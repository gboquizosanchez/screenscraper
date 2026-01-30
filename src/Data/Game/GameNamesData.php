<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Game;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class GameNamesData extends Data
{
    #[MapName('region')]
    public string $region;
    #[MapName('text')]
    public string $title;
}
