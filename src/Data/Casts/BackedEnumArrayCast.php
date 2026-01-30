<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Casts;

use BackedEnum;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Casts\IterableItemCast;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;

final readonly class BackedEnumArrayCast implements Cast, IterableItemCast
{
    /**
     * @param class-string<BackedEnum> $enumClass
     */
    public function __construct(
        private string $enumClass,
    ) {}

    public function cast(
        DataProperty $property,
        mixed $value,
        array $properties,
        CreationContext $context,
    ): mixed {
        if (!is_array($value)) {
            return Uncastable::create();
        }

        return array_map(function ($v) {
            return $this->castOne($v);
        }, $value);
    }

    public function castIterableItem(
        DataProperty $property,
        mixed $value,
        array $properties,
        CreationContext $context,
    ): BackedEnum|Uncastable {
        return $this->castOne($value);
    }

    private function castOne(mixed $value): BackedEnum|Uncastable|string
    {
        if ($value instanceof $this->enumClass) {
            return $value;
        }

        if ($value instanceof BackedEnum) {
            $value = $value->value;
        }

        if (!is_string($value) && !is_int($value)) {
            return Uncastable::create();
        }

        /** @var BackedEnum $enum */
        $enum = $this->enumClass::from($value);

        return $enum;
    }
}
