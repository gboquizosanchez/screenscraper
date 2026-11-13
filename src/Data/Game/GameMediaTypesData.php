<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Game;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class GameMediaTypesData extends Data
{
    /** @var array<array-key, mixed> */
    #[MapName('medias')]
    public array $medias;
}
