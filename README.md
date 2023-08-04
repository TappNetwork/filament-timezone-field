# Filament Timezone Field

A timezone select field for Laravel Filament.

## Installation

```bash
composer require tapp/filament-timezone-field:"^2.0"
```

## Usage

### Form Field

Add to your Filament resource:

```php
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;

public static function form(Form $form): Form
{
    return $form
        ->schema([
            // ...
            TimezoneSelect::make('timezone'),
            // ...
        ]);
}
```

#### Appareance

![Filament Timezone Field](https://raw.githubusercontent.com/TappNetwork/filament-timezone-field/main/docs/filament-timezone-field.png)

#### Options

To use GMT instead of UTC (default is UTC), add the `->timezoneType('GMT')` method:

```php
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;

public static function form(Form $form): Form
{
    return $form
        ->schema([
            // ...
            TimezoneSelect::make('timezone')
                ->timezoneType('GMT'),
            // ...
        ]);
}
```

All [Filament select field](https://filamentphp.com/docs/2.x/forms/fields#select) methods are available to use:

```php
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;

public static function form(Form $form): Form
{
    return $form
        ->schema([
            // ...
            TimezoneSelect::make('timezone')
                ->searchable()
                ->required(),
            // ...
        ]);
}
```

### Table Column

```php
use Tapp\FilamentTimezoneField\Tables\Columns\TimezoneColumn;

public static function table(Table $table): Table
{
    return $table
        ->columns([
            //...
            TimezoneColumn::make('timezone')
                ->timezoneType('GMT')
                ->formattedOffsetAndTimezone(),
        ])
        // ...
}
```

#### Options

| Method | Description |
| --- | --- |
| ->formattedTimezone()  | Show formatted timezone name |
| ->formattedOffsetAndTimezone() | Show formatted offset and timezone name |
| ->timezoneType('GMT') | Use GMT instead of UTC  |

### Table Filter

```php
use Tapp\FilamentTimezoneField\Tables\Filters\TimezoneSelectFilter;

public static function table(Table $table): Table
{
    return $table
        //...
        ->filters([
            TimezoneSelectFilter::make('timezone'),
            // ...
        ])
}
```
