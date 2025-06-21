<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;

Route::get('/', [ProdukController::class, 'index'])->name('index');
Route::get('/form', function () {
    return view('form');})
->name('formProduk');

Route::post('/form', [ProdukController::class, 'addProduk'])->name('addProduk');
Route::get('/form/{id}', [ProdukController::class, 'editProduk'])->name('editProduk');
Route::put('/form/{id}', [ProdukController::class, 'updateProduk'])->name('updateProduk');
Route::delete('/{id}', [ProdukController::class, 'deleteProduk'])->name('deleteProduk');

Route::get('/laporan', [ProdukController::class, 'cetakLaporan'])->name('cetak');