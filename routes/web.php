<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PembelianController;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


Route::middleware(['auth'])->group(function () {

   Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
   Route::get('/logout', [LoginController::class, 'logout'])->name('logout');  
   Route::get('/user', [UserController::class, 'index'])->name('user.index');
   Route::get('/user/tambah', [UserController::class, 'create'])->name('user.tambahUser');
   Route::post('/user', [UserController::class, 'store'])->name('user.store');
   Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
   Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
   Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
   Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

   Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
   Route::get('/produk/tambah', [ProdukController::class, 'create'])->name('produk.create');
   Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
   Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
   Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
   Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
   Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');


   Route::get('/transaksi', [PembelianController::class, 'index'])->name('pembelian.index');
   Route::get('/transaksi/tambah', [PembelianController::class, 'create'])->name('pembelian.create');
   Route::post('/transaksi', [PembelianController::class, 'store'])->name('pembelian.store');
   Route::get('/export-pembelian', [PembelianController::class, 'exportExcel'])->name('pembelian.exportExcel');

});


  
   

