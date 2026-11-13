<?php

declare(strict_types=1);

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use ScreenScraper\Exceptions\QuotaExceededException;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasBots::sendGameRating() */
/** @see \ScreenScraper\Traits\HasBots::sendContribution() */
beforeEach(function (): void {
    Http::fake([
        '*' => Http::response([], 200),
    ]);
});

it('sends a game rating without throwing', function (): void {
    expect(fn() => ScreenScraperClient::sendGameRating(
        gameId: 1,
        rating: 18,
        romName: 'sonic2.md',
        crc: '2ffb473e',
    ))->not->toThrow(Throwable::class);
});

it('sends a contribution without throwing', function (): void {
    expect(fn() => ScreenScraperClient::sendContribution(
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

it('sends only the game and the rating to botNote', function (): void {
    ScreenScraperClient::sendGameRating(
        gameId: 1,
        rating: 18,
    );

    expect(lastPath())->toBe('botNote.php')
        ->and(lastQuery())->toBe([
            'gameid' => '1',
            'note' => '18',
        ]);
});

it('keeps a rating of zero', function (): void {
    ScreenScraperClient::sendGameRating(
        gameId: 1,
        rating: 0,
    );

    expect(lastQuery())->toBe([
        'gameid' => '1',
        'note' => '0',
    ]);
});

it('sends a contribution as a multipart post', function (): void {
    ScreenScraperClient::sendContribution(
        gameId: 1,
        region: 'wor',
        mediaType: 'sstitle',
        url: 'https://example.com/media.png',
        source: 'https://example.com',
        supportNumber: 2,
        version: 'v2',
    );

    Http::assertSent(function (Request $request): bool {
        expect($request->method())->toBe('POST')
            ->and($request->isMultipart())->toBeTrue()
            ->and(basename((string) parse_url($request->url(), PHP_URL_PATH)))->toBe('botProposition.php')
            ->and(array_map('strval', array_column($request->data(), 'contents', 'name')))->toBe([
                'gameid' => '1',
                'modiftypemedia' => 'sstitle',
                'modiftyperegion' => 'wor',
                'modifmediafileurl' => 'https://example.com/media.png',
                'modifmediasource' => 'https://example.com',
                'modiftypenumsupport' => '2',
                'modiftypeversion' => 'v2',
            ]);

        return true;
    });
});

it('throws a quota exception when the post is refused', function (): void {
    Http::swap(new Factory());
    Http::fake([
        '*' => Http::response('Votre quota de scrape est dépassé pour aujourd\'hui !', 430),
    ]);

    expect(fn() => ScreenScraperClient::sendContribution(1, 'wor', 'sstitle', 'https://example.com/a.png'))
        ->toThrow(QuotaExceededException::class);
});
