@extends('layouts.default')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Aset & Gudang - Daftar Barang</h4>
            </div>
        </div>
    </div>

    <div class="card">

        <div class="card-body border-bottom">
            <div class="d-flex align-items-center">
                <h5 class="mb-0 card-title flex-grow-1">Inventaris Barang</h5>
                <div class="flex-shrink-0">
                    <a href="#!" class="btn btn-primary">Tambah Barang</a>
                    <a href="#!" class="btn btn-light"><i class="mdi mdi-refresh"></i></a>
                    <div class="dropdown d-inline-block">

                        <button type="menu" class="btn btn-success" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="mdi mdi-dots-vertical"></i></button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body border-bottom">
            <div class="row g-3">
                <div class="col-xxl-4 col-lg-6">
                    <input type="search" class="form-control" id="searchTableList" placeholder="Search for ...">
                </div>
                <div class="col-xxl-2 col-lg-6">
                    <select class="form-select" id="idStatus" aria-label="Default select example">
                        <option value="all">Status</option>
                        <option value="Active">Active</option>
                        <option value="New">New</option>
                        <option value="Close">Close</option>
                    </select>
                </div>
                <div class="col-xxl-2 col-lg-4">
                    <select class="form-select" id="idType" aria-label="Default select example">
                        <option value="all">Select Type</option>
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                    </select>
                </div>
                <div class="col-xxl-2 col-lg-4">
                    <div id="datepicker1">
                        <input type="text" class="form-control" placeholder="Select date" data-date-format="dd M, yyyy" data-date-container='#datepicker1' data-date-autoclose="true" data-provide="datepicker">
                    </div><!-- input-group -->
                </div>
                <div class="col-xxl-2 col-lg-4">
                    <button type="button" class="btn btn-secondary w-100" onclick="" disabled><i class="mdi mdi-filter-outline align-middle"></i> Filter</button>
                </div>
            </div>
        </div>
        <div class="card-body" style="overflow: visible;">
            <div class="table-responsive" style="border: 0px">
                <table class="table align-middle dt-responsive w-100 table-check" id="job-list">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">No Inventaris</th>
                            <th scope="col">Nama Sarana</th>
                            <th scope="col">Merk Sarana</th>
                            <th scope="col">Type</th>
                            <th scope="col">No Seri</th>
                            <th scope="col">Lokasi Ruang</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Kalibrasi</th>
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
                            <th scope="col">Keterangan</th>
                            <th scope="col">Tgl Input</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                </table>
                <!-- end table -->
            </div>
            <!-- end table responsive -->
        </div>

    </div>
    <script>
        $(document).ready(function() {

        })
    </script>
@endsection
