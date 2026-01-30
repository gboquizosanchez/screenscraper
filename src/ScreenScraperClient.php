<?php

declare(strict_types=1);

namespace ScreenScraper;

use Illuminate\Support\Facades\Facade;
use Override;
use ScreenScraper\Models\ScreenScraper;

/**
 * Start infrastructure methods.
 * @method static getInfrastructure(): InfrastructureData|array
 *
 * Start user methods.
 * @method static getUser(): ScreenScraperUserData|array
 * @method static getUserLevels(): UserLevelsData|array
 * @method static getPlayerCounts(): PlayerCountsData|array
 *
 * Start list methods.
 * @method static getSupportTypes(): SupportTypesData|array
 * @method static getLanguages(): LanguagesData|array
 * @method static getRegions(): RegionsData|array
 * @method static getGenres(): GenresData|array
 * @method static getFamilies(): FamiliesData|array
 * @method static getClassifications(): ClassificationsData|array
 *
 * Start system methods.
 * @method static getSystems(): SystemsData|array
 * @method static getSystemMediaTypes(): SystemMediaTypesData|array
 * @method static downloadSystemMedia(int $systemId, string $media, ?string $md5 = null, ?string $sha1 = null, ?string $mediaFormat = null): string
 * @method static downloadSystemVideo(int $systemId, string $media, ?string $crc = null, ?string $md5 = null, ?string $sha1 = null, ?string $mediaFormat = null): string
 *
 * Start games methods.
 * @method static searchGames(int $systemId, string $search): GamesSearchResultsData|array
 * @method static getGame(int $gameId): GameData|array
 * @method static getGameInfoTypes(): GameInfoTypesData|array
 * @method static getRomInfoTypes(): RomInfoTypesData|array
 * @method static getGameMediaTypes(int $gameId): GameMediaTypesData|array
 * @method static downloadGameMedia(int $gameId): mixed
 * @method static downloadGameVideo(int $gameId): mixed
 * @method static downloadGameManual(int $gameId): mixed
 *
 * Start groups methods.
 * @method static downloadGroupMedia(int $groupId, int $mediaId): mixed
 * @method static downloadCompanyMedia(int $groupId, int $mediaId): mixed
 *
 * Start bots methods.
 * @method static sendGameRating()
 * @method static sendContribution()
 *
 * @see ScreenScraper
 */
final class ScreenScraperClient extends Facade
{
    #[Override]
    public static function getFacadeAccessor(): string
    {
        return 'screenscraper';
    }
}
