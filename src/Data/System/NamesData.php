<?php

declare(strict_types=1);

namespace ScreenScraper\Data\System;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class NamesData extends Data
{
    #[MapName('nom_eu')]
    public string $nameEu;
    #[MapName('nom_us')]
    public string $nameUs;
    #[MapName('nom_recalbox')]
    public string $nameRecalbox;
    #[MapName('nom_retropie')]
    public string $nameRetropie;
    #[MapName('nom_launchbox')]
    public string $nameLaunchbox;
    #[MapName('nom_hyperspin')]
    public string $nameHyperspin;
    #[MapName('noms_commun')]
    public string $commonNames;
}
