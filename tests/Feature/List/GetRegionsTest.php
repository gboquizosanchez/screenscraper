<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\List\RegionsData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasLists::getRegions() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the regions', function (): void {
    /** @var RegionsData $response */
    $response = ScreenScraperClient::getRegions();

    expect($response)
        ->toBeInstanceOf(RegionsData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the rom types in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getRegions();

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the rom types in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getRegions();

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'regions' => [
            46 => [
                'id' => '46',
                'shortName' => 'us',
                'nameFr' => 'USA',
                'nameEn' => 'USA',
                'nameEs' => 'USA',
                'nameDe' => 'USA',
                'nameIt' => 'USA',
                'namePt' => 'EUA',
                'parentId' => 3257,
            ],
            47 => [
                'id' => '47',
                'shortName' => 'jp',
                'nameFr' => 'Japon',
                'nameEn' => 'Japan',
                'nameEs' => 'Japón',
                'nameDe' => 'Japan',
                'namePt' => 'Japão',
                'parentId' => 114,
            ],
            48 => [
                'id' => '48',
                'shortName' => 'eu',
                'nameFr' => 'Europe',
                'nameEn' => 'Europe',
                'nameEs' => 'Europa',
                'nameDe' => 'Europa',
                'namePt' => 'Europa',
                'parentId' => 0,
            ],
            57 => [
                'id' => '57',
                'shortName' => 'wor',
                'nameFr' => 'Monde',
                'nameEn' => 'World',
                'nameEs' => 'Mundo',
                'nameDe' => 'World',
                'namePt' => 'Mundo',
                'parentId' => 0,
            ],
            122 => [
                'id' => '122',
                'shortName' => 'sp',
                'nameFr' => 'Espagne',
                'nameEn' => 'Spain',
                'nameEs' => 'España',
                'nameDe' => 'Spanien',
                'namePt' => 'Espanha',
                'parentId' => 48,
            ],
        ],
    ];
}

function fakeRequest(): array
{
    return [
        'regions' => [
            46 => [
                'id' => 46,
                'nomcourt' => 'us',
                'nom_fr' => 'USA',
                'nom_de' => 'USA',
                'nom_en' => 'USA',
                'nom_es' => 'USA',
                'nom_it' => 'USA',
                'nom_pt' => 'EUA',
                'parent' => '3257',
            ],
            47 => [
                'id' => 47,
                'nomcourt' => 'jp',
                'nom_fr' => 'Japon',
                'nom_de' => 'Japan',
                'nom_en' => 'Japan',
                'nom_es' => 'Japón',
                'nom_pt' => 'Japão',
                'parent' => '114',
            ],
            48 => [
                'id' => 48,
                'nomcourt' => 'eu',
                'nom_fr' => 'Europe',
                'nom_de' => 'Europa',
                'nom_en' => 'Europe',
                'nom_es' => 'Europa',
                'nom_pt' => 'Europa',
                'parent' => '0',
            ],
            57 => [
                'id' => 57,
                'nomcourt' => 'wor',
                'nom_fr' => 'Monde',
                'nom_de' => 'World',
                'nom_en' => 'World',
                'nom_es' => 'Mundo',
                'nom_pt' => 'Mundo',
                'parent' => '0',
            ],
            122 => [
                'id' => 122,
                'nomcourt' => 'sp',
                'nom_fr' => 'Espagne',
                'nom_de' => 'Spanien',
                'nom_en' => 'Spain',
                'nom_es' => 'España',
                'nom_pt' => 'Espanha',
                'parent' => '48',
            ],
        ],
    ];
}
