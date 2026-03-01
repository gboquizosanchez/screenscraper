<?php

declare(strict_types=1);

namespace ScreenScraper\Traits;

trait HasBots
{
    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#botNote
     */
    public function sendGameRating(
        int $gameId,
        int $rating,
        string $romName,
        string $crc,
    ): void
    {
        $this->call('botNote.php', [
            'id' => $gameId,
            'note' => $rating,
            'romnom' => $romName,
            'crc' => $crc,
        ]);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#botProposition
     */
    public function sendContribution(
        int $gameId,
        string $region,
        string $mediaType,
        string $url,
        string $crc,
        string $md5,
        string $sha1,
        int $size,
        string $format,
    ): void{
        $this->call('botProposition.php', [
            'id' => $gameId,
            'region' => $region,
            'media' => $mediaType,
            'url' => $url,
            'crc' => $crc,
            'md5' => $md5,
            'sha1' => $sha1,
            'taille' => $size,
            'format' => $format,
        ]);
    }
}
