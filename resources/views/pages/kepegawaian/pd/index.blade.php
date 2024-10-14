@extends('layouts.index')

@section('content')

    {{-- FOR DROPDOWN BEHIND CARD --}}
    <style>
        .dropdown {
            transform-style: preserve-3d;
            transform: translate3d(0,0,10px) !important;
        }
    </style>

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Kepegawaian</li>
                        <li class="breadcrumb-item">Pengajuan</li>
                        <li class="breadcrumb-item" aria-current="page">Surat Tugas</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Surat Tugas</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <h5 class="mb-0">Formulir</h5>
                    {{-- @if (Auth::user()->getPermission('admin_surket') == true) --}}
                        <div class="btn-group">
                            <a href="javascript:void(0);" class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical f-18"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    {{-- <a class="dropdown-item" href="javascript:void(0);" onclick="showKategori()">Daftar Kategori</a> --}}
                                </li>
                            </ul>
                        </div>
                    {{-- @endif --}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="alert alert-secondary">
                                <small>
                                    {{-- <i class="ti ti-arrow-narrow-right me-1"></i> <br> --}}
                                    <i class="ti ti-arrow-narrow-right me-1"></i> Isian bertanda (<a class="text-danger">*</a>) berarti wajib diisi<br>
                                    <i class="ti ti-arrow-narrow-right me-1"></i> Batas ukuran file upload maksimal <b>5 mb</b>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label class="form-label">Nama Acara <a class="text-danger">*</a></label>
                                <input type="text" class="form-control" name="acara" id="acara" placeholder="e.g. Upacara Pengibaran Bendera Merah Putih HUT RI Ke-XX">
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label class="form-label">Waktu Acara <a class="text-danger">*</a></label>
                                <input type="datetime-local" class="form-control" name="tgl" id="tgl">
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jenis Perjalanan Dinas <a class="text-danger">*</a></label>
                                <select class="form-control" name="jenis" id="jenis">
                                    <option value="">Pilih</option>
                                    <option value="1">Offline</option>
                                    <option value="2">Online</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label">Lokasi Acara <a class="text-danger">*</a></label>
                                <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="e.g. Alun-alun Satya Negara Kabupaten Sukoharjo">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Pegawai Pelaksana <a class="text-danger">*</a></label>
                                <select class="form-select select2" name="pegawai[]" id="pegawai[]" style="width: 100%" multiple>
                                    @if (count($list['users']) > 0)
                                        @foreach ($list['users'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Upload <a class="text-danger">*</a></label>
                                <input type="file" class="form-control" id="filex" name="filex" accept="application/pdf">
                            </div>
                        </div>
                        <div class="text-end btn-page mt-2">
                            <button class="btn btn-primary" id="btn-simpan" onclick="simpan()"><i class="fas fa-save me-1"></i> Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-3">
                {{-- <button class="btn btn-link-primary"><i class="ti ti-arrow-narrow-left align-text-bottom me-2"></i>Back to Shipping Information</button> --}}
            </div>
        </div>
        <div class="col-xl-12">
            <div class="card table-card">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <h5 class="mb-0">Daftar Pengajuan</h5>
                    <div class="btn-group">
                        <a href="javascript:void(0);" class="avtar avtar-s btn-link-warning" onclick="showRiwayat()"><i class="ti ti-refresh f-20"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dttable" class="table table-hover dt-responsive align-middle">
                            <thead>
                                <tr>
                                    <th><center>#ID</center></th>
                                    <th><center>WAKTU</center></th>
                                    <th>ACARA</th>
                                    <th>USER</th>
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
                                    <th><center>#ID</center></th>
                                    <th><center>WAKTU</center></th>
                                    <th>ACARA</th>
                                    <th>USER</th>
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
    <div class="modal animate__animated animate__rubberBand fade" id="modalHapus" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Hapus Pengajuan
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_hapus" hidden>
                    <p style="text-align: justify;">Anda akan melakukan penghapusan Pengajuan Surat Keterangan, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penghapusan.</p>
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
    {{-- MODAL END --}}

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

            // $('.select2Tambah').select2({
            //     dropdownParent: $('#tambah')
            // });
            showRiwayat();
        });

        function simpan() {
            $("#btn-simpan").prop('disabled', true);
            $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");

            // Definisi
            var save = new FormData();
            var filesAdded = $('#filex')[0].files;
            save.append('acara',$('#acara').val());
            save.append('tgl',$('#tgl').val());
            save.append('jenis',$('#jenis').val());
            save.append('lokasi',$('#lokasi').val());
            save.append('pegawai',$('#pegawai').val());
            save.append('user','{{ Auth::user()->id }}');
            save.append('file',filesAdded);

            if (
                save.get('acara') == ""     ||
                save.get('tgl') == ""       ||
                save.get('jenis') == ""     ||
                save.get('lokasi') == ""    ||
                save.get('pegawai') == ""   ||
                filesAdded.length == 0 // (Jika Tidak Ada Gambar Yang Diupload)
                ) {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian Wajib',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/kepegawaian/pd/tambah',
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    data: save,
                    success: function(res) {
                        if (res.code != 200) {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: res.message,
                                position: 'topRight',
                                buttons: [
                                    [
                                        '<button>Tutup</button>',
                                        function (instance, toast) {
                                            instance.hide({
                                                transitionOut: 'fadeOutUp'
                                            }, toast);
                                        }
                                    ]
                                ]
                            });
                        } else {
                            iziToast.success({
                                title: 'Pesan Sukses!',
                                message: 'Submit Berkas Perjalanan Dinas telah berhasil dilakukan pada '+res,
                                position: 'topRight'
                            });
                            showRiwayat();
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

            $("#btn-simpan").find("i").removeClass("fa-sync fa-spin").addClass("fa-save");
            $("#btn-simpan").prop('disabled', false);
        }

        function showRiwayat() {
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/kepegawaian/pd/table",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        var date = new Date().toLocaleString("sv-SE").substring(0, 10);
                        content = "<tr id='data" + item.id + "' style='font-size:13px'>";
                        content += `<td><center><div class='btn-group'>
                                        <button type='button' class='btn btn-sm btn-link text-secondary dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'>`+item.id+`</button>
                                        <ul class='dropdown-menu dropdown-menu-right'>`;
                                        if (updet == date) {
                                            if (item.progress == 0) {
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` + item.id + `)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                            } else {
                                                content += `<li><a href='javascript:void(0);' class='dropdown-item text-secondary'><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                            }
                                        } else {
                                            content += `<li><a href='javascript:void(0);' class='dropdown-item text-secondary'><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                                        }
                        content += "</div></center></td>";
                        content += `<td>${new Date(item.tgl).toLocaleString("sv-SE")}</td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>` + item.acara + `</h6>
                                                <small class='text-truncate text-muted'>` + item.lokasi + `</small>
                                                <small class='text-truncate text-muted'>Diselenggarakan secara <b>${item.jenis==1?"Offline":"Online"}</b></small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>` + item.pegawai_id + `</h6>
                                                <small class='text-truncate text-muted'>` + item.pegawai_id + `</small>
                                                <small class='text-truncate text-muted'>` + item.pegawai_id + `</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += "<td>" + new Date(item.updated_at).toLocaleString("sv-SE") + "</td>";
                        content += "</tr>";
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        // dom: 'Bfrtip',
                        order: [
                            [4, "desc"]
                        ],
                        bAutoWidth: false,
                        aoColumns : [
                            // { sWidth: '5%' },
                            // { sWidth: '12%' },
                            // { sWidth: '45%' },
                            // { sWidth: '8%' },
                            // { sWidth: '10%' },
                            // { sWidth: '20%' },
                        ],
                        columnDefs: [
                            // { visible: false, targets: [7] },
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        // buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });
                }
            })
        }

        function hapus(id) {
            $("#id_hapus").val(id);
            var inputs = document.getElementById('setujuhapus');
            inputs.checked = false;
            $('#modalHapus').modal('show');
        }

        function prosesHapus() {
            // SWITCH BTN HAPUS
            var checkboxHapus = $('#setujuhapus').is(":checked");
            if (checkboxHapus == false) {
                iziToast.error({
                    title: 'Pesan Galat!',
                    message: 'Mohon menyetujui untuk dilakukan penghapusan pengajuan tersebut',
                    position: 'topRight'
                });
            } else {
                // PROSES HAPUS
                var id = $("#id_hapus").val();
                $.ajax({
                    url: "/api/kepegawaian/pengajuan/idcard/"+id+"/delete",
                    type: 'DELETE',
                    success: function(res) {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Pengajuan Surat Keterangan Anda telah berhasil dihapus pada '+res,
                            position: 'topRight'
                        });
                        $('#modalHapus').modal('hide');
                        showRiwayat();
                    },
                    error: function(res) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Pengajuan Surat Keterangan Anda gagal dihapus',
                            position: 'topRight'
                        });
                    }
                });
            }
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
