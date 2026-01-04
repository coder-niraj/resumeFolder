<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\AuthController;

// Route::get('/test', function () {
//     return 'Auth MODULE WORKS';
// });
Route::middleware( 'user.guest')->group(function () {
Route::get('/login', [AuthController::class,'loginView'])->name('user.login.view');
Route::get('/register',[AuthController::class,'registerView'] )->name('user.register.view');
Route::post('/login', [AuthController::class,'login'])->name('auth.login.api');
Route::post('/register', [AuthController::class,'register'])->name('auth.register.api');
});

Route::middleware('user.auth')->group(function () {
Route::get('/test', function () {
    return 'Auth MODULE WORKS';
})->name('user.dashboard');
});