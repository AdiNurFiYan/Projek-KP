<?php

use App\Http\Controllers\Admin\AdminSarprasController;
use App\Http\Controllers\Admin\AdminDetailSarprasController;
use App\Http\Controllers\Admin\AdminFotoSekolahController;
use App\Http\Controllers\Admin\AdminLaporanAsetController;
use App\Http\Controllers\Admin\AdminTanahDenahController;
use App\Http\Controllers\Admin\AdminSekolahController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AdminBarangController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ActivityController; 

Route::prefix('admin')->name('admin.')->group(function () {
    // Guest routes (login only)
    Route::middleware('guest:admin')->group(function () {
        // Authentication Routes
        Route::controller(AuthenticatedSessionController::class)->group(function () {
            Route::get('login', 'create')->name('login');
            Route::post('login', 'store');
        });
    });

    // Protected admin routes
    Route::middleware('auth:admin')->group(function () {
        // Dashboard Routes
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/activities/latest', [ActivityController::class, 'latest'])->name('activities.latest');

        // Basic Routes
        Route::get('/sekolah', [AdminSekolahController::class, 'index'])->name('sekolah');
        Route::get('/barang', [AdminBarangController::class, 'index'])->name('barang');
        Route::get('/tingkatan', [AdminSekolahController::class, 'tingkatan'])->name('tingkatan');
        
        // Authentication
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

        // KIB (Kartu Inventaris Barang) Routes
        Route::controller(AdminBarangController::class)->prefix('kib')->name('kib.')->group(function () {
            Route::get('/data-barang', 'index')->name('data.barang');
            Route::get('/detail/{kibType}', 'show')->name('detail');
            Route::post('/{kibType}/upload', 'upload')->name('upload');
            Route::delete('/{kib}', 'destroy')->name('destroy');
        });

        // School Data Routes
        Route::controller(AdminSekolahController::class)->prefix('data')->name('data.')->group(function () {
            Route::get('/sekolah', 'datasekolah')->name('sekolah');
            Route::get('/{korwil}', 'index')->name('index');
        });

        // School Management Routes
        Route::prefix('sekolah')->name('sekolah.')->group(function () {
            // School Data Management
            Route::controller(AdminSekolahController::class)->group(function () {
                Route::get('/{sekolah}', 'show')->name('show');
                Route::post('/create/{korwil}', 'create')->name('create');
                Route::put('/{sekolah}', 'update')->name('update');
                Route::delete('/{sekolah}', 'destroy')->name('destroy');
            });

            // Sarpras (Facilities) Management
            Route::controller(AdminSarprasController::class)->group(function () {
                Route::get('/sarpras/{korwil}', 'index')->name('sarpras');
                Route::get('/data-sarpras/{sekolah}', 'show')->name('data-sarpras');
                Route::put('/update-sarpras/{sekolah}', 'update')->name('update-sarpras');
                Route::post('/add-room/{sekolah}', 'addRoom')->name('add-room');
            });

            // Detail Sarpras Management
            Route::controller(AdminDetailSarprasController::class)->group(function () {
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
            Route::controller(AdminFotoSekolahController::class)->group(function () {
                Route::get('/foto-sekolah/{sekolah}', 'index')->name('foto-sekolah');
                Route::post('/foto-sekolah/{sekolah}/store', 'store')->name('store-photo');
                Route::delete('/foto-sekolah/{sekolah}/{filename}', 'destroy')->name('delete-photo');
            });

            // Asset Report Management
            Route::controller(AdminLaporanAsetController::class)->group(function () {
                Route::get('/laporan/{sekolah}', 'index')->name('laporan-aset');
                Route::post('/laporan/upload/{sekolah}', 'store')->name('upload-laporan');
            });

            // Land and Layout Management
            Route::controller(AdminTanahDenahController::class)->group(function () {
                Route::get('/tanah-denah/{sekolah}', 'index')->name('tanah-denah');
                Route::put('/tanah-denah/{sekolah}', 'update')->name('update-tanah-denah');
                Route::delete('/tanah-denah/{sekolah}/denah', 'removeDenah')->name('remove-denah');
            });
        });
    });
});