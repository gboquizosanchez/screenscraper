<?php

declare(strict_types=1);

namespace ScreenScraper\Data\User;

use ScreenScraper\Data;
use Spatie\LaravelData\Attributes\MapName;

final class UserData extends Data
{
    // Identity
    #[MapName('id')]
    public string $name;
    #[MapName('numid')]
    public int $id;
    #[MapName('niveau')]
    public int $level;

    // Contributions
    #[MapName('contribution')]
    public int $contribution;
    #[MapName('uploadsysteme')]
    public int $uploadedSystems;
    #[MapName('uploadinfos')]
    public int $uploadedInfos;
    #[MapName('romasso')]
    public int $associatedRoms;
    #[MapName('uploadmedia')]
    public int $uploadedMedia;
    #[MapName('propositionok')]
    public int $acceptedProposals;
    #[MapName('propositionko')]
    public int $rejectedProposals;

    // Quotas & limits
    #[MapName('quotarefu')]
    public float $quotaRefused;
    #[MapName('maxthreads')]
    public int $maxThreads;
    #[MapName('maxdownloadspeed')]
    public int $maxDownloadSpeed;

    // Requests
    #[MapName('requeststoday')]
    public int $requestsToday;
    #[MapName('requestskotoday')]
    public int $failedRequestsToday;
    #[MapName('maxrequestspermin')]
    public int $maxRequestsPerMinute;
    #[MapName('maxrequestsperday')]
    public int $maxRequestsPerDay;
    #[MapName('maxrequestskoperday')]
    public int $maxFailedRequestsPerDay;

    // Activity
    #[MapName('visites')]
    public int $visits;
    #[MapName('datedernierevisite')]
    public string $lastVisitAt;
    #[MapName('favregion')]
    public string $favoriteRegion;
}
