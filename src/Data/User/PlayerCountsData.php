<?php

declare(strict_types=1);

namespace ScreenScraper\Data\User;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;

final class PlayerCountsData extends Data
{
    #[MapName('nbjoueurs')]
    #[DataCollectionOf(PlayerCountData::class)]
    public array $numberOfPlayers;
}
