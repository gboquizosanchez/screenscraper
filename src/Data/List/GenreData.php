<?php

declare(strict_types=1);

namespace ScreenScraper\Data\List;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;

final class GenreData extends Data
{
    // Identity
    #[MapName('id')]
    public string $id;
    #[MapName('nomcourt')]
    public string $shortName;
    #[MapName('nom_fr')]
    public string $nameFr;
    #[MapName('nom_en')]
    public string $nameEn;
    #[MapName('nom_es')]
    public string $nameEs;
    #[MapName('nom_de')]
    public string $nameDe;
    #[MapName('nom_it')]
    public string $nameIt;
    #[MapName('nom_pt')]
    public string $namePt;
    #[MapName('parent')]
    public int $parentId;
    #[MapName('medias')]
    #[DataCollectionOf(MediaData::class)]
    public array $media;
}
