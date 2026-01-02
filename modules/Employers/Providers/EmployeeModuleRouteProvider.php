<?php

namespace Modules\Employers\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class EmployeeModuleRouteProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::middleware('web')
            ->prefix('employee')
            ->group(__DIR__ . '/../Routes/web.php');
    }
}
