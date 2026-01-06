<?php

namespace Modules\Jobs\Providers;

use Illuminate\Support\ServiceProvider;

class JobsModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(JobsModuleRouteProvider::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Views', 'jobs');
    }
}
