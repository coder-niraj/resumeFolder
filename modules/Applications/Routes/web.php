<?php

use Illuminate\Support\Facades\Route;
use Modules\Applications\Controllers\ApplicationController;

Route::middleware('user.auth')->name('application.')->group(function () {
    Route::get("/apllication-form/{jobId}", [ApplicationController::class, 'applicationFormView'])->name('form');
    Route::get("/apllication-edit", [ApplicationController::class, 'applicationEditFormView'])->name('edit-form');
    Route::get("/apllication-list", [ApplicationController::class, 'applicationListView'])->name('list');
    Route::get("/apllications", [ApplicationController::class, 'applicationLists'])->name('applications');
    Route::post("/create", [ApplicationController::class, 'createApplication'])->name('create');
    Route::get('/resume/{resume}', [ApplicationController::class, 'view'])
        ->name('resume.view');
    Route::get('/cover-letter/{id}', [ApplicationController::class, 'show'])->name('cover.view');
});
