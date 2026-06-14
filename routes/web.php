<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\NilaiMahasiswaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;

Route::view('/', 'dashboard.index');

Route::resource('mata-kuliah', MataKuliahController::class);

Route::get('/nilai-mahasiswa', [NilaiMahasiswaController::class, 'index']);

Route::resource('mahasiswa', MahasiswaController::class);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/logout', [AuthController::class, 'logout']);