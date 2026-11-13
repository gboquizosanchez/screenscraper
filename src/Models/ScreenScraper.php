<?php

declare(strict_types=1);

namespace ScreenScraper\Models;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Override;
use ScreenScraper\Data;
use ScreenScraper\Data\AuthData;
use ScreenScraper\Exceptions\QuotaExceededException;
use ScreenScraper\Exceptions\ScreenScraperException;
use ScreenScraper\Traits\HasBots;
use ScreenScraper\Traits\HasGames;
use ScreenScraper\Traits\HasGroups;
use ScreenScraper\Traits\HasInfrastructure;
use ScreenScraper\Traits\HasLists;
use ScreenScraper\Traits\HasSystems;
use ScreenScraper\Traits\HasUsers;
use ScreenScraper\Traits\MakesHttpRequests;

final class ScreenScraper
{
    use MakesHttpRequests;
    use HasInfrastructure;
    use HasUsers;
    use HasLists;
    use HasSystems;
    use HasGames;
    use HasGroups;
    use HasBots;

    public function __construct(
        private readonly AuthData $authorization,
    ) {
        $url = Config::get('screenscraper.base_url');

        assert(is_string($url));

        $this->client = Http::baseUrl($url)
            ->withHeader(
                'User-Agent',
                'ScreenScraper API Client',
            )
            ->acceptJson();
    }

    /**
     * @param array<string, mixed> $parameters
     *
     * @return array<string, mixed>
     * @throws ConnectionException
     * @throws ScreenScraperException
     * @throws QuotaExceededException
     */
    public function call(
        string $endpoint,
        array $parameters = [],
        bool $filtered = true,
    ): array {
        if ($filtered) {
            $parameters = array_filter($parameters);
        }

        return $this->request(
            $this->url($endpoint, $parameters),
        );
    }

    /**
     * @param array<string, mixed> $parameters
     *
     * @throws ConnectionException
     * @throws ScreenScraperException
     * @throws QuotaExceededException
     */
    public function callRaw(
        string $endpoint,
        array $parameters = [],
        bool $filtered = true,
    ): string {
        if ($filtered) {
            $parameters = array_filter($parameters);
        }

        return $this->requestRaw(
            $this->url($endpoint, $parameters),
        );
    }

    /**
     * @param array<string, mixed> $fields
     *
     * @throws ConnectionException
     * @throws ScreenScraperException
     * @throws QuotaExceededException
     */
    public function callPost(
        string $endpoint,
        array $fields = [],
    ): string {
        return $this->requestPost(
            $this->url($endpoint, []),
            array_filter($fields),
        );
    }

    /**
     * @param array<string, mixed> $parameters
     */
    private function url(string $endpoint, array $parameters): string
    {
        return sprintf('%s?%s', $endpoint, $this->buildQuery($parameters));
    }

    #[Override]
    protected function redact(string $text): string
    {
        $secrets = [
            $this->authorization->devId,
            $this->authorization->devPassword,
            $this->authorization->id,
            $this->authorization->password,
        ];

        foreach ($secrets as $secret) {
            if ($secret !== null && $secret !== '') {
                $text = str_replace($secret, '[redacted]', $text);
            }
        }

        $text = preg_replace(
            '~https?://[^\s"\']+~i',
            '[redacted]',
            $text,
        ) ?? '';

        return preg_replace(
            '~\b(devid|devpassword|softname|ssid|sspassword)=[^&\s"\']*~i',
            '$1=[redacted]',
            $text,
        ) ?? '';
    }

    /**
     * @param array<string, mixed> $parameters
     */
    private function buildQuery(array $parameters = []): string
    {
        return http_build_query(
            $this->authorization->credentials() + $parameters,
        );
    }

    /**
     * @template T of Data
     *
     * @param array<string, mixed> $data
     * @param class-string<T> $dto
     *
     * @return array<string, mixed>|T
     */
    public function response(
        array $data,
        string $dto,
        ?string $mapKey = null,
    ): array | Data {
        if (config('screenscraper.mapping.raw_properties')) {
            return $data;
        }

        $response = $data['response'] ?? [];

        if ($mapKey === null) {
            $dtoInstance = $dto::from($response);
        } else {
            $dtoInstance = $dto::from([
                $mapKey => $response,
            ]);
        }

        if (config('screenscraper.mapping.dto')) {
            return $dtoInstance;
        }

        return $dtoInstance->transformed();
    }
}
