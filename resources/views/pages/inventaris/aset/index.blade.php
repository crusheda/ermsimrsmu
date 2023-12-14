@extends('layouts.default')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Aset & Gudang - Daftar Sarana</h4>
            </div>
        </div>
    </div>

    <div class="card">

        <div class="card-body border-bottom">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 card-title flex-grow-1">Inventaris</h5>
                <div class="flex-shrink-0">
                    <div class="hstack gap-3 ms-auto">
                        <div class="btn-group">
                            <button class="btn btn-primary" onclick="tambah()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Menambahkan Aset / Sarana"><i class='bx bx-plus scaleX-n1-rtl'></i> Tambah Sarana</button>
                            <button class="btn btn-light" onclick="refresh()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                            title="Refresh Tabel Sarana"><i class="mdi mdi-refresh"></i></button>
                        </div>
                        <div class="vr"></div>
                        <div class="dropdown d-inline-block">
                            <button type="menu" class="btn btn-success" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i> Menu</button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="{{ route('aset_ruangan.index') }}">Daftar Ruangan</a></li>
                                {{-- <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body border-bottom">
            <div class="row g-3">
                <div class="col-xxl-4 col-lg-6">
                    <input type="search" class="form-control" id="searchTableList" placeholder="Cari Sarana ...">
                </div>
                <div class="col-xxl-2 col-lg-6">
                    <select class="form-select" id="idStatus" aria-label="Default select example">
                        <option value="" selected hidden>Jenis Sarana</option>
                        <option value="1">Medis</option>
                        <option value="2">Non Medis</option>
                    </select>
                </div>
                <div class="col-xxl-2 col-lg-4">
                    <select class="form-select" id="idType" aria-label="Default select example">
                        <option value="" selected hidden>Pilih Lokasi</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                    </select>
                </div>
                <div class="col-xxl-2 col-lg-4">
                    <div id="datepicker1">
                        <input type="text" class="form-control" placeholder="Tanggal Aset" data-date-format="dd M, yyyy" data-date-container='#datepicker1' data-date-autoclose="true" data-provide="datepicker">
                    </div><!-- input-group -->
                </div>
                <div class="col-xxl-2 col-lg-4">
                    <button type="button" class="btn btn-secondary w-100" onclick="" disabled><i class="mdi mdi-filter-outline align-middle"></i> Tampilkan</button>
                </div>
            </div>
        </div>
        <div class="card-body" style="overflow: visible;">
            <div class="table-responsive" style="border: 0px">
                <table class="table align-middle dt-responsive w-100 table-check" id="job-list">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col"></th>
                            <th scope="col">No Inventaris</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Type</th>
                            <th scope="col">No Seri</th>
                            <th scope="col">Lokasi/Ruang</th>
                            <th scope="col">Jenis</th>
                            {{-- <th scope="col">Kalibrasi</th>
                            <th scope="col">No Kalibrasi</th>
                            <th scope="col">Tgl Berlaku</th>
                            <th scope="col">Tgl Operasi</th>
                            <th scope="col">Tgl Perolehan</th>
                            <th scope="col">Asal Perolehan</th>
                            <th scope="col">Nilai Perolehan</th>
                            <th scope="col">Kondisi</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Golongan</th>
                            <th scope="col">Umur</th>
                            <th scope="col">Tarif</th>
                            <th scope="col">Penyusutan Per Bulan</th>
                            <th scope="col">Keterangan</th> --}}
                            <th scope="col">Tgl Input</th>
                        </tr>
                    </thead>
                </table>
                <!-- end table -->
            </div>
            <!-- end table responsive -->
        </div>

        <!--TAMBAH ASET -->
        <div class="modal fade" tabindex="-1" id="modalTambah" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderdetailsModalLabel">Tambah Sarana</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-label">Tgl. Surat</label>
                                    <input type="text" id="tempat" class="form-control" placeholder="e.g. Hotel Syariah Surakarta">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fa fa-times"></i>&nbsp;&nbsp;Batal</button>
                        <button class="btn btn-info" onclick="masukKeranjang()" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                            title="Simpan Data Aset Barang"><i
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

        })

        // FUNCTION AREA
        function tambah() {
            $('#modalTambah').modal('show');
        }

        function refresh() {
            $('.modal').modal('hide');
        }
    </script>
@endsection
