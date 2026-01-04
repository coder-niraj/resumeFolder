<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Modules\Admin\Controllers\AdminAuthMiddleware;
use Modules\Admin\Controllers\AdminGuestMiddleware;
use Modules\Auth\Controllers\EmployeeAuthMiddleware;
use Modules\Auth\Controllers\EmployeeGuestMiddleware;
use Modules\Auth\Controllers\UserAuthMiddleware;
use Modules\Auth\Controllers\UserGuestMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
        'admin.auth' => AdminAuthMiddleware::class,
        'admin.guest' => AdminGuestMiddleware::class,
        'user.auth' => UserAuthMiddleware::class,
        'user.guest' => UserGuestMiddleware::class,
        'employee.auth' => EmployeeAuthMiddleware::class,
        'employee.guest' => EmployeeGuestMiddleware::class,
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
