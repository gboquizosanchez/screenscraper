<?php

declare(strict_types=1);

namespace ScreenScraper\Data\System;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class SystemMediaTypeData extends Data
{
    // Identity
    #[MapName('id')]
    public string $id;
    #[MapName('nomcourt')]
    public string $shortName;
    #[MapName('nom')]
    public string $name;
    #[MapName('categorie')]
    public string $category;
    #[MapName('plataformtypes')]
    public string $platformTypes;
    #[MapName('plateforms')]
    public string $platforms;
    #[MapName('fileformat')]
    public string $fileFormat;
    #[MapName('fileformat2')]
    public string $secondFileFormat;
    #[MapName('autogen')]
    public bool $autoGenerate;
    #[MapName('multiregions')]
    public bool $multiRegions;
    #[MapName('multisupports')]
    public bool $multiSupports;
    #[MapName('multiversions')]
    public bool $multiVersions;
    #[MapName('extrainfostxt')]
    public string $extraInfo;
}
