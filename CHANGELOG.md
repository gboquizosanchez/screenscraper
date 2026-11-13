# Changelog

All notable changes to this package are documented in this file.

## Unreleased

### Added

- `callPost()` for `multipart/form-data` endpoints, and optional `$source`, `$supportNumber` and `$version` in `sendContribution()`.
- Optional `systemId`, `crc`, `md5`, `sha1`, `romName`, `romType`, `romSize` and `serialNum` in `getGame()` with an integer identifier, to identify a game by the hash of its ROM through `jeuInfos.php`.
- Optional `media`, `systemId`, `crc`, `md5`, `sha1`, `mediaFormat` in `downloadGameMedia()`, `downloadGameVideo()` and `downloadGameManual()`, and `maxWidth`, `maxHeight` and `outputFormat` in `downloadGameMedia()`.
- Optional `crc`, `md5`, `sha1`, `mediaFormat`, `maxWidth`, `maxHeight` and `outputFormat` in `downloadGroupMedia()` and `downloadCompanyMedia()`.
- `BadRequestException` (HTTP 400) and `QuotaExceededException` (HTTP 429, 430 and 431) with the `QuotaType` enum (`Threads`, `DailyQuota`, `DailyFailures`).
- `GamesData`, the typed response of `jeuInfos.php` (the game is in `$game`).
- The HTTP status as the code of every exception thrown for a failed answer.
- `composer test`, and PHPStan at the `max` level.

### Changed

- `ScreenScraperException` now extends `Throwable`, so it can be caught directly.
- `call()` and `callRaw()` declare `@throws` with `ConnectionException`, `ScreenScraperException` and `QuotaExceededException`.
- The message of an exception is the answer of the API, redacted and trimmed to 200 characters, instead of the whole body or `Invalid JSON response`.
- A failed connection is rethrown as a `ConnectionException` with a generic message and without the previous exception, and the URL parameters are marked `#[SensitiveParameter]`, so the credentials never reach a message or a stack trace.
- `url()` is now private: it returned the request URL with the account credentials.
- `sendGameRating()` only sends `gameid` and `note`, as the API reads; `$romName` and `$crc` are now optional and ignored.

### Fixed

- `sendContribution()` sent a GET with fields the API does not read; it now sends the `multipart/form-data` POST that `botProposition.php` expects.
- `getGame()` with an integer identifier sent `id` instead of `gameid`.
- `getGameMediaTypes()` sent a game id to an endpoint that has no input; `$gameId` is now optional and ignored.
- `getGameInfoTypes()`, `getRomInfoTypes()` and `getGameMediaTypes()` returned empty objects; they now map `infos` and `medias`.
- `sendGameRating()` dropped a rating of `0`.
- `AuthData` no longer shows the passwords in `var_dump()` and `print_r()`.
- `downloadSystemMedia()` and `downloadSystemVideo()` sent `id` instead of `systemeid` (the API answered `NOMEDIA`).
- `downloadGroupMedia()` and `downloadCompanyMedia()` sent `id` instead of `groupid` and `companyid`.
- `downloadGameMedia()`, `downloadGameVideo()` and `downloadGameManual()` sent `id` instead of `jeuid`.
- `getGame()` with an integer identifier returned an empty object.
- `SupportType` values for combined supports used a hyphen (`cartouche-cd`) where the API sends `&` (`cartouche&cd`), which threw a `ValueError`.
- The test suite could not run (helpers declared in every file), and the fakes did not match the real answers.
