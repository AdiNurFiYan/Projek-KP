<?php

use App\Http\Controllers\KibTypeController;
use App\Http\Controllers\KorwilController;
use App\Http\Controllers\DataSekolahController;
use App\Http\Controllers\DetailKibController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\DetailSarprasController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Home route
Route::get('/', function () {
    return view('pages.home');
})->name('dashboard');

// About routes
Route::prefix('about')->group(function () {
    Route::get('/', [AboutController::class, 'index'])->name('about');
    Route::post('/update', [AboutController::class, 'update'])->name('about.update');
    Route::post('/leader', [AboutController::class, 'storeLeader'])->name('about.leader.store');
    Route::put('/leader/{id}', [AboutController::class, 'updateLeader'])->name('about.leader.update');
    Route::delete('/leader/{id}', [AboutController::class, 'deleteLeader'])->name('about.leader.delete');
    Route::get('/leader/{id}', [AboutController::class, 'getLeader'])->name('about.leader.get');
});

// School Level Management
Route::prefix('tingkatan-sekolah')->group(function () {
    Route::get('/', [KorwilController::class, 'index'])->name('tingkatan-sekolah');
});

// School Data Management
Route::prefix('data-sekolah')->group(function () {
    Route::get('/', [KorwilController::class, 'listSD'])->name('korwil.list-sd');
    Route::get('/{korwil}', [KorwilController::class, 'list'])->name('data-sekolah.list');
});

// Regional Coordinator (Korwil) Management
Route::prefix('korwil')->group(function () {
    Route::get('/{korwil}/sekolah', [DataSekolahController::class, 'index'])->name('korwil.list-sekolah');
    Route::get('/{korwil}/sekolah/{sekolah}', [DataSekolahController::class, 'show'])->name('korwil.sarpras');
});

// School Details
Route::get('/sekolah/{id}', [SekolahController::class, 'show'])->name('sekolah.detail');

// Facilities (Sarpras) Management
Route::prefix('sarpras')->group(function () {
    Route::get('/{sarpras_id}/{jenis_ruang}', [DetailSarprasController::class, 'showByType'])
        ->name('detail-sarpras');
});

// Inventory Management
Route::prefix('data-barang')->group(function () {
    Route::get('/', [KibTypeController::class, 'index'])->name('data-barang');
    Route::get('/{kibType}', [KibTypeController::class, 'show'])->name('data-barang.show');
});

// KIB (Inventory Card) Management
Route::prefix('kib')->group(function () {
    Route::get('/{kib}/download', [DetailKibController::class, 'downloadExcel'])->name('kib.download');
});

// Authentication
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

// Include admin routes
require __DIR__.'/superadmin.php';
require __DIR__.'/admin.php';