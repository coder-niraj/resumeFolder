<?php

namespace Modules\Applications\Providers;

use Illuminate\Support\ServiceProvider;

class ApplicationModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(ApplicationRouteProvider::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Views', 'application');
    }
}
