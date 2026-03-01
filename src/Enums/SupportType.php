<?php

declare(strict_types=1);

namespace ScreenScraper\Enums;

enum SupportType: string
{
    case BlueRay = 'Bluray';
    case Card = 'carte';
    case Cartridge = 'cartouche';
    case CartridgeCd = 'cartouche-cd';
    case CartridgeDownload = 'cartouche-download';
    case CartridgeCassette = 'cartouche-k7';
    case CartridgeCassetteDiskette = 'cartouche-k7-disquette';
    case Cd = 'cd';
    case CdDiskette = 'cd-disquette';
    case Diskette = 'disquette';
    case Download = 'download';
    case Hardware = 'hardware';
    case Cassette = 'k7';
    case CassetteDiskette = 'k7-disquette';
    case NotApplicable = 'non-applicable';
    case Pcb = 'pcb';
    case Smc = 'smc';
    case Videotape = 'videotape';
    case Web = 'web';
}
