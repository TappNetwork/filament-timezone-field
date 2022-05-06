# Filament Timezone Field

A timezone select field for Laravel Filament.

## Installation

```bash
composer require tapp/filament-timezone-field
```

## Usage

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

### Appareance

![Filament Timezone Field](https://raw.githubusercontent.com/TappNetwork/filament-timezone-field/main/docs/filament-timezone-field.png)

### Options

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

All Filament select field methods are available to use:

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
