<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\KegiatanController;

Route::resource('/master/kegiatan', KegiatanController::class)->middleware(['auth'])->names('admin.kegiatan');