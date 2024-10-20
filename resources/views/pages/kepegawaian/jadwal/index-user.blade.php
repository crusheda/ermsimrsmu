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
                                <a class="dropdown-item" href="javascript:void(0);" onclick="">Referensi Staf</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="">Referensi Jaga Shift</a>
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
                                    <th>WAKTU</th>
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
                                    <th>WAKTU</th>
                                    <th>STAF</th>
                                    <th>KETERANGAN</th>
                                    <th>STATUS</th>
                                    <th>DIPERBARUI</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer">

                </div>
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
                            <i class="ti ti-arrow-narrow-right me-1"></i> Batas ukuran file upload maksimal <b class="text-danger">2 mb</b>
                        </small>
                    </div>
                    <div class="position-relative">
                        <label class="form-label">Pilih Bulan dan Tahun</label>
                        <input type="month" class="form-control" value="" placeholder="" id="tgl" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button class="btn btn-primary" id="btn-tambah" onclick="prosesTambah()"><i class="fa-fw fas fa-chevron-right nav-icon"></i> Lanjutkan</button>
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

        function prosesTambah() {
            $("#btn-tambah").prop('disabled', true);
            $("#btn-tambah").find("i").toggleClass("fa-chevron-right fa-sync fa-spin");

            // Definisi
            var save = new FormData();
            save.append('tgl',$('#tgl').val());
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
                        var updet = new Date(item.updated_at).toLocaleDateString("sv-SE");
                        var date = new Date().toLocaleDateString("sv-SE");
                        var bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        content += `<td><center><div class='btn-group'>
                                        <button type='button' class='btn btn-sm btn-link text-secondary dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</button>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                                        if (updet == date) {
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-primary" onclick="lihat(${item.id})"><i class="fa-fw fas fa-calendar-alt me-2"></i> Lihat</a></li>`;
                                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(${item.id})"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                        } else {
                                            content += `<li><a href="javascript:void(0);" class="dropdown-item text-secondary"><i class="fa-fw fas fa-calendar-alt me-2"></i> Lihat</a></li>`;
                                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-secondary'><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                        }
                        content += "</div></center></td>";
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
                                    var status = `<span class="badge rounded-pill text-bg-success">Selesai</span>`;
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
    </script>
@endsection
