@extends('layouts.default')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Aset & Gudang - Daftar Sarana</h4>
            </div>
        </div>
    </div>

    <div class="card" style="overflow: visible;">

        <div class="card-body border-bottom">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 card-title flex-grow-1">Inventaris</h5>
                <div class="flex-shrink-0">
                    <div class="hstack gap-3 ms-auto">
                        <div class="btn-group">
                            <button class="btn btn-primary tombol-tambah" onclick="tambah()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Menambahkan Sarana"><i class='bx bx-plus scaleX-n1-rtl'></i> Tambah Sarana</button>
                            <button class="btn btn-warning" onclick="refresh()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Refresh Tabel Sarana" id="btn-refresh" disabled><i class="fas fa-sync fa-fw nav-icon"></i> Segarkan</button>
                            <button class="btn btn-dark" onclick="scan()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Scan QR-Code Aset" hidden><i class="fas fa-qrcode fa-fw nav-icon"></i></button>
                        </div>
                        <div class="vr"></div>
                        <div class="dropdown d-inline-block">
                            <button type="menu" class="btn btn-success" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i> Menu</button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('aset_ruangan.index') }}" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Daftar Ruangan Sarana">Daftar Ruangan</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body border-bottom">
            <div class="row g-3">
                <div class="col-xxl-4 col-lg-6">
                    <input type="search" class="form-control" id="searchTableList" placeholder="Cari Sarana ..." disabled>
                </div>
                <div class="col-xxl-2 col-lg-6">
                    <select class="form-select" id="idStatus" aria-label="Default select example" disabled>
                        <option value="" selected hidden>Jenis Sarana</option>
                        <option value="1">Medis</option>
                        <option value="2">Non Medis</option>
                    </select>
                </div>
                <div class="col-xxl-2 col-lg-4">
                    <select class="form-select" id="idType" aria-label="Default select example" disabled>
                        <option value="" selected hidden>Pilih Lokasi</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                    </select>
                </div>
                <div class="col-xxl-2 col-lg-4">
                    <div id="datepicker1">
                        <input type="text" class="form-control flatpickr" placeholder="Tanggal Aset" disabled>
                    </div><!-- input-group -->
                </div>
                <div class="col-xxl-2 col-lg-4">
                    <button type="button" class="btn btn-info w-100" onclick="filter()" data-bs-toggle="tooltip"
                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                    title="Menampilkan Daftar Aset Sekarang"><i class="mdi mdi-filter-outline align-middle"></i> Tampilkan</button>
                </div>
            </div>

        </div>
    </div>

    <div class="card card-body table-responsive" style="overflow: visible;" id="show-table" style="border: 0px" hidden>
        <table class="table align-middle dt-responsive w-100 table-check table-hover" id="dttable">
            <thead>
                <tr>
                    <th scope="col"><center>#ID</center></th>
                    <th scope="col">No. Inventaris</th>
                    <th scope="col">Sarana</th>
                    <th scope="col">Ruangan</th>
                    <th scope="col">Merk</th>
                    <th scope="col">Tipe</th>
                    <th scope="col">No. Seri</th>
                    <th scope="col">Kondisi</th>
                    <th scope="col">Dibuat</th>
                    <th scope="col">Diperbarui</th>
                </tr>
            </thead>
            <tbody id="tampil-tbody"></tbody>
        </table>
        <!-- end table -->
    </div>

    <!-- MODAL TAMBAH -->
    <div class="modal fade" tabindex="-1" id="modalTambah" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Tambah Sarana</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);" class="form-auth-small" id="formTambah" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="shadow-lg p-3 bg-body rounded">
                                    <div class="form-group">
                                        <label class="form-label mb-2">Nomor Inventaris</label>
                                        {{-- <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="tgl_surat" readonly/> --}}

                                            <h5 class="mb-1" id="no_inventaris_add">
                                                <a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="No. Baku Inventaris">00.03.27</a>.<a id="kd_ruangan_add" class="text-danger" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Kode Ruangan"> . . </a>.<a id="kd_jenis_add" class="text-primary" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Kode Jenis"> . . </a>.<a id="kd_sarana_add" class="text-warning" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="No. Urut Sarana"> . . </a>.<a id="kd_th_add" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tahun Perolehan Aset">{{ $list['year'] }}</a></a>
                                            </h5>
                                        <small>Apabila nomor Inventaris tidak sesuai, silakan klik <a href="javascript:void(0);" onclick="reloadBrowser()"><kbd>REFRESH</kbd></a></small>
                                        {{-- <input type="text" class="form-control" id="no_inventaris" hidden> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="text-muted">
                                    <p class="mb-1"><strong>Keterangan Pengisian :</strong></p>
                                    <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> Periksa No. Inventaris sebelum Submit</p>
                                    <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> Tanda <a class="text-danger">*</a> isian/input <strong>Wajib</strong> diisi</p>
                                    <p class="mb-0"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> Pastikan tidak berpindah halaman saat proses Submit berjalan</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Ruangan - Lokasi <a class="text-danger">*</a></label>
                                <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location='{{ route('aset_ruangan.index') }}'" style="--bs-btn-padding-y: 0.09rem;--bs-btn-padding-x: 0.3rem;" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Lihat Daftar Ruangan">Tidak menemukan ruangan ?</button>
                                <div class="select2-dark">
                                    <select class="select2 form-select" id="ruangan_add" data-allow-clear="false" data-bs-auto-close="outside" style="width: 100%" required>
                                        <option value="">Pilih</option>
                                        @if(count($list['ruangan']) > 0)
                                            @foreach($list['ruangan'] as $item)
                                                <option value="{{ $item->id }}">{{ $item->ruangan }} - {{ $item->lokasi }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jenis Aset <a class="text-danger">*</a></label>
                                <select class="form-select" id="jenis_add" required>
                                    <option value="" hidden>Pilih</option>
                                    <option value="1">Medis</option>
                                    <option value="2">Non Medis</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tgl. Perolehan</label>
                                <input type="text" id="tgl_perolehan_add" class="form-control flatpickrnow" placeholder="YYYY-MM-DD" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Batas tgl hanya >= hari ini"/>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 show_medis_add" hidden>
                            <div class="form-group">
                                <label class="form-label">No. Kalibrasi</label>
                                <input type="text" id="no_kalibrasi_add" class="form-control" placeholder="e.g. xxx">
                            </div>
                        </div>
                        <div class="col-md-6 show_medis_add" hidden>
                            <div class="form-group">
                                <label class="form-label">Tgl. Berlaku</label>
                                <input type="text" id="tgl_berlaku_add" class="form-control flatpickrunl" placeholder="YYYY-MM-DD" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tidak ada batasan pemilihan tanggal"/>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Sarana <a class="text-danger">*</a></label>
                                <input type="text" id="sarana_add" class="form-control" placeholder="e.g. xxx">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Merk <a class="text-danger">*</a></label>
                                <input type="text" id="merk_add" class="form-control" placeholder="e.g. xxx">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tipe</label>
                                <input type="text" id="tipe_add" class="form-control" placeholder="e.g. xxx">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">No. Seri</label>
                                <input type="text" id="no_seri_add" class="form-control" placeholder="e.g. xxx">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tgl. Operasi <a class="text-danger">*</a></label>
                                <input type="text" id="tgl_operasi_add" class="form-control flatpickrtom" placeholder="YYYY-MM-DD" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tgl mulai digunakan / diserahkan (>= hari ini)"/>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Asal Perolehan <a class="text-danger">*</a></label>
                                <select class="form-select" id="asal_perolehan_add" required>
                                    <option value="" hidden>Pilih</option>
                                    <option value="1" selected>Beli</option>
                                    <option value="2">Hibah</option>
                                    <option value="3">Wakaf</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nilai Perolehan</label>
                                <input type="text" id="nilai_perolehan_add" class="form-control" onclick="$(this).val('')" placeholder="Rp. xxx.xxx" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Masukkan Hanya Angka Tanpa Titik (.) / Koma (,) /dsb">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Kondisi <a class="text-danger">*</a></label>
                                <select class="form-select" id="kondisi_add" required>
                                    <option value="" hidden>Pilih</option>
                                    <option value="1" selected>Baik</option>
                                    <option value="2">Cukup</option>
                                    <option value="3">Buruk</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea rows="3" id="keterangan_add" class="form-control" placeholder="Optional"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Upload</label>
                                <input type="file" class="form-control mb-2" id="file_add" accept=".jpg,.jpeg,.png" multiple>
                                <i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berupa Gambar<br>
                                <i class="fa-fw fas fa-caret-right nav-icon"></i> Dapat upload gambar lebih dari satu<br>
                                <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum setiap File Gambar adalah <strong>5 mb</strong>
                                {{-- <i class="fa-fw fas fa-caret-right nav-icon"></i> Gunakan aplikasi WinRAR untuk membuka file Upload --}}
                            </div>
                        </div>
                        {{-- MASIH MENUNGGU PIHAK KEUANGAN UNTUK PENGAJUAN PEMBUATAN SISTEM BARU --}}
                        <div hidden>
                            <hr>
                            <div class="col-md-5 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Golongan</label>
                                    <input type="number" id="golongan_add" class="form-control" maxlength="1" max="4" placeholder="e.g. 1 / 2 / 3 / 4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Umur</label>
                                    <input type="text" class="form-control" id="umur_add" hidden>
                                    <input type="number" id="umur_add_show" class="form-control" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Rumus dari golongan" placeholder="Otomatis" disabled>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tarif</label>
                                    <input type="text" class="form-control" id="tarif_add" hidden>
                                    <input type="number" id="tarif_add_show" class="form-control" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Rumus dari umur" placeholder="Otomatis" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Penyusutan Per Bulan</label>
                                    <input type="text" class="form-control" id="penyusutan_add" hidden>
                                    <input type="number" id="penyusutan_add_show" class="form-control" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Rumus dari tarif" placeholder="Otomatis" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                    <button class="btn btn-info" onclick="simpan()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                        title="Simpan Data Aset Barang" id="btn-simpan"><i
                            class="fa-fw fas fa-save nav-icon"></i>&nbsp;&nbsp;Submit</button>
                    {{-- <button class="btn btn-primary" onclick="showKeranjang()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Lihat Keranjang"><i
                            class="bx bx-cart align-middle"></i>&nbsp;&nbsp;Keranjang</button> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL UBAH -->
    <div class="modal fade" tabindex="-1" id="modalUbah" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Ubah Sarana <kbd>ID : <a href="javascript:void(0);" id="show_id_edit" class="text-white"></a></kbd></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);" class="form-auth-small" id="formUbah" method="post" enctype="multipart/form-data">
                    <input type="text" class="form-control" id="id_edit" hidden>
                    <div class="row">
                        <div class="row">
                            <div class="col-md-5 mb-3">
                                <div class="shadow-lg p-3 bg-body rounded">
                                    <div class="form-group">
                                        <label class="form-label mb-2">Nomor Inventaris <a id="badge_jenis_edit"></a></label>
                                        <h5 class="mb-1">
                                            <a id="no_inventaris_edit" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="No. Inventaris"></a>
                                        </h5>
                                        {{-- <h5 class="mb-1" id="no_inventaris_edit">
                                            <a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="No. Baku Inventaris">00.03.27</a>.<a id="kd_ruangan_edit" class="text-danger" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Kode Ruangan"> . . </a>.<a id="kd_jenis_edit" class="text-primary" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Kode Jenis"> . . </a>.<a id="kd_sarana_edit" class="text-warning" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="No. Urut Sarana"> . . </a>.<a id="kd_th_edit" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tahun Perolehan Aset"></a></a>
                                        </h5> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 mb-3">
                                <div class="text-muted">
                                    <p class="mb-1"><strong>Keterangan :</strong></p>
                                    <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> Tanda <a class="text-danger">*</a> isian/input <strong>Wajib</strong> diisi</p>
                                    <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> No. Inventaris sudah <mark><strong>TIDAK DAPAT</strong></mark> diubah, Hapus aset apabila diperlukan</p>
                                    <p class="mb-0"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> Pastikan tidak berpindah halaman saat proses Simpan berjalan</p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Ruangan - Lokasi <a class="text-danger">*</a></label>
                                <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location='{{ route('aset_ruangan.index') }}'" style="--bs-btn-padding-y: 0.09rem;--bs-btn-padding-x: 0.3rem;" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Lihat Daftar Ruangan">Tidak menemukan ruangan ?</button>
                                <div class="select2-dark">
                                    <select class="select2 form-select" id="ruangan_edit" data-allow-clear="false" data-bs-auto-close="outside" style="width: 100%" required></select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jenis Aset <a class="text-danger">*</a></label>
                                <select class="form-select" id="jenis_edit" required></select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tgl. Perolehan</label>
                                <input type="text" id="tgl_perolehan_edit" class="form-control flatpickrnow" placeholder="YYYY-MM-DD" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Batas tgl hanya >= hari ini"/>
                            </div>
                        </div> --}}
                        <div class="col-md-6 mb-3 show_medis_edit" hidden>
                            <div class="form-group">
                                <label class="form-label">No. Kalibrasi</label>
                                <input type="text" id="no_kalibrasi_edit" class="form-control" placeholder="e.g. xxx">
                            </div>
                        </div>
                        <div class="col-md-6 show_medis_edit" hidden>
                            <div class="form-group">
                                <label class="form-label">Tgl. Berlaku</label>
                                <input type="text" id="tgl_berlaku_edit" class="form-control flatpickrunl" placeholder="YYYY-MM-DD" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tidak ada batasan pemilihan tanggal"/>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Sarana <a class="text-danger">*</a></label>
                                <input type="text" id="sarana_edit" class="form-control" placeholder="e.g. xxx">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Merk <a class="text-danger">*</a></label>
                                <input type="text" id="merk_edit" class="form-control" placeholder="e.g. xxx">
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tipe</label>
                                <input type="text" id="tipe_edit" class="form-control" placeholder="e.g. xxx">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">No. Seri</label>
                                <input type="text" id="no_seri_edit" class="form-control" placeholder="e.g. xxx">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tgl. Operasi <a class="text-danger">*</a></label>
                                <input type="text" id="tgl_operasi_edit" class="form-control flatpickrtom" placeholder="YYYY-MM-DD" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tgl mulai digunakan / diserahkan (>= hari ini)"/>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Asal Perolehan <a class="text-danger">*</a></label>
                                <select class="form-select" id="asal_perolehan_edit" required></select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nilai Perolehan</label>
                                <input type="text" id="nilai_perolehan_edit" class="form-control" onclick="$(this).val('')" placeholder="Rp. xxx.xxx" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Masukkan Hanya Angka Tanpa Titik (.) / Koma (,) /dsb">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Kondisi <a class="text-danger">*</a></label>
                                <select class="form-select" id="kondisi_edit" required></select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea rows="3" id="keterangan_edit" class="form-control" placeholder="Optional"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12" id="show_img_upload"></div>
                        <div class="col-md-12" id="ubah_img_upload" hidden>
                            <div class="form-group">
                                <label class="form-label">Upload</label>
                                <input type="file" class="form-control mb-2" id="file_edit" accept=".jpg,.jpeg,.png" multiple>
                                <i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berupa Gambar<br>
                                <i class="fa-fw fas fa-caret-right nav-icon"></i> Dapat upload gambar lebih dari satu<br>
                                <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum setiap File Gambar adalah <strong>5 mb</strong>
                                {{-- <i class="fa-fw fas fa-caret-right nav-icon"></i> Gunakan aplikasi WinRAR untuk membuka file Upload --}}
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                        class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                    <button class="btn btn-warning" onclick="prosesUbah()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                        title="Simpan Perubahan Data Aset Barang" id="btn-ubah"><i
                        class="fa-fw fas fa-edit nav-icon"></i>&nbsp;&nbsp;Submit</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div class="modal animate__animated animate__rubberBand fade" id="hapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Hapus Aset&nbsp;&nbsp;&nbsp;
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan menghapus Aset <kbd>ID :<strong><a id="show_id_hapus"></a></strong></kbd> tersebut. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuhapus">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-hapus" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapus()"><i class="fa fa-trash"></i> Hapus</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL SCAN --}}
    <div class="modal fade" id="modalScan" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Scan QR-Code Aset&nbsp;&nbsp;&nbsp;
                    </h4>
                </div>
                <div class="modal-body">
                    <div id="reader" width="300px"></div>
                    <div id="result" hidden></div>
                </div>
                <div class="col-12 text-center mb-4">
                    <button class="btn btn-primary me-sm-3 me-1" id="reload-scan" onclick="reloadScan()" hidden><i class="fa fa-qrcode"></i>&nbsp;&nbsp;Ulangi Scan</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/html5-qrcode.js') }}"></script>
    {{-- <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script> --}}
    <script>
        $(document).ready(function() {
            // PENENTUAN MENU AKSES
            var aksesAdmin = "{{ Auth::user()->getManyRole(['it','kasubag-aset-gudang']) }}";
            var aksesElektromedis = "{{ Auth::user()->getRole('elektromedis') }}";
            var aksesPIC = "{{ Auth::user()->getRole('pic-sarpras') }}";
            var aksesIPSRS = "{{ Auth::user()->getManyRole(['ipsrs','kasubag-ipsrs']) }}";
            // console.log(aksesAdmin+' - '+aksesElektromedis+' - '+aksesIPSRS+' - '+aksesPIC);
            // VALIDASI AKSES
            if (aksesAdmin == true) { // ALL ACCESS
                $(".tombol-tambah").prop('hidden', false);
            } else {
                if (aksesElektromedis == true) {
                    $(".tombol-tambah").prop('hidden', false);
                } else {
                    if (aksesPIC == true) {
                        $(".tombol-tambah").prop('hidden', false);
                    } else {
                        if (aksesIPSRS == true) {
                            $(".tombol-tambah").prop('hidden', true);
                        } else {
                            $(".tombol-tambah").prop('hidden', true);
                        }
                    }
                }
            }

            // SELECT2
            var te = $(".select2");
            te.length && te.each(function() {
                var es = $(this);
                es.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    dropdownParent: es.parent()
                })
            });

            // DATEPICKER
            // DATE
            const today = new Date();
            var tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            var next = new Date(today);
            next.setDate(next.getDate() + 999999);
            const l = $('.flatpickr');
            const ln = $('.flatpickrnow');
            const lun = $('.flatpickrunl');
            const ltom = $('.flatpickrtom');
            // const dates = new Date(Date.now());
            // const tomorow = dates.getTime();
            // const m = new Date(Date.now());
            // const c = new Date(Date.now() + 1728e5); // 3 hari kedepan
            var now = moment().locale('id').format('Y-MM-DD HH:mm');
            l.flatpickr({
                enableTime: 0,
                minuteIncrement: 1,
                // monthSelectorType: "static",
                // inline: true,
                // defaultHour: 12,
                // defaultMinute: "today",
                time_24hr: true,
                // dateFormat: "Y-m-d H:m",
                disable: [{
                    from: tomorrow.toISOString().split("T")[0],
                    to: next.toISOString().split("T")[0]
                }]
            })
            ln.flatpickr({
                enableTime: 0,
                defaultDate: now,
                minuteIncrement: 1,
                time_24hr: true,
                defaultMinute: "today",
                disable: [{
                    from: tomorrow.toISOString().split("T")[0],
                    to: next.toISOString().split("T")[0]
                }]
            })
            lun.flatpickr({
                enableTime: 0,
                minuteIncrement: 1,
                time_24hr: true,
                // defaultMinute: "today",
                // disable: [{
                //     from: tomorrow.toISOString().split("T")[0],
                //     to: next.toISOString().split("T")[0]
                // }]
            })
            ltom.flatpickr({
                enableTime: 0,
                minuteIncrement: 1,
                time_24hr: true,
                // defaultMinute: "today",
                minDate: "today",
                maxDate: "01.01.3000"
                // disable: [{
                //     from: tomorrow.toISOString().split("T")[0],
                //     to: today
                // }]
            })

            $('#datepicker4').datepicker({
                    "setDate": new Date(),
                    "autoclose": true
            });

            // NILAI PEROLEHAN KEYUP
            var rupiah = document.getElementById('nilai_perolehan_add');
            rupiah.addEventListener('change', function(e){
                // tambahkan 'Rp.' pada saat form di ketik
                // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                rupiah.value = formatRupiah(parseInt(this.value), 'Rp. ');
            });

            // JENIS CHANGE
            $('#jenis_add').change(function() {
                if ($(this).val() == 1) {
                    $('#kd_jenis_add').text('A');
                    $('.show_medis_add').prop('hidden',false);
                }
                if ($(this).val() == 2) {
                    $('#kd_jenis_add').text('B');
                    $('#no_kalibrasi_add').val('');
                    $('#tgl_berlaku_add').val('');
                    $('.show_medis_add').prop('hidden',true);
                }
            });

        })

        // ----------------------------------------------------------------------------------------
        // FUNCTION AREA
        function filter() {
            $("#show-table").prop('hidden', false);
            $("#btn-refresh").prop('disabled', false);
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="20"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/inventaris/aset/filter",
                type: 'POST',
                dataType: 'json', // added data type
                data: {
                    // regulasi: regulasi,
                    // waktu: waktu,
                    // pembuat: pembuat,
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    var userID = "{{ Auth::user()->id }}";
                    var adminID = "{{ Auth::user()->getManyRole(['it','kasubag-aset-gudang']) }}";
                    var date = new Date().toLocaleDateString();
                    res.show.forEach(item => {
                        var updet = new Date(item.created_at).toLocaleDateString();
                        content = `<tr id='`+item.id+`'>`;
                        if (adminID == true) {
                            content += `<td><center>`
                                        + `<div class='btn-group'>`
                                            + `<button type='button' class='btn btn-sm btn-outline-dark btn-icon dropdown-toggle waves-effect waves-light hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class="bx bx-dots-vertical-rounded"></i> `+item.id+`</button>`
                                            + `<ul class='dropdown-menu dropdown-menu-right'>`
                                                + `<div class="dropdown-header noti-title">`
                                                    + `<h5 class="font-size-13 text-muted text-truncate mn-0">Aset & Gudang</h5>`
                                                + `</div>`
                                                + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="ubah(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`
                                                + `<div class="dropdown-divider"></div>`
                                                + `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                                            + `</ul>`
                                        + `</div>`
                                    + `</center></td>`;
                        } else {
                            if (userID == item.id_user) {
                                if (updet == date) {
                                    content += `<td><center>`
                                                + `<div class='btn-group'>`
                                                    + `<button type='button' class='btn btn-sm btn-outline-dark btn-icon dropdown-toggle waves-effect waves-light hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class="bx bx-dots-vertical-rounded"></i> `+item.id+`</button>`
                                                    + `<ul class='dropdown-menu dropdown-menu-right'>`
                                                        + `<div class="dropdown-header noti-title">`
                                                            + `<h5 class="font-size-13 text-muted text-truncate mn-0">Aset & Gudang</h5>`
                                                        + `</div>`
                                                        + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="ubah(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`
                                                        + `<div class="dropdown-divider"></div>`
                                                        + `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                                                    + `</ul>`
                                                + `</div>`
                                            + `</center></td>`;
                                } else {
                                    content += `<td><center>`
                                                + `<div class='btn-group'>`
                                                    + `<button type='button' class='btn btn-sm btn-outline-dark btn-icon dropdown-toggle waves-effect waves-light hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class="bx bx-dots-vertical-rounded"></i> `+item.id+`</button>`
                                                    + `<ul class='dropdown-menu dropdown-menu-right'>`
                                                        + `<div class="dropdown-header noti-title">`
                                                            + `<h5 class="font-size-13 text-muted text-truncate mn-0">Aset & Gudang</h5>`
                                                        + `</div>`
                                                        + `<li><a href='javascript:void(0);' class='dropdown-item text-secondary' value="animate__rubberBand" disabled><s><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</s></a></li>`
                                                        + `<div class="dropdown-divider"></div>`
                                                        + `<li><a href='javascript:void(0);' class='dropdown-item text-secondary' value="animate__rubberBand" disabled><s><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</s></a></li>`
                                                    + `</ul>`
                                                + `</div>`
                                            + `</center></td>`;
                                }
                            } else {
                                content += `<td><center>`
                                            + `<div class='btn-group'>`
                                                + `<button type='button' class='btn btn-sm btn-outline-dark btn-icon dropdown-toggle waves-effect waves-light hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class="bx bx-dots-vertical-rounded"></i> `+item.id+`</button>`
                                                + `<ul class='dropdown-menu dropdown-menu-right'>`
                                                    + `<div class="dropdown-header noti-title">`
                                                        + `<h5 class="font-size-13 text-muted text-truncate mn-0">Aset & Gudang</h5>`
                                                    + `</div>`
                                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-secondary' value="animate__rubberBand" disabled><s><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</s></a></li>`
                                                    + `<div class="dropdown-divider"></div>`
                                                    + `<li><a href='javascript:void(0);' class='dropdown-item text-secondary' value="animate__rubberBand" disabled><s><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</s></a></li>`
                                                + `</ul>`
                                            + `</div>`
                                        + `</center></td>`;
                            }
                        }
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a href='javascript:void(0);' onclick="location.href='/inventaris/aset/`+item.token+`'" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Lihat Detail Sarana"><h6 class='mb-0'><strong><u>`+item.no_inventaris+`</u></strong></h6></a>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>`+item.sarana+`</h6>
                                                <h6 class='mb-0'><small class='text-truncate text-muted'>Tgl. Operasi : `+item.tgl_operasi+`</small></h6>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>`+item.ruangan+`</h6>
                                                <small class='text-truncate text-muted'>`+item.lokasi+`</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td>`+item.merk+`</td><td>`;
                                if (item.tipe) {
                                    content += item.tipe;
                                } else {
                                    content += `-`;
                                }
                        content += `</td><td>`;
                                if (item.no_seri) {
                                    content += item.no_seri;
                                } else {
                                    content += `-`;
                                }
                        content += `</td>`;
                            if (item.kondisi == 1) {
                                content += `<td><kbd class='text-dark' style='background-color:#eaf9f4'>Baik</kbd></td>`;
                            } else {
                                if (item.kondisi == 2) {
                                    content += `<td><kbd class='text-dark' style='background-color:#fef7ed'>Cukup</kbd></td>`;
                                } else {
                                    if (item.kondisi == 3) {
                                        content += `<td><kbd class='text-dark' style='background-color:#fef0f0'>Buruk</kbd></td>`;
                                    } else {
                                        content += `<td><kbd class='text-dark' style='background-color:#d6d6d6'>Tidak Diketahui</kbd></td>`;
                                    }
                                }
                            }
                        content += `<td>`+item.updated_at.substring(0, 10)+`</td>`; // .substring(0, 19).replace('T',' ')
                        content += `<td>`+item.tgl_input+`</td></tr>`;
                        $('#tampil-tbody').append(content);
                    })

                    var table = $('#dttable').DataTable({
                        order: [
                            [9, "desc"]
                        ],
                        // bAutoWidth: false,
                        // aoColumns : [
                        //     { sWidth: '5%' },
                        //     { sWidth: '20%' },
                        //     { sWidth: '20%' },
                        //     { sWidth: '25%' },
                        //     { sWidth: '10%' },
                        // ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    table.buttons().container()
                        .appendTo('#dttable_wrapper .col-md-6:eq(0)');

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }
            })
        }

        function tambah() {
            // $.ajax(
            // {
            //     url: "/api/inventaris/aset/getTahunBulanPengadaan",
            //     type: 'GET',
            //     dataType: 'json', // added data type
            //     success: function(res) {
            //         $('#thbln_add').val(res.month+'-'+res.year);
            //     }
            // })
            $('#tgl_perolehan_add').change(function() {
                var thn = $('#tgl_perolehan_add').val();
                $('#kd_th_add').text(thn.substring(0,4));
            })
            // KODE RUANGAN CHANGE
            $('#ruangan_add').change(function() {
                $.ajax(
                {
                    url: "/api/inventaris/aset/getruangan/"+$(this).val(),
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $('#kd_sarana_add').text(res.kodesarana);
                        $('#kd_ruangan_add').text(res.ruangan);
                    }
                })
            });
            $('#modalTambah').modal('show');
        }

        function ubah(id) {
            $('#show_id_edit').text(id);
            $('#id_edit').val(id);
            $.ajax(
            {
                url: "/api/inventaris/aset/ubah/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // console.log(res);
                    if (res.show.jenis != 1) {
                        $("#badge_jenis_edit").empty().append(`
                            <a href="javascript: void(0);" class="badge bg-warning font-size-12">
                                <i class="bx bx-purchase-tag-alt align-middle text-white me-1"></i> Non Medis
                            </a>
                        `);
                        $(".show_medis_edit").prop('hidden', true);
                    } else {
                        $("#badge_jenis_edit").empty().append(`
                            <a href="javascript: void(0);" class="badge bg-danger font-size-12">
                                <i class="bx bx-purchase-tag-alt align-middle text-white me-1"></i> Medis
                            </a>
                        `);
                        $(".show_medis_edit").prop('hidden', false);
                    }
                    $('#no_inventaris_edit').text(res.show.no_inventaris);
                    $('#no_kalibrasi_edit').val(res.show.no_kalibrasi);
                    $('#tgl_berlaku_edit').val(res.show.tgl_berlaku);
                    $('#sarana_edit').val(res.show.sarana);
                    $('#merk_edit').val(res.show.merk);
                    $('#tipe_edit').val(res.show.tipe);
                    $('#no_seri_edit').val(res.show.no_seri);
                    $('#tgl_operasi_edit').val(res.show.tgl_operasi);
                    $("#asal_perolehan_edit").find('option').remove();
                    $("#asal_perolehan_edit").append(`
                        <option value="1" ${res.show.asal_perolehan == 1? "selected":""}>Beli</option>
                        <option value="2" ${res.show.asal_perolehan == 2? "selected":""}>Hibah</option>
                        <option value="3" ${res.show.asal_perolehan == 3? "selected":""}>Wakaf</option>
                    `);
                    $('#nilai_perolehan_edit').val(formatRupiah(parseInt(res.show.nilai_perolehan), 'Rp. '));
                    $("#kondisi_edit").find('option').remove();
                    $("#kondisi_edit").append(`
                        <option value="1" ${res.show.kondisi == 1? "selected":""}>Baik</option>
                        <option value="2" ${res.show.kondisi == 2? "selected":""}>Cukup</option>
                        <option value="3" ${res.show.kondisi == 3? "selected":""}>Buruk</option>
                    `);
                    $('#keterangan_edit').val(res.show.keterangan);
                    if (res.show.filename != null) {
                        $("#show_img_upload").empty().prop('hidden', false);
                        img = `<p>
                                <label class="form-label">Nama File Gambar : </label><br>
                                <ul>`;
                        JSON.parse(res.show.title).forEach(item => {
                            img += `<li>${item}</li>`;
                        });
                        img += `</ul></p><button class="btn btn-sm btn-outline-danger" type="button" onclick="ubahGambarAset()" data-bs-placement="bottom" data-bs-html="true" title="Ubah Gambar">Ingin mengubah gambar sarana?</button>`;
                        $("#show_img_upload").append(img);
                        $("#ubah_img_upload").prop('hidden', true);
                    } else {
                        $("#show_img_upload").prop('hidden', true);
                        $("#ubah_img_upload").prop('hidden', false);
                    }
                    // FORMAT RUPIAH NILAI PEROLEHAN
                    var rupiah_edit = document.getElementById('nilai_perolehan_edit');
                    rupiah_edit.addEventListener('change', function(e){
                        // tambahkan 'Rp.' pada saat form di ketik
                        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
                        rupiah_edit.value = formatRupiah(parseInt(this.value), 'Rp. ');
                    });
                    $('#modalUbah').modal('show');
                }
            })
        }

        function ubahGambarAset() {
            // Sudah ada gambar Aset dan ingin merubahnya / Upload ulang gambar baru
            $("#show_img_upload").prop('hidden', true);
            $("#ubah_img_upload").prop('hidden', false);
        }

        function prosesUbah() {
            $("#btn-ubah").prop('disabled', true);
            $("#btn-ubah").find("i").toggleClass("fa-edit fa-sync fa-spin");

            // Definisi
            var save = new FormData();
            save.append('id',$("#id_edit").val());
            save.append('no_kalibrasi',$("#no_kalibrasi_edit").val());
            save.append('tgl_berlaku',$("#tgl_berlaku_edit").val());
            save.append('sarana',$("#sarana_edit").val());
            save.append('merk',$("#merk_edit").val());
            save.append('tipe',$("#tipe_edit").val());
            save.append('no_seri',$("#no_seri_edit").val());
            save.append('tgl_operasi',$("#tgl_operasi_edit").val());
            save.append('asal_perolehan',$("#asal_perolehan_edit").val());
            save.append('nilai_perolehan',$("#nilai_perolehan_edit").val());
            save.append('kondisi',$("#kondisi_edit").val());
            save.append('keterangan',$("#keterangan_edit").val());
            save.append('user','{{ Auth::user()->id }}');

            // Get the selected file
            var filesAdded = $('#file_edit')[0].files;
            if (filesAdded.length != 0) {
                for (let i = 0; i < filesAdded.length; i++) {
                    save.append('file[]',filesAdded[i]);
                }
            }

            if (
                save.get('sarana') == "" ||
                save.get('merk') == "" ||
                save.get('tgl_operasi') == "" ||
                save.get('asal_perolehan') == "" ||
                save.get('kondisi') == ""
            ) {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian Wajib',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/inventaris/aset/update',
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    data: save,
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Ubah Sarana berhasil pada '+ res,
                            position: 'topRight'
                        });
                        if (res) {
                            refresh();
                        }
                    },
                    error: function (res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: res.responseJSON.error,
                            position: 'topRight'
                        });
                    }
                });
            }

            $("#btn-ubah").find("i").removeClass("fa-sync fa-spin").addClass("fa-edit");
            $("#btn-ubah").prop('disabled', false);
        }

        function simpan() {
            $("#btn-simpan").prop('disabled', true);
            $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
            // Definisi
            var save = new FormData();
            save.append('thbln',$("#thbln_add").val());
            save.append('ruangan',$("#ruangan_add").val());
            save.append('jenis',$("#jenis_add").val());
            save.append('no_kalibrasi',$("#no_kalibrasi_add").val());
            save.append('tgl_berlaku',$("#tgl_berlaku_add").val());
            save.append('tgl_perolehan',$("#tgl_perolehan_add").val());
            save.append('sarana',$("#sarana_add").val());
            save.append('merk',$("#merk_add").val());
            save.append('tipe',$("#tipe_add").val());
            save.append('no_seri',$("#no_seri_add").val());
            save.append('tgl_operasi',$("#tgl_operasi_add").val());
            save.append('asal_perolehan',$("#asal_perolehan_add").val());
            save.append('nilai_perolehan',$("#nilai_perolehan_add").val());
            save.append('kondisi',$("#kondisi_add").val());
            save.append('keterangan',$("#keterangan_add").val());
            save.append('golongan',$("#golongan_add").val());
            save.append('umur',$("#umur_add").val());
            save.append('tarif',$("#tarif_add").val());
            save.append('penyusutan',$("#penyusutan_add").val());
            save.append('user','{{ Auth::user()->id }}');

            // Get the selected file
            var filesAdded = $('#file_add')[0].files;
            for (let i = 0; i < filesAdded.length; i++) {
                save.append('file[]',filesAdded[i]);
            }
            // save.append('file2',filesAdded[1]);
            // save.append('file3',filesAdded);
            console.log(filesAdded);
            // console.log(filesAdded[0]);
            // console.log(filesAdded[1]);
            // console.log(filesAdded[2]);

            if (
                save.get('thbln') == "" ||
                save.get('ruangan') == "" ||
                save.get('jenis') == "" ||
                // save.get('no_kalibrasi') == "" ||
                // save.get('tgl_berlaku') == "" ||
                // save.get('tgl_perolehan') == "" ||
                save.get('sarana') == "" ||
                save.get('merk') == "" ||
                // save.get('tipe') == "" ||
                // save.get('no_seri') == "" ||
                save.get('tgl_operasi') == "" ||
                save.get('asal_perolehan') == "" ||
                // save.get('nilai_perolehan') == "" ||
                save.get('kondisi') == ""
                // save.get('golongan') == "" ||
                // save.get('umur') == "" ||
                // save.get('tarif') == "" ||
                // save.get('penyusutan') == ""
                // filesAdded.length == 0 (Jika Tidak Ada Gambar Yang Diupload)
            ) {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian Wajib',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/inventaris/aset/store',
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    data: save,
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Tambah Sarana berhasil pada '+ res,
                            position: 'topRight'
                        });
                        if (res) {
                            refresh();
                        }
                    },
                    error: function (res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: res.responseJSON.error,
                            position: 'topRight'
                        });
                    }
                });
            }

            $("#btn-simpan").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
            $("#btn-simpan").prop('disabled', false);
        }

        function refresh() {
            // $("#btn-refresh").prop('disabled', true);
            $("#btn-refresh").find("i").toggleClass("fa-spin");
            $('.modal').modal('hide');

            // Clear Pilihan Select2
            $(".select2").val('').change();

            // Clear Input Form
            document.getElementById("formTambah").reset();

            // Clear No. Inventaris
            $('#kd_ruangan_add').text(' . . ');
            $('#kd_jenis_add').text(' . . ');
            $('#kd_sarana_add').text(' . . ');

            $("#tampil-tbody").empty().append(
                `<tr><td colspan="20"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/inventaris/aset/filter",
                type: 'POST',
                dataType: 'json', // added data type
                data: {
                    // regulasi: regulasi,
                    // waktu: waktu,
                    // pembuat: pembuat,
                },
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();

                    res.show.forEach(item => {
                        content = `<tr id='`+item.id+`'>`;
                        content += `<td><center>`
                                    + `<div class='btn-group'>`
                                        + `<button type='button' class='btn btn-sm btn-outline-dark btn-icon dropdown-toggle waves-effect waves-light hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'><i class="bx bx-dots-vertical-rounded"></i> `+item.id+`</button>`
                                        + `<ul class='dropdown-menu dropdown-menu-right'>`
                                            + `<div class="dropdown-header noti-title">`
                                                + `<h5 class="font-size-13 text-muted text-truncate mn-0">Aset & Gudang</h5>`
                                            + `</div>`
                                            + `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="ubah(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>`
                                            + `<div class="dropdown-divider"></div>`
                                            + `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(`+item.id+`)" value="animate__rubberBand"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>`
                                        + `</ul>`
                                    + `</div>`;
                        content += `</div></center></td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a href='javascript:void(0);' onclick="location.href='/inventaris/aset/`+item.token+`'" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Lihat Detail Sarana"><h6 class='mb-0'><strong><u>`+item.no_inventaris+`</u></strong></h6></a>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>`+item.sarana+`</h6>
                                                <h6 class='mb-0'><small class='text-truncate text-muted'>Tgl. Operasi : `+item.tgl_operasi+`</small></h6>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>`+item.ruangan+`</h6>
                                                <small class='text-truncate text-muted'>`+item.lokasi+`</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td>`+item.merk+`</td><td>`;
                                if (item.tipe) {
                                    content += item.tipe;
                                } else {
                                    content += `-`;
                                }
                        content += `</td><td>`;
                                if (item.no_seri) {
                                    content += item.no_seri;
                                } else {
                                    content += `-`;
                                }
                        content += `</td>`;
                            if (item.kondisi == 1) {
                                content += `<td>Baik</td>`;
                            } else {
                                if (item.kondisi == 2) {
                                    content += `<td>Cukup</td>`;
                                } else {
                                    if (item.kondisi == 3) {
                                        content += `<td>Buruk</td>`;
                                    } else {
                                        content += `<td>Tidak Diketahui</td>`;
                                    }
                                }
                            }
                        content += `<td>`+item.updated_at.substring(0, 10)+`</td>`; // .substring(0, 19).replace('T',' ')
                        content += `<td>`+item.tgl_input+`</td></tr>`;
                        $('#tampil-tbody').append(content);
                    })

                    var table = $('#dttable').DataTable({
                        order: [
                            [9, "desc"]
                        ],
                        // bAutoWidth: false,
                        // aoColumns : [
                        //     { sWidth: '5%' },
                        //     { sWidth: '20%' },
                        //     { sWidth: '20%' },
                        //     { sWidth: '25%' },
                        //     { sWidth: '10%' },
                        // ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    table.buttons().container()
                        .appendTo('#dttable_wrapper .col-md-6:eq(0)');

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }
            })

            $("#btn-refresh").find("i").removeClass("fa-spin");
            // $("#btn-refresh").prop('disabled', false);
        }

        function hapus(id) {
            $('#show_id_hapus').text(id);
            $("#id_hapus").val(id);
            $('#hapus').modal('show');
        }

        function peminjaman(id) {
            $.ajax({
                url: "/api/inventaris/aset/peminjaman/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    if (res) {
                    }
                    $('#peminjaman').modal('show');
                },
                error: function (res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON.error,
                        position: 'topRight'
                    });
                }
            });
        }

        function prosesHapus() {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuhapus').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan penghapusan Aset',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_hapus").val();
                $.ajax({
                    url: "/api/inventaris/aset/hapus/"+id,
                    type: 'DELETE',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Aset telah berhasil dihapus pada '+res,
                            position: 'topRight'
                        });
                        $('#hapus').modal('hide');
                        refresh();
                        // window.location.reload();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Aset gagal dihapus',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function reloadBrowser() {
            $('.modal').modal('hide');
            window.location.reload();
        }

        function scan() {
            $("#reload-scan").prop('hidden', true);
            $("#result").prop('hidden',true);
            $("#reader").prop('hidden',false);
            // $('#modalResultScan').modal('hide');
            $('#modalScan').modal('show');
            const formatsToSupport = [
                Html5QrcodeSupportedFormats.QR_CODE,
                // Html5QrcodeSupportedFormats.UPC_A,
            ];
            let config = {
                fps: 10,
                qrbox: {width: 630, height: 450},
                rememberLastUsedCamera: true,
                // Only support camera scan type.
                supportedScanTypes: [
                    Html5QrcodeScanType.SCAN_TYPE_CAMERA,
                    Html5QrcodeScanType.SCAN_TYPE_FILE
                ],
                // formatsToSupport: formatsToSupport
            };

            let html5QrcodeScanner = new Html5QrcodeScanner("reader", config, /* verbose= */ false); // /* verbose= */ false
            html5QrcodeScanner.render(onScanSuccess); //onScanFailure
        }

        var lastResult, countResults = 0;
        function onScanSuccess(decodedText, decodedResult) {
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                $("#reload-scan").prop('hidden', false);
                $("#html5-qrcode-button-camera-stop").trigger("click");
                $("#reader").prop('hidden',true);
                $("#result").prop('hidden',false);
                iziToast.success({
                    title: 'QR-Code Valid!',
                    message: decodedText,
                    position: 'topRight'
                });
                $.ajax({
                    url: "/api/inventaris/aset/"+decodedText,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        console.log(res.show)
                        $('#result').append(res.show);
                        // res.show.forEach(item => {
                        //     console.log(res.show)
                        // })
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Aset gagal ditampilkan',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function reloadScan() {
            $("#reload-scan").prop('hidden', true);
            lastResult = null;
            scan();
        }

        // function onScanFailure(error) {
        //     // handle scan failure, usually better to ignore and keep scanning.
        //     // for example:
        //     console.warn(`Code scan error = ${error}`);
        //     iziToast.error({
        //         title: 'Scan gagal!',
        //         message: 'Mohon arahkan pada QR-Code yang valid',
        //         position: 'topRight'
        //     });
        // }

        function showResultQRCode(token) {
            $('#modalResultScan').modal('show');
            iziToast.warning({
                title: 'Show Result!',
                message: 'For = '+decodedText,
                position: 'topRight'
            });
        }
    </script>
@endsection
