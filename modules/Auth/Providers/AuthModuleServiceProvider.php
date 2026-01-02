<?php

namespace Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;


class AuthModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(AuthModuleRouteProvider::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/Views', 'auth');
    }
}
