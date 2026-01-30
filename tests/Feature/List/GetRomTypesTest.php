<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\List\RomTypesData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasLists::getRomTypes() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the rom types', function (): void {
    /** @var RomTypesData $response */
    $response = ScreenScraperClient::getRomTypes();

    expect($response)
        ->toBeInstanceOf(RomTypesData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the rom types in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getRomTypes();

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the rom types in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getRomTypes();

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'romTypes' => [
            'folder',
            'file',
            'iso',
            'rom',
        ],
    ];
}

function fakeRequest(): array
{
    return [
        'romtypes' => [
            'dossier',
            'fichier',
            'iso',
            'rom',
        ],
    ];
}
