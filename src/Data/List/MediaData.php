<?php

declare(strict_types=1);

namespace ScreenScraper\Data\List;

use ScreenScraper\Data;

final class MediaData extends Data
{
    public string $type;
    public ?string $parent;
    public string $url;
    public ?string $region;
    public ?string $support;
    public string $crc;
    public string $md5;
    public string $sha1;
    public ?string $size;
    public string $format;
}
