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
                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#tambah"><i
                        class="mdi mdi-microsoft-excel"></i>&nbsp;&nbsp;Tambah Data</button>
                <button type="button" class="btn btn-outline-warning" data-bs-toggle="tooltip" data-bs-offset="0,4"
                    data-bs-placement="bottom" data-bs-html="true"
                    title="<i class='fa-fw fas fa-sync nav-icon'></i> <span>Segarkan Tabel</span>" onclick="refresh()">
                    <i class="fa-fw fas fa-sync nav-icon"></i></button>
            </div>
        </h4>
        <hr>
        <table id="dttable" class="table dt-responsive table-hover w-100 align-middle">
            <thead>
                <tr>
                    <th>KORBAN</th>
                    <th>UNIT</th>
                    <th>LOKASI</th>
                    <th>TGL</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody style="text-transform: capitalize">
                @if (count($list['show']) > 0)
                    {{-- <div hidden>{{ $id = 1 }}</div> --}}
                    @foreach ($list['show'] as $item)
                        <tr>
                            <td>{{ $item->korban }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->lokasi }}</td>
                            <td>{{ $item->tgl }}</td>
                            <td>
                                <center>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#ubah{{ $item->id }}"><i
                                                class="fa-fw fas fa-edit nav-icon"></i></button>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#show{{ $item->id }}"><i
                                                class="fa-fw fas fa-folder-open nav-icon text-white"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#hapus{{ $item->id }}"><i
                                                class="fa-fw fas fa-trash nav-icon"></i></button>
                                    </div>
                                    {{-- @if ($item->verifikasi == null)
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#ubah{{ $item->id }}"><i
                                                    class="fa-fw fas fa-edit nav-icon"></i></button>
                                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#show{{ $item->id }}"><i
                                                    class="fa-fw fas fa-folder-open nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#hapus{{ $item->id }}"><i
                                                    class="fa-fw fas fa-trash nav-icon"></i></button>
                                        </div>
                                    @else
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-secondary btn-sm" disabled><i
                                                    class="fa-fw fas fa-edit nav-icon"></i></button>
                                            <button type="button" class="btn btn-secondary btn-sm"><i
                                                    class="fa-fw fas fa-folder-open nav-icon text-white"></i></button>
                                            <button type="button" class="btn btn-secondary btn-sm" disabled><i
                                                    class="fa-fw fas fa-trash nav-icon"></i></button>
                                        </div>
                                    @endif --}}
                                </center>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
            <tfoot class="bg-whitesmoke">
                <tr>
                    <th>KORBAN</th>
                    <th>UNIT</th>
                    <th>LOKASI</th>
                    <th>TGL</th>
                    <th>AKSI</th>
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
                        <i class="mdi mdi-microsoft-excel"></i> Form Upload
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-auth-small" name="formTambah" action="{{ route('manrisk.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <h4>A. Identifikasi Kecelakaan</h4>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Waktu :</label>
                                        <input type="text" class="form-control flatpickrtime" name="tgl"
                                            placeholder="YYYY-MM-DD HH:MM" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Lokasi : </label>
                                        <input type="text" name="lokasi" id="lokasi" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Jenis Kecelakaan : </label>
                                <select onchange="jenisBtn()" class="select2 form-select" name="jenis" id="jenis"
                                    required>
                                    <option value="">Pilih</option>
                                    <option value="1">Menabrak</option>
                                    <option value="2">Tertabrak</option>
                                    <option value="3">Terperangkap</option>
                                    <option value="4">Terbentur / Terpukul</option>
                                    <option value="5">Tergelincir</option>
                                    <option value="6">Terjepit</option>
                                    <option value="7">Tersangkut</option>
                                    <option value="8">Tertimbun</option>
                                    <option value="9">Terhirup</option>
                                    <option value="10">Tenggelam</option>
                                    <option value="11">Jatuh dari ketinggian yang sama</option>
                                    <option value="12">Jatuh dari ketinggian yang berbeda</option>
                                    <option value="13">Kontak dengan (Arus Listrik, Suhu Panas, Suhu Dingin, Terpapar
                                        Radiasi, Bahan Kimia Berbahaya)</option>
                                    <option value="14">Lain-lain</option>
                                </select>
                            </div>
                            <div id="lainlain" class="row" hidden>
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Lain-lain :</label>
                                        <textarea class="form-control" name="lain1" id="lain1" placeholder="" maxlength="190" rows="8"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Kronologi Kecelakaan :</label>
                                        <textarea class="form-control" name="kronologi" id="kronologi1" placeholder="" maxlength="190" rows="8"></textarea>
                                        <span class="help-block">
                                            <p id="maxkronologi1" class="help-block "></p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <h4>B. Kerugian</h4>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Kerugian Pada Manusia : </label>
                                        <button class="btn btn-xs btn-outline-dark" type="button"
                                            data-bs-toggle="collapse" href="#lihat" role="button"
                                            aria-expanded="false" aria-controls="lihat">Lihat</button>
                                        <select onchange="infoBtn()" class="select2 form-select" name="kerugian"
                                            id="kerugian" required>
                                            <option value="">Pilih</option>
                                            <option value="1">Tak Cedera</option>
                                            <option value="2">Cedera Ringan</option>
                                            <option value="3">Cedera Sedang</option>
                                            <option value="4">Cedera Berat</option>
                                            <option value="5">Meninggal/Fatal</option>
                                        </select>
                                        <div id="defaultFormControlHelp" class="form-text">Tombol Lihat untuk melihat
                                            Keterangan</div>
                                    </div>
                                    <div class="collapse" id="lihat">
                                        <div class="d-grid d-sm-flex p-3 border">
                                            <div class="table-responsive text-nowrap mb-3">
                                                <table class="table table-borderless">
                                                    <tbody>
                                                        <tr>
                                                            <td>Tak Cedera</td>
                                                            <td
                                                                style="word-wrap: break-word;min-width: 160px;white-space:normal;">
                                                                Tidak ada cedera dan tidak ada hilang hari kerja</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cedera Ringan</td>
                                                            <td
                                                                style="word-wrap: break-word;min-width: 160px;white-space:normal;">
                                                                Mengalami cedera ringan/mendapat P3K tapi tidak ada hilang
                                                                hari kerja</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cedera Sedang</td>
                                                            <td
                                                                style="word-wrap: break-word;min-width: 160px;white-space:normal;">
                                                                Mengalami cedera yang memerlukan pertolongan medis tapi
                                                                adanya hilang hari kerja</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Cedera Berat</td>
                                                            <td
                                                                style="word-wrap: break-word;min-width: 160px;white-space:normal;">
                                                                Mengalami cedera yang memerlukan pertolongan medis dan atau
                                                                rujukan medis, cacat sementara dan adanya hilang hari kerja
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Meninggal/Fatal</td>
                                                            <td
                                                                style="word-wrap: break-word;min-width: 160px;white-space:normal;">
                                                                Mengalami cacat permanen atau kematian</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Nama Korban : </label>
                                        <input type="text" name="korban" id="korban" class="form-control"
                                            placeholder="" required>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Tanggal Lahir :</label>
                                        <input type="text" name="lahir" class="form-control flatpickr"
                                            placeholder="YYYY-MM-DD">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Jenis Kelamin</label>
                                        <select id="jk" name="jk" class="select2 form-select" required>
                                            <option value="">Pilih</option>
                                            <option value="laki-laki">Laki-laki</option>
                                            <option value="perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <label>Unit :</label>
                                    <input type="text" name="unit" class="form-control" value="" hidden>
                                </div>
                            </div>
                            <div class="form-group mb-3">
                                <label>Bila cedera / cacat, anggota tubuh mana yang terkena? </label>
                                <input type="text" name="cedera" id="cedera" class="form-control"
                                    placeholder="">
                            </div>
                            <div class="form-group mb-3">
                                <label>Penanganan </label>
                                <textarea class="form-control" name="penanganan" id="penanganan1" placeholder="" maxlength="190" rows="8"></textarea>
                                <span class="help-block">
                                    <p id="maxpenanganan1" class="help-block "></p>
                                </span>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Kerugian Aset/Material/Proses : </label>
                                        <input type="text" name="k_aset" id="k_aset" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Kerugian Lingkungan : </label>
                                        <input type="text" name="k_lingkungan" id="k_lingkungan" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>
                            <h4>C. Investigasi Kecelakaan</h4>
                            <hr>
                            <h5>1. Penyebab Langsung</h5>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Tindakan Tidak Aman <i>(Unsafe Action)</i> : </label>
                                        <input type="text" name="tta" id="tta" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Kondisi Tidak Aman <i>(Unsafe Condition)</i> : </label>
                                        <input type="text" name="kta" id="kta" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h5>2. Penyebab Dasar</h5>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Faktor Personal : </label>
                                        <input type="text" name="f_personal" id="f_personal" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group mb-3">
                                        <label>Faktor Pekerjaan : </label>
                                        <input type="text" name="f_pekerjaan" id="f_pekerjaan" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <h5>3. Alat / Sumber Yang Terlibat Pada Kecelakaan</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Peralatan Kerja : </label>
                                        <input type="text" name="p_kerja" id="p_kerja" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Benda Bergerak : </label>
                                        <input type="text" name="benda_bergerak" id="benda_bergerak"
                                            class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Mesin : </label>
                                        <input type="text" name="mesin" id="mesin" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Bejana Tekan : </label>
                                        <input type="text" name="bejana_tekan" id="bejana_tekan" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Material : </label>
                                        <input type="text" name="material" id="material" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Alat Listrik : </label>
                                        <input type="text" name="alat_listrik" id="alat_listrik" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Alat Berat : </label>
                                        <input type="text" name="alat_berat" id="alat_berat" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Radiasi : </label>
                                        <input type="text" name="radiasi" id="radiasi" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Kendaraan : </label>
                                        <input type="text" name="kendaraan" id="kendaraan" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Binatang : </label>
                                        <input type="text" name="binatang" id="binatang" class="form-control"
                                            placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label>Lain-lain : </label>
                                        <textarea class="form-control" name="lain2" id="lain2" placeholder="" maxlength="190" rows="8"></textarea>
                                    </div>
                                </div>
                            </div>
                            <h4>D. Rencana Tindakan Perbaikan</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label>Rencana Tindakan : </label>
                                        <textarea class="form-control" name="r_tindakan" id="r_tindakan" placeholder="" maxlength="190" rows="8"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label>Target Waktu : </label>
                                        <textarea class="form-control" name="t_waktu" id="t_waktu" placeholder="" maxlength="190" rows="8"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label>Wewenang : </label>
                                        <textarea class="form-control" name="wewenang" id="wewenang" placeholder="" maxlength="190" rows="8"></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <label>Lampiran : </label>
                                <input type="file" name="file" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">

                    <button class="btn btn-primary" id="btn-simpan" onclick="saveData()"><i
                            class="fa-fw fas fa-save nav-icon"></i> Upload</button>
                    </form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                </div>
            </div>
        </div>
    </div>

@endsection
