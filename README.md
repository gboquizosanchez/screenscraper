<div align="center">

<img src="https://www.screenscraper.fr/images/logo-512x512.png" width="100" alt="ScreenScraper">

# `gboquizosanchez/screenscraper`

**ScreenScraper.fr API client for Laravel**

[![Latest Stable Version](https://img.shields.io/packagist/v/gboquizosanchez/screenscraper.svg)](https://packagist.org/packages/gboquizosanchez/screenscraper)
[![Total Downloads](https://img.shields.io/packagist/dt/gboquizosanchez/screenscraper.svg)](https://packagist.org/packages/gboquizosanchez/screenscraper)
[![PHP](https://img.shields.io/badge/PHP-%5E8.3-777BB4?logo=php&logoColor=white)](https://packagist.org/packages/gboquizosanchez/screenscraper)
[![Laravel](https://img.shields.io/badge/Laravel-11%20%7C%2012-FF2D20?logo=laravel&logoColor=white)](https://packagist.org/packages/gboquizosanchez/screenscraper)
[![License: MIT](https://img.shields.io/badge/License-MIT-22C55E.svg)](LICENSE.md)

---

*Fetch game metadata, media, and platform data from ScreenScraper.fr directly in your Laravel app.*

</div>

---

## Overview

A Laravel package that wraps the full [ScreenScraper API](https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0), giving you access to game info, artwork, ratings, and more — with optional DTO mapping via [spatie/laravel-data](https://github.com/spatie/laravel-data).

> **Note:** You need a ScreenScraper account and developer credentials to use this package. Register [here](https://www.screenscraper.fr/membreinscription.php) and request developer access [here](https://www.screenscraper.fr/forumsujets.php?frub=12&numpage=0).

---

## 📦 Installation

```bash
composer require gboquizosanchez/screenscraper
```

Add your credentials to `.env`:

```env
SCREENSCRAPER_BASE_URL=https://api.screenscraper.fr/api2/
SCREENSCRAPER_OUTPUT=json
SCREENSCRAPER_USERNAME=your_username
SCREENSCRAPER_PASSWORD=your_password
SCREENSCRAPER_DEV_ID=your_dev_id
SCREENSCRAPER_DEV_PASSWORD=your_dev_password
SCREENSCRAPER_SOFTNAME="ScreenScraper API Client for Laravel"
SCREENSCRAPER_DTO_MAPPING=true
SCREENSCRAPER_RAW_PROPERTIES=false
```

Optionally, publish the configuration file:

```bash
php artisan vendor:publish --provider="ScreenScraper\ScreenScraperServiceProvider"
```

---

## 🚀 Usage

### Via facade

The facade reads credentials directly from your `.env`:

```php
use ScreenScraper\ScreenScraperClient;

ScreenScraperClient::getGame(identifier: 1);
```

### Via the client directly

Useful when working with multiple accounts or custom credentials:

```php
use ScreenScraper\Data\AuthData;
use ScreenScraper\Models\ScreenScraper;

$auth = new AuthData(
    devId: 'your_dev_id',
    devPassword: 'your_dev_password',
    softwareName: 'Your App Name',
    output: 'json',
    id: 'your_username',
    password: 'your_password',
);

$client = new ScreenScraper($auth);
$client->getGame(identifier: 1);
```

The facade resolves the same client with the credentials of `config('screenscraper.credentials')` through `app('screenscraper')`.

### Low-level calls

Any endpoint can be called directly. `call` decodes a JSON endpoint and `callRaw` returns the raw body (media, videos, PDFs). With `$filtered = true` (the default) empty values such as `null`, `0` or `''` are dropped from the parameters:

```php
$client->call('jeuInfos.php', ['systemeid' => 14, 'md5' => '...']);
$client->callRaw('mediaJeu.php', ['systemeid' => 14, 'jeuid' => 3, 'media' => 'ss']);
```

---

## 🗺️ Response mapping

By default, the package maps responses to typed DTOs. You can switch to raw responses via `.env`:

```env
# Default — typed DTOs via spatie/laravel-data
SCREENSCRAPER_DTO_MAPPING=true
SCREENSCRAPER_RAW_PROPERTIES=false

# Arrays with normalized (English) keys
SCREENSCRAPER_DTO_MAPPING=false
SCREENSCRAPER_RAW_PROPERTIES=false

# Raw responses, exactly as the API sends them
SCREENSCRAPER_DTO_MAPPING=false
SCREENSCRAPER_RAW_PROPERTIES=true
```

> `RAW` mapping only works when `SCREENSCRAPER_DTO_MAPPING` is set to `false`.

Every method that returns data is typed `Dto|array<string, mixed>` and is documented with its return type.

---

## 📚 Available methods

This package covers all endpoints from the [ScreenScraper API](https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0). See [`ScreenScraperClient`](src/ScreenScraperClient.php) for the full method list.

| Area | Method | Endpoint | Returns |
| --- | --- | --- | --- |
| Infrastructure | `getInfrastructure()` | `ssinfraInfos` | `InfrastructureData` |
| User | `getUser()` | `ssuserInfos` | `ScreenScraperUserData` |
| User | `getUserLevels()` | `userlevelsListe` | `UserLevelsData` |
| User | `getPlayerCounts()` | `nbJoueursListe` | `PlayerCountsData` |
| Lists | `getSupportTypes()` | `supportTypesListe` | `SupportTypesData` |
| Lists | `getRomTypes()` | `romTypesListe` | `RomTypesData` |
| Lists | `getLanguages()` | `languesListe` | `LanguagesData` |
| Lists | `getRegions()` | `regionsListe` | `RegionsData` |
| Lists | `getGenres()` | `genresListe` | `GenresData` |
| Lists | `getFamilies()` | `famillesListe` | `FamiliesData` |
| Lists | `getClassifications()` | `classificationsListe` | `ClassificationsData` |
| Systems | `getSystems()` | `systemesListe` | `SystemsData` |
| Systems | `getSystemMediaTypes()` | `mediasSystemeListe` | `SystemMediaTypesData` |
| Systems | `downloadSystemMedia()` | `mediaSysteme` | raw `string` |
| Systems | `downloadSystemVideo()` | `mediaVideoSysteme` | raw `string` |
| Games | `searchGames()` | `jeuRecherche` | `GameSearchResultsData` |
| Games | `getGame()` | `jeuInfos` / `jeuRecherche` | `GamesData` / `GameSearchResultsData` |
| Games | `getGameInfoTypes()` | `infosJeuListe` | `GameInfoTypesData` |
| Games | `getRomInfoTypes()` | `infosRomListe` | `RomInfoTypesData` |
| Games | `getGameMediaTypes()` | `mediasJeuListe` | `GameMediaTypesData` |
| Games | `downloadGameMedia()` | `mediaJeu` | raw `string` |
| Games | `downloadGameVideo()` | `mediaVideoJeu` | raw `string` |
| Games | `downloadGameManual()` | `mediaManuelJeu` | raw `string` |
| Groups | `downloadGroupMedia()` | `mediaGroup` | raw `string` |
| Groups | `downloadCompanyMedia()` | `mediaCompagnie` | raw `string` |
| Bots | `sendGameRating()` | `botNote` | `void` |
| Bots | `sendContribution()` | `botProposition` | `void` |

`sendContribution()` proposes a media by URL with a `multipart/form-data` POST, as `botProposition.php` expects. `$crc`, `$md5`, `$sha1`, `$size` and `$format` are not read by the API and are not sent; `$source`, `$supportNumber` and `$version` are optional. Text proposals (`modiftexte` and the like) and file uploads (`modifmediafile`) are not covered: use `callPost()` for them.

### Getting a game

`getGame` with an integer identifier queries `jeuInfos.php` and returns a `GamesData` with the game in `$game`. With an array it queries `jeuRecherche.php`.

```php
ScreenScraperClient::getGame(identifier: 3)->game->names;
```

#### Identifying a game by its hash

Along with the integer, `getGame` accepts `systemId`, `crc`, `md5`, `sha1`, `romType`, `romName`, `romSize` and `serialNum`. Pass `0` as the identifier to look the game up by its ROM alone. Unless your account is exempt, the API needs at least one of `crc`, `md5` or `sha1` together with `romSize`:

```php
ScreenScraperClient::getGame(
    identifier: 0,
    systemId: 14,
    md5: 'd41d8cd98f00b204e9800998ecf8427e',
    romName: 'Game (USA).z64',
    romSize: 749652,
);
```

### Downloading media

Media methods return the raw content of the file. Every option is optional except the id:

```php
// The game is sent as `jeuid` and the system as `systemeid`.
ScreenScraperClient::downloadGameMedia(
    gameId: 3,
    media: 'box-2D(us)',
    systemId: 1,
    maxWidth: 640,
    outputFormat: 'png',
);

ScreenScraperClient::downloadGameVideo(gameId: 3, media: 'video', systemId: 1);
ScreenScraperClient::downloadGameManual(gameId: 3, media: 'manuel(eu)', systemId: 1);
ScreenScraperClient::downloadSystemMedia(systemId: 1, media: 'wheel(wor)');
ScreenScraperClient::downloadGroupMedia(groupId: 7, media: 'logo-monochrome');
ScreenScraperClient::downloadCompanyMedia(companyId: 3, media: 'logo-monochrome');
```

| Option | Applies to |
| --- | --- |
| `crc`, `md5`, `sha1` | every media method: hash of the file you already have |
| `mediaFormat` | every media method (informational, it does not change the output) |
| `maxWidth`, `maxHeight`, `outputFormat` (`png` or `jpg`) | images: game, system, group and company |

When the hash you send already matches, or the file does not exist, the API answers with a short text instead of a file: `CRCOK`, `MD5OK`, `SHA1OK` or `NOMEDIA`. The package returns it as is, so compare the result before saving it:

```php
$content = ScreenScraperClient::downloadGameMedia(3, 'ss', 1);

if (in_array($content, ['CRCOK', 'MD5OK', 'SHA1OK', 'NOMEDIA'], true)) {
    // Nothing new to save.
}
```

### Exceptions

Every exception thrown by the package implements `ScreenScraper\Exceptions\ScreenScraperException`, which extends `Throwable`, so it can be caught directly. The HTTP status is the exception code and the message is the answer of the API, with any URL or credential removed and trimmed to 200 characters.

| Status | Exception | Meaning |
| --- | --- | --- |
| 400 | `BadRequestException` | Missing or malformed fields, invalid ROM name or hash |
| 401 | `UnauthorizedException` | API closed to non members or inactive members |
| 403 | `ForbiddenException` | Wrong developer credentials |
| 404 | `NotFoundException` | Game, ROM or media not found |
| 429, 430, 431 | `QuotaExceededException` | Threads in use, daily scrape quota exceeded, too many unrecognized ROMs today |
| 423, 426 and any other | `GenericException` | API closed, software blacklisted |

`QuotaExceededException::$type` tells which limit was hit (`ScreenScraper\Enums\QuotaType`):

| Status | `QuotaType` | Meaning |
| --- | --- | --- |
| 429 | `Threads` | The threads (or threads per minute) of the account are in use: slow down and retry |
| 430 | `DailyQuota` | The scrape quota of the day is exhausted: wait until tomorrow |
| 431 | `DailyFailures` | Too many unrecognized ROMs today: sort your ROMs and come back tomorrow |

```php
use Illuminate\Http\Client\ConnectionException;
use ScreenScraper\Enums\QuotaType;
use ScreenScraper\Exceptions\QuotaExceededException;
use ScreenScraper\Exceptions\ScreenScraperException;

try {
    ScreenScraperClient::getGame(identifier: 3);
} catch (QuotaExceededException $exception) {
    if ($exception->type === QuotaType::Threads) {
        // Retry later.
    }
} catch (ScreenScraperException $exception) {
    $status = $exception->getCode();
} catch (ConnectionException) {
    // The API could not be reached.
}
```

To know your usage before hitting a limit, `getUser()` exposes `requestsToday`, `maxRequestsPerDay`, `failedRequestsToday`, `maxFailedRequestsPerDay`, `maxRequestsPerMinute` and `maxThreads` in `$user`.

A failed connection throws Laravel's `ConnectionException` with a generic message and without the previous exception: the request URL carries your credentials, so neither the package nor its exceptions ever expose it: the URL parameters are marked `#[SensitiveParameter]`, so they do not appear in stack traces either, and the answer of the API is redacted before it becomes a message. Do not log the URL of your own requests either.

---

## 🧪 Testing and quality

```bash
composer test    # Pest, no real calls: the API is faked with Http::fake
composer static  # PHPStan at the max level
composer fix     # PHP CS Fixer
```

---

## Contributing

Contributions are welcome!

- 🐛 **Report bugs** via [GitHub Issues](https://github.com/gboquizosanchez/screenscraper/issues/new)
- 💡 **Suggest features** or improvements
- 🔧 **Submit pull requests** with fixes or enhancements

---

## Credits

- **Author**: [Germán Boquizo Sánchez](mailto:germanboquizosanchez@gmail.com)
- **Contributors**: [View all contributors](../../contributors)

---

## 📄 License

This package is open-source software licensed under the [MIT License](LICENSE.md).
