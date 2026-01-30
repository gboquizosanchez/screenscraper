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
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#jeuInfos
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
            $data = $this->call('jeuInfos.php', ['id' => $identifier]);

            return $this->response($data, GamesData::class);
        }

        $params = $identifier;

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

        $data = $this->call('jeuRecherche.php', $params);

        return $this->response($data, GameSearchResultsData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#infosJeuListe
     */
    public function getGameInfoTypes(): GameInfoTypesData|array
    {
        $data = $this->call('infosJeuListe.php');

        return $this->response($data, GameInfoTypesData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#infosRomListe
     */
    public function getRomInfoTypes(): RomInfoTypesData|array
    {
        $data = $this->call('infosRomListe.php');

        return $this->response($data, RomInfoTypesData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediasJeuListe
     */
    public function getGameMediaTypes(int $gameId): GameMediaTypesData|array
    {
        $data = $this->call('mediasJeuListe.php', ['id' => $gameId]);

        return $this->response($data, GameMediaTypesData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaJeu
     */
    public function downloadGameMedia(int $gameId): string
    {
        return $this->callRaw('mediaJeu.php', ['id' => $gameId]);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaVideoJeu
     */
    public function downloadGameVideo(int $gameId): string
    {
        return $this->callRaw('mediaVideoJeu.php', ['id' => $gameId]);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaManuelJeu
     */
    public function downloadGameManual(int $gameId): string
    {
        return $this->callRaw('mediaManuelJeu.php', ['id' => $gameId]);
    }
}
