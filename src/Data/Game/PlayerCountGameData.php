<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Game;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class PlayerCountGameData extends Data
{
    #[MapName('text')]
    public string $amount;
}
