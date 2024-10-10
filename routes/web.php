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
    return view('pages.index');
})->name('portal');

Route::get('/masuk', [App\Http\Controllers\LoginController::class, 'index'])->name('auth.login');

Route::get('/dashboard', [App\Http\Controllers\Dashboard\DefaultController::class, 'index'])->name('dashboard');
Route::get('/clear-cache', [App\Http\Controllers\Dashboard\DefaultController::class, 'clearCache'])->name('clearcache');

Route::group(['middleware' => ['auth']], function () {
    // PROFIL
    Route::get('profil/ubahpassword', [App\Http\Controllers\Setting\UbahPassword\UbahPasswordController::class, 'showChangePasswordForm'])->name('profil.ubahpassword');
    Route::patch('profil/ubahpassword', [App\Http\Controllers\Setting\UbahPassword\UbahPasswordController::class, 'changePassword'])->name('auth.change_password');
    Route::resource('profil', '\App\Http\Controllers\Setting\Profil\ProfilController');
    Route::put('profil/{id}/ubahfoto', [App\Http\Controllers\Setting\Profil\ProfilController::class, 'storeImg'])->name('profil.ubahfoto');
    Route::get('profil/dokumen/download/{id}', '\App\Http\Controllers\Setting\Profil\ProfilController@downloadDokumen');
});

// HAK AKSES
Route::group(['middleware' => ['auth'], 'prefix' => 'hakakses', 'as' => ''], function () {
    // AKSES JABATAN
    Route::get('aksesjabatan', '\App\Http\Controllers\HakAkses\AksesJabatanController@index')->name('aksesjabatan.index');
    Route::post('aksesjabatan/storeAkses', '\App\Http\Controllers\HakAkses\AksesJabatanController@storeAkses')->name('akses.store');
    Route::post('aksesjabatan/storeJabatan', '\App\Http\Controllers\HakAkses\AksesJabatanController@storeJabatan')->name('jabatan.store');
    Route::delete('akses', '\App\Http\Controllers\HakAkses\AksesJabatanController@hapusAkses')->name('akses.destroy');
    Route::delete('jabatan', '\App\Http\Controllers\HakAkses\AksesJabatanController@hapusJabatan')->name('jabatan.destroy');
    // AKUN PENGGUNA
    Route::resource('akunpengguna', '\App\Http\Controllers\HakAkses\DataKaryawanController');
});

