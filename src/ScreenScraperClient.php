<?php

declare(strict_types=1);

namespace ScreenScraper;

use Illuminate\Support\Facades\Facade;
use Override;
use ScreenScraper\Data\Game\GameInfoTypesData;
use ScreenScraper\Data\Game\GameMediaTypesData;
use ScreenScraper\Data\Game\GamesData;
use ScreenScraper\Data\Game\GameSearchResultsData;
use ScreenScraper\Data\Game\RomInfoTypesData;
use ScreenScraper\Data\Infrastructure\InfrastructureData;
use ScreenScraper\Data\List\ClassificationsData;
use ScreenScraper\Data\List\FamiliesData;
use ScreenScraper\Data\List\GenresData;
use ScreenScraper\Data\List\LanguagesData;
use ScreenScraper\Data\List\RegionsData;
use ScreenScraper\Data\List\RomTypesData;
use ScreenScraper\Data\List\SupportTypesData;
use ScreenScraper\Data\System\SystemMediaTypesData;
use ScreenScraper\Data\System\SystemsData;
use ScreenScraper\Data\User\PlayerCountsData;
use ScreenScraper\Data\User\ScreenScraperUserData;
use ScreenScraper\Data\User\UserLevelsData;
use ScreenScraper\Models\ScreenScraper;

/**
 * Start infrastructure methods.
 * @method static InfrastructureData|array<string, mixed> getInfrastructure()
 *
 * Start user methods.
 * @method static ScreenScraperUserData|array<string, mixed> getUser()
 * @method static UserLevelsData|array<string, mixed> getUserLevels()
 * @method static PlayerCountsData|array<string, mixed> getPlayerCounts()
 *
 * Start list methods.
 * @method static SupportTypesData|array<string, mixed> getSupportTypes()
 * @method static RomTypesData|array<string, mixed> getRomTypes()
 * @method static LanguagesData|array<string, mixed> getLanguages()
 * @method static RegionsData|array<string, mixed> getRegions()
 * @method static GenresData|array<string, mixed> getGenres()
 * @method static FamiliesData|array<string, mixed> getFamilies()
 * @method static ClassificationsData|array<string, mixed> getClassifications()
 *
 * Start system methods.
 * @method static SystemsData|array<string, mixed> getSystems()
 * @method static SystemMediaTypesData|array<string, mixed> getSystemMediaTypes()
 * @method static string downloadSystemMedia(int $systemId, string $media, ?string $md5 = null, ?string $sha1 = null, ?string $mediaFormat = null, ?int $maxWidth = null, ?int $maxHeight = null, ?string $outputFormat = null)
 * @method static string downloadSystemVideo(int $systemId, string $media, ?string $crc = null, ?string $md5 = null, ?string $sha1 = null, ?string $mediaFormat = null)
 *
 * Start games methods.
 * @method static GameSearchResultsData|array<string, mixed> searchGames(int $systemId, string $search)
 * @method static GamesData|GameSearchResultsData|array<string, mixed> getGame(int|array<string, mixed> $identifier, ?string $crc = null, ?string $md5 = null, ?string $sha1 = null, ?int $systemId = null, ?string $romType = null, ?string $romName = null, ?int $romSize = null, ?string $serialNum = null)
 * @method static GameInfoTypesData|array<string, mixed> getGameInfoTypes()
 * @method static RomInfoTypesData|array<string, mixed> getRomInfoTypes()
 * @method static GameMediaTypesData|array<string, mixed> getGameMediaTypes(?int $gameId = null)
 * @method static string downloadGameMedia(int $gameId, ?string $media = null, ?int $systemId = null, ?string $crc = null, ?string $md5 = null, ?string $sha1 = null, ?string $mediaFormat = null, ?int $maxWidth = null, ?int $maxHeight = null, ?string $outputFormat = null)
 * @method static string downloadGameVideo(int $gameId, ?string $media = null, ?int $systemId = null, ?string $crc = null, ?string $md5 = null, ?string $sha1 = null, ?string $mediaFormat = null)
 * @method static string downloadGameManual(int $gameId, ?string $media = null, ?int $systemId = null, ?string $crc = null, ?string $md5 = null, ?string $sha1 = null, ?string $mediaFormat = null)
 *
 * Start groups methods.
 * @method static string downloadGroupMedia(int $groupId, string $media, ?string $crc = null, ?string $md5 = null, ?string $sha1 = null, ?string $mediaFormat = null, ?int $maxWidth = null, ?int $maxHeight = null, ?string $outputFormat = null)
 * @method static string downloadCompanyMedia(int $companyId, string $media, ?string $crc = null, ?string $md5 = null, ?string $sha1 = null, ?string $mediaFormat = null, ?int $maxWidth = null, ?int $maxHeight = null, ?string $outputFormat = null)
 *
 * Start bots methods.
 * @method static void sendGameRating(int $gameId, int $rating, ?string $romName = null, ?string $crc = null)
 * @method static void sendContribution(int $gameId, string $region, string $mediaType, string $url, ?string $crc = null, ?string $md5 = null, ?string $sha1 = null, ?int $size = null, ?string $format = null, ?string $source = null, ?int $supportNumber = null, ?string $version = null)
 *
 * Start low level methods.
 * @method static array<string, mixed> call(string $endpoint, array<string, mixed> $parameters = [], bool $filtered = true)
 * @method static string callRaw(string $endpoint, array<string, mixed> $parameters = [], bool $filtered = true)
 * @method static string callPost(string $endpoint, array<string, mixed> $fields = [])
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
