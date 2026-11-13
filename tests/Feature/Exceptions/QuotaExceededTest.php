<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\AuthData;
use ScreenScraper\Enums\QuotaType;
use ScreenScraper\Exceptions\GenericException;
use ScreenScraper\Exceptions\QuotaExceededException;
use ScreenScraper\Exceptions\ScreenScraperException;
use ScreenScraper\Models\ScreenScraper;

/** @see \ScreenScraper\Traits\MakesHttpRequests::handleRequestError() */
function quotaClient(): ScreenScraper
{
    return new ScreenScraper(new AuthData(
        devId: 'dev-id',
        devPassword: 'dev-secret',
        softwareName: 'laravel',
        output: 'json',
        id: 'user-id',
        password: 'user-secret',
    ));
}

dataset('quota statuses', [
    'threads' => [429, QuotaType::Threads, 'The maximum threads is already used'],
    'daily quota' => [430, QuotaType::DailyQuota, 'Votre quota de scrape est dépassé pour aujourd\'hui !'],
    'daily failures' => [431, QuotaType::DailyFailures, 'Faite du tri dans vos fichiers roms et repassez demain !'],
]);

it('throws a quota exception from call', function (int $status, QuotaType $type, string $body): void {
    Http::fake([
        '*' => Http::response($body, $status),
    ]);

    try {
        quotaClient()->call('jeuInfos.php');
    } catch (QuotaExceededException $caught) {
        expect($caught->type)->toBe($type)
            ->and($caught->getCode())->toBe($status)
            ->and($caught->getMessage())->toBe($body)
            ->and($caught)->toBeInstanceOf(ScreenScraperException::class)
            ->and($caught)->not->toBeInstanceOf(GenericException::class);

        return;
    }

    $this->fail('No exception thrown.');
})->with('quota statuses');

it('throws a quota exception from callRaw', function (int $status, QuotaType $type, string $body): void {
    Http::fake([
        '*' => Http::response($body, $status),
    ]);

    try {
        quotaClient()->callRaw('mediaJeu.php');
    } catch (QuotaExceededException $caught) {
        expect($caught->type)->toBe($type);

        return;
    }

    $this->fail('No exception thrown.');
})->with('quota statuses');

it('does not carry the url or the credentials in the message or the trace', function (): void {
    Http::fake([
        '*' => Http::response('Votre quota de scrape est dépassé pour aujourd\'hui !', 430),
    ]);

    try {
        quotaClient()->call('jeuInfos.php', ['md5' => 'md5-hash']);
    } catch (QuotaExceededException $caught) {
        $dump = $caught->getMessage() . $caught->getTraceAsString();

        expect($dump)
            ->not->toContain('dev-secret')
            ->not->toContain('user-secret')
            ->not->toContain('md5-hash')
            ->not->toContain('api.screenscraper.fr');

        return;
    }

    $this->fail('No exception thrown.');
});
