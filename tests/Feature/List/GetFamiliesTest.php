<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\List\FamiliesData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasLists::getFamilies() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the families', function (): void {
    /** @var FamiliesData $response */
    $response = ScreenScraperClient::getFamilies();

    expect($response)
        ->toBeInstanceOf(FamiliesData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the families in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getFamilies();

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the families in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getFamilies();

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'families' =>  [
            226 =>  [
                'id' => '226',
                'name' => 'Disney',
                'media' =>  [
                    0 =>  [
                        'type' => 'figurine',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=226&media=figurine&mediaformat=png',
                        'crc' => 'd6da5333',
                        'md5' => 'aafe0b5e3e75f5d837ec903eae896281',
                        'sha1' => '3e25ab37023957475a5680779bd057b34f33ac76',
                        'size' => '161473',
                        'format' => 'png',
                    ],
                ],
            ],
            255 =>  [
                'id' => '255',
                'name' => 'Deathsmiles',
            ],
        ],
    ];
}

function fakeRequest(): array
{
    return [
        'familles' => [
            '226' => [
                'id' => 226,
                'nom' => 'Disney',
                'medias' => [
                    [
                        'type' => 'figurine',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=226&media=figurine&mediaformat=png',
                        'crc' => 'd6da5333',
                        'md5' => 'aafe0b5e3e75f5d837ec903eae896281',
                        'sha1' => '3e25ab37023957475a5680779bd057b34f33ac76',
                        'size' => '161473',
                        'format' => 'png',
                    ],
                ],
            ],
            '255' => [
                'id' => 255,
                'nom' => 'Deathsmiles',
            ],
        ],
    ];
}
