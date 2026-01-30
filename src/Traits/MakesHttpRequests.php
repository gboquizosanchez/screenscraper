<?php

declare(strict_types=1);

namespace ScreenScraper\Traits;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use ScreenScraper\Exceptions\ForbiddenException;
use ScreenScraper\Exceptions\GenericException;
use ScreenScraper\Exceptions\NotFoundException;
use ScreenScraper\Exceptions\ScreenScraperException;
use ScreenScraper\Exceptions\UnauthorizedException;

trait MakesHttpRequests
{
    protected PendingRequest $client;

    /**
     * @param  string  $uri
     * @param  array<string, mixed>  $payload
     *
     * @return mixed
     * @throws ConnectionException
     * @throws ScreenScraperException
     */
    final public function request(string $uri, array $payload = []): mixed
    {
        $options = $payload === [] ? $payload : ['query' => $payload];

        $response = $this->client->send('GET', $uri, $options);

        if (! $this->isSuccessful($response)) {
            $this->handleRequestError($response);
        }

        $decoded = json_decode($response->body(), true);

        if (! is_array($decoded)) {
            throw new GenericException('Invalid JSON response');
        }

        return $decoded;
    }

    /**
     * Request raw/binary content (media, video, manual PDFs, etc).
     *
     * @param string $uri
     * @param array<string, mixed> $payload
     *
     * @return string
     * @throws ConnectionException
     * @throws ScreenScraperException
     */
    final public function requestRaw(string $uri, array $payload = []): string
    {
        $options = $payload === [] ? $payload : ['query' => $payload];

        $response = $this->client->send('GET', $uri, $options);

        if (! $this->isSuccessful($response)) {
            $this->handleRequestError($response);
        }

        return $response->body();
    }

    private function isSuccessful(Response $response): bool
    {
        return (int) mb_substr((string) $response->status(), 0, 1) === 2;
    }

    /**
     * @throws ScreenScraperException
     */
    private function handleRequestError(Response $response): void
    {
        $body = $response->body();
        $status = $response->status();

        match ($status) {
            403 => throw new ForbiddenException($body),
            404 => throw new NotFoundException($body),
            401 => throw new UnauthorizedException($body),
            default => null,
        };

        if (! json_validate($body)) {
            throw new GenericException('Invalid JSON response');
        }

        throw new GenericException($body);
    }
}
