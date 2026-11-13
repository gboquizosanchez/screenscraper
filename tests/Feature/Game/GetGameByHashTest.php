<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasGames::getGame() */
beforeEach(function (): void {
    Http::fake([
        '*' => Http::response([
            'response' => [
                'jeu' => [],
            ],
        ]),
    ]);

    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
});

it('keeps sending only the id when an integer identifier is given alone', function (): void {
    ScreenScraperClient::getGame(5);

    expect(lastPath())->toBe('jeuInfos.php')
        ->and(lastQuery())->toBe([
            'gameid' => '5',
        ]);
});

it('identifies a game by hash with an integer identifier', function (): void {
    ScreenScraperClient::getGame(
        identifier: 0,
        crc: 'AABBCCDD',
        md5: 'md5-hash',
        sha1: 'sha1-hash',
        systemId: 14,
        romType: 'rom',
        romName: 'Game (USA).z64',
        romSize: 1024,
        serialNum: 'NUS-NABE-USA',
    );

    expect(lastPath())->toBe('jeuInfos.php')
        ->and(lastQuery())->toBe([
            'crc' => 'AABBCCDD',
            'md5' => 'md5-hash',
            'sha1' => 'sha1-hash',
            'systemeid' => '14',
            'romtype' => 'rom',
            'romnom' => 'Game (USA).z64',
            'romtaille' => '1024',
            'serialnum' => 'NUS-NABE-USA',
        ]);
});

it('combines the game id with the hash', function (): void {
    ScreenScraperClient::getGame(
        identifier: 5,
        md5: 'md5-hash',
        systemId: 14,
    );

    expect(lastQuery())->toBe([
        'gameid' => '5',
        'md5' => 'md5-hash',
        'systemeid' => '14',
    ]);
});

it('keeps searching with the array identifier', function (): void {
    ScreenScraperClient::getGame(
        identifier: ['recherche' => 'sonic'],
        systemId: 1,
    );

    expect(lastPath())->toBe('jeuRecherche.php')
        ->and(lastQuery())->toBe([
            'recherche' => 'sonic',
            'systemeid' => '1',
        ]);
});
