<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardMahasiswaController;
use App\Http\Controllers\DashboardPaketController;
use App\Http\Controllers\DashboardPaketDetailController;
use App\Http\Controllers\DashboardProdiController;
use App\Http\Controllers\DashboardSoalController;
use App\Http\Controllers\DashboardSoalDetailController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\LoginController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return redirect('/dashboard');
});

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::prefix('/dashboard')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/user', DashboardUserController::class);
    Route::post('/user/reset-password', [DashboardUserController::class, 'resetPasswordAdmin'])->name('user.reset');
    Route::resource('/prodi', DashboardProdiController::class);
    Route::resource('/mahasiswa', DashboardMahasiswaController::class);
    Route::prefix('/paket-soal')->group(function () {
        Route::resource('/paket', DashboardPaketController::class);
        Route::resource('/paket/paket-detail', DashboardPaketDetailController::class)->names('paket-detail');
        Route::resource('/soal', DashboardSoalController::class);
        Route::resource('/soal/soal-detail', DashboardSoalDetailController::class)->names('soal-detail');
    });
    
});
