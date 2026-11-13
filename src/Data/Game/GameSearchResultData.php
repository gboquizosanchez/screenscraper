<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Game;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MapName;

final class GameSearchResultData extends Data
{
    public int $id;

    /** @var list<GameNamesData> */
    #[MapName('noms')]
    #[DataCollectionOf(GameNamesData::class)]
    public array $names;
    #[MapName('systeme')]
    public SystemGameData $system;
    #[MapName('editeur')]
    public EditorGameData $editor;
    #[MapName('developpeur')]
    public DeveloperGameData $developer;
    #[MapName('joueurs')]
    public PlayerCountGameData $playerCount;
    #[MapName('note')]
    public NoteData $extra;
    #[MapName('topstaff')]
    public ?bool $topStaff;
    public bool $rotation;
    #[MapName('controles')]
    public string $controls;
    #[MapName('couleurs')]
    public string $colors;
    /** @var list<SynopsisData> */
    #[DataCollectionOf(SynopsisData::class)]
    public array $synopsis;
    /** @var list<GameClassificationData> */
    #[DataCollectionOf(GameClassificationData::class)]
    public array $classifications;
    /** @var list<DatesData> */
    #[DataCollectionOf(DatesData::class)]
    public array $dates;
    /** @var list<GameObjectData> */
    #[DataCollectionOf(GameObjectData::class)]
    public array $genres;
    /** @var list<GameObjectData> */
    #[DataCollectionOf(GameObjectData::class)]
    public array $modes;
    /** @var list<GameObjectData> */
    #[MapName('familles')]
    #[DataCollectionOf(GameObjectData::class)]
    public array $families;
    /** @var list<array<string, mixed>> */
    #[MapName('medias')]
    public array $medias;
}
