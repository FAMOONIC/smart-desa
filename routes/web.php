<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminPendudukController;
use App\Http\Controllers\WargaProfilController;

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
        Route::get('/dashboard', [DashboardController::class, 'admin']);
        Route::get('/penduduk', [AdminPendudukController::class, 'index']);
        Route::post('/penduduk/{id}/status', [AdminPendudukController::class, 'updateStatus']);
    });

    Route::middleware('role:warga')->prefix('warga')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'warga']);
        Route::get('/profil', [WargaProfilController::class, 'index']);
    });

});
