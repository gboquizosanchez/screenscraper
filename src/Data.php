<?php

declare(strict_types=1);

namespace ScreenScraper;

use Spatie\LaravelData\Data as SpatieData;
use Spatie\LaravelData\Support\Transformation\TransformationContextFactory;

abstract class Data extends SpatieData
{
    /**
     * @return array<string, mixed>
     */
    public function transformed(): array
    {
        $transformationContext = TransformationContextFactory::create()
            ->withoutPropertyNameMapping();

        return $this->transform($transformationContext);
    }
}
