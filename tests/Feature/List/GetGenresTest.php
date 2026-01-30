<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\List\GenresData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasLists::getGenres() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the genres', function (): void {
    /** @var GenresData $response */
    $response = ScreenScraperClient::getGenres();

    expect($response)
        ->toBeInstanceOf(GenresData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the genres in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getGenres();

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the genres in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getGenres();

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'genres' => [
            1 => [
                'id' => '1',
                'nameFr' => 'Beat\'em All',
                'nameEn' => 'Beat\'em Up',
                'nameEs' => 'Beat\'em Up',
                'nameDe' => 'Beat\'em Up',
                'nameIt' => 'Beat\'em All',
                'namePt' => 'Briga de rua',
                'parentId' => 0,
                'media' => [
                    0 => [
                        'type' => 'pictomonochrome',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=1&media=logo-monochrome&mediaformat=png',
                        'crc' => '3974c2c4',
                        'md5' => '19fa1571415cc4d60d321d1c42dd45b5',
                        'sha1' => '27a372f24bbf11f0a7050bfea0bbcab612935244',
                        'size' => '9003',
                        'format' => 'png',
                    ],
                    1 => [
                        'type' => 'pictomonochromesvg',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=1&media=logo-monochrome-svg&mediaformat=svg',
                        'crc' => 'ccb72604',
                        'md5' => 'a3cce15fcad1ab4329a718a6b0d27d7e',
                        'sha1' => '1de1e8426d307e4cc56b909ffe353813822278e3',
                        'size' => '2918',
                        'format' => 'png',
                    ],
                    2 => [
                        'type' => 'background',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=1&media=background&mediaformat=jpg',
                        'crc' => '76efc81b',
                        'md5' => 'c110398f549f2cc0e3203275655943e1',
                        'sha1' => 'e11e67f962b414d3bdfcc1afe285bab4135c6d1b',
                        'size' => '161306',
                        'format' => 'jpg',
                    ],
                ],
            ],
            7 => [
                'id' => '7',
                'nameFr' => 'Plateforme',
                'nameEn' => 'Platform',
                'nameEs' => 'Plataformas',
                'nameDe' => 'Plattform',
                'nameIt' => 'Piattaforma',
                'namePt' => 'Plataforma',
                'parentId' => 0,
                'media' => [
                    0 => [
                        'type' => 'pictomonochrome',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=7&media=logo-monochrome&mediaformat=png',
                        'crc' => '0f88a1ba',
                        'md5' => 'e8c818f5f59d48642afea18e5c545c15',
                        'sha1' => 'ef3857055eaae13785d2cab692edf9454b544be3',
                        'size' => '9142',
                        'format' => 'png',
                    ],
                    1 => [
                        'type' => 'pictomonochromesvg',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=7&media=logo-monochrome-svg&mediaformat=svg',
                        'crc' => 'fa797dda',
                        'md5' => '73a61640b94904834fdbfc7e043150e0',
                        'sha1' => '3e5fe422339961df30bd70aa83e43671a1badce4',
                        'size' => '4755',
                        'format' => 'png',
                    ],
                    2 => [
                        'type' => 'background',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=7&media=background&mediaformat=jpg',
                        'crc' => '3d578fbf',
                        'md5' => '62dbdbe08a5765fae2630d06e0f0ea38',
                        'sha1' => '354ef394870af26f443863a29c846a07a20f47a0',
                        'size' => '161158',
                        'format' => 'jpg',
                    ],
                ],
            ],
        ],
    ];
}

function fakeRequest(): array
{
    return [
        'genres' => [
            '1' => [
                'id' => 1,
                'nom_fr' => "Beat'em All",
                'nom_de' => "Beat'em Up",
                'nom_en' => "Beat'em Up",
                'nom_es' => "Beat'em Up",
                'nom_it' => "Beat'em All",
                'nom_pt' => 'Briga de rua',
                'parent' => '0',
                'medias' => [
                    [
                        'type' => 'pictomonochrome',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=1&media=logo-monochrome&mediaformat=png',
                        'crc' => '3974c2c4',
                        'md5' => '19fa1571415cc4d60d321d1c42dd45b5',
                        'sha1' => '27a372f24bbf11f0a7050bfea0bbcab612935244',
                        'size' => '9003',
                        'format' => 'png',
                    ],
                    [
                        'type' => 'pictomonochromesvg',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=1&media=logo-monochrome-svg&mediaformat=svg',
                        'crc' => 'ccb72604',
                        'md5' => 'a3cce15fcad1ab4329a718a6b0d27d7e',
                        'sha1' => '1de1e8426d307e4cc56b909ffe353813822278e3',
                        'size' => '2918',
                        'format' => 'png',
                    ],
                    [
                        'type' => 'background',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=1&media=background&mediaformat=jpg',
                        'crc' => '76efc81b',
                        'md5' => 'c110398f549f2cc0e3203275655943e1',
                        'sha1' => 'e11e67f962b414d3bdfcc1afe285bab4135c6d1b',
                        'size' => '161306',
                        'format' => 'jpg',
                    ],
                ],
            ],
            '7' => [
                'id' => 7,
                'nom_fr' => 'Plateforme',
                'nom_de' => 'Plattform',
                'nom_en' => 'Platform',
                'nom_es' => 'Plataformas',
                'nom_it' => 'Piattaforma',
                'nom_pt' => 'Plataforma',
                'parent' => '0',
                'medias' => [
                    [
                        'type' => 'pictomonochrome',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=7&media=logo-monochrome&mediaformat=png',
                        'crc' => '0f88a1ba',
                        'md5' => 'e8c818f5f59d48642afea18e5c545c15',
                        'sha1' => 'ef3857055eaae13785d2cab692edf9454b544be3',
                        'size' => '9142',
                        'format' => 'png',
                    ],
                    [
                        'type' => 'pictomonochromesvg',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=7&media=logo-monochrome-svg&mediaformat=svg',
                        'crc' => 'fa797dda',
                        'md5' => '73a61640b94904834fdbfc7e043150e0',
                        'sha1' => '3e5fe422339961df30bd70aa83e43671a1badce4',
                        'size' => '4755',
                        'format' => 'png',
                    ],
                    [
                        'type' => 'background',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=7&media=background&mediaformat=jpg',
                        'crc' => '3d578fbf',
                        'md5' => '62dbdbe08a5765fae2630d06e0f0ea38',
                        'sha1' => '354ef394870af26f443863a29c846a07a20f47a0',
                        'size' => '161158',
                        'format' => 'jpg',
                    ],
                ],
            ],
        ],
    ];
}
