<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\AuthData;
use ScreenScraper\Exceptions\ForbiddenException;
use ScreenScraper\Models\ScreenScraper;

it('should be the config in file', function (): void {
    expect(config('screenscraper'))
        ->toBe([
            'base_url' => 'https://api.screenscraper.fr/api2/',
            'credentials' => [
                'ssid' => null,
                'sspassword' => null,
                'dev_id' => 'xxx',
                'dev_password' => 'yyy',
                'softname' => 'ScreenScraper API Client for Laravel',
                'output' => 'json',
            ],
            'mapping' => [
                'dto' => true,
                'raw_properties' => false,
            ],
        ])
        ->toBeArray();
});

it('should be forbidden with wrong developer credentials', function (): void {
    Http::fake([
        '*' => Http::response('Erreur de login : Vérifier vos identifiants développeur !', 403),
    ]);

    $client = new ScreenScraper(new AuthData(
        devId: 'devId',
        devPassword: 'devPassword',
        softwareName: 'laravel',
        output: 'json',
    ));

    $client->getInfrastructure();
})->throws(ForbiddenException::class);
