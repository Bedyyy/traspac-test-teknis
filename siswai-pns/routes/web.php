<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PegawaiController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard'); 
    }
    return redirect()->route('login');
});


Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth', 'check_role:admin,staff']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    // --- PENYESUAIAN DIMULAI DI SINI ---

    // Rute Kustom untuk Cetak (Fitur i)
    // HARUS diletakkan sebelum resource
    Route::get('/pegawai/print', [PegawaiController::class, 'print'])->name('pegawai.print');

    // Rute Resource untuk CRUD Pegawai (Fitur c, f, g, h)
    Route::resource('/pegawai', PegawaiController::class);

    // --- PENYESUAIAN SELESAI ---
});
Route::group(['middleware' => ['auth', 'check_role:guest']], function () {
    Route::get('/guest', function () {
        return 'Test Halaman Guest';
    });
});
Route::group(['middleware' => ['auth', 'check_role:admin']], function () {
    Route::get('/users', function () {
        return 'Test Halaman User';
    });
});
