<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PenjualanController;

Route::get('/', [dashboard::class, 'index'])->name('dashboard');

Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
Route::post('/produk/tambah', [ProdukController::class, 'upload'])->name('produk.tambah');
Route::delete('/produk/hapus/{id}', [ProdukController::class, 'delete'])->name('produk.hapus');
Route::put('/produk/update', [ProdukController::class, 'update'])->name('produk.update');


Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan');
Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
Route::get('/penjualan/{id}', [PenjualanController::class, 'show']);

//pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan');
Route::post('/pelanggan/tambah', [PelangganController::class, 'upload'])->name('pelanggan.tambah');
Route::delete('/pelanggan/hapus/{id}', [PelangganController::class, 'delete'])->name('pelanggan.hapus');
Route::put('/pelanggan/update', [PelangganController::class, 'update'])->name('pelanggan.update');
// Route::get('/pelanggan', [PelangganController::class, 'pelanggan'])->name('pelanggan');

Route::get('/register', [dashboard::class, 'register'])->name('register');

Route::get('/kasir', [KasirController::class, 'index'])->name('kasir');

