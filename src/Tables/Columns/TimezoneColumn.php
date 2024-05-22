<?php

namespace Tapp\FilamentTimezoneField\Tables\Columns;

use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Tapp\FilamentTimezoneField\Concerns\CanFormatTimezone;
use Tapp\FilamentTimezoneField\Concerns\HasTimezoneType;

class TimezoneColumn extends TextColumn
{
    use CanFormatTimezone;
    use HasTimezoneType;

    public function formattedTimezone(): static
    {
        $this->defaultState = $this->formatStateUsing(static function (Column $column, $state): ?string {
            if ($state instanceof \Tapp\FilamentTimezoneField\Tables\Columns\TimezoneColumn) {
                return '';
            }

            return $column->getFormattedTimezoneName($state);
        });

        return $this;
    }

    public function formattedOffsetAndTimezone(): static
    {
        $this->defaultState = $this->formatStateUsing(static function (Column $column, $state): ?string {
            if ($state instanceof \Tapp\FilamentTimezoneField\Tables\Columns\TimezoneColumn) {
                return '';
            }

            $offset = $column->getOffset($state);

            return $column->getFormattedOffsetAndTimezone($offset, $state);
        });

        return $this;
    }
}
