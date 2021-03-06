<?php

namespace Tapp\FilamentTimezoneField\Forms\Components;

use Filament\Forms\Components\Select;
use Tapp\FilamentTimezoneField\Concerns\CanFormatTimezone;
use Tapp\FilamentTimezoneField\Concerns\HasTimezoneOptions;
use Tapp\FilamentTimezoneField\Concerns\HasTimezoneType;

class TimezoneSelect extends Select
{
    use CanFormatTimezone;
    use HasTimezoneOptions;
    use HasTimezoneType;

    protected string $view = 'forms::components.select';
}
