<?php

declare(strict_types=1);

namespace ScreenScraper\Traits;

trait HasGroups
{
    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaGroup
     */
    public function downloadGroupMedia(
        int $groupId,
        string $media,
        ?string $crc = null,
        ?string $md5 = null,
        ?string $sha1 = null,
        ?string $mediaFormat = null,
        ?int $maxWidth = null,
        ?int $maxHeight = null,
        ?string $outputFormat = null,
    ): string {
        return $this->callRaw('mediaGroup.php', $this->mediaParams(
            'groupid',
            $groupId,
            $media,
            $crc,
            $md5,
            $sha1,
            $mediaFormat,
            $maxWidth,
            $maxHeight,
            $outputFormat,
        ));
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaCompagnie
     */
    public function downloadCompanyMedia(
        int $companyId,
        string $media,
        ?string $crc = null,
        ?string $md5 = null,
        ?string $sha1 = null,
        ?string $mediaFormat = null,
        ?int $maxWidth = null,
        ?int $maxHeight = null,
        ?string $outputFormat = null,
    ): string {
        return $this->callRaw('mediaCompagnie.php', $this->mediaParams(
            'companyid',
            $companyId,
            $media,
            $crc,
            $md5,
            $sha1,
            $mediaFormat,
            $maxWidth,
            $maxHeight,
            $outputFormat,
        ));
    }

    /**
     * @return array<string, mixed>
     */
    private function mediaParams(
        string $idName,
        int $id,
        string $media,
        ?string $crc,
        ?string $md5,
        ?string $sha1,
        ?string $mediaFormat,
        ?int $maxWidth,
        ?int $maxHeight,
        ?string $outputFormat,
    ): array {
        $params = [
            $idName => $id,
            'media' => $media,
        ];

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
        if ($maxWidth !== null) {
            $params['maxwidth'] = $maxWidth;
        }
        if ($maxHeight !== null) {
            $params['maxheight'] = $maxHeight;
        }
        if ($outputFormat !== null) {
            $params['outputformat'] = $outputFormat;
        }

        return $params;
    }
}
