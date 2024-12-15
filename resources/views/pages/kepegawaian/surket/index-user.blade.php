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
                        <li class="breadcrumb-item" aria-current="page">Surat Keterangan</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Surat Keterangan</h2>
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
                    <h5 class="mb-0">Form Pengajuan</h5>
                    {{-- @if (Auth::user()->getPermission('admin_surket') == true) --}}
                        <div class="btn-group">
                            <a href="javascript:void(0);" class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical f-18"></i></a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="showKategori()">Daftar Kategori</a>
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
                                    <i class="ti ti-arrow-narrow-right me-1"></i> Tidak dapat mengajukan <b>lebih dari 2x</b> pada order yang sama apabila masih terdapat pengajuan/order yang belum diselesaikan<br>
                                    <i class="ti ti-arrow-narrow-right me-1"></i> Proses pengajuan ini terdiri dari 3 tahap yaitu <span class="badge rounded-pill text-bg-primary">Pengajuan</span> ,
                                                                                                                                    <span class="badge rounded-pill text-bg-warning">Dalam Proses</span> ,
                                                                                                                                    <span class="badge rounded-pill text-bg-success">Selesai</span> <br>
                                    <i class="ti ti-arrow-narrow-right me-1"></i> Pengajuan hanya dapat dihapus pada hari yang sama saat pengajuan tersebut<br>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="divider mb-3"><span>Periksa Kelengkapan Data Diri Anda</span></div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="form-group">
                                <label for="form-label">Nama Lengkap + Gelar <a class="text-danger">*</a></label>
                                <input type="text" value="{{ $list['user']->nama }}" class="form-control" disabled>
                                <input type="text" name="nama" id="nama" value="{{ $list['user']->nama }}" class="form-control" hidden>
                            </div>
                        </div>
                        <div class="col-2 mb-3">
                            <div class="form-group">
                                <label for="form-label">Tempat, Tanggal Lahir <a class="text-danger">*</a></label>
                                <input type="text" value="{{ $list['user']->temp_lahir }}, {{ $list['user']->tgl_lahir }}" class="form-control" disabled>
                                <input type="text" name="ttl" id="ttl" value="{{ $list['user']->temp_lahir }}, {{ $list['user']->tgl_lahir }}" class="form-control" hidden>
                            </div>
                        </div>
                        <div class="col-4 mb-3">
                            <div class="form-group">
                                <label for="form-label">Pendidikan <a class="text-danger">*</a></label>
                                <input type="text" value="{{ $list['pendidikan'] }}" class="form-control" disabled>
                                <input type="text" name="pendidikan" id="pendidikan" value="{{ $list['pendidikan'] }}" class="form-control" hidden>
                            </div>
                        </div>
                        <div class="col-8 mb-3">
                            <div class="form-group">
                                <label for="form-label">Alamat Lengkap <a class="text-danger">*</a></label>
                                <input type="text" value="{{ $list['user']->alamat_dom?$list['user']->alamat_dom:$list['user']->alamat_ktp }}" class="form-control" disabled>
                                <input type="text" name="alamat" id="alamat" value="{{ $list['user']->alamat_dom?$list['user']->alamat_dom:$list['user']->alamat_ktp }}" class="form-control" hidden>
                                <small>Apabila terdapat <b>ketidaksesuaian</b> data, silakan mengubah data diri Anda di menu Profil</small>
                            </div>
                        </div>
                        <div class="col-4 mb-3">
                            <div class="form-group">
                                <label for="form-label">TMT (Tanggal Mulai Tugas) <a class="text-danger">*</a></label>
                                <input type="text" value="{{ $list['user']->tmt }}" class="form-control" disabled>
                                <input type="text" name="tmt" id="tmt" value="{{ $list['user']->tmt }}" class="form-control" hidden>
                                <small>Apabila TMT <b class="text-danger">Masih Kosong</b>, silakan menghubungi bagian Kepegawaian</small>
                            </div>
                        </div>
                        <div class="divider mb-3"><span>Formulir</span></div>
                        <div class="col-12">
                            <div class="mb-2 row">
                                <label class="col-lg-3 col-form-label">Kategori Order Surat <a class="text-danger">*</a>
                                    <small class="text-muted d-block">Silakan order bagi yang berkepentingan</small>
                                </label>
                                <div class="col-lg-9">
                                    <select class="form-control" name="kategori" id="kategori">
                                        <option value="">Pilih</option>
                                        @if (count($list['kategori']) > 0)
                                            @foreach ($list['kategori'] as $item)
                                                <option value="{{ $item->id }}">{{ $item->deskripsi }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="text-end btn-page mb-0">
                                <button class="btn btn-primary" id="btn-simpan" onclick="ajukan()"><i class="fas fa-stamp me-1"></i> Ajukan Sekarang</button>
                            </div>
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
                                    <th>
                                        <center>#ID</center>
                                    </th>
                                    <th>KATEGORI</th>
                                    <th>USER</th>
                                    <th><center>PROGRESS</center></th>
                                    <th>UPDATE</th>
                                    <th>VERIFIED</th>
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
                                    <th>
                                        <center>#ID</center>
                                    </th>
                                    <th>KATEGORI</th>
                                    <th>USER</th>
                                    <th><center>PROGRESS</center></th>
                                    <th>UPDATE</th>
                                    <th>VERIFIED</th>
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

        function ajukan() {
            $("#btn-simpan").prop('disabled', true);
            $("#btn-simpan").find("i").toggleClass("fa-stamp fa-sync fa-spin");

            // Definisi
            var save = new FormData();
            save.append('nama',$('#nama').val());
            save.append('ttl',$('#ttl').val());
            save.append('pendidikan',$('#pendidikan').val());
            save.append('alamat',$('#alamat').val());
            save.append('tmt',$('#tmt').val());
            save.append('kategori',$('#kategori').val());
            save.append('pegawai','{{ Auth::user()->id }}');

            // console.log(save.get('pengajuan'));
            if ($('#nama').val() == "" ||
                $('#ttl').val() == "" ||
                $('#pendidikan').val() == "" ||
                $('#alamat').val() == "" ||
                $('#tmt').val() == "" ||
                $('#kategori').val() == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan tidak ada data yang kosong, silakan membaca keterangan pengisian',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/kepegawaian/pengajuan/surket/tambah',
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    data: save,
                    success: function(res) {
                        if (res.code == 500) {
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
                                message: 'Pengajuan Surat Keterangan telah berhasil dilakukan pada '+res,
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

            $("#btn-simpan").find("i").removeClass("fa-sync fa-spin").addClass("fa-stamp");
            $("#btn-simpan").prop('disabled', false);
        }

        function showRiwayat() {
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/kepegawaian/pengajuan/surket/{{ Auth::user()->id }}/table",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        var date = new Date().toLocaleString("sv-SE").substring(0, 10);
                        // PROGRESS
                        if (item.progress == 0) {
                            var status = `<span class="badge rounded-pill text-bg-primary">Pengajuan</span>`;
                        } else {
                            if (item.progress == 1) {
                                var status = `<span class="badge rounded-pill text-bg-warning">Dalam Proses</span>`;
                            } else {
                                if (item.progress == 2) {
                                    var status = `<span class="badge rounded-pill text-bg-success">Selesai</span>`;
                                } else {
                                    var status = `<span class="badge rounded-pill text-bg-danger">Ditolak</span>`;
                                }
                            }
                        }
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
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>` + item.kategori + `</h6>
                                                <small class='text-truncate text-muted'>No. Surat ` + zeroPad(item.no_surat,100) + `</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>` + item.pegawai_nama + ` (` + item.pegawai_ttl + `)</h6>
                                                <small class='text-truncate text-muted'>` + item.pegawai_pendidikan + `</small>
                                                <small class='text-truncate text-muted'>` + item.pegawai_alamat + `</small>
                                            </div>
                                        </div>
                                    </td>`;
                        content += "<td><center>" + status + "</center></td><td>" + new Date(item.updated_at).toLocaleString("sv-SE") + "</td>";
                        content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                        <div class='d-flex justify-content-start align-items-center'>
                                            <div class='d-flex flex-column'>
                                                <h6 class='mb-0'>${item.valid?'Telah Diverifikasi oleh <b class="text-primary">Kepegawaian</b>':'Belum Terverifikasi'}</h6>
                                                <small class='text-truncate text-muted'>${item.tgl_valid?'Pada '+item.tgl_valid:''}</small>
                                            </div>
                                        </div>
                                    </td>`;
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
                            { sWidth: '5%' },
                            { sWidth: '12%' },
                            { sWidth: '45%' },
                            { sWidth: '8%' },
                            { sWidth: '10%' },
                            { sWidth: '20%' },
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
                    url: "/api/kepegawaian/pengajuan/surket/"+id+"/delete",
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

        function zeroPad(nr,base){ // 1 => 001 (1,100)
            var  len = (String(base).length - String(nr).length)+1;
            return len > 0? new Array(len).join('0')+nr : nr;
        }
    </script>
@endsection
