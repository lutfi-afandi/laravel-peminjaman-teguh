<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\GedungController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\RuanganController;

Route::resource('/master/kegiatan', KegiatanController::class)->middleware(['auth'])->names('admin.kegiatan');
Route::resource('/master/barang', BarangController::class)->middleware(['auth'])->names('admin.barang');
Route::resource('/master/ruangan', RuanganController::class)->middleware(['auth'])->names('admin.ruangan');

Route::resource('/master/gedung', GedungController::class)->middleware(['auth'])->names('admin.gedung');

Route::resource('/master/peminjaman', PeminjamanController::class)->middleware(['auth'])->names('admin.peminjaman');
