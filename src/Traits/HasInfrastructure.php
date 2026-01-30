<?php

declare(strict_types=1);

namespace ScreenScraper\Traits;

use ScreenScraper\Data\Infrastructure\InfrastructureData;

trait HasInfrastructure
{
    /**
     * @link https://screenscraper.fr/webapi2.php?alpha=0&numpage=0#ssinfraInfos
     *
     * @return InfrastructureData|array<string, mixed>
     */
    public function getInfrastructure(): InfrastructureData|array
    {
        $data = $this->call('ssinfraInfos.php');

        return $this->response($data, InfrastructureData::class);
    }
}
