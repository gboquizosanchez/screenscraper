<?php

declare(strict_types=1);

namespace ScreenScraper\Data;

use SensitiveParameter;

final readonly class AuthData
{
    public function __construct(
        public string $devId,
        #[SensitiveParameter]
        public string $devPassword,
        public string $softwareName,
        public string $output = 'json',
        public ?string $id = null,
        #[SensitiveParameter]
        public ?string $password = null,
    ) {}

    /**
     * @return array<string, string>
     */
    public function credentials(): array
    {
        return array_filter([
            'devid' => $this->devId,
            'devpassword' => $this->devPassword,
            'softname' => $this->softwareName,
            'output' => $this->output,
            'ssid' => $this->id,
            'sspassword' => $this->password,
        ]);
    }
}
