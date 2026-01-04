<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Controllers\AdminController;

Route::get('/test', function () {
    return 'ADMIN MODULE WORKS';
});
Route::middleware('admin.guest')->group(function () {
    Route::post('/login',[AdminController::class,'login'])->name('admin.login.api');
    Route::get('/login',[AdminController::class,'index'])->name('admin.login.view');
    
});
Route::middleware('admin.auth')->group(function () {
Route::get('/dashboard', function () { 
    return view('admin::admin.dashboard');
})->name(name: 'admin.dashboard');
});

    