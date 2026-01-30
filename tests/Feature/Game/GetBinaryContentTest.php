<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasGames::downloadGameMedia() */
/** @see \ScreenScraper\Traits\HasGames::downloadGameVideo() */
/** @see \ScreenScraper\Traits\HasGames::downloadGameManual() */
beforeEach(function (): void {
    Http::fake([
        '*' => Http::response('BINARY-CONTENT', 200, [
            'Content-Type' => 'application/octet-stream',
        ]),
    ]);
});

it('downloads game media as raw content', function (): void {
    $response = ScreenScraperClient::downloadGameMedia(123);

    expect($response)->toBe('BINARY-CONTENT');
});

it('downloads game video as raw content', function (): void {
    $response = ScreenScraperClient::downloadGameVideo(123);

    expect($response)->toBe('BINARY-CONTENT');
});

it('downloads game manual as raw content', function (): void {
    $response = ScreenScraperClient::downloadGameManual(123);

    expect($response)->toBe('BINARY-CONTENT');
});
