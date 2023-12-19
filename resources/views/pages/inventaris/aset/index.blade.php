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
                            title="Refresh Tabel Sarana"><i class="mdi mdi-refresh"></i></button>
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
                    <button type="button" class="btn btn-secondary w-100" onclick="" disabled><i class="mdi mdi-filter-outline align-middle"></i> Tampilkan</button>
                </div>
            </div>
        </div>
        <div class="card-body" style="overflow: visible;">
            <div class="table-responsive" style="border: 0px">
                <table class="table align-middle dt-responsive w-100 table-check" id="job-list">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col"></th>
                            <th scope="col">No Inventaris</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Type</th>
                            <th scope="col">No Seri</th>
                            <th scope="col">Lokasi/Ruang</th>
                            <th scope="col">Jenis</th>
                            {{-- <th scope="col">Kalibrasi</th>
                            <th scope="col">No Kalibrasi</th>
                            <th scope="col">Tgl Berlaku</th>
                            <th scope="col">Tgl Operasi</th>
                            <th scope="col">Tgl Perolehan</th>
                            <th scope="col">Asal Perolehan</th>
                            <th scope="col">Nilai Perolehan</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Golongan</th>
                            <th scope="col">Umur</th>
                            <th scope="col">Tarif</th>
                            <th scope="col">Penyusutan Per Bulan</th>
                            <th scope="col">Keterangan</th> --}}
                            <th scope="col">Tgl Input</th>
                        </tr>
                    </thead>
                </table>
                <!-- end table -->
            </div>
            <!-- end table responsive -->
        </div>

        <!--TAMBAH ASET -->
        <div class="modal fade" tabindex="-1" id="modalTambah" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderdetailsModalLabel">Tambah Sarana</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
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
                                        <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> Tanda <a class="text-danger">*</a> isian/input wajib diisi</p>
                                        <p class="mb-0"><i class="mdi mdi-circle-medium align-middle text-primary me-1"></i> Pastikan tidak berpindah halaman saat proses Submit berjalan</p>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Ruangan - Lokasi <a class="text-danger">*</a></label>
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
                                    <input type="text" id="kalibrasi_add" class="form-control" placeholder="e.g. xxx">
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
                                    <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" id="tgl_berlaku_add"/>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-3 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tgl. Perolehan <a class="text-danger">*</a></label>
                                    <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" id="tgl_perolehan_add" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Batas tgl hanya >= 2 hari"/>
                                </div>
                            </div>
                            <div class="col-md-9 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama Sarana <a class="text-danger">*</a></label>
                                    <input type="text" id="sarana_add" class="form-control" placeholder="e.g. xxx" autofocus>
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
                                    <input type="text" class="form-control flatpickr" placeholder="YYYY-MM-DD" id="tgl_operasi_add" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tgl mulai digunakan / diserahkan"/>
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
                                    <textarea rows="3" class="form-control" id="keterangan_add" placeholder="Optional"></textarea>
                                </div>
                            </div>
                            <div class="col-md-5 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Golongan <a class="text-danger">*</a></label>
                                    <input type="number" id="golongan_add" class="form-control" maxlength="1" placeholder="e.g. 1 / 2 / 3 / 4" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Umur <a class="text-danger">*</a></label>
                                    <input type="text" class="form-control" id="umur_add" hidden>
                                    <input type="number" id="umur_add_show" class="form-control" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Rumus dari golongan" disabled>
                                </div>
                            </div>
                            <div class="col-md-2 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Tarif <a class="text-danger">*</a></label>
                                    <input type="text" class="form-control" id="tarif_add" hidden>
                                    <input type="number" id="tarif_add_show" class="form-control" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Rumus dari umur" disabled>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Penyusutan Per Bulan <a class="text-danger">*</a></label>
                                    <input type="text" class="form-control" id="penyusutan_add" hidden>
                                    <input type="number" id="penyusutan_add_show" class="form-control" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Rumus dari tarif" disabled>
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label">Upload <a class="text-danger">*</a></label>
                                    <input type="file" class="form-control mb-2" id="file_add" accept=".jpg,.jpeg,.png" multiple>
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berupa Gambar<br>
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum Semua File Gambar adalah <strong>10 mb</strong><br>
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> File gambar akan disimpan ke dalam file berformat <strong>RAR</strong><br>
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> Gunakan aplikasi WinRAR untuk membuka file Upload
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                        <button class="btn btn-info" onclick="simpan()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                            title="Simpan Data Aset Barang"><i
                                class="bx bxs-save"></i>&nbsp;&nbsp;Submit</button>
                        {{-- <button class="btn btn-primary" onclick="showKeranjang()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Lihat Keranjang"><i
                                class="bx bx-cart align-middle"></i>&nbsp;&nbsp;Keranjang</button> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
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

        // FUNCTION AREA
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
            var files = $('#file_add')[0].files;
            save.append('file',files[0]);

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
                save.get('umur') == "" ||
                save.get('tarif') == "" ||
                save.get('penyusutan') == ""
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
                    dataType: 'json',
                    data: save,
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Tambah Sarana berhasil pada '+ res,
                            position: 'topRight'
                        });
                        if (res) {
                            $('.modal').modal('hide');
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
        }

        function refresh() {
            $('.modal').modal('hide');
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
    </script>
@endsection
