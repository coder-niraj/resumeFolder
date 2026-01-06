<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Controllers\AdminController;

// Route::get('/test', function () {
//     return 'ADMIN MODULE WORKS';
// });
Route::middleware('admin.guest')->name('admin.')->group(function () {
    Route::post('/login', [AdminController::class, 'login'])->name('login');
    Route::get('/login', [AdminController::class, 'index'])->name('login.view');
});
Route::middleware('admin.auth')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboardView'])->name(name: 'dashboard');
    Route::get('/employees', [AdminController::class, 'employeesView'])->name(name: 'employees');
    Route::get('/change-password', [AdminController::class, 'changePasswordView'])->name(name: 'password');
    Route::get('/users', [AdminController::class, 'usersView'])->name(name: 'users');
    Route::get('/employees/data', [AdminController::class, 'employeesData'])->name('employees.data');
    Route::get('/users/data', [AdminController::class, 'usersData'])->name('users.data');
    Route::get('/jobs', [AdminController::class, 'jobsView'])->name(name: 'jobs');
    Route::get('/profile', [AdminController::class, 'profileView'])->name(name: 'profile');
    Route::get('/logout', [AdminController::class, 'logout'])->name(name: 'logout');
    Route::post('/update', [AdminController::class, 'updateAdminProfile'])->name(name: 'update');
    Route::post('/change-password', [AdminController::class, 'updatePassword'])->name(name: 'change-password');
    Route::post('/toggle/employee', [AdminController::class, 'toggleEmployeeStatus'])->name(name: 'toggle.employee');
    Route::post('/toggle/user', [AdminController::class, 'toggleUserStatus'])->name(name: 'toggle.user');
});
