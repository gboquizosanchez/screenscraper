<?php

declare(strict_types=1);

namespace ScreenScraper\Data\User;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class ScreenScraperUserData extends Data
{
    #[MapName('ssuser')]
    public UserData $user;
}
