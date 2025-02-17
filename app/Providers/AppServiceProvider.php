<?php

namespace App\Providers;

use App\Weather;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Weather::class, function () {
            return new \App\Weather('demo');
        });

        // or
        //$this->app->singleton('weather', fn () => new \App\Weather('demo'));
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
