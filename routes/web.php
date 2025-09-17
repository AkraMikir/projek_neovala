<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ViewsController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\tampilanUserController;
use App\Http\Controllers\TampilanApartmentController;
use App\Http\Controllers\FormDataController;
use App\Http\Controllers\KomentarTpjController;
use App\Http\Controllers\KomentarTpcController;
use App\Http\Controllers\KomentarGklController;
use App\Http\Controllers\KomentarPluController;
use App\Http\Controllers\KomentarGwcController;
use App\Http\Controllers\KomentarPgvController;
use App\Http\Controllers\KomentarGpcController;
use App\Http\Controllers\KomentarBscController;


Route::get('/storage-link', function() {
    Artisan::call('storage:link');
    return 'Alhamdulillah sudah bisa ya mas ganteng';
});

// ==============================
// ROUTE UNTUK USER PAGE
// ==============================

Route::get('/', [tampilanUserController::class, 'homeTampilanUser'])->name('home');

Route::get('/book-now', function () {
    return view('user.bookNow');
})->name('bookNow');

//=======================================
//DISCOVER GKL
//=======================================
Route::get('/discover-gkl', [TampilanApartmentController::class, 'gkl'])->name('discoverGKL');


//=======================================
//DISCOVER GWC
//=======================================
Route::get('/discover-gwc', [TampilanApartmentController::class, 'gwc'])->name('discoverGWC');


//=======================================
//DISCOVER PGv
//=======================================
Route::get('/discover-pgv', [TampilanApartmentController::class, 'pgv'])->name('discoverPGV');


//=======================================
//DISCOVER PLU
//=======================================
Route::get('/discover-plu', [TampilanApartmentController::class, 'plu'])->name('discoverPLU');

//=======================================
//DISCOVER TPC
//=======================================
Route::get('/discover-tpc', [TampilanApartmentController::class, 'tpc'])->name('discoverTPC');

//=======================================
//DISCOVER TPJ
//=======================================
Route::get('/discover-tpj', [TampilanApartmentController::class, 'tpj'])->name('discoverTPJ');

//=======================================
//DISCOVER GPC
//=======================================
Route::get('/discover-gpc', [TampilanApartmentController::class, 'gpc'])->name('discoverGPC');

//=======================================
//DISCOVER BSC
//=======================================
Route::get('/discover-bsc', [TampilanApartmentController::class, 'bsc'])->name('discoverBSC');


//=======================================
//DISCOVER OUR STORY
//=======================================
Route::get('/our-story', function () {
    return view('user.ourStory');
})->name('ourStory');

//=======================================
//DISCOVER TITIP KUNCI
//=======================================
Route::get('/titip-kunci', function () {
    return view('user.titipKunci');
})->name('titipKunci');


// ==============================
// ROUTE UNTUK ADMIN & LOGIN
// ==============================

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::post('/logout', function () {
    Auth::guard('admin')->logout(); // <-- Properly log out from admin guard
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/admin/login')->with('message', 'Logged out due to inactivity.');
})->name('logout');


// ==============================
// ROUTE ADMIN VIEWS SECTION
// ==============================

// FIX: hanya gunakan 1 route dashboard, dan pastikan data $komentars dibawa dari controller
Route::get('/admin/dashboard', [ViewsController::class, 'dashboardView'])
    ->middleware('auth:admin')
    ->name('admin.dashboard');

// ==============================
// ROUTE ADMIN Store Data
// ==============================
Route::post('/admin/dashboard', [StoreController::class, 'store'])->name('admin.store');

// ==============================
// ROUTE ADMIN Delete Data
// ==============================
Route::delete('/admin/delete/{tipe}/{id}', [DeleteController::class, 'destroy'])->name('admin.delete');

// ==============================
// ROUTE ADMIN Edit Data
// ==============================
Route::patch('/admin/komentar/{id}', [EditController::class, 'KomentarUpdate'])->name('komentar.update');
Route::put('/admin/komentar/{id}', [EditController::class, 'KomentarUpdate'])->name('komentar.update');



Route::post('/komentar-tpj', [KomentarTpjController::class, 'store'])->name('komentar-tpj.store');
Route::patch('/komentar-tpj/{id}/accept', [KomentarTpjController::class, 'accept'])->name('komentar-tpj.accept');
Route::delete('/komentar-tpj/{id}/delete', [KomentarTpjController::class, 'delete'])->name('komentar-tpj.delete');
Route::patch('/komentar-tpj/{id}/unapply', [KomentarTpjController::class, 'unapply'])->name('komentar-tpj.unapply');


