@extends('layouts.default')

@section('content')
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">ASET & GUDANG - SARANA</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="fw-semibold text-center">SCAN - <b>QR CODE</b></h5>
                        <center><div class="mb-3" id="qr"><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses QR Code...</div></center>
                        {{-- <div class="mb-3">
                            <center>
                                {!! DNS2D::getBarcodeHTML($list['show']->token, 'QRCODE',5,5) !!}
                            </center>
                        </div> --}}
                    {{-- <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="col">Job Title</th>
                                    <td scope="col">Magento Developer</td>
                                </tr>
                                <tr>
                                    <th scope="row">Experience:</th>
                                    <td>0-2 Years</td>
                                </tr>
                                <tr>
                                    <th scope="row">Vacancy</th>
                                    <td>12</td>
                                </tr>
                                <tr>
                                    <th scope="row">Job Type</th>
                                    <td><span class="badge badge-soft-success">Full Time</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">Status</th>
                                    <td><span class="badge badge-soft-info">New</span></td>
                                </tr>
                                <tr>
                                    <th scope="row">Posted Date</th>
                                    <td>25 June, 2022</td>
                                </tr>
                                <tr>
                                    <th scope="row">Close Date</th>
                                    <td>13 April, 2022</td>
                                </tr>
                            </tbody>
                        </table>
                    </div> --}}
                    <div class="hstack gap-2">
                        <button class="btn btn-soft-dark w-100" onclick="window.location='{{ route('aset.index') }}'"><i class="bx bx-caret-left scaleX-n1-rtl"></i> Kembali</button>
                        <button class="btn btn-soft-info w-100" disabled><i class="bx bx-download scaleX-n1-rtl"></i> Download</button>
                        <button class="btn btn-soft-warning w-100" onclick="cetak()"><i class="bx bx-printer scaleX-n1-rtl"></i> Cetak</button>
                        <a class="btn btn-soft-success w-100" href="javascript:void(0);" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-caret-down align-middle'></i>&nbsp;&nbsp;Menu
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="javascript:void(0);" onclick="modalPemeliharaan({{ $list['show']->id }})">Pemeliharaan</a>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="modalMutasi({{ $list['show']->id }})">Mutasi</a>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="modalPeminjaman()">Peminjaman</a>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="modalPengembalian()">Pengembalian</a>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="modalPenarikan({{ $list['show']->id }})">Penarikan</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div id="kondisi_aset">
                                <div class="spinner-border text-primary m-1" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        {{-- @if ($list['show']->kondisi == 1)
                            <div class="avatar-md mx-auto mb-3">
                                <div class="avatar-title bg-light rounded-circle text-primary h1">
                                    <i class="fas fa-check"></i>
                                </div>
                            </div>
                            <p class="text-primary mb-0"><b>Kondisi Baik</b></p>
                        @else
                            @if ($list['show']->kondisi == 2)
                                <div class="avatar-md mx-auto mb-3">
                                    <div class="avatar-title bg-warning rounded-circle text-light h1">
                                        <i class="fas fa-minus"></i>
                                    </div>
                                </div>
                                <p class="text-warning mb-0"><b>Kondisi Cukup</b></p>
                            @else
                                @if ($list['show']->kondisi == 3)
                                    <div class="avatar-md mx-auto mb-3">
                                        <div class="avatar-title bg-danger rounded-circle text-light h1">
                                            <i class="fas fa-times"></i>
                                        </div>
                                    </div>
                                    <p class="text-danger mb-0"><b>Kondisi Buruk</b></p>
                                @else
                                    <div class="avatar-md mx-auto mb-3">
                                        <div class="avatar-title bg-dark rounded-circle text-light h1">
                                            <i class="mdi mdi-email-open"></i>
                                        </div>
                                    </div>
                                    <p class="text-dark mb-0"><b>Kondisi Tidak Terdefinisi</b></p>
                                @endif
                            @endif
                        @endif --}}
                        {{-- <button class="btn btn-warning-outline btn-sm" onclick="showUpdateKondisi({{ $list['show']->kondisi }})" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="Kondisi Sekarang"><i class='bx bx-edit scaleX-n1-rtl'></i> Perbarui Kondisi</button> --}}
                        <hr>
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="mt-3">
                                    <p class="text-muted mb-1">Status Aset</p>
                                    <h5 id="status_aset"></h5>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mt-3">
                                    <p class="text-muted mb-1">Tgl. Beroperasi</p>
                                    <h6 class="mb-0">{{ Carbon\Carbon::parse($list['show']->tgl_operasi)->isoFormat('d MMM Y') }}</h6>
                                    <small class="text-success">{{ Carbon\Carbon::parse($list['show']->tgl_operasi)->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="bg-transparent mb-3">
                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#post-mutasi" role="tab">
                                    Mutasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#post-peminjaman" role="tab">
                                    Peminjaman
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#post-pengembalian" role="tab">
                                    Pengembalian
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        {{-- MUTASI --}}
                        <div class="tab-pane active" id="post-mutasi" role="tabpanel">
                            <div data-simplebar style="max-height: 376px;">
                                <ul class="verti-timeline list-unstyled">
                                    <li class="event-list">
                                        <div class="event-timeline-dot">
                                            <i class="bx bx-right-arrow-circle font-size-18"></i>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                @if (!empty($list['mutasi']->filename))
                                                    <img src="{{ url('storage/' . substr($list['mutasi']->filename, 7, 1000)) }}" alt="" class="avatar-xs rounded-circle">
                                                @else
                                                    <img class="avatar-xs rounded-circle" alt="" src="{{ url("images/no-image-person.png") }}">
                                                @endif
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <b>Charles Brown</b> applied for the job <b>Sr.frontend Developer</b>
                                                    <p class="mb-0 text-muted">3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{-- PEMINJAMAN --}}
                        <div class="tab-pane" id="post-peminjaman" role="tabpanel">
                            <div data-simplebar style="max-height: 376px;">
                                <ul class="verti-timeline list-unstyled">
                                    <li class="event-list">
                                        <div class="event-timeline-dot">
                                            <i class="bx bx-right-arrow-circle font-size-18"></i>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="assets/images/users/avatar-5.jpg" alt="" class="avatar-xs rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <b>Cdasdasdwn</b> applcxvxcvcxhe job <b>Sr.fronvcbvcbcvbvcvbvvcend Developer</b>
                                                    <p class="mb-0 text-muted">1 hour ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{-- PENGEMBALIAN --}}
                        <div class="tab-pane" id="post-pengembalian" role="tabpanel">
                            <div data-simplebar style="max-height: 376px;">
                                <ul class="verti-timeline list-unstyled">
                                    <li class="event-list">
                                        <div class="event-timeline-dot">
                                            <i class="bx bx-right-arrow-circle font-size-18"></i>
                                        </div>
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="assets/images/users/avatar-5.jpg" alt="" class="avatar-xs rounded-circle">
                                            </div>
                                            <div class="flex-grow-1">
                                                <div>
                                                    <b>Cdasdasdwn</b>
                                                    <p class="mb-0 text-muted">6 hour ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- <ul class="list-unstyled mt-4">
                        <li>
                            <div class="d-flex">
                                <i class="bx bx-phone text-primary fs-4"></i>
                                <div class="ms-3">
                                    <h6 class="fs-14 mb-2">Phone</h6>
                                    <p class="text-muted fs-14 mb-0">+589 560 56555</p>
                                </div>
                            </div>
                        </li>
                        <li class="mt-3">
                            <div class="d-flex">
                                <i class="bx bx-mail-send text-primary fs-4"></i>
                                <div class="ms-3">
                                    <h6 class="fs-14 mb-2">Email</h6>
                                    <p class="text-muted fs-14 mb-0">themesbrand@gmail.com</p>
                                </div>
                            </div>
                        </li>
                        <li class="mt-3">
                            <div class="d-flex">
                                <i class="bx bx-globe text-primary fs-4"></i>
                                <div class="ms-3">
                                    <h6 class="fs-14 mb-2">Website</h6>
                                    <p class="text-muted fs-14 text-break mb-0">www.themesbrand.com</p>
                                </div>
                            </div>
                        </li>
                        <li class="mt-3">
                            <div class="d-flex">
                                <i class="bx bx-map text-primary fs-4"></i>
                                <div class="ms-3">
                                    <h6 class="fs-14 mb-2">Location</h6>
                                    <p class="text-muted fs-14 mb-0">Oakridge Lane Richardson.</p>
                                </div>
                            </div>
                        </li>
                    </ul> --}}
                    <div class="mt-4">
                        <a href="#!" class="btn btn-soft-primary btn-hover w-100 rounded"><i class="mdi mdi-eye"></i> Tampilkan Semua Riwayat</a>
                    </div>
                </div>
            </div>
        </div><!--end col-->
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex">
                        {{-- <img src="assets/images/companies/wechat.svg" alt="" height="50"> --}}
                        <div class="flex-grow-1">
                            <h5 class="fw-semibold"><kbd>ID : {{ $list['show']->id }}</kbd>&nbsp;&nbsp;{{ $list['show']->sarana }}</h5>
                            <h6>No. Inventaris : <a href="javascript:void(0);">{{ $list['show']->no_inventaris }}</a></h6>
                            <ul class="list-unstyled hstack gap-2 mb-0">
                                <li>
                                    <i class="fas fa-barcode"></i> <span class="text-muted">{{ $list['show']->no_seri }}</span>
                                </li>
                                <li>
                                    <i class="bx bx-map"></i> <span class="text-muted" id="ruangan_aset">{{ $list['show']->ruangan.' - '.$list['show']->lokasi }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="carouselExampleControls" class="carousel carousel-dark slide mb-3" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            @php
                                $lampiran = json_decode($list['show']->filename);
                            @endphp
                            @for ($i = 0; $i < count($lampiran); $i++)
                                <div class="carousel-item @if ($i == 0) active @endif">
                                    <center><img class="d-block img-fluid" style="max-height: 600px" src="{{ url('storage/'.substr($lampiran[$i],7,1000)) }}"></center>
                                </div>
                            @endfor
                            {{-- @foreach (json_decode($list['show']->filename) as $item)
                                <div class="carousel-item active">
                                    <img class="d-block img-fluid" src="{{ url('storage/'.substr($item,7,1000)) }}">
                                </div>
                            @endforeach --}}
                            {{-- <div class="carousel-item active">
                                <img class="d-block img-fluid" width="100%" src="{{ asset('/images/small/img-4.jpg') }}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid" width="100%" src="{{ asset('/images/small/img-5.jpg') }}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block img-fluid" width="100%" src="{{ asset('/images/small/img-6.jpg') }}" alt="Third slide">
                            </div> --}}
                        </div>
                        <br><img src="" alt="" srcset="" id="pdf_preview">
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon text-dark" aria-hidden="true"></span>
                            <span class="sr-only">Sebelumnya</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Selanjutnya</span>
                        </a>
                    </div>

                    <h5 class="fw-semibold mb-3">Description</h5>
                    <p class="text-muted">We are looking to hire a skilled Magento developer to build and maintain eCommerce websites for our clients. As a Magento developer, you will be responsible for liaising with the design team, setting up Magento 1x and 2x sites, building modules and customizing extensions, testing the performance of each site, and maintaining security and feature updates after the installation is complete.</p>

                    <h5 class="fw-semibold mb-3">Responsibilities:</h5>
                    <ul class="vstack gap-3">
                        <li>
                            Meeting with the design team to discuss the needs of the company.
                        </li>
                        <li>
                            Building and configuring Magento 1x and 2x eCommerce websites.
                        </li>
                        <li>
                            Coding of the Magento templates.
                        </li>
                        <li>
                            Developing Magento modules in PHP using best practices.
                        </li>
                        <li>
                            Designing themes and interfaces.
                        </li>
                        <li>
                            Setting performance tasks and goals.
                        </li>
                        <li>
                            Updating website features and security patches.
                        </li>
                    </ul>

                    <h5 class="fw-semibold mb-3">Requirements:</h5>
                    <ul class="vstack gap-3">
                        <li>
                            Bachelor’s degree in computer science or related field.
                        </li>
                        <li>
                            Advanced knowledge of Magento, JavaScript, HTML, PHP, CSS, and MySQL.
                        </li>
                        <li>
                            Experience with complete eCommerce lifecycle development.
                        </li>
                        <li>
                            Understanding of modern UI/UX trends.
                        </li>
                        <li>
                            Knowledge of Google Tag Manager, SEO, Google Analytics, PPC, and A/B Testing.
                        </li>
                        <li>
                            Good working knowledge of Adobe Photoshop and Adobe Illustrator.
                        </li>
                        <li>
                            Strong attention to detail.
                        </li>
                        <li>
                            Ability to project-manage and work to strict deadlines.
                        </li>
                        <li>
                            Ability to work in a team environment.
                        </li>
                    </ul>

                    <h5 class="fw-semibold mb-3">Qualification:</h5>
                    <ul class="vstack gap-3">
                        <li>
                            B.C.A / M.C.A under National University course complete.
                        </li>
                        <li>
                            3 or more years of professional design experience
                        </li>
                        <li>
                            Advanced degree or equivalent experience in graphic and web design
                        </li>
                    </ul>

                    <h5 class="fw-semibold mb-3">Skill & Experience:</h5>
                    <ul class="vstack gap-3 mb-0">
                        <li>
                            Understanding of key Design Principal
                        </li>
                        <li>
                            Proficiency With HTML, CSS, Bootstrap
                        </li>
                        <li>
                            WordPress: 1 year (Required)
                        </li>
                        <li>
                            Experience designing and developing responsive design websites
                        </li>
                        <li>
                            web designing: 1 year (Preferred)
                        </li>
                    </ul>

                    <div class="mt-4">
                        <span class="badge badge-soft-warning">PHP</span>
                        <span class="badge badge-soft-warning">Magento</span>
                        <span class="badge badge-soft-warning">Marketing</span>
                        <span class="badge badge-soft-warning">WordPress</span>
                        <span class="badge badge-soft-warning">Bootstrap</span>
                    </div>

                    <div class="mt-4">
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item mt-1">
                                Share this job:
                            </li>
                            <li class="list-inline-item mt-1">
                                <a href="javascript:void(0)" class="btn btn-outline-primary btn-hover"><i class="uil uil-facebook-f"></i> Facebook</a>
                            </li>
                            <li class="list-inline-item mt-1">
                                <a href="javascript:void(0)" class="btn btn-outline-danger btn-hover"><i class="uil uil-google"></i> Google+</a>
                            </li>
                            <li class="list-inline-item mt-1">
                                <a href="javascript:void(0)" class="btn btn-outline-success btn-hover"><i class="uil uil-linkedin-alt"></i> linkedin</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->

    {{----------------------------------------------------------- MODAL ---------------------------------------------------------------}}

    {{-- MODAL PEMELIHARAAN --}}
    <div class="modal fade" id="formPemeliharaan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Formulir Pemeliharaan Aset&nbsp;&nbsp;&nbsp;
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Petugas <a class="text-danger">*</a></label>
                                <div class="select2-dark">
                                    <select class="select2 form-select" id="petugas_pemeliharaan" data-allow-clear="false" data-bs-auto-close="outside" style="width: 100%" required>
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Hasil <a class="text-danger">*</a></label>
                                <textarea rows="2" id="hasil_pemeliharaan" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Rekomendasi <a class="text-danger">*</a></label>
                                <textarea rows="2" id="rekomendasi_pemeliharaan" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mb-3">
                    <div class="btn-group">
                        <button class="btn btn-soft-warning btn-rounded" onclick="refreshModalPemeliharaan()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Refresh Tabel Riwayat Pemeliharaan"><i class="fa fa-sync"></i>&nbsp;&nbsp;Refresh</button>
                        <button type="reset" class="btn btn-soft-secondary btn-rounded" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
                        <button class="btn btn-soft-primary btn-rounded" onclick="prosesPemeliharaan()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tambah Pemeliharaan Aset"><i class="fa fa-wrench"></i>&nbsp;&nbsp;Submit</button>
                    </div>
                </div>
                <hr>
                <div class="table-responsive text-nowrap" style="border: 0px;margin-left:20px;margin-right:20px">
                    <h4 class="card-title">Riwayat Pemeliharaan <mark>{{ $list['show']->sarana }}</mark></h4>
                    <p class="card-title-desc"><footer class="blockquote-footer">No. Inventaris <code>{{ $list['show']->no_inventaris }}</code></footer></p>
                    <p class="card-title-desc"><footer class="blockquote-footer">Penghapusan <strong>HANYA</strong> dapat dilakukan pada hari yang sama</footer></p>
                    <table class="table dt-responsive table-hover nowrap w-100" id="dttable-pemeliharaan">
                        <thead>
                            <tr>
                                <th scope="col"><center>Aksi</center></th>
                                <th scope="col">Petugas</th>
                                <th scope="col">Hasil</th>
                                <th scope="col">Rekomendasi</th>
                                <th scope="col">Ditambahkan</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody-pemeliharaan"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL MUTASI --}}
    <div class="modal fade" id="formMutasi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Formulir Mutasi Aset&nbsp;&nbsp;&nbsp;
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <div class="form-group">
                                <label class="form-label">Lokasi Awal</label>
                                <input type="text" id="lokasi_awal" value="" class="form-control" placeholder="" disabled/>
                            </div>
                        </div>
                        <div class="col-md-5 mb-3">
                            <div class="form-group">
                                <label class="form-label">Lokasi Tujuan (<strong>Ruangan - Lokasi</strong>) <a class="text-danger">*</a></label>
                                <div class="select2-dark">
                                    <select class="select2 form-select" id="lokasi_tujuan" data-allow-clear="false" data-bs-auto-close="outside" style="width: 100%" required>
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 mb-3">
                            <div class="form-group">
                                <label class="form-label">Kondisi <a class="text-danger">*</a></label>
                                <select class="form-select" id="kondisi_mutasi" required></select>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea rows="3" id="ket_mutasi" class="form-control" placeholder="Optional"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mb-3">
                    <div class="btn-group">
                        <button class="btn btn-soft-warning btn-rounded" onclick="refreshModalMutasi({{ $list['show']->id }})" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Refresh Tabel Riwayat Mutasi"><i class="fa fa-sync"></i>&nbsp;&nbsp;Refresh</button>
                        <button type="reset" class="btn btn-soft-secondary btn-rounded" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
                        <button class="btn btn-soft-primary btn-rounded" onclick="prosesMutasi({{ $list['show']->id }})" data-bs-toggle="tooltip"
                            data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title=""><i class="fas fa-luggage-cart"></i>&nbsp;&nbsp;Mutasi Aset</button>
                    </div>
                </div>
                <hr>
                <div class="table-responsive text-nowrap" style="border: 0px;margin-left:20px;margin-right:20px">
                    <h4 class="card-title">Riwayat Mutasi <mark>{{ $list['show']->sarana }}</mark></h4>
                    <p class="card-title-desc"><footer class="blockquote-footer">No. Inventaris <code>{{ $list['show']->no_inventaris }}</code></footer></p>
                    <p class="card-title-desc"><footer class="blockquote-footer">Ruangan Sekarang : <kbd id="ruangan_sekarang_mutasi"></kbd> - <kbd id="lokasi_sekarang_mutasi"></kbd></footer></p>
                    <p class="card-title-desc"><footer class="blockquote-footer">Pembatalan mutasi <strong>HANYA</strong> dapat dilakukan pada hari yang sama</footer></p>
                    <p class="card-title-desc"><footer class="blockquote-footer">Mutasi <mark>lebih dari satu</mark> pada hari yang sama <strong>HANYA</strong> dapat dibatalkan secara berurutan</footer></p>
                    <table class="table dt-responsive table-hover nowrap w-100" id="dttable-mutasi">
                        <thead>
                            <tr>
                                <th scope="col"><center>Aksi</center></th>
                                <th scope="col">Tgl Mutasi</th>
                                <th scope="col">Lokasi Awal</th>
                                <th scope="col">Lokasi Tujuan</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Kondisi</th>
                            </tr>
                        </thead>
                        <tbody id="tampil-tbody-mutasi"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PEMINJAMAN --}}
    <div class="modal fade" id="formPeminjaman" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Formulir Peminjaman Aset&nbsp;&nbsp;&nbsp;
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tgl. Peminjaman <a class="text-danger">*</a></label>
                                <input type="text" id="" class="form-control flatpickr" placeholder="YYYY-MM-DD"/>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Tgl. Pengembalian</label>
                                <input type="text" id="" class="form-control flatpickr" placeholder="YYYY-MM-DD"/>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Sarana <a class="text-danger">*</a></label>
                                <input type="text" id="" class="form-control" placeholder="e.g. xxx">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Nama Penanggungjawab <a class="text-danger">*</a></label>
                                <input type="text" id="" class="form-control" placeholder="e.g. xxx">
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Ruangan - Lokasi <a class="text-danger">*</a></label>
                                <div class="select2-dark">
                                    <select class="select2 form-select" id="" data-allow-clear="false" data-bs-auto-close="outside" style="width: 100%" required>
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Kelengkapan Sarana <a class="text-danger">*</a></label>
                                <textarea rows="2" id="" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Keterangan</label>
                                <textarea rows="3" id="" class="form-control" placeholder="Optional"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center mb-4">
                    <button class="btn btn-primary me-sm-3 me-1" id="btn-peminjaman" onclick="prosesPeminjaman()" hidden><i class="fa fa-qrcode"></i>&nbsp;&nbsp;Ajukan</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PENGEMBALIAN --}}
    <div class="modal fade" id="formPengembalian" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Formulir Pengembalian Aset&nbsp;&nbsp;&nbsp;
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="col-12 text-center mb-4">
                    <button class="btn btn-primary me-sm-3 me-1" id="btn-pengembalian" onclick="prosesPengembalian()" hidden><i class="fa fa-qrcode"></i>&nbsp;&nbsp;Ajukan</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL PENARIKAN --}}
    <div class="modal fade" id="formPenarikan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-add-new-address modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Formulir Penarikan Aset <mark>{{ $list['show']->sarana }}</mark>
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="card-title-desc"><footer class="blockquote-footer">No. Inventaris <code>{{ $list['show']->no_inventaris }}</code></footer></p>
                    <p class="card-title-desc"><footer class="blockquote-footer">Ruangan Sekarang : <kbd id="ruangan_sekarang_penarikan"></kbd> - <kbd id="lokasi_sekarang_penarikan"></kbd></footer></p>
                    <p class="card-title-desc"><footer class="blockquote-footer">Jika <mark>dimusnahkan</mark>, Aset akan dikunci oleh sistem</footer></p>
                    <hr>
                    <div class="row">
                        <input type="number" class="form-control" id="validasi_ruangan_penarikan" hidden>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Alasan Penarikan <a class="text-danger">*</a></label>
                                <textarea rows="2" id="alasan_penarikan" class="form-control" placeholder="Wajib diisi..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Kondisi <a class="text-danger">*</a></label>
                                <select class="form-select" id="kondisi_penarikan" required>
                                    <option value="" hidden>Pilih</option>
                                    <option value="1">Baik</option>
                                    <option value="2">Cukup</option>
                                    <option value="3">Buruk</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label class="form-label">Status <a class="text-danger">*</a></label>
                                <select class="form-select" id="status_penarikan" required>
                                    <option value="" hidden>Pilih</option>
                                    <option value="2">Dikembalikan ke Gudang Aset</option>
                                    <option value="3">Dimusnahkan</option>
                                </select>
                            </div>
                        </div>
                        {{-- <hr>
                        <div class="col-md-12 mb-3">
                            <div class="form-group">
                                <label class="form-label">Upload Dokumen (Optional)</label>
                                <input type="file" class="form-control mb-2" id="file_add" disabled>
                                <i class="fa-fw fas fa-caret-right nav-icon"></i> Batas ukuran maksimum setiap File Gambar adalah <strong>5 mb</strong>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="col-12 text-center mb-4">
                    <button class="btn btn-primary me-sm-3 me-1" id="btn-penarikan" onclick="prosesPenarikan()"><i class="fa fa-people-carry"></i>&nbsp;&nbsp;Ajukan Penarikan</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i>&nbsp;&nbsp;Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- UPDATE KONDISI --}}
    <div class="modal fade" id="kondisi" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Bagaimana Kondisi Sarana Sekarang?
                    </h4>
                    <button type="button" class="btn-close" onclick="closeModal()" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="id_kondisi" hidden>
                    <label for="">Pilih Kondisi</label>
                    <select class="form-select" id="pilihan_kondisi" required></select>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="btn-simpan-kondisi" onclick="updateKondisi()"><i
                            class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal()" aria-label="Close"><i class="fa-fw fas fa-times nav-icon"></i> Batal</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // SELECT2
            var te = $(".select2");
            te.length && te.each(function() {
                var es = $(this);
                es.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    dropdownParent: es.parent()
                })
            });

            $('#qr').text('') ;
            var qrcode = new QRCode("qr", {
                text: "{{ $list['qr'] }}",
                width: 300,
                height: 300,
                colorDark : "#000000",
                colorLight : "#ffffff",
                correctLevel : QRCode.CorrectLevel.H
            });
            $("img").on("contextmenu",function(){
                return false;
            });
            fresh();
        })

        // SHOWING MODAL -----------------------------------------------------------------------------------------------------------------------
        function showUpdateKondisi(kondisi) {
            $('#kondisi').modal('show');
            $("#id_kondisi").val({{ $list['show']->id }});
            $("#pilihan_kondisi").find('option').remove();
            $("#pilihan_kondisi").append(`
                <option value="1" ${kondisi == '1' ? "selected":""}>Baik</option>
                <option value="2" ${kondisi == '2' ? "selected":""}>Cukup</option>
                <option value="3" ${kondisi == '3' ? "selected":""}>Buruk</option>
            `);
        }

        // PEMELIHARAAN
        function modalPemeliharaan(aset) {
            $.ajax({
                url: "/api/inventaris/aset/pemeliharaan/"+aset,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res){
                    if (res.penarikan != null) {
                        if (res.penarikan.status == 3) {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: 'Aset telah <i>DIMUSNAHKAN</i>. Silakan melakukan pembatalan penarikan aset apabila diperlukan',
                                position: 'topRight'
                            });
                        }
                    } else {
                        // TAMPIL USERS DROPDOWN
                        $("#petugas_pemeliharaan").find('option').remove();
                        res.users.forEach(item => {
                            $("#petugas_pemeliharaan").append(`<option value="" hidden>Pilih</option>`);
                            $("#petugas_pemeliharaan").append(`
                                <option value="${item.id}">${item.nama}</option>
                            `);
                        });

                        // TAMPIL TABEL PEMELIHARAAN
                        $("#tampil-tbody-pemeliharaan").empty();
                        $('#dttable-pemeliharaan').DataTable().clear().destroy();
                        var date = new Date().toLocaleDateString();
                        res.show.forEach(item => {
                            var updet = new Date(item.created_at).toLocaleDateString();
                            content = `<tr id='`+item.id+`'>`;
                                if (updet == date) {
                                    content += `<td><center><a href='javascript:void(0);' class='btn btn-soft-danger btn-sm' onclick="hapusPemeliharaan(${item.id})"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></center></td>`;
                                } else {
                                    content += `<td><center><a href='javascript:void(0);' class='btn btn-soft-secondary btn-sm'><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></center></td>`;
                                }
                                content += `<td style='white-space: normal !important;word-wrap: break-word;'>${item.nama_petugas}</td>`;
                                content += `<td style='white-space: normal !important;word-wrap: break-word;'>${item.hasil}</td>`;
                                content += `<td style='white-space: normal !important;word-wrap: break-word;'>${item.rekomendasi}</td>`;
                                content += `<td>${new Date(item.created_at).toLocaleDateString('sv-SE')}</td>`;
                            content += `</tr>`;
                            $('#tampil-tbody-pemeliharaan').append(content);
                        })
                        var table = $('#dttable-pemeliharaan').DataTable({
                            order: [
                                [4, "desc"]
                            ],
                            bAutoWidth: false,
                            aoColumns : [
                                { sWidth: '10%' },
                                { sWidth: '15%' },
                                { sWidth: '30%' },
                                { sWidth: '30%' },
                                { sWidth: '15%' },
                            ],
                            displayLength: 7,
                            lengthChange: true,
                            lengthMenu: [7, 10, 25, 50, 75, 100],
                            buttons: ['excel', 'pdf']
                        });
                        table.buttons().container().appendTo('#dttable-pemeliharaan_wrapper .col-md-6:eq(0)');
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger: 'hover'
                        })

                        $('#formPemeliharaan').modal('show');
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON.error,
                        position: 'topRight'
                    });
                }
            });
        }

        function prosesPemeliharaan() {
            var petugas = $("#petugas_pemeliharaan").val();
            var hasil = $("#hasil_pemeliharaan").val();
            var rekomendasi = $("#rekomendasi_pemeliharaan").val();

            if (petugas == "" || hasil == "" || rekomendasi == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian wajib (<a class="text-danger">*</a>)',
                    position: 'topRight'
                });
            } else {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/api/inventaris/aset/pemeliharaan/store',
                    dataType: 'json',
                    data: {
                        user: "{{ Auth::user()->id }}",
                        petugas: petugas,
                        hasil: hasil,
                        rekomendasi: rekomendasi,
                        aset: "{{ $list['show']->id }}",
                    },
                    success: function(res) {
                        iziToast.success({
                            title: 'Sukses!',
                            message: 'Submit Pemeliharaan berhasil pada '+ res,
                            position: 'topRight'
                        });
                        if (res) {
                            refreshModalPemeliharaan();
                            fresh();
                        }
                    },
                    error: function (res) {
                        console.log("error : " + JSON.stringify(res) );
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: res.responseJSON.error,
                            position: 'topRight'
                        });
                    }
                });
            }
        }

        function hapusPemeliharaan(id) {
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: 'Hapus Pemeliharaan ID : '+id,
                icon: 'warning',
                reverseButtons: false,
                showDenyButton: false,
                showCloseButton: false,
                showCancelButton: true,
                focusCancel: true,
                confirmButtonColor: '#FF4845',
                confirmButtonText: `<i class="fa fa-trash"></i> Hapus`,
                cancelButtonText: `<i class="fa fa-times"></i> Batal`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/api/inventaris/aset/pemeliharaan/destroy/" + id,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Hapus Pemeliharaan berhasil pada ' + res,
                                position: 'topRight'
                            });
                            refreshModalPemeliharaan();
                            fresh();
                        },
                        error: function(res) {
                            console.log("error : " + JSON.stringify(res) );
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: res.responseJSON.error,
                                position: 'topRight'
                            });
                        }
                    });
                }
            })
        }

        // MUTASI
        function modalMutasi(aset) {
            $.ajax({
                url: "/api/inventaris/aset/mutasi/"+aset,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res){
                    if (res.penarikan != null) {
                        if (res.penarikan.status == 3) {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: 'Aset telah <i>DIMUSNAHKAN</i>. Silakan melakukan pembatalan penarikan aset apabila diperlukan',
                                position: 'topRight'
                            });
                        }
                    } else {
                        // DEFINISI
                        $("#lokasi_awal").val(res.aset.ruangan);
                        $("#ruangan_sekarang_mutasi").text(res.aset.ruangan);
                        $("#lokasi_sekarang_mutasi").text(res.aset.lokasi);
                        $("#kondisi_mutasi").find('option').remove();
                        $("#kondisi_mutasi").append(`
                            <option value="1" ${res.aset.kondisi == '1' ? "selected":""}>Baik</option>
                            <option value="2" ${res.aset.kondisi == '2' ? "selected":""}>Cukup</option>
                            <option value="3" ${res.aset.kondisi == '3' ? "selected":""}>Buruk</option>
                        `);

                        $("#lokasi_tujuan").find('option').remove();
                        res.ruangan.forEach(item => {
                            $("#lokasi_tujuan").append(`<option value="" hidden>Pilih</option>`);
                            $("#lokasi_tujuan").append(`
                                <option value="${item.id}" ${res.aset.id_ruangan == item.id ? "selected":""}>${item.ruangan} - ${item.lokasi}</option>
                            `);
                        });

                        // TABEL
                        $("#tampil-tbody-mutasi").empty();
                        $('#dttable-mutasi').DataTable().clear().destroy();
                        var date = new Date().toLocaleDateString();
                        res.show.forEach(item => {
                            var updet = new Date(item.created_at).toLocaleDateString();
                            content = `<tr id='`+item.id+`'>`;
                                if (updet == date) {
                                    content += `<td><center><div class='btn-group'>
                                        <a href='javascript:void(0);' class='btn btn-soft-danger btn-sm' onclick="batalMutasi(${item.id})"><i class='bx bx-trash scaleX-n1-rtl'></i> Batal</a>
                                        </div></center></td>`;
                                } else {
                                    content += `<td><center><div class='btn-group'>
                                        <a href='javascript:void(0);' class='btn btn-soft-secondary btn-sm'><i class='bx bx-trash scaleX-n1-rtl'></i> Batal</a>
                                        </div></center></td>`;
                                }
                                content += `<td>${new Date(item.created_at).toLocaleString('sv-SE')}</td>`;
                                content += `<td style='white-space: normal !important;word-wrap: break-word;'><div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0'>${item.ruangan_awal_aset}</h6><small class='text-truncate text-muted'>${item.lokasi_awal_aset}</small></div></div></td>`;
                                content += `<td style='white-space: normal !important;word-wrap: break-word;'><div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0'>${item.ruangan_tujuan_aset}</h6><small class='text-truncate text-muted'>${item.lokasi_tujuan_aset}</small></div></div></td>`;
                                content += `<td style='white-space: normal !important;word-wrap: break-word;'>${item.ket?item.ket:''}</td>`;
                                if (item.kondisi == 1) {
                                    content += `<td><kbd class='text-dark' style='background-color:#eaf9f4'>Baik</kbd></td>`;
                                } else {
                                    if (item.kondisi == 2) {
                                        content += `<td><kbd class='text-dark' style='background-color:#fef7ed'>Cukup</kbd></td>`;
                                    } else {
                                        if (item.kondisi == 3) {
                                            content += `<td><kbd class='text-dark' style='background-color:#fef0f0'>Buruk</kbd></td>`;
                                        }
                                    }
                                }
                            content += `</tr>`;
                            $('#tampil-tbody-mutasi').append(content);
                        })
                        var table = $('#dttable-mutasi').DataTable({
                            order: [
                                [1, "desc"]
                            ],
                            bAutoWidth: false,
                            aoColumns : [
                                { sWidth: '10%' },
                                { sWidth: '15%' },
                                { sWidth: '20%' },
                                { sWidth: '20%' },
                                { sWidth: '25%' },
                                { sWidth: '10%' },
                            ],
                            displayLength: 7,
                            lengthChange: true,
                            lengthMenu: [7, 10, 25, 50, 75, 100],
                            buttons: ['excel', 'pdf']
                        });
                        table.buttons().container().appendTo('#dttable-mutasi_wrapper .col-md-6:eq(0)');
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger: 'hover'
                        })

                        $('#formMutasi').modal('show');
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON.error,
                        position: 'topRight'
                    });
                }
            });
        }

        function prosesMutasi() {
            var lokasi_tujuan = $("#lokasi_tujuan").val();
            var kondisi = $("#kondisi_mutasi").val();
            var ket = $("#ket_mutasi").val();

            if (lokasi_tujuan == "" || kondisi == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian wajib (<a class="text-danger">*</a>)',
                    position: 'topRight'
                });
            } else {
                if (lokasi_tujuan == "{{ $list['show']->id_ruangan }}") {
                    iziToast.warning({
                        title: 'Pesan Ambigu!',
                        message: 'Pastikan Anda memilih ruangan tujuan mutasi dengan benar / tidak sama dengan ruangan awal',
                        position: 'topRight'
                    });
                } else {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/api/inventaris/aset/mutasi/store',
                        dataType: 'json',
                        data: {
                            user: "{{ Auth::user()->id }}",
                            lokasi_tujuan: lokasi_tujuan,
                            kondisi: kondisi,
                            ket: ket,
                            aset: "{{ $list['show']->id }}",
                        },
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Mutasi Aset berhasil pada '+ res,
                                position: 'topRight'
                            });
                            refreshModalMutasi("{{ $list['show']->id }}");
                            fresh();
                        },
                        error: function (res) {
                            console.log("error : " + JSON.stringify(res) );
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: res.responseJSON.error,
                                position: 'topRight'
                            });
                        }
                    });
                }
            }
        }

        function batalMutasi(id) {
            $.ajax({
                url: "/api/inventaris/aset/mutasi/destroy/cariaset/{{ $list['show']->id }}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    if (res.id != id) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Lakukan pembatalan secara berurutan!',
                            position: 'topRight'
                        });
                    } else {
                        Swal.fire({
                            title: 'Batal Mutasi Aset ID : '+id+' ?',
                            text: 'Ruangan dan Kondisi aset sekarang akan dikembalikan seperti keadaan semula',
                            icon: 'warning',
                            reverseButtons: false,
                            showDenyButton: false,
                            showCloseButton: false,
                            showCancelButton: true,
                            focusCancel: true,
                            confirmButtonColor: '#FF4845',
                            confirmButtonText: `<i class="fa fa-history"></i> Batalkan Mutasi`,
                            cancelButtonText: `<i class="fa fa-times"></i> Tutup`,
                            backdrop: `rgba(26,27,41,0.8)`,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "/api/inventaris/aset/mutasi/destroy/" + id,
                                    type: 'GET',
                                    dataType: 'json', // added data type
                                    success: function(res) {
                                        iziToast.success({
                                            title: 'Sukses!',
                                            message: 'Pembatalan mutasi aset berhasil pada ' + res,
                                            position: 'topRight'
                                        });
                                        refreshModalMutasi("{{ $list['show']->id }}");
                                        fresh();
                                    },
                                    error: function(res) {
                                        console.log("error : " + JSON.stringify(res) );
                                        iziToast.error({
                                            title: 'Pesan Galat!',
                                            message: res.responseJSON.error,
                                            position: 'topRight'
                                        });
                                    }
                                });
                            }
                        })
                    }
                },
                error: function(res) {
                    console.log("error : " + JSON.stringify(res) );
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON.error,
                        position: 'topRight'
                    });
                }
            });
        }

        // PENARIKAN
        function modalPenarikan(aset) {
            $.ajax({
                url: "/api/inventaris/aset/penarikan/"+aset,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res){
                    if (res.validasi1) {
                        batalPenarikan(res.validasi1.id);
                    } else {
                        if (res.validasi2) {
                            console.log('Aset sedang dalam peminjamn / belum dikembalikan');
                        } else {
                            $('#validasi_ruangan_penarikan').val(res.show.id_ruangan);
                            $('#ruangan_sekarang_penarikan').text(res.show.ruangan);
                            $('#lokasi_sekarang_penarikan').text(res.show.lokasi);
                            $('#formPenarikan').modal('show');
                        }
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON.error,
                        position: 'topRight'
                    });
                }
            });
        }

        function prosesPenarikan() {
            var alasan = $("#alasan_penarikan").val();
            var kondisi = $("#kondisi_penarikan").val();
            var status = $("#status_penarikan").val();
            var validasi = $('#validasi_ruangan_penarikan').val();
            console.log(validasi);

            if (alasan == "" || kondisi == "" || status == "") {
                iziToast.warning({
                    title: 'Pesan Ambigu!',
                    message: 'Pastikan Anda tidak mengosongi semua isian wajib (<a class="text-danger">*</a>)',
                    position: 'topRight'
                });
            } else {
                if (validasi == 1 && kondisi == 2) {
                    iziToast.warning({
                        title: 'Pesan Ambigu!',
                        message: 'Ruangan aset sudah berada di Gudang Aset, tidak memerlukan penarikan aset ke Gudang kembali',
                        position: 'topRight'
                    });
                } else {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method: 'POST',
                        url: '/api/inventaris/aset/penarikan/store',
                        dataType: 'json',
                        data: {
                            user: "{{ Auth::user()->id }}",
                            alasan: alasan,
                            kondisi: kondisi,
                            status: status,
                            aset: "{{ $list['show']->id }}",
                        },
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Penarikan Aset berhasil pada '+ res,
                                position: 'topRight'
                            });
                            $('.modal').modal('hide');
                            fresh();
                        },
                        error: function (res) {
                            console.log("error : " + JSON.stringify(res) );
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: res.responseJSON.error,
                                position: 'topRight'
                            });
                        }
                    });
                }
            }
        }

        function batalPenarikan(id) {
            Swal.fire({
                title: 'Batal Penarikan Aset ID : '+id+' ?',
                text: 'Status, kondisi, dan ruangan aset yang sudah dilakukan penarikan akan dikembalikan seperti semula',
                icon: 'warning',
                reverseButtons: false,
                showDenyButton: false,
                showCloseButton: false,
                showCancelButton: true,
                focusCancel: true,
                confirmButtonColor: '#FF4845',
                confirmButtonText: `<i class="fa fa-history"></i> Batalkan Penarikan`,
                cancelButtonText: `<i class="fa fa-times"></i> Tutup`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/api/inventaris/aset/penarikan/destroy/" + id,
                        type: 'GET',
                        dataType: 'json', // added data type
                        success: function(res) {
                            iziToast.success({
                                title: 'Sukses!',
                                message: 'Pembatalan penarikan aset berhasil pada ' + res,
                                position: 'topRight'
                            });
                            $('.modal').modal('hide');
                            fresh();
                        },
                        error: function(res) {
                            console.log("error : " + JSON.stringify(res) );
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: res.responseJSON.error,
                                position: 'topRight'
                            });
                        }
                    });
                }
            })
        }

        // REFRESH -----------------------------------------------------------------------------------------------------------------------

        // REFRESH DASHBOARD DETAIL ASET
        function fresh() {
            $.ajax({
                url: "/api/inventaris/aset/{{ $list['show']->token }}/fresh",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res){
                    if (res) {
                        // FRESH RUANGAN
                        $('#ruangan_aset').text(res.ruangan+" - "+res.lokasi);

                        // FRESH STATUS
                        $('#status_aset').empty();
                        if (res.status == false) {
                            $('#status_aset').append(`<div class="badge bg-primary">Tersedia</div>`);
                        } else {
                            $('#status_aset').append(`<div class="badge bg-danger">Dimusnahkan</div>`);
                        }

                        // FRESH KONDISI
                        $('#kondisi_aset').empty();
                        if (res.kondisi == 1) {
                            $('#kondisi_aset').append(`
                                <div class="avatar-md mx-auto mb-3">
                                    <div class="avatar-title bg-light rounded-circle text-primary h1">
                                        <i class="fas fa-check"></i>
                                    </div>
                                </div>
                                <p class="text-primary mb-0"><b>Kondisi Baik</b></p>
                            `);
                        } else {
                            if (res.kondisi == 2) {
                                $('#kondisi_aset').append(`
                                    <div class="avatar-md mx-auto mb-3">
                                        <div class="avatar-title bg-warning rounded-circle text-light h1">
                                            <i class="fas fa-minus"></i>
                                        </div>
                                    </div>
                                    <p class="text-warning mb-0"><b>Kondisi Cukup</b></p>
                                `);
                            } else {
                                if (res.kondisi == 3) {
                                    $('#kondisi_aset').append(`
                                        <div class="avatar-md mx-auto mb-3">
                                            <div class="avatar-title bg-danger rounded-circle text-light h1">
                                                <i class="fas fa-times"></i>
                                            </div>
                                        </div>
                                        <p class="text-danger mb-0"><b>Kondisi Buruk</b></p>
                                    `);
                                } else {
                                    $('#kondisi_aset').append(`
                                        <div class="avatar-md mx-auto mb-3">
                                            <div class="avatar-title bg-dark rounded-circle text-light h1">
                                                <i class="mdi mdi-email-open"></i>
                                            </div>
                                        </div>
                                        <p class="text-dark mb-0"><b>Kondisi Tidak Terdefinisi</b></p>
                                    `);
                                }
                            }
                        }
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON.error,
                        position: 'topRight'
                    });
                }
            });
        }

        // REFRESH MODAL PEMELHARAAN
        function refreshModalPemeliharaan() {
            $("#tampil-tbody-pemeliharaan").empty().append(`<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memuat data...</center></td></tr>`);
            $.ajax({
                url: "/api/inventaris/aset/pemeliharaan",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res){
                    if (res) {
                        $('#hasil_pemeliharaan').val('');
                        $('#rekomendasi_pemeliharaan').val('');

                        // DEFINISI
                        $("#petugas_pemeliharaan").find('option').remove();
                        res.users.forEach(item => {
                            $("#petugas_pemeliharaan").append(`<option value="" hidden>Pilih</option>`);
                            $("#petugas_pemeliharaan").append(`
                                <option value="${item.id}">${item.nama}</option>
                            `);
                        });

                        // TABEL
                        $("#tampil-tbody-pemeliharaan").empty();
                        $('#dttable-pemeliharaan').DataTable().clear().destroy();
                        var date = new Date().toLocaleDateString();
                        res.show.forEach(item => {
                            var updet = new Date(item.created_at).toLocaleDateString();
                            content = `<tr id='`+item.id+`'>`;
                                if (updet == date) {
                                    content += `<td><center><a href='javascript:void(0);' class='btn btn-soft-danger btn-sm' onclick="hapusPemeliharaan(${item.id})"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></center></td>`;
                                } else {
                                    content += `<td><center><a href='javascript:void(0);' class='btn btn-soft-secondary btn-sm'><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a></center></td>`;
                                }
                                content += `<td style='white-space: normal !important;word-wrap: break-word;'>${item.nama_petugas}</td>`;
                                content += `<td style='white-space: normal !important;word-wrap: break-word;'>${item.hasil}</td>`;
                                content += `<td style='white-space: normal !important;word-wrap: break-word;'>${item.rekomendasi}</td>`;
                                content += `<td>${new Date(item.created_at).toLocaleDateString('sv-SE')}</td>`;
                            content += `</tr>`;
                            $('#tampil-tbody-pemeliharaan').append(content);
                        })
                        var table = $('#dttable-pemeliharaan').DataTable({
                            order: [
                                [4, "desc"]
                            ],
                            bAutoWidth: false,
                            aoColumns : [
                                { sWidth: '10%' },
                                { sWidth: '15%' },
                                { sWidth: '30%' },
                                { sWidth: '30%' },
                                { sWidth: '15%' },
                            ],
                            displayLength: 7,
                            lengthChange: true,
                            lengthMenu: [7, 10, 25, 50, 75, 100],
                            buttons: ['excel', 'pdf']
                        });
                        table.buttons().container().appendTo('#dttable-pemeliharaan_wrapper .col-md-6:eq(0)');
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger: 'hover'
                        })
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON.error,
                        position: 'topRight'
                    });
                }
            });
        }

        function refreshModalMutasi(aset) {
            $("#tampil-tbody-mutasi").empty().append(`<tr><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memuat data...</center></td></tr>`);
            $.ajax({
                url: "/api/inventaris/aset/mutasi/"+aset,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res){
                    if (res) {
                        // DEFINISI
                        // $("#lokasi_awal").val(res.aset.ruangan);
                        $("#ruangan_sekarang_mutasi").text(res.aset.ruangan);
                        $("#lokasi_sekarang_mutasi").text(res.aset.lokasi);
                        $("#kondisi_mutasi").find('option').remove();
                        $("#kondisi_mutasi").append(`
                            <option value="1" ${res.aset.kondisi == '1' ? "selected":""}>Baik</option>
                            <option value="2" ${res.aset.kondisi == '2' ? "selected":""}>Cukup</option>
                            <option value="3" ${res.aset.kondisi == '3' ? "selected":""}>Buruk</option>
                        `);

                        $("#lokasi_tujuan").find('option').remove();
                        res.ruangan.forEach(item => {
                            $("#lokasi_tujuan").append(`<option value="" hidden>Pilih</option>`);
                            $("#lokasi_tujuan").append(`
                                <option value="${item.id}" ${res.aset.id_ruangan == item.id ? "selected":""}>${item.ruangan} - ${item.lokasi}</option>
                            `);
                        });

                        // TABEL
                        $("#tampil-tbody-mutasi").empty();
                        $('#dttable-mutasi').DataTable().clear().destroy();
                        var date = new Date().toLocaleDateString();
                        res.show.forEach(item => {
                            var updet = new Date(item.created_at).toLocaleDateString();
                            content = `<tr id='`+item.id+`'>`;
                                if (updet == date) {
                                    content += `<td><center><div class='btn-group'>
                                        <a href='javascript:void(0);' class='btn btn-soft-danger btn-sm' onclick="batalMutasi(${item.id})"><i class='bx bx-trash scaleX-n1-rtl'></i> Batal</a>
                                        </div></center></td>`;
                                } else {
                                    content += `<td><center><div class='btn-group'>
                                        <a href='javascript:void(0);' class='btn btn-soft-secondary btn-sm'><i class='bx bx-trash scaleX-n1-rtl'></i> Batal</a>
                                        </div></center></td>`;
                                }
                                content += `<td>${new Date(item.created_at).toLocaleString('sv-SE')}</td>`;
                                content += `<td style='white-space: normal !important;word-wrap: break-word;'><div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0'>${item.ruangan_awal_aset}</h6><small class='text-truncate text-muted'>${item.lokasi_awal_aset}</small></div></div></td>`;
                                content += `<td style='white-space: normal !important;word-wrap: break-word;'><div class='d-flex justify-content-start align-items-center'><div class='d-flex flex-column'><h6 class='mb-0'>${item.ruangan_tujuan_aset}</h6><small class='text-truncate text-muted'>${item.lokasi_tujuan_aset}</small></div></div></td>`;
                                content += `<td style='white-space: normal !important;word-wrap: break-word;'>${item.ket?item.ket:''}</td>`;
                                if (item.kondisi == 1) {
                                    content += `<td><kbd class='text-dark' style='background-color:#eaf9f4'>Baik</kbd></td>`;
                                } else {
                                    if (item.kondisi == 2) {
                                        content += `<td><kbd class='text-dark' style='background-color:#fef7ed'>Cukup</kbd></td>`;
                                    } else {
                                        if (item.kondisi == 3) {
                                            content += `<td><kbd class='text-dark' style='background-color:#fef0f0'>Buruk</kbd></td>`;
                                        }
                                    }
                                }
                            content += `</tr>`;
                            $('#tampil-tbody-mutasi').append(content);
                        })
                        var table = $('#dttable-mutasi').DataTable({
                            order: [
                                [1, "desc"]
                            ],
                            bAutoWidth: false,
                            aoColumns : [
                                { sWidth: '10%' },
                                { sWidth: '15%' },
                                { sWidth: '20%' },
                                { sWidth: '20%' },
                                { sWidth: '25%' },
                                { sWidth: '10%' },
                            ],
                            displayLength: 7,
                            lengthChange: true,
                            lengthMenu: [7, 10, 25, 50, 75, 100],
                            buttons: ['excel', 'pdf']
                        });
                        table.buttons().container().appendTo('#dttable-mutasi_wrapper .col-md-6:eq(0)');
                        $('[data-bs-toggle="tooltip"]').tooltip({
                            trigger: 'hover'
                        })
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON.error,
                        position: 'topRight'
                    });
                }
            });
        }

        // FUNCTION -----------------------------------------------------------------------------------------------------------------------
        function updateKondisi() {
            var kondisi = $("#pilihan_kondisi").val();

            $.ajax({
                url: "/api/inventaris/aset/{{ $list['show']->token }}/kondisi/"+kondisi,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res){
                    iziToast.success({
                        title: 'Pesan Sukses!',
                        message: 'Kondisi sarana berhasil diperbarui pada '+res,
                        position: 'topRight'
                    });
                    if (res) {
                        $('#kondisi').modal('hide');
                        fresh();
                        // window.location.reload();
                    }
                },
                error: function(res){
                    console.log("error : " + JSON.stringify(res) );
                }
            });
        }

        function cetak() {
            var pdf = new jsPDF({
                orientation: "portrait",
                unit: "mm",
                format: [120, 120]
            });

            let base64Image = $('#qr img').attr('src');
            pdf.addImage(base64Image, 'png', 10, 10, 100, 100);
            var base64string = pdf.output('bloburl');
            window.open(base64string,'_blank', 'width=500,height=550');
        }

        function getDateTime() {
            var now = new Date();
            now.setHours(now.getHours() + 7);
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
