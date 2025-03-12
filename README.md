# Filament Timezone Field

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tapp/filament-timezone-field.svg?style=flat-square)](https://packagist.org/packages/tapp/filament-timezone-field)
![Code Style Action Status](https://github.com/TappNetwork/filament-timezone-field/actions/workflows/pint.yml/badge.svg)
[![Total Downloads](https://img.shields.io/packagist/dt/tapp/filament-timezone-field.svg?style=flat-square)](https://packagist.org/packages/tapp/filament-timezone-field)

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

##### List timezones by country

To list only the timezones for a country, you can pass the country code to `->byCountry()` method. For example, to list only United States timezones:

```php
TimezoneSelect::make('timezone')
    ->byCountry('US')
```

You can also pass an array with more than one country code:

```php
TimezoneSelect::make('timezone')
    ->byCountry(['US', 'AU'])
```

##### List timezones by region

To list the timezones for a region use the `->byRegion()` method. You can specify a region with a [Region enum value](src/Enums/Region.php):

```php
use Tapp\FilamentTimezoneField\Enums\Region;

TimezoneSelect::make('timezone')
    ->byRegion(Region::Australia)
```

or you can use one of the [PHP's DateTimeZone predifined constants](https://www.php.net/manual/en/class.datetimezone.php):

```php
use DateTimeZone;

TimezoneSelect::make('timezone')
    ->byRegion(DateTimeZone::AUSTRALIA)
```

It's also possible to pass an array with more than one region:

```php
use Tapp\FilamentTimezoneField\Enums\Region;

TimezoneSelect::make('timezone')
    ->byRegion([Region::Australia, Region::America])
```

> [!TIP]
> All [Filament select field](https://filamentphp.com/docs/2.x/forms/fields#select) methods are available to use:
> 
> ```php
> use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;
>
> public static function form(Form $form): Form
> {
>    return $form
>        ->schema([
>            // ...
>            TimezoneSelect::make('timezone')
>                ->searchable()
>                ->required(),
>            // ...
>        ]);
> }
> ```

Optionally, hide either timezone offsets or timezone names, depending on your use case:

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

Optionally, hydrate the field with the timezone from the user's browser. If there is already a value, it will not be overridden.

```php
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;

public static function form(Form $form): Form
{
    return $form
        ->schema([
            // ...
            TimezoneSelect::make('timezone')
                ->getTimezoneFromBrowser()
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
