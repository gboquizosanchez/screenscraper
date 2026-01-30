<?php

declare(strict_types=1);

namespace ScreenScraper\Traits;

trait HasGroups
{
    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaGroup
     *
     * @todo: need implementation
     */
    public function downloadGroupMedia(int $groupId, int $mediaId)
    {
        return $this->call('mediaGroup.php', ['id' => $groupId, 'media' => $mediaId]);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaCompagnie
     *
     * @need implementation
     */
    public function downloadCompanyMedia(int $companyId, int $mediaId)
    {
        return $this->call('mediaCompagnie.php', ['id' => $companyId, 'media' => $mediaId]);
    }
}
