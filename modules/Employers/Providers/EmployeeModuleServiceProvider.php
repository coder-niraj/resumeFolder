<?php

namespace Modules\Employers\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Employers\Providers\EmployeeModuleRouteProvider;

class EmployeeModuleServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(EmployeeModuleRouteProvider::class);
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../Views', 'employee');
    }
}
