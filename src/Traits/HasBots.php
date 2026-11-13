<?php

declare(strict_types=1);

namespace ScreenScraper\Traits;

trait HasBots
{
    /**
     * The API only reads `gameid` and `note`: `$romName` and `$crc` are kept for compatibility
     * and are not sent.
     *
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#botNote
     */
    public function sendGameRating(
        int $gameId,
        int $rating,
        ?string $romName = null,
        ?string $crc = null,
    ): void {
        $this->call('botNote.php', [
            'gameid' => $gameId,
            'note' => $rating,
        ], filtered: false);
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
    ): void {
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
