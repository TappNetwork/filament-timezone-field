<?php

namespace Tapp\FilamentTimezoneField;

use Spatie\LaravelPackageTools\PackageServiceProvider;
use Spatie\LaravelPackageTools\Package;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Assets\Js;

class FilamentTimezoneFieldServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filament-timezone-field')
            ->hasViews();
    }

    public function packageBooted()
    {
        FilamentAsset::register([
            Js::make('filament-timezone-field', __DIR__ . '/../dist/filament-timezone-field.js'),
        ], 'tapp/filament-timezone-field');
    }
}
