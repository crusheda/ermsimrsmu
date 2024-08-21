@extends('layouts.index')

@section('content')

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Kepegawaian</li>
                        <li class="breadcrumb-item" aria-current="page">Profil Karyawan</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Profil Karyawan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <div class="btn-group shadow">
                        <button class="btn btn-primary" onclick="window.location.href='{{ route('akunpengguna.create') }}'" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tambah Akun Pengguna Baru">
                            <i class="fas fa-plus me-1"></i> Tambah Pengguna</button>
                        <button class="btn btn-warning" onclick="refresh()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Segarkan Tabel Profil Karyawan">
                            <i class="fas fa-sync"></i></button>
                        <button class="btn btn-info disabled" onclick="" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Menampilkan Seluruh Data Profil Karyawan">
                            <i class="fas fa-history me-1"></i> Tampilkan Semua</button>
                    </div>
                    <div class="btn-group">
                        <a href="javascript:void(0);" class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical f-18"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="showNonLengkap()">Profil Belum Lengkap</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="showNonAktif()">Karyawan Nonaktif</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="alert alert-secondary">
                        <small><i class="fa-fw fas fa-caret-right nav-icon me-1"></i> Refresh browser Anda apabila terjadi Error saat pengambilan data karyawan</small><br>
                        <small><i class="fa-fw fas fa-caret-right nav-icon me-1"></i> Klik pada <u class="text-primary"><b>#ID Karyawan</b></u> untuk melihat Profil</small>
                    </div>
                    <div class="table-responsive">
                        <table id="dttable" class="table align-middle dt-responsive table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="cell-fit"><center>#ID</center></th>
                                    <th class="cell-fit">AKUN</th>
                                    <th class="cell-fit">NAMA</th>
                                    <th class="cell-fit">UPDATE</th>
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
                                <th class="cell-fit"><center>#ID</center></th>
                                <th class="cell-fit">AKUN</th>
                                <th class="cell-fit">NAMA</th>
                                <th class="cell-fit">UPDATE</th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="table-responsive" hidden>
                        <table id="dttable-all" class="table align-middle dt-responsive table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="cell-fit">ID</th>
                                    <th>NIP</th>
                                    <th>NIK</th>
                                    <th>NAMA LENGKAP</th>
                                    <th>PANGGILAN</th>
                                    <th>TMPT/TGL LAHIR</th>
                                    <th>JENIS KELAMIN</th>
                                    <th>STATUS KAWIN</th>
                                    <th>EMAIL</th>
                                    <th>HP</th>
                                    <th>FB</th>
                                    <th>IG</th>
                                    <th>KELURAHAN (KTP)</th>
                                    <th>KECAMATAN (KTP)</th>
                                    <th>KABUPATEN (KTP)</th>
                                    <th>PROVINSI (KTP)</th>
                                    <th class="cell-fit">ALAMAT (KTP)</th>
                                    <th>KELURAHAN (DOM)</th>
                                    <th>KECAMATAN (DOM)</th>
                                    <th>KABUPATEN (DOM)</th>
                                    <th>PROVINSI (DOM)</th>
                                    <th class="cell-fit">ALAMAT (DOM)</th>
                                    <th>SD</th>
                                    <th>SMP</th>
                                    <th>SMA</th>
                                    <th>D1</th>
                                    <th>D2</th>
                                    <th>D3</th>
                                    <th>D4</th>
                                    <th>S1</th>
                                    <th>S2</th>
                                    <th>S3</th>
                                    <th class="cell-fit">PENGALAMAN KERJA</th>
                                    <th>RIWAYAT PENYAKIT</th>
                                    <th>RIWAYAT PENYAKIT KELUARGA</th>
                                    <th>RIWAYAT OPERASI</th>
                                    <th>RIWAYAT PENGGUNAAN OBAT</th>
                                    <th class="cell-fit">UPDATE</th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-all">
                                <tr>
                                    <td colspan="9" style="font-size:13px">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit">ID</th>
                                    <th>NIP</th>
                                    <th>NIK</th>
                                    <th>NAMA LENGKAP</th>
                                    <th>PANGGILAN</th>
                                    <th>TMPT/TGL LAHIR</th>
                                    <th>JENIS KELAMIN</th>
                                    <th>STATUS KAWIN</th>
                                    <th>EMAIL</th>
                                    <th>HP</th>
                                    <th>FB</th>
                                    <th>IG</th>
                                    <th>KELURAHAN (KTP)</th>
                                    <th>KECAMATAN (KTP)</th>
                                    <th>KABUPATEN (KTP)</th>
                                    <th>PROVINSI (KTP)</th>
                                    <th class="cell-fit">ALAMAT (KTP)</th>
                                    <th>KELURAHAN (DOM)</th>
                                    <th>KECAMATAN (DOM)</th>
                                    <th>KABUPATEN (DOM)</th>
                                    <th>PROVINSI (DOM)</th>
                                    <th class="cell-fit">ALAMAT (DOM)</th>
                                    <th>SD</th>
                                    <th>SMP</th>
                                    <th>SMA</th>
                                    <th>D1</th>
                                    <th>D2</th>
                                    <th>D3</th>
                                    <th>D4</th>
                                    <th>S1</th>
                                    <th>S2</th>
                                    <th>S3</th>
                                    <th class="cell-fit">PENGALAMAN KERJA</th>
                                    <th>RIWAYAT PENYAKIT</th>
                                    <th>RIWAYAT PENYAKIT KELUARGA</th>
                                    <th>RIWAYAT OPERASI</th>
                                    <th>RIWAYAT PENGGUNAAN OBAT</th>
                                    <th class="cell-fit">UPDATE</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- NONAKTIF --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="nonaktif" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Daftar Karyawan Nonaktif
                    </h4>
                    <button type="button" class="btn-close" onclick="closeModal()" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-1">
                    <div class="table-responsive text-nowrap table-card">
                        <table id="dttable-nonaktif" class="table dt-responsive table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="cell-fit"><center>ID</center></th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">NAMA LENGKAP</th>
                                    <th class="cell-fit">TGL NONAKTIF</th>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-nonaktif">
                                <tr>
                                    <td colspan="9" style="font-size:13px">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit"><center>ID</center></th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">NAMA LENGKAP</th>
                                    <th class="cell-fit">TGL NONAKTIF</th>
                                    <th class="cell-fit">
                                        <center>#</center>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-label-secondary" href="javascript:void(0);" data-bs-dismiss="modal"><i
                        class="fas fa-chevron-left"></i>&nbsp;&nbsp;Tutup</a>
                    <div class="btn-group">
                        <button class="btn btn-warning" onclick="refreshNonAktif()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Segarkan"><i
                                class='fa-fw fas fa-sync nav-icon'></i>&nbsp;&nbsp;Segarkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- TIDAK LENGKAP --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="nonlengkap" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Daftar Profil Karyawan Belum Lengkap
                    </h4>
                    <button type="button" class="btn-close" onclick="closeModal()" aria-label="Tutup"></button>
                </div>
                <div class="modal-body p-1">
                    <div class="table-responsive text-nowrap" style="border: 0px">
                        <table id="dttable-nonlengkap" class="table dt-responsive table-hover nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="cell-fit"><center>ID</center></th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">DITAMBAHKAN</th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody-nonlengkap">
                                <tr>
                                    <td colspan="9" style="font-size:13px">
                                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit"><center>ID</center></th>
                                    <th class="cell-fit">NAME</th>
                                    <th class="cell-fit">DITAMBAHKAN</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-label-secondary" href="javascript:void(0);" data-bs-dismiss="modal"><i
                        class="fas fa-chevron-left"></i>&nbsp;&nbsp;Tutup</a>
                    <div class="btn-group">
                        <button class="btn btn-warning" onclick="refreshNonLengkap()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Segarkan"><i
                                class='fa-fw fas fa-sync nav-icon'></i>&nbsp;&nbsp;Segarkan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            // TABEL PROFIL KARYAWAN INIT
            $.ajax({
                url: "/api/profilkaryawan/table",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    res.show.forEach(item => {
                        content = "<tr id='data" + item.id + "'>";
                        content += `<td><center><div class='btn-group'>
                                        <button type='button' class='btn btn-sm btn-link dropdown-toggle hide-arrow ${item.nik?'text-primary':'text-danger'}' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</button>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                            content += `<li><a href="javascript:void(0);" class='dropdown-item text-primary' onclick="lihatProfil(` + item.id + `)"><i class="fa-fw fas fa-search nav-icon me-1"></i> Lihat Profil</a></li>
                                        <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="nonaktif(` + item.id + `)"><i class="fa-fw fas fa-trash nav-icon me-1"></i> Nonaktif</a></li>`;
                        content += `</div></center></td>`;
                        content += `<td>${item.name}</td>`;
                        content += `<td>${item.nama?item.nama:'<b class="text-danger">Data Tidak Valid</b>'}</td>`;
                        content += '<td>' + new Date(item.updated_at).toLocaleString("sv-SE") + '</td>';
                        content += `</tr>`;
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [3, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '10%' },
                            { sWidth: '20%' },
                            { sWidth: '55%' },
                            { sWidth: '15%' },
                        ],
                        displayLength: 10,
                        lengthChange: true,
                        lengthMenu: [10, 25, 50, 75, 100],
                    });
                }
            });
        });

        // FUNCTION-FUNCTION
        function refresh() {
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="9" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/profilkaryawan/table",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = "<tr id='data" + item.id + "'>";
                        content += `<td><center><div class='btn-group'>
                                        <button type='button' class='btn btn-sm btn-link dropdown-toggle hide-arrow ${item.nik?'text-primary':'text-danger'}' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</button>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                            content += `<li><a href="javascript:void(0);" class='dropdown-item text-primary' onclick="lihatProfil(` + item.id + `)"><i class="fa-fw fas fa-search nav-icon me-1"></i> Lihat Profil</a></li>
                                        <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="nonaktif(` + item.id + `)"><i class="fa-fw fas fa-trash nav-icon me-1"></i> Nonaktif</a></li>`;
                        content += `</div></center></td>`;
                        content += `<td>${item.name}</td>`;
                        content += `<td>${item.nama?item.nama:'<b class="text-danger">Data Tidak Valid</b>'}</td>`;
                        content += '<td>' + new Date(item.updated_at).toLocaleString("sv-SE") + '</td>';
                        content += `</tr>`;
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [3, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '10%' },
                            { sWidth: '20%' },
                            { sWidth: '55%' },
                            { sWidth: '15%' },
                        ],
                        displayLength: 10,
                        lengthChange: true,
                        lengthMenu: [10, 25, 50, 75, 100],
                    });
                }
            });
        }

        function showNonAktif() {
            $('#nonaktif').modal('show');
            $.ajax({
                url: "/api/profilkaryawan/nonaktif",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-nonaktif").empty();
                    $('#dttable-nonaktif').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = `
                                <tr>
                                    <td><center>` + item.id + `</center></td>
                                    <td>` + item.name + `</td>
                                    <td>` + item.nama + `</td>
                                    <td>` + new Date(item.deleted_at).toLocaleString("sv-SE") +
                            `</td>
                                    <td><center><a href='javascript:void(0);' class='btn btn-sm btn-link-primary' onclick="batalNonAktif(` +
                            item.id + `)"><i class='fa-fw fas fa-user-check nav-icon'></i> Aktifkan</a></center></td>
                                </tr>
                            `;
                        $('#tampil-tbody-nonaktif').append(content);
                    })
                    var table = $('#dttable-nonaktif').DataTable({
                        order: [
                            [3, "desc"]
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }
            })
        }

        function showNonLengkap() {
            $('#nonlengkap').modal('show');
            $.ajax({
                url: "/api/profilkaryawan/nonlengkap",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-nonlengkap").empty();
                    $('#dttable-nonlengkap').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = `<tr>
                                    <td><center>` + item.id + `</center></td>
                                    <td>` + item.name + `</td>
                                    <td>` + new Date(item.created_at).toLocaleString("sv-SE") + `</td></tr>`;
                        $('#tampil-tbody-nonlengkap').append(content);
                    })
                    var table = $('#dttable-nonlengkap').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '15%' },
                            { sWidth: '60%' },
                            { sWidth: '25%' },
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }
            })
        }

        function refreshNonAktif() {
            $("#tampil-tbody-nonaktif").empty().append(
                `<tr><td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/profilkaryawan/nonaktif",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-nonaktif").empty();
                    $('#dttable-nonaktif').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = `
                                <tr>
                                    <td><center>` + item.id + `</center></td>
                                    <td>` + item.name + `</td>
                                    <td>` + item.nama + `</td>
                                    <td>` + new Date(item.deleted_at).toLocaleString("sv-SE") +
                            `</td>
                                    <td><center><a href='javascript:void(0);' class='btn btn-sm btn-link-primary' onclick="batalNonAktif(` +
                            item.id + `)"><i class='fa-fw fas fa-user-check nav-icon'></i> Aktifkan</a></center></td>
                                </tr>
                            `;
                        $('#tampil-tbody-nonaktif').append(content);
                    })
                    var table = $('#dttable-nonaktif').DataTable({
                        order: [
                            [3, "desc"]
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }
            })
        }

        function refreshNonLengkap() {
            $("#tampil-tbody-nonlengkap").empty().append(
                `<tr><td colspan="10" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/profilkaryawan/nonlengkap",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody-nonlengkap").empty();
                    $('#dttable-nonlengkap').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = `<tr>
                                    <td><center>` + item.id + `</center></td>
                                    <td>` + item.name + `</td>
                                    <td>` + new Date(item.created_at).toLocaleString("sv-SE") + `</td></tr>`;
                        $('#tampil-tbody-nonlengkap').append(content);
                    })
                    var table = $('#dttable-nonlengkap').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '15%' },
                            { sWidth: '60%' },
                            { sWidth: '25%' },
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }
            })
        }

        function batalNonAktif(id) {
            $.ajax({
                url: "/api/profilkaryawan/setaktif/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    iziToast.success({
                        title: 'Sukses!',
                        message: 'User ID : '+id+' sukses di Aktifkan kembali pada '+ res,
                        position: 'topRight'
                    });
                    refreshNonAktif();
                    window.location.reload();
                }
            })
        }
    </script>
@endsection
