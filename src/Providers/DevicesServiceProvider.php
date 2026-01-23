<?php

namespace Dpb\Package\Devices\Providers;

use Illuminate\Support\Facades\Artisan;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class DevicesServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('pkg-devices')
            ->hasConfigFile()
            ->hasMigrations([
                '2025_01_01_080001_create_devices_tables',
            ])
            ->runsMigrations()
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile();
            });
    }    
}
