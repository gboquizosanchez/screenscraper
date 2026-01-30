<?php

declare(strict_types=1);

namespace ScreenScraper\Data\List;

use ScreenScraper\Data;
use ScreenScraper\Data\Casts\BackedEnumArrayCast;
use ScreenScraper\Data\Transformers\BackedEnumArrayTransformer;
use ScreenScraper\Enums\RomType;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;

final class RomTypesData extends Data
{
    /** @var list<RomType> */
    #[MapName('romtypes')]
    #[WithCast(BackedEnumArrayCast::class, RomType::class)]
    #[WithTransformer(BackedEnumArrayTransformer::class)]
    public array $romTypes;
}
