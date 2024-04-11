<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        Blade::anonymousComponentNamespace('dashboard.components', 'dashboard');
        Blade::anonymousComponentNamespace('auth.components', 'auth');
        Blade::anonymousComponentNamespace('app.components', 'app');

        Paginator::useBootstrapFive();
    }
}
