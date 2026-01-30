<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Game;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class DeveloperGameData extends Data
{
    public int $id;
    #[MapName('text')]
    public string $name;
}
