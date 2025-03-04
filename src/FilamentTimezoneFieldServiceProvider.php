<?php

namespace Tapp\FilamentTimezoneField;

use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            Js::make('filament-timezone-field', __DIR__.'/../dist/filament-timezone-field.js'),
        ], 'tapp/filament-timezone-field');
    }
}
