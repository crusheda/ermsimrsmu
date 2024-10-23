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
                        <li class="breadcrumb-item" aria-current="page">Jadwal Dinas</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Jadwal Dinas</h2>
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
                    <h5 class="mb-0">Tabel Riwayat</h5>
                    <div class="btn-group">
                        <a href="javascript:void(0);" class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical f-18"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="tambah()">Tambah Jadwal Dinas</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="showRiwayat()">Segarkan Tabel</a>
                                <div class="divider pb-1"></div>
                                <a class="dropdown-item" href="javascript:void(0);" onclick=""><s>Referensi Staf</s></a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick=""><s>Referensi Jaga Shift</s></a>
                            </li>
                        </ul>
                        {{-- <a href="javascript:void(0);" class="avtar avtar-s btn-light-primary" onclick="tambah()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tambah Ja"><i class="ti ti-refresh f-20"></i></a> --}}
                    </div>
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

    {{-- MODAL START --}}
    <div class="modal fade animate__animated animate__rubberBand" id="modalTambah" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Tambah
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-secondary mb-3">
                        <small>
                            {{-- <i class="ti ti-arrow-narrow-right me-1"></i> <br> --}}
                            <i class="ti ti-arrow-narrow-right me-1"></i> Isian bertanda (<a class="text-danger">*</a>) berarti wajib diisi<br>
                            <i class="ti ti-arrow-narrow-right me-1"></i> Jadwal Dinas akan berstatus <span class="badge rounded-pill text-bg-warning">Pending</span> setelah pengajuan ini, maka dari itu segera lengkapi data jadwal dinas <br>
                            <i class="ti ti-arrow-narrow-right me-1"></i> Pengajuan Jadwal Dinas yang telah di <b class="text-success">Verifikasi</b> / <b class="text-danger">Ditolak</b> tidak dapat di ubah / hapus di kemudian waktu
                        </small>
                    </div>
                    <div class="position-relative mb-3">
                        <label class="form-label">Pilih Bulan dan Tahun <a class="text-danger">*</a></label>
                        <input type="month" class="form-control" value="" placeholder="" id="tgl" />
                    </div>
                    <div class="position-relative">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" id="ket" cols="30" rows="2" placeholder="Optional"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button class="btn btn-primary" id="btn-tambah" onclick="prosesTambah()">Lanjutkan &nbsp;<i class="fa-fw fas fa-chevron-right nav-icon"></i></button>
                </div>
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
                    <p style="text-align: justify;">Anda akan menghapus Jadwal Dinas tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
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
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
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

        function tambah() {
            $('#modalTambah').modal('show');
        }

        function ubah(id) {
            $.ajax({
                url: "/api/kepegawaian/jadwaldinas/jadwal/"+id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    console.log(res.detail);
                    if(res.detail.length == 0) {
                        window.location.href = '/kepegawaian/jadwaldinas/tambah/'+res.jadwal.id;
                    } else {
                        window.location.href = '/kepegawaian/jadwaldinas/ubah/'+id;
                    }
                }
            })

        }

        function prosesTambah() {
            $("#btn-tambah").prop('disabled', true);
            $("#btn-tambah").find("i").toggleClass("fa-chevron-right fa-sync fa-spin");

            // Definisi
            var save = new FormData();
            save.append('tgl',$('#tgl').val());
            save.append('keterangan',$('#ket').val());
            save.append('pegawai','{{ Auth::user()->id }}');
            if (save.get('tgl') == "") {
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
                    url: "{{route('kepegawaian.jadwaldinas.storePengajuan')}}",
                    method: 'post',
                    data: save,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(res) {
                        if (res.code == 200) {
                            window.location.href = '/kepegawaian/jadwaldinas/tambah/'+res.message.id;
                        } else {
                            notifier.show(
                                "Pesan Galat!", res.message,
                                "warning", "{{ asset('images/notification/medium_priority-48.png') }}", 4e3
                            );
                        }
                    },
                    error: function (res) {
                        notifier.show(
                            res.statusText + " (Code " + res.status + ")", res.responseText,
                            "danger", "{{ asset('images/notification/high_priority-48.png') }}", 4e3
                        );
                    }
                });
            }

            $("#btn-tambah").find("i").removeClass("fa-sync fa-spin").addClass("fa-chevron-right");
            $("#btn-tambah").prop('disabled', false);
        }

        function showRiwayat() {
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/kepegawaian/jadwaldinas/table/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var userID = "{{ Auth::user()->id }}";
                        var updet = new Date(item.updated_at).toLocaleDateString("sv-SE");
                        var date = new Date().toLocaleDateString("sv-SE");
                        var bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        content += `<td><center><div class='btn-group'>
                                        <button type='button' class='btn btn-sm btn-link text-secondary dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</button>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                                        if (item.pegawai_id == userID) {
                                            if (item.progress == 1) {
                                                content += `<li><a href="javascript:void(0);" class="dropdown-item text-success" onclick="verif(${item.id})"><i class="fa-fw fas fa-check me-2"></i> Verif</a></li>`;
                                                content += `<li><a href="javascript:void(0);" class="dropdown-item text-warning" onclick="ubah(${item.id})"><i class="fa-fw fas fa-calendar-alt me-2"></i> Ubah</a></li>`;
                                                content += `<li><a href="javascript:void(0);" class="dropdown-item text-primary" onclick="lihat(${item.id})"><i class="fa-fw fas fa-list-ol me-2"></i> Lihat</a></li>`;
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(${item.id})"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                            } else {
                                                content += `<li><a href="javascript:void(0);" class="dropdown-item text-success" onclick="verif(${item.id})"><i class="fa-fw fas fa-check me-2"></i> Verif</a></li>`;
                                                content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fa-fw fas fa-calendar-alt me-2"></i> Ubah</a></li>`;
                                                content += `<li><a href="javascript:void(0);" class="dropdown-item text-primary" onclick="lihat(${item.id})"><i class="fa-fw fas fa-list-ol me-2"></i> Lihat</a></li>`;
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item text-secondary'><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                            }
                                        } else {
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fa-fw fas fa-check me-2"></i> Verif</a></li>`;
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fa-fw fas fa-calendar-alt me-2"></i> Ubah</a></li>`;
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fa-fw fas fa-list-ol me-2"></i> Lihat</a></li>`;
                                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-secondary'><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                        }
                        content += "</ul></div></center></td>";
                        for (let i = 1; i <= bulan.length; i++) {
                            if (i == item.bulan) {
                                content += `<td>${bulan[i]} ${item.tahun}</td>`;
                            }
                        }
                        var pegawai = null;
                        content += `<td><small><ul class='list-unstyled mt-2'>`;
                        // console.log(JSON.parse(item.pegawai_id));
                        res.users.forEach(us => {
                            JSON.parse(item.staf).forEach(val => {
                                if (val == us.id) {
                                    content += `${us.nama?us.nama:'<b class="text-danger">'+us.name+'</b>'}; `;
                                }
                            })
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
                                    var status = `<span class="badge rounded-pill text-bg-info">Tidak Valid</span>`;
                                }
                            }
                        }
                        content += `<td>${status}</td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0'>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</a>
                                                <small class='text-truncate text-muted'>Oleh ` + item.nama_pegawai + `</small>
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
                            "Pesan Galat!", "Data isian Jadwal Dinas tidak ditemukan, silakan melengkapi jadwal terlebih dahulu (Klik Ubah)",
                            "warning", "{{ asset('images/notification/medium_priority-48.png') }}", 4e3
                        );
                    } else {
                        $("#showUser").text(res.jadwal.nama_pegawai)
                        // INIT
                        var n = 1;
                        // PROCESS
                        content = ``;
                        content += `<h4 class="text-center mb-2">Jadwal Dinas Bulan <b class="text-primary">${res.bulan}</b> Tahun <b class="text-primary">${res.jadwal.tahun}</b></h4>`;
                        content += `<div class="table-responsive p-10 pb-0">
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
                                content += `<tr class="text-center">`;
                                    content += `<td>${n++}</td>`;
                                    content += `<td class="text-start">${res.detail[t].pegawai_nama}</td>`;
                                    content += `<td class="p-2 tgl1">${res.detail[t].tgl1}</td>`;
                                    content += `<td class="p-2 tgl2">${res.detail[t].tgl2}</td>`;
                                    content += `<td class="p-2 tgl3">${res.detail[t].tgl3}</td>`;
                                    content += `<td class="p-2 tgl4">${res.detail[t].tgl4}</td>`;
                                    content += `<td class="p-2 tgl5">${res.detail[t].tgl5}</td>`;
                                    content += `<td class="p-2 tgl6">${res.detail[t].tgl6}</td>`;
                                    content += `<td class="p-2 tgl7">${res.detail[t].tgl7}</td>`;
                                    content += `<td class="p-2 tgl8">${res.detail[t].tgl8}</td>`;
                                    content += `<td class="p-2 tgl9">${res.detail[t].tgl9}</td>`;
                                    content += `<td class="p-2 tgl10">${res.detail[t].tgl10}</td>`;
                                    content += `<td class="p-2 tgl11">${res.detail[t].tgl11}</td>`;
                                    content += `<td class="p-2 tgl12">${res.detail[t].tgl12}</td>`;
                                    content += `<td class="p-2 tgl13">${res.detail[t].tgl13}</td>`;
                                    content += `<td class="p-2 tgl14">${res.detail[t].tgl14}</td>`;
                                    content += `<td class="p-2 tgl15">${res.detail[t].tgl15}</td>`;
                                    content += `<td class="p-2 tgl16">${res.detail[t].tgl16}</td>`;
                                    content += `<td class="p-2 tgl17">${res.detail[t].tgl17}</td>`;
                                    content += `<td class="p-2 tgl18">${res.detail[t].tgl18}</td>`;
                                    content += `<td class="p-2 tgl19">${res.detail[t].tgl19}</td>`;
                                    content += `<td class="p-2 tgl20">${res.detail[t].tgl20}</td>`;
                                    content += `<td class="p-2 tgl21">${res.detail[t].tgl21}</td>`;
                                    content += `<td class="p-2 tgl22">${res.detail[t].tgl22}</td>`;
                                    content += `<td class="p-2 tgl23">${res.detail[t].tgl23}</td>`;
                                    content += `<td class="p-2 tgl24">${res.detail[t].tgl24}</td>`;
                                    content += `<td class="p-2 tgl25">${res.detail[t].tgl25}</td>`;
                                    content += `<td class="p-2 tgl26">${res.detail[t].tgl26}</td>`;
                                    if (res.totalDay >= 27) {
                                        content += `<td class="p-2 tgl27">${res.detail[t].tgl27}</td>`;
                                        if (res.totalDay >= 28) {
                                            content += `<td class="p-2 tgl28">${res.detail[t].tgl28}</td>`;
                                            if (res.totalDay >= 29) {
                                                content += `<td class="p-2 tgl29">${res.detail[t].tgl29}</td>`;
                                                if (res.totalDay >= 30) {
                                                    content += `<td class="p-2 tgl30">${res.detail[t].tgl30}</td>`;
                                                    if (res.totalDay >= 31) {
                                                        content += `<td class="p-2 tgl31">${res.detail[t].tgl31}</td>`;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                content += `</tr>`;
                            }
                        content += `</tbody></table></div>`;

                        // KETERANGAN
                        content += `<div class="p-10">
                                        <h5>Keterangan :</h5>
                                        <div class="list-group">
                                            <label class="list-group-item border-0 p-2">
                                                <a class="btn btn-light me-2" style="background-color: #fed8b9" href="javascript:void(0);"></a>
                                                Hari Minggu
                                            </label>
                                        </div>
                                    </div>`;
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

        function hapus(id) {
            $("#id_hapus").val(id);
            var inputs = document.getElementById('setujuhapus');
            inputs.checked = false;
            $('#modalHapus').modal('show');
        }

        function prosesHapus() {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuhapus').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan penghapusan jadwal dinas tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_hapus").val();
                $.ajax({
                    url: "/api/kepegawaian/jadwaldinas/"+id+"/hapus",
                    type: 'DELETE',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Jadwal Dinas Anda telah berhasil dihapus pada '+res,
                            position: 'topRight'
                        });
                        $('#modalHapus').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Jadwal Dinas Anda gagal dihapus',
                            position: 'topRight'
                        });
                    }
                });
            }
        }
    </script>
@endsection
