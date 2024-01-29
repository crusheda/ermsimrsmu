@extends('layouts.default')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">MFK - Manajemen Risiko</h4>
            </div>
        </div>
    </div>

    <div class="card card-body table-responsive">
        <h4 classs="card-title">
            <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#tambah"><i
                    class="tf-icon bx bx-upload"></i>&nbsp;&nbsp;Upload Berkas Excell</button>
        </h4>
        <hr>
        <table id="dttable" class="table dt-responsive table-hover w-100 align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>KEGIATAN</th>
                    <th>KETUA</th>
                    <th>WAKTU</th>
                    <th>LOKASI</th>
                    <th>KET</th>
                    <th>UPDATE</th>
                    <th>USER</th>
                    <th>
                        <center>#</center>
                    </th>
                </tr>
            </thead>
            <tbody id="tampil-tbody">
                <tr>
                    <td colspan="9">
                        <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center>
                    </td>
                </tr>
            </tbody>
            <tfoot class="bg-whitesmoke">
                <tr>
                    <th>ID</th>
                    <th>KEGIATAN</th>
                    <th>KETUA</th>
                    <th>WAKTU</th>
                    <th>LOKASI</th>
                    <th>KET</th>
                    <th>UPDATE</th>
                    <th>USER</th>
                    <th>
                        <center>#</center>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>

    {{-- MODAL START --}}
    <div class="modal fade bd-example-modal-lg" id="tambah" role="dialog" aria-labelledby="confirmFormLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Upload
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-auth-small" name="formTambah" action="{{ route('rapat.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">Kegiatan</label>
                                    <input type="text" name="nama" id="nama" class="form-control"
                                        placeholder="e.g. Rapat Unit IT" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">Ketua Rapat</label>
                                    <select class="select2 form-control" name="kepala" style="width: 100%" required>
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">Tanggal</label>
                                    <input class="form-control flatpickr" name="tanggal" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="mb-2">Lokasi Rapat</label>
                                    <input type="text" name="lokasi" id="lokasi" class="form-control"
                                        placeholder="e.g. Ruang IT" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label class="mb-2">Keterangan</label>
                            <textarea maxlength="200" rows="3" placeholder="Keterangan terbatas hanya 200 karakter." class="form-control"
                                name="keterangan" id="keterangan" placeholder="Optional"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="mb-2">Upload</label>
                            <input type="file" class="form-control mb-2" name="file2[]" id="file2" multiple required>
                            <i class="fa-fw fas fa-caret-right nav-icon"></i> File yang diupload berupa Dokumen dan bisa
                            lebih dari satu file<br>
                            <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum setiap file adalah
                            <strong>5 mb</strong>
                        </div>
                </div>
                <div class="modal-footer">

                    <button class="btn btn-primary" id="btn-simpan" onclick="saveData()"><i
                            class="fa-fw fas fa-upload nav-icon"></i> Upload</button>
                    </form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ubah" role="dialog" aria-labelledby="confirmFormLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Ubah Berkas&nbsp;<kbd><a id="show_edit"></a></kbd>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="id_edit" class="form-control" hidden>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="mb-2">Kegiatan :</label>
                                <input type="text" id="nama_edit" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="mb-2">Ketua Rapat : </label><br>
                                <select class="form-control select2" id="kepala_edit" style="width: 100%"
                                    required></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="mb-2">Tanggal :</label>
                                <input type="text" id="tanggal_edit" class="form-control flatpickr"
                                    placeholder="Tanggal Rapat" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="mb-2">Lokasi Rapat :</label>
                                <input type="text" id="lokasi_edit" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mb-2">Keterangan :</label>
                        <textarea  maxlength="200" rows="3" placeholder="Keterangan terbatas hanya 200 karakter." class="form-control" id="keterangan_edit" ></textarea>
                    </div>
                    <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Waktu pengubahan berkas rapat hanya berlaku pada
                        hari saat anda mengupload</sub><br>
                    <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Periksa ulang lampiran berkas anda, apabila
                        terdapat kesalahan upload dokumen mohon hapus dan upload ulang</sub>

                </div>
                <div class="modal-footer">
                    Ditambahkan oleh&nbsp;<a id="user_edit"></a>
                    <button class="btn btn-primary" id="submit_edit" onclick="ubah()"><i
                            class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                    </form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

        })
    </script>

@endsection
