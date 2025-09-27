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
                '0001_create_devices_tables',
            ])
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->startWith(function(InstallCommand $command) {
                        $command->info('Installing pkg-eav first...');
                        $command->call('pkg-eav:install');
                    })
                    ->publishMigrations()
                    ->publishConfigFile()
                    ->askToRunMigrations();
            });
    }    
}
