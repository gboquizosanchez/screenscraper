<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasSystems::downloadSystemMedia() */
/** @see \ScreenScraper\Traits\HasSystems::downloadSystemVideo() */
beforeEach(function (): void {
    Http::fake([
        '*' => Http::response('BINARY-CONTENT', 200, [
            'Content-Type' => 'application/octet-stream',
        ]),
    ]);
});

it('downloads system media as raw content', function (): void {
    $response = ScreenScraperClient::downloadSystemMedia(10, 99);

    expect($response)->toBe('BINARY-CONTENT');
});

it('downloads system video as raw content', function (): void {
    $response = ScreenScraperClient::downloadSystemVideo(10, 99);

    expect($response)->toBe('BINARY-CONTENT');
});
