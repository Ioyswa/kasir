<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\PenjualanController;
use App\Http\Middleware\OperatorMiddleware as auth;


Route::get('/', [dashboard::class, 'index'])->name('dashboard')->middleware(auth::class);
Route::get('/produk', [ProdukController::class, 'index'])->name('produk')->middleware(auth::class);;
Route::post('/produk/tambah', [ProdukController::class, 'upload'])->name('produk.tambah')->middleware(auth::class);;
Route::delete('/produk/hapus/{id}', [ProdukController::class, 'delete'])->name('produk.hapus')->middleware(auth::class);;
Route::put('/produk/update', [ProdukController::class, 'update'])->name('produk.update')->middleware(auth::class);;


Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan')->middleware(auth::class);;
Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store')->middleware(auth::class);;
Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->middleware(auth::class);;

//pelanggan
Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan')->middleware(auth::class);;
Route::post('/pelanggan/tambah', [PelangganController::class, 'upload'])->name('pelanggan.tambah')->middleware(auth::class);;
Route::delete('/pelanggan/hapus/{id}', [PelangganController::class, 'delete'])->name('pelanggan.hapus')->middleware(auth::class);;
Route::put('/pelanggan/update', [PelangganController::class, 'update'])->name('pelanggan.update')->middleware(auth::class);;

Route::get('/kasir', [KasirController::class, 'index'])->name('kasir')->middleware(auth::class);;


// Route::get('/pelanggan', [PelangganController::class, 'pelanggan'])->name('pelanggan');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'upload']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
