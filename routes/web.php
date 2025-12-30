<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminPendudukController;
use App\Http\Controllers\AdminAntrianController;
use App\Http\Controllers\WargaProfilController;
use App\Http\Controllers\WargaAntrianController;


Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/penduduk', [AdminPendudukController::class, 'index']);
        Route::get('/penduduk/{id}', [AdminPendudukController::class, 'show']);
        Route::get('/penduduk/{id}/edit', [AdminPendudukController::class, 'edit']);
        Route::put('/penduduk/{id}', [AdminPendudukController::class, 'update']);
        Route::post('/penduduk/{id}/status', [AdminPendudukController::class, 'updateStatus']);
        Route::get('/antrian', [AdminAntrianController::class, 'index']);
        Route::post('/antrian/{id}/proses', [AdminAntrianController::class, 'proses']);
        Route::post('/antrian/{id}/selesai', [AdminAntrianController::class, 'selesai']);
        Route::get('/antrian/riwayat', [AdminAntrianController::class, 'riwayat']);
    });

    Route::middleware('role:warga')->prefix('warga')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'warga']);
        Route::get('/profil', [WargaProfilController::class, 'index']);
        Route::get('/antrian', [WargaAntrianController::class, 'index']);
        Route::post('/antrian', [WargaAntrianController::class, 'ambil']);
        Route::get('/antrian/riwayat', [WargaAntrianController::class, 'riwayat']);
    });

});
