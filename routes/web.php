<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/dashboard'], function () {

    // Index Route
    Route::get('/', [DashboardController::class, 'index'])->name('home');

});
