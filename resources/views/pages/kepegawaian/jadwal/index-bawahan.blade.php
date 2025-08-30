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
                        <li class="breadcrumb-item"><a href="{{ route('kepegawaian.jadwaldinas.index') }}">Jadwal Dinas</a></li>
                        <li class="breadcrumb-item" aria-current="page">Verifikasi</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0"><b class="text-danger">Verifikasi</b> Jadwal Dinas</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        <div class="col-xl-12">
            <div class="card table-card">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <div class="btn-group">
                        <a href="{{ route('kepegawaian.jadwaldinas.index') }}" class="btn btn-light-dark align-items-center" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Kembali ke Halaman Sebelumnya"><i class="ti ti-arrow-back-up me-2"></i> Kembali</a>
                        <button class="btn btn-light-warning" onclick="showRiwayat()"><i class="ti ti-refresh f-20 me-2"></i> Refresh Tabel</button>
                        {{-- <a href="javascript:void(0);" class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical f-18"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="showRiwayat()">Segarkan Tabel</a>
                            </li>
                        </ul> --}}
                    </div>
                    <h5 class="mb-0">Tabel Verifikasi Jadwal Dinas</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dttable" class="table table-hover dt-responsive align-middle">
                            <thead>
                                <tr>
                                    <th><center>#ID</center></th>
                                    <th>BLN / THN</th>
                                    <th>STAF</th>
                                    <th>KETERANGAN</th>
                                    <th>STATUS</th>
                                    <th>DIPERBARUI</th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody">
                                <tr>
                                    <td colspan="9" style="font-size:13px">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th><center>#ID</center></th>
                                    <th>BLN / THN</th>
                                    <th>STAF</th>
                                    <th>KETERANGAN</th>
                                    <th>STATUS</th>
                                    <th>DIPERBARUI</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                {{-- <div class="card-footer">

                </div> --}}
            </div>
        </div>
    </div>

    <div class="modal fade animate__animated animate__rubberBand" id="modalLihat" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true">
        <div class="modal-dialog modal-xxl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        Ditambahkan oleh <a class="text-primary" id="showUser"></a>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="tampil-jadwal">
                    <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn-refresh-lihat" class="btn btn-link-warning me-sm-3 me-1"><i class="fa fa-sync me-1" style="font-size:13px"></i> Segarkan</button>
                    <button type="button" class="btn btn-link-secondary" data-bs-dismiss="modal">Tutup &nbsp;<i class="fa-fw fas fa-chevron-right nav-icon" style="font-size:13px"></i></button>
                </div>
            </div>
        </div>
    </div>
    {{-- FORM VERIF & BATAL VERIF --}}
    <div class="modal animate__animated animate__rubberBand fade" id="modalVerif" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Verif
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_verif" hidden>
                    <p style="text-align: justify;">Anda akan melakukan verifikasi Jadwal Dinas tersebut, status akan berubah ke <kbd>DIVERIFIKASI</kbd>. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan pemrosesan data.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuverif">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-verif" class="btn btn-success me-sm-3 me-1" onclick="prosesVerif()"><i class="fa fa-calendar-check me-1" style="font-size:13px"></i> Verifikasi</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalBatalVerif" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Batal Verif
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_batal_verif" hidden>
                    <p style="text-align: justify;">Anda akan melakukan pembatalan verifikasi Jadwal Dinas tersebut, status akan berubah ke <kbd>PENDING</kbd>. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan pemrosesan data.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujubatalverif">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-batal-verif" class="btn btn-warning me-sm-3 me-1" onclick="prosesBatalVerif()"><i class="fa fa-calendar-check me-1" style="font-size:13px"></i> Batalkan Verifikasi</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    {{-- FORM TOLAK & BATAL TOLAK --}}
    <div class="modal animate__animated animate__rubberBand fade" id="modalTolak" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Penolakan
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_tolak" hidden>
                    <p style="text-align: justify;">Anda akan melakukan penolakan Jadwal Dinas tersebut, status akan berubah ke <kbd>DITOLAK</kbd>. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan pemrosesan data.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujutolak">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-tolak" class="btn btn-danger me-sm-3 me-1" onclick="prosesTolak()"><i class="fa fa-calendar-times me-1" style="font-size:13px"></i> Tolak</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalBatalTolak" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Batal Penolakan
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_batal_tolak" hidden>
                    <p style="text-align: justify;">Anda akan melakukan pembatalan penolakan Jadwal Dinas tersebut, status akan berubah ke <kbd>PENDING</kbd>. Lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan pemrosesan data.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujubataltolak">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-batal-verif" class="btn btn-danger me-sm-3 me-1" onclick="prosesBatalTolak()"><i class="fa fa-calendar-times me-1" style="font-size:13px"></i> Batalkan Penolakan</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}

    <script>
        $(document).ready(function() {
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

            // $('.select2Tambah').select2({
            //     dropdownParent: $('#tambah')
            // });

            showRiwayat();
        });

        function showRiwayat() {
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/kepegawaian/jadwaldinas/bawahan/table/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleDateString("sv-SE");
                        var date = new Date().toLocaleDateString("sv-SE");
                        var bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        content += `<td><center><div class='btn-group'>
                                        <button type='button' class='btn btn-sm btn-link text-secondary dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</button>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-info" onclick="lihat(${item.id})"><i class="fa-fw fas fa-list-ol me-2"></i> Lihat</a></li>`;
                                            if (item.progress == 1) { // SEBELUM VERIFIKASI/PENDING
                                                content += `<li><a href="javascript:void(0);" class="dropdown-item text-success" onclick="verif(${item.id})"><i class="fa-fw fas fa-calendar-check me-2"></i> Verif</a></li>`;
                                                content += `<li><a href="javascript:void(0);" class="dropdown-item text-danger" onclick="tolak(${item.id})"><i class="fa-fw fas fa-calendar-times me-2"></i> Tolak</a></li>`;
                                            } else { // SETELAH DIVERIFIKASI
                                                if (item.progress == 2) {
                                                    content += `<li><a href="javascript:void(0);" class="dropdown-item text-warning" onclick="batalVerif(${item.id})"><i class="fa-fw fas fa-calendar-check me-2"></i> Batal Verif</a></li>`;
                                                    content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fa-fw fas fa-calendar-times me-2"></i> Tolak</a></li>`;
                                                } else { // DIVALIDASI
                                                    if (item.progress == 3) {
                                                        content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fa-fw fas fa-calendar-check me-2"></i> Batal Verif</a></li>`;
                                                        content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fa-fw fas fa-calendar-times me-2"></i> Tolak</a></li>`;
                                                    } else { // DITOLAK
                                                        content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fa-fw fas fa-calendar-check me-2"></i> Verif</a></li>`;
                                                        content += `<li><a href="javascript:void(0);" class="dropdown-item text-warning" onclick="batalTolak(${item.id})"><i class="fa-fw fas fa-calendar-times me-2"></i> Batal Tolak</a></li>`;
                                                    }
                                                }
                                            }
                        content += "</ul></div></center></td>";
                        for (let i = 1; i <= bulan.length; i++) {
                            if (i == item.bulan) {
                                content += `<td>${bulan[i]} ${item.tahun}</td>`;
                            }
                        }
                        var nama_verif = null;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>Unit ${item.unit?'<b class="text-primary">'+item.unit+'</b>':'<s class="text-danger">Tidak Valid</s>'}</h6>
                                                <small class='text-muted'>`;
                        res.users.forEach(us => {
                            JSON.parse(item.staf).forEach(val => {
                                if (val == us.id) {
                                    content += `${us.nama?us.nama:'<b class="text-danger">'+us.name+'</b>'}; `;
                                }
                            })
                            if (us.id == item.verif) {
                                nama_verif = us.nama;
                            }
                        })
                        content += `</small></ul></td>`;
                        content += `<td>${item.keterangan?item.keterangan:''}</td>`;
                        if (item.progress == 0) {
                            var status = `<span class="badge rounded-pill text-bg-danger">Ditolak</span>`;
                        } else {
                            if (item.progress == 1) {
                                var status = `<span class="badge rounded-pill text-bg-warning">Pending</span>`;
                            } else {
                                if (item.progress == 2) {
                                    var status = `<span class="badge rounded-pill text-bg-success">Diverifikasi</span>`;
                                } else {
                                    if (item.progress == 3) {
                                        var status = `<span class="badge rounded-pill text-bg-primary">Divalidasi</span>`;
                                    } else {
                                        var status = `<span class="badge rounded-pill text-bg-info">Tidak Valid</span>`;
                                    }
                                }
                            }
                        }
                        content += `<td>${status}</td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0'>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</a>
                                                <small class='text-truncate text-muted'>Ditambahkan Oleh ` + item.nama_pegawai + `</small>
                                                ${nama_verif!=null?'<small class="text-truncate text-muted">Diverifikasi Oleh '+nama_verif+'</small>':''}
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
                            [5, "desc"]
                        ],
                        // bAutoWidth: false,
                        // aoColumns : [
                        //     { sWidth: '5%' },
                        //     { sWidth: '10%' },
                        //     { sWidth: '45%' },
                        //     { sWidth: '28%' },
                        //     { sWidth: '12%' },
                        // ],
                        columnDefs: [
                            // { visible: false, targets: [7] },
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        // buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });
                }
            })
        }

        function lihat(id) {
            $("#tampil-jadwal").empty().append(`<center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>`);
            $.ajax({
                url: "/api/kepegawaian/jadwaldinas/jadwal/"+id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    if (res.detail.length == 0) {
                        notifier.show(
                            "Pesan Galat!", "Data isian Jadwal Dinas tidak ditemukan, silakan melakukan konfirmasi ulang kepada bagian terkait",
                            "warning", "{{ asset('images/notification/medium_priority-48.png') }}", 4e3
                        );
                    } else {
                        $("#showUser").text(res.jadwal.nama_pegawai)
                        // INIT
                        var n = 1;
                        // PROCESS
                        content = ``;
                        content += `<h4 class="text-center mb-2">Jadwal Dinas Unit <b class="text-primary">${res.jadwal.unit}</b></h4><h5 class="text-center mb-2">Bulan <b class="text-primary">${res.bulan}</b> Tahun <b class="text-primary">${res.jadwal.tahun}</b></h5>`;
                        content += `<div class="row"><div class="col-md-12"><div class="table-responsive p-10 pb-0">
                                    <table id="dttable" class="table table-bordered" style="width: 100%;table-layout: auto">
                                        <thead>
                                        <tr>
                                            <th class="text-center" rowspan="2">NO</th>
                                            <th class="text-center" rowspan="2">NAMA</th>
                                            <th class="text-center" colspan="${res.totalDay}">TANGGAL</th>
                                        </tr>
                                        <tr>`;
                                        for (let i = 1; i <= res.totalDay; i++) {
                                            content += `<th class="p-2 text-center tgl${i}">${i < 10?'0'+i:i}</th>`;
                                        }
                        content += `    </tr>
                                    </thead>
                                    <tbody>`;
                            for (let t = 0; t < res.detail.length; t++) {
                                content += `<tr class="text-center" style="background-color: ${res.detail[t].color}">`;
                                    content += `<td>${n++}</td>`;
                                    content += `<td class="text-start">
                                                    <div class='d-flex justify-content-start align-items-center'>
                                                        <div class='d-flex flex-column'>
                                                            <h6 class='mb-0'>${res.detail[t].pegawai_nama}</h6>
                                                            <small class='text-truncate text-muted'>${res.detail[t].jabatan?res.detail[t].jabatan:''}</small>
                                                        </div>
                                                    </div>
                                                </td>`;
                                    content += `<td class="p-2 tgl1">${res.detail[t].tgl1?res.detail[t].tgl1:''}</td>`;
                                    content += `<td class="p-2 tgl2">${res.detail[t].tgl2?res.detail[t].tgl2:''}</td>`;
                                    content += `<td class="p-2 tgl3">${res.detail[t].tgl3?res.detail[t].tgl3:''}</td>`;
                                    content += `<td class="p-2 tgl4">${res.detail[t].tgl4?res.detail[t].tgl4:''}</td>`;
                                    content += `<td class="p-2 tgl5">${res.detail[t].tgl5?res.detail[t].tgl5:''}</td>`;
                                    content += `<td class="p-2 tgl6">${res.detail[t].tgl6?res.detail[t].tgl6:''}</td>`;
                                    content += `<td class="p-2 tgl7">${res.detail[t].tgl7?res.detail[t].tgl7:''}</td>`;
                                    content += `<td class="p-2 tgl8">${res.detail[t].tgl8?res.detail[t].tgl8:''}</td>`;
                                    content += `<td class="p-2 tgl9">${res.detail[t].tgl9?res.detail[t].tgl9:''}</td>`;
                                    content += `<td class="p-2 tgl10">${res.detail[t].tgl10?res.detail[t].tgl10:''}</td>`;
                                    content += `<td class="p-2 tgl11">${res.detail[t].tgl11?res.detail[t].tgl11:''}</td>`;
                                    content += `<td class="p-2 tgl12">${res.detail[t].tgl12?res.detail[t].tgl12:''}</td>`;
                                    content += `<td class="p-2 tgl13">${res.detail[t].tgl13?res.detail[t].tgl13:''}</td>`;
                                    content += `<td class="p-2 tgl14">${res.detail[t].tgl14?res.detail[t].tgl14:''}</td>`;
                                    content += `<td class="p-2 tgl15">${res.detail[t].tgl15?res.detail[t].tgl15:''}</td>`;
                                    content += `<td class="p-2 tgl16">${res.detail[t].tgl16?res.detail[t].tgl16:''}</td>`;
                                    content += `<td class="p-2 tgl17">${res.detail[t].tgl17?res.detail[t].tgl17:''}</td>`;
                                    content += `<td class="p-2 tgl18">${res.detail[t].tgl18?res.detail[t].tgl18:''}</td>`;
                                    content += `<td class="p-2 tgl19">${res.detail[t].tgl19?res.detail[t].tgl19:''}</td>`;
                                    content += `<td class="p-2 tgl20">${res.detail[t].tgl20?res.detail[t].tgl20:''}</td>`;
                                    content += `<td class="p-2 tgl21">${res.detail[t].tgl21?res.detail[t].tgl21:''}</td>`;
                                    content += `<td class="p-2 tgl22">${res.detail[t].tgl22?res.detail[t].tgl22:''}</td>`;
                                    content += `<td class="p-2 tgl23">${res.detail[t].tgl23?res.detail[t].tgl23:''}</td>`;
                                    content += `<td class="p-2 tgl24">${res.detail[t].tgl24?res.detail[t].tgl24:''}</td>`;
                                    content += `<td class="p-2 tgl25">${res.detail[t].tgl25?res.detail[t].tgl25:''}</td>`;
                                    content += `<td class="p-2 tgl26">${res.detail[t].tgl26?res.detail[t].tgl26:''}</td>`;
                                    if (res.totalDay >= 27) {
                                        content += `<td class="p-2 tgl27">${res.detail[t].tgl27?res.detail[t].tgl27:''}</td>`;
                                        if (res.totalDay >= 28) {
                                            content += `<td class="p-2 tgl28">${res.detail[t].tgl28?res.detail[t].tgl28:''}</td>`;
                                            if (res.totalDay >= 29) {
                                                content += `<td class="p-2 tgl29">${res.detail[t].tgl29?res.detail[t].tgl29:''}</td>`;
                                                if (res.totalDay >= 30) {
                                                    content += `<td class="p-2 tgl30">${res.detail[t].tgl30?res.detail[t].tgl30:''}</td>`;
                                                    if (res.totalDay >= 31) {
                                                        content += `<td class="p-2 tgl31">${res.detail[t].tgl31?res.detail[t].tgl31:''}</td>`;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                content += `</tr>`;
                            }
                        content += `</tbody></table></div></div>`;

                        // KETERANGAN
                        content += `<div class="col-md-6"><div class="p-10">
                                        <h5>Shift Jaga :</h5>
                                        <div class="list-group">
                                            <label class="list-group-item border-0 p-2">
                                                <ul>`;
                                    res.shift.forEach(item => {
                                        content += `<li><b class="me-1">${item.singkat}</b>(<u>${item.shift}</u>) : ${item.berangkat.substring(0,5)} - ${item.pulang.substring(0,5)} WIB</li>`;
                                    });
                                        content += `<li><b class="me-1 text-success">DL</b>(<u class="text-success">DINAS LUAR</u>)</li>
                                                    <li><b class="me-1 text-danger">L</b>(<u class="text-danger">LIBUR</u>)</li>
                                                    <li><b class="me-1 text-danger">C</b>(<u class="text-danger">CUTI TAHUNAN</u>)</li>
                                                    <li><b class="me-1 text-danger">CM</b>(<u class="text-danger">CUTI MELAHIRKAN</u>)</li>
                                                    <li><b class="me-1 text-danger">CU</b>(<u class="text-danger">CUTI UMROH</u>)</li>
                                                    <li><b class="me-1 text-danger">CH</b>(<u class="text-danger">CUTI HAJI</u>)</li>
                                                    <li><b class="me-1 text-danger">CD</b>(<u class="text-danger">CUTI DILUAR TANGGUNGAN</u>)</li>
                                                </ul>
                                            </label>
                                        </div>
                                    </div></div>`;
                        content += `<div class="col-md-6"><div class="p-10">
                                        <h5>Keterangan :</h5>
                                        <div class="list-group">
                                            <label class="list-group-item border-0 p-2">
                                                <a class="btn btn-light me-2" style="background-color: #fed8b9" href="javascript:void(0);"></a>
                                                Hari Minggu
                                            </label>
                                        </div>
                                    </div></div></div>`;
                        $('#tampil-jadwal').empty().append(content);
                        for (let i = 0; i < res.totalDay; i++) {
                            if (res.dataArray[i] == 'Minggu') {
                                $('.tgl'+(i+1)).css('background-color','#fed8b9');
                                // console.log(i+1);
                            }
                        }
                        $('#btn-refresh-lihat').attr('onClick', 'lihat('+id+');');
                        $('#modalLihat').modal('show');
                    }
                }
            })
        }

        // VERIFIKASI
        function verif(id) {
            $("#id_verif").val(id);
            var inputs = document.getElementById('setujuverif');
            inputs.checked = false;
            $('#modalVerif').modal('show');
        }
        function batalVerif(id) {
            $("#id_batal_verif").val(id);
            var inputs = document.getElementById('setujubatalverif');
            inputs.checked = false;
            $('#modalBatalVerif').modal('show');
        }

        function prosesVerif() {
            // SWITCH BTN
            var checkbox = $('#setujuverif').is(":checked");
            if (checkbox == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan verifikasi jadwal dinas tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES
                var id = $("#id_verif").val();
                $.ajax({
                    url: "/api/kepegawaian/jadwaldinas/bawahan/"+id+"/verif/{{ Auth::user()->id }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Jadwal Dinas telah berhasil diverifikasi pada '+res,
                            position: 'topRight'
                        });
                        $('#modalVerif').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Jadwal Dinas gagal diverifikasi',
                            position: 'topRight'
                        });
                    }
                });
            }
        }
        function prosesBatalVerif() {
            // SWITCH BTN
            var checkbox = $('#setujubatalverif').is(":checked");
            if (checkbox == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan pembatalan verifikasi jadwal dinas tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES
                var id = $("#id_batal_verif").val();
                $.ajax({
                    url: "/api/kepegawaian/jadwaldinas/bawahan/"+id+"/batalverif/{{ Auth::user()->id }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Jadwal Dinas telah berhasil dibatalkan verifikasi pada '+res,
                            position: 'topRight'
                        });
                        $('#modalBatalVerif').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Jadwal Dinas gagal batal verifikasi',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        // PENOLAKAN
        function tolak(id) {
            $("#id_tolak").val(id);
            var inputs = document.getElementById('setujutolak');
            inputs.checked = false;
            $('#modalTolak').modal('show');
        }
        function batalTolak(id) {
            $("#id_batal_tolak").val(id);
            var inputs = document.getElementById('setujubataltolak');
            inputs.checked = false;
            $('#modalBatalTolak').modal('show');
        }

        function prosesTolak() {
            // SWITCH BTN
            var checkbox = $('#setujutolak').is(":checked");
            if (checkbox == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan penolakan jadwal dinas tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES
                var id = $("#id_tolak").val();
                $.ajax({
                    url: "/api/kepegawaian/jadwaldinas/bawahan/"+id+"/tolak/{{ Auth::user()->id }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Jadwal Dinas telah berhasil ditolak pada '+res,
                            position: 'topRight'
                        });
                        $('#modalTolak').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Jadwal Dinas gagal ditolak',
                            position: 'topRight'
                        });
                    }
                });
            }
        }
        function prosesBatalTolak() {
            // SWITCH BTN
            var checkbox = $('#setujubataltolak').is(":checked");
            if (checkbox == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan pembatalan penolakan jadwal dinas tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES
                var id = $("#id_batal_tolak").val();
                $.ajax({
                    url: "/api/kepegawaian/jadwaldinas/bawahan/"+id+"/bataltolak/{{ Auth::user()->id }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Jadwal Dinas telah berhasil dibatal tolak pada '+res,
                            position: 'topRight'
                        });
                        $('#modalBatalTolak').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Jadwal Dinas gagal dibatal tolak',
                            position: 'topRight'
                        });
                    }
                });
            }
        }
    </script>
@endsection
