<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\MemberController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/edit/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::post('/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::get('/produk/delete/{id}', [ProdukController::class, 'destroy'])->name('produk.delete');

    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::get('/member/create', [MemberController::class, 'create'])->name('member.create');
    Route::post('/member/store', [MemberController::class, 'store'])->name('member.store');
    Route::get('/member/edit/{id}', [MemberController::class, 'edit'])->name('member.edit');
    Route::post('/member/update/{id}', [MemberController::class, 'update'])->name('member.update');
    Route::get('/member/delete/{id}', [MemberController::class, 'destroy'])->name('member.delete');

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
});