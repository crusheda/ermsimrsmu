@extends('layouts.default')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Laporan Bulanan - Verifikasi</h4>
            </div>
        </div>
    </div>

    <div class="card card-body table-responsive text-nowrap">
        <div classs="card-title">
            <button class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom"
                data-bs-html="true" title="Kembali ke sebelumnya">
                <i class="fas fa-chevron-left"></i>&nbsp;
                <span class="align-middle">Kembali</span>
            </button>
        </div>
        <hr>
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
                    <td colspan="7"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td>
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

    {{-- MODAL --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="verif" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">
                    Verifikasi Dokumen
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-info waves-effect btn-label waves-light"><i class="bx bx-check label-icon"></i> Verifikasi</button>
                    <button type="button" class="btn btn-outline-warning waves-effect waves-light" data-bs-toggle="collapse" data-bs-target="#tampil-catatan"><i class="bx bx-note label-icon "></i> Tambahkan Catatan</button>
                    <div class="collapse" id="tampil-catatan">
                        <div class="form-group mb-2 mt-2">
                            <textarea class="form-control" id="catatan" placeholder="Tuliskan Catatan Laporan"></textarea>
                        </div>
                        <button class="btn btn-success" id="btn-simpan-catatan" onclick="saveCatatan()"><i
                                class="fa-fw fas fa-save nav-icon"></i> Simpan Catatan</button>
                    </div>
                    <hr>
                    <table id="dttable" class="table dt-responsive table-hover table-bordered nowrap w-100 align-middle">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>ID USER</th>
                                <th>NAMA USER</th>
                                <th>JABATAN</th>
                                <th>UPDATE</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody-verif">
                            <tr>
                                <td colspan="7"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>NO</th>
                                <th>ID USER</th>
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
                    res.forEach(item => {
                        if (item.unit) {
                            try {
                                var un = JSON.parse(item.unit);
                            } catch (e) {
                                var un = item.unit;
                            }
                        }
                        var updet = item.updated_at.substring(0, 10);
                        content = `<tr id="data` + item.id + `">`;
                        content += `<td><center><div class="btn-group">
                        <button class='btn btn-success btn-sm' onclick="window.location.href='{{ url('berkas/laporan/bulanan/`+item.id+`') }}'"><i class="fa-fw fas fa-download nav-icon"></i></button>
                        <button class='btn btn-info btn-sm' onclick="showVerif(` + item.id +
                            `)"><i class="fa-fw fas fa-check nav-icon"></i></button>`;
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
                        content += `</td><td>` + item.updated_at.substring(0, 19).replace('T',' ') + `</td></tr>`;
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [6, "desc"]
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    table.buttons().container()
                        .appendTo('#dttable_wrapper .col-md-6:eq(0)');
                }
            });
        })

        // FUNCTION
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

        function saveData() {
            $("#tambah").one('submit', function() {
                $("#btn-simpan").attr('disabled', 'disabled');
                $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
                return true;
            });
        }

        function showVerif(id) {
            $.ajax({
                url: "/api/laporan/bulanan/table/verif/" + id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    if (res != null) {
                        res.forEach(item => {
                            $content = ``;
                            $('#tampil-tbody-verif').append(content);
                        })
                    } else {
                        $('#tampil-tbody-verif').append(`<td colspan="5">Belum ada yg verifikasi</td>`);
                    }
                    $('#verif').modal('show');
                }
            })
        }
    </script>
@endsection
