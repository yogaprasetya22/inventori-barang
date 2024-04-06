<?php

use App\Http\Controllers\ApiDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/generate/data/barang', [ApiDataController::class, 'index'])->name('generate.data.barang');
Route::get('/generate/data/barang_masuk', [ApiDataController::class, 'add_barang_masuk'])->name('generate.data.add_barang_masuk');
Route::get('/generate/data/barang_keluar', [ApiDataController::class, 'add_barang_keluar'])->name('generate.data.add_barang_keluar');
Route::get('/scrape-category', [ApiDataController::class, 'scrape'])->name('scrape.category');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
