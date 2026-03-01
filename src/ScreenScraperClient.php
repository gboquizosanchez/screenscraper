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
 * @method static getRomTypes(): RomTypesData|array
 * @method static getLanguages(): LanguagesData|array
 * @method static getRegions(): RegionsData|array
 * @method static getGenres(): GenresData|array
 * @method static getFamilies(): FamiliesData|array
 * @method static getClassifications(): ClassificationsData|array
 *
 * Start system methods.
 * @method static getSystems(): SystemsData|array
 * @method static getSystemMediaTypes(): SystemMediaTypesData|array
 * @method static downloadSystemMedia(int $systemId, string $media, ?string $md5 = null, ?string $sha1 = null, ?string $mediaFormat = null, ?int $maxWidth = null, ?int $maxHeight = null, ?string $outputFormat = null): string
 * @method static downloadSystemVideo(int $systemId, string $media, ?string $crc = null, ?string $md5 = null, ?string $sha1 = null, ?string $mediaFormat = null): string
 *
 * Start games methods.
 * @method static searchGames(int $systemId, string $search): GameSearchResultsData|array
 * @method static getGame(int|array $identifier, ?string $crc = null, ?string $md5 = null, ?string $sha1 = null, ?int $systemId = null, ?string $romType = null, ?string $romName = null, ?int $romSize = null, ?string $serialNum = null): GamesData|GameSearchResultsData|array
 * @method static getGameInfoTypes(): GameInfoTypesData|array
 * @method static getRomInfoTypes(): RomInfoTypesData|array
 * @method static getGameMediaTypes(int $gameId): GameMediaTypesData|array
 * @method static downloadGameMedia(int $gameId): string
 * @method static downloadGameVideo(int $gameId): string
 * @method static downloadGameManual(int $gameId): string
 *
 * Start groups methods.
 * @method static downloadGroupMedia(int $groupId, string $media): string
 * @method static downloadCompanyMedia(int $companyId, string $media): string
 *
 * Start bots methods.
 * @method static sendGameRating(int $gameId, int $rating, string $romName, string $crc): void
 * @method static sendContribution(int $gameId, string $region, string $mediaType, string $url, string $crc, string $md5, string $sha1, int $size, string $format): void
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
