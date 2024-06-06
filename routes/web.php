<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RelawanController;
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
    Route::get('/relawan/dashboard', [RelawanController::class, 'index'])->name('home-relawan');
    Route::get('/relawan/lapsit', [RelawanController::class, 'index_lapsit'])->name('relawan-lapsit');
    Route::get('/relawan/lapsit/create', [RelawanController::class, 'create_lapsit'])->name('create-lapsit');
    Route::get('/relawan/lapsit/edit', [RelawanController::class, 'edit_lapsit'])->name('edit-lapsit');
    Route::get('/relawan/assesment', [RelawanController::class, 'index_assessment'])->name('relawan-assessment');
    Route::get('/relawan/assesment/create', [RelawanController::class, 'create_assessment'])->name('create-assessment');
    Route::get('/relawan/assesment/edit', [RelawanController::class, 'edit_assessment'])->name('edit-assessment');
});

//test middleware pengelola profil role
Route::group(['middleware' => ['auth', 'role:pengelola_profil']], function () {
    Route::get('/pengelolaProfil/dashboard', [PengelolaProfilController::class, 'index'])->name('pengelolaProfil-home');
});

//test middleware admin role
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index_admin'])->name('admin-home');
    Route::get('/admin/exsum', [AdminController::class, 'index_exsum'])->name('admin-exsum');
});