// Route untuk komentar TPC

Route::post('/komentar-tpc', [KomentarTpcController::class, 'store'])->name('komentar-tpc.store');
Route::patch('/komentar-tpc/{id}/accept', [KomentarTpcController::class, 'accept'])->name('komentar-tpc.accept');
Route::patch('/komentar-tpc/{id}/unapply', [KomentarTpcController::class, 'unapply'])->name('komentar-tpc.unapply');
Route::delete('/komentar-tpc/{id}/delete', [KomentarTpcController::class, 'delete'])->name('komentar-tpc.delete');

// Route untuk komentar GKL

Route::post('/komentar-gkl', [KomentarGklController::class, 'store'])->name('komentar-gkl.store');
Route::patch('/komentar-gkl/{id}/accept', [KomentarGklController::class, 'accept'])->name('komentar-gkl.accept');
Route::patch('/komentar-gkl/{id}/unapply', [KomentarGklController::class, 'unapply'])->name('komentar-gkl.unapply');
Route::delete('/komentar-gkl/{id}/delete', [KomentarGklController::class, 'delete'])->name('komentar-gkl.delete');

// Route untuk komentar plu

Route::post('/komentar-plu', [KomentarPluController::class, 'store'])->name('komentar-plu.store');
Route::patch('/komentar-plu/{id}/accept', [KomentarPluController::class, 'accept'])->name('komentar-plu.accept');
Route::patch('/komentar-plu/{id}/unapply', [KomentarPluController::class, 'unapply'])->name('komentar-plu.unapply');
Route::delete('/komentar-plu/{id}/delete', [KomentarPluController::class, 'delete'])->name('komentar-plu.delete');

// Route untuk komentar gwc

Route::post('/komentar-gwc', [KomentarGwcController::class, 'store'])->name('komentar-gwc.store');
Route::patch('/komentar-gwc/{id}/accept', [KomentarGwcController::class, 'accept'])->name('komentar-gwc.accept');
Route::patch('/komentar-gwc/{id}/unapply', [KomentarGwcController::class, 'unapply'])->name('komentar-gwc.unapply');
Route::delete('/komentar-gwc/{id}/delete', [KomentarGwcController::class, 'delete'])->name('komentar-gwc.delete');

// Route untuk komentar pgv

Route::post('/komentar-pgv', [KomentarPgvController::class, 'store'])->name('komentar-pgv.store');
Route::patch('/komentar-pgv/{id}/accept', [KomentarPgvController::class, 'accept'])->name('komentar-pgv.accept');
Route::patch('/komentar-pgv/{id}/unapply', [KomentarPgvController::class, 'unapply'])->name('komentar-pgv.unapply');
Route::delete('/komentar-pgv/{id}/delete', [KomentarPgvController::class, 'delete'])->name('komentar-pgv.delete');

// Route untuk komentar gpc
Route::post('/komentar-gpc', [KomentarGpcController::class, 'store'])->name('komentar-gpc.store');
Route::patch('/komentar-gpc/{id}/accept', [KomentarGpcController::class, 'accept'])->name('komentar-gpc.accept');
Route::patch('/komentar-gpc/{id}/unapply', [KomentarGpcController::class, 'unapply'])->name('komentar-gpc.unapply');
Route::delete('/komentar-gpc/{id}/delete', [KomentarGpcController::class, 'delete'])->name('komentar-gpc.delete');

// Route untuk komentar bsc
Route::post('/komentar-bsc', [KomentarBscController::class, 'store'])->name('komentar-bsc.store');
Route::patch('/komentar-bsc/{id}/accept', [KomentarBscController::class, 'accept'])->name('komentar-bsc.accept');
Route::patch('/komentar-bsc/{id}/unapply', [KomentarBscController::class, 'unapply'])->name('komentar-bsc.unapply');
Route::delete('/komentar-bsc/{id}/delete', [KomentarBscController::class, 'delete'])->name('komentar-bsc.delete');

// Route existing untuk accept/unapply/delete tetap bisa digunakan (bekerja untuk semua section)



Route::post('/save-form-data', [FormDataController::class, 'store']);
Route::get('/get-form-data/{apartment_type}', [FormDataController::class, 'getDataByApartment']);
Route::get('/form-data/{id}', [FormDataController::class, 'show']);
Route::delete('/admin/delete-form/{id}', [FormDataController::class, 'destroy']);