@extends('layouts.index')

@section('content')

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Kepegawaian</li>
                        <li class="breadcrumb-item">Pengajuan</li>
                        <li class="breadcrumb-item" aria-current="page">ID Card</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Pengajuan ID Card</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        <div class="">
            <div class="card table-card">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <h6 class="mb-0">Dafar Pengajuan</h6>
                    {{-- <div class="btn-group">
                        <button class="btn btn-primary btn-shadow" data-bs-toggle="modal" data-bs-target="#tambah">
                            <i class="fa-fw fas fa-upload nav-icon"></i>&nbsp;&nbsp;Upload Berkas
                        </button>
                    </div> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dttable" class="table table-hover dt-responsive align-middle">
                            <thead>
                                <tr>
                                    <th class="cell-fit">#ID</th>
                                    <th class="cell-fit">NIP</th>
                                    <th>NAMA</th>
                                    <th>JABATAN</th>
                                    <th>PROGRESS</th>
                                    <th>ESTIMASI</th>
                                    <th>UPDATE</th>
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
                                    <th class="cell-fit">#ID</th>
                                    <th class="cell-fit">NIP</th>
                                    <th>NAMA</th>
                                    <th>JABATAN</th>
                                    <th>PROGRESS</th>
                                    <th>ESTIMASI</th>
                                    <th>UPDATE</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL START --}}
    <div class="modal fade" id="modalHapus" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="text-center">
                        <h3>Hapus Berkas Anda?</h3>
                    </div>
                </div>
                <div class="modal-body">
                    <input type="text" id="tampungHapus" hidden>
                    <p>File yang sudah anda Upload akan terhapus oleh Sistem. Anda hanya memiliki kesempatan menghapus pada
                        Hari saat Anda mengupload file tersebut.</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger" onclick="hapus()"><i class="fa-fw fas fa-trash nav-icon me-1"></i> Hapus</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa-fw fas fa-times nav-icon me-1"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}

    <script>
        $(document).ready(function() {

            refresh();

        });

        function refresh() {
            $("#tampil-tbody").empty();
            $("#tampil-tbody").empty().append(`<tr><td colspan="9" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax(
                {
                    url: "/api/kepegawaian/pengajuan/idcard/table",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        var adminID = "{{ Auth::user()->getManyRole(['it','kabag-kepegawaian']) }}";
                        // var userID = "{{ Auth::user()->id }}";
                        $("#tampil-tbody").empty();
                        $('#dttable').DataTable().clear().destroy();

                        res.show.forEach(item => {
                            content = "<tr id='data"+ item.id +"'>";
                            content += `<td><center><div class='dropend'><a href='javascript:void(0);' class='btn ${item.status==0?'btn-light':'btn-light-primary'} btn-sm font-size-16 rounded' data-bs-toggle='dropdown' aria-haspopup="true"><i class="ti ti-dots"></i></a><div class='dropdown-menu'>`;
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(`+item.id+`)" value="animate__rubberBand"><i class='ti ti-edit me-1'></i> Ubah</a>`;
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-danger' onclick="showHapus(`+item.id+`)" value="animate__rubberBand"><i class='ti ti-trash me-1'></i> Hapus</a>`;
                            content += `</div></center></td>`;
                            if (item.pengajuan == 0) {
                                stt = `<span class="badge rounded-pill text-bg-success p-1">Baru</span>`;
                            } else {
                                stt = `<span class="badge rounded-pill text-bg-primary p-1">Ganti</span>`;
                            }
                            content += `<td>${item.pegawai_nip?item.pegawai_nip:'-'}</td>`;
                            content += "<td style='white-space: normal !important;word-wrap: break-word;'>"
                                    + "<div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'>"
                                        + "<h6 class='mb-0'>" + item.pegawai_panggilan + "&nbsp;&nbsp;" + stt + "</h6><small class='text-truncate text-muted'>Oleh " + item.pegawai_nama + "</small>"
                                    + "</div></div></td>";
                            content += `<td>${item.pegawai_jabatan?item.pegawai_jabatan:'-'}</td>`;
                            content += `<td>${item.progress?item.progress:'-'}</td>`;
                            content += `<td>${item.estimasi?item.estimasi:'-'}</td>`;
                            content += `<td>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</td>`;
                            $('#tampil-tbody').append(content);
                        });
                        var table = $('#dttable').DataTable({
                            order: [
                                [6, "desc"]
                            ],
                            bAutoWidth: false,
                            aoColumns : [
                                { sWidth: '5%' },
                                { sWidth: '10%' },
                                { sWidth: '20%' },
                                { sWidth: '20%' },
                                { sWidth: '15%' },
                                { sWidth: '15%' },
                                { sWidth: '15%' },
                            ],
                            displayLength: 10,
                            lengthChange: true,
                            lengthMenu: [ 10, 25, 50, 75, 100, 500, 1000, 5000, 10000],
                            // buttons: ['copy', 'excel', 'pdf', 'colvis']
                        });

                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Record Data tidak ditemukan.',
                            position: 'topRight'
                        });
                    }
                }
            );
        }

        function saveData() {
            $("#tambah").one('submit', function() {
                $("#btn-simpan").attr('disabled', 'disabled');
                $("#btn-simpan").find("i").toggleClass("fa-upload fa-sync fa-spin");
                return true;
            });
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
    </script>
@endsection
