<?php

declare(strict_types=1);

namespace ScreenScraper\Traits;

trait HasGroups
{
    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaGroup
     */
    public function downloadGroupMedia(int $groupId, string $media): string
    {
        return $this->callRaw('mediaGroup.php', [
            'id' => $groupId,
            'media' => $media,
        ]);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaCompagnie
     */
    public function downloadCompanyMedia(int $companyId, string $media): string
    {
        return $this->callRaw('mediaCompagnie.php', [
            'id' => $companyId,
            'media' => $media,
        ]);
    }
}
