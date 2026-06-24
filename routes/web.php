<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\NilaiMahasiswaController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TranskripController;
use App\Http\Controllers\AuthMahasiswaController;

Route::view('/', 'landing.index')->name('home');
Route::view('/dashboard', 'dashboard.index')->name('dashboard');

// Route Login Mahasiswa
Route::get('/login-mahasiswa', [AuthMahasiswaController::class, 'showLogin'])->name('mahasiswa.login');
Route::post('/login-mahasiswa', [AuthMahasiswaController::class, 'login']);

// Route Register / Aktivasi Mahasiswa
Route::get('/mahasiswa/register', [AuthMahasiswaController::class, 'showRegister'])->name('mahasiswa.register');
Route::post('/mahasiswa/register', [AuthMahasiswaController::class, 'register']);

// Route Dashboard & Logout Mahasiswa
Route::get('/mahasiswa/dashboard', [AuthMahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');
Route::post('/mahasiswa/logout', [AuthMahasiswaController::class, 'logout'])->name('mahasiswa.logout');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);

Route::middleware('auth')->group(function () {
    // ================= MAHASISWA =================
    Route::resource('mahasiswa', MahasiswaController::class);
    
    // ================= MATA KULIAH =================
    Route::resource('mata-kuliah', MataKuliahController::class);
    
    // ================= NILAI =================
    Route::prefix('nilai')->group(function () {
        Route::get('/', [NilaiMahasiswaController::class, 'index'])->name('nilai.index');
        Route::get('/create', [NilaiMahasiswaController::class, 'create'])->name('nilai.create');
        Route::post('/', [NilaiMahasiswaController::class, 'store'])->name('nilai.store');
        Route::get('/{id}/edit', [NilaiMahasiswaController::class, 'edit'])->name('nilai.edit');
        Route::put('/{id}', [NilaiMahasiswaController::class, 'update'])->name('nilai.update');
        Route::delete('/{id}', [NilaiMahasiswaController::class, 'destroy'])->name('nilai.destroy');
    });
    
    // ================= API ROUTES =================
    Route::prefix('api')->group(function () {
        Route::get('/search-mahasiswa', [NilaiMahasiswaController::class, 'searchMahasiswa']);
        Route::get('/matkul-by-semester', [NilaiMahasiswaController::class, 'getMatkulBySemester']);
        Route::get('/check-nilai', [NilaiMahasiswaController::class, 'checkNilai']);
    });
    
    // ================= TRANSKRIP =================
    Route::get('/transkrip', [TranskripController::class, 'index'])->name('transkrip.index');
    Route::get('/transkrip/pdf', [TranskripController::class, 'pdf'])->name('transkrip.pdf');
    
    // ================= PROFIL ADMIN =================
    Route::get('/profil', function () { 
        return view('profil.index'); 
    })->name('profil');
    
    // ================= PROFIL MAHASISWA =================
    Route::get('/mahasiswa/profil', function () { 
        return view('profil.profil'); 
    })->name('mahasiswa.profil');
    
    // ================= LOGOUT =================
    Route::get('/logout', [AuthController::class, 'logout']);
});