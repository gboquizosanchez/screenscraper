<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Game;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class RomInfoTypesData extends Data
{
    /** @var array<array-key, mixed> */
    #[MapName('infos')]
    public array $infos;
}
