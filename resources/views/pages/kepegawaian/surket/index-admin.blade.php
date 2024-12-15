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
                        <li class="breadcrumb-item">Pengajuan</li>
                        <li class="breadcrumb-item" aria-current="page">Surat Keterangan</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Surat Keterangan</h2>
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
                    <h5 class="mb-0">Daftar Pengajuan</h5>
                    <div class="btn-group">
                        <a href="javascript:void(0);" class="avtar avtar-s btn-link-warning" onclick="showRiwayat()"><i class="ti ti-refresh f-20"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dttable" class="table table-hover dt-responsive align-middle">
                            <thead>
                                <tr>
                                    <th>
                                        <center>#ID</center>
                                    </th>
                                    <th>KATEGORI</th>
                                    <th>USER</th>
                                    <th><center>PROGRESS</center></th>
                                    <th>UPDATE</th>
                                    <th>VERIFIED</th>
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
                                    <th>
                                        <center>#ID</center>
                                    </th>
                                    <th>KATEGORI</th>
                                    <th>USER</th>
                                    <th><center>PROGRESS</center></th>
                                    <th>UPDATE</th>
                                    <th>VERIFIED</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL START --}}
    <div class="modal animate__animated animate__rubberBand fade" id="modalVerif" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Verifikasi Pengajuan
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_verif" hidden>
                    <p style="text-align: justify;">Anda akan melakukan verifikasi Pengajuan Surat Keterangan tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan proses.</p>
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
                    <button type="submit" id="btn-verif" class="btn btn-primary me-sm-3 me-1" onclick="prosesVerif()"><i class="fas fa-check me-1" style="font-size:13px"></i> Verifikasi</button>
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
                        Form Pembatalan Verifikasi Pengajuan
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_batal_verif" hidden>
                    <p style="text-align: justify;">Anda akan melakukan pembatalan verifikasi Pengajuan Surat Keterangan tersebut sehingga status akan berubah menjadi <kbd>PENGAJUAN</kbd>, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan proses.</p>
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
                    <button type="submit" id="btn-batal-verif" class="btn btn-warning me-sm-3 me-1" onclick="prosesBatalVerif()"><i class="fas fa-undo me-1" style="font-size:13px"></i> Batalkan Verifikasi</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalBatalTolak" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Pembatalan Penolakan Pengajuan
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_status" hidden>
                    <p style="text-align: justify;">Anda akan melakukan pembatalan penolakan Pengajuan Surat Keterangan tersebut sehingga status akan berubah menjadi <kbd>PENGAJUAN</kbd>, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan proses.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujustatus">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-status" class="btn btn-danger me-sm-3 me-1" onclick="prosesBatalTolak()"><i class="fas fa-flag-checkered me-1" style="font-size:13px"></i> Batalkan Penolakan</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalTolak" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Penolakan Pengajuan
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_tolak" hidden>
                    <p style="text-align: justify;">Anda akan melakukan penolakan Pengajuan Surat Keterangan tersebut status akan berubah menjadi <kbd>DITOLAK</kbd>, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penolakan.</p>
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
                    <button type="submit" id="btn-tolak" class="btn btn-danger me-sm-3 me-1" onclick="prosesTolak()"><i class="fas fa-minus-circle me-1" style="font-size:13px"></i> Tolak Pengajuan</button>
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

        function showRiwayat() {
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/kepegawaian/pengajuan/surket/table",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        var date = new Date().toLocaleString("sv-SE").substring(0, 10);
                        // PROGRESS
                        if (item.progress == 0) {
                            var status = `<span class="badge rounded-pill text-bg-primary">Pengajuan</span>`;
                        } else {
                            if (item.progress == 1) {
                                var status = `<span class="badge rounded-pill text-bg-success">Selesai</span>`;
                            } else {
                                var status = `<span class="badge rounded-pill text-bg-danger">Ditolak</span>`;
                            }
                        }
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        if (item.progress == 2) {
                            clrbtn = 'text-danger';
                        } else {
                            if (item.progress == 1) {
                                clrbtn = 'text-success';
                            } else {
                                if (item.progress == 0) {
                                    clrbtn = 'text-primary';
                                } else {
                                    clrbtn = 'text-secondary';
                                }
                            }
                        }
                        content += `<td><center><div class='btn-group'>`;
                            content += `<button type='button' class='btn btn-sm avtar avtar-s btn-link ${clrbtn} dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</button>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                                        content += `<li><a href='javascript:void(0);' class='dropdown-item text-info'><i class="fa-fw fas fa-check-square nav-icon me-1"></i>Download</a></li>`;
                                        if (item.progress == 2) {
                                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-secondary'><i class="fa-fw fas fa-check-square nav-icon me-1"></i>Verif</a></li>`;
                                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="batalTolak(` + item.id + `)"><i class="fa-fw fas fas fa-reply nav-icon me-1"></i>Batal Tolak</a></li>`;
                                        } else {
                                            if (item.progress == 1) {
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="batalVerif(` + item.id + `)"><i class="fa-fw fas fas fa-reply nav-icon me-1"></i>Batal Verif</a></li>`;
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item text-secondary'><i class="fa-fw fas fa-times-circle nav-icon me-1"></i>Tolak</a></li>`;
                                            } else {
                                                if (item.progress == 0) {
                                                    content += `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="verif(` + item.id + `)"><i class="fa-fw fas fa-check-square nav-icon me-1"></i>Verif</a></li>`;
                                                    content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="tolak(` + item.id + `)"><i class="fa-fw fas fa-times-circle nav-icon me-1"></i>Tolak</a></li>`;
                                                }
                                            }
                                        }
                            content += `</ul>`;
                        content += "</div></center></td>";
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>` + item.kategori + `</h6>
                                                <small class='text-truncate text-muted'>No. Surat ` + zeroPad(item.no_surat,100) + `</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>` + item.pegawai_nama + ` (` + item.pegawai_ttl + `)</h6>
                                                <small class='text-truncate text-muted'>` + item.pegawai_pendidikan + `</small>
                                                <small class='text-truncate text-muted'>` + item.pegawai_alamat + `</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += "<td><center>" + status + "</center></td><td>" + new Date(item.updated_at).toLocaleString("sv-SE") + "</td>";
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>${item.valid?'Telah Diverifikasi oleh <b class="text-primary">Kepegawaian</b>':'Belum Terverifikasi'}</h6>
                                                <small class='text-truncate text-muted'>${item.progress==2?'Ditolak':''} ${item.tgl_valid?'Pada '+item.tgl_valid:''}</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        // dom: 'Bfrtip',
                        order: [
                            [4, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '12%' },
                            { sWidth: '45%' },
                            { sWidth: '8%' },
                            { sWidth: '10%' },
                            { sWidth: '20%' },
                        ],
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

        function tolak(id) {
            $("#id_tolak").val(id);
            var inputs = document.getElementById('setujutolak');
            inputs.checked = false;
            $('#modalTolak').modal('show');
        }

        function prosesTolak() {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujutolak').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan penolakan pengajuan tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_tolak").val();
                $.ajax({
                    url: "/api/kepegawaian/pengajuan/surket/"+id+"/tolak",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Pengajuan Surat Keterangan Anda telah berhasil ditolak pada '+res,
                            position: 'topRight'
                        });
                        $('#modalTolak').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pengajuan Surat Keterangan Anda gagal ditolak',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function batalTolak(id) {
            $("#id_status").val(id);
            var inputs = document.getElementById('setujustatus');
            inputs.checked = false;
            $('#modalBatalTolak').modal('show');
        }

        function prosesBatalTolak(id) {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujustatus').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan pembatalan status penolakan pengajuan tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_status").val();
                $.ajax({
                    url: "/api/kepegawaian/pengajuan/surket/"+id+"/bataltolak",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Penolakan Pengajuan Surat Keterangan telah berhasil dibatalkan pada '+res,
                            position: 'topRight'
                        });
                        $('#modalBatalTolak').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pembatalan Penolakan Pengajuan Surat Keterangan gagal dilakukan',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function verif(id) {
            $("#id_verif").val(id);
            var inputs = document.getElementById('setujuverif');
            inputs.checked = false;
            $('#modalVerif').modal('show');
        }

        function prosesVerif(id) {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuverif').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan verifikasi pengajuan tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_verif").val();
                var user = "{{ Auth::user()->id }}";
                $.ajax({
                    url: "/api/kepegawaian/pengajuan/surket/"+id+"/verif/"+user,
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Pengajuan Surat Keterangan Anda telah berhasil diverifikasi pada '+res,
                            position: 'topRight'
                        });
                        $('#modalVerif').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pengajuan Surat Keterangan Anda gagal diverifikasi',
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function batalVerif(id) {
            $("#id_batal_verif").val(id);
            var inputs = document.getElementById('setujubatalverif');
            inputs.checked = false;
            $('#modalBatalVerif').modal('show');
        }

        function prosesBatalVerif(id) {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujubatalverif').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan pembatalan verifikasi pengajuan tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_batal_verif").val();
                $.ajax({
                    url: "/api/kepegawaian/pengajuan/surket/"+id+"/unverif",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Pengajuan Surat Keterangan Anda telah berhasil dibatalkan status verifikasi pada '+res,
                            position: 'topRight'
                        });
                        $('#modalBatalVerif').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pengajuan Surat Keterangan Anda gagal batal verifikasi',
                            position: 'topRight'
                        });
                    }
                });
            }
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

        function zeroPad(nr,base){ // 1 => 001 (1,100)
            var  len = (String(base).length - String(nr).length)+1;
            return len > 0? new Array(len).join('0')+nr : nr;
        }
    </script>
@endsection
