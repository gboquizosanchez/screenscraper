<?php

declare(strict_types=1);

namespace ScreenScraper\Traits;

trait HasBots
{
    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#botNote
     *
     * @todo: need implementation
     */
    public function sendGameRating(): void
    {
        $data = $this->call('botNote.php');
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#botProposition
     *
     * @todo: need implementation
     */
    public function sendContribution(): void
    {
        $data = $this->call('botProposition.php');
    }
}
