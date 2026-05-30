<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $helperPath = app_path('Support/helpers.php');

        if (file_exists($helperPath)) {
            require_once $helperPath;
        }
    }
}
