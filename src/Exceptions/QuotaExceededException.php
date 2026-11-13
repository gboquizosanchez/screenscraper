<?php

declare(strict_types=1);

namespace ScreenScraper\Exceptions;

use Exception;
use ScreenScraper\Enums\QuotaType;

final class QuotaExceededException extends Exception implements ScreenScraperException
{
    public function __construct(
        string $message,
        public readonly QuotaType $type,
    ) {
        parent::__construct($message, $type->value);
    }
}
