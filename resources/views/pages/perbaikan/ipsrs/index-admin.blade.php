@extends('layouts.index')

@section('content')
    {{-- Sistem Tracking --}}
    <link href="{{ asset('css/tracking.css') }}" rel="stylesheet" />

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Pengaduan</li>
                        <li class="breadcrumb-item">Perbaikan</li>
                        <li class="breadcrumb-item" aria-current="page">IPSRS <span class="badge rounded-pill text-bg-primary ms-1">Admin</span></li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Perbaikan IPSRS</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        {{-- BARIS 1 --}}
        <div class="col-lg-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">{{ $list['total'] }}</h3>
                            <p class="text-muted mb-0">Total</p>
                        </div>
                        <div class="col-4 text-end"><i class="ti ti-license text-secondary f-36"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">{{ $list['totalmasukpengaduan'] }}</h3>
                            <p class="text-muted mb-0">Diverifikasi</p>
                        </div>
                        <div class="col-4 text-end"><i class="ti ti-checks f-36" style="color: rebeccapurple"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">{{ $list['totaldiverifikasi'] }}</h3>
                            <p class="text-muted mb-0">Diterima</p>
                        </div>
                        <div class="col-4 text-end"><i class="ti ti-phone-incoming f-36" style="color: salmon"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">{{ $list['totaldikerjakan'] }}</h3>
                            <p class="text-muted mb-0">Dikerjakan</p>
                        </div>
                        <div class="col-4 text-end"><i class="ti ti-clock f-36" style="color: orange"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">{{ $list['totalselesai'] }}</h3>
                            <p class="text-muted mb-0">Diselesaikan</p>
                        </div>
                        <div class="col-4 text-end"><i class="ti ti-clipboard-check f-36" style="color: turquoise"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">{{ $list['totalditolak'] }}</h3>
                            <p class="text-muted mb-0">Ditolak</p>
                        </div>
                        <div class="col-4 text-end"><i class="ti ti-file-shredder f-36" style="color: red"></i></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- BARIS 2 --}}
        <div class="col-lg-12">
            <div class="card table-card">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <h5 class="mb-0">Tabel Pengaduan</h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-light-warning" id="btn-refresh" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                title="Segarkan Tabel Pengaduan" onclick="refresh()">
                                <i class="fa-fw fas fa-sync nav-icon"></i></button>
                        <button type="button" class="btn btn-light-info" id="btn-refresh" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                title="Tampilkan 100 Data Terakhir" onclick="showHalf()">
                                <i class="fa-fw fas fa-history nav-icon"></i></button>
                        <button type="button" class="btn btn-light-danger" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Tampilkan Seluruh Data" onclick="showAll()">
                            <i class="fa-fw fas fa-infinity nav-icon"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dttable" class="table table-hover dt-responsive align-middle">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th><center>STATUS</center></th>
                                    <th>NAMA</th>
                                    <th>UNIT</th>
                                    <th>LOKASI</th>
                                    <th>TGL PENGADUAN</th>
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
                                    <th>#ID</th>
                                    <th><center>STATUS</center></th>
                                    <th>NAMA</th>
                                    <th>UNIT</th>
                                    <th>LOKASI</th>
                                    <th>TGL PENGADUAN</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalLampiran" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Lampiran Pengaduan
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="imgPush"></div>
                <div class="col-12 text-center mb-4">
                    <button type="reset" class="btn btn-link-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            refresh();
        });

        // FUNCTION
        function refresh() {
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="20" style="font-size: 13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/perbaikan/ipsrs/admin/table",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        if (item.unit) {
                            try {
                                var un = JSON.parse(item.unit);
                            } catch (e) {
                                var un = item.unit;
                            }
                        }
                        if (un !== null) {
                            un = un.toString().replaceAll(',', ', ').replaceAll('-', ' ');
                        } else {
                            un = '';
                        }
                        var status = '';
                        if (item.tgl_selesai != null && item.ket_penolakan == null) {
                            status = '<td><center><kbd style="background-color: turquoise">Selesai</kbd></center></td>';
                        } else {
                            if (item.ket_penolakan != null) {
                                status = '<td><center><kbd style="background-color: red">Ditolak</kbd></center></td>';
                            } else {
                                if (item.tgl_diterima == null) {
                                    status = '<td><center><kbd style="background-color: rebeccapurple">Diverifikasi</kbd></center></td>';
                                } else {
                                    if (item.tgl_dikerjakan == null) {
                                        status = '<td><center><kbd style="background-color: salmon">Diterima</kbd></center></td>';
                                    } else {
                                        if (item.tgl_selesai == null) {
                                            status = '<td><center><kbd style="background-color: orange">Dikerjakan</kbd></center></td>';
                                        } else {
                                            status = '<td><center><kbd style="background-color: dark">Tidak Ditemukan</kbd></center></td>';
                                        }
                                    }
                                }
                            }
                        }

                        content = `<tr><td><div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="javascript:;" class="btn btn-sm btn-link dropdown-toggle hide-arrow" data-bs-toggle="dropdown">${item.id}</a>
                                            <div class="dropdown-menu dropdown-menu-right">`;
                                                if (item.filename_pengaduan != null && item.filename_pengaduan != '') {
                                                    content += `<a href="javascript:;" onclick="showLampiran(${item.id})" class="dropdown-item text-info"><i class='fas fa-image me-2'></i> Lampiran</a>`;
                                                } else {
                                                    content += `<a href="javascript:;" class="dropdown-item text-secondary disabled" disabled><i class='fas fa-image me-2'></i> Lampiran</a>`;
                                                }
                                                content += `<a href="/perbaikan/ipsrs/detail/${item.id}" class="dropdown-item text-primary"><i class='fa fa-wrench me-2'></i> Lihat Pengaduan</a>`;
                        content += `</div></div></div></td>`;
                        // LANJUT CONTENT
                        content += status;
                        content += `<td>${item.nama?item.nama:'<s class="text-danger">Nama Tidak Valid</s>'}</td>`;
                        content += `<td>`+un+`</td>`;
                        content += `<td>${item.lokasi}</td>`;
                        content += `<td>`+new Date(item.tgl_pengaduan).toLocaleString("sv-SE")+`</td></tr>`;
                        $('#tampil-tbody').append(content);
                    })

                    var table = $('#dttable').DataTable({
                        // dom: 'Bfrtip',
                        order: [
                            [5, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '8%' },
                            { sWidth: '8%' },
                            { sWidth: '20%' },
                            { sWidth: '24%' },
                            { sWidth: '30%' },
                            { sWidth: '10%' },
                        ],
                        // columnDefs: [
                        //     { visible: false, targets: [7] },
                        // ],
                        displayLength: 10,
                        lengthChange: true,
                        lengthMenu: [10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });
                }
            })
        }

        function showLampiran(id) {
            $.ajax({
                url: "/api/perbaikan/ipsrs/admin/lampiran/"+id,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $('#imgPush').empty();
                    $('#imgPush').append(`<center><img src="/storage/`+res.filename_pengaduan.substring(7,1000)+`" class="img-fluid" alt=""></center>`);
                    $('#modalLampiran').modal('show');
                }
            })
        }
    </script>
@endsection
