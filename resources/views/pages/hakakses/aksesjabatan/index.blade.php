@extends('layouts.default')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Hak Akses - Akses Jabatan</h4>
            </div>
        </div>
    </div>

    <div class="card card-body text-nowrap">
        <h4 class="card-title">
            <div class="d-flex">
                <div class="btn-group">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formSync"><i
                            class="bx bxs-magnet"></i>&nbsp;&nbsp;Sinkronisasi <kbd>Jabatan x Akses</kbd></button>
                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#info"><i
                            class="bx bxs-info-circle"></i>&nbsp;&nbsp;Informasi</button>
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="<i class='fa-fw fas fa-sync nav-icon'></i> <span>Segarkan</span>" onclick="refresh()">
                        <i class="fa-fw fas fa-sync nav-icon"></i>&nbsp;&nbsp;Segarkan</button>
                </div>
                <div class="hstack gap-3 ms-auto">
                    <div class="btn-group">
                        <button class="btn btn-info" onclick="showAkses()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="Tambah Akses"><i class="bx bx-key"></i></button>
                        <button class="btn btn-outline-warning" onclick="showDaftarAkses()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="Lihat Daftar Akses"><i class="bx bx-spreadsheet"></i></button>
                    </div>
                    <div class="vr"></div>
                    <div class="btn-group">
                        <button class="btn btn-info" onclick="showJabatan()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="Tambah Jabatan"><i class="bx bxs-traffic-barrier"></i></button>
                        <button class="btn btn-outline-warning" onclick="showDaftarJabatan()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="Lihat Daftar Jabatan"><i class="bx bx-detail"></i></button>
                    </div>
                </div>
            </div>
        </h4>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-body table-responsive text-nowrap">
                <table id="dttable" class="table dt-responsive table-hover nowrap w-100">
                    <thead>
                        <tr>
                            <th class="cell-fit">JABATAN</th>
                            <th class="cell-fit">AKSES</th>
                            <th class="cell-fit"><center>#</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($list['show']) > 0)
                            @foreach ($list['show'] as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if (count($list['selection']) > 0)
                                            @foreach ($list['selection'] as $val)
                                                @if ($val->id_role == $item->role_id)
                                                    <kbd>{{ $val->name_permission }}</kbd>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <center>
                                            <button class='btn btn-danger btn-sm'
                                            onclick="hapus({{ $item->role_id }})"><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="cell-fit">JABATAN</th>
                            <th class="cell-fit">AKSES</th>
                            <th class="cell-fit"><center>#</center></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    {{-- TAMBAH AKSES --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="formTambahAkses" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <form id="tambah" action="{{ route('akses.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                    <h4 class="modal-title">
                        Tambah Akses
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <label for="">Akses</label>
                        <input type="text" name="akses" class="form-control" placeholder="Masukkan nama akses">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btn-simpan" onclick="tambah()"><i class="fa-fw fas fa-save nav-icon"></i> Tambah</button>
                        {{-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- TAMBAH JABATAN --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="formTambahJabatan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <form id="tambah" action="{{ route('jabatan.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                    <h4 class="modal-title">
                        Tambah Jabatan
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <label for="">Jabatan</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama jabatan" required>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btn-simpan" onclick="tambah()"><i class="fa-fw fas fa-save nav-icon"></i> Tambah</button>
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- TAMBAH SYNC AKSES --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="formSync" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <form id="sync" action="{{ route('aksesjabatan.store') }}" method="post">
                    @csrf
                    <div class="modal-header">
                    <h4 class="modal-title">
                        Hubungkan Jabatan dengan Akses
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="">Jabatan</label>
                            <select class="select2 form-control" name="role" style="width: 100%" required>
                                <option value="">Pilih</option>
                                @if (count($list['role']) > 0)
                                    @foreach ($list['role'] as $key => $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Akses</label>
                            <select name="akses[]" class="select2 form-control"
                                data-bs-auto-close="outside" required multiple="multiple" style="width: 100%">
                                @if (count($list['role']) > 0)
                                    @foreach ($list['role'] as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" id="btn-simpan" onclick="tambah()"><i class="fa-fw fas fa-save nav-icon"></i> Tambah</button>
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- DAFTAR AKSES --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="daftarAkses" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Daftar Akses
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive text-nowrap" style="border: 0px">
                        <table id="dttable-akses" class="table dt-responsive table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="cell-fit">ID</th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">UPDATE</th>
                                    <th class="cell-fit"><center>#</center></th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-akses">
                                <tr>
                                    <td colspan="9">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit">ID</th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">UPDATE</th>
                                    <th class="cell-fit"><center>#</center></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" onclick="showAkses()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                    title="Tambah Akses"><i class="bx bxs-plus-square"></i>&nbsp;&nbsp;Tambah Akses</button>
                </div>
            </div>
        </div>
    </div>
    {{-- DAFTAR JABATAN --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="daftarJabatan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Daftar Jabatan
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive text-nowrap" style="border: 0px">
                        <table id="dttable-jabatan" class="table dt-responsive table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="cell-fit">ID</th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">UPDATE</th>
                                    <th class="cell-fit"><center>#</center></th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-jabatan">
                                <tr>
                                    <td colspan="9">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit">ID</th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">UPDATE</th>
                                    <th class="cell-fit"><center>#</center></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" onclick="showJabatan()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                    title="Tambah Jabatan"><i class="bx bxs-plus-square"></i>&nbsp;&nbsp;Tambah Jabatan</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            var table = $('#dttable').DataTable({
                order: [
                    [0, "asc"]
                ],
                displayLength: 7,
                lengthChange: true,
                lengthMenu: [7, 10, 25, 50, 75, 100],
                buttons: ['copy', 'excel', 'pdf', 'colvis']
            });

            table.buttons().container()
                .appendTo('#dttable_wrapper .col-md-6:eq(0)');

            $(".select2").select2({
                placeholder: "",
                allowClear: true
            }).val('').trigger('change');
        })

        function tambah() {
            $("#tambah").one('submit', function() {
                $("#btn-simpan").attr('disabled', 'disabled');
                $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
                return true;
            });
        }

        // MODAL OPEN
        function showAkses() {
            $('.modal').modal('hide');
            $('#formTambahAkses').modal('show');
        }
        function showJabatan() {
            $('.modal').modal('hide');
            $('#formTambahJabatan').modal('show');
        }
        function showDaftarAkses() {
            $('#daftarAkses').modal('show');
            $.ajax(
                {
                    url: "/api/hakakses/akses/data",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#tampil-tbody-akses").empty();
                        $('#dttable-akses').DataTable().clear().destroy();
                        res.show.forEach(item => {
                            content = `
                                <tr>
                                    <td>`+item.id+`</td>
                                    <td>`+item.name+`</td>
                                    <td>`+item.updated_at.substring(0, 19).replace('T',' ')+`</td>
                                    <td><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapusAkses(`+item.id+`)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></td>
                                </tr>
                            `;
                            $('#tampil-tbody-akses').append(content);
                        })
                        var table = $('#dttable-akses').DataTable({
                            order: [
                                [2, "asc"]
                            ],
                            displayLength: 7,
                            lengthChange: true,
                            lengthMenu: [7, 10, 25, 50, 75, 100],
                            buttons: ['copy', 'excel', 'pdf', 'colvis']
                        });

                        table.buttons().container()
                            .appendTo('#dttable-akses_wrapper .col-md-6:eq(0)');
                    }
                }
            )
        }
        function showDaftarJabatan() {
            $('#daftarJabatan').modal('show');
            $.ajax(
                {
                    url: "/api/hakakses/jabatan/data",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#tampil-tbody-jabatan").empty();
                        $('#dttable-jabatan').DataTable().clear().destroy();
                        res.show.forEach(item => {
                            content = `
                                <tr>
                                    <td>`+item.id+`</td>
                                    <td>`+item.name+`</td>
                                    <td>`+item.updated_at.substring(0, 19).replace('T',' ')+`</td>
                                    <td><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapusJabatan(`+item.id+`)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></td>
                                </tr>
                            `;
                            $('#tampil-tbody-jabatan').append(content);
                        })
                        var table = $('#dttable-jabatan').DataTable({
                            order: [
                                [2, "asc"]
                            ],
                            displayLength: 7,
                            lengthChange: true,
                            lengthMenu: [7, 10, 25, 50, 75, 100],
                            buttons: ['copy', 'excel', 'pdf', 'colvis']
                        });

                        table.buttons().container()
                            .appendTo('#dttable-jabatan_wrapper .col-md-6:eq(0)');
                    }
                }
            )
        }

        // HAPUS AKSES JABATAN
        function hapusAksesJabatan(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Hapus Permanen Akses Jabatan ID : ' + id,
                icon: 'warning',
                reverseButtons: false,
                showDenyButton: false,
                showCloseButton: false,
                showCancelButton: true,
                focusCancel: true,
                confirmButtonColor: '#FF4845',
                confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
                cancelButtonText: `<i class="fa fa-times"></i>  Batal`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/api/hakakses/aksesjabatan/hapus/" + id,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Hapus Akses Jabatan berhasil pada ' + res,
                                position: 'topRight'
                            });
                            window.location.reload();
                        },
                        error: function(res) {
                            Swal.fire({
                                title: `Gagal di hapus!`,
                                text: 'Pada ' + res,
                                icon: `error`,
                                showConfirmButton: false,
                                showCancelButton: false,
                                allowOutsideClick: true,
                                allowEscapeKey: true,
                                timer: 3000,
                                timerProgressBar: true,
                                backdrop: `rgba(26,27,41,0.8)`,
                            });
                        }
                    });
                }
            })
        }

        // HAPUS AKSES
        function hapusAkses(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Hapus Permanen Akses ID : ' + id,
                icon: 'warning',
                reverseButtons: false,
                showDenyButton: false,
                showCloseButton: false,
                showCancelButton: true,
                focusCancel: true,
                confirmButtonColor: '#FF4845',
                confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
                cancelButtonText: `<i class="fa fa-times"></i>  Batal`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/api/hakakses/akses/hapus/" + id,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Hapus Akses berhasil pada ' + res,
                                position: 'topRight'
                            });
                            window.location.reload();
                        },
                        error: function(res) {
                            Swal.fire({
                                title: `Gagal di hapus!`,
                                text: 'Pada ' + res,
                                icon: `error`,
                                showConfirmButton: false,
                                showCancelButton: false,
                                allowOutsideClick: true,
                                allowEscapeKey: true,
                                timer: 3000,
                                timerProgressBar: true,
                                backdrop: `rgba(26,27,41,0.8)`,
                            });
                        }
                    });
                }
            })
        }

        // HAPUS JABATAN
        function hapusJabatan(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Hapus Permanen Jabatan ID : ' + id,
                icon: 'warning',
                reverseButtons: false,
                showDenyButton: false,
                showCloseButton: false,
                showCancelButton: true,
                focusCancel: true,
                confirmButtonColor: '#FF4845',
                confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
                cancelButtonText: `<i class="fa fa-times"></i>  Batal`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/api/hakakses/jabatan/hapus/" + id,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Hapus Jabatan berhasil pada ' + res,
                                position: 'topRight'
                            });
                            window.location.reload();
                        },
                        error: function(res) {
                            Swal.fire({
                                title: `Gagal di hapus!`,
                                text: 'Pada ' + res,
                                icon: `error`,
                                showConfirmButton: false,
                                showCancelButton: false,
                                allowOutsideClick: true,
                                allowEscapeKey: true,
                                timer: 3000,
                                timerProgressBar: true,
                                backdrop: `rgba(26,27,41,0.8)`,
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection
