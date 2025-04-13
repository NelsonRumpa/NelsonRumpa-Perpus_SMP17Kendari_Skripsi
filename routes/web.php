<?php

use App\Http\Controllers\kategoriController;
use App\Http\Controllers\rakbukuController;
use App\Http\Controllers\bukuController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\guruController;
use App\Http\Controllers\kunjunganSiswaController;
use App\Http\Controllers\peminguruController;
use App\Http\Controllers\peminjamanController;
use App\Http\Controllers\peminkelasController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\kunjunganGuruController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [userController::class, 'showLoginForm'])->name('login');
Route::post('/login', [userController::class, 'login']);
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::middleware(['auth'])->group(function () {

    Route::get('/register', [userController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [userController::class, 'register']);

    Route::get('/main', function () {
        return view('layout.main');
    });
    
    // Dashboard
    Route::get('/dashboard', [dashboardController::class, 'index']);

    // Kategori
    Route::get('/kategori', [kategoriController::class, 'index']);
    Route::post('/kategori/store', [kategoriController::class, 'store']);
    Route::get('/kategori/{id_kat}/edit', [kategoriController::class, 'edit']);
    Route::put('/kategori/{id_kat}', [kategoriController::class, 'update']);
    Route::get('/kategori/{id_kat}', [kategoriController::class, 'destroy']);

    // Rak Buku
    Route::get('/rakbuku', [RakBukuController::class, 'index']);
    Route::post('/rakbuku/store', [RakBukuController::class, 'store']);
    Route::get('/rakbuku/{id_rak}/edit', [RakBukuController::class, 'edit']);
    Route::put('/rakbuku/{id_rak}', [RakBukuController::class, 'update']);
    Route::get('/rakbuku/{id_rak}', [RakBukuController::class, 'destroy']);

    // Buku
    Route::get('/buku', [bukuController::class, 'index']);
    Route::post('/buku/store', [bukuController::class, 'store']);
    Route::get('/buku/{id_buku}/edit', [bukuController::class, 'edit']);
    Route::put('/buku/{id_buku}', [bukuController::class, 'update']);
    Route::get('/buku/{id_buku}', [bukuController::class, 'destroy']);

    // Siswa
    Route::get('/siswa', [siswaController::class, 'index']);
    Route::post('/siswa/store', [siswaController::class, 'store']);
    Route::get('/siswa/{id}/edit', [siswaController::class, 'edit']);
    Route::put('/siswa/{id}', [siswaController::class, 'update']);
    Route::get('/siswa/{id}', [siswaController::class, 'destroy']);

    // Guru
    Route::get('/guru', [guruController::class, 'index']);
    Route::post('/guru/store', [guruController::class, 'store']);
    Route::get('/guru/{id}/edit', [guruController::class, 'edit']);
    Route::put('/guru/{id}', [guruController::class, 'update']);
    Route::get('/guru/{id}', [guruController::class, 'destroy']);

    // Peminjaman Buku
    Route::get('/peminjaman', [peminjamanController::class, 'index']);
    Route::post('/peminjaman/store', [peminjamanController::class, 'store']);
    Route::get('/peminjaman/{id}/edit', [peminjamanController::class, 'edit']);
    Route::put('/peminjaman/{id}', [peminjamanController::class, 'update']);
    Route::get('/peminjaman/{id}', [peminjamanController::class, 'destroy']);
    Route::put('/peminjaman/{id_peminjaman}/return', [peminjamanController::class, 'returnBook'])->name('peminjaman.return');
    
    // Peminjaman Guru
    Route::get('/peminGuru', [peminguruController::class, 'index']);
    Route::post('/peminGuru/store', [peminguruController::class, 'store']);
    Route::get('/peminGuru/{id}/edit', [peminguruController::class, 'edit']);
    Route::put('/peminGuru/{id}', [peminguruController::class, 'update'])->name('peminGuru.update');
    Route::get('/peminGuru/{id}', [peminguruController::class, 'destroy']);
    Route::put('/peminGuru/{id_peminjaman}/return', [peminguruController::class, 'returnBook'])->name('peminGuru.return');
    
    // Peminjaman Kelas
    Route::get('/peminKelas', [peminkelasController::class, 'index']);
    Route::post('/peminKelas/store', [peminkelasController::class, 'store']);
    Route::get('/peminKelas/{id}/edit', [peminkelasController::class, 'edit']);
    Route::put('/peminKelas/{id}', [peminkelasController::class, 'update'])->name('peminKelas.update');
    Route::get('/peminKelas/{id}', [peminkelasController::class, 'destroy']);
    Route::put('/peminKelas/return/{id_peminjaman}', [peminkelasController::class, 'return'])->name('peminKelas.return');
    
    // Kunjungan Siswa
    Route::get('/kunjunganSiswa', [kunjunganSiswaController::class, 'index']);
    Route::post('/kunjunganSiswa/store', [kunjunganSiswaController::class, 'store']);
    Route::get('/kunjunganSiswa/{id}/edit', [kunjunganSiswaController::class, 'edit']);
    Route::put('/kunjunganSiswa/{id}', [kunjunganSiswaController::class, 'update'])->name('kunjunganSiswa.update');
    
    // Kunjungan Guru
    Route::get('/kunjunganGuru', [kunjunganGuruController::class, 'index']);
    Route::post('/kunjunganGuru/store', [kunjunganGuruController::class, 'store']);
    Route::get('/kunjunganGuru/{id}/edit', [kunjunganGuruController::class, 'edit']);
    Route::put('/kunjunganGuru/{id}', [kunjunganGuruController::class, 'update'])->name('kunjunganGuru.update');
});
