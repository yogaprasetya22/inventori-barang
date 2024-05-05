<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\LaporanRekapController;
use App\Http\Controllers\User\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokBarangContoller;
use App\Http\Controllers\user\MekanikController;
use App\Http\Controllers\user\OwnerController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::get('/fail404', function () {
    return Inertia::render('404', [
        'title' => '404',
    ]);
})->name('fail404');


Route::prefix('/')->middleware(['auth', 'role:3', 'verified'])->group(function () {
    Route::get('/', [MekanikController::class, 'index'])->name('mekanik');
    // barang keluar
    Route::get('/barang-keluar', [MekanikController::class, 'barang_keluar'])->name('mekanik.barang-keluar');
    Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('mekanik.barang-keluar.store');
    Route::post('/barang-keluar/update', [BarangKeluarController::class, 'update'])->name('mekanik.barang-keluar.update');
    Route::delete('/barang-keluar', [BarangKeluarController::class, 'destroy'])->name('mekanik.barang-keluar.destroy');
    // laporan rekap
    Route::get('/laporan-rekap', [MekanikController::class, 'laporan_rekap'])->name('mekanik.laporan-rekap');
    Route::post('/laporan-rekap', [LaporanRekapController::class, 'store'])->name('mekanik.laporan-rekap.store');
    Route::put('/laporan-rekap', [LaporanRekapController::class, 'update'])->name('mekanik.laporan-rekap.update');
    Route::delete('/laporan-rekap', [LaporanRekapController::class, 'destroy'])->name('mekanik.laporan-rekap.destroy');
    // laporan rekap barang
    Route::get('/laporan-rekap/rekap-barang/{id}', [MekanikController::class, 'detail_laporan_rekap_stok_barang'])->name('mekanik.rekap-barang');
    // laporan rekap barang masuk
    Route::get('/laporan-rekap/rekap-barang-masuk/{id}', [MekanikController::class, 'detail_laporan_rekap_barang_masuk'])->name('mekanik.rekap-barang-masuk');
    // laporan rekap barang keluar
    Route::get('/laporan-rekap/rekap-barang-keluar/{id}', [MekanikController::class, 'detail_laporan_rekap_barang_keluar'])->name('mekanik.rekap-barang-keluar');
});

Route::prefix('owner')->middleware(['auth', 'role:2', 'verified'])->group(function () {
    Route::get('/', [OwnerController::class, 'index'])->name('owner');
    // laporan rekap
    Route::get('/laporan-rekap', [OwnerController::class, 'laporan_rekap'])->name('owner.laporan-rekap');
    Route::post('/laporan-rekap', [LaporanRekapController::class, 'store'])->name('owner.laporan-rekap.store');
    Route::put('/laporan-rekap', [LaporanRekapController::class, 'update'])->name('owner.laporan-rekap.update');
    Route::delete('/laporan-rekap', [LaporanRekapController::class, 'destroy'])->name('owner.laporan-rekap.destroy');
    // laporan rekap barang
    Route::get('/laporan-rekap/rekap-barang/{id}', [OwnerController::class, 'detail_laporan_rekap_stok_barang'])->name('owner.rekap-barang');
    // laporan rekap barang masuk
    Route::get('/laporan-rekap/rekap-barang-masuk/{id}', [OwnerController::class, 'detail_laporan_rekap_barang_masuk'])->name('owner.rekap-barang-masuk');
    // laporan rekap barang keluar
    Route::get('/laporan-rekap/rekap-barang-keluar/{id}', [OwnerController::class, 'detail_laporan_rekap_barang_keluar'])->name('owner.rekap-barang-keluar');
    // stok barang
    Route::get('/stok-barang', [OwnerController::class, 'stok_barang'])->name('owner.stok-barang');
    Route::post('/barang', [StokBarangContoller::class, 'store'])->name('owner.barang.store');
    Route::post('/barang/update', [StokBarangContoller::class, 'update'])->name('owner.barang.update');
    Route::delete('/barang', [StokBarangContoller::class, 'destroy'])->name('owner.barang.destroy');
});

