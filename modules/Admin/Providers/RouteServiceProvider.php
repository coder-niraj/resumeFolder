<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    protected $moduleNamespace = 'Modules\Admin\Controllers';
    public function boot(): void
    {
        Route::middleware('web')
            ->prefix('admin')
            ->group(__DIR__ . '/../Routes/web.php');
    }
    // Module provider code here
}
