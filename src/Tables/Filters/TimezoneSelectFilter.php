<?php

namespace Tapp\FilamentTimezoneField\Tables\Filters;

use Filament\Tables\Filters\SelectFilter;
use Tapp\FilamentTimezoneField\Concerns\CanFormatTimezone;
use Tapp\FilamentTimezoneField\Concerns\HasTimezoneOptions;
use Tapp\FilamentTimezoneField\Concerns\HasTimezoneType;

class TimezoneSelectFilter extends SelectFilter
{
    use CanFormatTimezone;
    use HasTimezoneOptions;
    use HasTimezoneType;
}
