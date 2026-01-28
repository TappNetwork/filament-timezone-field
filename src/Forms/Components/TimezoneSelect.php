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

    protected function setUp(): void
    {
        parent::setUp();

        $this->options(fn () => $this->getOptions());
    }

    public function getTimezoneFromBrowser(): static
    {
        $this->afterStateHydrated(function ($livewire) {
            // Only set browser timezone if the field is empty
            if (blank($this->getState())) {
                $statePath = $this->getStatePath();
                $componentId = $livewire->getId();
                // Defer to next tick so the component is in Livewire's registry (avoids
                // "Component not found" on auth/SPA pages). Use Livewire.find(id) instead
                // of $wire so we never look up the component during the initial effect run.
                $livewire->js(
                    '(function () {'.
                    'var id = '.json_encode($componentId).';'.
                    'var statePath = '.json_encode($statePath).';'.
                    'var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;'.
                    'var run = function () {'.
                    '  var livewire = typeof Livewire !== "undefined" ? Livewire : window.Livewire;'.
                    '  var c = livewire && livewire.find(id);'.
                    '  if (c) c.set(statePath, timezone);'.
                    '};'.
                    'if (typeof queueMicrotask === "function") { queueMicrotask(run); } else { setTimeout(run, 0); }'.
                    '})();'
                );
            }
        });

        return $this;
    }
}
