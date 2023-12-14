@extends('layouts.default')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Aset & Gudang - Daftar Ruangan</h4>
            </div>
        </div>
    </div>

    <div class="card">

        <div class="card-body border-bottom">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 card-title flex-grow-1">
                    <div class="btn-group">
                        <a class="btn btn-outline-secondary" href="{{ route('aset.index') }}" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="Kembali ke Daftar Aset"><i  class="bx bx-chevron-left"></i></a>
                        <button class="btn btn-primary" onclick="tambah()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="Tambah Ruangan & Lokasi"><i class='bx bx-plus scaleX-n1-rtl'></i> Tambah</button>
                    </div>
                </h5>
                <div class="flex-shrink-0">
                    <button class="btn btn-info" onclick="refresh()" data-bs-toggle="tooltip"
                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                    title="Refresh Tabel Ruangan"><i class="mdi mdi-refresh"></i> Segarkan</button>
                </div>
            </div>
        </div>
        <div class="card-body" style="overflow: visible;">
            <div class="table-responsive text-nowrap" style="border: 0px">
                <table id="dttable" class="table dt-responsive table-hover nowrap w-100">
                    <thead>
                        <tr>
                            <th class="cell-fit">Aksi</th>
                            <th><span class="badge bg-secondary">Kode</span> Ruangan</th>
                            <th class="cell-fit">Lokasi</th>
                            <th>Unit</th>
                            <th class="cell-fit">Diperbarui</th>
                        </tr>
                    </thead>
                    <tbody id="tampil-tbody">
                        <tr>
                            <td colspan="9">
                                <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- end table -->
            </div>
            <!-- end table responsive -->
        </div>

        <!--TAMBAH RUANGAN -->
        <div class="modal fade" tabindex="-1" id="modalTambah" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderdetailsModalLabel">Tambah Ruangan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Kode Inventaris</label>
                                    <input type="text" id="kode" class="form-control" placeholder="e.g. 2.2.1.1">
                                </div>
                            </div>
                            <div class="col-md-8 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Nama Ruangan</label>
                                    <input type="text" id="ruangan" class="form-control" placeholder="e.g. Poliklinik">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="form-group">
                                    <label class="form-label">Lokasi</label>
                                    <input type="text" id="lokasi" class="form-control" placeholder="e.g. Ruang Jaga Perawat">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="form-label">Unit Terkait</label>
                                    <select class="select2unit form-control" id="unit" style="width: 100%" data-bs-auto-close="outside" required multiple="multiple">
                                        {{-- <option value="">Pilih</option> --}}
                                        @if (count($list['role']) > 0)
                                            @foreach ($list['role'] as $key => $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <small>Para karyawan akan dapat melihat asetnya masing-masing menyesuaikan unit yang dipilih</small>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                        <button class="btn btn-info" onclick="simpan()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                            title="Simpan Data Ruangan"><i
                                class="bx bxs-plus-square"></i>&nbsp;&nbsp;Submit</button>
                        {{-- <button class="btn btn-primary" onclick="showKeranjang()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="Lihat Keranjang"><i
                                class="bx bx-cart align-middle"></i>&nbsp;&nbsp;Keranjang</button> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {

            $.ajax({
                url: "/api/inventaris/aset/ruangan",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var unit = JSON.parse(item.unit.replace(/"/g,""));
                        content = `<tr><td><div class="d-flex align-items-center">
                                            <div class="dropdown">
                                                <a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0 btn-icon" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="javascript:;" onclick="ubah(` + item.id + `)" class="dropdown-item text-warning"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a>
                                                    <a href="javascript:;" onclick="hapus(` + item.id + `)" class="dropdown-item text-danger"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a>
                                                </div>
                                            </div>
                                        </div></td>`;
                        content += `<td><span class="badge bg-secondary">`+item.kode+`</span> <u>`+item.ruangan+`</u></td>`;
                        content += `<td>`+item.lokasi+`</td><td>`;
                        unit.forEach(val => {
                            res.role.forEach(pus => {
                                if (val == pus.id) {
                                    content += `<span class="badge bg-dark">` + pus.name +
                                        `</span>&nbsp;`;
                                }
                            })
                        })
                        content += `</td><td>`+item.updated_at.substring(0, 19).replace('T',' ')+`</td></tr>`;
                        $('#tampil-tbody').append(content);
                    })
                    var table = $('#dttable').DataTable({
                        order: [
                            [4, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '20%' },
                            { sWidth: '20%' },
                            { sWidth: '25%' },
                            { sWidth: '10%' },
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    table.buttons().container()
                        .appendTo('#dttable_wrapper .col-md-6:eq(0)');
                }
            })

            var te = $(".select2unit");
            te.length && te.each(function() {
                var es = $(this);
                es.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih Unit",
                    dropdownParent: es.parent()
                })
            });

            // $(".select2").select2({
            //     placeholder: "",
            //     allowClear: true
            // }).val('').trigger('change');
        })

        // FUNCTION AREA
        function tambah() {
            $('#modalTambah').modal('show');
        }

        function simpan() {
            var kode = $("#kode").val();
            var ruangan = $("#ruangan").val();
            var lokasi = $("#lokasi").val();
            var unit = $("#unit").val();
            var user = '{{ Auth::user()->id }}';

            if (kode == "" || ruangan == "" || lokasi == "" || unit == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/inventaris/aset/ruangan/store',
                    dataType: 'json',
                    data: {
                        kode: kode,
                        ruangan: ruangan,
                        lokasi: lokasi,
                        unit: unit,
                        user: user,
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Tambah Ruangan berhasil pada '+ res,
                            position: 'topRight'
                        });
                        if (res) {
                            $('.modal').modal('hide');
                            refresh();
                        }
                    },
                    error: function (res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: res.responseJSON.error,
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function refresh() {
            $('.modal').modal('hide');
            $("#tampil-tbody").empty().append(
                `<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/inventaris/aset/ruangan",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var unit = JSON.parse(item.unit.replace(/"/g,""));
                        content = `<tr><td><div class="d-flex align-items-center">
                                            <div class="dropdown">
                                                <a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0 btn-icon" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="javascript:;" onclick="ubah(` + item.id + `)" class="dropdown-item text-warning"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a>
                                                    <a href="javascript:;" onclick="hapus(` + item.id + `)" class="dropdown-item text-danger"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a>
                                                </div>
                                            </div>
                                        </div></td>`;
                        content += `<td><span class="badge bg-secondary">`+item.kode+`</span> <u>`+item.ruangan+`</u></td>`;
                        content += `<td>`+item.lokasi+`</td><td>`;
                        unit.forEach(val => {
                            res.role.forEach(pus => {
                                if (val == pus.id) {
                                    content += `<span class="badge bg-dark">` + pus.name +
                                        `</span>&nbsp;`;
                                }
                            })
                        })
                        content += `</td><td>`+item.updated_at.substring(0, 19).replace('T',' ')+`</td></tr>`;
                        $('#tampil-tbody').append(content);
                    })
                    var table = $('#dttable').DataTable({
                        order: [
                            [4, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '20%' },
                            { sWidth: '20%' },
                            { sWidth: '25%' },
                            { sWidth: '10%' },
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    table.buttons().container()
                        .appendTo('#dttable_wrapper .col-md-6:eq(0)');

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }
            })
        }
    </script>
@endsection
