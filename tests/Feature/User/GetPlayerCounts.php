<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\User\PlayerCountsData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasUsers::getPlayerCounts() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the player counts', function (): void {
    /** @var PlayerCountsData $response */
    $response = ScreenScraperClient::getPlayerCounts();

    expect($response)
        ->toBeInstanceOf(PlayerCountsData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the player counts in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getPlayerCounts();

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the player counts in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getPlayerCounts();

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'numberOfPlayers' => [
            3304 => [
                'id' => 3304,
                'number' => '1-2',
                'parentId' => 0,
            ],
            3309 => [
                'id' => 3309,
                'number' => '1',
                'parentId' => 0,
            ],
            3348 => [
                'id' => 3348,
                'number' => '1-3',
                'parentId' => 0,
            ],
            3357 => [
                'id' => 3357,
                'number' => '2',
                'parentId' => 0,
            ],
            3369 => [
                'id' => 3369,
                'number' => '1-4',
                'parentId' => 0,
            ],
            3374 => [
                'id' => 3374,
                'number' => '1-6',
                'parentId' => 0,
            ],
            3376 => [
                'id' => 3376,
                'number' => '1-8',
                'parentId' => 0,
            ],
            3390 => [
                'id' => 3390,
                'number' => '8+',
                'parentId' => 0,
            ],
            3398 => [
                'id' => 3398,
                'number' => '1-5',
                'parentId' => 0,
            ],
            3402 => [
                'id' => 3402,
                'number' => '4+',
                'parentId' => 0,
            ],
        ],
    ];
}

function fakeRequest(): array
{
    return [
        'nbjoueurs' => [
            3304 => [
                'id' => 3304,
                'nom' => '1-2',
                'parent' => '0',
            ],
            3309 => [
                'id' => 3309,
                'nom' => '1',
                'parent' => '0',
            ],
            3348 => [
                'id' => 3348,
                'nom' => '1-3',
                'parent' => '0',
            ],
            3357 => [
                'id' => 3357,
                'nom' => '2',
                'parent' => '0',
            ],
            3369 => [
                'id' => 3369,
                'nom' => '1-4',
                'parent' => '0',
            ],
            3374 => [
                'id' => 3374,
                'nom' => '1-6',
                'parent' => '0',
            ],
            3376 => [
                'id' => 3376,
                'nom' => '1-8',
                'parent' => '0',
            ],
            3390 => [
                'id' => 3390,
                'nom' => '8+',
                'parent' => '0',
            ],
            3398 => [
                'id' => 3398,
                'nom' => '1-5',
                'parent' => '0',
            ],
            3402 => [
                'id' => 3402,
                'nom' => '4+',
                'parent' => '0',
            ],
        ],
    ];
}