Route::prefix('admin')->middleware(['auth', 'role:1', 'verified'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    // stok barang
    Route::get('/stok-barang', [AdminController::class, 'stok_barang'])->name('admin.stok-barang');
    Route::post('/barang', [StokBarangContoller::class, 'store'])->name('admin.barang.store');
    Route::post('/barang/update', [StokBarangContoller::class, 'update'])->name('admin.barang.update');
    Route::delete('/barang', [StokBarangContoller::class, 'destroy'])->name('admin.barang.destroy');
    // barang masuk
    Route::get('/barang-masuk', [AdminController::class, 'barang_masuk'])->name('admin.barang-masuk');
    Route::post('/barang-masuk', [BarangMasukController::class, 'store'])->name('admin.barang-masuk.store');
    Route::post('/barang-masuk/update', [BarangMasukController::class, 'update'])->name('admin.barang-masuk.update');
    Route::delete('/barang-masuk', [BarangMasukController::class, 'destroy'])->name('admin.barang-masuk.destroy');
    // barang keluar
    Route::get('/barang-keluar', [AdminController::class, 'barang_keluar'])->name('admin.barang-keluar');
    Route::post('/barang-keluar', [BarangKeluarController::class, 'store'])->name('admin.barang-keluar.store');
    Route::post('/barang-keluar/update', [BarangKeluarController::class, 'update'])->name('admin.barang-keluar.update');
    Route::delete('/barang-keluar', [BarangKeluarController::class, 'destroy'])->name('admin.barang-keluar.destroy');
    // data mekanik
    Route::get('/data-mekanik', [AdminController::class, 'data_mekanik'])->name('admin.data-mekanik');
    // data owner
    Route::get('/data-owner', [AdminController::class, 'data_owner'])->name('admin.data-owner');
    // laporan rekap
    Route::get('/laporan-rekap', [AdminController::class, 'laporan_rekap'])->name('admin.laporan-rekap');
    // mekanik
    Route::post('/mekanik', [MekanikController::class, 'store'])->name('admin.mekanik.store');
    Route::put('/mekanik', [MekanikController::class, 'update'])->name('admin.mekanik.update');
    Route::delete('/mekanik', [MekanikController::class, 'destroy'])->name('admin.mekanik.destroy');
    // owner
    Route::post('/owner', [OwnerController::class, 'store'])->name('admin.owner.store');
    Route::put('/owner', [OwnerController::class, 'update'])->name('admin.owner.update');
    Route::delete('/owner', [OwnerController::class, 'destroy'])->name('admin.owner.destroy');
    // laporan rekap
    Route::get('/laporan-rekap', [AdminController::class, 'laporan_rekap'])->name('admin.laporan-rekap');
    Route::get('/laporan-rekap/print', [AdminController::class, 'laporan_rekap_print'])->name('admin.laporan-rekap.print');
    Route::post('/laporan-rekap', [LaporanRekapController::class, 'store'])->name('admin.laporan-rekap.store');
    Route::put('/laporan-rekap', [LaporanRekapController::class, 'update'])->name('admin.laporan-rekap.update');
    Route::delete('/laporan-rekap', [LaporanRekapController::class, 'destroy'])->name('admin.laporan-rekap.destroy');
    // laporan rekap barang
    Route::get('/laporan-rekap/rekap-barang/{id}', [AdminController::class, 'detail_laporan_rekap_stok_barang'])->name('admin.rekap-barang');
    // laporan rekap barang masuk
    Route::get('/laporan-rekap/rekap-barang-masuk/{id}', [AdminController::class, 'detail_laporan_rekap_barang_masuk'])->name('admin.rekap-barang-masuk');
    // laporan rekap barang keluar
    Route::get('/laporan-rekap/rekap-barang-keluar/{id}', [AdminController::class, 'detail_laporan_rekap_barang_keluar'])->name('admin.rekap-barang-keluar');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
