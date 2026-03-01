<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasGroups::downloadGroupMedia() */
/** @see \ScreenScraper\Traits\HasGroups::downloadCompanyMedia() */
beforeEach(function (): void {
    Http::fake([
        '*' => Http::response('BINARY-CONTENT', 200, [
            'Content-Type' => 'application/octet-stream',
        ]),
    ]);
});

it('downloads group media as raw content', function (): void {
    $response = ScreenScraperClient::downloadGroupMedia(10, 'logo');

    expect($response)->toBe('BINARY-CONTENT');
});

it('downloads company media as raw content', function (): void {
    $response = ScreenScraperClient::downloadCompanyMedia(3, 'logo');

    expect($response)->toBe('BINARY-CONTENT');
});
