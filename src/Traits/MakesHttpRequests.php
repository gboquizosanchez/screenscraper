<?php

declare(strict_types=1);

namespace ScreenScraper\Traits;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use ScreenScraper\Enums\QuotaType;
use ScreenScraper\Exceptions\BadRequestException;
use ScreenScraper\Exceptions\ForbiddenException;
use ScreenScraper\Exceptions\GenericException;
use ScreenScraper\Exceptions\NotFoundException;
use ScreenScraper\Exceptions\QuotaExceededException;
use ScreenScraper\Exceptions\ScreenScraperException;
use ScreenScraper\Exceptions\UnauthorizedException;
use SensitiveParameter;

trait MakesHttpRequests
{
    protected PendingRequest $client;

    /**
     * @param array<string, mixed> $payload
     *
     * @return array<string, mixed>
     * @throws ConnectionException
     * @throws ScreenScraperException
     * @throws QuotaExceededException
     */
    final public function request(
        #[SensitiveParameter]
        string $uri,
        array $payload = [],
    ): array {
        $options = $payload === [] ? $payload : ['query' => $payload];

        $response = $this->send($uri, $options);

        if (! $this->isSuccessful($response)) {
            $this->handleRequestError($response);
        }

        $decoded = json_decode($response->body(), true);

        if (! is_array($decoded)) {
            throw new GenericException('Invalid JSON response');
        }

        /** @var array<string, mixed> $decoded */
        return $decoded;
    }

    /**
     * The API answers a hash that already matches (`CRCOK`, `MD5OK`, `SHA1OK`) or a missing
     * file (`NOMEDIA`) with a plain text body, so it is returned as is.
     *
     * @param array<string, mixed> $payload
     *
     * @throws ConnectionException
     * @throws ScreenScraperException
     * @throws QuotaExceededException
     */
    final public function requestRaw(
        #[SensitiveParameter]
        string $uri,
        array $payload = [],
    ): string {
        $options = $payload === [] ? $payload : ['query' => $payload];

        $response = $this->send($uri, $options);

        if (! $this->isSuccessful($response)) {
            $this->handleRequestError($response);
        }

        return $response->body();
    }

    /**
     * The URI carries the account credentials and the connection message quotes it,
     * so a failed connection is rethrown without that message or previous exception.
     *
     * @param array<string, mixed> $options
     *
     * @throws ConnectionException
     */
    private function send(
        #[SensitiveParameter]
        string $uri,
        array $options,
    ): Response {
        try {
            return $this->client->send('GET', $uri, $options);
        } catch (ConnectionException) {
            throw new ConnectionException('Could not connect to ScreenScraper.');
        }
    }

    private function isSuccessful(Response $response): bool
    {
        return (int) mb_substr((string) $response->status(), 0, 1) === 2;
    }

    abstract protected function redact(string $text): string;

    /**
     * The HTTP status is the exception code, and the message is the body of the answer,
     * redacted and trimmed. The request URL carries the credentials and is never part of it.
     *
     * @throws ScreenScraperException
     * @throws QuotaExceededException
     */
    private function handleRequestError(
        #[SensitiveParameter]
        Response $response
    ): void {
        $status = $response->status();
        $message = trim(
            mb_strimwidth(
                $this->redact(
                    $response->body(),
                ),
                start: 0,
                width: 200,
                trim_marker: '...'
            ),
        );

        if ($message === '') {
            $message = sprintf('HTTP status %d', $status);
        }

        match ($status) {
            400 => throw new BadRequestException($message, $status),
            403 => throw new ForbiddenException($message, $status),
            404 => throw new NotFoundException($message, $status),
            401 => throw new UnauthorizedException($message, $status),
            429, 430, 431 => throw new QuotaExceededException(
                $message,
                QuotaType::from($status),
            ),
            default => throw new GenericException($message, $status),
        };
    }
}
