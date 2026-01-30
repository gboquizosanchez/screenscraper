<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Game;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;

final class GameSearchResultsData extends Data
{
    #[MapName('jeux')]
    #[DataCollectionOf(GameSearchResultData::class)]
    public array $games;
}
