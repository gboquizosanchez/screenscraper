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
     * Proposes a media by URL as a `multipart/form-data` POST. The API does not read
     * `$crc`, `$md5`, `$sha1`, `$size` or `$format`: they are kept for compatibility and are not sent.
     *
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#botProposition
     */
    public function sendContribution(
        int $gameId,
        string $region,
        string $mediaType,
        string $url,
        ?string $crc = null,
        ?string $md5 = null,
        ?string $sha1 = null,
        ?int $size = null,
        ?string $format = null,
        ?string $source = null,
        ?int $supportNumber = null,
        ?string $version = null,
    ): void {
        $this->callPost('botProposition.php', [
            'gameid' => $gameId,
            'modiftypemedia' => $mediaType,
            'modiftyperegion' => $region,
            'modifmediafileurl' => $url,
            'modifmediasource' => $source,
            'modiftypenumsupport' => $supportNumber,
            'modiftypeversion' => $version,
        ]);
    }
}
