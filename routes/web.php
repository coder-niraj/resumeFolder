<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\TwoFactor;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::get('/', function () {
    return view('welcome');
})->name('home');
$modules = [
    'Admin' => [
        'prefix' => 'admin',
        'middleware' => ['web'],
    ],

    'Applications' => [
        'prefix' => 'users',
        'middleware' => ['web'],
    ],
    'Auth' => [
        'prefix' => 'users',
        'middleware' => ['web'],
    ],
    'Employers' => [
        'prefix' => 'users',
        'middleware' => ['web'],
    ],
    'Jobs' => [
        'prefix' => 'users',
        'middleware' => ['web'],
    ],
    'Users' => [
        'prefix' => 'users',
        'middleware' => ['web'],
    ],
];

foreach ($modules as $module => $config) {
    $routesFile = base_path("modules/{$module}/Routes/web.php");
    if (! file_exists($routesFile)) {
        continue;
    }

    Route::middleware($config['middleware'])
        ->prefix($config['prefix'])
        ->group($routesFile);
}
