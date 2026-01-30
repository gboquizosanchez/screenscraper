<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Transformers;

use BackedEnum;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

final class BackedEnumNameLcfirstTransformer implements Transformer
{
    public function transform(
        DataProperty $property,
        mixed $value,
        TransformationContext $context,
    ): mixed {
        if ($value instanceof BackedEnum) {
            return lcfirst($value->name);
        }

        return $value;
    }
}
