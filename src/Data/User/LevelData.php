<?php

declare(strict_types=1);

namespace ScreenScraper\Data\User;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class LevelData extends Data
{
    // Identity
    #[MapName('id')]
    public int $id;
    #[MapName('nom_fr')]
    public string $name;
}
