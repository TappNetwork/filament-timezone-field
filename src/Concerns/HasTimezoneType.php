<?php

namespace Tapp\FilamentTimezoneField\Concerns;

trait HasTimezoneType
{
    protected string | null $timezoneType = null;

    protected array $allowedTimezoneTypes = [
        'UTC',
        'GMT',
    ];

    public function timezoneType(string | null $type): static
    {
        $this->timezoneType = strtoupper($type);

        return $this;
    }

    public function getTimezoneType(): string
    {
        if ($this->timezoneType === null && !in_array($this->timezoneType, $this->allowedTimezoneTypes)) {
            $this->timezoneType = 'UTC';
        }

        return $this->timezoneType;
    }
}
