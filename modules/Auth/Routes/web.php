<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Controllers\AuthController;



Route::middleware('user.guest')->prefix('user')->name('user.')->group(function () {
    Route::get('/login', [AuthController::class, 'loginView'])
        ->name('login.view');
    Route::get('/register', [AuthController::class, 'registerView'])
        ->name('register.view');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login');
    Route::post('/register', [AuthController::class, 'register'])
        ->name('register');
});

Route::middleware('user.auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/test', function () {
        return 'Auth MODULE WORKS';
    })->name('dashboard');
});
Route::middleware('employee.guest')->prefix('employee')->name('employee.')->group(function () {
    Route::get('/login', [AuthController::class, 'employeeLoginView'])
        ->name('login.view');
    Route::get('/register', [AuthController::class, 'employeeRegisterView'])
        ->name('register.view');
    Route::post('/login', [AuthController::class, 'employeeLogin'])
        ->name('login');
    Route::post('/register', [AuthController::class, 'employeeRegister'])
        ->name('register');
});


Route::get('/non-authorized', function () {
    return view("auth::auth.notAuthorized");
})->name('non-authorized');
