<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasGames::getGameInfoTypes() */
/** @see \ScreenScraper\Traits\HasGames::getRomInfoTypes() */
/** @see \ScreenScraper\Traits\HasGames::getGameMediaTypes() */
it('does not send a game to the media types list', function (): void {
    Http::fake([
        '*' => Http::response([
            'response' => [
                'medias' => [],
            ],
        ]),
    ]);

    ScreenScraperClient::getGameMediaTypes(5);

    expect(lastPath())->toBe('mediasJeuListe.php')
        ->and(lastQuery())->toBe([]);
});

it('maps the lists of types without a known shape', function (string $method, string $property): void {
    Http::fake([
        '*' => Http::response([
            'response' => [
                $property => [
                    'a' => [
                        'id' => 1,
                    ],
                ],
            ],
        ]),
    ]);

    $this->app['config']->set('screenscraper.mapping.dto', false);

    expect(ScreenScraperClient::{$method}())->toBe([
        $property => [
            'a' => [
                'id' => 1,
            ],
        ],
    ]);
})->with([
    ['getGameInfoTypes', 'infos'],
    ['getRomInfoTypes', 'infos'],
    ['getGameMediaTypes', 'medias'],
]);
