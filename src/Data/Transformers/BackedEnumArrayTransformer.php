<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Transformers;

use BackedEnum;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;
use Spatie\LaravelData\Transformers\Transformer;

final class BackedEnumArrayTransformer implements Transformer
{
    public function transform(
        DataProperty $property,
        mixed $value,
        TransformationContext $context,
    ): array {
        if (!is_array($value)) {
            return [];
        }

        return array_map(
            static function (mixed $item): mixed {
                if ($item instanceof BackedEnum) {
                    return lcfirst($item->name);
                }

                return $item;
            },
            $value
        );
    }
}
