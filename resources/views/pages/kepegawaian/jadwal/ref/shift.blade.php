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
                        <li class="breadcrumb-item" aria-current="page">Daftar Shift</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Daftar Shift (Jaga)</h2>
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
                                <th>(<b class="text-warning">KODE</b>) Nama Shift</th>
                                <th class="cell-fit">Jam Berangkat (24h)</th>
                                <th class="cell-fit">Jam Pulang (24h)</th>
                                <th>Keterangan</th>
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
                                <th>(<b class="text-warning">KODE</b>) Nama Shift</th>
                                <th class="cell-fit">Jam Berangkat (24h)</th>
                                <th class="cell-fit">Jam Pulang (24h)</th>
                                <th>Keterangan</th>
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
                    <h5 class="modal-title" id="orderdetailsModalLabel">Tambah Shift</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <div class="alert alert-secondary">
                                    <small>
                                        <h6><center>Mohon Diperhatikan <b class="text-danger">Panduan Di Bawah</b> Sebelum Melakukan Pengisian!</center></h6>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Perhatikan penulisan Nama Singkat Shift karena kata tersebut akan menjadi pilihan dalam penentuan Jadwal Dinas<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Penulisan Nama Singkat Shift hanya diperbolehkan <kbd>2 HURUF</kbd><br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Shift yang akan ditambahkan tidak boleh sama dengan yang sudah ada<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Format Waktu/Jam Shift = <u><b>JAM (24 Jam) : MENIT</b></u><br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Waktu/Jam Shift Berangkat dan Pulang tidak boleh sama<br>
                                        <i class="fas fa-caret-right text-primary me-1 mb-3"></i> Contoh memasukkan Jam Berangkat & Pulang (Khusus Lewat HARI)<br>
                                        <h6><span class="border border-dark border-top-2">&nbsp;Berangkat <i class="fas fa-long-arrow-alt-right text-danger"></i> Pulang&nbsp;</span>
                                        <i class="fas fa-grip-lines me-1">
                                        </i><span class="border border-dark border-top-2">&nbsp;21:00 <i class="fas fa-long-arrow-alt-right text-danger"></i> 05:00&nbsp;</span></h6>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama <mark>Singkat</mark> Shift <a class="text-danger">*</a></label>
                                <input type="text" id="singkat_add" class="form-control inputTgl" onkeyup="checkShift($(this))" pattern="[A-Za-z]{1,2}" placeholder="e.g. P / PS / P6 / etc">
                            </div>
                        </div>
                        <div class="col-md-9 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama <mark>Lengkap</mark> Shift <a class="text-danger">*</a></label>
                                <input type="text" id="shift_add" class="form-control" placeholder="e.g. PAGI / PAGI SIANG / PAGI JAM 6 / etc">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jam Berangkat / <b>Masuk</b> <a class="text-danger">*</a></label>
                                <input type="text" id="berangkat_add" class="form-control pilihJam" data-provide="timepicker" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Waktu/Jam Masuk Kerja" placeholder="Format Waktu H:i">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jam Pulang / <b>Keluar</b> <a class="text-danger">*</a></label>
                                <input type="text" id="pulang_add" class="form-control pilihJam" data-provide="timepicker" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Waktu/Jam Pulang Kerja" placeholder="Format Waktu H:i">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea rows="2" class="form-control" id="ket_add" placeholder="Optional"></textarea>
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
                                        <i class="fas fa-caret-right text-primary me-1"></i> Perhatikan penulisan Nama Singkat Shift karena kata tersebut akan menjadi pilihan dalam penentuan Jadwal Dinas<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Penulisan Nama Singkat Shift hanya diperbolehkan <kbd>2 HURUF</kbd><br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Shift yang akan diubah tidak boleh sama dengan yang sudah ada<br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Format Waktu/Jam Shift = <u><b>JAM (24 Jam) : MENIT</b></u><br>
                                        <i class="fas fa-caret-right text-primary me-1"></i> Waktu/Jam Shift Berangkat dan Pulang tidak boleh sama<br>
                                        <i class="fas fa-caret-right text-primary me-1 mb-3"></i> Contoh memasukkan Jam Berangkat & Pulang (Khusus Lewat HARI)<br>
                                        <h6><span class="border border-dark border-top-2">&nbsp;Berangkat <i class="fas fa-long-arrow-alt-right text-danger"></i> Pulang&nbsp;</span>
                                        <i class="fas fa-grip-lines me-1">
                                        </i><span class="border border-dark border-top-2">&nbsp;21:00 <i class="fas fa-long-arrow-alt-right text-danger"></i> 05:00&nbsp;</span></h6>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama <mark>Singkat</mark> Shift <a class="text-danger">*</a></label>
                                <input type="text" id="singkat_edit" class="form-control inputTgl" onkeyup="checkShift($(this))" pattern="[A-Za-z]{1,2}" placeholder="e.g. P / PS / P6 / etc">
                            </div>
                        </div>
                        <div class="col-md-9 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama <mark>Lengkap</mark> Shift <a class="text-danger">*</a></label>
                                <input type="text" id="shift_edit" class="form-control" placeholder="e.g. PAGI / PAGI SIANG / PAGI JAM 6 / etc">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jam Berangkat / <b>Masuk</b> <a class="text-danger">*</a></label>
                                <input type="text" id="berangkat_edit" class="form-control pilihJam" data-provide="timepicker" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Waktu/Jam Masuk Kerja" placeholder="Format Waktu H:i">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jam Pulang / <b>Keluar</b> <a class="text-danger">*</a></label>
                                <input type="text" id="pulang_edit" class="form-control pilihJam" data-provide="timepicker" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Waktu/Jam Pulang Kerja" placeholder="Format Waktu H:i">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea rows="2" class="form-control" id="ket_edit" placeholder="Optional"></textarea>
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
                    <p style="text-align: justify;">Anda akan menghapus Daftar Shift tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
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
            $('.inputTgl').bind('keypress', onlyInput);
            refresh();
            $('.pilihJam').timepicker({ showInputs: false, showMeridian: false, timeFormat: 'HH:mm', use24hours: true });
        })

        // IMPORTANT FUNCTION
        function checkShift(t) {
            if (t.val().length <= 2 ) {
                t.val(t.val().toUpperCase());
            } else {
                t.val('');
            }
        }

        function onlyInput(event) {
            var value = String.fromCharCode(event.which);
            var pattern = new RegExp(/[a-zåäö ]/i);
            return pattern.test(value);
        }

        // FUNCTION AREA
        function refresh() {
            $('.modal').modal('hide');
            $("#tampil-tbody").empty().append(
                `<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
            );
            $.ajax({
                url: "/api/kepegawaian/jadwaldinas/shift/table/{{ Auth::user()->id }}",
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
                                                    <a href="javascript:;" onclick="ubah(` + item.id + `)" class="dropdown-item text-warning"><i class='fas fa-edit me-1'></i> Ubah</a>
                                                    <a href="javascript:;" onclick="hapus(` + item.id + `)" class="dropdown-item text-danger"><i class='fas fa-trash-alt me-1'></i> Hapus</a>
                                                </div>
                                            </div>
                                        </div></td>`;
                        content += `<td><kbd class="bg-warning text-white me-1">${item.singkat}</kbd> <u><b class='text-dark'>`+item.shift+`</b></u></td>`;
                        content += `<td>`+item.berangkat+`</td>`;
                        content += `<td>`+item.pulang+`</td>`;
                        content += `<td>${item.ket?item.ket:'-'}</td>`;
                        content += `<td>`;
                            if(item.updated_at) { content += new Date(item.updated_at).toLocaleString("sv-SE"); } else { content += `-`; }
                        content += `</td></tr>`;
                        $('#tampil-tbody').append(content);
                    })
                    var table = $('#dttable').DataTable({
                        order: [
                            [5, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            { sWidth: '5%' },
                            { sWidth: '30%' },
                            { sWidth: '15%' },
                            { sWidth: '15%' },
                            { sWidth: '20%' },
                            { sWidth: '15%' },
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
            $("#berangkat_add").val("");
            $("#pulang_add").val("");
            $('#modalTambah').modal('show');
        }

        function simpan() {
            var singkat = $("#singkat_add").val();
            var shift = $("#shift_add").val();
            var berangkat = $("#berangkat_add").val();
            var pulang = $("#pulang_add").val();
            var ket = $("#ket_add").val();
            var pegawai = "{{ Auth::user()->id }}";

            if (singkat == "" || shift == "" || berangkat == "" || pulang == "") {
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
                    url: '/api/kepegawaian/jadwaldinas/shift/tambah',
                    dataType: 'json',
                    data: {
                        singkat: singkat,
                        shift: shift,
                        berangkat: berangkat,
                        pulang: pulang,
                        ket: ket,
                        pegawai: pegawai,
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Tambah Shift berhasil pada '+ res,
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
            $("#singkat_edit").val("");
            $("#shift_edit").val("");
            $("#berangkat_edit").val("");
            $("#pulang_edit").val("");
            $("#ket_edit").val("");
            $.ajax(
            {
                url: "/api/kepegawaian/jadwaldinas/shift/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#id_edit").val(res.show.id);
                    $("#singkat_edit").val(res.show.singkat);
                    $("#shift_edit").val(res.show.shift);
                    $("#berangkat_edit").val(res.show.berangkat.substring(0,5)).change();
                    $("#pulang_edit").val(res.show.pulang.substring(0,5)).change();
                    $("#ket_edit").val(res.show.ket);
                    $('#modalUbah').modal('show');
                }
            });
        }

        function prosesUbah() {
            $("#btn-ubah").prop('disabled', true);
            $("#btn-ubah").find("i").toggleClass("fa-save fa-sync fa-spin");

            var fd = new FormData();
            fd.append('id',$("#id_edit").val());
            fd.append('singkat',$("#singkat_edit").val());
            fd.append('shift',$("#shift_edit").val());
            fd.append('berangkat',$("#berangkat_edit").val());
            fd.append('pulang',$("#pulang_edit").val());
            fd.append('ket',$("#ket_edit").val());
            fd.append('pegawai',"{{ Auth::user()->id }}");

            if (fd.get('singkat') == "" || fd.get('shift') == "" || fd.get('berangkat') == "" || fd.get('pulang') == "") {
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
                    url: "/api/kepegawaian/jadwaldinas/shift/"+fd.get('id')+"/ubah",
                    method: 'post',
                    data: fd,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(res){
                        iziToast.success({
                            title: 'Pesan Sukses! ID : '+fd.get('id'),
                            message: 'Shift berhasil diperbarui pada '+res,
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
                    url: "/api/kepegawaian/jadwaldinas/shift/"+id+"/hapus",
                    type: 'DELETE',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Shift telah berhasil dihapus pada '+res,
                            position: 'topRight'
                        });
                        $('#hapus').modal('hide');
                        refresh();
                        // window.location.reload();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Shift gagal dihapus',
                            position: 'topRight'
                        });
                    }
                });
            }
        }
    </script>
@endsection
