<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasGroups::downloadGroupMedia() */
/** @see \ScreenScraper\Traits\HasGroups::downloadCompanyMedia() */
beforeEach(function (): void {
    Http::fake([
        '*' => Http::response('BINARY-CONTENT'),
    ]);
});

it('sends the group as groupid with every option', function (): void {
    ScreenScraperClient::downloadGroupMedia(
        groupId: 7,
        media: 'logo-monochrome',
        crc: 'AABBCCDD',
        md5: 'md5-hash',
        sha1: 'sha1-hash',
        mediaFormat: 'png',
        maxWidth: 100,
        maxHeight: 50,
        outputFormat: 'png',
    );

    expect(lastPath())->toBe('mediaGroup.php')
        ->and(lastQuery())->toBe([
            'groupid' => '7',
            'media' => 'logo-monochrome',
            'crc' => 'AABBCCDD',
            'md5' => 'md5-hash',
            'sha1' => 'sha1-hash',
            'mediaformat' => 'png',
            'maxwidth' => '100',
            'maxheight' => '50',
            'outputformat' => 'png',
        ]);
});

it('sends the company as companyid', function (): void {
    ScreenScraperClient::downloadCompanyMedia(3, 'logo-monochrome');

    expect(lastPath())->toBe('mediaCompagnie.php')
        ->and(lastQuery())->toBe([
            'companyid' => '3',
            'media' => 'logo-monochrome',
        ]);
});
