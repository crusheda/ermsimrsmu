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
    // Route::post('profil/fotoprofil', '\App\Http\Controllers\Setting\Profil\ProfilController@storeBlobImg');
    Route::get('provinsi/{id}', '\App\Http\Controllers\Setting\Profil\ProfilController@apiProvinsi');
    Route::get('kota/{id}', '\App\Http\Controllers\Setting\Profil\ProfilController@apiKota');
    Route::get('kecamatan/{id}', '\App\Http\Controllers\Setting\Profil\ProfilController@apiKecamatan');
    Route::get('profil/dokumen/table/{id}', '\App\Http\Controllers\Setting\Profil\ProfilController@tableDokumen');
    Route::post('profil/dokumen/add', '\App\Http\Controllers\Setting\Profil\ProfilController@tambahDokumen')->name('profil.storeDokumen');
    Route::post('profil/dokumen/ubah/{id}/proses', '\App\Http\Controllers\Setting\Profil\ProfilController@ubahDokumen')->name('profil.ubahDokumen');
    Route::delete('profil/dokumen/hapus/{id}/proses', '\App\Http\Controllers\Setting\Profil\ProfilController@hapusDokumen')->name('profil.hapusDokumen');
    Route::get('profil/dokumen/ubah/{id}', '\App\Http\Controllers\Setting\Profil\ProfilController@showUbahDokumen')->name('profil.showUbahDokumen');

    // PROFIL KARYAWAN - KEPEGAWAIAN
    Route::get('profilkaryawan/table', [\App\Http\Controllers\Kepegawaian\ProfilKaryawanController::class, 'table'])->name('profilkaryawan.table');
    Route::get('profilkaryawan/{user}/setaktif/{id}', [\App\Http\Controllers\Kepegawaian\ProfilKaryawanController::class, 'setAktif'])->name('profilkaryawan.setaktif');
    Route::get('profilkaryawan/setnonaktif/{id}', [\App\Http\Controllers\Kepegawaian\ProfilKaryawanController::class, 'setNonAktif'])->name('profilkaryawan.setnonaktif');
    Route::get('profilkaryawan/nonaktif', [\App\Http\Controllers\Kepegawaian\ProfilKaryawanController::class, 'tableNonaktif'])->name('profilkaryawan.nonaktif');
    Route::get('profilkaryawan/nonlengkap', [\App\Http\Controllers\Kepegawaian\ProfilKaryawanController::class, 'tableNonLengkap'])->name('profilkaryawan.nonlengkap');
    Route::get('profilkaryawan/{user}/hapus/{id}/proses', [\App\Http\Controllers\Kepegawaian\ProfilKaryawanController::class, 'hapusPegawai'])->name('profilkaryawan.hapusPegawai');

        // PENETAPAN
        Route::get('profilkaryawan/penetapan/table/{id}', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'tablePenetapan'])->name('profilkaryawan.tablePenetapan');
        Route::post('profilkaryawan/penetapan/tambah', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'tambahPenetapan'])->name('profilkaryawan.tambahPenetapan');
        Route::get('profilkaryawan/penetapan/ubah/{id}', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'showUbahPenetapan'])->name('profilkaryawan.show.ubahPenetapan');
        Route::post('profilkaryawan/penetapan/ubah/{id}/proses', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'ubahPenetapan'])->name('profilkaryawan.ubahPenetapan');
        Route::delete('profilkaryawan/penetapan/hapus/{id}/proses', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'hapusPenetapan'])->name('profilkaryawan.hapusPenetapan');
        // ROTASI
        Route::get('profilkaryawan/rotasi/table/{id}', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'tableRotasi'])->name('profilkaryawan.tableRotasi');
        Route::post('profilkaryawan/rotasi/tambah', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'tambahRotasi'])->name('profilkaryawan.tambahRotasi');
        Route::get('profilkaryawan/rotasi/ubah/{id}', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'showUbahRotasi'])->name('profilkaryawan.show.ubahRotasi');
        Route::post('profilkaryawan/rotasi/ubah/{id}/proses', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'ubahRotasi'])->name('profilkaryawan.ubahRotasi');
        Route::delete('profilkaryawan/rotasi/hapus/{id}/proses', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'hapusRotasi'])->name('profilkaryawan.hapusRotasi');
        // DOKUMEN
        Route::get('profilkaryawan/dokumen/table/{id}', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'tableDokumen'])->name('profilkaryawan.tableDokumen');
        // SPK RKK
        Route::get('profilkaryawan/spkrkk/table/{id}', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'tableSpkRkk'])->name('profilkaryawan.tableSpkRkk');
        Route::post('profilkaryawan/spkrkk/tambah', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'tambahSpkRkk'])->name('profilkaryawan.tambahSpkRkk');
        Route::get('profilkaryawan/spkrkk/ubah/{id}', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'showUbahSpkRkk'])->name('profilkaryawan.show.ubahSpkRkk');
        Route::post('profilkaryawan/spkrkk/ubah/{id}/proses', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'ubahSpkRkk'])->name('profilkaryawan.ubahSpkRkk');
        Route::delete('profilkaryawan/spkrkk/hapus/{id}/proses', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'hapusSpkRkk'])->name('profilkaryawan.hapusSpkRkk');
        // KEPEGAWAIAN (NIP & KLASIFIKASI)
        Route::get('profilkaryawan/kepegawaian/{id}', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'showKepegawaian'])->name('profilkaryawan.show.kepegawaian');
        Route::post('profilkaryawan/kepegawaian/nip/simpan', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'tambahNIP'])->name('profilkaryawan.tambahNIP');
        Route::post('profilkaryawan/kepegawaian/klasifikasi/simpan', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'tambahKlasifikasi'])->name('profilkaryawan.tambahKlasifikasi');

    // KEPEGAWAIAN
        // PENGAJUAN
            // IDCARD
                // ADMIN
                Route::get('kepegawaian/pengajuan/idcard/table', [\App\Http\Controllers\Kepegawaian\IDCardController::class, 'table'])->name('kepegawaian.idcard.table');
                Route::post('kepegawaian/pengajuan/idcard/status', [\App\Http\Controllers\Kepegawaian\IDCardController::class, 'ubahStatus'])->name('kepegawaian.idcard.ubahStatus');
                // USER
                Route::post('kepegawaian/pengajuan/idcard/tambah', [\App\Http\Controllers\Kepegawaian\IDCardController::class, 'tambahPengajuan'])->name('kepegawaian.idcard.tambahPengajuan');
                Route::get('kepegawaian/pengajuan/idcard/riwayat/{id}', [\App\Http\Controllers\Kepegawaian\IDCardController::class, 'riwayat'])->name('kepegawaian.idcard.riwayat');
                Route::delete('kepegawaian/pengajuan/idcard/{id}/delete', [\App\Http\Controllers\Kepegawaian\IDCardController::class, 'hapusPengajuan'])->name('kepegawaian.idcard.hapusPengajuan');
                // Route::post('kepegawaian/pengajuan/idcard/ubah/{id}/proses', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'ubahPenetapan'])->name('profilkaryawan.ubahPenetapan');
                // Route::delete('kepegawaian/pengajuan/idcard/hapus/{id}/proses', [\App\Http\Controllers\Kepegawaian\DetailProfilKaryawanController::class, 'hapusPenetapan'])->name('profilkaryawan.hapusPenetapan');
            // SURAT KETERANGAN
                // ADMIN
                Route::get('kepegawaian/pengajuan/surket/table', [\App\Http\Controllers\Kepegawaian\SurketController::class, 'tableAdmin'])->name('kepegawaian.surket.tableAdmin');
                Route::get('kepegawaian/pengajuan/surket/{id}/verif/{user}', [\App\Http\Controllers\Kepegawaian\SurketController::class, 'verif'])->name('kepegawaian.surket.verif');
                Route::get('kepegawaian/pengajuan/surket/{id}/unverif', [\App\Http\Controllers\Kepegawaian\SurketController::class, 'unverif'])->name('kepegawaian.surket.unverif');
                Route::get('kepegawaian/pengajuan/surket/{id}/ubahstatus', [\App\Http\Controllers\Kepegawaian\SurketController::class, 'ubahStatus'])->name('kepegawaian.surket.ubahStatus');
                Route::get('kepegawaian/pengajuan/surket/{id}/tolak', [\App\Http\Controllers\Kepegawaian\SurketController::class, 'tolak'])->name('kepegawaian.surket.tolak');
                // USER
                Route::get('kepegawaian/pengajuan/surket/{id}/table', [\App\Http\Controllers\Kepegawaian\SurketController::class, 'tableUser'])->name('kepegawaian.surket.tableUser');
                Route::post('kepegawaian/pengajuan/surket/tambah', [\App\Http\Controllers\Kepegawaian\SurketController::class, 'tambah'])->name('kepegawaian.surket.tambah');
                Route::delete('kepegawaian/pengajuan/surket/{id}/delete', [\App\Http\Controllers\Kepegawaian\SurketController::class, 'hapus'])->name('kepegawaian.surket.hapus');
        // PERJALANAN DINAS
            Route::get('kepegawaian/pd/table', [\App\Http\Controllers\Kepegawaian\PDController::class, 'table'])->name('kepegawaian.pd.table');
            Route::get('kepegawaian/pd/{id}', [\App\Http\Controllers\Kepegawaian\PDController::class, 'show'])->name('kepegawaian.pd.show');
            Route::post('kepegawaian/pd/{id}/ubah', [\App\Http\Controllers\Kepegawaian\PDController::class, 'update'])->name('kepegawaian.pd.update');
            Route::post('kepegawaian/pd/tambah', [\App\Http\Controllers\Kepegawaian\PDController::class, 'tambah'])->name('kepegawaian.pd.tambah');
            Route::delete('kepegawaian/pd/{id}/hapus', [\App\Http\Controllers\Kepegawaian\PDController::class, 'hapus'])->name('kepegawaian.pd.hapus');
            // USER
        // JADWAL DINAS
            Route::post('kepegawaian/jadwaldinas/tambah', [\App\Http\Controllers\Kepegawaian\JadwalController::class, 'storePengajuan'])->name('kepegawaian.jadwaldinas.storePengajuan');
            Route::get('kepegawaian/jadwaldinas/shift/{id}/user/{user}', [\App\Http\Controllers\Kepegawaian\JadwalController::class, 'cekShift'])->name('kepegawaian.jadwaldinas.cekShift');
            Route::get('kepegawaian/jadwaldinas/table/{id}', [\App\Http\Controllers\Kepegawaian\JadwalController::class, 'table'])->name('kepegawaian.jadwaldinas.table');


    // HAK AKSES
        // AKSES JABATAN
        Route::get('hakakses/aksesjabatan/data', '\App\Http\Controllers\HakAkses\AksesJabatanController@tableAksesJabatan')->name('aksesjabatan.data');
        Route::post('hakakses/aksesjabatan/store', '\App\Http\Controllers\HakAkses\AksesJabatanController@store')->name('aksesjabatan.store');
        Route::get('hakakses/aksesjabatan/hapus/{id}', '\App\Http\Controllers\HakAkses\AksesJabatanController@destroy')->name('aksesaksesjabatan.hapus');
        Route::get('hakakses/akses/data', '\App\Http\Controllers\HakAkses\AksesJabatanController@tableAkses')->name('akses.data');
        Route::post('hakakses/akses/store', '\App\Http\Controllers\HakAkses\AksesJabatanController@storeAkses')->name('akses.store');
        Route::get('hakakses/akses/hapus/{id}', '\App\Http\Controllers\HakAkses\AksesJabatanController@hapusAkses')->name('akses.hapus');
        Route::get('hakakses/jabatan/data', '\App\Http\Controllers\HakAkses\AksesJabatanController@tableJabatan')->name('jabatan.data');
        Route::post('hakakses/jabatan/store', '\App\Http\Controllers\HakAkses\AksesJabatanController@storeJabatan')->name('jabatan.store');
        Route::get('hakakses/jabatan/hapus/{id}', '\App\Http\Controllers\HakAkses\AksesJabatanController@hapusJabatan')->name('jabatan.hapus');

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
        // Route::get('rka/hapus/{id}', '\App\Http\Controllers\Berkas\RkaController@hapus');
        Route::delete('rka/hapus/{id}', '\App\Http\Controllers\Berkas\RkaController@hapus');

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

        // DISPOSISI
        Route::get('disposisi/data', '\App\Http\Controllers\Berkas\Surat\DisposisiController@apiGet')->name('disposisi.data');
        Route::get('disposisi/data/all', '\App\Http\Controllers\Berkas\Surat\DisposisiController@apiGetAll')->name('disposisi.dataAll');
        Route::get('disposisi/data/{id}', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@apiGetDisposisi')->name('disposisi.detail');
        Route::post('disposisi/simpan', '\App\Http\Controllers\Berkas\Surat\DisposisiController@store')->name('disposisi.simpan');
        Route::delete('disposisi/{id}', '\App\Http\Controllers\Berkas\Surat\DisposisiController@hapus')->name('disposisi.hapus');

        // SURAT MASUK
        Route::get('suratmasuk/data', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@apiGet');
        Route::get('suratmasuk/tambah', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@formTambah');
        Route::get('suratmasuk/filter/{bulan}/{tahun}', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@getFilterSurat');
        Route::get('suratmasuk/data/all', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@apiGetAll');
        Route::get('suratmasuk/data/disposisi/{id}', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@apiGetDisposisi');
        Route::get('suratmasuk/data/{id}', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@showChange');
        Route::post('suratmasuk/ubah', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@ubah')->name('suratmasuk.ubah');
        // Route::put('suratmasuk/{id}', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@update');
        Route::delete('suratmasuk/{id}', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@hapus');
        Route::get('suratmasuk/cariasal', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@acAsal')->name('ac.asal.cari');
        Route::get('suratmasuk/caritempat', '\App\Http\Controllers\Berkas\Surat\SuratMasukController@acTempat')->name('ac.tempat.cari');

        // SURAT KELUAR
        Route::get('suratkeluar/getkode/{id}', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@apiKode');
        // Route::get('suratkeluar/filter/{id}', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@getFilterSurat');
        Route::get('suratkeluar/filter/{surat}/{bulan}/{tahun}', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@getFilterSurat');
        Route::get('suratkeluar/data', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@apiGet');
        Route::get('suratkeluar/data/{id}', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@showChange');
        Route::post('suratkeluar/ubah', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@ubah')->name('suratkeluar.ubah');
        Route::delete('suratkeluar/{id}', '\App\Http\Controllers\Berkas\Surat\SuratKeluarController@hapus');

    // PENGADAAN
    Route::get('pengadaan/data/{id}', '\App\Http\Controllers\Pengadaan\PengadaanController@dataPengadaan')->name('pengadaan.data');
    Route::get('pengadaan/riwayat/{id}', '\App\Http\Controllers\Pengadaan\PengadaanController@riwayatPengadaan')->name('pengadaan.riwayat');
    Route::delete('pengadaan/riwayat/{id}/hapus', '\App\Http\Controllers\Pengadaan\PengadaanController@hapusRiwayatPengadaan')->name('pengadaan.hapusriwayat');
    Route::get('pengadaan/keranjang/{id}/tampil', '\App\Http\Controllers\Pengadaan\PengadaanController@tampilTambahKeranjang')->name('pengadaan.tampiltambah-keranjang');
    Route::get('pengadaan/keranjang/{id}', '\App\Http\Controllers\Pengadaan\PengadaanController@tampilKeranjang')->name('pengadaan.keranjang');
    Route::post('pengadaan/keranjang/tambah', '\App\Http\Controllers\Pengadaan\PengadaanController@tambahKeranjang')->name('pengadaan.tambah-keranjang');
    Route::post('pengadaan/keranjang/checkout', '\App\Http\Controllers\Pengadaan\PengadaanController@checkoutKeranjang')->name('pengadaan.checkout-keranjang');
    Route::delete('pengadaan/keranjang/{id}/hapus', '\App\Http\Controllers\Pengadaan\PengadaanController@hapusKeranjang')->name('pengadaan.hapus-keranjang');
    Route::get('pengadaan/barang', '\App\Http\Controllers\Pengadaan\PengadaanController@loadMore')->name('pengadaan.loadmore');
    Route::get('pengadaan/caribarang', '\App\Http\Controllers\Pengadaan\PengadaanController@getacbarang')->name('pengadaan.getacbarang');
    // Route::get('pengadaan/autocomplete/barang', '\App\Http\Controllers\Pengadaan\PengadaanController@acbarang')->name('pengadaan.acbarang');

    // PENGADUAN
        // IPSRS
            // USER
                Route::get('perbaikan/ipsrs/lokasi', '\App\Http\Controllers\Perbaikan\ipsrsController@autocompleteLokasi')->name('ipsrs.ac.lokasi');
                Route::get('perbaikan/ipsrs/user/table/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@tableUser')->name('ipsrs.user.table');
                Route::get('perbaikan/ipsrs/user/track/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@track')->name('ipsrs.user.track');
                Route::get('perbaikan/ipsrs/user/ubah/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@getUbah')->name('ipsrs.user.ubah');
                Route::post('perbaikan/ipsrs/user/ubah', '\App\Http\Controllers\Perbaikan\ipsrsController@prosesUbah')->name('ipsrs.user.prosesUbah');
                Route::delete('perbaikan/ipsrs/user/hapus/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@prosesHapus')->name('ipsrs.user.prosesHapus');
            // ADMIN
                Route::get('perbaikan/ipsrs/admin/table', '\App\Http\Controllers\Perbaikan\ipsrsController@tableAdmin')->name('ipsrs.admin.table');
                Route::get('perbaikan/ipsrs/admin/lampiran/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@lampiranAdmin')->name('ipsrs.admin.lampiran');
                Route::post('perbaikan/ipsrs/filter', '\App\Http\Controllers\Perbaikan\ipsrsController@filter')->name('ipsrs.filter');
                // DETAIL
                    Route::post('perbaikan/ipsrs/verif/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@verif')->name('ipsrs.verif');
                    Route::post('perbaikan/ipsrs/unverif/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@unverif')->name('ipsrs.unverif');
                    Route::post('perbaikan/ipsrs/process/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@process')->name('ipsrs.process');
                    Route::post('perbaikan/ipsrs/finish/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@finish')->name('ipsrs.finish');
                    Route::get('perbaikan/ipsrs/result/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@result')->name('ipsrs.result');

    // E-RUANG
        Route::get('eruang', 'App\Http\Controllers\ERuang\ERuangController@table')->name('eruang.table');
        Route::post('eruang/store', 'App\Http\Controllers\ERuang\ERuangController@store')->name('eruang.store');
        Route::post('eruang/ubah/{id}/proses', 'App\Http\Controllers\ERuang\ERuangController@ubah')->name('eruang.ubah');
        Route::post('eruang/tolak/{id}', 'App\Http\Controllers\ERuang\ERuangController@tolak')->name('eruang.tolak');
        Route::get('eruang/ubah/{id}', 'App\Http\Controllers\ERuang\ERuangController@getUbah')->name('eruang.getUbah');
        Route::get('eruang/gizi/verif/{id}', 'App\Http\Controllers\ERuang\ERuangController@verifGizi')->name('eruang.verifGizi');
        Route::get('eruang/gizi/verif/edithapus/{id}', 'App\Http\Controllers\ERuang\ERuangController@verifEditHapus')->name('eruang.verifEditHapus');
        Route::delete('eruang/hapus/{id}', 'App\Http\Controllers\ERuang\ERuangController@hapus')->name('eruang.hapus');
        Route::get('eruang/display', 'App\Http\Controllers\ERuang\ERuangController@display')->name('eruang.display');
        // DAFTAR RUANGAN
            Route::get('eruang/ruangan', 'App\Http\Controllers\ERuang\ERuangController@getRuangan')->name('eruang.getRuangan');
            Route::post('eruang/ruangan/store', 'App\Http\Controllers\ERuang\ERuangController@storeRuangan')->name('eruang.storeRuangan');
            Route::delete('eruang/ruangan/hapus/{id}', 'App\Http\Controllers\ERuang\ERuangController@destroyRuangan')->name('eruang.destroyRuangan');
            Route::get('eruang/ruangan/ubah/{id}', 'App\Http\Controllers\ERuang\ERuangController@getUbahRuangan')->name('eruang.getUbahRuangan');
            Route::post('eruang/ruangan/ubah/proses', 'App\Http\Controllers\ERuang\ERuangController@updateRuangan')->name('eruang.updateRuangan');

    // INVENTARIS
        // ENCRYPT - DECRYPT
            Route::get('inventaris/aset/en/{token}', '\App\Http\Controllers\Inventaris\Aset\AsetController@makeEncrypt')->name('aset.makeEncrypt');
            Route::get('inventaris/aset/de/{token}', '\App\Http\Controllers\Inventaris\Aset\AsetController@makeDecrypt')->name('aset.makeDecrypt');
        // DETAIL ASET
            Route::get('inventaris/aset/{id}/fresh', '\App\Http\Controllers\Inventaris\Aset\AsetController@fresh')->name('aset_detail.fresh');
            Route::get('inventaris/aset/{token}/kondisi/{kondisi}', '\App\Http\Controllers\Inventaris\Aset\AsetController@ubahKondisi')->name('aset_detail.ubahKondisi');
        // PEMELHARAAN ASET
            Route::get('inventaris/aset/pemeliharaan/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetPemeliharaanController@index')->name('aset_pemeliharaan.index');
            Route::post('inventaris/aset/pemeliharaan/store', '\App\Http\Controllers\Inventaris\Aset\AsetPemeliharaanController@store')->name('aset_pemeliharaan.store');
            Route::get('inventaris/aset/pemeliharaan/destroy/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetPemeliharaanController@destroy')->name('aset_pemeliharaan.destroy');
        // MUTASI ASET
            Route::get('inventaris/aset/mutasi/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetMutasiController@index')->name('aset_mutasi.index');
            Route::post('inventaris/aset/mutasi/store', '\App\Http\Controllers\Inventaris\Aset\AsetMutasiController@store')->name('aset_mutasi.store');
            Route::get('inventaris/aset/mutasi/destroy/cariaset/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetMutasiController@cariAsetDestroy')->name('aset_mutasi.cariAsetDestroy');
            Route::get('inventaris/aset/mutasi/destroy/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetMutasiController@destroy')->name('aset_mutasi.destroy');
        // PEMINJAMAN - PENGEMBALIAN ASET
            Route::get('inventaris/aset/peminjaman/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetPeminjamanPengembalianController@getPeminjamanAset')->name('aset_peminjaman.getPeminjamanAset');
            Route::post('inventaris/aset/peminjaman/store', '\App\Http\Controllers\Inventaris\Aset\AsetPeminjamanPengembalianController@storePeminjaman')->name('aset_peminjaman.store');
            Route::post('inventaris/aset/pengembalian/store', '\App\Http\Controllers\Inventaris\Aset\AsetPeminjamanPengembalianController@storePengembalian')->name('aset_pengembalian.store');
            Route::get('inventaris/aset/pengembalian/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetPeminjamanPengembalianController@getPengembalianAset')->name('aset_pengembalian.getPengembalianAset');
        // PENARIKAN ASET
            Route::get('inventaris/aset/penarikan/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetPenarikanController@index')->name('aset_penarikan.index');
            Route::post('inventaris/aset/penarikan/store', '\App\Http\Controllers\Inventaris\Aset\AsetPenarikanController@store')->name('aset_penarikan.store');
            Route::get('inventaris/aset/penarikan/destroy/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetPenarikanController@destroy')->name('aset_penarikan.destroy');
        // ASET RUANGAN
            Route::get('inventaris/aset/ruangan', '\App\Http\Controllers\Inventaris\Aset\AsetRuanganController@table')->name('aset_ruangan.table');
            Route::get('inventaris/aset/ruangan/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetRuanganController@getRuangan')->name('aset_ruangan.getRuangan');
            Route::post('inventaris/aset/ruangan/store', '\App\Http\Controllers\Inventaris\Aset\AsetRuanganController@store')->name('aset_ruangan.simpan');
            Route::post('inventaris/aset/ruangan/ubah', '\App\Http\Controllers\Inventaris\Aset\AsetRuanganController@update')->name('aset_ruangan.ubah');
            Route::delete('inventaris/aset/ruangan/hapus/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetRuanganController@destroy')->name('aset_ruangan.hapus');
        // ADDON
            Route::get('inventaris/aset/getTahunBulanPengadaan', '\App\Http\Controllers\Inventaris\Aset\AsetController@getTahunBulanPengadaan')->name('aset.getTahunBulanPengadaan');
            Route::get('inventaris/aset/getruangan/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetController@getRuangan')->name('aset.getruangan');
            Route::get('inventaris/aset/getkalibrasi/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetController@getKalibrasi')->name('aset.getkalibrasi');
            Route::post('inventaris/aset/updatekalibrasi', '\App\Http\Controllers\Inventaris\Aset\AsetController@updateKalibrasi')->name('aset.updatekalibrasi');
            // Route::get('inventaris/aset/{id}/updatekalibrasi/{no_kalibrasi}/{tgl_berlaku}/{tgl_berakhir}', '\App\Http\Controllers\Inventaris\Aset\AsetController@updateKalibrasi')->name('aset.updatekalibrasi');
        // ASET
            Route::get('inventaris/aset/refreshtoken', '\App\Http\Controllers\Inventaris\Aset\AsetController@refreshToken')->name('aset.refreshToken');
            Route::get('inventaris/aset/{token}', '\App\Http\Controllers\Inventaris\Aset\AsetController@getAsetToken')->name('aset.getAsetToken');
            Route::get('inventaris/aset/ubah/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetController@getUbahAset')->name('aset.getUbahAset');
            Route::post('inventaris/aset/update', '\App\Http\Controllers\Inventaris\Aset\AsetController@update')->name('aset.update');
            Route::post('inventaris/aset/store', '\App\Http\Controllers\Inventaris\Aset\AsetController@store')->name('aset.simpan');
            Route::post('inventaris/aset/filter', '\App\Http\Controllers\Inventaris\Aset\AsetController@filter')->name('aset.filter');
            Route::delete('inventaris/aset/hapus/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetController@hapus')->name('aset.hapus');
            // Route::get('inventaris/aset/qrcode/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetController@qrcode')->name('aset.qrcode');

    // PELAYANAN
        // SKL
        Route::get('kebidanan/skl/get','\App\Http\Controllers\Pelayanan\Kebidanan\sklController@apiGet');
        Route::get('kebidanan/skl/cari/{id}','\App\Http\Controllers\Pelayanan\Kebidanan\sklController@filterIbu');
        Route::get('kebidanan/skl/all','\App\Http\Controllers\Pelayanan\Kebidanan\sklController@apiAll');
        Route::get('kebidanan/skl/getubah/{id}', '\App\Http\Controllers\Pelayanan\Kebidanan\sklController@getubah');
        Route::get('kebidanan/skl/hapus/{id}', '\App\Http\Controllers\Pelayanan\Kebidanan\sklController@hapus');
        Route::post('kebidanan/skl/ubah/{id}', '\App\Http\Controllers\Pelayanan\Kebidanan\sklController@ubah');

        // ANTIGEN
        Route::get('antigen/all','\App\Http\Controllers\Pelayanan\Lab\antigenController@apiShowAll')->name('antigen.apiall');
        Route::get('antigen/get','\App\Http\Controllers\Pelayanan\Lab\antigenController@apiGet')->name('antigen.apiget');
        Route::post('antigen/filter', '\App\Http\Controllers\Pelayanan\Lab\antigenController@apiFilter')->name('antigen.apifilter');
        // Route::get('antigen/filter/{id}', '\App\Http\Controllers\Pelayanan\Lab\antigenController@apiFilter')->name('antigen.apiFilter');
        Route::post('antigen/ubah/{id}', '\App\Http\Controllers\Pelayanan\Lab\antigenController@ubah')->name('antigen.ubah');
        Route::get('antigen/getubah/{id}', '\App\Http\Controllers\Pelayanan\Lab\antigenController@getubah')->name('antigen.getubah');
        Route::get('antigen/hapus/{id}', '\App\Http\Controllers\Pelayanan\Lab\antigenController@hapus')->name('antigen.hapus');
        Route::get('antigen/getpasien/{id}', '\App\Http\Controllers\Pelayanan\Lab\antigenController@getPasien');

    // K3
        // MFK
            // KECELAKAAN KERJA
            Route::get('mfk/kecelakaankerja/data','\App\Http\Controllers\MFK\AccidentReportController@table');
            Route::get('mfk/kecelakaankerja/{id}/hapus','\App\Http\Controllers\MFK\AccidentReportController@destroy');
        // MUTU
            // MANAJEMEN RISIKO
            Route::get('manrisk/data','\App\Http\Controllers\Mutu\ManriskController@table');
            Route::get('manrisk/hapus/{id}', '\App\Http\Controllers\Mutu\ManriskController@hapus');
// });
