<?php

namespace Modules\Jobs\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class JobsModuleRouteProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::middleware('web')
            ->prefix('jobs')
            ->group(__DIR__ . '/../Routes/web.php');
    }
}
