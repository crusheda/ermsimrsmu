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

Route::get('/', function () {
    return view('pages.comingsoon');
})->name('portal');

Route::get('/masuk', [App\Http\Controllers\LoginController::class, 'index'])->name('auth.login');

// Auth::routes();
Auth::routes(['register' => false]);
// Auth::routes(['register' => false]);

Route::get('/dashboard', [App\Http\Controllers\Dashboard\DefaultController::class, 'index'])->name('dashboard');

// HAK AKSES
Route::group(['middleware' => ['auth'], 'prefix' => 'hakakses', 'as' => ''], function () {
    Route::resource('datakaryawan', '\App\Http\Controllers\HakAkses\DataKaryawanController');
});

// PROFIL KARYAWAN
Route::get('/profilkaryawan', [App\Http\Controllers\ProfilKaryawanController::class, 'index'])->name('profilkaryawan.index');
Route::get('/profilkaryawan/{id}', [App\Http\Controllers\ProfilKaryawanController::class, 'show'])->name('profilkaryawan.show');
Route::delete('/profilkaryawan/{id}/nonaktif', [App\Http\Controllers\ProfilKaryawanController::class, 'destroy'])->name('profilkaryawan.destroy');
// Route::resource('profilkaryawan', '\App\Http\Controllers\ProfilKaryawanController');

// CATATAN

// Route::get('/kunjungan', 'kunjunganController@index')->name('landing.kunjungan');
