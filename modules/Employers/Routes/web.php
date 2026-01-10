<?php

use Illuminate\Support\Facades\Route;
use Modules\Employers\Controllers\EmployeeController;

Route::middleware('employee.auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('employee::employee.dashboard');
    })->name('dashboard');
    Route::get('/profile', [EmployeeController::class, 'profileView'])->name('profile');

    Route::get('/change-password', [EmployeeController::class, 'changePasswordView'])->name('password');
    Route::post('/change-password', [EmployeeController::class, 'changePassword'])->name('change-password');
    Route::post('/update', [EmployeeController::class, 'updateProfile'])->name('update');
    Route::get('/logout', [EmployeeController::class, 'logout'])->name('logout');
});
