<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\AbsensiController;

Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('matakuliah', MatakuliahController::class);
Route::resource('absensi', AbsensiController::class);

Route::get('/', function () {
    return redirect()->route('mahasiswa.index');
});