// KEPEGAWAIAN
Route::group(['middleware' => ['auth'], 'prefix' => 'kepegawaian', 'as' => ''], function () {
    // STRUKTUR ORGANISASI
    Route::get('strukturorganisasi', [App\Http\Controllers\StrukturOrganisasiController::class, 'index'])->name('strukturorganisasi.index');
    Route::get('strukturorganisasi/tambah', [App\Http\Controllers\StrukturOrganisasiController::class, 'create'])->name('strukturorganisasi.tambah');
    Route::post('strukturorganisasi', [App\Http\Controllers\StrukturOrganisasiController::class, 'store'])->name('strukturorganisasi.simpan');
    Route::get('strukturorganisasi/{id}/ubah', [App\Http\Controllers\StrukturOrganisasiController::class, 'edit'])->name('strukturorganisasi.ubah');
    Route::put('strukturorganisasi/{id}', [App\Http\Controllers\StrukturOrganisasiController::class, 'update'])->name('strukturorganisasi.update');

    // PROFIL KARYAWAN
    Route::get('profilkaryawan', [App\Http\Controllers\Kepegawaian\ProfilKaryawanController::class, 'index'])->name('profilkaryawan.index');
    Route::get('profilkaryawan/{id}', [App\Http\Controllers\Kepegawaian\ProfilKaryawanController::class, 'show'])->name('profilkaryawan.show');
    Route::get('profilkaryawan/detail/{id}', [App\Http\Controllers\Setting\Profil\ProfilController::class, 'indexKepegawaian'])->name('profilkaryawan.kepegawaian');
    Route::get('profilkaryawan/dokumen/download/{id}', [App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class,'downloadDokumen'])->name('profilkaryawan.downloadDokumen');
    Route::get('profilkaryawan/spkrkk/download/{id}', [App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class,'downloadSpkRkk'])->name('profilkaryawan.downloadSpkRkk');
    Route::delete('profilkaryawan/{id}/nonaktif', [App\Http\Controllers\Kepegawaian\ProfilKaryawanController::class, 'destroy'])->name('profilkaryawan.destroy');
    Route::resource('profilkaryawan', '\App\Http\Controllers\Kepegawaian\ProfilKaryawanController');

    // PENGAJUAN
        // SURAT KETERANGAN (SURKET)
        Route::get('pengajuan/surket', [App\Http\Controllers\Kepegawaian\SurketController::class, 'index'])->name('kepegawaian.surket.index');

        // IDCARD
        Route::get('pengajuan/idcard', [App\Http\Controllers\Kepegawaian\IDCardController::class, 'index'])->name('kepegawaian.idcard.index');

    // SURAT TUGAS
    Route::get('pd', [App\Http\Controllers\Kepegawaian\PDController::class, 'index'])->name('kepegawaian.pd.index');

    // MASUKAN / SARAN
    Route::get('feedback', [App\Http\Controllers\Kepegawaian\SaranController::class, 'index'])->name('kepegawaian.feedback.index');
    Route::post('feedback/store', [App\Http\Controllers\Kepegawaian\SaranController::class, 'store'])->name('kepegawaian.feedback.store');
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
        // DISPOSISI
            Route::get('disposisi', '\App\Http\Controllers\Berkas\Surat\DisposisiController@index')->name('disposisi.index');
            Route::get('disposisi/{id}', '\App\Http\Controllers\Berkas\Surat\DisposisiController@show')->name('disposisi.show');
        // SURAT MASUK
            Route::get('suratmasuk', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@index')->name('suratmasuk.index');
            Route::get('suratmasuk/{id}/download', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@download');
            Route::post('suratmasuk', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@store')->name('suratmasuk.store');
        // SURAT KELUAR
            Route::get('suratkeluar', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@index')->name('suratkeluar.index');
            Route::get('suratkeluar/{id}/download', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@download');
            Route::post('suratkeluar', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@store')->name('suratkeluar.store');
});

// PENGADAAN
Route::group(['middleware' => ['auth'], 'prefix' => '', 'as' => ''], function () {
    // NEW
    Route::post('pengadaan/rekap', '\App\Http\Controllers\Pengadaan\PengadaanRekapController@index')->name('pengadaanrekap.index');
    Route::get('pengadaan', '\App\Http\Controllers\Pengadaan\PengadaanController@index')->name('pengadaan.index');

    // OLD
    // Route::get('pengadaan/api/data', 'publik\pengadaan\pengadaanController@getPengadaan')->name('pengadaan.api.data');
    // Route::get('pengadaan/api/data/{id}', 'publik\pengadaan\pengadaanController@detailPengadaan')->name('pengadaan.api.detailData');
    // Route::get('pengadaan/api/data/hapus/{id}', 'publik\pengadaan\pengadaanController@hapusPengadaan')->name('pengadaan.api.hapus');
    // Route::get('pengadaan/tambah/api/barang/detail/{id}', 'publik\pengadaan\pengadaanController@getBarangDetail')->name('pengadaan.api.barangDetail');
    // Route::get('pengadaan/tambah/api/barang/{id}', 'publik\pengadaan\pengadaanController@getBarang')->name('pengadaan.api.barang');
    // Route::post('pengadaan/tambah', 'publik\pengadaan\pengadaanController@create')->name('pengadaan.create');
    // Route::post('pengadaan', 'publik\pengadaan\pengadaanController@store')->name('pengadaan.store');
    // Route::get('pengadaan/api/barang', 'publik\pengadaan\barangPengadaanController@apiGet')->name('barang.api.get');
    // Route::get('pengadaan/api/barang/hapus/{id}', 'publik\pengadaan\barangPengadaanController@apiHapus')->name('barang.api.hapus');
    // Route::resource('pengadaan/barang', 'publik\pengadaan\barangPengadaanController');

    //     // Rekap Pengadaan
    //     Route::get('pengadaan/rekap', 'publik\pengadaan\pengadaanController@indexRekap')->name('rekap.index');
    //     Route::get('pengadaan/rekap/all', 'publik\pengadaan\pengadaanController@RekapAll')->name('rekapAll.index');
    //     Route::get('pengadaan/rekap/api/data/bulan/{bulan}/tahun/{tahun}', 'publik\pengadaan\pengadaanController@getRekap')->name('rekap.api.data');
    //     Route::get('pengadaan/rekap/api/data/barang/addfield/{barang}', 'publik\pengadaan\pengadaanController@addField')->name('rekap.api.dataBarangAddField');
});

// PENGADUAN
Route::group(['middleware' => ['auth'], 'prefix' => 'perbaikan', 'as' => ''], function () {
    // IPSRS
        Route::post('ipsrs/catatan', '\App\Http\Controllers\Perbaikan\ipsrsController@catatan')->name('ipsrs.catatan');
        Route::get('ipsrs/catatan/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@downloadCatatan')->name('ipsrs.downloadcatatan');
        Route::post('ipsrs/catatan/ubah', '\App\Http\Controllers\Perbaikan\ipsrsController@ubahCatatan')->name('ipsrs.ubahCatatan');
        Route::get('ipsrs/detail/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@detail')->name('ipsrs.detail');
        Route::get('ipsrs/riwayat', '\App\Http\Controllers\Perbaikan\ipsrsController@riwayat')->name('ipsrs.riwayat');
        Route::resource('ipsrs', '\App\Http\Controllers\Perbaikan\ipsrsController');
        // Route::post('ipsrs/selesai', '\App\Http\Controllers\Perbaikan\ipsrsController@selesai')->name('pengaduan.ipsrs.selesai');
        // Route::post('ipsrs/tambahketerangan', '\App\Http\Controllers\Perbaikan\ipsrsController@tambahketerangan')->name('pengaduan.ipsrs.tambahketerangan');
        // Route::post('ipsrs/kerjakan', '\App\Http\Controllers\Perbaikan\ipsrsController@kerjakan')->name('pengaduan.ipsrs.kerjakan');
        // Route::post('ipsrs/kerjakan/ubah', '\App\Http\Controllers\Perbaikan\ipsrsController@ubahKerjakan')->name('pengaduan.ipsrs.ubah.kerjakan');
        // Route::post('ipsrs/terima', '\App\Http\Controllers\Perbaikan\ipsrsController@terima')->name('pengaduan.ipsrs.terima');
        // Route::post('ipsrs/terima/ubah', '\App\Http\Controllers\Perbaikan\ipsrsController@ubahTerima')->name('pengaduan.ipsrs.ubah.terima');
        // Route::post('ipsrs/tolak', '\App\Http\Controllers\Perbaikan\ipsrsController@tolak')->name('pengaduan.ipsrs.tolak');
        // Route::get('ipsrs/history', '\App\Http\Controllers\Perbaikan\ipsrsController@history')->name('ipsrs.history');
});

// E-RUANG
Route::group(['middleware' => ['auth'], 'prefix' => 'eruang', 'as' => ''], function () {
    // Accident Report - Kecelakan Kerja
        Route::get('/', [App\Http\Controllers\ERuang\ERuangController::class, 'index'])->name('eruang.index');
        Route::get('/ruangan', [App\Http\Controllers\ERuang\ERuangController::class, 'indexRuangan'])->name('eruang.ruangan');
});

// INVENTARIS
Route::group(['middleware' => ['auth'], 'prefix' => 'inventaris', 'as' => ''], function () {
    // ASET RUANGAN
    Route::get('aset/ruangan','\App\Http\Controllers\Inventaris\Aset\AsetRuanganController@index')->name('aset_ruangan.index');

    // ASET
    Route::get('aset','\App\Http\Controllers\Inventaris\Aset\AsetController@index')->name('aset.index');
    Route::get('aset/{token}','\App\Http\Controllers\Inventaris\Aset\AsetController@detail')->name('aset.detail');
});

// PELAYANAN
Route::group(['middleware' => ['auth'], 'prefix' => 'pelayanan', 'as' => ''], function () {
    // Kebidanan
        Route::get('kebidanan/skl/all','\App\Http\Controllers\Pelayanan\Kebidanan\sklController@showAll')->name('skl.all');
        Route::get('kebidanan/skl/{id}/cetak','\App\Http\Controllers\Pelayanan\Kebidanan\sklController@cetak')->name('skl.cetak');
        Route::get('kebidanan/skl/{id}/print','\App\Http\Controllers\Pelayanan\Kebidanan\sklController@print')->name('skl.print');
        Route::resource('kebidanan/skl', '\App\Http\Controllers\Pelayanan\Kebidanan\sklController');

    // Lab
        // Route::get('lab/antigen/all','lab\antigenController@showAll')->name('antigen.all');
        Route::get('lab/antigen/filter','\App\Http\Controllers\Pelayanan\Lab\antigenController@filter')->name('antigen.filter');
        Route::get('lab/antigen/{id}/cetak','\App\Http\Controllers\Pelayanan\Lab\antigenController@cetak')->name('antigen.cetak');
        Route::get('lab/antigen/{id}/print','\App\Http\Controllers\Pelayanan\Lab\antigenController@print')->name('antigen.print');
        Route::resource('/lab/antigen', '\App\Http\Controllers\Pelayanan\Lab\antigenController');
});

// K3
    // MFK
    Route::group(['middleware' => ['auth'], 'prefix' => 'mfk', 'as' => ''], function () {
        // Accident Report - Kecelakan Kerja
            Route::get('kecelakaankerja','\App\Http\Controllers\MFK\AccidentReportController@index')->name('accidentreport.index');
            Route::get('kecelakaankerja/tambah','\App\Http\Controllers\MFK\AccidentReportController@tambah')->name('accidentreport.tambah');
            Route::post('kecelakaankerja/simpan','\App\Http\Controllers\MFK\AccidentReportController@store')->name('accidentreport.store');
            Route::get('kecelakaankerja/ubah/{id}','\App\Http\Controllers\MFK\AccidentReportController@ubah')->name('accidentreport.showupdate');
            Route::put('kecelakaankerja/ubah','\App\Http\Controllers\MFK\AccidentReportController@update')->name('accidentreport.update');
    });

    // Mutu
    Route::group(['middleware' => ['auth'], 'prefix' => 'mutu', 'as' => ''], function () {
        // Manajemen Risiko
            Route::get('manrisk','\App\Http\Controllers\Mutu\ManriskController@index')->name('manrisk.index');
            Route::post('manrisk', [App\Http\Controllers\Mutu\ManriskController::class, 'store'])->name('manrisk.store');
            Route::get('manrisk/{id}/download', '\App\Http\Controllers\Mutu\ManriskController@download');
    });

// ----------------------------------------------------------------------------------------------------------------------------------------------------
// CATATAN

// Route::get('/kunjungan', 'kunjunganController@index')->name('landing.kunjungan');

// ----------------------------------------------------------------------------------------------------------------------------------------------------
// SIMRSMU V3.1
// Route::get('/dashboardx', [App\Http\Controllers\Dashboard\DefaultController::class, 'index2'])->name('dashboardx');
// Route::group(['middleware' => ['auth']], function () {
//     Route::get('profilx', [App\Http\Controllers\Setting\Profil\ProfilController::class, 'index2'])->name('profilx');
// });
// // Route::get('/starter', function () {
// //     return view('pages.dashboard.index');
// // })->name('starter');

// // INVENTARIS
// Route::group(['middleware' => ['auth'], 'prefix' => 'inventaris', 'as' => ''], function () {
//     // ASET RUANGAN
//     Route::get('asetx/ruangan','\App\Http\Controllers\Inventaris\Aset\AsetRuanganController@index')->name('asetx_ruangan.index');

//     // ASET
//     Route::get('asetx','\App\Http\Controllers\Inventaris\Aset\AsetController@index2')->name('asetx.index');
//     Route::get('asetx/{token}','\App\Http\Controllers\Inventaris\Aset\AsetController@detail2')->name('asetx.detail');
// });

