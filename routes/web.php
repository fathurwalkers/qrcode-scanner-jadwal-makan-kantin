<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Livewire\Home\Index as HomeIndex;


Route::group(['prefix' => '/'], function () {
    // Index Route
    Route::get('/', HomeIndex::class, 'index')->name('home');
});

Route::get('/test-qr', [GenerateController::class, 'test_qr'])->name('test-qr');
Route::post('/proses-test-qr', [GenerateController::class, 'proses_test_qr'])->name('proses-test-qr');

Route::get('/generate-data', [GenerateController::class, 'generate_data'])->name('generate-data');
Route::get('/generate-qr', [GenerateController::class, 'generate_qr'])->name('generate-qr');
