<?php

namespace Tapp\FilamentTimezoneField\Concerns;

trait HasDisplayOptions
{
    protected bool $displayOffset = true;
    protected bool $displayNames = true;

    public function hideOffset(): static
    {
        $this->displayOffset = false;
        $this->displayNames = true;

        return $this;
    }

    public function hideNames(): static
    {
        $this->displayOffset = true;
        $this->displayNames = false;

        return $this;
    }

    public function getDisplayOffset(): bool
    {
        return $this->displayOffset;
    }

    public function getDisplayNames(): bool
    {
        return $this->displayNames;
    }
}
