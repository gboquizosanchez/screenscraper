<?php

declare(strict_types=1);

namespace ScreenScraper\Data\User;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;

final class UserLevelsData extends Data
{
    /** @var list<LevelData> */
    #[MapName('userlevels')]
    #[DataCollectionOf(LevelData::class)]
    public array $levels;
}
