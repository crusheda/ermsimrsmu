@extends('layouts.index')

@section('content')

    {{-- FOR DROPDOWN BEHIND CARD --}}
    <style>
        .dropdown {
            transform-style: preserve-3d;
            transform: translate3d(0,0,10px) !important;
        }
    </style>

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Kepegawaian</li>
                        <li class="breadcrumb-item" aria-current="page">Absensi</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Absensi Karyawan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        @if (Auth::user()->getRole('kabag-kepegawaian') == true || Auth::user()->getRole('karu-it') == true)
            <div class="col-xl-12" hidden>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <div class="card">
                            <div class="card-header accordion-header d-flex align-items-center justify-content-between py-3 ">
                                <h5 class="mb-0"><button
                                    class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                    aria-expanded="false" aria-controls="flush-collapseOne"><b style="font-size: 1rem">Form Manual <a class="text-primary">Ijin Sakit</a></b>&nbsp;&nbsp;</button>
                                </h5>
                            </div>
                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">

                                    {{-- <div class="row">
                                        <div class="col-xl-12 col-xxl-12">
                                            <div class="alert alert-secondary">
                                                <small>
                                                    <i class="ti ti-arrow-narrow-right me-1"></i> Isian bertanda (<a class="text-danger">*</a>) berarti wajib diisi
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-9 mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Nama Acara <a class="text-danger">*</a></label>
                                                <input type="text" class="form-control" name="acara" id="acara" placeholder="e.g. Upacara Pengibaran Bendera Merah Putih HUT RI Ke-XX">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Waktu Acara <a class="text-danger">*</a></label>
                                                <input type="datetime-local" class="form-control" name="tgl" id="tgl">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Jenis Perjalanan Dinas <a class="text-danger">*</a></label>
                                                <select class="form-control" name="jenis" id="jenis">
                                                    <option value="">Pilih</option>
                                                    <option value="1">Offline</option>
                                                    <option value="2">Online</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Jenis Kendaraan <a class="text-danger">*</a></label>
                                                <select class="form-control" name="kendaraan" id="kendaraan">
                                                    <option value="">Pilih</option>
                                                    <option value="1">[Pribadi] Motor</option>
                                                    <option value="2">[Pribadi] Mobil</option>
                                                    <option value="3">[Rumah Sakit] Mobil</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3" id="showing" hidden>
                                            <div class="form-group">
                                                <label class="form-label">Pemilik Kendaraan Yang Digunakan <a class="text-danger">*</a></label>
                                                <select class="form-select select2" name="kendaraan_pegawai[]" id="kendaraan_pegawai" style="width: 100%" multiple>
                                                    @if (count($list['users']) > 0)
                                                        @foreach ($list['users'] as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label" for="multiple-inputs">Lama Dinas <a class="text-danger">*</a></label>
                                            <div class="input-group">
                                                <select class="form-control" name="lama1" id="lama1">
                                                    <option value="">Pilih</option>
                                                    <option value="1">< 4 Jam (Kurang dari 4 jam)</option>
                                                    <option value="2">> 4 Jam (Lebih dari 4 jam)</option>
                                                </select>
                                                <input type="text" placeholder="Perkiraan Waktu (Jam)" class="form-control" name="lama2" id="lama2">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Lokasi Acara <a class="text-danger">*</a></label>
                                                <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="e.g. Alun-alun Satya Negara Kabupaten Sukoharjo">
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3" id="slide">
                                            <div class="form-group">
                                                <label class="form-label">Pegawai Pelaksana <a class="text-danger">*</a></label>
                                                <select class="form-select select2" name="pegawai[]" id="pegawai" style="width: 100%" multiple>
                                                    @if (count($list['users']) > 0)
                                                        @foreach ($list['users'] as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group">
                                                <label class="form-label">Deskripsi Perjalanan (<b>Optional</b>)</label>
                                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="2" placeholder="Deskripsikan perjalanan dinas Anda"></textarea>
                                            </div>
                                        </div>
                                        <div class="text-end btn-page mt-2">
                                            <button class="btn btn-link-secondary" id="clear_text" onclick="clearInput()">Kosongkan</button>
                                            <button class="btn btn-primary" id="btn-simpan" onclick="simpan()"><i class="fas fa-save me-1"></i> Simpan</button>
                                        </div>
                                    </div> --}}
                                    <a>masih tahap development :)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-xl-12" id="show_filter" hidden>
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between px-3">
                    <h5 class="mb-0 ms-3">Filter <b class="text-primary">Riwayat</b></h5>
                    {{-- @if (Auth::user()->getPermission('admin_surket') == true) --}}
                        <div class="btn-group">
                            <a href="javascript:void(0);" class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical f-18"></i></a>
                            {{-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="showKategori()">Daftar Kategori</a>
                                </li>
                            </ul> --}}
                        </div>
                    {{-- @endif --}}
                </div>
                <div class="card-body p-b-10">
                    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                        <small>
                            <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Kosongi semua filter isian untuk mendapatkan seluruh data
                            {{-- <i class="ti ti-arrow-narrow-right text-primary me-1"></i>  <br> --}}
                        </small>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Pilihan Filter <a class="text-danger">*</a></label>
                                <select class="form-select select2" id="filter_pilihan" onchange="filterPilihan()" data-allow-clear="false" data-bs-auto-close="outside" style="width: 100%" required>
                                    <option value="1" selected hidden>Monitoring Absensi</option>
                                    <option value="2">Absensi Karyawan Lengkap</option>
                                    <option value="3">Rekap Absensi Final</option>
                                    <option value="4">Rekap Absensi (Per Karyawan Per Tanggal)</option>
                                    <option value="5"><s>Rekap Cuti</s></option>
                                    <option value="6"><s>Monitoring Harian Pegawai</s></option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="form-group">
                                <label class="form-label">Daftar Unit</label>
                                <select class="form-select select2" name="filter_unit[]" id="filter_unit" style="width: 100%" multiple>
                                    @if (!empty($list['jabatan']))
                                        @foreach ($list['jabatan'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->unit }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jenis Absensi</label>
                                <select class="form-select" name="filter_jenis" id="filter_jenis" style="width: 100%">
                                    <option value="0" selected>Semua Jenis</option>
                                    <option value="1">Shift/Masuk</option>
                                    {{-- <option value="2"><s>Cuti</s></option> --}}
                                    <option value="3">Ijin/TIdak Masuk</option>
                                    {{-- <option value="4"><s>OnCall</s></option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Pilih Rentang Tanggal">
                            <div class="form-group">
                                <label class="form-label">Rentang Tanggal <span class="text-danger">*</span></label>
                                <div class="input-daterange input-group" id="pc-datepicker-5">
                                    <span class="input-group-text">Dari</span>
                                    <input type="text" class="form-control text-end" placeholder="Masukkan Tanggal" name="range-start" id="filter_dari">
                                    <span class="input-group-text">Sampai</span>
                                    <input type="text" class="form-control text-end" placeholder="Masukkan Tanggal" name="range-end" id="filter_sampai">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-3" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Pilih Jenis Sarana">
                            <select class="selectFilter form-select" id="filterJenis" data-allow-clear="false" data-bs-auto-close="outside" style="width: 100%" required>
                                <option value="" selected hidden>Pilih Jenis</option>
                                <option value="1">Medis</option>
                                <option value="2">Non Medis</option>
                            </select>
                        </div> --}}
                    </div>
                </div>
                <div class="card-footer p-3">
                    <div class="text-end btn-page mb-0">
                        <button type="button" class="btn btn-link-secondary" id="clear_text" onclick="clearInput()">Kosongkan</button>
                        <button type="button" class="btn btn-shadow btn-primary" onclick="filter()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="Menampilkan Daftar/Filter Absensi" id="tombol-tampilkan"><i class="fas fa-filter align-middle me-2"></i> Tampilkan</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12" id="table" hidden>
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between px-3">
                    <h5 class="mb-0 ms-3"><b style="font-size: 1rem">Tabel <a class="text-primary">Riwayat</a></b></h5>
                    {{-- <div class="btn-group">
                        <a href="javascript:void(0);" class="avtar avtar-s btn-link-warning" onclick="showRiwayat()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Segarkan Tabel"><i class="ti ti-refresh f-20"></i></a>
                    </div> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dttable" class="table table-hover dt-responsive align-middle" style="width: 100%">
                            <thead id="tampil-thead"></thead>
                            <tbody id="tampil-tbody">
                                <tr>
                                    <td colspan="20" style="font-size:13px">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL START --}}
    <div class="modal fade animate__animated animate__rubberBand" id="modalDetail" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Detail Absensi <span class="badge p-1" id="show_jenis_detail"></span> <span class="badge text-bg-info ms-1 p-1" id="show_id_detail"></span>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" style="width: 100%">
                            <thead class="text-center align-middle">
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Berangkat</th>
                                    <th>Pulang</th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-detail" class="text-center align-middle"></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link-secondary" data-bs-dismiss="modal">Tutup <i class="fas fa-arrow-right ms-1"></i></button>
                    {{-- <button class="btn btn-primary" id="btn-ubah" onclick="prosesUbah()"><i class="fa-fw fas fa-save nav-icon"></i> Simpan Perubahan</button> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalHapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Hapus
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan melakukan penghapusan Berkas Perjalanan Dinas, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
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
                    <button type="submit" id="btn-hapus" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapus()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                    <button type="reset" class="btn btn-link-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}

    <script>
        $(document).ready(function() {
            // ------------------------------------------------------------------------------------- START DATERANGEPICKER
            const datepicker_range = new DateRangePicker(document.querySelector('#pc-datepicker-5'), {
                buttonClass: 'btn',
                todayBtn: true,
                clearBtn: true,
                format: 'yyyy-mm-dd'
            });
            // Set tanggal default
            const today = new Date();
            let tahun = today.getFullYear();
            let bulan = today.getMonth();

            let bulanLalu = bulan - 1;
            let tahunLalu = tahun;
            if (bulanLalu < 0) {
                bulanLalu = 11;
                tahunLalu -= 1;
            }

            const dariDate = new Date(tahunLalu, bulanLalu, 21);
            const sampaiDate = new Date(tahun, bulan, 20);

            // Format ke yyyy-mm-dd string
            const formatDate = (d) => `${d.getFullYear()}-${String(d.getMonth() + 1).padStart(2, '0')}-${String(d.getDate()).padStart(2, '0')}`;

            // Set ke input
            $('#filter_dari').val(formatDate(dariDate));
            $('#filter_sampai').val(formatDate(sampaiDate));

            // 🔥 Set nilai ke datepicker RANGE (bukan ke input langsung)
            datepicker_range.setDates(dariDate, sampaiDate);
            // ------------------------------------------------------------------------------------- END DATERANGEPICKER
            // SELECT2
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    allowClear: true,
                    dropdownParent: e.parent()
                })
            });

            // $('#kendaraan').change(function () {
            //     var i = $(this).val();
            //     if (i == 1 || i == 2) {
            //         var o = $("#kendaraan_pegawai");
            //         o.length && o.each(function() {
            //             var e = $(this);
            //             e.wrap('<div class="position-relative"></div>').select2({
            //                 placeholder: "Pilih",
            //                 allowClear: true,
            //                 dropdownParent: e.parent()
            //             })
            //         });
            //         $('#kendaraan_pegawai').val('').change();
            //         $('#showing').prop('hidden',false);
            //         $('#slide').removeClass('col-md-6').addClass('col-md-12');
            //     } else {
            //         $('#showing').prop('hidden',true);
            //         $('#slide').removeClass('col-md-12').addClass('col-md-6');
            //     }
            // });

            $('#show_filter').prop('hidden',false);
            filterPilihan();
        });

        function filterPilihan() {
            pilihan = $('#filter_pilihan').val();
            if (pilihan == 3 || pilihan == 4) {
                $('#filter_jenis').val(0).prop('disabled',true);
            } else {
                $('#filter_jenis').prop('disabled',false);
            }
        }

        function filter() {
            pilihan = $('#filter_pilihan').val();
            // jenis = $('#filter_jenis').val();
            // unit = $('#filter_unit').val();
            // dari = $('#filter_dari').val();
            // sampai = $('#filter_sampai').val();

            if (pilihan == 1) {
                showMonitoring();
            } else {
                if (pilihan == 2) {
                    showRiwayatLengkap();
                } else {
                    if (pilihan == 3) {
                        showRekapAbsensiLinda();
                    } else {
                        if (pilihan == 4) {
                            showRekapAbsensiLindaDetail();
                        } else {
                            $('#table').prop('hidden',true);
                            Swal.fire({
                                title: `Ahh Maaf!`,
                                text: 'Fitur ini sedang tahap development. Mohon Ditunggu yaa 😊. Tetap Semangat..',
                                icon: `success`,
                                showConfirmButton: false,
                                showCancelButton: false,
                                allowOutsideClick: true,
                                allowEscapeKey: true,
                                timer: 3000,
                                timerProgressBar: true,
                                backdrop: `rgba(26,27,41,0.8)`,
                            });
                            // PILIHAN LAIN LAGI APABILA ADA
                        }
                    }
                }
            }
        }

        function showMonitoring() {
            $("#tampil-thead").empty().append(`
                <tr>
                    <th><center>#ID</center></th>
                    <th>PEGAWAI</th>
                    <th>STATUS</th>
                    <th>BERANGKAT <i class="ti ti-arrow-narrow-right text-primary"></i> PULANG</th>
                    <th>TGL ABSEN</th>
                </tr>
            `);
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="20"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $('#table').prop('hidden',false);
            // INITIALIZIE
            var save = new FormData();
            save.append('jenis',$('#filter_jenis').val());
            save.append('unit',JSON.stringify($('#filter_unit').val()));
            save.append('dari',$('#filter_dari').val());
            save.append('sampai',$('#filter_sampai').val());
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/kepegawaian/absensi/table/monitoring`,
                method: 'post',
                data: save,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleDateString("sv-SE");
                        var date = new Date().toLocaleDateString("sv-SE");
                        var adminID = "{{ Auth::user()->getPermission(['admin_kepegawaian']) }}";
                        var superID = "{{ Auth::user()->getRole('kabag-kepegawaian') }}";
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        content += `<td><center><div class='btn-group'>
                                        <button type='button' class='btn btn-sm btn-link text-secondary dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</button>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                                        if (adminID == true) {
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-info" onclick="detail(${item.id})"><i class="fas fa-calendar-alt me-2"></i> Detail</a></li>`;
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fa-fw fas fa-edit me-2"></i> Ubah</a></li>`;
                                            if (superID == true) {
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item text-secondary'><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                            }
                                        } else {
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fas fa-calendar-alt me-2"></i> Detail</a></li>`;
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fa-fw fas fa-edit me-2"></i> Ubah</a></li>`;
                                        }
                        content += "</div></center></td>";
                        role = '';
                        res.role.forEach(us => {
                            if (us.id_user == item.pegawai_id) {
                                role += `<span class="badge bg-light-secondary me-1">${us.nama_role}</span>`;
                            }
                        })
                        content += `<td>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0"><img
                                                    src="${item.foto_user?`/storage/`+item.foto_user.substring(7,10000):'/images/pku/user.png'}" alt="user image"
                                                    class="img-radius wid-40 hei-40 align-top m-r-15"></div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="mb-1">${item.nama_pegawai}</h6>
                                                <small class='text-truncate text-muted'>${role}</small>
                                            </div>
                                        </div>
                                    </td>`;
                        jenis = '';
                        if (item.jenis == 1) {
                            jenis = `<h6>Masuk <b class="text-primary">Shift</b></h6>`;
                        } else {
                            if (item.jenis == 3) {
                                jenis = `<h6>Tidak Masuk/<b class="text-warning">Ijin</b></h6>`;
                            } else {
                                jenis = `<h6>Tidak <b class="text-danger">Terdefinisi</b></h6>`;
                            }
                        }
                        content += `<td>${jenis}</td>`;
                        if (item.terlambat == 1) {
                            colorTglIn = 'text-bg-primary';
                            terlambat = '<span class="badge text-bg-danger" style="padding:3px">Terlambat</span>';
                        } else {
                            if (item.terlambat == 0) {
                                colorTglIn = 'text-bg-primary';
                                terlambat = '<span class="badge text-bg-success" style="padding:3px">Disiplin</span>';
                            } else {
                                colorTglIn = 'text-bg-warning';
                                terlambat = '';
                            }
                        }
                        if (item.tgl_out) {
                            tgl_out = '<i class="ti ti-arrows-right text-primary"></i> <span class="badge text-bg-secondary">'+new Date(item.tgl_out).toLocaleString("sv-SE")+'</span>';
                        } else {
                            if (item.jenis != 3) {
                                tgl_out = '<i class="ti ti-arrows-right text-dark"></i> <span class="badge text-bg-info">Belum/Tidak Absen Pulang</span>';
                            } else {
                                tgl_out = '';
                            }
                        }
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-1'><a href="javascript:void(0);" class="text-dark" data-bs-toggle="tooltip"
                                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Berangkat Sampai Pulang">
                                                    <span class="badge ${colorTglIn}">${new Date(item.tgl_in).toLocaleString("sv-SE")}</span> ${tgl_out}</a>
                                                </h6>
                                                <small class='text-truncate text-muted'>Keterlambatan : <b>${item.keterlambatan?item.keterlambatan:'-'} ${terlambat}</b></small>
                                                <small class='text-truncate text-muted'>Lembur : <b>${item.lembur?item.lembur:'-'}</b></small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0'>` + moment(item.ref_jam_masuk).format('YYYY-MM-DD') + `</a>
                                                ${item.selisih_jam?`<small class='text-truncate text-muted'>Bekerja selama : `+item.selisih_jam+`</small>`:''}
                                            </div>
                                        </div>
                                    </td>`;
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                        // Showing Tooltip
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger: 'hover'
                        })
                    });
                    var table = $('#dttable').DataTable({
                        // dom: 'Bfrtip',
                        order: [
                            [4, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '10%' },
                            { sWidth: '40%' },
                            { sWidth: '10%' },
                            { sWidth: '30%' },
                            { sWidth: '10%' },
                        ],
                        columnDefs: [
                            // { visible: false, targets: [7] },
                        ],
                        displayLength: 100,
                        lengthChange: true,
                        lengthMenu: [100, 300, 500, 1000, 3000, 5000, 10000, 30000, 50000],
                        // buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });
                    iziToast.success({
                        title: 'System Message!',
                        message: 'Berhasil menampilkan data Monitoring Absensi',
                        position: 'topRight'
                    });
                }
            })
        }

        function showRiwayatLengkap() {
            $("#tampil-thead").empty().append(`
                <tr>
                    <th><center>#ID</center></th>
                    <th>TGL ABSEN</th>
                    <th>ID PEGAWAI</th>
                    <th>NIP PEGAWAI</th>
                    <th>NAMA PEGAWAI</th>
                    <th>UNIT</th>
                    <th>STATUS</th>
                    <th>SHIFT</th>
                    <th>JAM MASUK - PULANG</th>
                    <th>ABSEN BERANGKAT</th>
                    <th>ABSEN PULANG</th>
                    <th>TERLAMBAT</th>
                    <th>LEMBUR</th>
                    <th>TOTAL BEKERJA</th>
                </tr>
            `);
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="20"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $('#table').prop('hidden',false);
            // INITIALIZIE
            var save = new FormData();
            save.append('jenis',$('#filter_jenis').val());
            save.append('unit',JSON.stringify($('#filter_unit').val()));
            save.append('dari',$('#filter_dari').val());
            save.append('sampai',$('#filter_sampai').val());
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/kepegawaian/absensi/table/all`,
                method: 'post',
                data: save,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleDateString("sv-SE");
                        var date = new Date().toLocaleDateString("sv-SE");
                        var adminID = "{{ Auth::user()->getPermission(['admin_kepegawaian']) }}";
                        var superID = "{{ Auth::user()->getRole('kabag-kepegawaian') }}";
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        content += `<td><center><div class='btn-group'>
                                        <button type='button' class='btn btn-sm btn-link text-secondary dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</button>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                                        if (adminID == true) {
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-info" onclick="detail(${item.id})"><i class="fas fa-calendar-alt me-2"></i> Detail</a></li>`;
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fa-fw fas fa-edit me-2"></i> Ubah</a></li>`;
                                            if (superID == true) {
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item text-secondary'><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                            }
                                        } else {
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fas fa-calendar-alt me-2"></i> Detail</a></li>`;
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fa-fw fas fa-edit me-2"></i> Ubah</a></li>`;
                                        }
                        content += "</div></center></td>";
                        content += `<td>${moment(item.ref_jam_masuk).format('YYYY-MM-DD')}</td>`;
                        content += `<td>${item.id_pegawai}</td>`;
                        content += `<td class="text-end">${item.nip_pegawai?item.nip_pegawai:'-'}</td>`;
                        content += `<td>${item.nama_pegawai}</td>`;
                        role = '';
                        res.role.forEach(us => {
                            if (us.id_user == item.pegawai_id) {
                                role += `<span class="badge bg-light-secondary me-1">${us.nama_role}</span>`;
                            }
                        })
                        content += `<td>${role}</td>`;
                        jenis = '';
                        if (item.jenis == 1) {
                            jenis = `<h6>Masuk <b class="text-primary">Shift</b></h6>`;
                        } else {
                            if (item.jenis == 3) {
                                jenis = `<h6>Tidak Masuk/<b class="text-warning">Ijin</b></h6>`;
                            } else {
                                jenis = `<h6>Tidak <b class="text-danger">Terdefinisi</b></h6>`;
                            }
                        }
                        content += `<td>${jenis}</td>`;
                        content += `<td>${item.nm_shift} (${item.kd_shift})</td>`;
                        content += `<td>${moment(item.ref_jam_masuk).format('HH:mm') +" - "+ moment(item.ref_jam_pulang).format('HH:mm')}</td>`;
                        if (item.terlambat == 1) {
                            colorTglIn = 'text-bg-primary';
                        } else {
                            if (item.terlambat == 0) {
                                colorTglIn = 'text-bg-primary';
                            } else {
                                colorTglIn = 'text-bg-warning';
                            }
                        }
                        content += `<td><span class="badge ${colorTglIn}">${new Date(item.tgl_in).toLocaleString("sv-SE")}</span></td>`;
                        if (item.tgl_out) {
                            tgl_out = '<span class="badge text-bg-secondary">'+new Date(item.tgl_out).toLocaleString("sv-SE")+'</span>';
                        } else {
                            if (item.jenis != 3) {
                                tgl_out = '<span class="badge text-bg-info">Belum/Tidak Absen Pulang</span>';
                            } else {
                                tgl_out = '-';
                            }
                        }
                        content += `<td>${tgl_out}</td>`;
                        content += `<td class="text-end">${item.keterlambatan?toTime(item.keterlambatan):'-'}</td>`;
                        content += `<td class="text-end">${item.lembur?toTime(item.lembur):'-'}</td>`;
                        content += `<td class="text-end">${item.selisih_jam?toTime(item.selisih_jam):'-'}</td>`;
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                        // Showing Tooltip
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger: 'hover'
                        })
                    });
                    var table = $('#dttable').DataTable({
                        dom: 'Bfrtip',
                        scrollX: true, // Tambahkan ini untuk memungkinkan scroll horizontal
                        scrollCollapse: true,
                        fixedColumns: {
                            leftColumns: 5 // Jumlah kolom kiri yang ingin dibekukan (NIP, PEGAWAI, UNIT)
                        },
                        order: [
                            // [1, "desc"],
                            [4, "asc"],
                        ],
                        // bAutoWidth: false,
                        // aoColumns : [
                        //     { sWidth: '5%' },
                        //     { sWidth: '10%' },
                        //     { sWidth: '30%' },
                        //     { sWidth: '10%' },
                        //     { sWidth: '10%' },
                        //     { sWidth: '10%' },
                        //     { sWidth: '10%' },
                        //     { sWidth: '5%' },
                        //     { sWidth: '5%' },
                        //     { sWidth: '5%' },
                        // ],
                        columnDefs: [
                            { visible: false, targets: [2] },
                        ],
                        displayLength: 100,
                        lengthChange: true,
                        lengthMenu: [100, 300, 500, 1000, 3000, 5000, 10000, 30000, 50000],
                        buttons: [
                            {
                                extend: 'excel',
                                text: 'Export Excel',
                                orientation: 'landscape',
                                pageSize: 'A4',
                                exportOptions: {
                                    columns: [1,2,3,4,5,6,7,8,9,10,11,12,13] // hanya kolom tertentu
                                },
                                className: 'btn btn-success'
                            },
                            {
                                extend: 'pdf',
                                text: 'Export PDF',
                                orientation: 'landscape',
                                pageSize: 'A4',  // F4 dalam milimeter
                                exportOptions: {
                                    columns: [1,2,3,4,5,6,7,8,9,10,11,12,13] // hanya kolom tertentu
                                },
                                className: 'btn btn-danger',
                                customize: function (doc) {
                                    // Menambahkan judul di atas tabel
                                    doc.content.unshift({
                                        text: 'Laporan Data Absensi Pegawai',  // Judul yang ingin ditambahkan
                                        fontSize: 18,   // Ukuran font
                                        bold: true,     // Menebalkan teks
                                        alignment: 'center', // Menyelaraskan teks ke tengah
                                        margin: [0, 0, 0, 10]  // Margin bawah (untuk memberi jarak antara judul dan tabel)
                                    });

                                    // Pastikan header tabel tetap disembunyikan jika diinginkan
                                    if (doc.content && doc.content[1] && doc.content[1].table) {
                                        doc.content[1].table.headerRows = 0;
                                    }
                                }
                            },
                            {
                                extend: 'print',
                                text: 'Cetak',
                                orientation: 'landscape',
                                pageSize: 'A4',  // F4 dalam milimeter
                                className: 'btn btn-warning',
                                customize: function (win) {
                                    // Sembunyikan semua selain tabel
                                    $(win.document.body).find('*').not('table, table *').hide();

                                    $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                },
                                exportOptions: {
                                    columns: [1,2,3,4,5,6,7,8,9,10,11,12,13] // hanya kolom tertentu
                                },
                            },
                            {
                                extend: 'colvis',
                                text: 'Sembunyikan Kolom',
                                className: 'btn btn-dark',
                            }
                        ],
                    });
                    iziToast.success({
                        title: 'System Message!',
                        message: 'Berhasil menampilkan data Absensi keseluruhan',
                        position: 'topRight'
                    });
                }
            })
        }

        function showRekapAbsensiLinda() {
            Swal.fire({
                title: `Mohon Perhatian!`,
                text: 'Isikan NIP Seluruh Pegawai dengan Lengkap pada Halaman Profil Kepegawaian guna kelancaran rekap data Absensi',
                icon: `warning`,
                showConfirmButton: false,
                showCancelButton: false,
                allowOutsideClick: true,
                allowEscapeKey: true,
                timer: 5000,
                timerProgressBar: true,
                backdrop: `rgba(26,27,41,0.8)`,
            });
            $("#tampil-thead").empty().append(`
                <tr>
                    <th rowspan="2" class="text-center"><center>NIP</center></th>
                    <th rowspan="2" class="text-center">PEGAWAI</th>
                    <th rowspan="2" class="text-center">UNIT</th>
                    <th colspan="7" class="text-center">TOTAL (JADWAL DINAS)</th>
                    <th colspan="5" class="text-center">TOTAL (ABSENSI)</th>
                    <th rowspan="2" class="text-center">KETERANGAN</th>
                </tr>
                <tr>
                    <th class="text-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Total Shift Sesuai Jadwal Dinas">S</th>
                    <th class="text-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Total Libur Sesuai Jadwal Dinas">L</th>
                    <th class="text-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Total Cuti Tahunan Sesuai Jadwal Dinas">C</th>
                    <th class="text-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Total Cuti Menikah Sesuai Jadwal Dinas">CM</th>
                    <th class="text-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Total Cuti Umroh Sesuai Jadwal Dinas">CU</th>
                    <th class="text-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Total Cuti Haji Sesuai Jadwal Dinas">CH</th>
                    <th class="text-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Total Cuti Diluar Tanggungan Sesuai Jadwal Dinas">CD</th>
                    <th class="text-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Total Datang Tepat Waktu Dari Data Absensi">TEPAT WAKTU</th>
                    <th class="text-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Total Terlambat Dari Data Absensi">TERLAMBAT</th>
                    <th class="text-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Total Absen Hanya 1 Kali Dari Data Absensi">ABSEN 1X</th>
                    <th class="text-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Total Ijin Dari Data Absensi">IJIN</th>
                    <th class="text-end" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Total Seluruh Absen Dari Data Absensi">ABSENSI</th>
                </tr>
            `);
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="20"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $('#table').prop('hidden',false);
            // INITIALIZIE
            var save = new FormData();
            save.append('jenis',$('#filter_jenis').val());
            save.append('unit',JSON.stringify($('#filter_unit').val()));
            save.append('dari',$('#filter_dari').val());
            save.append('sampai',$('#filter_sampai').val());
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/kepegawaian/absensi/table/rekapLinda`,
                method: 'post',
                data: save,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleDateString("sv-SE");
                        var date = new Date().toLocaleDateString("sv-SE");
                        var adminID = "{{ Auth::user()->getPermission(['admin_kepegawaian']) }}";
                        var superID = "{{ Auth::user()->getRole('kabag-kepegawaian') }}";
                        content = "<tr id='data" + item.pegawai_id + "' style='font-size:13px'>";
                        content += `<td class="text-center">${item.nip?item.nip:'-'}</td>`;
                        content += `<td>${item.nama}</td>`;
                        content += `<td>${item.unit}</td>`;
                        content += `<td class="text-end">${item.total_masuk_shift}</td>`;
                        content += `<td class="text-end">${item.total_L}</td>`;
                        content += `<td class="text-end">${item.total_C}</td>`;
                        content += `<td class="text-end">${item.total_CM}</td>`;
                        content += `<td class="text-end">${item.total_CU}</td>`;
                        content += `<td class="text-end">${item.total_CH}</td>`;
                        content += `<td class="text-end">${item.total_CD}</td>`;
                        content += `<td class="text-end">${item.total_tidak_terlambat}</td>`;
                        content += `<td class="text-end">${item.total_terlambat}</td>`;
                        content += `<td class="text-end">${item.total_alpha}</td>`;
                        content += `<td class="text-end">${item.total_ijin}</td>`;
                        content += `<td class="text-end">${item.total_absensi}</td>`;
                        content += `<td class="text-end text-capitalize">${item.status}</td>`;
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                        // Showing Tooltip
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger: 'hover'
                        })
                    });
                    var table = $('#dttable').DataTable({
                        dom: 'Bfrtip',
                        scrollX: true, // Tambahkan ini untuk memungkinkan scroll horizontal
                        scrollCollapse: true,
                        fixedColumns: {
                            leftColumns: 3 // Jumlah kolom kiri yang ingin dibekukan (NIP, PEGAWAI, UNIT)
                        },
                        order: [
                            [2, "asc"],
                            [1, "asc"]
                        ],
                        displayLength: 100,
                        lengthChange: true,
                        lengthMenu: [100, 300, 500, 1000, 3000, 5000, 10000, 30000, 50000],
                        buttons: [
                            {
                                extend: 'excel',
                                text: 'Export Excel',
                                orientation: 'landscape',
                                pageSize: 'A4',
                                exportOptions: {
                                    columns: [1,2,3,4,5,6,7,8,9,10,11,12,13] // hanya kolom tertentu
                                },
                                className: 'btn btn-success'
                            },
                            {
                                extend: 'pdf',
                                text: 'Export PDF',
                                orientation: 'landscape',
                                pageSize: 'A4',  // F4 dalam milimeter
                                exportOptions: {
                                    columns: [1,2,3,4,5,6,7,8,9,10,11,12,13] // hanya kolom tertentu
                                },
                                className: 'btn btn-danger',
                                customize: function (doc) {
                                    // Menambahkan judul di atas tabel
                                    doc.content.unshift({
                                        text: 'Laporan Data Absensi Pegawai',  // Judul yang ingin ditambahkan
                                        fontSize: 18,   // Ukuran font
                                        bold: true,     // Menebalkan teks
                                        alignment: 'center', // Menyelaraskan teks ke tengah
                                        margin: [0, 0, 0, 10]  // Margin bawah (untuk memberi jarak antara judul dan tabel)
                                    });

                                    // Pastikan header tabel tetap disembunyikan jika diinginkan
                                    if (doc.content && doc.content[1] && doc.content[1].table) {
                                        doc.content[1].table.headerRows = 0;
                                    }
                                }
                            },
                            {
                                extend: 'print',
                                text: 'Cetak',
                                orientation: 'landscape',
                                pageSize: 'A4',  // F4 dalam milimeter
                                className: 'btn btn-warning',
                                customize: function (win) {
                                    // Sembunyikan semua selain tabel
                                    $(win.document.body).find('*').not('table, table *').hide();

                                    $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                },
                                exportOptions: {
                                    columns: [1,2,3,4,5,6,7,8,9,10,11,12,13] // hanya kolom tertentu
                                },
                            },
                            {
                                extend: 'colvis',
                                text: 'Sembunyikan Kolom',
                                className: 'btn btn-dark',
                            }
                        ],
                    });
                    iziToast.success({
                        title: 'System Message!',
                        message: 'Berhasil menampilkan data Rekapitulasi Absensi berdasarkan masing-masing Pegawai dan Per Unit',
                        position: 'topRight'
                    });
                }
            })
        }

        function showRekapAbsensiLindaDetail() {
            Swal.fire({
                title: `Mohon Perhatian!`,
                text: 'Isikan NIP Seluruh Pegawai dengan Lengkap pada Halaman Profil Kepegawaian guna kelancaran rekap data Absensi',
                icon: `warning`,
                showConfirmButton: false,
                showCancelButton: false,
                allowOutsideClick: true,
                allowEscapeKey: true,
                timer: 5000,
                timerProgressBar: true,
                backdrop: `rgba(26,27,41,0.8)`,
            });
            $("#tampil-thead").empty().append(`
                <tr>
                    <th class="text-center"><center>NIP</center></th>
                    <th class="text-center">PEGAWAI</th>
                    <th class="text-center">UNIT</th>
                    <th class="text-center">TANGGAL</th>
                    <th class="text-center">ABSENSI BERANGKAT</th>
                    <th class="text-center">ABSENSI PULANG</th>
                    <th class="text-center">TERLAMBAT</th>
                    <th class="text-center">TEPAT WAKTU</th>
                    <th class="text-center">ABSEN 1X</th>
                    <th class="text-center">IJIN</th>
                    <th class="text-center">KETERANGAN</th>
                </tr>
            `);
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="20"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $('#table').prop('hidden',false);
            // INITIALIZIE
            var save = new FormData();
            save.append('jenis',$('#filter_jenis').val());
            save.append('unit',JSON.stringify($('#filter_unit').val()));
            save.append('dari',$('#filter_dari').val());
            save.append('sampai',$('#filter_sampai').val());
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: `/api/kepegawaian/absensi/table/rekapLindaDetail`,
                method: 'post',
                data: save,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleDateString("sv-SE");
                        var date = new Date().toLocaleDateString("sv-SE");
                        var adminID = "{{ Auth::user()->getPermission(['admin_kepegawaian']) }}";
                        var superID = "{{ Auth::user()->getRole('kabag-kepegawaian') }}";
                        content = "<tr id='data" + item.pegawai_id + "' style='font-size:13px'>";
                        content += `<td class="text-center">${item.nip?item.nip:'-'}</td>`;
                        content += `<td>${item.nama}</td>`;
                        content += `<td>${item.unit}</td>`;
                        content += `<td>${item.tanggal}</td>`;
                        content += `<td>${item.is_terlambat==1?'<b class="text-danger">'+item.jam_masuk+'</b>':item.jam_masuk}</td>`;
                        content += `<td>${item.jam_pulang?item.jam_pulang:'-'}</td>`;
                        content += `<td class="text-center">${item.is_terlambat==1?'<i class="ti ti-mood-sad text-danger" style="font-size: 20px;"></i>':' '}</td>`;
                        content += `<td class="text-center">${item.is_tidak_terlambat==1?'<i class="ti ti-mood-smile text-success" style="font-size: 20px;"></i>':' '}</td>`;
                        content += `<td class="text-center">${item.is_alpha==1?'<i class="ti ti-mood-neutral text-warning" style="font-size: 20px;"></i>':' '}</td>`;
                        content += `<td class="text-center">${item.is_ijin==1?'<i class="ti ti-mood-crazy-happy text-info" style="font-size: 20px;"></i>':' '}</td>`;
                        content += `<td class="text-end">${item.status_keterangan}</td>`;
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                        // Showing Tooltip
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger: 'hover'
                        })
                    });
                    var table = $('#dttable').DataTable({
                        dom: 'Bfrtip',
                        order: [
                            [1, "asc"], // Kolom PEGAWAI (kolom ke-3, index 2)
                            [3, "asc"]   // Kolom TANGGAL (kolom ke-4, index 3)
                        ],
                        // bAutoWidth: false,
                        // aoColumns : [
                        //     { sWidth: '5%' },
                        //     { sWidth: '10%' },
                        //     { sWidth: '30%' },
                        //     { sWidth: '10%' },
                        //     { sWidth: '10%' },
                        //     { sWidth: '10%' },
                        //     { sWidth: '10%' },
                        //     { sWidth: '5%' },
                        //     { sWidth: '5%' },
                        //     { sWidth: '5%' },
                        // ],
                        displayLength: 100,
                        lengthChange: true,
                        lengthMenu: [100, 300, 500, 1000, 3000, 5000, 10000, 30000, 50000],
                        buttons: [
                            {
                                extend: 'excel',
                                text: 'Export Excel',
                                orientation: 'landscape',
                                pageSize: 'A4',
                                exportOptions: {
                                    columns: [1,2,3,4,5,6,7,8,9,10,11,12,13] // hanya kolom tertentu
                                },
                                className: 'btn btn-success'
                            },
                            {
                                extend: 'pdf',
                                text: 'Export PDF',
                                orientation: 'landscape',
                                pageSize: 'A4',  // F4 dalam milimeter
                                exportOptions: {
                                    columns: [1,2,3,4,5,6,7,8,9,10,11,12,13] // hanya kolom tertentu
                                },
                                className: 'btn btn-danger',
                                customize: function (doc) {
                                    // Menambahkan judul di atas tabel
                                    doc.content.unshift({
                                        text: 'Laporan Data Absensi Pegawai',  // Judul yang ingin ditambahkan
                                        fontSize: 18,   // Ukuran font
                                        bold: true,     // Menebalkan teks
                                        alignment: 'center', // Menyelaraskan teks ke tengah
                                        margin: [0, 0, 0, 10]  // Margin bawah (untuk memberi jarak antara judul dan tabel)
                                    });

                                    // Pastikan header tabel tetap disembunyikan jika diinginkan
                                    if (doc.content && doc.content[1] && doc.content[1].table) {
                                        doc.content[1].table.headerRows = 0;
                                    }
                                }
                            },
                            {
                                extend: 'print',
                                text: 'Cetak',
                                orientation: 'landscape',
                                pageSize: 'A4',  // F4 dalam milimeter
                                className: 'btn btn-warning',
                                customize: function (win) {
                                    // Sembunyikan semua selain tabel
                                    $(win.document.body).find('*').not('table, table *').hide();

                                    $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                },
                                exportOptions: {
                                    columns: [1,2,3,4,5,6,7,8,9,10,11,12,13] // hanya kolom tertentu
                                },
                            },
                            {
                                extend: 'colvis',
                                text: 'Sembunyikan Kolom',
                                className: 'btn btn-dark',
                            }
                        ],
                    });
                    iziToast.success({
                        title: 'System Message!',
                        message: 'Berhasil menampilkan data Rekapitulasi Absensi berdasarkan masing-masing Pegawai dan Per Tanggal',
                        position: 'topRight'
                    });
                }
            })
        }

        // FUNCTION FITURE
        function detail(id) {
            $("#tampil-tbody-detail").empty().append(`<tr style='font-size:13px'><td colspan="20"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: `/api/kepegawaian/absensi/${id}/detail`,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.show) {
                        $('#show_id_detail').text('ID#'+id);
                        // INIT HEADER
                        if (res.show.jenis == 1) {
                            tx = 'Shift '+res.show.nm_shift;
                            clr = 'primary';
                            // $('#jenis_shift').empty().append('<span class="badge text-bg-primary p-1">Shift '+res.show.nm_shift+'</span>');
                        } else {
                            if (res.show.jenis == 3) {
                                tx = 'Ijin';
                                clr = 'warning';
                                // $('#jenis_shift').empty().append('<span class="badge text-bg-warning p-1">Ijin</span>');
                            } else {
                                tx = 'OnCall';
                                clr = 'danger';
                                // $('#jenis_shift').empty().append('<span class="badge text-bg-danger p-1">OnCall</span>');
                            }
                        }
                        $('#show_jenis_detail').addClass(`text-bg-${clr}`).text(tx);
                        // INIT CONTENT
                        if (res.show.terlambat == 0) {
                            stt = '<span class="badge text-bg-success p-1">TEPAT WAKTU</span>';
                        } else {
                            stt = '<span class="badge text-bg-danger p-1">TERLAMBAT</span>';
                        }
                        var parts_in = res.show.tgl_in.split(' '); // pisah berdasarkan spasi
                        date_in = parts_in[0]; // "2025-04-04"
                        time_in = parts_in[1]; // "20:00:00"
                        if (res.show.tgl_out) {
                            var parts_out = res.show.tgl_out.split(' ');
                            date_out = parts_out[0]; // "2025-04-04"
                            time_out = parts_out[1]; // "20:00:00"
                        } else {
                            date_out = '-';
                            time_out = '-';
                        }
                        $('#tampil-tbody-detail').empty().append(`
                            <tr>
                                <th class="text-start">Bukti Foto</th>
                                <td>
                                    <a href="https://absensi.simrsmu.com/api/kepegawaian/detail/foto/${res.show.id}/1" data-lightbox="gallery" data-title="Bukti Foto Absensi (${res.show.foto_in?res.show.foto_in:'-'})" style="width:500px;height:500px">
                                        <img src="https://absensi.simrsmu.com/api/kepegawaian/detail/foto/${res.show.id}/1" class="img-fluid m-b-10" alt="" style="width:500px;height:500px">
                                    </a>
                                </td>
                                <td>
                                    <a href="https://absensi.simrsmu.com/api/kepegawaian/detail/foto/${res.show.id}/0" data-lightbox="gallery" data-title="Bukti Foto Absensi (${res.show.foto_out?res.show.foto_out:'-'})" style="width:500px;height:500px">
                                        <img src="https://absensi.simrsmu.com/api/kepegawaian/detail/foto/${res.show.id}/0" class="img-fluid m-b-10" alt="" style="width:500px;height:500px">
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-start">Lokasi</th>
                                <td>${res.show.lokasi_in}</td>
                                <td>${res.show.lokasi_out?res.show.lokasi_out:'-'}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Tanggal Absen</th>
                                <td>${moment(date_in).format('dddd, D MMMM YYYY')}</td>
                                <td>${res.show.tgl_out?moment(date_out).format('dddd, D MMMM YYYY'):'-'}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Waktu/Jam Absen</th>
                                <td data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Referensi Berangkat Pukul ${moment(res.show.ref_jam_masuk).format('HH:mm:ss')}">${time_in}</td>
                                <td data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Referensi Pulang Pukul ${moment(res.show.ref_jam_pulang).format('HH:mm:ss')}">${time_out}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Total Waktu Bekerja</th>
                                <td colspan="2">${res.show.selisih_jam?res.show.selisih_jam:'-'}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Keterlambatan</th>
                                <td colspan="2" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Toleransi Keterlambatan 10 Menit">${res.show.keterlambatan} ${stt}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Lembur</th>
                                <td colspan="2">${res.show.lembur?res.show.lembur:'-'}</td>
                            </tr>
                            <tr>
                                <th class="text-start">Keterangan</th>
                                <td colspan="2">${res.show.keterangan?res.show.keterangan:'Tidak Ada.'}</td>
                            </tr>
                        `);
                        // INIT MAP
                        // tampilMapIn(res.show.lokasi_in);
                        // if (res.show.lokasi_out) {
                        //     tampilMapOut(res.show.lokasi_out);
                        // }
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger: 'hover'
                        })
                        $('#modalDetail').modal('show');
                    } else {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Data Absensi Tidak Valid. Hubungi Administrator!',
                            position: 'topRight'
                        });
                    }
                },
                error: function(res) {
                    if (res.responseJSON && res.responseJSON.message) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: res.responseJSON.message,
                            position: 'topRight'
                        });
                    } else {
                        alert('Terjadi kesalahan.');
                    }
                }
            })
        }

        function tampilMapIn(lokasi) {
            // Tampil MAP
            if (map_in) {
                map_in.remove();
            }
            var lat,long;// Creating a promise out of the function
            var arr = lokasi.split(", ");
            console.log(arr);
            lat = arr[0];
            long = arr[1];
            map_in = L.map('map_in',{
                keyboard: false,
                zoomControl: false,
                boxZoom: false,
                doubleClickZoom: false,
                tap: false,
                touchZoom: false,
                enableHighAccuracy: true,
                scrollWheelZoom: false,
                dragging: false,
                doubleClickZoom: false,
            }).setView([lat, long], 18);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxNativeZoom:16,
                minZoom:16,
                maxZoom:16
                // attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map_in);

            var marker = new L.Marker([lat, long]);
            // marker.addTo(map_in).bindPopup("<center>Titik Lokasi Anda<br><b class='text-danger'>"+lokasi+"</b></center>").openPopup();
            marker.addTo(map_in).openPopup();
        }

        function tampilMapOut(lokasi) {
            if (map_out) {
                map_out.remove(); // beda instance!
            }
            var arr = lokasi.split(", ");
            var lat = arr[0];
            var long = arr[1];

            map_out = L.map('map_out', {
                keyboard: false,
                zoomControl: false,
                boxZoom: false,
                doubleClickZoom: false,
                tap: false,
                touchZoom: false,
                enableHighAccuracy: true,
                scrollWheelZoom: false,
                dragging: false
            }).setView([lat, long], 18);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxNativeZoom:16,
                minZoom:16,
                maxZoom:16
            }).addTo(map_out);

            var marker = L.marker([lat, long]);
            marker.addTo(map_out).openPopup();
        }

        function clearInput() {
            // $('#filter_pilihan').val('').change();
            $('#filter_unit').val('').change();
            $('#filter_jenis').val('0');
            $('#filter_dari').val('').change();
            $('#filter_sampai').val('').change();
        }

        function getDateTime() {
            var now = new Date();
            var year = now.getFullYear();
            var month = now.getMonth() + 1;
            var day = now.getDate();
            if (month.toString().length == 1) {
                month = '0' + month;
            }
            if (day.toString().length == 1) {
                day = '0' + day;
            }
            var dateTime = year + '-' + month + '-' + day;
            return dateTime;
        }

        function toTime(waktu) {
            if (waktu == "00:00:00") {
                var hasil = '-';
            } else {
                var parts = waktu.split(':'); // pisah jadi array ['07','04','20']

                var hasil = parseInt(parts[0]) + 'j ' + parseInt(parts[1]) + 'm ' + parseInt(parts[2]) + 'd';
            }

            return hasil; // Output: "7j 4m 20d"
        }
    </script>
@endsection
