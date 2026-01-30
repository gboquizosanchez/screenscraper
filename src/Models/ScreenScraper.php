<?php

declare(strict_types=1);

namespace ScreenScraper\Models;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use ScreenScraper\Data;
use ScreenScraper\Data\AuthData;
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
     * @phpstan-ignore-next-line
     */
    public function call(
        string $endpoint,
        array $parameters = [],
        bool $filtered = true,
    ): array {
        if ($filtered) {
            $parameters = array_filter($parameters);
        }

        $request = $this->request(
            $this->url($endpoint, $parameters),
        );

        assert(is_array($request));

        return $request;
    }

    /**
     * Raw/binary call (media, video, manuals, etc).
     *
     * @throws ConnectionException
     * @throws ScreenScraperException
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
     * @param array<string, mixed> $parameters
     */
    public function url(string $endpoint, array $parameters): string
    {
        return sprintf('%s?%s', $endpoint, $this->buildQuery($parameters));
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
     * @param array<string, mixed>|array<int, int|string|true|null> $data
     * @param class-string<Data> $dto
     *
     * @return array|T
     */
    public function response(
        array $data,
        string $dto,
        ?string $mapKey = null,
    ): array | Data {
        if (config('screenscraper.mapping.raw_properties')) {
            return $data;
        }

        /** @var T $dtoInstance */
        $dtoInstance = $mapKey === null
            ? $dto::from($data)
            : $dto::from([
                $mapKey => $data,
            ]);

        if (config('screenscraper.mapping.dto')) {
            return $dtoInstance;
        }

        return $dtoInstance->transformed();
    }
}
