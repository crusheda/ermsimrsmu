@extends('layouts.index')

@section('content')

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Kepegawaian</li>
                        <li class="breadcrumb-item">Jadwal Dinas</li>
                        <li class="breadcrumb-item" aria-current="page">Daftar Staf</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Daftar Staf</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        <div class="card table-card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 card-title flex-grow-1">
                        <div class="btn-group">
                            <a class="btn btn-outline-secondary" href="{{ route('kepegawaian.jadwaldinas.index') }}" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Kembali"><i class="fas fa-angle-left me-1"></i> Kembali</a>
                            <button class="btn btn-primary" onclick="tambah()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Form Tambah"><i class='ti ti-calendar-plus me-1'></i> Tambah</button>
                        </div>
                    </h5>
                    <div class="flex-shrink-0">
                        <button class="btn btn-link-warning" onclick="refresh()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="Segarkan Tabel"><i class="fas fa-sync me-1"></i> Segarkan</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap" style="border: 0px">
                    <table id="dttable" class="table dt-responsive table-hover nowrap w-100">
                        <thead>
                            <tr>
                                <th class="cell-fit">Aksi</th>
                                <th>Nama Staf</th>
                                <th class="cell-fit">Diperbarui</th>
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
                                <th class="cell-fit">Aksi</th>
                                <th>Nama Staf</th>
                                <th class="cell-fit">Diperbarui</th>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- end table -->
                </div>
                <!-- end table responsive -->
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH -->
    <div class="modal fade" tabindex="-1" id="modalTambah" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Tambah / Perbarui Data Staf</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="alert alert-secondary">
                                    <small>
                                        <h6><center>Mohon Diperhatikan <b class="text-danger">Panduan Di Bawah</b> Sebelum Melakukan Pengisian!</center></h6>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Staf yang ditambahkan di bawah adalah staf yang akan ditampilkan pada Jadwal Dinas Anda<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Apabila terdapat pengurangan / penambahan staf di Unit Anda, segera lakukan pembaruan data<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Apabila nama Staf <mark>TIDAK DITEMUKAN</mark> pada isian di bawah, silakan memperbarui profil karyawan bersangkutan dengan masuk/login Simrsmu menggunakan akun yang telah diberikan oleh Kepegawaian sebelumnya
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Staf / Pegawai di Unit Anda <a class="text-danger">*</a></label>
                                <select class="form-select select2" name="staf[]" id="staf_add" style="width: 100%" multiple>
                                    @if (count($list['users']) > 0)
                                        @foreach ($list['users'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa fa-times me-1"></i> Batal</button>
                    <button class="btn btn-info" onclick="simpan()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                        title="Simpan Data"><i
                            class="fas fa-save me-1"></i> Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL UBAH -->
    <div class="modal fade" tabindex="-1" id="modalUbah" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Ubah Shift</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" hidden>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="alert alert-secondary">
                                    <small>
                                        <h6><center>Mohon Diperhatikan <b class="text-danger">Panduan Di Bawah</b> Sebelum Melakukan Pengisian!</center></h6>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Staf yang ditambahkan di bawah adalah staf yang akan ditampilkan pada Jadwal Dinas Anda<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Apabila terdapat pengurangan / penambahan staf di Unit Anda, segera lakukan pembaruan data<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Apabila nama Staf <mark>TIDAK DITEMUKAN</mark> pada isian di bawah, silakan memperbarui profil karyawan bersangkutan dengan masuk/login Simrsmu menggunakan akun yang telah diberikan oleh Kepegawaian sebelumnya
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Staf/Pegawai di Unit Anda <a class="text-danger">*</a></label>
                                <select class="form-select select2" name="staf[]" id="staf_edit" style="width: 100%" multiple>
                                    @if (count($list['users']) > 0)
                                        @foreach ($list['users'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-ubah" onclick="prosesUbah()"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    <div class="modal animate__animated animate__rubberBand fade" id="hapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Hapus&nbsp;&nbsp;&nbsp;
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan menghapus Daftar Staf tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuhapus">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-hapus" class="btn btn-danger me-sm-3 me-1" onclick="prosesHapus()"><i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>

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

            refresh();
        })

        // FUNCTION AREA
        function refresh() {
            $('.modal').modal('hide');
            $("#tampil-tbody").empty().append(
                `<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/kepegawaian/jadwaldinas/staf/table/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = `<tr><td><div class="d-flex align-items-center">
                                            <div class="dropdown">
                                                <a href="javascript:;" class="btn btn-link-secondary dropdown-toggle hide-arrow text-body p-0 btn-icon" data-bs-toggle="dropdown">` + item.id + `</a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="javascript:;" onclick="hapus(` + item.id + `)" class="dropdown-item text-danger"><i class='fas fa-trash-alt me-1'></i> Hapus</a>
                                                </div>
                                            </div>
                                        </div></td>`; // <a href="javascript:;" onclick="ubah(` + item.id + `)" class="dropdown-item text-warning"><i class='fas fa-edit me-1'></i> Ubah</a>
                        content += `<td><small><ul class='list-unstyled mt-2'>`;
                        res.users.forEach(us => {
                            JSON.parse(item.staf).forEach(val => {
                                if (val == us.id) {
                                    content += `<li><i class="ti ti-arrow-narrow-right me-1"></i>` + us.nama + `</li>`;
                                }
                            })
                        })
                        content += `</small></ul></td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <a class='mb-0'>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</a>
                                                <small class='text-truncate text-muted'>Diperbarui Oleh` + item.nama_user + `</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                    })
                    var table = $('#dttable').DataTable({
                        order: [
                            [2, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '65%' },
                            { sWidth: '30%' },
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    })
                }
            })
        }

        function tambah() {
            $("#staf").val("").change();
            $('#modalTambah').modal('show');
        }

        function simpan() {
            var staf = JSON.stringify($('#staf_add').val());
            var pegawai = "{{ Auth::user()->id }}";

            if ($('#staf_add').val() == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian wajib',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/kepegawaian/jadwaldinas/staf/tambah',
                    dataType: 'json',
                    data: {
                        staf: staf,
                        pegawai: pegawai,
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Tambah Staf berhasil pada '+ res,
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

        function ubah(id) {
            $("#id_edit").val("");
            $("#staf_edit").val("");
            $.ajax(
            {
                url: "/api/kepegawaian/jadwaldinas/staf/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#id_edit").val(res.show.id);

                    var un = JSON.parse(res.show.staf);
                    $("#staf_edit").find('option').remove();
                    res.users.forEach(pounch => {
                        $("#staf_edit").append(`
                            <option value="${pounch.id}">${pounch.nama}</option>
                        `);
                    });
                    $("#staf_edit").val(un).change();

                    $('#modalUbah').modal('show');
                }
            });
        }

        function prosesUbah() {
            $("#btn-ubah").prop('disabled', true);
            $("#btn-ubah").find("i").toggleClass("fa-save fa-sync fa-spin");

            var fd = new FormData();
            fd.append('id',$("#id_edit").val());
            fd.append('staf_edit',JSON.stringify($('#staf_edit').val()));
            fd.append('pegawai',"{{ Auth::user()->id }}");

            if ($('#staf_edit').val() == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian wajib',
                    position: 'topRight'
                });
            } else {
                // AJAX request
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/api/kepegawaian/jadwaldinas/staf/"+fd.get('id')+"/ubah",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(res){
                        iziToast.success({
                            title: 'Pesan Sukses! ID : '+fd.get('id'),
                            message: 'Staf berhasil diperbarui pada '+res,
                            position: 'topRight'
                        });
                        if (res) {
                            $('#ubah').modal('hide');
                            refresh();
                        }
                    },
                    error: function(res){
                        console.log("error : " + JSON.stringify(res) );
                    }
                });
            }

            $("#btn-ubah").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
            $("#btn-ubah").prop('disabled', false);
        }

        function hapus(id) {
            $("#id_hapus").val(id);
            var inputs = document.getElementById('setujuhapus');
            inputs.checked = false;
            $('#hapus').modal('show');
        }

        function prosesHapus() {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuhapus').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui/ceklis form ini untuk melanjutkan proses penghapusan baris tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_hapus").val();
                $.ajax({
                    url: "/api/kepegawaian/jadwaldinas/staf/"+id+"/hapus",
                    type: 'DELETE',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Staf telah berhasil dihapus pada '+res,
                            position: 'topRight'
                        });
                        $('#hapus').modal('hide');
                        refresh();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Staf gagal dihapus',
                            position: 'topRight'
                        });
                    }
                });
            }
        }
    </script>
@endsection
