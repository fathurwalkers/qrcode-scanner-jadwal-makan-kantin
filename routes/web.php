<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CekLogin;
use App\Http\Middleware\HandleServerError;
use App\Livewire\Home\Index as HomeIndex;
use App\Livewire\HomeIndexTest as HomeTest;
use App\Livewire\Dashboard\Index as DashboardIndex;
use App\Livewire\Dashboard\Jadwal\Index as DashboardJadwalIndex;
use App\Livewire\Dashboard\Karyawan\Index as DashboardKaryawanIndex;
use App\Livewire\Dashboard\Karyawan\TambahKaryawan as DashboardTambahKaryawan;

Route::group(['prefix' => '/'], function () {
    // Index Route
    Route::get('/', HomeIndex::class, 'index')->name('home');
    Route::get('/home-test', HomeTest::class, 'index')->name('home-test');
});

Route::group(['prefix' => '/dashboard', 'middleware' => [CekLogin::class, HandleServerError::class]], function () {
    // Index Route
    // [ GET ]
    Route::get('/', DashboardIndex::class, 'index')->name('dashboard');
    Route::get('/jadwal', DashboardJadwalIndex::class, 'index')->name('dashboard-jadwal');
    Route::get('/data-karyawan', DashboardKaryawanIndex::class, 'index')->name('dashboard-data-karyawan');
    Route::get('/tambah-data-karyawan', DashboardTambahKaryawan::class)->name('dashboard-tambah-data-karyawan');

    // [ POST ]
    Route::post('/edit-user', [DashboardController::class, 'edit_user'])->name('edit-user');
    Route::post('/hapus-user', [DashboardController::class, 'hapus_user'])->name('hapus-user');
    Route::post('/print-jadwal', [DashboardController::class, 'print_jadwal'])->name('print-jadwal');
    Route::post('/post-buat-user', [DashboardController::class, 'post_buat_user'])->name('post-buat-user');
    Route::post('/import-absensi', [DashboardController::class, 'import'])->name('import-absensi');
});

Route::get('/login', [BackController::class, 'login'])->name('login');
Route::post('/post-login', [BackController::class, 'post_login'])->name('post-login');
Route::post('/logout', [BackController::class, 'logout'])->name('logout');

Route::get('/test-qr', [GenerateController::class, 'test_qr'])->name('test-qr');
Route::post('/proses-test-qr', [GenerateController::class, 'proses_test_qr'])->name('proses-test-qr');

// Route::get('/generate-data', [GenerateController::class, 'generate_data'])->name('generate-data');
Route::get('/generate-qr', [GenerateController::class, 'generate_qr'])->name('generate-qr');
Route::get('/generate-unique-id', [GenerateController::class, 'generate_unique_id'])->name('generate-unique-id');
Route::get('/generate-login', [GenerateController::class, 'generate_login'])->name('generate-login');
Route::get('/generate-jadwal', [GenerateController::class, 'generate_jadwal'])->name('generate-jadwal');
