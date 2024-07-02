<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RelawanController;
use App\Http\Controllers\SelectStatusController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\pdfController;
use App\Http\Controllers\PengelolaProfilController;


Auth::routes();


// Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('register', [RegisterController::class, 'register']);

Route::any('/', function()
{
    return 'default loads';
});

Route::get('/', function () {
    return view('landing');
    
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/cekdata/{id}', [pdfController::class, 'cekdata']);

Route::get('/relawan/assessment/response/{id}', [RelawanController::class, 'response_assessment'])->name('relawan-view-assessment');
Route::get('/relawan/lapsit/response/{id}', [RelawanController::class, 'response_lapsit'])->name('relawan-view-assessment');

Route::get('relawan/select-laporan-kejadian', [SelectStatusController::class, 'relawan_laporan_kejadian']);
Route::get('relawan/select-assessment', [SelectStatusController::class, 'relawan_assessment']);
Route::get('relawan/select-lapsit', [SelectStatusController::class, 'relawan_lapsit']);
Route::get('admin/select-laporan-kejadian', [SelectStatusController::class, 'admin_laporan_kejadian']);
Route::get('admin/select-lapsit', [SelectStatusController::class, 'admin_lapsit']);

Route::get('admin/select-laporan-kejadian/unverified', [SelectStatusController::class, 'admin_laporan_kejadian_unverified']);
Route::get('admin/select-laporan-kejadian/verified', [SelectStatusController::class, 'admin_laporan_kejadian_verified']);
Route::get('admin/select-assessment/unverified', [SelectStatusController::class, 'admin_assessment_unverif']);
Route::get('admin/select-assessment/verified', [SelectStatusController::class, 'admin_assessment_verif']);
Route::get('admin/select-assessment', [SelectStatusController::class, 'admin_assessment']);

Route::get('reports/{id}/pdf', [App\Http\Controllers\PDFController::class, 'exportLaporanKejadian'])->name('reports.pdf');
Route::get('reports/{id}/view', [App\Http\Controllers\PDFController::class, 'viewLaporanKejadian']);
Route::get('pdf/view', [App\Http\Controllers\PDFController::class, 'checkViewPDF']);
Route::get('pdf/check', [App\Http\Controllers\PDFController::class, 'checkExportPDF']);

// add pdf assessment
Route::get('assessment/{id}/pdf', [App\Http\Controllers\PDFController::class, 'exportLaporanAssessment'])->name('assessment.pdf');
Route::get('assessment/{id}/view', [App\Http\Controllers\PDFController::class, 'viewLaporanAssessment']);
Route::get('pdf/assessment/view', [App\Http\Controllers\PDFController::class, 'checkViewPDF_assessment']);
Route::get('pdf/assessment/check', [App\Http\Controllers\PDFController::class, 'checkExportPDF_assessment']);

// add pdf lapsit
Route::get('lapsit/{id}/pdf', [App\Http\Controllers\PDFController::class, 'exportLaporanSituasi'])->name('lapsit.pdf');
Route::get('lapsit/{id}/view', [App\Http\Controllers\PDFController::class, 'viewLaporanSituasi']);
Route::get('pdf/lapsit/view', [App\Http\Controllers\PDFController::class, 'checkViewPDF_lapsit']);
Route::get('pdf/lapsit/check', [App\Http\Controllers\PDFController::class, 'checkExportPDF_lapsit']);


//route to pdf export
Route::post('users/view-pdf/{id}', [PDFController::class, 'viewPDF'])->name('view-pdf');
Route::post('users/download-pdf', [PDFController::class, 'downloadPDF'])->name('download-pdf');
//Route::get('users/{id}/preview', [pdfController::class, 'previewAssessmentPdf'])->name('assessment.preview');
Route::get('users/export-assessment/{id}', [pdfController::class, 'exportLaporanAssessment'])->name('assessment-export');

//test middleware relawan role
Route::group(['middleware' => ['auth', 'role:relawan']], function () {
    Route::get('/relawan/dashboard', [RelawanController::class, 'index'])->name('home-relawan');
    Route::get('/relawan/laporan-kejadian', [RelawanController::class, 'index_laporankejadian'])->name('relawan-laporankejadian');
    Route::patch('/relawan/laporan-kejadian/{id}', [RelawanController::class, 'verify'])->name('relawan-verify');
    Route::patch('/relawan/laporan-kejadian-unverify/{id}', [RelawanController::class, 'unverify'])->name('relawan-unverify');
    Route::post('/relawan/laporan-kejadian/store', [RelawanController::class, 'store_laporankejadian'])->name('store-laporankejadian');
    // Route::get('/relawan/laporan-kejadian/create', [RelawanController::class, 'create_laporankejadian'])->name('create-laporankejadian');
    Route::get('/relawan/laporan-kejadian/edit/{id}', [RelawanController::class, 'edit_laporankejadian'])->name('edit-laporankejadian');
    Route::get('/relawan/laporan-kejadian/view/{id}', [RelawanController::class, 'view_laporankejadian'])->name('view-laporankejadian'); 
    Route::delete('/relawan/laporan-kejadian/delete/{id}', [RelawanController::class, 'delete_laporankejadian'])->name('delete-laporankejadian'); //edit
    Route::get('/relawan/lapsit', [RelawanController::class, 'index_lapsit'])->name('relawan-lapsit');

    Route::get('/relawan/lapsit/create/{id}', [RelawanController::class, 'create_lapsit'])->name('create-lapsit');
    Route::post('/relawan/lapsit/store/{id}', [RelawanController::class, 'store_lapsit'])->name('store-lapsit'); //store
    //Route::post('/relawan/lapsit/{id}', [RelawanController::class, 'store_lapsit'])->name('create-lapsit.store');

    Route::get('/relawan/lapsit/{id}/edit', [RelawanController::class, 'edit_lapsit'])->name('edit-lapsit'); //edit
    Route::put('/relawan/lapsit/{id}', [RelawanController::class, 'update_lapsit'])->name('edit-lapsit.update'); //edit
    Route::delete('/relawan/lapsit/delete/{id}', [RelawanController::class, 'delete_lapsit'])->name('delete-lapsit'); //edit
    // Route::post('/relawan/lapsit/{id}/edit', [RelawanController::class, 'edit_lapsit'])->name('edit-lapsit'); //edit
    Route::get('/relawan/lapsit/view/{id}', [RelawanController::class, 'view_lapsit'])->name('relawan-view-lapsit');
    Route::get('/relawan/assessment', [RelawanController::class, 'index_assessment'])->name('relawan-assessment');
    Route::post('/relawan/assessment/store', [RelawanController::class, 'store_assessment'])->name('store-assessment');
    Route::get('/relawan/assessment/view/{id}', [RelawanController::class, 'view_assessment'])->name('relawan-view-assessment');
    Route::get('/relawan/assessment/create/{id}', [RelawanController::class, 'create_assessment'])->name('create-assessment');
    Route::get('/relawan/assessment/{id}/edit', [RelawanController::class, 'edit_assessment'])->name('edit-assessment'); //edit
    Route::put('/relawan/assessment/{id}', [RelawanController::class, 'update_assessment'])->name('edit-assessment.update');//edit
    Route::delete('/relawan/assessment/delete/{id}', [RelawanController::class, 'delete_assessment'])->name('delete-assessment'); //edit
    
});

//test middleware pengelola profil role
Route::group(['middleware' => ['auth',  'role:pengelola_profil']], function () {
    Route::get('/pengelolaProfil/dashboard', [PengelolaProfilController::class, 'index'])->name('pengelolaProfil-home');
    // Route::get('/pengelolaProfil/user_management', [PengelolaProfilController::class, 'user_management'])->name('pengelola-user');
    Route::get('/pengelolaProfil/user_management', [PengelolaProfilController::class, 'user_management'])->name('pengelola-user');
    Route::get('/pengelolaProfil/user_management/edit/{id}', [PengelolaProfilController::class, 'user_management_edit'])->name('pengelola-user.edit');
    Route::delete('/pengelolaProfil/user_management/delete/{id}', [PengelolaProfilController::class, 'user_management_hapus'])->name('pengelola-user.hapus');
    Route::put('pengelolaProfil/user_management/update/{id}', [PengelolaProfilController::class, 'user_management_update'])->name('pengelola-user.update');
    Route::get('/pengelolaProfil/relawan_management', [PengelolaProfilController::class, 'relawan_management'])->name('pengelola-relawan');
    Route::get('/pengelolaProfil/admin_management', [PengelolaProfilController::class, 'admin_management'])->name('pengelola-admin');
    //crud relawan
    Route::post('/pengelolaProfil/store-relawan', [PengelolaProfilController::class, 'store_relawan'])->name('pengelola-user-relawan');  
    Route::get('/pengelolaProfil/add-volunteer', [PengelolaProfilController::class, 'create_relawan'])->name('pengelola-addRelawan');
    Route::get('/pengelolaProfil/detail-volunteer/{id}/hapus', [PengelolaProfilController::class, 'destroy_relawan'])->name('pengelola-detailRelawan');
    Route::get('/pengelolaProfil/{id}/editRelawan', [PengelolaProfilController::class, 'edit_relawan'])->name('pengelolaProfiledit_relawan');
    Route::put('/pengelolaProfil/{id}/editRelawan', [PengelolaProfilController::class, 'update_relawan'])->name('pengelolaProfil.update_relawan');
    Route::get('/pengelolaProfil/detail_relawan/{id}',  [PengelolaProfilController::class, 'show_relawan'])->name('pengelolaProfil.show_relawan');
    Route::delete('/pengelolaProfil/hapus-relawan/{id}/hapusRelawan', [PengelolaProfilController::class, 'destroy_relawan'])->name('pengelola-user-hapusRelawan');
    //admin CRUD
    Route::post('/pengelolaProfil/store-admin', [PengelolaProfilController::class, 'store_admin'])->name('pengelola-user-admin');  
    Route::get('/pengelolaProfil/add-admin', [PengelolaProfilController::class, 'create_admin'])->name('pengelola-add-admin');//nampilin view 
    Route::get('pengelolaProfil/{id}/edit', [PengelolaProfilController::class, 'edit_admin'])->name('pengelolaProfil.edit_admin');
    Route::put('pengelolaProfil/{id}/edit', [PengelolaProfilController::class, 'update_admin'])->name('pengelolaProfil.update_admin');
    Route::resource('pengelolaProfil', PengelolaProfilController::class);
    Route::delete('/pengelolaProfil/hapus-admin/{id}/hapus', [PengelolaProfilController::class, 'destroy_admin'])->name('pengelola-user-hapusAdmin');
   
    // show detail 
    Route::get('pengelolaProfil/detail/{id}',  [PengelolaProfilController::class, 'show_detail'])->name('pengelolaProfil.show_detail');

    // approval 
    Route::get('/pengelolaProfil/approve', [PengelolaProfilController::class, 'show_ApprovalPage'])->name('approval.page');
    Route::post('/pengelolaProfil/approved/{id}', [PengelolaProfilController::class, 'approveUser'])->name('approve.user');
});
//test middleware admin role
Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index_admin'])->name('admin-home');
    Route::get('/admin/kejadian', [AdminController::class, 'kejadian'])->name('admin-kejadian');
    Route::get('/admin/assessment', [AdminController::class, 'index_assessment'])->name('admin-assessment');
    Route::get('/admin/assessment/view/{id}', [AdminController::class, 'view_assessment'])->name('admin-view-assessment');
    Route::get('/admin/assessment/verif/{id}', [AdminController::class, 'verif_assessment'])->name('admin-verif-assessment');
    Route::put('/admin/assessment/verif/{id}', [AdminController::class, 'verify_assessment'])->name('admin-verif-assessment');
    Route::get('/admin/assessment/selesai/{id}', [AdminController::class, 'selesai_assessment'])->name('admin-done-assessment');
    Route::put('/admin/assessment/selesai/{id}', [AdminController::class, 'done_assessment'])->name('admin-done-assessment');
    // Route::get('/admin/assessment/create/{id}', [AdminController::class, 'create_assessment'])->name('create-assessment');
    // Route::get('/admin/assessment/unverified', [AdminController::class, 'assessment_unverif'])->name('admin-assessment-unverif');
    // Route::get('/admin/assessment/verified', [AdminController::class, 'assessment_verif'])->name('admin-assessment-verif');
    // Route::get('/admin/laporan-kejadian', [AdminController::class, 'index_laporan_kejadian'])->name('admin-assessment');
    // laporan kejadian NEW
    Route::get('/admin/laporan-kejadian', [AdminController::class, 'index_laporankejadian'])->name('admin-laporankejadian');
    Route::get('/admin/laporan-kejadian/create', [AdminController::class, 'create_laporankejadian'])->name('create-laporankejadian');
    Route::get('/admin/laporan-kejadian/edit/{id}', [AdminController::class, 'edit_laporankejadian'])->name('edit-laporankejadian');
    Route::get('/admin/laporan-kejadian/view/{id}', [AdminController::class, 'view_laporankejadian'])->name('view-laporankejadian'); 
    Route::post('admin/laporan-kejadian/store', [AdminController::class, 'store_laporankejadian'])->name('store-laporankejadian');
    Route::put('admin/laporan-kejadian/update/{id}', [AdminController::class, 'update_laporankejadian'])->name('update-laporankejadian');
    Route::delete('/admin/laporan-kejadian/delete/{id}', [AdminController::class, 'delete_laporankejadian'])->name('delete-laporankejadian'); //edit
    // laporan kejadian OLD
    Route::get('/admin/laporan-kejadian/unverified', [AdminController::class, 'laporan_kejadian_unverif'])->name('admin-laporan-kejadian-unverif');
    Route::get('/admin/laporan-kejadian/verified', [AdminController::class, 'laporan_kejadian_verif'])->name('admin-laporan-kejadian-verif');
    Route::get('/admin/laporan-kejadian/unverified/view/{id}', [AdminController::class, 'laporan_kejadian_view'])->name('admin-laporan-kejadian-view-unverif');
    Route::get('/admin/laporan-kejadian/verified/view/{id}', [AdminController::class, 'laporan_kejadian_view'])->name('admin-laporan-kejadian-view-verif');
    Route::get('/admin/laporan-kejadian/unverified/verif/{id}', [AdminController::class, 'laporan_kejadian_verif_view'])->name('admin-laporan-kejadian-verif-view');
    Route::post('/admin/verif/laporan-kejadian', [AdminController::class, 'verif_laporan_kejadian'])->name('verif-laporan-kejadian');
    
    Route::get('/admin/lapsit', [AdminController::class, 'index_lapsit'])->name('admin-lapsit');
    Route::get('/admin/lapsit/view/{id}', [AdminController::class, 'view_lapsit'])->name('admin-view-lapsit');
    Route::post('/admin/lapsit/{id}/share', [AdminController::class, 'Sharelapsit'])->name('share.lapsit');
    Route::get('/admin/exsum', [AdminController::class, 'index_exsum'])->name('admin-exsum');

    Route::post('admin/download-pdf', [PDFController::class, 'downloadPDFeksum'])->name('eksum.pdf');
});
