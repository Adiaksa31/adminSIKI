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
        class_alias(\App\Helpers\PermissionHelper::class, 'PermissionHelper');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \App\Helpers\PermissionHelper::init();
    }
}
