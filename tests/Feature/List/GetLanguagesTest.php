<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\List\LanguagesData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasLists::getLanguages() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the languages', function (): void {
    /** @var LanguagesData $response */
    $response = ScreenScraperClient::getLanguages();

    expect($response)
        ->toBeInstanceOf(LanguagesData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the languages in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getLanguages();

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the languages in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getLanguages();

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'languages' => [
            68 => [
                'id' => '68',
                'shortName' => 'en',
                'nameFr' => 'Anglais',
                'nameEn' => 'English',
                'nameEs' => 'Inglés',
                'nameDe' => 'Englisch',
                'nameIt' => 'Inglese',
                'namePt' => 'Inglês',
                'parentId' => 0,
            ],
            69 => [
                'id' => '69',
                'shortName' => 'fr',
                'nameFr' => 'Français',
                'nameEn' => 'French',
                'nameEs' => 'Francés',
                'nameDe' => 'Französisch',
                'nameIt' => 'Francese',
                'namePt' => 'Francês',
                'parentId' => 0,
            ],
            70 => [
                'id' => '70',
                'shortName' => 'de',
                'nameFr' => 'Allemand',
                'nameEn' => 'German',
                'nameEs' => 'Alemán',
                'nameDe' => 'Deutsch',
                'nameIt' => 'Tedesco',
                'namePt' => 'Alemão',
                'parentId' => 0,
            ],
            71 => [
                'id' => '71',
                'shortName' => 'es',
                'nameFr' => 'Espagnol',
                'nameEn' => 'Spanish',
                'nameEs' => 'Español',
                'nameDe' => 'Spanisch',
                'nameIt' => 'Spagnolo',
                'namePt' => 'Espanhol',
                'parentId' => 0,
            ],
            72 => [
                'id' => '72',
                'shortName' => 'it',
                'nameFr' => 'Italien',
                'nameEn' => 'Italian',
                'nameEs' => 'Italiano',
                'nameDe' => 'Italienisch',
                'nameIt' => 'Italiano',
                'namePt' => 'Italiano',
                'parentId' => 0,
            ],
            73 => [
                'id' => '73',
                'shortName' => 'ja',
                'nameFr' => 'Japonais',
                'nameEn' => 'Japanese',
                'nameEs' => 'Japonés',
                'nameDe' => 'Japanisch',
                'nameIt' => 'Giapponese',
                'namePt' => 'Japonês',
                'parentId' => 0,
            ],
        ],
    ];
}

function fakeRequest(): array
{
    return [
        'langues' => [
            68 => [
                'id' => 68,
                'nomcourt' => 'en',
                'nom_fr' => 'Anglais',
                'nom_de' => 'Englisch',
                'nom_en' => 'English',
                'nom_es' => 'Inglés',
                'nom_it' => 'Inglese',
                'nom_pt' => 'Inglês',
                'parent' => '0',
            ],
            69 => [
                'id' => 69,
                'nomcourt' => 'fr',
                'nom_fr' => 'Français',
                'nom_de' => 'Französisch',
                'nom_en' => 'French',
                'nom_es' => 'Francés',
                'nom_it' => 'Francese',
                'nom_pt' => 'Francês',
                'parent' => '0',
            ],
            70 => [
                'id' => 70,
                'nomcourt' => 'de',
                'nom_fr' => 'Allemand',
                'nom_de' => 'Deutsch',
                'nom_en' => 'German',
                'nom_es' => 'Alemán',
                'nom_it' => 'Tedesco',
                'nom_pt' => 'Alemão',
                'parent' => '0',
            ],
            71 => [
                'id' => 71,
                'nomcourt' => 'es',
                'nom_fr' => 'Espagnol',
                'nom_de' => 'Spanisch',
                'nom_en' => 'Spanish',
                'nom_es' => 'Español',
                'nom_it' => 'Spagnolo',
                'nom_pt' => 'Espanhol',
                'parent' => '0',
            ],
            72 => [
                'id' => 72,
                'nomcourt' => 'it',
                'nom_fr' => 'Italien',
                'nom_de' => 'Italienisch',
                'nom_en' => 'Italian',
                'nom_es' => 'Italiano',
                'nom_it' => 'Italiano',
                'nom_pt' => 'Italiano',
                'parent' => '0',
            ],
            73 => [
                'id' => 73,
                'nomcourt' => 'ja',
                'nom_fr' => 'Japonais',
                'nom_de' => 'Japanisch',
                'nom_en' => 'Japanese',
                'nom_es' => 'Japonés',
                'nom_it' => 'Giapponese',
                'nom_pt' => 'Japonês',
                'parent' => '0',
            ],
        ],
    ];
}
