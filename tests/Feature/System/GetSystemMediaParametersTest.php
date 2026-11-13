<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasSystems::downloadSystemMedia() */
/** @see \ScreenScraper\Traits\HasSystems::downloadSystemVideo() */
beforeEach(function (): void {
    Http::fake([
        '*' => Http::response('BINARY-CONTENT'),
    ]);
});

it('sends the system as systemeid in the system media endpoint', function (): void {
    ScreenScraperClient::downloadSystemMedia(
        systemId: 10,
        media: 'wheel(wor)',
        md5: 'md5-hash',
        sha1: 'sha1-hash',
        mediaFormat: 'png',
        maxWidth: 300,
        maxHeight: 200,
        outputFormat: 'png',
    );

    expect(lastPath())->toBe('mediaSysteme.php')
        ->and(lastQuery())->toBe([
            'systemeid' => '10',
            'media' => 'wheel(wor)',
            'md5' => 'md5-hash',
            'sha1' => 'sha1-hash',
            'mediaformat' => 'png',
            'maxwidth' => '300',
            'maxheight' => '200',
            'outputformat' => 'png',
        ]);
});

it('sends the system as systemeid in the system video endpoint', function (): void {
    ScreenScraperClient::downloadSystemVideo(
        systemId: 10,
        media: 'video',
        crc: 'AABBCCDD',
        md5: 'md5-hash',
        sha1: 'sha1-hash',
        mediaFormat: 'mp4',
    );

    expect(lastPath())->toBe('mediaVideoSysteme.php')
        ->and(lastQuery())->toBe([
            'systemeid' => '10',
            'media' => 'video',
            'crc' => 'AABBCCDD',
            'md5' => 'md5-hash',
            'sha1' => 'sha1-hash',
            'mediaformat' => 'mp4',
        ]);
});
