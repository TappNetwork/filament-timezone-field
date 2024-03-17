# Filament Timezone Field

A timezone select field for Laravel Filament.

## Installation

```bash
composer require tapp/filament-timezone-field:"^3.0"
```

> **Note** 
> For **Filament 2.x** check the **[2.x](https://github.com/TappNetwork/filament-timezone-field/tree/2.x)** branch

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

Optionally hide either timezone offsets or timezone names, depending on your use case:

![Filament Timezone Display Options](https://raw.githubusercontent.com/TappNetwork/filament-timezone-field/main/docs/hide-timezone-offset.png)

```php
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;

public static function form(Form $form): Form
{
    return $form
        ->schema([
            // ...
            TimezoneSelect::make('timezone')
                ->hideNames(),
            // ...
        ]);
}
```

```php
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;

public static function form(Form $form): Form
{
    return $form
        ->schema([
            // ...
            TimezoneSelect::make('timezone')
                ->hideOffset(),
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
