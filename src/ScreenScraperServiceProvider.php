<?php

declare(strict_types=1);

namespace ScreenScraper;

use Illuminate\Support\ServiceProvider;
use Override;
use ScreenScraper\Data\AuthData;
use ScreenScraper\Models\ScreenScraper;

final class ScreenScraperServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $configFile = 'screenscraper.php';

            $this->publishes([
                __DIR__ . "/../config/{$configFile}" => config_path($configFile),
            ]);
        }
    }

    #[Override]
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/screenscraper.php',
            'screenscraper',
        );

        $this->app->bind(
            'screenscraper',
            static function () {
                /** @var array<string, string> $config */
                $config = config('screenscraper.credentials');

                $authorization = new AuthData(
                    $config['dev_id'],
                    $config['dev_password'],
                    $config['softname'],
                    $config['output'],
                    $config['ssid'],
                    $config['sspassword'],
                );

                return new ScreenScraper($authorization);
            },
        );
    }
}
