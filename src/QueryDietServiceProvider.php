<?php

namespace Cbdt\QueryDiet;

use Cbdt\QueryDiet\Middleware\InjectQueryDiet;
use Illuminate\Contracts\Http\Kernel;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class QueryDietServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('query-diet')
            ->hasConfigFile();

    }

    public function boot()
    {
        parent::boot();

        $kernel = $this->app[Kernel::class];
        $kernel->pushMiddleware(InjectQueryDiet::class);
    }
}
