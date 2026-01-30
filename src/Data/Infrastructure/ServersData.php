<?php

namespace ScreenScraper\Data\Infrastructure;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;

final class ServersData extends Data
{
    // CPU usage (strings from API)
    #[MapName('cpu1')]
    public string $cpu1;
    #[MapName('cpu2')]
    public string $cpu2;
    #[MapName('cpu3')]
    public string $cpu3;
    #[MapName('cpu4')]
    public string $cpu4;

    // Access counters
    #[MapName('threadsmin')]
    public int $threadsMin;
    #[MapName('nbscrapeurs')]
    public int $nbScrapers;
    #[MapName('apiacces')]
    public int $apiAccess;

    // API status flags
    #[MapName('closefornomember')]
    public bool $closeForNoMember;
    #[MapName('closeforleecher')]
    public bool $closeForLeecher;

    // Thread limits
    #[MapName('maxthreadfornonmember')]
    public int $maxThreadForNonMember;
    #[MapName('threadfornonmember')]
    public int $threadForNonMember;
    #[MapName('maxthreadformember')]
    public int $maxThreadForMember;
    #[MapName('threadformember')]
    public int $threadForMember;
}
