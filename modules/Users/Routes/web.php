<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\Controllers\UserController;

Route::middleware('user.auth')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboardView'])->name('dashboard');
    // Route::get('/jobs', [UserController::class, 'jobsView'])->name('jobs');
    Route::get('/jobs', [UserController::class, 'jobSearch'])->name('jobs');
    Route::get('/saved-jobs', [UserController::class, 'savedJobsView'])->name('saved');
    Route::get('/application-list', [UserController::class, 'applicationListView'])->name('application-list');
    Route::get('/profile', [UserController::class, 'profileView'])->name('profile');
    Route::get('/password', [UserController::class, 'passwordChangeView'])->name('password');
    Route::post('/password', [UserController::class, 'changePassword'])->name('change');
    Route::post('/profile-update', [UserController::class, 'profileUpdate'])->name('update');
    Route::post('/toggle-save-job/{jobId}', [UserController::class, 'toggleSavedJob'])->name('toggle');
});
