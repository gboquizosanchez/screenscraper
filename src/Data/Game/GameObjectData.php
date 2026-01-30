<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Game;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;

final class GameObjectData extends Data
{
    public int $id;
    #[MapName('nomcourt')]
    public string $name;
    #[MapName('principale')]
    public bool $principal;
    #[MapName('parent')]
    public string $parentId;
    #[MapName('noms')]
    #[DataCollectionOf(GameNameData::class)]
    public array $names;
}
