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
                    <h5 class="mb-0">Surat Tugas</h5>
                    {{-- @if (Auth::user()->getPermission('admin_surket') == true) --}}
                        <div class="btn-group">
                            <a href="javascript:void(0);" class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical f-18"></i></a>
                            {{-- <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);" onclick="showKategori()">Daftar Kategori</a>
                                </li>
                            </ul> --}}
                        </div>
                    {{-- @endif --}}
                </div>
                <div class="card-body p-b-10">
                    <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                        <small>
                            <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Batas maksimal upload dokumen <kbd>3 mb</kbd> dan hanya berformat <b>PDF</b> <br>
                            <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Pegawai-pegawai yang sudah ditambahkan akan mendapatkan akses download dokumen Surat Tugas tersebut pada masing-masing halaman surat tugas pegawai beserta notifikasi
                            {{-- <i class="ti ti-arrow-narrow-right text-primary me-1"></i>  --}}
                        </small>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group mb-3">
                                <label class="form-label">Daftar Pegawai <span class="text-danger">*</span></label>
                                <select class="form-select select2" name="pegawai[]" id="pegawai" style="width: 100%" multiple>
                                    @if (count($list['users']) > 0)
                                        @foreach ($list['users'] as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama?$item->nama:$item->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group mb-3">
                                <label class="form-label">Upload Dokumen <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col"><input type="file" class="form-control" id="upload_surtug" accept="application/pdf"></div>
                                    <div class="col-auto"><button class="btn btn-primary" onclick="prosesTambahSurtug()" id="btn-upload-surtug" disabled><i class="fas fa-upload me-1"></i> Upload & Share</button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                                    <th class="cell-fit">#ID</th>
                                    {{-- <th class="cell-fit">DOKUMEN</th>
                                    <th class="cell-fit">PEGAWAI</th> --}}
                                    <th class="cell-fit">DIPERBARUI</th>
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
                                    {{-- <th class="cell-fit">DOKUMEN</th>
                                    <th class="cell-fit">PEGAWAI</th> --}}
                                    <th class="cell-fit">DIPERBARUI</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL START --}}
    <div class="modal animate__animated animate__rubberBand fade" id="modalVerif" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Verifikasi Pengajuan
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_verif" hidden>
                    <p style="text-align: justify;">Anda akan melakukan verifikasi Pengajuan Surat Keterangan tersebut, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan proses.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujuverif">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-verif" class="btn btn-primary me-sm-3 me-1" onclick="prosesVerif()"><i class="fas fa-check me-1" style="font-size:13px"></i> Verifikasi</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalBatalVerif" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Pembatalan Verifikasi Pengajuan
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_batal_verif" hidden>
                    <p style="text-align: justify;">Anda akan melakukan pembatalan verifikasi Pengajuan Surat Keterangan tersebut sehingga status akan berubah menjadi <kbd>PENGAJUAN</kbd>, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan proses.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujubatalverif">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-batal-verif" class="btn btn-warning me-sm-3 me-1" onclick="prosesBatalVerif()"><i class="fas fa-undo me-1" style="font-size:13px"></i> Batalkan Verifikasi</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalBatalTolak" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Pembatalan Penolakan Pengajuan
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_status" hidden>
                    <p style="text-align: justify;">Anda akan melakukan pembatalan penolakan Pengajuan Surat Keterangan tersebut sehingga status akan berubah menjadi <kbd>PENGAJUAN</kbd>, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan proses.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujustatus">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-status" class="btn btn-danger me-sm-3 me-1" onclick="prosesBatalTolak()"><i class="fas fa-flag-checkered me-1" style="font-size:13px"></i> Batalkan Penolakan</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times me-1" style="font-size:13px"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal animate__animated animate__rubberBand fade" id="modalTolak" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Penolakan Pengajuan
                    </h4>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_tolak" hidden>
                    <p style="text-align: justify;">Anda akan melakukan penolakan Pengajuan Surat Keterangan tersebut status akan berubah menjadi <kbd>DITOLAK</kbd>, lakukanlah dengan hati-hati. Ceklis dibawah untuk melanjutkan penolakan.</p>
                    <label class="switch">
                        <input type="checkbox" class="switch-input" id="setujutolak">
                        <span class="switch-toggle-slider">
                        <span class="switch-on"></span>
                        <span class="switch-off"></span>
                        </span>
                        <span class="switch-label">Anda siap menerima Risiko</span>
                    </label>
                </div>
                <div class="col-12 text-center mb-4">
                    <button type="submit" id="btn-tolak" class="btn btn-danger me-sm-3 me-1" onclick="prosesTolak()"><i class="fas fa-minus-circle me-1" style="font-size:13px"></i> Tolak Pengajuan</button>
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

        function showRiwayat() {
            $("#tampil-tbody").empty().append(`<tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax({
                url: "/api/kepegawaian/pengajuan/surket/table",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    // VALIDATION FORM
                    // ------------------------------------------------------
                    $("#tampil-tbody").empty();
                    $('#dttable').DataTable().clear().destroy();
                    res.show.forEach(item => {
                        content = "<tr id='data"+ item.id +"'>";
                        content += `<td><center><div class='dropend'><a href='javascript:void(0);' class='btn btn-light btn-sm text-muted font-size-16 rounded' data-bs-toggle='dropdown' aria-haspopup="true"><i class="ti ti-dots"></i></a><div class='dropdown-menu'>`;
                            if (item.deleted_at == null) {
                                content += `<a href='javascript:void(0);' class='dropdown-item text-primary' onclick="window.open('/kepegawaian/profilkaryawan/surtug/download/`+item.id+`')"><i class='fas fa-download me-1'></i> Download</a>`;
                                content += `<a href='javascript:void(0);' class='dropdown-item text-danger' onclick="showHapusSurtug(`+item.id+`)" value="animate__rubberBand"><i class='fas fa-trash me-1'></i> Hapus</a>`;
                            } else {
                                content += `<a href='javascript:void(0);' class='dropdown-item text-secondary'><i class='fas fa-download me-1'></i> Download</a>`;
                                content += `<a href='javascript:void(0);' class='dropdown-item text-secondary'><i class='fas fa-trash me-1'></i> Hapus</a>`;
                            }
                        content += `</div></center></td>`;
                        content += "<td>" + new Date(item.updated_at).toLocaleString("sv-SE") + "</td></tr>";
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        // dom: 'Bfrtip',
                        order: [
                            [3, "desc"]
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        // buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });
                }
            })
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
