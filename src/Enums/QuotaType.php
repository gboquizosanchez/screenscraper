<?php

declare(strict_types=1);

namespace ScreenScraper\Enums;

enum QuotaType: int
{
    /** The threads (or threads per minute) allowed to the account are already in use. */
    case Threads = 429;

    /** The scrape quota of the day is exhausted. */
    case DailyQuota = 430;

    /** Too many unrecognized ROMs were scraped today. */
    case DailyFailures = 431;
}
