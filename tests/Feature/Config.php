<?php

declare(strict_types=1);

use ScreenScraper\Data\AuthData;
use ScreenScraper\Exceptions\ForbiddenException;
use ScreenScraper\Exceptions\UnauthorizedException;
use ScreenScraper\Models\ScreenScraper;

it('should be the config in file', function (): void {
    expect(config('screenscraper'))
        ->toBe([
            'base_url' => 'https://api.screenscraper.fr/api2/',
            'credentials' => [
                'ssid' => null,
                'sspassword' => null,
                'dev_id' => null,
                'dev_password' => null,
                'softname' => 'laravel',
                'output' => 'json',
            ],
            'mapping' => [
                'dto' => true,
                'raw_properties' => false,
            ],
        ])
        ->toBeArray();
});

it('should be unauthorized', function (): void {
    $client = new ScreenScraper(new AuthData(
        devId: 'devId',
        devPassword: 'devPassword',
        softname: 'laravel',
        output: 'json',
    ));

    $client->getInfrastructure();
})->throws(ForbiddenException::class);
