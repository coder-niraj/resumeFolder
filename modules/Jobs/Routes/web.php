<?php

use Illuminate\Support\Facades\Route;


Route::middleware('employee.auth')->group(function () {
    Route::get('/get', function () {
        return "a";
    })->name('get');
    Route::get('/post', function () {
        return view('jobs::jobs.job-list');
    })->name('post');
});
