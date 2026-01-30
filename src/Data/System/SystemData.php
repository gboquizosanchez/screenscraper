<?php

declare(strict_types=1);

namespace ScreenScraper\Data\System;

use ScreenScraper\Data;
use ScreenScraper\Data\List\MediaData;
use ScreenScraper\Data\Transformers\BackedEnumNameLcfirstTransformer;
use ScreenScraper\Enums\RomType;
use ScreenScraper\Enums\SupportType;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithTransformer;

final class SystemData extends Data
{
    // Identity
    #[MapName('id')]
    public int $id;
    #[MapName('noms')]
    public NamesData $names;
    public string $extensions;
    #[MapName('compagnie')]
    public string $company;
    public string $type;
    #[MapName('datedebut')]
    public string $startDate;
    #[MapName('datefin')]
    public string $endDate;
    #[MapName('romtype')]
    #[WithTransformer(BackedEnumNameLcfirstTransformer::class)]
    public RomType $romType;
    #[MapName('supporttype')]
    #[WithTransformer(BackedEnumNameLcfirstTransformer::class)]
    public SupportType $supportType;
    #[MapName('medias')]
    #[DataCollectionOf(MediaData::class)]
    public array $medias;
}
