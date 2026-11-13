<?php

declare(strict_types=1);

namespace ScreenScraper\Traits;

use ScreenScraper\Data\Game\GamesData;
use ScreenScraper\Data\Game\GameInfoTypesData;
use ScreenScraper\Data\Game\GameMediaTypesData;
use ScreenScraper\Data\Game\GameSearchResultsData;
use ScreenScraper\Data\Game\RomInfoTypesData;

trait HasGames
{
    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#jeuRecherche
     *
     * @return GameSearchResultsData|array<string, mixed>
     */
    public function searchGames(int $systemId, string $search): GameSearchResultsData|array
    {
        $data = $this->call('jeuRecherche.php', [
            'systemeid' => $systemId,
            'recherche' => $search,
        ]);

        return $this->response($data, GameSearchResultsData::class);
    }

    /**
     * With an integer identifier it queries `jeuInfos.php`: the game id (0 to leave it out)
     * can be combined with `$systemId` and `$crc`, `$md5`, `$sha1` or `$romName`
     * to identify the game by the hash of its ROM. With an array it queries `jeuRecherche.php`.
     *
     * Unless the account is exempt, `jeuInfos.php` needs at least one of `$crc`, `$md5` or `$sha1`
     * together with `$romSize`.
     *
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#jeuInfos
     *
     * @param int|array<string, mixed> $identifier
     *
     * @return GamesData|GameSearchResultsData|array<string, mixed>
     */
    public function getGame(
        int|array $identifier,
        ?string $crc = null,
        ?string $md5 = null,
        ?string $sha1 = null,
        ?int $systemId = null,
        ?string $romType = null,
        ?string $romName = null,
        ?int $romSize = null,
        ?string $serialNum = null
    ): GamesData|GameSearchResultsData|array {
        if (is_int($identifier)) {
            $data = $this->call('jeuInfos.php', $this->gameLookupParams(
                ['gameid' => $identifier],
                $crc,
                $md5,
                $sha1,
                $systemId,
                $romType,
                $romName,
                $romSize,
                $serialNum,
            ));

            return $this->response($data, GamesData::class);
        }

        $data = $this->call('jeuRecherche.php', $this->gameLookupParams(
            $identifier,
            $crc,
            $md5,
            $sha1,
            $systemId,
            $romType,
            $romName,
            $romSize,
            $serialNum,
        ));

        return $this->response($data, GameSearchResultsData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#infosJeuListe
     *
     * @return GameInfoTypesData|array<string, mixed>
     */
    public function getGameInfoTypes(): GameInfoTypesData|array
    {
        $data = $this->call('infosJeuListe.php');

        return $this->response($data, GameInfoTypesData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#infosRomListe
     *
     * @return RomInfoTypesData|array<string, mixed>
     */
    public function getRomInfoTypes(): RomInfoTypesData|array
    {
        $data = $this->call('infosRomListe.php');

        return $this->response($data, RomInfoTypesData::class);
    }

    /**
     * The endpoint has no input: `$gameId` is kept for compatibility and is not sent.
     *
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediasJeuListe
     *
     * @return GameMediaTypesData|array<string, mixed>
     */
    public function getGameMediaTypes(?int $gameId = null): GameMediaTypesData|array
    {
        $data = $this->call('mediasJeuListe.php');

        return $this->response($data, GameMediaTypesData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaJeu
     */
    public function downloadGameMedia(
        int $gameId,
        ?string $media = null,
        ?int $systemId = null,
        ?string $crc = null,
        ?string $md5 = null,
        ?string $sha1 = null,
        ?string $mediaFormat = null,
        ?int $maxWidth = null,
        ?int $maxHeight = null,
        ?string $outputFormat = null,
    ): string {
        $params = $this->gameMediaParams(
            $gameId,
            $media,
            $systemId,
            $crc,
            $md5,
            $sha1,
            $mediaFormat,
        );

        if ($maxWidth !== null) {
            $params['maxwidth'] = $maxWidth;
        }
        if ($maxHeight !== null) {
            $params['maxheight'] = $maxHeight;
        }
        if ($outputFormat !== null) {
            $params['outputformat'] = $outputFormat;
        }

        return $this->callRaw('mediaJeu.php', $params);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaVideoJeu
     */
    public function downloadGameVideo(
        int $gameId,
        ?string $media = null,
        ?int $systemId = null,
        ?string $crc = null,
        ?string $md5 = null,
        ?string $sha1 = null,
        ?string $mediaFormat = null,
    ): string {
        return $this->callRaw(
            'mediaVideoJeu.php',
            $this->gameMediaParams(
                $gameId,
                $media,
                $systemId,
                $crc,
                $md5,
                $sha1,
                $mediaFormat,
            ),
        );
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaManuelJeu
     */
    public function downloadGameManual(
        int $gameId,
        ?string $media = null,
        ?int $systemId = null,
        ?string $crc = null,
        ?string $md5 = null,
        ?string $sha1 = null,
        ?string $mediaFormat = null,
    ): string {
        return $this->callRaw(
            'mediaManuelJeu.php',
            $this->gameMediaParams(
                $gameId,
                $media,
                $systemId,
                $crc,
                $md5,
                $sha1,
                $mediaFormat,
            ),
        );
    }

    /**
     * @param array<string, mixed> $params
     *
     * @return array<string, mixed>
     */
    private function gameLookupParams(
        array $params,
        ?string $crc,
        ?string $md5,
        ?string $sha1,
        ?int $systemId,
        ?string $romType,
        ?string $romName,
        ?int $romSize,
        ?string $serialNum,
    ): array {
        if ($crc !== null) {
            $params['crc'] = $crc;
        }
        if ($md5 !== null) {
            $params['md5'] = $md5;
        }
        if ($sha1 !== null) {
            $params['sha1'] = $sha1;
        }
        if ($systemId !== null) {
            $params['systemeid'] = $systemId;
        }
        if ($romType !== null) {
            $params['romtype'] = $romType;
        }
        if ($romName !== null) {
            $params['romnom'] = $romName;
        }
        if ($romSize !== null) {
            $params['romtaille'] = $romSize;
        }
        if ($serialNum !== null) {
            $params['serialnum'] = $serialNum;
        }

        return $params;
    }

    /**
     * @return array<string, mixed>
     */
    private function gameMediaParams(
        int $gameId,
        ?string $media,
        ?int $systemId,
        ?string $crc,
        ?string $md5,
        ?string $sha1,
        ?string $mediaFormat,
    ): array {
        $params = [
            'jeuid' => $gameId,
        ];

        if ($systemId !== null) {
            $params['systemeid'] = $systemId;
        }
        if ($media !== null) {
            $params['media'] = $media;
        }
        if ($crc !== null) {
            $params['crc'] = $crc;
        }
        if ($md5 !== null) {
            $params['md5'] = $md5;
        }
        if ($sha1 !== null) {
            $params['sha1'] = $sha1;
        }
        if ($mediaFormat !== null) {
            $params['mediaformat'] = $mediaFormat;
        }

        return $params;
    }
}
