<?php

use Illuminate\Support\Facades\Route;

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


// Auth::routes();
Auth::routes(['register' => false]);
// Auth::routes(['register' => false]);
// ----------------------------------------------------------------------------------------------------------------------------------------------------
Route::get('/', function () {
    return view('pages.comingsoon');
})->name('portal');

Route::get('/masuk', [App\Http\Controllers\LoginController::class, 'index'])->name('auth.login');

Route::get('/dashboard', [App\Http\Controllers\Dashboard\DefaultController::class, 'index'])->name('dashboard');

// HAK AKSES
Route::group(['middleware' => ['auth'], 'prefix' => 'hakakses', 'as' => ''], function () {
    Route::resource('datakaryawan', '\App\Http\Controllers\HakAkses\DataKaryawanController');
});

// STRUKTUR ORGANISASI
Route::get('strukturorganisasi', [App\Http\Controllers\StrukturOrganisasiController::class, 'index'])->name('strukturorganisasi.index');
Route::get('strukturorganisasi/tambah', [App\Http\Controllers\StrukturOrganisasiController::class, 'create'])->name('strukturorganisasi.tambah');
Route::post('strukturorganisasi', [App\Http\Controllers\StrukturOrganisasiController::class, 'store'])->name('strukturorganisasi.simpan');
Route::get('strukturorganisasi/{id}/ubah', [App\Http\Controllers\StrukturOrganisasiController::class, 'edit'])->name('strukturorganisasi.ubah');
Route::put('strukturorganisasi/{id}', [App\Http\Controllers\StrukturOrganisasiController::class, 'update'])->name('strukturorganisasi.update');

// PROFIL KARYAWAN
Route::get('/profilkaryawan', [App\Http\Controllers\ProfilKaryawanController::class, 'index'])->name('profilkaryawan.index');
Route::get('/profilkaryawan/{id}', [App\Http\Controllers\ProfilKaryawanController::class, 'show'])->name('profilkaryawan.show');
Route::delete('/profilkaryawan/{id}/nonaktif', [App\Http\Controllers\ProfilKaryawanController::class, 'destroy'])->name('profilkaryawan.destroy');
// Route::resource('profilkaryawan', '\App\Http\Controllers\ProfilKaryawanController');

// BERKAS
Route::group(['middleware' => ['auth'], 'prefix' => 'berkas', 'as' => ''], function () {
    // RKA
    Route::post('rka/fileupload', [App\Http\Controllers\Berkas\RkaController::class, 'fileupload'])->name('rka.upload');
    Route::resource('rka', '\App\Http\Controllers\Berkas\RkaController');
});

// ----------------------------------------------------------------------------------------------------------------------------------------------------
// CATATAN

// Route::get('/kunjungan', 'kunjunganController@index')->name('landing.kunjungan');
