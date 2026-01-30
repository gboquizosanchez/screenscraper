<?php

declare(strict_types=1);

namespace ScreenScraper\Data\System;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;

final class SystemMediaTypesData extends Data
{
    #[MapName('medias')]
    #[DataCollectionOf(SystemMediaTypeData::class)]
    public array $mediaTypes;
}
