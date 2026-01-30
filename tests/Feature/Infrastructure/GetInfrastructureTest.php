<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\Infrastructure\InfrastructureData;
use ScreenScraper\ScreenScraperClient;

/** @see \ScreenScraper\Traits\HasInfrastructure::getInfrastructure() */
beforeEach(function (): void {
    Http::fake([
        '*' => fakeRequest(),
    ]);
});

it('retrieves all information about the infrastructure', function (): void {
    /** @var InfrastructureData $response */
    $response = ScreenScraperClient::getInfrastructure();

    expect($response)
        ->toBeInstanceOf(InfrastructureData::class)
        ->and($response->transformed())
        ->toBe(expectedResponse());
});

it('retrieves all information about the infrastructure in array mode', function (): void {
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getInfrastructure();

    expect($response)
        ->toBe(expectedResponse());
});

it('retrieves all information about the infrastructure in array mode with RAW Properties', function (): void {
    $this->app['config']->set('screenscraper.mapping.raw_properties', true);
    $this->app['config']->set('screenscraper.mapping.dto', false);

    $response = ScreenScraperClient::getInfrastructure();

    expect($response)
        ->toBe(fakeRequest());
});

function expectedResponse(): array
{
    return [
        'servers' => [
            'cpu1' => '0',
            'cpu2' => '0',
            'cpu3' => '0',
            'cpu4' => '0',
            'threadsMin' => 3273,
            'nbScrapers' => 1164,
            'apiAccess' => 21307735,
            'closeForNoMember' => false,
            'closeForLeecher' => false,
            'maxThreadForNonMember' => 256,
            'threadForNonMember' => 134,
            'maxThreadForMember' => 4096,
            'threadForMember' => 573,
        ],
    ];
}

function fakeRequest(): array
{
    return [
        'serveurs' => [
            'cpu1' => '0',
            'cpu2' => '0',
            'cpu3' => '0',
            'cpu4' => '0',
            'threadsmin' => 3273,
            'nbscrapeurs' => 1164,
            'apiacces' => 21307735,
            'closefornomember' => '0',
            'closeforleecher' => '0',
            'maxthreadfornonmember' => 256,
            'threadfornonmember' => 134,
            'maxthreadformember' => 4096,
            'threadformember' => 573,
        ],
    ];
}
