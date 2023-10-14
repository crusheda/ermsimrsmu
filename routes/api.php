<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// PROFIL
Route::get('provinsi/{id}', '\App\Http\Controllers\Setting\Profil\ProfilController@apiProvinsi');
Route::get('kota/{id}', '\App\Http\Controllers\Setting\Profil\ProfilController@apiKota');
Route::get('kecamatan/{id}', '\App\Http\Controllers\Setting\Profil\ProfilController@apiKecamatan');

// HAK AKSES
Route::get('hakakses/datakaryawan/verif/{id}', '\App\Http\Controllers\HakAkses\DataKaryawanController@verifName')->name('datakaryawan.verif');
Route::get('hakakses/datakaryawan/hapus/{id}', '\App\Http\Controllers\HakAkses\DataKaryawanController@hapus')->name('datakaryawan.hapus');

// STRUKTUR ORGANISASI
Route::get('strukturorganisasi/hapus/{id}', '\App\Http\Controllers\StrukturOrganisasiController@destroy')->name('strukturorganisasi.hapus');

// RAPAT
Route::get('berkas/rapat/data', '\App\Http\Controllers\Berkas\RapatController@getRapat');
Route::get('berkas/rapat/data/{id}', '\App\Http\Controllers\Berkas\RapatController@detailRapat');
Route::post('berkas/rapat/data/{id}/ubah', '\App\Http\Controllers\Berkas\RapatController@ubah');
Route::get('berkas/rapat/data/{id}/hapus', '\App\Http\Controllers\Berkas\RapatController@hapusRapat');
Route::get('berkas/rapat/data/{id}/download', '\App\Http\Controllers\Berkas\RapatController@getFile');
Route::get('berkas/rapat/data/{id}/zip', '\App\Http\Controllers\Berkas\RapatController@showAll');

// BERKAS
    // RKA
    Route::get('rka/table', '\App\Http\Controllers\Berkas\RkaController@table');
    Route::get('rka/hapus/{id}', '\App\Http\Controllers\Berkas\RkaController@hapus');
