@extends('layouts.index')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Kepegawaian</li>
                        <li class="breadcrumb-item">Rekrutmen</li>
                        <li class="breadcrumb-item" aria-current="page">Pengumuman</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Daftar Lowongan Kerja</h2>
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
                    <h5 class="mb-0">Table</h5>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambah"><i class="fa-fw fas fa-plus nav-icon"></i>&nbsp;&nbsp;Tambah Loker</button>
                    </div>
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
                                    <th><center>PROGRESS</center></th>
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
                                    <th><center>PROGRESS</center></th>
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
    <div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Tambah Lowongan Pekerjaan
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Buka Lowongan <a class="text-danger">*</a></label>
                                <input type="date" id="mulai" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tutup Lowongan <a class="text-danger">*</a></label>
                                <input type="date" id="mulai" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Penempatan / Unit Kerja</label>
                                <input type="text" id="unit" value="" class="form-control" placeholder="e.g. IT">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Kebutuhan <a class="text-danger">*</a></label>
                                <input type="text" id="nama" value="" class="form-control" placeholder="e.g. IT Support">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Umur Minimal <a class="text-danger">*</a></label>
                                <input type="number" id="umur_min" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Umur Maksimal</label>
                                <input type="number" id="umur_max" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jumlah Kebutuhan <a class="text-danger">*</a></label>
                                <input type="number" id="jumlah" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Maksimal Kuota Pendaftar</label>
                                <input type="number" id="kuota" value="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Jenjang Pendidikan <a class="text-danger">*</a></label>
                                <select class="select-multiple form-select" name="tujuan[]" id="tujuan1_add_req" data-allow-clear="true" data-bs-auto-close="outside" style="width: 100%" required multiple>
                                    {{-- <option value="" selected>Pilih</option> --}}
                                    @if(count($list['pendidikan']) > 0)
                                        @foreach($list['pendidikan'] as $item)
                                            <option value="{{ $item->id }}">{{ "[".$item->kategori."] ".$item->nama }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Uraian Tugas <a class="text-danger">*</a></label>
                                <textarea id="tugas" rows="4" class="form-control" placeholder="e.g. Pengelolaan infrastruktur teknologi, keamanan data pasien, pemeliharaan sistem informasi rumah sakit, serta memberikan dukungan teknis dan integrasi antar sistem untuk mendukung pelayanan medis yang efisien."></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Keahlian <a class="text-danger">*</a></label>
                                <textarea id="keahlian" rows="4" class="form-control" placeholder="e.g. keamanan siber untuk melindungi data pasien, manajemen jaringan untuk memastikan konektivitas yang stabil, serta pemrograman untuk pengembangan dan pemeliharaan perangkat lunak. Selain itu, kemampuan dalam memberikan support teknis, manajemen sistem informasi rumah sakit, dan analisis data juga penting untuk mendukung kelancaran operasional dan meningkatkan kualitas layanan medis."></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Persyaratan <a class="text-danger">*</a></label>
                                <textarea id="persyaratan" rows="4" class="form-control" placeholder="e.g. Muslim (Laki-laki), usia max 30th, memiliki sertifikat ahli K3 umum/K3RS, manajemen resiko, mampu berkomunikasi dengan baik, sehat jasmani & rohani, mampu bekerjasama dalam tim, menguasai analisa/pengolahan/penyajian data dalam komputer"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Keterangan <a class="text-danger">*</a></label>
                                <textarea id="persyaratan" rows="2" class="form-control" placeholder="Optional"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="prosesSimpan()"><i class="fa-fw fas fa-save nav-icon"></i> Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
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
            var te = $(".select-multiple");
            te.length && te.each(function() {
                var es = $(this);
                es.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    dropdownParent: es.parent()
                })
            });

            refresh();
        })

        function refresh() {
            $("#tampil-tbody").empty();
            $("#tampil-tbody").empty().append(`<tr><td colspan="9" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`);
            $.ajax(
                {
                    url: "/api/kepegawaian/rekrutmen/pengumuman/table",
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        var adminID = "{{ Auth::user()->getPermission('admin_kepegawaian') }}";
                        // var userID = "{{ Auth::user()->id }}";
                        $("#tampil-tbody").empty();
                        $('#dttable').DataTable().clear().destroy();

                        res.show.forEach(item => {
                            content = "<tr id='data"+ item.id +"'>";
                            content += `<td><center><div class='dropend'><a href='javascript:void(0);' class='btn ${item.progress==2 || item.progress==3?'btn-light':'btn-light-primary'} btn-sm font-size-16 rounded' data-bs-toggle='dropdown' aria-haspopup="true"><i class="ti ti-dots"></i></a><div class='dropdown-menu'>`;
                                if (item.progress == 3 || item.progress == 2) {
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-secondary'><i class='ti ti-edit me-1'></i> Ubah Status</a>`;
                                } else {
                                    content += `<a href='javascript:void(0);' class='dropdown-item text-warning' onclick="showUbahStatus(`+item.id+`,`+item.progress+`)" value="animate__rubberBand"><i class='ti ti-edit me-1'></i> Ubah Status</a>`;
                                }
                                    // content += `<a href='javascript:void(0);' class='dropdown-item text-danger' onclick="showHapus(`+item.id+`)" value="animate__rubberBand"><i class='ti ti-trash me-1'></i> Hapus</a>`;
                            content += `</div></center></td>`;
                            if (item.pengajuan == 0) {
                                stt = `<small><span class="badge rounded-pill text-bg-success p-1">Baru</span></small>`;
                            } else {
                                stt = `<small><span class="badge rounded-pill text-bg-primary p-1">Ganti</span></small>`;
                            }
                            content += `<td>${item.pegawai_nip?item.pegawai_nip:'-'}</td>`;
                            content += "<td style='white-space: normal !important;word-wrap: break-word;'>"
                                    + "<div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'>"
                                        + "<h6 class='mb-0'>" + item.pegawai_panggilan + "&nbsp;&nbsp;" + stt + "</h6><small class='text-truncate text-muted'>Oleh " + item.pegawai_nama + "</small>"
                                    + "</div></div></td>";
                            content += `<td>${item.pegawai_jabatan?item.pegawai_jabatan:'-'}</td>`;
                            if (item.progress == 0) {
                                pg = `<center><span class="badge text-bg-primary p-1">Pengajuan</span></center>`;
                            } else {
                                if (item.progress == 1) {
                                    pg = `<center><span class="badge text-bg-warning p-1">Sedang Diproses</span></center>`;
                                } else {
                                    if (item.progress == 2) {
                                        pg = `<center><span class="badge text-bg-success p-1">Selesai</span></center>`;
                                    } else {
                                        pg = `<center><span class="badge text-bg-danger p-1">Ditolak</span></center>`;
                                    }
                                }
                            }
                            content += `<td>${pg}</td>`;
                            content += `<td>${item.estimasi?item.estimasi:'Belum Ditentukan'}</td>`;
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
    </script>
@endsection
