<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Game;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class GameNameData extends Data
{
    #[MapName('langue')]
    public string $language;
    #[MapName('text')]
    public string $name;
}
