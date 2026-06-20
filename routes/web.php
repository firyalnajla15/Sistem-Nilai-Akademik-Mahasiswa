<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\NilaiMahasiswaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TranskripController;

Route::view('/', 'dashboard.index')->name('home');
Route::view('/dashboard', 'dashboard.index')->name('dashboard');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::middleware('auth')->group(function () {
    Route::resource('mata-kuliah', MataKuliahController::class);
    Route::get('/nilai-mahasiswa', [NilaiMahasiswaController::class, 'index']);
    Route::resource('mahasiswa', MahasiswaController::class);
    Route::get('/logout', [AuthController::class, 'logout']);


    Route::get('/nilai', [NilaiMahasiswaController::class, 'index'])->name('nilai.index');
    Route::get('/nilai/create', [NilaiMahasiswaController::class, 'create'])->name('nilai.create');
    Route::post('/nilai', [NilaiMahasiswaController::class, 'store'])->name('nilai.store');
    Route::get('/nilai/{id}/edit', [NilaiMahasiswaController::class, 'edit'])->name('nilai.edit');
    Route::put('/nilai/{id}', [NilaiMahasiswaController::class, 'update'])->name('nilai.update');
    Route::delete('/nilai/{id}', [NilaiMahasiswaController::class, 'destroy'])->name('nilai.destroy');

    Route::get('/profil', function () {return view('profil.index');})->name('profil');

    Route::get('/transkrip', [TranskripController::class, 'index'])->name('transkrip.index');
    Route::get('/transkrip/pdf', [TranskripController::class, 'pdf'])->name('transkrip.pdf');
    Route::get('/api/search-mahasiswa', function (Illuminate\Http\Request $request) {

    $q = $request->q;

    return \App\Models\Mahasiswa::where('nim', 'like', $q . '%')
        ->limit(10)
        ->get(['nim', 'nama']);
});
Route::get('/search-mahasiswa', function (Illuminate\Http\Request $request) {

    return \App\Models\Mahasiswa::where('nim', 'like', $request->q . '%')
        ->limit(10)
        ->get(['nim', 'nama']);
});

Route::get('/check-nilai', function (Illuminate\Http\Request $request) {

    return \App\Models\NilaiMahasiswa::where('nim', $request->nim)
        ->where('matkul_id', $request->matkul_id)
        ->exists();
});
    });

