<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/buku', [BukuController::class, 'index'])->name('buku.index');
Route::get('/admin/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
Route::put('/admin/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
Route::post('/admin/buku', [BukuController::class, 'store'])->name('buku.store');
Route::delete('/admin/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');

Route::get('/admin/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/admin/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::put('/admin/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
Route::post('/admin/customer', [CustomerController::class, 'store'])->name('customer.store');
Route::delete('/admin/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

Route::get('/admin/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::get('/admin/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
Route::put('/admin/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
Route::post('/admin/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
Route::delete('/admin/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');

Route::get('/admin/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::get('/admin/pengembalian/{id}/edit', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
Route::put('/admin/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
Route::post('/admin/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
Route::delete('/admin/pengembalian/{id}', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');

Route::get('/admin/dashboard', function() {
    return view('admin.dashboard');
})->name('admin.dashboard');