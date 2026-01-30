<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Game;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class NoteData extends Data
{
    #[MapName('text')]
    public string $notes;
}
