<?php

use App\Http\Controllers\ProfileController;
use App\Models\Meja;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function(){

Route::middleware('role:administrator,owner')->group(function (){
    Route::resource('meja', MejaController::class)->except(['show']);
});

Route::middleware('role:administrator,waiter')->group(function (){
    Route::resource('menu', MenuController::class)->except(['show']);
});

Route::middleware('role:waiter')->group(function (){
    Route::resource('pesanan', PesananController::class)->except(['show']);
    Route::resource('pelanggan', PelangganController::class)->except(['show']); 
});

Route::middleware('role:kasir')->group(function(){
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');   
    Route::post('/transaksi/{pesanan}', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{pesanan}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');   
});

Route::middleware('role:waiter,kasir,owner')->group(function(){
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
}); 
});