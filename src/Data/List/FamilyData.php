<?php

declare(strict_types=1);

namespace ScreenScraper\Data\List;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class FamilyData extends Data
{
    // Identity
    #[MapName('id')]
    public string $id;
    #[MapName('nom')]
    public string $name;
    #[MapName('medias')]
    public array $media;
}
