<?php

declare(strict_types=1);

use Illuminate\Http\Client\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use ScreenScraper\Tests\TestCase;

pest()->extends(TestCase::class);

/**
 * @return array<string, string>
 */
function lastQuery(): array
{
    $query = [];

    Http::assertSent(function (Request $request) use (&$query): bool {
        parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

        return true;
    });

    return Arr::except($query, [
        'devid',
        'devpassword',
        'softname',
        'output',
        'ssid',
        'sspassword',
    ]);
}

function lastPath(): string
{
    $path = '';

    Http::assertSent(function (Request $request) use (&$path): bool {
        $path = basename((string) parse_url($request->url(), PHP_URL_PATH));

        return true;
    });

    return $path;
}
