<?php

use Illuminate\Support\Facades\Route;
use Modules\Jobs\Controllers\JobController;

Route::middleware('employee.auth')->group(function () {
    Route::get('/post', [JobController::class, 'jobPostFromView'])->name('post');
    Route::post('/create', [JobController::class, 'createJobPost'])->name('create');
    Route::get('/list', [JobController::class, 'jobList'])->name('list');
    Route::get('/application-list/{jobId}', [JobController::class, 'jobApplications'])->name('applications');
    Route::get('/application/{jobId}', [JobController::class, 'jobApplicationsListView'])->name('application.view');
    Route::get('/post/update/{id}', [JobController::class, 'jobPostUpdateFromView'])->name('update');
    Route::post('/post/delete', [JobController::class, 'deleteJob'])->name('delete');
    Route::post('/post/toggle', [JobController::class, 'toggleActiveJobPost'])->name('toggle');
    Route::get('/get-list', [JobController::class, 'jobPostListView'])->name('list.view');
    Route::get('/resume/{resume}', [JobController::class, 'view'])
        ->name('resume.view');
    Route::get('/cover-letter/{id}', [JobController::class, 'show'])->name('cover.view');
    Route::post('/post/update', [JobController::class, 'updateJobForm'])->name('update.form');
    Route::post('/status/update', [JobController::class, 'changeApplicationStatus'])->name('update-status');
});
