<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\List\SupportTypesData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasLists::getSupportTypes() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the support types', function (): void {
    /** @var SupportTypesData $response */
    $response = ScreenScraperClient::getSupportTypes();

    expect($response)
        ->toBeInstanceOf(SupportTypesData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the support types in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getSupportTypes();

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the support types in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getSupportTypes();

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'supportTypes' => [
            'blueRay',
            'card',
            'cartridge',
            'cartridgeCd',
            'cartridgeDownload',
            'cartridgeCassette',
            'cartridgeCassetteDiskette',
            'cd',
            'cdDiskette',
            'diskette',
            'download',
            'hardware',
            'cassette',
            'cassetteDiskette',
            'notApplicable',
            'pcb',
            'smc',
            'videotape',
            'web',
        ],
    ];
}

function fakeRequest(): array
{
    return [
        'supporttypes' => [
            'Bluray',
            'carte',
            'cartouche',
            'cartouche&cd',
            'cartouche&download',
            'cartouche&k7',
            'cartouche&k7&disquette',
            'cd',
            'cd&disquette',
            'disquette',
            'download',
            'hardware',
            'k7',
            'k7&disquette',
            'non-applicable',
            'pcb',
            'smc',
            'videotape',
            'web',
        ],
    ];
}
