<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\User\ScreenScraperUserData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasUsers::getUser() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the user', function (): void {
    /** @var ScreenScraperUserData $response */
    $response = ScreenScraperClient::getUser();

    expect($response)
        ->toBeInstanceOf(ScreenScraperUserData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the user in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getUser();

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the user in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getUser();

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'user' => [
            'name' => 'Cheke',
            'id' => 1444,
            'level' => 11,
            'contribution' => 0,
            'uploadedSystems' => 0,
            'uploadedInfos' => 12,
            'associatedRoms' => 0,
            'uploadedMedia' => 3,
            'acceptedProposals' => 15,
            'rejectedProposals' => 4,
            'quotaRefused' => 26.67,
            'maxThreads' => 2,
            'maxDownloadSpeed' => 512,
            'requestsToday' => 0,
            'failedRequestsToday' => 0,
            'maxRequestsPerMinute' => 3072,
            'maxRequestsPerDay' => 20_000,
            'maxFailedRequestsPerDay' => 2000,
            'visits' => 102,
            'lastVisitAt' => '2026-01-18 14:53:06',
            'favoriteRegion' => 'us',
        ],
    ];
}

function fakeRequest(): array
{
    return [
        'ssuser' => [
            'id' => 'Cheke',
            'numid' => '1444',
            'niveau' => '11',
            'contribution' => '0',
            'uploadsysteme' => '0',
            'uploadinfos' => '12',
            'romasso' => '0',
            'uploadmedia' => '3',
            'propositionok' => '15',
            'propositionko' => '4',
            'quotarefu' => '26.67',
            'maxthreads' => '2',
            'maxdownloadspeed' => '512',
            'requeststoday' => '0',
            'requestskotoday' => '0',
            'maxrequestspermin' => '3072',
            'maxrequestsperday' => '20000',
            'maxrequestskoperday' => '2000',
            'visites' => '102',
            'datedernierevisite' => '2026-01-18 14:53:06',
            'favregion' => 'us',
        ],
    ];
}
