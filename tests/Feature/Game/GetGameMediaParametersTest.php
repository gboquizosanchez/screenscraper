<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasGames::downloadGameMedia() */
/** @see \ScreenScraper\Traits\HasGames::downloadGameVideo() */
/** @see \ScreenScraper\Traits\HasGames::downloadGameManual() */
beforeEach(function (): void {
    Http::fake([
        '*' => Http::response('BINARY-CONTENT'),
    ]);
});

it('sends only the game as jeuid when no option is given', function (): void {
    ScreenScraperClient::downloadGameMedia(123);

    expect(lastPath())->toBe('mediaJeu.php')
        ->and(lastQuery())->toBe([
            'jeuid' => '123',
        ]);
});

it('sends every option of the game media endpoint', function (): void {
    ScreenScraperClient::downloadGameMedia(
        gameId: 123,
        media: 'box-2D(us)',
        systemId: 14,
        crc: 'AABBCCDD',
        md5: 'md5-hash',
        sha1: 'sha1-hash',
        mediaFormat: 'png',
        maxWidth: 640,
        maxHeight: 480,
        outputFormat: 'jpg',
    );

    expect(lastQuery())->toBe([
        'jeuid' => '123',
        'systemeid' => '14',
        'media' => 'box-2D(us)',
        'crc' => 'AABBCCDD',
        'md5' => 'md5-hash',
        'sha1' => 'sha1-hash',
        'mediaformat' => 'png',
        'maxwidth' => '640',
        'maxheight' => '480',
        'outputformat' => 'jpg',
    ]);
});

it('sends the options of the game video endpoint', function (): void {
    ScreenScraperClient::downloadGameVideo(
        gameId: 123,
        media: 'video',
        systemId: 14,
        md5: 'md5-hash',
        mediaFormat: 'mp4',
    );

    expect(lastPath())->toBe('mediaVideoJeu.php')
        ->and(lastQuery())->toBe([
            'jeuid' => '123',
            'systemeid' => '14',
            'media' => 'video',
            'md5' => 'md5-hash',
            'mediaformat' => 'mp4',
        ]);
});

it('sends the options of the game manual endpoint', function (): void {
    ScreenScraperClient::downloadGameManual(
        gameId: 123,
        media: 'manuel(eu)',
        systemId: 14,
        crc: 'AABBCCDD',
        sha1: 'sha1-hash',
    );

    expect(lastPath())->toBe('mediaManuelJeu.php')
        ->and(lastQuery())->toBe([
            'jeuid' => '123',
            'systemeid' => '14',
            'media' => 'manuel(eu)',
            'crc' => 'AABBCCDD',
            'sha1' => 'sha1-hash',
        ]);
});

it('keeps the game video and manual calls with only the game id', function (): void {
    ScreenScraperClient::downloadGameVideo(7);
    ScreenScraperClient::downloadGameManual(7);

    expect(lastQuery())->toBe([
        'jeuid' => '7',
    ]);
});
