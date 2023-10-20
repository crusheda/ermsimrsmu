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

// Route::group(['middleware' => ['auth']], function () {

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

        // REGULASI
        Route::get('regulasi/showtambah', '\App\Http\Controllers\Berkas\RegulasiController@showTambah');
        Route::post('regulasi/tambah', '\App\Http\Controllers\Berkas\RegulasiController@tambah')->name('regulasi.tambah');
        Route::get('regulasi/showubah/{id}', '\App\Http\Controllers\Berkas\RegulasiController@showUbah');
        Route::post('regulasi/ubah', '\App\Http\Controllers\Berkas\RegulasiController@ubah')->name('regulasi.ubah');
        Route::delete('regulasi/{id}', '\App\Http\Controllers\Berkas\RegulasiController@hapus');
        Route::post('regulasi/filter', '\App\Http\Controllers\Berkas\RegulasiController@cariRegulasi');
        Route::get('regulasi/totalregulasi', '\App\Http\Controllers\Berkas\RegulasiController@apiTotalRegulasi');

        // LAPORAN BULANAN
        Route::get('laporan/bulanan/table/verif/{id}', '\App\Http\Controllers\Berkas\LaporanBulananController@verif');
        Route::get('laporan/bulanan/formverif/{id}', '\App\Http\Controllers\Berkas\LaporanBulananController@formVerif');
        Route::get('laporan/bulanan/formupload/{id}', '\App\Http\Controllers\Berkas\LaporanBulananController@formUpload');
        Route::get('laporan/bulanan/table/{id}/verif', '\App\Http\Controllers\Berkas\LaporanBulananController@tableVerif');
        Route::get('laporan/bulanan/table/{id}', '\App\Http\Controllers\Berkas\LaporanBulananController@table');
        Route::get('laporan/bulanan/getubah/{id}','\App\Http\Controllers\Berkas\LaporanBulananController@getUbah');
        Route::get('laporan/bulanan/hapus/{id}','\App\Http\Controllers\Berkas\LaporanBulananController@hapus');
        Route::post('laporan/bulanan/ubah/{id}','\App\Http\Controllers\Berkas\LaporanBulananController@ubah');


// });
