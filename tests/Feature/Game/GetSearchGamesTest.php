<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\Game\GameSearchResultsData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasGames::searchGames() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the search of games', function (): void {
    /** @var GameSearchResultsData $response */
    $response = ScreenScraperClient::searchGames(
        systemId: 1,
        search: 'sonic',
    );

    expect($response)
        ->toBeInstanceOf(GameSearchResultsData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the search of games in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::searchGames(
        systemId: 1,
        search: 'sonic',
    );

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the search of games in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::searchGames(
        systemId: 1,
        search: 'sonic',
    );

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'games' => [
            [
                'id' => 1,
                'names' => [
                    [
                        'region' => 'jp',
                        'title' => 'Sonic The Hedgehog 2',
                    ],
                    [
                        'region' => 'eu',
                        'title' => 'Sonic The Hedgehog 2',
                    ],
                ],
                'system' => [
                    'id' => 1,
                    'name' => 'Megadrive',
                ],
                'editor' => [
                    'id' => 3,
                    'name' => 'SEGA',
                ],
                'developer' => [
                    'id' => 3,
                    'name' => 'SEGA',
                ],
                'playerCount' => [
                    'amount' => '1-2',
                ],
                'extra' => [
                    'notes' => '17',
                ],
                'topStaff' => null,
                'rotation' => false,
                'controls' => '6',
                'colors' => '0',
                'synopsis' => [
                    [
                        'language' => 'es',
                        'description' => 'El malvado Dr. Robotnik quiere conquistar el mundo. Para hacer eso, encarcela y transforma a todos los animales en robots llamados \'Badniks\'. De esta forma pueden construir su poderosa arma, el Death Egg. Solo Sonic the Hedgehog, y su nuevo socio Miles \'Tails\' Prower, pueden evitar que Robotnik y su ejército de Badniks se apoderen del mundo. Sonic the Hedgehog 2 es un juego de plataformas de desplazamiento lateral basado en la velocidad y la secuela de Sonic the Hedgehog. Al igual que el original, los jugadores corren a través de mundos diferentes llamados &quot;Zonas&quot;, cada uno con su propio tema específico. Hay dos Actos en casi todas las 10 Zonas, y al final de la última Ley de cada Zona hay una máquina que controla Robotnik, que debes vencer para avanzar. Sonic and Tails pueden recolectar anillos que están dispersos en todos los niveles. Al igual que con la mayoría de los juegos de plataformas, cuando el jugador colecciona 100 anillos, ganan una vida extra. Sin embargo, los anillos también actúan como protección: si Sonic se lastima cuando lleva anillos, se dispersan por todas partes y es invencible por un momento. Si lo golpean nuevamente cuando no tiene anillos, perderá una vida.',
                    ],
                ],
                'classifications' => [
                    [
                        'type' => 'PEGI',
                        'classification' => '3',
                    ],
                ],
                'dates' => [
                    [
                        'region' => 'eu',
                        'release' => '1992-11-24',
                    ],
                ],
                'genres' => [
                    [
                        'id' => 7,
                        'name' => '0101',
                        'principal' => true,
                        'names' => [
                            [
                                'language' => 'es',
                                'name' => 'Plataforma',
                            ],
                        ],
                    ],
                ],
                'modes' => [
                    [
                        'id' => 3602,
                        'name' => '',
                        'principal' => false,
                        'names' => [
                            [
                                'language' => 'es',
                                'name' => 'Jugador individual con 2 mandos',
                            ],
                        ],
                    ],
                ],
                'families' => [
                    [
                        'id' => 4048,
                        'name' => '',
                        'principal' => false,
                        'names' => [
                            [
                                'language' => 'fr',
                                'name' => 'Sonic',
                            ],
                        ],
                    ],
                ],
                'medias' => [
                    [
                        'type' => 'sstitle',
                        'parent' => 'jeu',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaJeu.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&systemeid=1&jeuid=3&media=sstitle(wor)',
                        'region' => 'wor',
                        'crc' => '2ffb473e',
                        'md5' => '3ef435cc17b42933e5edb398a0b4f6c1',
                        'sha1' => '9f84fd6bf389b0234270ea4624644d3edd0a3827',
                        'size' => '7784',
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
        'jeux' => [
            [
                'id' => 1,
                'noms' => [
                    [
                        'region' => 'jp',
                        'text' => 'Sonic The Hedgehog 2',
                    ],
                    [
                        'region' => 'eu',
                        'text' => 'Sonic The Hedgehog 2',
                    ],
                ],
                'systeme' => [
                    'id' => '1',
                    'text' => 'Megadrive',
                ],
                'editeur' => [
                    'id' => '3',
                    'text' => 'SEGA',
                ],
                'developpeur' => [
                    'id' => '3',
                    'text' => 'SEGA',
                ],
                'joueurs' => [
                    'text' => '1-2',
                ],
                'note' => [
                    'text' => '17',
                ],
                'topstaff' => null,
                'rotation' => '0',
                'controles' => '6',
                'couleurs' => '0',
                'synopsis' => [
                    [
                        'langue' => 'es',
                        'text' => 'El malvado Dr. Robotnik quiere conquistar el mundo. Para hacer eso, encarcela y transforma a todos los animales en robots llamados \'Badniks\'. De esta forma pueden construir su poderosa arma, el Death Egg. Solo Sonic the Hedgehog, y su nuevo socio Miles \'Tails\' Prower, pueden evitar que Robotnik y su ejército de Badniks se apoderen del mundo. Sonic the Hedgehog 2 es un juego de plataformas de desplazamiento lateral basado en la velocidad y la secuela de Sonic the Hedgehog. Al igual que el original, los jugadores corren a través de mundos diferentes llamados &quot;Zonas&quot;, cada uno con su propio tema específico. Hay dos Actos en casi todas las 10 Zonas, y al final de la última Ley de cada Zona hay una máquina que controla Robotnik, que debes vencer para avanzar. Sonic and Tails pueden recolectar anillos que están dispersos en todos los niveles. Al igual que con la mayoría de los juegos de plataformas, cuando el jugador colecciona 100 anillos, ganan una vida extra. Sin embargo, los anillos también actúan como protección: si Sonic se lastima cuando lleva anillos, se dispersan por todas partes y es invencible por un momento. Si lo golpean nuevamente cuando no tiene anillos, perderá una vida.',
                    ],
                ],
                'classifications' => [
                    [
                        'type' => 'PEGI',
                        'text' => '3',
                    ],
                ],
                'dates' => [
                    [
                        'region' => 'eu',
                        'text' => '1992-11-24',
                    ],
                ],
                'genres' => [
                    [
                        'id' => '7',
                        'nomcourt' => '0101',
                        'principale' => '1',
                        'parentid' => '0',
                        'noms' => [
                            [
                                'langue' => 'es',
                                'text' => 'Plataforma',
                            ],
                        ],
                    ],
                ],
                'modes' => [
                    [
                        'id' => '3602',
                        'nomcourt' => '',
                        'principale' => '0',
                        'parentid' => '0',
                        'noms' => [
                            [
                                'langue' => 'es',
                                'text' => 'Jugador individual con 2 mandos',
                            ],
                        ],
                    ],
                ],
                'familles' => [
                    [
                        'id' => '4048',
                        'nomcourt' => '',
                        'principale' => '0',
                        'parentid' => '0',
                        'noms' => [
                            [
                                'langue' => 'fr',
                                'text' => 'Sonic',
                            ],
                        ],
                    ],
                ],
                'medias' => [
                    [
                        'type' => 'sstitle',
                        'parent' => 'jeu',
                        'url' => 'https://neoclone.screenscraper.fr/api2/mediaJeu.php?devid=xxx&devpassword=yyy&softname=zzz&ssid=test&sspassword=test&systemeid=1&jeuid=3&media=sstitle(wor)',
                        'region' => 'wor',
                        'crc' => '2ffb473e',
                        'md5' => '3ef435cc17b42933e5edb398a0b4f6c1',
                        'sha1' => '9f84fd6bf389b0234270ea4624644d3edd0a3827',
                        'size' => '7784',
                        'format' => 'png',
                    ],
                ],
            ],
        ],
    ];
}
