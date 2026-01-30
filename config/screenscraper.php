<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | ScreenScraper API Base URL
    |--------------------------------------------------------------------------
    |
    | This value is the base URL of the ScreenScraper API. This value is
    | used to make requests to the API.
    |
    */
    'base_url' => env('SCREENSCRAPER_BASE_URL', 'https://api.screenscraper.fr/api2/'),

    'credentials' => [
        'ssid' => env('SCREENSCRAPER_USERNAME'),
        'sspassword' => env('SCREENSCRAPER_PASSWORD'),
        'dev_id' => env('SCREENSCRAPER_DEV_ID', 'xxx'),
        'dev_password' => env('SCREENSCRAPER_DEV_PASSWORD', 'yyy'),
        'softname' => env('SCREENSCRAPER_SOFTNAME', 'ScreenScraper API Client for Laravel'),
        'output' => env('SCREENSCRAPER_OUTPUT', 'json'),
    ],
    'mapping' => [
        /*
        |--------------------------------------------------------------------------
        | Enable DTO Mapping
        |--------------------------------------------------------------------------
        |
        | This value determines if the package should map the DTOs to the
        | ScreenScraper API response. If this value is set to true, the
        | package will map the DTOs to the response. If this value is set to
        | false, the package will return the response as an array.
        |
        */
        'dto' => env('SCREENSCRAPER_DTO_MAPPING', true),

        /*
        |--------------------------------------------------------------------------
        | Enable Raw Properties
        |--------------------------------------------------------------------------
        | This value determines if the package should return the raw properties
        | when DTO mapping is disabled. If this value is set to true, the package
        | will return the raw properties instead of normalized.
        |
        | This value is only used when DTO mapping is disabled.
        */
        'raw_properties' => env('SCREENSCRAPER_RAW_PROPERTIES', false),
    ],
];
