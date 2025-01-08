<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/home'], function () {

    // Home Route
    Route::get('/', [HomeController::class, 'index'])->name('home');

});

Route::group(['prefix' => '/dashboard'], function () {

    // Index Route
    Route::get('/', [DashboardController::class, 'index'])->name('home');

});
Route::get('/test-qr', [GenerateController::class, 'test_qr'])->name('test-qr');
Route::post('/proses-test-qr', [GenerateController::class, 'proses_test_qr'])->name('proses-test-qr');

Route::get('/generate-data', [GenerateController::class, 'generate_data'])->name('generate-data');
Route::get('/generate-qr', [GenerateController::class, 'generate_qr'])->name('generate-qr');
