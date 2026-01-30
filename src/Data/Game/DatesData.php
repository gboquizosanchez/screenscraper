<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Game;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class DatesData extends Data
{
    public string $region;
    #[MapName('text')]
    public string $release;
}
