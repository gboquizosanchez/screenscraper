<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\List\ClassificationsData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasLists::getClassifications() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the classifications', function (): void {
    /** @var ClassificationsData $response */
    $response = ScreenScraperClient::getClassifications();

    expect($response)
        ->toBeInstanceOf(ClassificationsData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the classifications in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getClassifications();

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the classifications in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getClassifications();

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'classifications' =>  [
            3324 =>  [
                'id' => '3324',
                'parentId' => 0,
            ],
            3326 =>  [
                'id' => '3326',
                'media' =>  [
                    0 =>  [
                        'type' => 'pictomonochrome',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=3326&media=logo-monochrome&mediaformat=png',
                        'crc' => '2209ca9d',
                        'md5' => '69ae2e55d29213699692a507575f03a2',
                        'sha1' => '15923f1cc22ea88ffe1ac0f29a4be547eaae1cdd',
                        'size' => '15025',
                        'format' => 'png',
                    ],
                    1 =>  [
                        'type' => 'pictomonochromesvg',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=3326&media=logo-monochrome-svg&mediaformat=svg',
                        'crc' => 'c5cfd710',
                        'md5' => '4947ebc57d34e4f9735a0be7924f14d7',
                        'sha1' => 'f2a432b10f1e33279d215e936614b1b68839c4a2',
                        'size' => '9467',
                        'format' => 'png',
                    ],
                ],
                'parentId' => 0,
            ],
        ],
    ];
}

function fakeRequest(): array
{
    return [
        'classifications' => [
            "3324" => [
                "id" => 3324,
                "nomcourt" => "SEGA:ForceMega02",
                "parent" => 0,
            ],
            "3326" => [
                "id" => 3326,
                "nomcourt" => "ESRB:KA",
                "parent" => 0,
                "medias" => [
                    [
                        "type" => "pictomonochrome",
                        "url" => "https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=3326&media=logo-monochrome&mediaformat=png",
                        "crc" => "2209ca9d",
                        "md5" => "69ae2e55d29213699692a507575f03a2",
                        "sha1" => "15923f1cc22ea88ffe1ac0f29a4be547eaae1cdd",
                        "size" => "15025",
                        "format" => "png",
                    ],
                    [
                        "type" => "pictomonochromesvg",
                        "url" => "https://neoclone.screenscraper.fr/api2/mediaGroup.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&groupid=3326&media=logo-monochrome-svg&mediaformat=svg",
                        "crc" => "c5cfd710",
                        "md5" => "4947ebc57d34e4f9735a0be7924f14d7",
                        "sha1" => "f2a432b10f1e33279d215e936614b1b68839c4a2",
                        "size" => "9467",
                        "format" => "png",
                    ],
                ],
            ],
        ],
    ];
}
