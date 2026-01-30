<?php

declare(strict_types=1);

namespace ScreenScraper\Traits;

use ScreenScraper\Data\System\SystemMediaTypesData;
use ScreenScraper\Data\System\SystemsData;

trait HasSystems
{
    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#systemesListe
     */
    public function getSystems(): SystemsData|array
    {
        $data = $this->call('systemesListe.php');

        return $this->response($data, SystemsData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediasSystemeListe
     *
     * @return SystemMediaTypesData|array<string, mixed>
     */
    public function getSystemMediaTypes(): SystemMediaTypesData|array
    {
        $data = $this->call('mediasSystemeListe.php');

        return $this->response($data, SystemMediaTypesData::class);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaSysteme
     */
    public function downloadSystemMedia(
        int $systemId,
        string $media,
        ?string $md5 = null,
        ?string $sha1 = null,
        ?string $mediaFormat = null,
        ?int $maxWidth = null,
        ?int $maxHeight = null,
        ?string $outputFormat = null,
    ): string {
        $params = [
            'id' => $systemId,
            'media' => $media,
        ];

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

        return $this->callRaw('mediaSysteme.php', $params);
    }

    /**
     * @link https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0#mediaVideoSysteme
     */
    public function downloadSystemVideo(
        int $systemId,
        string $media,
        ?string $crc = null,
        ?string $md5 = null,
        ?string $sha1 = null,
        ?string $mediaFormat = null,
    ): string {
        $params = [
            'id' => $systemId,
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

        return $this->callRaw('mediaVideoSysteme.php', $params);
    }
}
