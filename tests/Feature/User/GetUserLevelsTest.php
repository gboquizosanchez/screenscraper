<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\User\UserLevelsData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasUsers::getUserLevels() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the levels', function (): void {
    /** @var UserLevelsData $response */
    $response = ScreenScraperClient::getUserLevels();

    expect($response)
        ->toBeInstanceOf(UserLevelsData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the levels in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getUserLevels();

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the levels in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getUserLevels();

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'levels' => [
            1 => [
                'id' => 1,
                'name' => 'Membre',
            ],
            10 => [
                'id' => 10,
                'name' => 'Contributeur Occasionnel',
            ],
            11 => [
                'id' => 11,
                'name' => 'Infographiste Contributeur Occasionnel',
            ],
            15 => [
                'id' => 15,
                'name' => 'Contributeur',
            ],
            16 => [
                'id' => 16,
                'name' => 'Infographiste Contributeur',
            ],
            20 => [
                'id' => 20,
                'name' => 'Fervent Contributeur',
            ],
            21 =>  [
                'id' => 21,
                'name' => 'Fervent Infographiste Contributeur',
            ],
            25 =>  [
                'id' => 25,
                'name' => 'Maître Contributeur',
            ],
            26 =>  [
                'id' => 26,
                'name' => 'Maître Infographiste Contributeur',
            ],
            30 =>  [
                'id' => 30,
                'name' => 'Grand Grourou Contributeur',
            ],
            31 =>  [
                'id' => 31,
                'name' => 'Grand Gourou Infographiste Contributeur',
            ],
            35 =>  [
                'id' => 35,
                'name' => 'Contributeur de Confiance',
            ],
            36 =>  [
                'id' => 36,
                'name' => 'Infographiste Contributeur de Confiance',
            ],
            40 =>  [
                'id' => 40,
                'name' => 'Traducteur',
            ],
            42 =>  [
                'id' => 42,
                'name' => 'Community Manager',
            ],
            45 =>  [
                'id' => 45,
                'name' => 'Modérateur Système(s)',
            ],
            49 =>  [
                'id' => 49,
                'name' => 'Modérateur',
            ],
            59 =>  [
                'id' => 59,
                'name' => 'Super Modérateur',
            ],
            69 =>  [
                'id' => 69,
                'name' => 'Admin',
            ],
            99 =>  [
                'id' => 99,
                'name' => 'Super Admin',
            ],
            101 =>  [
                'id' => 101,
                'name' => 'Robot',
            ],
            199 =>  [
                'id' => 199,
                'name' => 'Darwiniste qui en veut',
            ],
            500 =>  [
                'id' => 500,
                'name' => 'Demi Dieu',
            ],
            502 =>  [
                'id' => 502,
                'name' => '2/3 de Dieu',
            ],
            1000 =>  [
                'id' => 1000,
                'name' => 'Dieu tout puissant',
            ],
            2000 =>  [
                'id' => 2000,
                'name' => 'Chuck Norris',
            ],
        ],
    ];
}

function fakeRequest(): array
{
    return [
        'userlevels' => [
            1 => [
                'id' => 1,
                'name' => 'Membre',
            ],
            10 => [
                'id' => 10,
                'name' => 'Contributeur Occasionnel',
            ],
            11 => [
                'id' => 11,
                'name' => 'Infographiste Contributeur Occasionnel',
            ],
            15 => [
                'id' => 15,
                'name' => 'Contributeur',
            ],
            16 => [
                'id' => 16,
                'name' => 'Infographiste Contributeur',
            ],
            20 => [
                'id' => 20,
                'name' => 'Fervent Contributeur',
            ],
            21 =>  [
                'id' => 21,
                'name' => 'Fervent Infographiste Contributeur',
            ],
            25 =>  [
                'id' => 25,
                'name' => 'Maître Contributeur',
            ],
            26 =>  [
                'id' => 26,
                'name' => 'Maître Infographiste Contributeur',
            ],
            30 =>  [
                'id' => 30,
                'name' => 'Grand Grourou Contributeur',
            ],
            31 =>  [
                'id' => 31,
                'name' => 'Grand Gourou Infographiste Contributeur',
            ],
            35 =>  [
                'id' => 35,
                'name' => 'Contributeur de Confiance',
            ],
            36 =>  [
                'id' => 36,
                'name' => 'Infographiste Contributeur de Confiance',
            ],
            40 =>  [
                'id' => 40,
                'name' => 'Traducteur',
            ],
            42 =>  [
                'id' => 42,
                'name' => 'Community Manager',
            ],
            45 =>  [
                'id' => 45,
                'name' => 'Modérateur Système(s)',
            ],
            49 =>  [
                'id' => 49,
                'name' => 'Modérateur',
            ],
            59 =>  [
                'id' => 59,
                'name' => 'Super Modérateur',
            ],
            69 =>  [
                'id' => 69,
                'name' => 'Admin',
            ],
            99 =>  [
                'id' => 99,
                'name' => 'Super Admin',
            ],
            101 =>  [
                'id' => 101,
                'name' => 'Robot',
            ],
            199 =>  [
                'id' => 199,
                'name' => 'Darwiniste qui en veut',
            ],
            500 =>  [
                'id' => 500,
                'name' => 'Demi Dieu',
            ],
            502 =>  [
                'id' => 502,
                'name' => '2/3 de Dieu',
            ],
            1000 =>  [
                'id' => 1000,
                'name' => 'Dieu tout puissant',
            ],
            2000 =>  [
                'id' => 2000,
                'name' => 'Chuck Norris',
            ],
        ],
    ];
}
