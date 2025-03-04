<?php

namespace Tapp\FilamentTimezoneField\Forms\Components;

use Filament\Forms\Components\Select;
use Tapp\FilamentTimezoneField\Concerns\CanFormatTimezone;
use Tapp\FilamentTimezoneField\Concerns\HasDisplayOptions;
use Tapp\FilamentTimezoneField\Concerns\HasTimezoneOptions;
use Tapp\FilamentTimezoneField\Concerns\HasTimezoneType;

class TimezoneSelect extends Select
{
    use CanFormatTimezone;
    use HasDisplayOptions;
    use HasTimezoneOptions;
    use HasTimezoneType;

    public function getTimezoneFromBrowser(): static
    {
        $this->afterStateHydrated(function ($livewire) {
            $id = $this->getId();
            $livewire->js("setTimezoneFromBrowser('{$id}')");
        });

        return $this;
    }
}
