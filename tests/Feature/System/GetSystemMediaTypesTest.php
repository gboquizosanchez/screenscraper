<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\System\SystemMediaTypesData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasSystems::getSystemMediaTypes() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the system media types', function (): void {
    /** @var SystemMediaTypesData $response */
    $response = ScreenScraperClient::getSystemMediaTypes();

    expect($response)
        ->toBeInstanceOf(SystemMediaTypesData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the system media types in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getSystemMediaTypes();

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the system media types in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getSystemMediaTypes();

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'mediaTypes' => [
            24 => [
                'id' => '24',
                'shortName' => 'logo-monochrome',
                'name' => 'Logo Monochrome',
                'category' => 'Logos',
                'platforms' => '',
                'fileFormat' => 'png',
                'secondFileFormat' => 'png',
                'autoGenerate' => false,
                'multiRegions' => true,
                'multiSupports' => false,
                'multiVersions' => false,
                'extraInfo' => '',
            ],
            25 => [
                'id' => '25',
                'shortName' => 'wheel',
                'name' => 'Wheel',
                'category' => 'Logos',
                'platforms' => '',
                'fileFormat' => 'png',
                'secondFileFormat' => 'png',
                'autoGenerate' => false,
                'multiRegions' => true,
                'multiSupports' => false,
                'multiVersions' => false,
                'extraInfo' => '',
            ],
        ],
    ];
}

function fakeRequest(): array
{
    return [
        'medias' => [
            24 => [
                'id' => 24,
                'nomcourt' => 'logo-monochrome',
                'nom' => 'Logo Monochrome',
                'categorie' => 'Logos',
                'plateformtypes' => '',
                'plateforms' => '',
                'type' => 'image',
                'fileformat' => 'png',
                'fileformat2' => 'png',
                'autogen' => '0',
                'multiregions' => '1',
                'multisupports' => '0',
                'multiversions' => '0',
                'extrainfostxt' => '',
            ],
            25 => [
                'id' => 25,
                'nomcourt' => 'wheel',
                'nom' => 'Wheel',
                'categorie' => 'Logos',
                'plateformtypes' => '',
                'plateforms' => '',
                'type' => 'image',
                'fileformat' => 'png',
                'fileformat2' => 'png',
                'autogen' => '0',
                'multiregions' => '1',
                'multisupports' => '0',
                'multiversions' => '0',
                'extrainfostxt' => '',
            ],
        ],
    ];
}
