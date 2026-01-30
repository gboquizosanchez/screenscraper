<?php

declare(strict_types=1);

namespace ScreenScraper\Traits;

use ScreenScraper\Data\User\PlayerCountsData;
use ScreenScraper\Data\User\UserLevelsData;
use ScreenScraper\Data\User\ScreenScraperUserData;

trait HasUsers
{
    /**
     * @link https://screenscraper.fr/webapi2.php?alpha=0&numpage=0#ssuserInfos
     *
     * @return ScreenScraperUserData|array<string, mixed>
     */
    public function getUser(): ScreenScraperUserData|array
    {
        $data = $this->call('ssuserInfos.php');

        return $this->response($data, ScreenScraperUserData::class);
    }

    /**
     * @link https://screenscraper.fr/webapi2.php?alpha=0&numpage=0#userlevelsListe
     *
     * @return UserLevelsData|array<string, mixed>
     */
    public function getUserLevels(): UserLevelsData|array
    {
        $data = $this->call('userlevelsListe.php');

        return $this->response($data, UserLevelsData::class);
    }

    /**
     * @link https://screenscraper.fr/webapi2.php?alpha=0&numpage=0#nbJoueursListe
     *
     * @return PlayerCountsData|array<string, mixed>
     */
    public function getPlayerCounts(): PlayerCountsData|array
    {
        $data = $this->call('nbJoueursListe.php');

        return $this->response($data, PlayerCountsData::class);
    }
}
