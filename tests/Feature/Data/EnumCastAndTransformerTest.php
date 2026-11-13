<?php

declare(strict_types=1);

use ScreenScraper\Data\Casts\BackedEnumArrayCast;
use ScreenScraper\Data\Transformers\BackedEnumArrayTransformer;
use ScreenScraper\Data\Transformers\BackedEnumNameLcfirstTransformer;
use ScreenScraper\Enums\SupportType;
use Spatie\LaravelData\Casts\Uncastable;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;

enum OtherWebEnum: string
{
    case Web = 'web';
}

/** @see \ScreenScraper\Data\Casts\BackedEnumArrayCast */
function castProperty(): DataProperty
{
    return Mockery::mock(DataProperty::class);
}

function castContext(): CreationContext
{
    return Mockery::mock(CreationContext::class);
}

it('does not cast a value that is not an array', function (): void {
    $cast = new BackedEnumArrayCast(SupportType::class);

    expect($cast->cast(castProperty(), 'web', [], castContext()))
        ->toBeInstanceOf(Uncastable::class);
});

it('casts every item of an array', function (): void {
    $cast = new BackedEnumArrayCast(SupportType::class);

    expect($cast->cast(castProperty(), ['web', 'cd'], [], castContext()))
        ->toBe([SupportType::Web, SupportType::Cd]);
});

it('keeps an item that already is the enum', function (): void {
    $cast = new BackedEnumArrayCast(SupportType::class);

    expect($cast->castIterableItem(castProperty(), SupportType::Web, [], castContext()))
        ->toBe(SupportType::Web);
});

it('casts the value of another backed enum', function (): void {
    $cast = new BackedEnumArrayCast(SupportType::class);

    expect($cast->castIterableItem(castProperty(), OtherWebEnum::Web, [], castContext()))
        ->toBe(SupportType::Web);
});

it('does not cast a value that is neither a string nor an integer', function (mixed $value): void {
    $cast = new BackedEnumArrayCast(SupportType::class);

    expect($cast->castIterableItem(castProperty(), $value, [], castContext()))
        ->toBeInstanceOf(Uncastable::class);
})->with([
    'null' => [null],
    'float' => [1.5],
    'array' => [[]],
]);

/** @see \ScreenScraper\Data\Transformers\BackedEnumArrayTransformer */
it('transforms a value that is not an array into an empty list', function (): void {
    $transformer = new BackedEnumArrayTransformer();

    expect($transformer->transform(castProperty(), 'web', new TransformationContext()))
        ->toBe([]);
});

it('transforms enums into their lowercase first name and keeps the rest', function (): void {
    $transformer = new BackedEnumArrayTransformer();

    expect($transformer->transform(castProperty(), [SupportType::BlueRay, 'raw'], new TransformationContext()))
        ->toBe(['blueRay', 'raw']);
});

/** @see \ScreenScraper\Data\Transformers\BackedEnumNameLcfirstTransformer */
it('transforms an enum and keeps any other value', function (): void {
    $transformer = new BackedEnumNameLcfirstTransformer();

    expect($transformer->transform(castProperty(), SupportType::BlueRay, new TransformationContext()))
        ->toBe('blueRay')
        ->and($transformer->transform(castProperty(), 'raw', new TransformationContext()))
        ->toBe('raw');
});
