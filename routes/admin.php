<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KegiatanController as AdminKegiatanController;
use App\Http\Controllers\Admin\BarangController;
use App\Http\Controllers\Admin\GedungController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\QrCodeController;
use App\Http\Controllers\Admin\RuanganController;
use App\Http\Controllers\Admin\BookingController;

use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\UnitkerjaController;
use App\Http\Controllers\Admin\UserController;

Route::resource('/master/kegiatan', AdminKegiatanController::class)->middleware(['auth_admin'])->names('admin.kegiatan');
// Route::resource('/master/kegiatan', AdminKegiatanController::class)->middleware(['auth'])->names('admin.kegiatan');
Route::resource('/master/barang', BarangController::class)->middleware(['auth_admin'])->names('admin.barang');

Route::get('/CetakQrCode/{ruangan_id}', [BarangController::class, 'QrCode'])->middleware(['auth_admin'])->name('admin.barang.QrCode');

Route::get('/filterBarang', [BarangController::class, 'filter'])->middleware(['auth_admin'])->name('admin.barang.filter');
Route::get('/filterBarang/{gedung_id}', [BarangController::class, 'ruanganByGedung'])->middleware(['auth_admin'])->name('admin.barang.filterRuanganByGedung');

Route::resource('/master/ruangan', RuanganController::class)->middleware(['auth_admin'])->names('admin.ruangan');


Route::resource('/master/gedung', GedungController::class)->middleware(['auth_admin'])->names('admin.gedung');

Route::resource('/master/peminjaman', PeminjamanController::class)->middleware(['auth_admin'])->names('admin.peminjaman');

Route::resource('/master/booking', BookingController::class)->middleware(['auth_baak'])->names('admin.booking');
Route::match(['put', 'patch'], '/master/booking/{id}', 'BookingController@update')->middleware(['auth_baak'])->name('admin.booking.update');



Route::get('/master/jadwal', [JadwalController::class, 'index'])->middleware(['auth_baak'])->name('admin.jadwal');

Route::get('/master/laporan', [BookingController::class, 'laporan'])->middleware(['auth_admin'])->name('admin.laporan');

Route::get('/master/laporan/data', [BookingController::class, 'fetchDataLaporan'])->middleware('auth_admin')->name('fetch.data.laporan');
Route::get('/master/laporan/cetak', [BookingController::class, 'cetakLaporan'])->middleware(['auth_admin'])->name('admin.cetak.laporan');




Route::resource('/master/user', UserController::class)->middleware(['auth_admin'])->names('admin.user');

Route::resource('/master/unit', UnitkerjaController::class)->middleware(['auth_admin'])->names('admin.unit');