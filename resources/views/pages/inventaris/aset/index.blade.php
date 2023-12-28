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

    <div class="card">

        <div class="card-body border-bottom">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 card-title flex-grow-1">Inventaris</h5>
                <div class="flex-shrink-0">
                    <div class="hstack gap-3 ms-auto">
                        <div class="btn-group">
                            <button class="btn btn-primary" onclick="tambah()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Menambahkan Aset / Sarana"><i class='bx bx-plus scaleX-n1-rtl'></i> Tambah Sarana</button>
                            <button class="btn btn-light" onclick="refresh()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Refresh Tabel Sarana" id="btn-refresh"><i class="fas fa-sync fa-fw nav-icon"></i></button>
                            <button class="btn btn-dark" onclick="scan()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Scan QR-Code Aset"><i class="fas fa-qrcode fa-fw nav-icon"></i></button>
                        </div>
                        <div class="vr"></div>
                        <div class="dropdown d-inline-block">
                            <button type="menu" class="btn btn-success" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i> Menu</button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('aset_ruangan.index') }}">Daftar Ruangan</a></li>
                                {{-- <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body border-bottom">
            <div class="row g-3">
                <div class="col-xxl-4 col-lg-6">
                    <input type="search" class="form-control" id="searchTableList" placeholder="Cari Sarana ...">
                </div>
                <div class="col-xxl-2 col-lg-6">
                    <select class="form-select" id="idStatus" aria-label="Default select example">
                        <option value="" selected hidden>Jenis Sarana</option>
                        <option value="1">Medis</option>
                        <option value="2">Non Medis</option>
                    </select>
                </div>
                <div class="col-xxl-2 col-lg-4">
                    <select class="form-select" id="idType" aria-label="Default select example">
                        <option value="" selected hidden>Pilih Lokasi</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                    </select>
                </div>
                <div class="col-xxl-2 col-lg-4">
                    <div id="datepicker1">
                        <input type="text" class="form-control flatpickr" placeholder="Tanggal Aset">
                    </div><!-- input-group -->
                </div>
                <div class="col-xxl-2 col-lg-4">
                    <button type="button" class="btn btn-info w-100" onclick="filter()"><i class="mdi mdi-filter-outline align-middle"></i> Tampilkan</button>
                </div>
            </div>

        </div>
        <div class="card-body" style="overflow: visible;" id="show-table" hidden>
            <div class="table-responsive" style="border: 0px">
                <table class="table align-middle dt-responsive w-100 table-check" id="dttable">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">No Inventaris</th>
                            <th scope="col">Sarana</th>
                            <th scope="col">Ruangan</th>
                            <th scope="col">Kalibrasi</th>
                            <th scope="col">Perolehan</th>
                            <th scope="col">Tgl Berlaku</th>
                            <th scope="col">Tgl Operasi</th>
                            <th scope="col">Penyusutan Per Bulan</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Dibuat</th>
                            <th scope="col">Diperbarui</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody"></tbody>
                </table>
                <!-- end table -->
            </div>
            <!-- end table responsive -->
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
                                                    <a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="No. Baku Inventaris">00.03.27</a>.<a id="kd_ruangan_add" class="text-danger" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Kode Ruangan"> . . </a>.<a id="kd_jenis_add" class="text-primary" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Kode Jenis"> . . </a>.<a id="kd_sarana_add" class="text-warning" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="No. Urut Sarana"></a>.<a data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Bulan & Tahun Aset">{{ $list['month'].'.'.$list['year'] }}</a>
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
                            <div class="col-md-8 mb-3">
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
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Jenis Aset <a class="text-danger">*</a></label>
                                    <select class="form-select" id="jenis_add" required>
                                        <option value="" hidden>Pilih</option>
                                        <option value="1">Medis</option>
                                        <option value="2">Non Medis</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 show_medis_add" hidden>
                                <div class="form-group">
                                    <label class="form-label">Kalibrasi <a class="text-danger">*</a></label>
                                    <input type="number" id="kalibrasi_add" class="form-control" placeholder="e.g. xxx">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3 show_medis_add" hidden>
                                <div class="form-group">
                                    <label class="form-label">No. Kalibrasi <a class="text-danger">*</a></label>
                                    <input type="text" id="no_kalibrasi_add" class="form-control" placeholder="e.g. xxx">
                                </div>
                            </div>
                            <div class="col-md-4 show_medis_add" hidden>
                                <div class="form-group">
                                    <label class="form-label">Tgl. Berlaku <a class="text-danger">*</a></label>
                                    <input type="text" id="tgl_berlaku_add" class="form-control flatpickr" placeholder="YYYY-MM-DD"/>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl. Perolehan <a class="text-danger">*</a></label>
                                    <input type="text" id="tgl_perolehan_add" class="form-control flatpickr" placeholder="YYYY-MM-DD" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Batas tgl hanya >= 2 hari"/>
                                </div>
                            </div>
                            <div class="col-md-9 mb-3">
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
                                    <label class="form-label">Tipe <a class="text-danger">*</a></label>
                                    <input type="text" id="tipe_add" class="form-control" placeholder="e.g. xxx">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">No. Seri <a class="text-danger">*</a></label>
                                    <input type="text" id="no_seri_add" class="form-control" placeholder="e.g. xxx">
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl. Operasi <a class="text-danger">*</a></label>
                                    <input type="text" id="tgl_operasi_add" class="form-control flatpickr" placeholder="YYYY-MM-DD" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tgl mulai digunakan / diserahkan"/>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Asal Perolehan <a class="text-danger">*</a></label>
                                    <select class="form-select" id="asal_perolehan_add" required>
                                        <option value="" hidden>Pilih</option>
                                        <option value="1">Beli</option>
                                        <option value="2">Hibah</option>
                                        <option value="3">Wakaf</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nilai Perolehan <a class="text-danger">*</a></label>
                                    <input type="text" id="nilai_perolehan_add" class="form-control" onclick="$(this).val('')" placeholder="Rp. xxx.xxx" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Masukkan Hanya Angka Tanpa Titik (.) / Koma (,) /dsb">
                                </div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Kondisi <a class="text-danger">*</a></label>
                                    <select class="form-select" id="kondisi_add" required>
                                        <option value="" hidden>Pilih</option>
                                        <option value="1">Baik</option>
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
                            <div class="col-md-5 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Golongan <a class="text-danger">*</a></label>
                                    <input type="number" id="golongan_add" class="form-control" maxlength="1" max="4" placeholder="e.g. 1 / 2 / 3 / 4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Umur <a class="text-danger">*</a></label>
                                    <input type="text" class="form-control" id="umur_add" hidden>
                                    <input type="number" id="umur_add_show" class="form-control" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Rumus dari golongan" placeholder="Otomatis" disabled>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tarif <a class="text-danger">*</a></label>
                                    <input type="text" class="form-control" id="tarif_add" hidden>
                                    <input type="number" id="tarif_add_show" class="form-control" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Rumus dari umur" placeholder="Otomatis" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Penyusutan Per Bulan <a class="text-danger">*</a></label>
                                    <input type="text" class="form-control" id="penyusutan_add" hidden>
                                    <input type="number" id="penyusutan_add_show" class="form-control" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Rumus dari tarif" placeholder="Otomatis" disabled>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Upload <a class="text-danger">*</a></label>
                                    <input type="file" class="form-control mb-2" id="file_add" accept=".jpg,.jpeg,.png" multiple>
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berupa Gambar<br>
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum setiap File Gambar adalah <strong>5 mb</strong>
                                    {{-- <i class="fa-fw fas fa-caret-right nav-icon"></i> File gambar akan disimpan ke dalam file berformat <strong>RAR</strong><br>
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> Gunakan aplikasi WinRAR untuk membuka file Upload --}}
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
                    </div>
                    <div class="col-12 text-center mb-4">
                        <button class="btn btn-primary me-sm-3 me-1" onclick="scan()"><i class="fa fa-sync"></i>&nbsp;&nbsp;Ulangi Scan</button>
                        <button class="btn btn-info me-sm-3 me-1" onclick="nextScan()" id="resume-scan" hidden><i class="fa fa-play"></i>&nbsp;&nbsp;Lanjut Scan</button>
                        <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
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
            tomorrow.setDate(tomorrow.getDate() + 2);
            var next = new Date(today);
            next.setDate(next.getDate() + 999999);
            const l = $('.flatpickr');
            const ln = $('.flatpickrNull');
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
                disable: [{
                    from: tomorrow.toISOString().split("T")[0],
                    to: next.toISOString().split("T")[0]
                }]
            })

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
                    $('#kalibrasi_add').val('');
                    $('#no_kalibrasi_add').val('');
                    $('#tgl_berlaku_add').val('');
                    $('.show_medis_add').prop('hidden',true);
                }
            });

            // KODE RUANGAN CHANGE
            $('#ruangan_add').change(function() {
                $.ajax(
                {
                    url: "/api/inventaris/aset/getruangan/"+$(this).val(),
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $('#kd_ruangan_add').text(res.kode);
                    }
                })
            });

        })

        // ----------------------------------------------------------------------------------------
        // FUNCTION AREA
        function filter() {
            $("#show-table").prop('hidden', false);
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

                    // content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                    //                     <div class='d-flex justify-content-start align-items-center'>
                    //                         <div class='d-flex flex-column'>
                    //                             <h6 class='mb-0'></h6>
                    //                             <small class='text-truncate text-muted'></small>
                    //                         </div>
                    //                     </div>
                    //                 </td>`;
                    res.show.forEach(item => {
                        content = `<tr id='`+item.id+`'>`;
                        content += `<td><div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="javascript:;" class="btn btn-outline-light dropdown-toggle hide-arrow text-body btn-sm btn-icon" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i> `+item.id+`</a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:;" onclick="location.href='/inventaris/aset/`+item.token+`'" class="dropdown-item text-info"><i class='bx bx-barcode scaleX-n1-rtl'></i> Detail</a>
                                                <a href="javascript:;" onclick="ubah(` + item.id + `)" class="dropdown-item text-warning"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a>
                                                <a href="javascript:;" onclick="hapus(` + item.id + `)" class="dropdown-item text-danger"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a>
                                            </div>
                                        </div>
                                    </div></td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a href='javascript:void(0);'><h6 class='mb-0'><strong><u>`+item.no_inventaris+`</u></strong></h6></a>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>`+item.sarana+`</h6>
                                                <h6 class='mb-0'>`+item.no_seri+`</h6>
                                                <small class='text-truncate text-muted'>`+item.merk+` - `+item.tipe+`</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>`+item.ruangan+` - `+item.lokasi+`</h6>
                                                <small class='text-truncate text-muted'>Jenis : `+item.jenis+`</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>`+item.no_kalibrasi+`</h6>
                                                <small class='text-truncate text-muted'>Kondisi : `+item.kondisi+`</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>`+item.asal_perolehan+`</h6>
                                                <h6 class='mb-0'>`+formatRupiah(item.nilai_perolehan,'Rp. ')+`</h6>
                                                <small class='text-truncate text-muted'>Diperoleh : `+item.tgl_perolehan+`</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td>`+item.tgl_berlaku+`</td>`;
                        content += `<td>`+item.tgl_operasi+`</td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>Golongan `+item.golongan+`</h6>
                                                <small class='text-truncate text-muted'>`+item.umur+` Bulan - `+item.tarif+` - `+item.penyusutan+`</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td>`+item.keterangan+`</td>`;
                        content += `<td>`+item.updated_at.substring(0, 19).replace('T',' ')+`</td>`;
                        content += `<td>`+item.tgl_input+`</td></tr>`;
                        $('#tampil-tbody').append(content);
                    })

                    var table = $('#dttable').DataTable({
                        order: [
                            [10, "desc"]
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
            $.ajax(
            {
                url: "/api/inventaris/aset/getlastaset",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#kd_sarana_add').text(res);
                }
            })
            $('#modalTambah').modal('show');
        }

        function simpan() {
            $("#btn-simpan").prop('disabled', true);
            $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
            // Definisi
            var save = new FormData();
            save.append('ruangan',$("#ruangan_add").val());
            save.append('jenis',$("#jenis_add").val());
            save.append('kalibrasi',$("#kalibrasi_add").val());
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
                save.get('ruangan') == "" ||
                save.get('jenis') == "" ||
                save.get('kalibrasi') == "" ||
                save.get('no_kalibrasi') == "" ||
                save.get('tgl_berlaku') == "" ||
                save.get('tgl_perolehan') == "" ||
                save.get('sarana') == "" ||
                save.get('merk') == "" ||
                save.get('tipe') == "" ||
                save.get('no_seri') == "" ||
                save.get('tgl_operasi') == "" ||
                save.get('asal_perolehan') == "" ||
                save.get('nilai_perolehan') == "" ||
                save.get('kondisi') == "" ||
                save.get('golongan') == "" ||
                // save.get('umur') == "" ||
                // save.get('tarif') == "" ||
                // save.get('penyusutan') == ""
                filesAdded.length == 0
            ) {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian Wajib',
                    position: 'topRight'
                });
            } else {
                // console.log(save)
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

            $("#btn-refresh").find("i").removeClass("fa-spin");
            // $("#btn-refresh").prop('disabled', false);
        }

        function hapus(id) {
            $('#show_id_hapus').text(id);
            $("#id_hapus").val(id);
            $('#hapus').modal('show');
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
            $('#modalScan').modal('show');
            const formatsToSupport = [
                Html5QrcodeSupportedFormats.QR_CODE,
                // Html5QrcodeSupportedFormats.UPC_A,
            ];
            let config = {
                fps: 10,
                qrbox: {width: 250, height: 250},
                rememberLastUsedCamera: true,
                // Only support camera scan type.
                supportedScanTypes: [
                    Html5QrcodeScanType.SCAN_TYPE_CAMERA,
                    Html5QrcodeScanType.SCAN_TYPE_FILE
                ],
                formatsToSupport: formatsToSupport
            };

            let html5QrcodeScanner = new Html5QrcodeScanner("reader", config, /* verbose= */ false); // /* verbose= */ false
            html5QrcodeScanner.render(onScanSuccess); //onScanFailure
        }

        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            // console.log(`Code matched = ${decodedText}`, decodedResult);
            var lastResult, countResults = 0;
            let shouldPauseVideo = true;
            let showPausedBanner = false;
            if (decodedText !== lastResult) {
                ++countResults;
                lastResult = decodedText;
                iziToast.success({
                    title: 'QR-Code Valid!',
                    message: decodedText,
                    position: 'topRight'
                });
                // html5QrcodeScanner.stop();
                // html5QrcodeScanner.start();
                // html5QrcodeScanner.clear();
            }
            html5QrcodeScanner.pause(shouldPauseVideo, showPausedBanner);
            $("#resume-scan").prop('hidden', false);
            // scan();
        }

        function nextScan() {
            $("#resume-scan").prop('hidden', true);
            html5QrcodeScanner.resume();
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
    </script>
@endsection
