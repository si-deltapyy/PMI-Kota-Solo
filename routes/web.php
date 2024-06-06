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
    Route::get('/relawan/laporan-kejadian', [RelawanController::class, 'index_laporankejadian'])->name('relawan-laporankejadian');
    Route::get('/relawan/laporan-kejadian/create', [RelawanController::class, 'create_laporankejadian'])->name('create-laporankejadian');
    Route::get('/relawan/laporan-kejadian/edit', [RelawanController::class, 'edit_laporankejadian'])->name('edit-laporankejadian');
    Route::get('/relawan/lapsit', [RelawanController::class, 'index_lapsit'])->name('relawan-lapsit');
    Route::get('/relawan/lapsit/create', [RelawanController::class, 'create_lapsit'])->name('create-lapsit');
    Route::get('/relawan/lapsit/edit', [RelawanController::class, 'edit_lapsit'])->name('edit-lapsit');
    Route::get('/relawan/lapsit/detail', [RelawanController::class, 'detail_lapsit'])->name('detail-lapsit');
    Route::get('/relawan/assesment', [RelawanController::class, 'index_assessment'])->name('relawan-assessment');
    Route::get('/relawan/assesment/create', [RelawanController::class, 'create_assessment'])->name('create-assessment');
    Route::get('/relawan/assesment/edit', [RelawanController::class, 'edit_assessment'])->name('edit-assessment');
});

//test middleware pengelola profil role
Route::group(['middleware' => ['auth', 'role:pengelola_profil']], function () {
    Route::get('/pengelolaProfil/dashboard', [PengelolaProfilController::class, 'index'])->name('pengelolaProfil-home');
    Route::get('/pengelolaProfil/user_management', [PengelolaProfilController::class, 'user_management'])->name('pengelola-user');
    Route::get('/pengelolaProfil/relawan_management', [PengelolaProfilController::class, 'relawan_management'])->name('pengelola-relawan');
    Route::get('/pengelolaProfil/admin_management', [PengelolaProfilController::class, 'admin_management'])->name('pengelola-admin');
    Route::get('/pengelolaProfil/add-volunteer', [PengelolaProfilController::class, 'create_relawan'])->name('pengelola-add');
    Route::get('/pengelolaProfil/edit-volunteer', [PengelolaProfilController::class, 'edit_relawan'])->name('pengelola-edit');
    Route::get('/pengelolaProfil/detail-volunteer', [PengelolaProfilController::class, 'detail_relawan'])->name('pengelola-detail');
    Route::get('/pengelolaProfil/add-admin', [PengelolaProfilController::class, 'create_admin'])->name('pengelola-add-admin');
});
//test middleware admin role
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index_admin'])->name('admin-home');
    Route::get('/admin/assessment', [AdminController::class, 'index_assessment'])->name('admin-assessment');
    Route::get('/admin/assessment/unverified', [AdminController::class, 'assessment_unverif'])->name('admin-assessment-unverif');
    Route::get('/admin/assessment/verified', [AdminController::class, 'assessment_verif'])->name('admin-assessment-verif');
    Route::get('/admin/lapsit', [AdminController::class, 'index_lapsit'])->name('admin-lapsit');
    Route::get('/admin/exsum', [AdminController::class, 'index_exsum'])->name('admin-exsum');
});