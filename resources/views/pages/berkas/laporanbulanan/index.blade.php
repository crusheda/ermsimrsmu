@extends('layouts.index')

@section('content')

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Administrasi</li>
                        <li class="breadcrumb-item">Berkas</li>
                        <li class="breadcrumb-item" aria-current="page">Laporan Rutin</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Laporan Rutin</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <h5 class="mb-0">Bulanan <b class="text-primary">x</b> Triwulan <b class="text-primary">x</b> Tahunan</h5>
                    <div class="btn-group">
                        <button class="btn btn-primary btn-shadow" data-bs-toggle="modal" data-bs-target="#tambah"><i
                                class="fa-fw fas fa-upload nav-icon"></i>&nbsp;&nbsp;Upload Berkas</button>
                        <button class="btn btn-outline-info btn-shadow" id="btn-verif" onclick="verif()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Menampilkan Semua Data Laporan Bulanan Bawahan">
                            <i class="fas fa-history"></i>&nbsp;
                            <span class="align-middle">Laporan Bawahan</span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dttable" class="table dt-responsive table-hover nowrap w-100 align-middle">
                            <thead>
                                <tr>
                                    <th class="cell-fit">
                                        <center>#ID</center>
                                    </th>
                                    <th>JUDUL</th>
                                    <th>BLN / THN</th>
                                    <th>KETERANGAN</th>
                                    <th>DIUPDATE</th>
                                </tr>
                            </thead>
                            <tbody id="tampil-tbody">
                                <tr>
                                    <td colspan="5" style="font-size:13px"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="cell-fit">
                                        <center>#ID</center>
                                    </th>
                                    <th>JUDUL</th>
                                    <th>BLN / THN</th>
                                    <th>KETERANGAN</th>
                                    <th>DIUPDATE</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    {{-- TAMBAH --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="tambah" data-bs-backdrop="static" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Tambah
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <form class="form-auth-small needs-validation" name="formTambah" action="{{ route('bulanan.store') }}" method="POST"
                        enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-secondary">
                                    Pengubahan atau Penghapusan dokumen laporan hanya berlaku pada <strong class="text-danger">Hari saat Anda mengupload saja</strong>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Pilih Bulan <a class="text-danger">*</a></label>
                                    <select class="form-control" name="bln" id="bln-tambah" style="width: 100%" required>
                                        <option value="">Bulan</option>
                                        <?php
                                        $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                        $jml_bln = count($bulan);
                                        for ($c = 1; $c < $jml_bln; $c += 1) {
                                            echo "<option value=$c> $bulan[$c] </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Pilih Tahun <a class="text-danger">*</a></label>
                                    <select class="form-control" name="thn" id="thn-tambah" style="width: 100%" required>
                                        <option value="">Tahun</option>
                                        @php
                                            for ($i = 2018; $i <= $list['thn']; $i++) {
                                                echo "<option value=$i> $i </option>";
                                            }
                                        @endphp
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label">Judul <a class="text-danger">*</a></label>
                                    <input type="text" name="judul" class="form-control"
                                        placeholder="Laporan Bulanan Unit X" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <textarea rows="3" class="form-control" name="ket" id="ket" placeholder="Optional"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label">Dokumen <a class="text-danger">*</a></label>
                                    {{-- <input type="file" name="file" class="form-control mb-2" accept="application/pdf" required> --}}
                                    <input type="file" name="file" class="form-control mb-2" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="alert alert-secondary mb-0">
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berupa Dokumen<br>
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum dokumen adalah <strong class="text-danger">5 mb</strong>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-simpan" onclick="saveData()"><i
                            class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                    </form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- UBAH --}}
    <div class="modal fade animate__animated animate__jackInTheBox" id="ubah" data-bs-backdrop="static"
        tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Ubah&nbsp;<span class="badge bg-dark badge-sm"><a id="show_edit"></a></span>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" class="form-control" hidden>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Bulan <a class="text-danger">*</a></label>
                                <select class="select2 form-control" id="bln_edit" style="width: 100%" required></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Tahun <a class="text-danger">*</a></label>
                                <select class="select2 form-control" id="thn_edit" style="width: 100%" required></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label class="form-label">Judul <a class="text-danger">*</a></label>
                                <input type="text" id="judul_edit" class="form-control"
                                    placeholder="Laporan Bulanan Unit X" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea rows="3" class="form-control" id="ket_edit" placeholder="Optional"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            Dokumen Upload
                            <div id="file_edit"></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-simpan-edit" onclick="ubah()"><i
                            class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade animate__animated animate__bounceInRight" id="info" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Informasi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <h5 class="mb-0">Cara Setting PDF Viewer pada browser Google Chrome</h5>
                    <sub>Terdapat 2 cara untuk melihat laporan bulanan PDF tanpa mendownload. Apabila anda menggunakan
                        browser Firefox, silakan abaikan semua langkah di bawah.</sub>
                    <div class="divider text-end">
                        <div class="divider-text">Plugin PDF Viewer</div>
                    </div>
                    <p>
                    <h6>1. Instal plugin untuk Google Chrome dengan membuka Link <a target="_blank"
                            href="https://chrome.google.com/webstore/detail/pdf-viewer/oemmndcbldboiebfnladdacbdfmadadm?hl=in"><u>Disini</u></a>
                    </h6>
                    <h6>2. Klik <strong>Tambahkan ke Chrome</strong></h6>
                    <img src="{{ asset('img/pdf-viewer/1.jpg') }}" class="img-fluid" alt="">
                    <h6>3. Klik <strong>Add extension</strong></h6>
                    <img src="{{ asset('img/pdf-viewer/2.jpg') }}" class="img-fluid" alt="">
                    </p>
                    <div class="divider text-end">
                        <div class="divider-text">Mode Incognito (Private Browser)</div>
                    </div>
                    <p>
                    <h6>1. Masuk ke Menu Chrome dengan cara klik tombol Titik Tiga di Pojok Kanan Atas</h6>
                    <img src="{{ asset('img/pdf-viewer/3.jpg') }}" class="img-fluid mb-3" alt="">
                    <h6>2. Klik tombol <strong>New Incognito Window</strong> atau dengan menekan kombinasi tombol
                        <strong>Ctrl+Shift+N</strong></h6>
                    <h6>3. Masuk/Login <strong>Simrsmu</strong> kembali pada Mode Incognito tersebut dan anda sudah bisa
                        melihat dokumen Laporan Bulanan tanpa harus mendownloadnya terlebih dahulu</h6>
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div> --}}

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
                url: "/api/laporan/bulanan/table/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $("#tampil-tbody").empty();
                    var date = getDateTime();
                    res.show.forEach(item => {
                        var updet = new Date(item.updated_at).toLocaleString("sv-SE").substring(0, 10);
                        content = `<tr id="data` + item.id + `">`;
                        content += `<td><center>
                              <div class='btn-group'>
                                <button type='button' class='btn btn-sm btn-link btn-icon dropdown-toggle hide-arrow' data-bs-toggle='dropdown' aria-expanded='false'>${item.id}</button>
                                <ul class='dropdown-menu dropdown-menu-end'>
                                  <li><a href='javascript:void(0);' class='dropdown-item text-success' onclick="window.location.href='{{ url('berkas/laporan/bulanan/`+item.id+`') }}'"><i class="fa-fw fas fa-download nav-icon"></i> Download</a></li>`;
                        if (item.ket_verif != null) {
                            content +=
                                `<li><a href="javascript:void(0); class='dropdown-item text-info' onclick="ketLihat(` +
                                item.id +
                                `)"><i class="fa-fw fas fa-sticky-note nav-icon"></i> Keterangan</a></li>`;
                        } else {
                            content +=
                                `<li><a href="javascript:void(0);" class='dropdown-item text-secondary' disabled><i class="fa-fw fas fa-sticky-note nav-icon"></i> Keterangan</a></li>`;
                        }
                        if (updet == date) {
                            content +=
                                `<li><a href="javascript:void(0);" class='dropdown-item text-warning' onclick="showUbah(` +
                                item.id +
                                `)"><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                                <li><a href='javascript:void(0);' class='dropdown-item text-danger' onclick="hapus(` +
                                item.id +
                                `)"><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                        } else {
                            content +=
                                `<li><a href="javascript:void(0);" class='dropdown-item text-secondary' disabled><i class="fa-fw fas fa-edit nav-icon"></i> Ubah</a></li>
                                                <li><a href='javascript:void(0);' class='dropdown-item text-secondary' disabled><i class="fa-fw fas fa-trash nav-icon"></i> Hapus</a></li>`;
                        }
                        content += `</ul></div></center></td>`;
                        content += `<td>` + item.judul + ` `;
                        res.verif.forEach(valver => {
                            if (valver.lap_id == item.id) {
                                content += `<i class="ti ti-checkbox text-primary" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top"data-bs-html="true" title="Laporan Terverifikasi"></i>`;
                            }
                        });
                        content += `</td><td>` + item.bln + ` / ` + item.thn + `</td><td>`;
                        if (item.ket != null) {
                            content += item.ket;
                        }
                        content += `</td><td>` + new Date(item.updated_at).toLocaleString("sv-SE") + `</td>`;
                        content += `</tr>`;
                        $('#tampil-tbody').append(content);
                    });
                    var table = $('#dttable').DataTable({
                        order: [
                            [4, "desc"]
                        ],
                        displayLength: 7,
                        lengthChange: true,
                        lengthMenu: [7, 10, 25, 50, 75, 100],
                        buttons: ['copy', 'excel', 'pdf', 'colvis']
                    });

                    // Showing Tooltip
                    $('[data-bs-toggle="tooltip"]').tooltip({
                        trigger : 'hover'
                    })
                }
            });

        });

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

        function tambah() {
            $("#btn-tambah").prop('disabled', true);
            $("#btn-tambah").find("i").toggleClass("fa-plus fa-sync fa-spin");
            $.ajax({
                url: "/api/laporan/bulanan/formupload/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    if (res === 1) {
                        $('#tambah').modal('show');
                    } else {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Anda tidak memiliki Hak Akses Tambah Laporan Bulanan, silakan hubungi IT',
                            position: 'topRight'
                        });
                    }
                    $("#btn-tambah").prop('disabled', false);
                    $("#btn-tambah").find("i").removeClass("fa-sync fa-spin").addClass("fa-plus");
                },
                error: function(res) {}
            });
        }

        function verif() {
            $("#btn-verif").prop('disabled', true);
            $("#btn-verif").find("i").toggleClass("fa-history fa-sync fa-spin");
            $.ajax({
                url: "/api/laporan/bulanan/formverif/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    if (res === 1) {
                        window.location.href = "./bulanan/verif";
                    } else {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Akses Laporan Bawahan tidak ditemukan, silakan hubungi IT',
                            position: 'topRight'
                        });
                    }
                    $("#btn-verif").prop('disabled', false);
                    $("#btn-verif").find("i").removeClass("fa-sync fa-spin").addClass("fa-history");
                },
                error: function(res) {}
            });
        }

        function saveData() {
            $("#tambah").one('submit', function() {
                $("#btn-simpan").attr('disabled', 'disabled');
                $("#btn-simpan").find("i").toggleClass("fa-save fa-spinner fa-spin");
                return true;
            });
        }

        function showUbah(id) {
            $('#ubah').modal('show');
            $.ajax({
                url: "/api/laporan/bulanan/getubah/" + id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // var tgl = res.tgl + 'T' + res.waktu;
                    document.getElementById('show_edit').innerHTML = "ID : " + res.show.id;
                    $("#id_edit").val(res.show.id);
                    $("#judul_edit").val(res.show.judul);
                    $("#ket_edit").val(res.show.ket);
                    $("#bln_edit").find('option').remove();
                    $("#thn_edit").find('option').remove();
                    for (c = 1; c < res.jml_bulan; c++) {
                        $("#bln_edit").append(`
                      <option value="${c}" ${c == res.show.bln? "selected":""}>` + res.bulan[c] + `</option>
                  `);
                    }
                    for (i = 2018; i <= res.tahun; i++) {
                        $("#thn_edit").append(`
                      <option value="${i}" ${i == res.show.thn? "selected":""}>${i}</option>
                  `);
                    }
                    $("#file_edit").empty();
                    $("#file_edit").append(`
                  <b><u><a href="./bulanan/${res.show.id}">${res.show.title}</a></u>&nbsp(${res.sizeFile} Mb)</b>
              `);
                    // document.getElementById('tgl_edit').innerHTML = res.sizeFile;
                }
            });
        }

        function ubah() {
            $("#btn-simpan-edit").attr('disabled', 'disabled');
            $("#btn-simpan-edit").find("i").toggleClass("fa-save fa-spinner fa-spin");

            var id = $("#id_edit").val();
            var judul = $("#judul_edit").val();
            var ket = $("#ket_edit").val();
            var bln = $("#bln_edit").val();
            var thn = $("#thn_edit").val();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '/api/laporan/bulanan/ubah/' + id,
                dataType: 'json',
                data: {
                    id: id,
                    judul: judul,
                    ket: ket,
                    bln: bln,
                    thn: thn,
                },
                success: function(res) {
                    $('#ubah').modal('hide');
                    fresh();
                    window.location.reload();
                }
            });
        }

        function hapus(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Hapus Laporan Bulanan ID : ' + id,
                icon: 'warning',
                reverseButtons: false,
                showDenyButton: false,
                showCloseButton: false,
                showCancelButton: true,
                focusCancel: true,
                confirmButtonColor: '#FF4845',
                confirmButtonText: `<i class="fa fa-trash me-1" style="font-size:13px"></i> Hapus`,
                cancelButtonText: `<i class="fa fa-times me-1" style="font-size:13px"></i> Batal`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/api/laporan/bulanan/hapus/" + id,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Hapus Dokumen Laporan Bulanan berhasil pada ' + res,
                                position: 'topRight'
                            });
                            fresh();
                            window.location.reload();
                        },
                        error: function(res) {
                            Swal.fire({
                                title: `Gagal di hapus!`,
                                text: 'Pada ' + res,
                                icon: `error`,
                                showConfirmButton: false,
                                showCancelButton: false,
                                allowOutsideClick: true,
                                allowEscapeKey: true,
                                timer: 3000,
                                timerProgressBar: true,
                                backdrop: `rgba(26,27,41,0.8)`,
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection
