<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\AbsensiController;

// ===== Route Login =====
Route::get('/login',  [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout',[LoginController::class, 'logout'])->name('logout');

// ===== Root redirect =====
Route::get('/', function () {
    return redirect()->route('login');
});

// ===== Route wajib login =====
Route::middleware('auth')->group(function () {
    Route::resource('mahasiswa',  MahasiswaController::class);
    Route::resource('matakuliah', MatakuliahController::class);
    Route::resource('absensi',    AbsensiController::class);
});
