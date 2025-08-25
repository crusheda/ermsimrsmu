@extends('layouts.index')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Kepegawaian</li>
                        <li class="breadcrumb-item" aria-current="page">Perizinan Perangkat</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Perangkat Absensi Karyawan</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        <div class="col-xl-12" id="table-perangkat">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between px-3">
                    <h5 class="mb-0 ms-3"><b style="font-size: 1rem">Tabel <a class="text-primary">Perangkat</a></b></h5>
                    <div class="btn-group">
                        <a href="javascript:void(0);" class="btn btn-link-warning" onclick="refresh()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Segarkan Tabel"><i class="ti ti-refresh f-20 me-2"></i> Refresh Tabel Perangkat</a>
                    </div>
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

    <script>
        $(document).ready(function() {
            refresh();
        });

        function refresh() {
            $("#tampil-thead").empty().append(`
                <tr>
                    <th><center>AKSI</center></th>
                    <th>PENGGUNA APLIKASI</th>
                    <th>PERANGKAT</th>
                    <th>PLATFORM</th>
                    <th>STATUS LOGIN USER</th>
                    <th>STATUS IZIN DEVICE</th>
                    <th>DITETAPKAN</th>
                    <th>TERAKHIR LOGIN</th>
                </tr>
            `);
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="20"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/kepegawaian/absensi/perangkat/table",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleDateString("sv-SE");
                        var userID = "{{ Auth::user()->id }}";
                        var adminID = "{{ Auth::user()->getPermission(['admin_kepegawaian']) }}";
                        var superID = "{{ Auth::user()->getPermission('admin_kepegawaian_kepala') }}";
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        content += `<td><center>`;
                                    if (superID == true || adminID == true) {
                                        if (item.accepted) {
                                            content += `<buttoon class="btn btn-light-danger btn-icon me-2" onclick="nonaktif(${item.id})" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Hapus Perizinan Device"><i class="fas fa-frown"></i></buttoon>`;
                                        } else {
                                            content += `<buttoon class="btn btn-success btn-icon me-2" onclick="aktif(${item.id})" data-bs-toggle="tooltip"
                                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tetapkan Perizinan Device"><i class="fas fa-smile-beam"></i></buttoon>`;
                                        }
                                    }
                                    // if (superID == true) {
                                        if (item.status) {
                                            content += `<buttoon class="btn btn-light-danger btn-icon" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="bottom" data-bs-html="true" title="Blokir Device"><i class="fas fa-lock"></i></buttoon>`;
                                        } else {
                                            content += `<buttoon class='btn btn-info btn-icon' data-bs-toggle="tooltip" data-bs-offset="0,4"
                                            data-bs-placement="bottom" data-bs-html="true" title="Buka Blokir Device"><i class="fas fa-lock-open"></i></buttoon>`;
                                        }
                                    // }
                        content += "</center></td>";
                        content += `<td>${item.nama_user}</td>`;
                        content += `<td>${item.nama_brand?item.nama_brand+' - ':''}${item.nama_android?item.nama_android:'Perangkat Tidak Diketahui'} ${item.nama_device?'(ID#'+item.nama_device+')':''}</td>`;
                        content += `<td>${item.platform} (Versi OS. ${item.os_version})</td>`;
                                    aktif = '';
                                    if (item.status) {
                                        if (item.is_active) {
                                            aktif = '<span class="badge text-bg-info">Sedang Aktif</span>';
                                        } else {
                                            aktif = '<span class="badge text-bg-warning">Tidak Aktif</span>';
                                        }
                                    } else {
                                        aktif = '<span class="badge text-bg-danger">-</span>';
                                    }
                        content += `<td>${aktif}</td>`;
                        content += `<td>${item.accepted?'<span class="badge text-bg-success">Telah Disetujui</span>':'<span class="badge text-bg-danger">Belum/Tidak Disetujui</span>'}</td>`;
                        content += `<td>${item.accepted_date?new Date(item.accepted_date).toLocaleDateString("sv-SE"):''}</td>`;
                        content += `<td>${item.last_login_at?new Date(item.last_login_at).toLocaleDateString("sv-SE"):''}</td>`;
                        // content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                        //                 <div class='d-flex justify-content-start align-items-center'>
                        //                     <div class='d-flex flex-column'>
                        //                         <a class='mb-0'>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</a>
                        //                         <small class='text-truncate text-muted'>` + item.nama_user + `</small>
                        //                     </div>
                        //                 </div>
                        //             </td>`;
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
                            [0, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '25%' },
                            { sWidth: '20%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                            { sWidth: '10%' },
                        ],
                        columnDefs: [
                            // { visible: false, targets: [7] },
                        ],
                        displayLength: 20,
                        lengthChange: true,
                        lengthMenu: [20, 35, 50, 75, 100, 200, 350, 500],
                        // buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });
                }
            })
        }
    </script>
@endsection
