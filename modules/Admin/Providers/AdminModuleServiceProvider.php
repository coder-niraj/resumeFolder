<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;

class AdminModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'admin');
    }
}

// $this->mergeConfigFrom(
//     __DIR__ . '/Config/config.php',
//     'admin'
// );

// $this->publishes([
//     __DIR__ . '/Config/config.php' => config_path('admin.php'),
// ], 'admin-config');