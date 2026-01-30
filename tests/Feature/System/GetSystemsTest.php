<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\System\SystemsData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasSystems::getSystems() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the systems', function (): void {
    /** @var SystemsData $response */
    $response = ScreenScraperClient::getSystems();

    expect($response)
        ->toBeInstanceOf(SystemsData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the systems in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getSystems();

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the systems in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getSystems();

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'systems' => [
            [
                'id' => 1,
                'names' => [
                    'nameEu' => 'Megadrive',
                    'nameUs' => 'Genesis',
                    'nameRecalbox' => 'megadrive',
                    'nameRetropie' => 'genesis,megadrive',
                    'nameLaunchbox' => 'Sega Genesis',
                    'nameHyperspin' => 'Sega Genesis',
                    'commonNames' => 'Sega Megadrive,Sega Genesis,Megadrive,Genesis,Super Aladdin Boy',
                ],
                'extensions' => 'gen,md,smd,bin,sg',
                'company' => 'SEGA',
                'type' => 'Console',
                'startDate' => '1988',
                'endDate' => '1998',
                'romType' => 'rom',
                'supportType' => 'cartridge',
                'medias' => [
                    [
                        'type' => 'logo-monochrome',
                        'parent' => 'systeme',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaSysteme.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&systemeid=1&media=logo-monochrome(br)',
                        'region' => 'br',
                        'support' => '0',
                        'crc' => '85be4a0e',
                        'md5' => '69e98b292ffeedfa1ed19fd556492df5',
                        'sha1' => 'de678ddec48cdf8d048d02edc6bbe05dad636260',
                        'size' => null,
                        'format' => 'png',
                    ],
                ],
            ],
        ],
    ];
}

function fakeRequest(): array
{
    return [
        'systemes' => [
            [
                'id' => 1,
                'noms' => [
                    'nom_eu' => 'Megadrive',
                    'nom_us' => 'Genesis',
                    'nom_recalbox' => 'megadrive',
                    'nom_retropie' => 'genesis,megadrive',
                    'nom_launchbox' => 'Sega Genesis',
                    'nom_hyperspin' => 'Sega Genesis',
                    'noms_commun' => 'Sega Megadrive,Sega Genesis,Megadrive,Genesis,Super Aladdin Boy',
                ],
                'extensions' => 'gen,md,smd,bin,sg',
                'compagnie' => 'SEGA',
                'type' => 'Console',
                'datedebut' => '1988',
                'datefin' => '1998',
                'romtype' => 'rom',
                'supporttype' => 'cartouche',
                'medias' => [
                    [
                        'type' => 'logo-monochrome',
                        'parent' => 'systeme',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaSysteme.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&systemeid=1&media=logo-monochrome(br)',
                        'region' => 'br',
                        'support' => '0',
                        'crc' => '85be4a0e',
                        'md5' => '69e98b292ffeedfa1ed19fd556492df5',
                        'sha1' => 'de678ddec48cdf8d048d02edc6bbe05dad636260',
                        'format' => 'png',
                    ],
                ],
            ],
        ],
    ];
}
