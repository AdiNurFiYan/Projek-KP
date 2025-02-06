<?php

use App\Http\Controllers\SuperAdmin\SuperAdminSarprasController;
use App\Http\Controllers\SuperAdmin\SuperAdminDetailSarprasController;
use App\Http\Controllers\SuperAdmin\SuperAdminFotoSekolahController;
use App\Http\Controllers\SuperAdmin\SuperAdminLaporanAsetController;
use App\Http\Controllers\SuperAdmin\SuperAdminTanahDenahController;
use App\Http\Controllers\SuperAdmin\SuperAdminSekolahController;
use App\Http\Controllers\SuperAdmin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\SuperAdmin\SuperAdminBarangController;
use App\Http\Controllers\SuperAdmin\SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\SuperAdminAkunController;

Route::prefix('super-admin')->name('super-admin.')->group(function () {
    // Guest routes (login)
    Route::middleware('guest:super_admin')->group(function () {
        // Authentication Routes
        Route::controller(AuthenticatedSessionController::class)->group(function () {
            Route::get('login', 'create')->name('login');
            Route::post('login', 'store');
        });
    });

    // Protected super admin routes
    Route::middleware('auth:super_admin')->group(function () {
        // Dashboard Route
        Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');

        // Basic Routes
        Route::get('/sekolah', [SuperAdminSekolahController::class, 'index'])->name('sekolah');
        Route::get('/barang', [SuperAdminBarangController::class, 'index'])->name('barang');
        Route::get('/tingkatan', [SuperAdminSekolahController::class, 'tingkatan'])->name('tingkatan');
        
        // Authentication
        Route::match(['get', 'post'], 'logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        // KIB (Kartu Inventaris Barang) Routes
        Route::controller(SuperAdminBarangController::class)->prefix('kib')->name('kib.')->group(function () {
            Route::get('/data-barang', 'index')->name('data.barang');
            Route::get('/detail/{kibType}', 'show')->name('detail');
            Route::post('/{kibType}/upload', 'upload')->name('upload');
            Route::delete('/{kib}', 'destroy')->name('destroy');
        });

        // School Data Routes
        Route::controller(SuperAdminSekolahController::class)->prefix('data')->name('data.')->group(function () {
            Route::get('/sekolah', 'datasekolah')->name('sekolah');
            Route::get('/{korwil}', 'index')->name('index');
        });

        // School Management Routes
        Route::prefix('sekolah')->name('sekolah.')->group(function () {
            // School Data Management
            Route::controller(SuperAdminSekolahController::class)->group(function () {
                Route::get('/{sekolah}', 'show')->name('show');
                Route::post('/create/{korwil}', 'create')->name('create');
                Route::put('/{sekolah}', 'update')->name('update');
                Route::delete('/{sekolah}', 'destroy')->name('destroy');
            });

            // Sarpras (Facilities) Management
            Route::controller(SuperAdminSarprasController::class)->group(function () {
                Route::get('/sarpras/{korwil}', 'index')->name('sarpras');
                Route::get('/data-sarpras/{sekolah}', 'show')->name('data-sarpras');
                Route::put('/update-sarpras/{sekolah}', 'update')->name('update-sarpras');
                Route::post('/add-room/{sekolah}', 'addRoom')->name('add-room');
            });

            // Detail Sarpras Management
            Route::controller(SuperAdminDetailSarprasController::class)->group(function () {
                Route::get('/detail/{sekolah}', 'show')->name('detail');
                Route::get('/detail-data-sarpras/{sekolah}', 'showSarpras')->name('detail-data-sarpras');
                Route::get('/show-detail-sarpras/{sekolah}/{detailSarpras}', 'showDetailSarpras')->name('show.detail-sarpras');
                Route::put('/detail/{sekolah}', 'update')->name('detail.update');
                Route::put('/detail-sarpras/{sekolah}/{detailSarpras}', 'updateDetailSarpras')->name('update-detail-sarpras');
                Route::post('/detail-sarpras/{sekolah}/{detailSarpras}/delete-photo', 'deletePhoto')->name('delete-photo-sarpras');
                Route::post('/detail-sarpras/{sekolah}/{detailSarpras}/upload-photo', 'uploadPhotos')->name('upload-photo-sarpras');
                Route::post('/store-detail-sarpras/{sekolah}', 'store')->name('store-detail-sarpras');
            });

            // School Photos Management
            Route::controller(SuperAdminFotoSekolahController::class)->group(function () {
                Route::get('/foto-sekolah/{sekolah}', 'index')->name('foto-sekolah');
                Route::post('/foto-sekolah/{sekolah}/store', 'store')->name('store-photo');
                Route::delete('/foto-sekolah/{sekolah}/{filename}', 'destroy')->name('delete-photo');
            });

            // Asset Report Management
            Route::controller(SuperAdminLaporanAsetController::class)->group(function () {
                Route::get('/laporan/{sekolah}', 'index')->name('laporan-aset');
                Route::post('/laporan/upload/{sekolah}', 'store')->name('upload-laporan');
            });

            // Land and Layout Management
            Route::controller(SuperAdminTanahDenahController::class)->group(function () {
                Route::get('/tanah-denah/{sekolah}', 'index')->name('tanah-denah');
                Route::put('/tanah-denah/{sekolah}', 'update')->name('update-tanah-denah');
                Route::delete('/tanah-denah/{sekolah}/denah', 'removeDenah')->name('remove-denah');
            });
        });

        // Account Management Routes
        Route::controller(SuperAdminAkunController::class)->group(function () {
            Route::get('/akun', 'index')->name('akun');
            Route::post('/akun/register', 'register')->name('akun.register');
            Route::put('/akun/{admin}', 'update')->name('akun.update');
            Route::delete('/akun/{admin}', 'destroy')->name('akun.destroy');
        });
    });
});