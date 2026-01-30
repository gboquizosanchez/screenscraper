<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Game;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class GameClassificationData extends Data
{
    public string $type;
    #[MapName('text')]
    public string $classification;
}
