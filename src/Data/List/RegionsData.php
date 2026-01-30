<?php

declare(strict_types=1);

namespace ScreenScraper\Data\List;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;

final class RegionsData extends Data
{
    #[MapName('regions')]
    #[DataCollectionOf(RegionData::class)]
    public array $regions;
}
