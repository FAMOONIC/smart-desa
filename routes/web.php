<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminPendudukController;
use App\Http\Controllers\AdminAntrianController;
use App\Http\Controllers\AdminArsipController;
use App\Http\Controllers\AdminPeraturanController;
use App\Http\Controllers\AdminSiskamlingController;
use App\Http\Controllers\AdminKegiatanSosialController;
use App\Http\Controllers\ProfilDesaController;

use App\Http\Controllers\WargaProfilController;
use App\Http\Controllers\WargaAntrianController;
use App\Http\Controllers\WargaArsipController;
use App\Http\Controllers\WargaPeraturanController;
use App\Http\Controllers\WargaSiskamlingController;
use App\Http\Controllers\WargaKegiatanSosialController;

use App\Http\Controllers\ArsipFileController;
use App\Http\Controllers\PeraturanPdfController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::middleware('guest')->group(function () {
    Route::get('/', fn () => redirect()->route('login'));

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:3,1');

    Route::get('/register', [AuthController::class, 'showRegister']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->middleware('throttle:5,1')->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->middleware('throttle:5,1')->name('password.update');
});

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
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

        Route::get('/arsip', [AdminArsipController::class, 'index']);
        Route::post('/arsip', [AdminArsipController::class, 'store']);
        Route::delete('/arsip/{id}', [AdminArsipController::class, 'destroy']);

        Route::get('/peraturan', [AdminPeraturanController::class, 'index']);
        Route::post('/peraturan', [AdminPeraturanController::class, 'store']);
        Route::get('/peraturan/{id}', [AdminPeraturanController::class, 'show']);
        Route::get('/peraturan/{id}/edit', [AdminPeraturanController::class, 'edit']);
        Route::put('/peraturan/{id}', [AdminPeraturanController::class, 'update']);
        Route::delete('/peraturan/{id}', [AdminPeraturanController::class, 'destroy']);

        Route::get('/siskamling', [AdminSiskamlingController::class, 'index']);
        Route::post('/siskamling/generate', [AdminSiskamlingController::class, 'generate']);
        Route::get('/siskamling/riwayat', [AdminSiskamlingController::class, 'riwayat']);
        Route::get('/siskamling/{id}', [AdminSiskamlingController::class, 'show']);

        Route::get('/kegiatan-sosial', [AdminKegiatanSosialController::class, 'index']);
        Route::post('/kegiatan-sosial', [AdminKegiatanSosialController::class, 'store']);
        Route::delete('/kegiatan-sosial/{id}', [AdminKegiatanSosialController::class, 'destroy']);
        Route::get('/kegiatan-sosial/{id}/download', [AdminKegiatanSosialController::class, 'download']);

        Route::get('/profil-desa', [ProfilDesaController::class, 'index']);
        Route::put('/profil-desa', [ProfilDesaController::class, 'update']);
    });

    Route::middleware('role:warga')->prefix('warga')->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'warga']);
        Route::get('/profil', [WargaProfilController::class, 'index']);

        Route::get('/antrian', [WargaAntrianController::class, 'index']);
        Route::post('/antrian', [WargaAntrianController::class, 'ambil']);
        Route::get('/antrian/riwayat', [WargaAntrianController::class, 'riwayat']);

        Route::get('/arsip', [WargaArsipController::class, 'index']);

        Route::get('/peraturan', [WargaPeraturanController::class, 'index']);
        Route::get('/peraturan/{id}', [WargaPeraturanController::class, 'show']);

        Route::get('/siskamling', [WargaSiskamlingController::class, 'index']);
        Route::get('/siskamling/{id}', [WargaSiskamlingController::class, 'show']);

        Route::get('/kegiatan-sosial', [WargaKegiatanSosialController::class, 'index']);
        Route::get('/kegiatan-sosial/{id}/download', [WargaKegiatanSosialController::class, 'download']);

        Route::get('/informasi-desa', [ProfilDesaController::class, 'warga']);
    });

    Route::get('/arsip/{id}/view', [ArsipFileController::class, 'view']);
    Route::get('/arsip/{id}/download', [ArsipFileController::class, 'download']);
    Route::get('/peraturan/pdf/download', [PeraturanPdfController::class, 'download']);
});
