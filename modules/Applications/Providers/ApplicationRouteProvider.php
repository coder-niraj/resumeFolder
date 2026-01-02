<?php

namespace Modules\Applications\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class ApplicationRouteProvider extends ServiceProvider
{
    public function boot(): void
    {
        Route::middleware('web')
            ->prefix('application')
            ->group(__DIR__ . '/../Routes/web.php');
    }
}
