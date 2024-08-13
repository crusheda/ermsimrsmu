@extends('layouts.index')

@section('content')

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Administrasi</li>
                        <li class="breadcrumb-item">Berkas</li>
                        <li class="breadcrumb-item">Laporan Rutin</li>
                        <li class="breadcrumb-item" aria-current="page">Verifikasi</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Verifikasi Laporan Rutin</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <button class="btn btn-link-secondary" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom"
                        data-bs-html="true" title="Kembali ke halaman sebelumnya" onclick="window.location='{{ route('bulanan.index') }}'">
                        <i class="fas fa-chevron-left mt-2"></i>&nbsp;
                        <span class="align-middle">Kembali</span>
                    </button>
                    <h5 class="mb-0">Tabel Verifikasi Laporan</h5>
                    <div class="btn-group">
                        <button class="btn btn-warning" id="refreshBtn" onclick="refresh()"><i class="fas fa-sync me-1"></i> Segarkan</button>
                        {{-- <button class="btn btn-outline-secondary" onclick="tutorial()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom"
                        data-bs-html="true" title="Lihat tutorial verifikasi dokumen" disabled><i class="far fa-question-circle"></i> Tutorial</button> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dttable" class="table dt-responsive table-hover nowrap w-100 align-middle">
                            <thead>
                                <tr>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                    <th>NAMA</th>
                                    <th>UNIT</th>
                                    <th>JUDUL</th>
                                    <th>BLN / THN</th>
                                    <th>KETERANGAN</th>
                                    <th>DIUPDATE</th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody">
                                <tr>
                                    <td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                    <th>NAMA</th>
                                    <th>UNIT</th>
                                    <th>JUDUL</th>
                                    <th>BLN / THN</th>
                                    <th>KETERANGAN</th>
                                    <th>DIUPDATE</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="verif" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Verifikasi Dokumen
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div id="show-action"></div>
                    <hr>
                    <div class="table-responsive text-nowrap">
                        <table id="dttable-verif" class="table dt-responsive table-hover table-bordered nowrap w-100 align-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>NAMA USER</th>
                                    <th>JABATAN</th>
                                    <th>UPDATE</th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-verif">
                                <tr>
                                    <td colspan="5"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>NAMA USER</th>
                                    <th>JABATAN</th>
                                    <th>UPDATE</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    dropdownParent: e.parent()
                })
            })

            $.ajax({
                url: "/api/laporan/bulanan/table/{{ Auth::user()->id }}/verif",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    var date = getDateTime();
                    res.show.forEach(item => {
                        if (item.unit) {
                            try {
                                var un = JSON.parse(item.unit);
                            } catch (e) {
                                var un = item.unit;
                            }
                        }
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        content = `<tr id="data` + item.id + `">`;
                        var colorBtn = 'info';
                        if (res.verif.length != 0) {
                            res.verif.forEach(valver => {
                                if (valver.lap_id == item.id) {
                                    colorBtn = 'warning'
                                }
                            });
                        }
                        content += `<td><center><div class="btn-group">
                                    <button class='btn btn-success btn-sm' onclick="window.location.href='{{ url('berkas/laporan/bulanan/`+item.id+`') }}'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Unduh Laporan"><i class="fa-fw fas fa-download nav-icon"></i></button>
                                    <button class='btn btn-`+colorBtn+` btn-sm' id="btnVerif`+item.id+`" onclick="showVerif(` + item.id + `)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Informasi Verifikasi Laporan"><i class="fa-fw fas fa-info-circle nav-icon"></i></button>`;

                        // if(item.tgl_verif != null) {
                        // } else {
                        //   content += `<button class='btn btn-secondary btn-sm' disabled><i class="fa-fw fas fa-check nav-icon"></i></a></li>`;
                        // };
                        content += `</div></center></td>
                        <td>` + item.nama + `</td>
                        <td>` + un + `</td>
                        <td>` + item.judul + `</td>
                        <td>` + item.bln + ` / ` + item.thn + `</td><td>`;
                        if (item.ket != null) {
                            content += item.ket;
                        }
                        content += `</td><td>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</td></tr>`;
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [6, "desc"]
                        ],
                        displayLength: 10,
                        lengthChange: true,
                        lengthMenu: [10, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger : 'hover'
                    })
                }
            });
        });

        // FUNCTION-FUNCTION
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

        function refresh() {
            $("#refreshBtn").prop('disabled', true);
            $("#refreshBtn").find("i").toggleClass("fa-sync fa-spinner fa-spin");
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/laporan/bulanan/table/{{ Auth::user()->id }}/verif",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    var date = getDateTime();
                    res.show.forEach(item => {
                        if (item.unit) {
                            try {
                                var un = JSON.parse(item.unit);
                            } catch (e) {
                                var un = item.unit;
                            }
                        }
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        content = `<tr id="data` + item.id + `">`;
                        var colorBtn = 'info';
                        if (res.verif.length != 0) {
                            res.verif.forEach(valver => {
                                if (valver.lap_id == item.id) {
                                    colorBtn = 'warning'
                                }
                            });
                        }
                        content += `<td><center><div class="btn-group">
                                    <button class='btn btn-success btn-sm' onclick="window.location.href='{{ url('berkas/laporan/bulanan/`+item.id+`') }}'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Unduh Laporan"><i class="fa-fw fas fa-download nav-icon"></i></button>
                                    <button class='btn btn-`+colorBtn+` btn-sm' id="btnVerif`+item.id+`" onclick="showVerif(` + item.id + `)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Informasi Verifikasi Laporan"><i class="fa-fw fas fa-info-circle nav-icon"></i></button>`;

                        // if(item.tgl_verif != null) {
                        // } else {
                        //   content += `<button class='btn btn-secondary btn-sm' disabled><i class="fa-fw fas fa-check nav-icon"></i></a></li>`;
                        // };
                        content += `</div></center></td>
                        <td>` + item.nama + `</td>
                        <td>` + un + `</td>
                        <td>` + item.judul + `</td>
                        <td>` + item.bln + ` / ` + item.thn + `</td><td>`;
                        if (item.ket != null) {
                            content += item.ket;
                        }
                        content += `</td><td>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</td></tr>`;
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [6, "desc"]
                        ],
                        displayLength: 10,
                        lengthChange: true,
                        lengthMenu: [10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger : 'hover'
                    })
                }
            });
            $("#refreshBtn").prop('disabled', false);
            $("#refreshBtn").find("i").removeClass("fa-spinner fa-spin").addClass("fa-sync");
        }

        function saveData() {
            $("#tambah").one('submit', function() {
                $("#btn-simpan").attr('disabled', 'disabled');
                $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
                return true;
            });
        }

        function showVerif(id) {
            $("#tampil-tbody-verif").empty();
            $("#btnVerif"+id).prop('disabled', true);
            $("#btnVerif"+id).find("i").toggleClass("fa-info-circle fa-spinner fa-spin");
            $.ajax({
                url: "/api/laporan/bulanan/table/verif/" + id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#show-action').empty();
                    $('#dttable-verif').DataTable().clear().destroy();
                    var verifBtn = false;
                    // TAMPIL TABEL VERIFIKASI
                    var date = getDateTime();
                    res.forEach(item => {
                        content =   `<tr id="data` + item.id + `">`;
                        if (item.user_id == '{{ Auth::user()->id }}') {
                            content += `<td><button class="btn btn-danger btn-sm" id="batalVerif`+item.id+`" onclick="batalVerif(` + item.id +`)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-html="true" title="Batal Verifikasi"><i class="fa-fw fas fa-times nav-icon"></i></button></td>`;
                        } else {
                            content += `<td><button class="btn btn-secondary btn-sm" disabled><i class="fa-fw fas fa-times nav-icon"></i></button></td>`;
                        }
                        content += `<td>` + item.queue + `</td>
                                        <td>` + item.user_name + `</td>
                                        <td style="white-space: normal;">` + item.role_name.toString().replaceAll('"', '').replace(',', ', ').replace('-', ' ').replace('[', '').replace(']', '') + `</td>
                                        <td>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</td>
                                    </tr>`;
                        $('#tampil-tbody-verif').append(content);
                        // VALIDASI SUDAH VERIF ATAU KAH BELUM
                        if (item.user_id == '{{ Auth::user()->id }}') {
                            verifBtn = true;
                        }
                    });
                    var tablev = $('#dttable-verif').DataTable({
                        order: [
                            [1, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '8%' },
                            { sWidth: '8%' },
                            { sWidth: '30%' },
                            { sWidth: '34%' },
                            { sWidth: '20%' },
                        ],
                        displayLength: 10,
                        lengthChange: true,
                        lengthMenu: [10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    // TAMPIL BUTTON VERIFIKASI
                    if (verifBtn == true) {
                        actionBtn = `<button type="button" class="btn btn-secondary waves-effect btn-label waves-light" style="margin-right: 8px" disabled><i class="fas fa-check label-icon me-1"></i> Verifikasi</button>`;
                    } else {
                        actionBtn = `<button type="button" class="btn btn-primary waves-effect btn-label waves-light" style="margin-right: 8px" id="verifUser(`+id+`)" onclick="verifUser(`+id+`)"><i class="fas fa-check label-icon me-1"></i> Verifikasi</button>`;
                    }
                    actionBtn += `<button type="button" class="btn btn-outline-secondary waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#tampil-catatan" disabled><i class="fas fa-sticky-note me-1"></i> Tambahkan Catatan</button>
                                <div class="collapse" id="tampil-catatan">
                                    <div class="form-group mb-2 mt-2">
                                        <textarea class="form-control" id="catatan(`+id+`)" placeholder="Tuliskan Catatan Laporan"></textarea>
                                    </div>
                                    <button class="btn btn-success" id="btn-simpan-catatan" onclick="saveCatatan(`+id+`)"><i
                                            class="fa-fw fas fa-save nav-icon"></i> Simpan Catatan</button>
                                </div>`;
                    $('#show-action').append(actionBtn);
                    $('#verif').modal('show');
                    $("#btnVerif"+id).prop('disabled', false);
                    $("#btnVerif"+id).find("i").removeClass("fa-spinner fa-spin").addClass("fa-info-circle");
                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger : 'hover'
                    })
                }
            })
        }

        // Proses Verifikasi Laporan oleh User
        function verifUser(id) {
            $("#verifUser"+id).prop('disabled', true);
            $("#verifUser"+id).find("i").toggleClass("fa-check fa-spinner fa-spin");
            $.ajax({
                url: "/api/laporan/bulanan/table/verif/" + id + "/user/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#verif').modal('hide');
                    iziToast.success({
                        title: 'Sukses!',
                        message: 'Verifikasi dokumen laporan berhasil oleh ' + res.user_name,
                        position: 'topRight'
                    });
                    refresh();
                }
            })
            $("#verifUser"+id).prop('disabled', false);
            $("#verifUser"+id).find("i").removeClass("fa-spinner fa-spin").addClass("fa-check");
        }

        // Hapus Verifikasi oleh User
        function batalVerif(id) {
            $("#batalVerif"+id).prop('disabled', true);
            $("#batalVerif"+id).find("i").toggleClass("fa-times fa-spinner fa-spin");
            $.ajax({
                url: "/api/laporan/bulanan/table/verif/" + id + "/batal",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#verif').modal('hide');
                    iziToast.success({
                        title: 'Sukses!',
                        message: 'Batal Verifikasi dokumen laporan '+res+' berhasil',
                        position: 'topRight'
                    });
                    refresh();
                }
            })
            $("#batalVerif"+id).prop('disabled', false);
            $("#batalVerif"+id).find("i").removeClass("fa-spinner fa-spin").addClass("fa-times");
        }
    </script>
@endsection
