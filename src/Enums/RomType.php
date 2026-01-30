<?php

declare(strict_types=1);

namespace ScreenScraper\Enums;

enum RomType: string
{
    case Folder = 'dossier';
    case File = 'fichier';
    case Iso = 'iso';
    case Rom = 'rom';
}
