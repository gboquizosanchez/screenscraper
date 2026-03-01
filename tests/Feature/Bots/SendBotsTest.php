<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasBots::sendGameRating() */
/** @see \ScreenScraper\Traits\HasBots::sendContribution() */
beforeEach(function (): void {
    Http::fake([
        '*' => Http::response([], 200),
    ]);
});

it('sends a game rating without throwing', function (): void {
    expect(fn () => ScreenScraperClient::sendGameRating(
        gameId: 1,
        rating: 18,
        romName: 'sonic2.md',
        crc: '2ffb473e',
    ))->not->toThrow(Throwable::class);
});

it('sends a contribution without throwing', function (): void {
    expect(fn () => ScreenScraperClient::sendContribution(
        gameId: 1,
        region: 'wor',
        mediaType: 'sstitle',
        url: 'https://example.com/media.png',
        crc: '2ffb473e',
        md5: '3ef435cc17b42933e5edb398a0b4f6c1',
        sha1: '9f84fd6bf389b0234270ea4624644d3edd0a3827',
        size: 7784,
        format: 'png',
    ))->not->toThrow(Throwable::class);
});
