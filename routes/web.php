<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DashboardController;

Route::get('/', function(){
    return redirect('dashboard');
});

// Auth
Route::get('login', [LoginController::class, 'view'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('login.auth');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Pengguna harus login agar bisa mengakses route didalamnya
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('divisi', DivisiController::class)->except(['show']);
    Route::resource('prodi', ProdiController::class)->except(['show']);
    Route::resource('anggota', AnggotaController::class)->except(['show']);
    Route::resource('kegiatan', KegiatanController::class);
    Route::get('kegiatan/print/{id}', [KegiatanController::class, 'print'])->name('kegiatan.print');
});


