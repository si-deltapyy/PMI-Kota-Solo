<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PengelolaProfilController;


Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//test middleware relawan role
Route::group(['middleware' => ['auth', 'role:relawan']], function () {
    Route::get('/relawan', [HomeController::class, 'index']);
});

//test middleware pengelola profil role
Route::group(['middleware' => ['auth', 'role:pengelola_profil']], function () {
    Route::get('/pengelolaProfil', [HomeController::class, 'index']);
    Route::get('/pengelolaProfil/home', [PengelolaProfilController::class, 'index_admin'])->name('admin-home');
});

//test middleware admin role
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin', [HomeController::class, 'index']);
});

Route::get('/admin/home', [AdminController::class, 'index_admin'])->name('admin-home');
