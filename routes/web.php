<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DashboardController;

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('divisi', DivisiController::class)->except(['show']);

Route::resource('prodi', ProdiController::class)->except(['show']);

Route::resource('anggota', AnggotaController::class)->except(['show']);

Route::resource('kegiatan', KegiatanController::class);
