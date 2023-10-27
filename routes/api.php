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
        // JABATAN
        Route::get('hakakses/jabatan/hapus/{id}', '\App\Http\Controllers\HakAkses\JabatanController@hapus')->name('jabatan.hapus');

        // AKUN PENGGUNA
        Route::get('hakakses/akunpengguna/verif/{id}', '\App\Http\Controllers\HakAkses\DataKaryawanController@verifName')->name('akunpengguna.verif');
        Route::get('hakakses/akunpengguna/hapus/{id}', '\App\Http\Controllers\HakAkses\DataKaryawanController@hapus')->name('akunpengguna.hapus');

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
        Route::get('laporan/bulanan/table/verif/{id}/batal', '\App\Http\Controllers\Berkas\LaporanBulananController@batalVerif');
        Route::get('laporan/bulanan/table/verif/{id}/user/{user}', '\App\Http\Controllers\Berkas\LaporanBulananController@verifUser');
        Route::get('laporan/bulanan/formverif/{id}', '\App\Http\Controllers\Berkas\LaporanBulananController@formVerif');
        Route::get('laporan/bulanan/formupload/{id}', '\App\Http\Controllers\Berkas\LaporanBulananController@formUpload');
        Route::get('laporan/bulanan/table/{id}/verif', '\App\Http\Controllers\Berkas\LaporanBulananController@tableVerif');
        Route::get('laporan/bulanan/table/{id}', '\App\Http\Controllers\Berkas\LaporanBulananController@table');
        Route::get('laporan/bulanan/getubah/{id}','\App\Http\Controllers\Berkas\LaporanBulananController@getUbah');
        Route::get('laporan/bulanan/hapus/{id}','\App\Http\Controllers\Berkas\LaporanBulananController@hapus');
        Route::post('laporan/bulanan/ubah/{id}','\App\Http\Controllers\Berkas\LaporanBulananController@ubah');

        // SURAT MASUK
        Route::get('suratmasuk/data', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@apiGet');
        Route::get('suratmasuk/data/{id}', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@showChange');
        Route::post('suratmasuk/ubah', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@ubah')->name('suratmasuk.ubah');
        // Route::put('suratmasuk/{id}', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@update');
        Route::delete('suratmasuk/{id}', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@hapus');
        Route::get('suratmasuk/cariasal', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@acAsal')->name('ac.asal.cari');
        Route::get('suratmasuk/caritempat', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@acTempat')->name('ac.tempat.cari');

        // SURAT MASUK
        Route::get('suratkeluar/getkode/{id}', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@apiKode');
        Route::get('suratkeluar/data', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@apiGet');
        Route::get('suratkeluar/data/{id}', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@showChange');
        Route::post('suratkeluar/ubah', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@ubah')->name('suratkeluar.ubah');
        Route::delete('suratkeluar/{id}', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@hapus');

// });
