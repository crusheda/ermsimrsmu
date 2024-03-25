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

    // PROFIL KARYAWAN - KEPEGAWAIAN
    Route::get('profilkaryawan/setaktif/{id}', [\App\Http\Controllers\ProfilKaryawanController::class, 'setAktif'])->name('profilkaryawan.setaktif');
    Route::get('profilkaryawan/setnonaktif/{id}', [\App\Http\Controllers\ProfilKaryawanController::class, 'setNonAktif'])->name('profilkaryawan.setnonaktif');
    Route::get('profilkaryawan/nonaktif', [\App\Http\Controllers\ProfilKaryawanController::class, 'tableNonaktif'])->name('profilkaryawan.nonaktif');
    Route::get('profilkaryawan/nonlengkap', [\App\Http\Controllers\ProfilKaryawanController::class, 'tableNonLengkap'])->name('profilkaryawan.nonlengkap');

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
        Route::get('perbaikan/ipsrs/lokasi', '\App\Http\Controllers\Perbaikan\ipsrsController@autocompleteLokasi')->name('ipsrs.ac.lokasi');
        Route::post('perbaikan/ipsrs/verif/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@verif')->name('ipsrs.verif');
        Route::post('perbaikan/ipsrs/unverif/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@unverif')->name('ipsrs.unverif');
        Route::post('perbaikan/ipsrs/process/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@process')->name('ipsrs.process');
        Route::post('perbaikan/ipsrs/finish/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@finish')->name('ipsrs.finish');
        Route::get('perbaikan/ipsrs/result/{id}', '\App\Http\Controllers\Perbaikan\ipsrsController@result')->name('ipsrs.result');
        Route::post('perbaikan/ipsrs/filter', '\App\Http\Controllers\Perbaikan\ipsrsController@filter')->name('ipsrs.filter');

    // INVENTARIS
        // ASET RUANGAN
            Route::get('inventaris/aset/ruangan', '\App\Http\Controllers\Inventaris\Aset\AsetRuanganController@table')->name('aset_ruangan.table');
            Route::get('inventaris/aset/ruangan/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetRuanganController@getRuangan')->name('aset_ruangan.getRuangan');
            Route::post('inventaris/aset/ruangan/store', '\App\Http\Controllers\Inventaris\Aset\AsetRuanganController@store')->name('aset_ruangan.simpan');
            Route::post('inventaris/aset/ruangan/ubah', '\App\Http\Controllers\Inventaris\Aset\AsetRuanganController@update')->name('aset_ruangan.ubah');
            Route::delete('inventaris/aset/ruangan/hapus/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetRuanganController@destroy')->name('aset_ruangan.hapus');
        // ADDON
            Route::get('inventaris/aset/getTahunBulanPengadaan', '\App\Http\Controllers\Inventaris\Aset\AsetController@getTahunBulanPengadaan')->name('aset.getTahunBulanPengadaan');
            Route::get('inventaris/aset/getruangan/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetController@getRuangan')->name('aset.getruangan');
        // ASET
            Route::get('inventaris/aset/{token}', '\App\Http\Controllers\Inventaris\Aset\AsetController@getAsetToken')->name('aset.getAsetToken');
            Route::post('inventaris/aset/store', '\App\Http\Controllers\Inventaris\Aset\AsetController@store')->name('aset.simpan');
            Route::post('inventaris/aset/filter', '\App\Http\Controllers\Inventaris\Aset\AsetController@filter')->name('aset.filter');
            Route::delete('inventaris/aset/hapus/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetController@hapus')->name('aset.hapus');
            // Route::get('inventaris/aset/qrcode/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetController@qrcode')->name('aset.qrcode');
        // DETAIL ASET
            Route::get('inventaris/aset/{token}/kondisi/{kondisi}', '\App\Http\Controllers\Inventaris\Aset\AsetController@ubahKondisi')->name('aset_detail.ubahKondisi');
        // PEMINJAMAN ASET
            Route::get('inventaris/aset/peminjaman/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetPeminjamanPengembalianController@getPeminjamanAset')->name('aset_peminjaman.getPeminjamanAset');
            Route::get('inventaris/aset/pengembalian/{id}', '\App\Http\Controllers\Inventaris\Aset\AsetPeminjamanPengembalianController@getPengembalianAset')->name('aset_peminjaman.getPengembalianAset');

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

    // MUTU
        // MANAJEMEN RISIKO
        Route::get('manrisk/data','\App\Http\Controllers\Mutu\ManriskController@table');
        Route::get('manrisk/hapus/{id}', '\App\Http\Controllers\Mutu\ManriskController@hapus');
// });
