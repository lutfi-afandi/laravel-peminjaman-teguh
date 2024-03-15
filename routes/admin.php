<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\BarangController;

Route::resource('/master/kegiatan', KegiatanController::class)->middleware(['auth'])->names('admin.kegiatan');
Route::resource('/master/barang', BarangController::class)->middleware(['auth'])->names('admin.barang');