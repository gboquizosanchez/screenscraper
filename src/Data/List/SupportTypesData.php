<?php

declare(strict_types=1);

namespace ScreenScraper\Data\List;

use ScreenScraper\Data;
use ScreenScraper\Data\Casts\BackedEnumArrayCast;
use ScreenScraper\Data\Transformers\BackedEnumArrayTransformer;
use ScreenScraper\Enums\SupportType;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;

final class SupportTypesData extends Data
{
    /** @var list<SupportType> */
    #[MapName('supporttypes')]
    #[WithCast(BackedEnumArrayCast::class, SupportType::class)]
    #[WithTransformer(BackedEnumArrayTransformer::class)]
    public array $supportTypes;
}
