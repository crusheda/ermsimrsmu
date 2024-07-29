@extends('layouts.default')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">MFK - Kecelakaan Kerja</h4>
            </div>
        </div>
    </div>

    <div class="card card-body table-responsive" style="overflow: visible;">
        <h4 classs="card-title">
            <div class="btn-group">
                <button class="btn btn-soft-success" onclick="window.location='{{ route('accidentreport.tambah') }}'"><i
                        class="mdi mdi-microsoft-excel"></i>&nbsp;&nbsp;Tambah Data</button>
                <button type="button" class="btn btn-soft-warning" data-bs-toggle="tooltip" data-bs-offset="0,4"
                    data-bs-placement="bottom" data-bs-html="true"
                    title="<i class='fa-fw fas fa-sync nav-icon'></i> <span>Segarkan Tabel</span>" onclick="refresh()">
                    <i class="fa-fw fas fa-sync nav-icon"></i></button>
            </div>
        </h4>
        <hr>
        <table id="dttable" class="table dt-responsive table-hover w-100 align-middle">
            <thead>
                <tr>
                    <th><center>AKSI</center></th>
                    <th>KORBAN</th>
                    <th>UNIT</th>
                    <th>LOKASI</th>
                    <th>TGL</th>
                </tr>
            </thead>
            <tbody id="tampil-tbody">
                <tr>
                    <td colspan="10"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td>
                </tr>
            </tbody>
            <tfoot class="bg-whitesmoke">
                <tr>
                    <th><center>AKSI</center></th>
                    <th>KORBAN</th>
                    <th>UNIT</th>
                    <th>LOKASI</th>
                    <th>TGL</th>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- MODAL START --}}
    <div class="modal fade animate__animated animate__jackInTheBox fade" id="tampil" aria-hidden="true"
        aria-labelledby="modalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Kecelakaan Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ini isinya
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}

    <script>
        $(document).ready(function() {

            // AJAX TABLE GET
            $.ajax({
                url: "/api/mfk/kecelakaankerja/data",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    res.show.forEach(item => {
                        // var updet = item.updated_at.substring(0, 10);
                        content = `<tr id='data"+ item.id +"'>`;
                        content +=
                            `<td><center><div class='btn-group'><button type='button' class='btn btn-sm btn-primary btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false' value="animate__rubberBand"><i class='bx bx-dots-vertical-rounded'></i></button><ul class='dropdown-menu dropdown-menu-right'>` +
                            `<li><a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbah(` +
                            item.id +
                            `)"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a></li>` +
                            `<li><a href='javascript:void(0);' class='dropdown-item text-info' onclick="window.open('/pelayanan/kebidanan/skl/` +
                            item.id +
                            `/print','id','width=900,height=600')"><i class='bx bx-printer scaleX-n1-rtl'></i> Cetak</a></li>` +
                            `<li><a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/pelayanan/kebidanan/skl/` +
                            item.id +
                            `/cetak')"><i class='bx bx-download scaleX-n1-rtl'></i> Download</a></li>` +
                            `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` +
                            item.id +
                            `)"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></li>` +
                            `</ul></center></td><td>`;
                        content += item.korban + "</td><td>" +
                                    item.role + "</td><td>" +
                                    item.lokasi + "</td><td>" +
                                    item.tgl + "</td>";
                        content += `</tr>`;
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [4, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '8%' },
                            { sWidth: '32%' },
                            { sWidth: '25%' },
                            { sWidth: '20%' },
                            { sWidth: '15%' },
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    table.buttons().container()
                        .appendTo('#dttable_wrapper .col-md-6:eq(0)');

                    // SELECT PICKER
                    var t = $(".select2");
                    t.length && t.each(function() {
                        var e = $(this);
                        e.wrap('<div class="position-relative"></div>').select2({
                            placeholder: "Pilih",
                            dropdownParent: e.parent()
                        })
                    })

                }
            });

        })
    </script>
@endsection
