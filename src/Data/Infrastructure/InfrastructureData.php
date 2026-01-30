<?php

declare(strict_types=1);

namespace ScreenScraper\Data\Infrastructure;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class InfrastructureData extends Data
{
    #[MapName('serveurs')]
    public ServersData $servers;
}
