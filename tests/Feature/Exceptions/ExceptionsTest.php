<?php

declare(strict_types=1);

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use ScreenScraper\Data\AuthData;
use ScreenScraper\Exceptions\BadRequestException;
use ScreenScraper\Exceptions\ForbiddenException;
use ScreenScraper\Exceptions\GenericException;
use ScreenScraper\Exceptions\NotFoundException;
use ScreenScraper\Exceptions\ScreenScraperException;
use ScreenScraper\Exceptions\UnauthorizedException;
use ScreenScraper\Models\ScreenScraper;

/** @see \ScreenScraper\Traits\MakesHttpRequests */
function secretClient(): ScreenScraper
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

it('can catch every package exception as a throwable', function (string $exception): void {
    expect(is_subclass_of($exception, Throwable::class))->toBeTrue()
        ->and(is_subclass_of($exception, ScreenScraperException::class))->toBeTrue();
})->with([
    ForbiddenException::class,
    GenericException::class,
    NotFoundException::class,
    UnauthorizedException::class,
]);

it('throws a catchable ScreenScraperException from call', function (int $status, string $exception): void {
    Http::fake([
        '*' => Http::response('error', $status),
    ]);

    try {
        secretClient()->call('jeuInfos.php');
    } catch (ScreenScraperException $caught) {
        expect($caught)->toBeInstanceOf($exception);

        return;
    }

    $this->fail('No exception thrown.');
})->with([
    [401, UnauthorizedException::class],
    [403, ForbiddenException::class],
    [404, NotFoundException::class],
    [500, GenericException::class],
]);

it('throws a catchable ScreenScraperException from callRaw', function (): void {
    Http::fake([
        '*' => Http::response('error', 404),
    ]);

    secretClient()->callRaw('mediaJeu.php');
})->throws(NotFoundException::class);

it('keeps the http status as code and the answer as message', function (int $status, string $body): void {
    Http::fake([
        '*' => Http::response($body, $status),
    ]);

    try {
        secretClient()->call('jeuInfos.php');
    } catch (ScreenScraperException $caught) {
        expect($caught->getCode())->toBe($status)
            ->and($caught->getMessage())->toBe($body);

        return;
    }

    $this->fail('No exception thrown.');
})->with([
    [400, 'Il manque des champs obligatoires dans l\'url'],
    [404, 'Erreur : Jeu non trouvée !'],
    [429, 'The maximum threads is already used'],
    [430, 'Votre quota de scrape est dépassé pour aujourd\'hui !'],
]);

it('trims a long answer and names the status when the answer is empty', function (): void {
    Http::fake([
        '*' => Http::sequence()
            ->push(str_repeat('a', 500), 500)
            ->push('', 503),
    ]);

    try {
        secretClient()->call('jeuInfos.php');
    } catch (ScreenScraperException $caught) {
        expect(mb_strlen($caught->getMessage()))->toBe(200);
    }

    try {
        secretClient()->call('jeuInfos.php');
    } catch (ScreenScraperException $caught) {
        expect($caught->getMessage())->toBe('HTTP status 503');
    }
});

it('does not leak the url or the credentials when the connection fails', function (string $method): void {
    Http::fake(function (): void {
        throw new ConnectionException(
            'cURL error 6 for https://api.screenscraper.fr/api2/jeuInfos.php?devpassword=dev-secret&sspassword=user-secret',
        );
    });

    try {
        secretClient()->{$method}('jeuInfos.php');
    } catch (ConnectionException $caught) {
        expect($caught->getMessage())
            ->not->toContain('dev-secret')
            ->not->toContain('user-secret')
            ->not->toContain('api.screenscraper.fr')
            ->and($caught->getPrevious())->toBeNull();

        return;
    }

    $this->fail('No exception thrown.');
})->with([
    'call',
    'callRaw',
]);

it('throws a bad request exception for status 400', function (): void {
    Http::fake([
        '*' => Http::response('Il manque des champs obligatoires dans l\'url', 400),
    ]);

    try {
        secretClient()->call('jeuInfos.php');
    } catch (BadRequestException $caught) {
        expect($caught->getCode())->toBe(400)
            ->and($caught)->toBeInstanceOf(ScreenScraperException::class);

        return;
    }

    $this->fail('No exception thrown.');
});

it('redacts urls and credentials echoed by the answer', function (): void {
    Http::fake([
        '*' => Http::response('Error at https://api.screenscraper.fr/api2/x.php?devid=dev-id&devpassword=dev-secret and user-secret, ssid=user-id', 403),
    ]);

    try {
        secretClient()->call('jeuInfos.php');
    } catch (ForbiddenException $caught) {
        expect($caught->getMessage())
            ->not->toContain('dev-secret')
            ->not->toContain('user-secret')
            ->not->toContain('user-id')
            ->not->toContain('api.screenscraper.fr')
            ->toContain('[redacted]');

        return;
    }

    $this->fail('No exception thrown.');
});

it('keeps the credentials out of the arguments of the stack trace', function (): void {
    Http::fake([
        '*' => Http::response('error', 404),
    ]);

    try {
        secretClient()->call('jeuInfos.php');
    } catch (NotFoundException $caught) {
        $packageFrames = array_filter(
            $caught->getTrace(),
            static fn(array $frame): bool => str_starts_with($frame['class'] ?? '', 'ScreenScraper\\'),
        );

        expect($packageFrames)->not->toBeEmpty();

        $trace = print_r($packageFrames, true);

        expect($trace)
            ->not->toContain('dev-secret')
            ->not->toContain('user-secret');

        return;
    }

    $this->fail('No exception thrown.');
});

it('hides the passwords when the client is dumped', function (): void {
    $dump = print_r(secretClient(), true);

    expect($dump)
        ->not->toContain('dev-secret')
        ->not->toContain('user-secret')
        ->toContain('[redacted]');
});
