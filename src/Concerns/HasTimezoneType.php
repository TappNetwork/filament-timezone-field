<?php

namespace Tapp\FilamentTimezoneField\Concerns;

trait HasTimezoneType
{
    protected ?string $timezoneType = null;

    protected array $allowedTimezoneTypes = [
        'UTC',
        'GMT',
    ];

    public function timezoneType(?string $type): static
    {
        $this->timezoneType = strtoupper($type);

        return $this;
    }

    public function getTimezoneType(): string
    {
        if ($this->timezoneType === null && ! in_array($this->timezoneType, $this->allowedTimezoneTypes)) {
            $this->timezoneType = 'UTC';
        }

        return $this->timezoneType;
    }
}
