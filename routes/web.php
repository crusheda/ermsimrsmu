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

Route::group(['middleware' => ['auth']], function () {
    // PROFIL
    Route::get('profil/ubahpassword', [App\Http\Controllers\Setting\UbahPassword\UbahPasswordController::class, 'showChangePasswordForm'])->name('profil.ubahpassword');
    Route::patch('profil/ubahpassword', [App\Http\Controllers\Setting\UbahPassword\UbahPasswordController::class, 'changePassword'])->name('auth.change_password');
    Route::resource('profil', '\App\Http\Controllers\Setting\Profil\ProfilController');
    Route::put('profil/{id}/ubahfoto', [App\Http\Controllers\Setting\Profil\ProfilController::class, 'storeImg'])->name('profil.ubahfoto');
});

// HAK AKSES
Route::group(['middleware' => ['auth'], 'prefix' => 'hakakses', 'as' => ''], function () {
    // AKSES JABATAN
    Route::get('aksesjabatan', '\App\Http\Controllers\HakAkses\AksesJabatanController@index')->name('aksesjabatan.index');
    Route::post('aksesjabatan', '\App\Http\Controllers\HakAkses\AksesJabatanController@destroy')->name('aksesjabatan.destroy');
    Route::post('aksesjabatan/store', '\App\Http\Controllers\HakAkses\AksesJabatanController@store')->name('aksesjabatan.store');
    Route::post('aksesjabatan/storeAkses', '\App\Http\Controllers\HakAkses\AksesJabatanController@storeAkses')->name('akses.store');
    Route::post('aksesjabatan/storeJabatan', '\App\Http\Controllers\HakAkses\AksesJabatanController@storeJabatan')->name('jabatan.store');
    Route::delete('akses', '\App\Http\Controllers\HakAkses\AksesJabatanController@hapusAkses')->name('akses.destroy');
    Route::delete('jabatan', '\App\Http\Controllers\HakAkses\AksesJabatanController@hapusJabatan')->name('jabatan.destroy');
    // AKUN PENGGUNA
    Route::resource('akunpengguna', '\App\Http\Controllers\HakAkses\DataKaryawanController');
});

Route::group(['middleware' => ['auth']], function () {
    // STRUKTUR ORGANISASI
    Route::get('strukturorganisasi', [App\Http\Controllers\StrukturOrganisasiController::class, 'index'])->name('strukturorganisasi.index');
    Route::get('strukturorganisasi/tambah', [App\Http\Controllers\StrukturOrganisasiController::class, 'create'])->name('strukturorganisasi.tambah');
    Route::post('strukturorganisasi', [App\Http\Controllers\StrukturOrganisasiController::class, 'store'])->name('strukturorganisasi.simpan');
    Route::get('strukturorganisasi/{id}/ubah', [App\Http\Controllers\StrukturOrganisasiController::class, 'edit'])->name('strukturorganisasi.ubah');
    Route::put('strukturorganisasi/{id}', [App\Http\Controllers\StrukturOrganisasiController::class, 'update'])->name('strukturorganisasi.update');

    // PROFIL KARYAWAN
    Route::get('profilkaryawan', [App\Http\Controllers\ProfilKaryawanController::class, 'index'])->name('profilkaryawan.index');
    Route::get('profilkaryawan/{id}', [App\Http\Controllers\ProfilKaryawanController::class, 'show'])->name('profilkaryawan.show');
    Route::get('profilkaryawan/detail/{id}', [App\Http\Controllers\Setting\Profil\ProfilController::class, 'indexKepegawaian'])->name('profilkaryawan.kepegawaian');
    Route::delete('profilkaryawan/{id}/nonaktif', [App\Http\Controllers\ProfilKaryawanController::class, 'destroy'])->name('profilkaryawan.destroy');
    Route::resource('profilkaryawan', '\App\Http\Controllers\ProfilKaryawanController');
});

// BERKAS
Route::group(['middleware' => ['auth'], 'prefix' => 'berkas', 'as' => ''], function () {
    // RKA
        Route::post('rka/fileupload', [App\Http\Controllers\Berkas\RkaController::class, 'fileupload'])->name('rka.upload');
        Route::resource('rka', '\App\Http\Controllers\Berkas\RkaController');
    // RAPAT
        // Route::post('rapat/fileupload', [App\Http\Controllers\Berkas\RkaController::class, 'fileupload'])->name('rka.upload');
        Route::resource('rapat', '\App\Http\Controllers\Berkas\RapatController');
    // REGULASI
        Route::get('regulasi', '\App\Http\Controllers\Berkas\RegulasiController@index')->name('regulasi.index');
        Route::get('regulasi/{id}/download', '\App\Http\Controllers\Berkas\RegulasiController@download')->name('regulasi.download');
    // LAPORAN BULANAN
        Route::get('laporan/bulanan/verif', '\App\Http\Controllers\Berkas\LaporanBulananController@showVerif')->name('bulanan.verif');
        Route::resource('laporan/bulanan', '\App\Http\Controllers\Berkas\LaporanBulananController');
    // SURAT
        // SURAT MASUK
            Route::get('suratmasuk', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@index')->name('suratmasuk.index');
            Route::get('suratmasuk/{id}/download', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@download');
            Route::post('suratmasuk', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@store')->name('suratmasuk.store');
        // SURAT KELUAR
            Route::get('suratkeluar', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@index')->name('suratkeluar.index');
            Route::get('suratkeluar/{id}/download', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@download');
            Route::post('suratkeluar', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@store')->name('suratkeluar.store');
});

// ----------------------------------------------------------------------------------------------------------------------------------------------------
// CATATAN

// Route::get('/kunjungan', 'kunjunganController@index')->name('landing.kunjungan');
