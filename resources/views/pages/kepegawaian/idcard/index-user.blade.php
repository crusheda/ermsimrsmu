@extends('layouts.index')

@section('content')

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Kepegawaian</li>
                        <li class="breadcrumb-item">Pengajuan</li>
                        <li class="breadcrumb-item" aria-current="page">ID Card</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Pengajuan ID Card</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body border-bottom">
                    <h5>Form Pengajuan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-12 col-xxl-6">
                            <div class="address-check border rounded">
                                <div class="form-check" style="background-image: url(/images/application/img-pay-card-bg.png)">
                                    <input type="radio" name="pengajuan" class="form-check-input input-primary" id="idcard1" value="1">
                                    <label class="form-check-label d-block" for="idcard1">
                                        <span class="card-body p-3 d-block">
                                            <span class="h5 mb-3 d-block">ID Card Baru</span>
                                            <span class="d-flex align-items-center">
                                            <span class="f-12 badge bg-secondary me-3">Rp 0 ,-</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-xxl-6">
                            <div class="address-check border rounded">
                                <div class="form-check" style="background-image: url(/images/application/img-pay-card-bg.png)">
                                    <input type="radio" name="pengajuan" class="form-check-input input-primary" id="idcard2" value="2">
                                    <label class="form-check-label d-block" for="idcard2">
                                        <span class="card-body p-3 d-block">
                                            <span class="h5 mb-3 d-block">Ganti ID Card Lama</span>
                                            <span class="d-flex align-items-center">
                                            <span class="f-12 badge bg-primary me-3">Rp 25.000 ,-</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="divider"><span>Isian Wajib</span></div>
                    <div class="row">
                        <div class="col-12 mt-2">
                            <div class="mb-3 row">
                                <label class="col-lg-4 col-form-label">Nama Lengkap (<mark>Beserta Gelar</mark>) & Panggilan
                                    <small class="text-muted d-block">Periksa nama lengkap dan gelar Anda</small>
                                </label>
                                <div class="col-lg-8">
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="text" class="form-control" placeholder="Nama Lengkap">
                                        </div>
                                        <div class="col-4">
                                            <input type="text" class="form-control" placeholder="Nama Panggilan">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-lg-4 col-form-label">Nomor Induk Pegawai (<mark>NIP</mark>)
                                    <small class="text-muted d-block">Konfirmasi kepegawaian apabila nomor <b>NIP</b> kosong</small>
                                </label>
                                <div class="col-lg-8"><input type="text" class="form-control"></div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-lg-4 col-form-label">Jabatan
                                    <small class="text-muted d-block">Enter the 3 or 4 digit number on the card</small>
                                </label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                            <div class="text-end btn-page mb-0 mt-4">
                                <button class="btn btn-outline-secondary">Bersihkan</button>
                                <button class="btn btn-primary">Ajukan Sekarang</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mb-3">
                {{-- <button class="btn btn-link-primary"><i class="ti ti-arrow-narrow-left align-text-bottom me-2"></i>Back to Shipping Information</button> --}}
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header new-cust-card">
                    <h5>Riwayat Pengajuan</h5>
                </div>
                <div data-simplebar style="max-height: 500px;">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="d-flex align-items-start">
                                    {{-- <img class="bg-light rounded img-fluid wid-60 flex-shrink-0"
                                        src="../assets/images/application/img-prod-2.jpg"
                                        alt="User image"> --}}
                                    <div class="flex-grow-1 mx-2">
                                        <h5 class="mb-1">Pengajuan ID Card Baru</h5>
                                        <p class="text-muted text-sm mb-2">Yussuf Faisal</p>
                                        <h5 class="mb-1">
                                            <b>Rp 0,-</b>
                                        </h5>
                                    </div>
                                    <a href="#" class="avtar avtar-s btn-link-danger btn-pc-default flex-shrink-0">
                                        <i class="ti ti-checkbox f-20"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL START --}}
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

        });

        function saveData() {
            $("#tambah").one('submit', function() {
                $("#btn-simpan").attr('disabled', 'disabled');
                $("#btn-simpan").find("i").toggleClass("fa-upload fa-sync fa-spin");
                return true;
            });
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
