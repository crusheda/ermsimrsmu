@extends('layouts.default')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">ASET & GUDANG - SARANA <kbd>ID : {{ $list['show']->id }}</kbd></h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3">
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
                        <button class="btn btn-soft-primary w-100"><i class="bx bx-download scaleX-n1-rtl"></i> Download</button>
                        <button class="btn btn-soft-warning w-100" onclick="cetak()"><i class="bx bx-printer scaleX-n1-rtl"></i> Cetak</button>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div class="avatar-md mx-auto mb-3">
                            <div class="avatar-title bg-light rounded-circle text-primary h1">
                                <i class="mdi mdi-email-open"></i>
                            </div>
                        </div>
                        <p class="text-primary mb-0"><b>Kondisi Baik</b></p>kondisi = {{ $list['show']->kondisi }}
                        <button class="btn btn-warning-outline btn-sm" onclick="showUpdateKondisi({{ $list['show']->kondisi }})" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                        title="Kondisi Sekarang"><i class='bx bx-edit scaleX-n1-rtl'></i> Perbarui Kondisi</button>
                        <hr>
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="mt-3">
                                    <p class="text-muted mb-1">Today</p>
                                    <h5>1024</h5>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mt-3">
                                    <p class="text-muted mb-1">This Month</p>
                                    <h5>12356 <span class="text-success font-size-13">0.2 % <i class="mdi mdi-arrow-up ms-1"></i></span></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <ul class="list-unstyled mt-4">
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
                    </ul>
                    <div class="mt-4">
                        <a href="#!" class="btn btn-soft-primary btn-hover w-100 rounded"><i class="mdi mdi-eye"></i> View Profile</a>
                    </div>
                </div>
            </div>
        </div><!--end col-->
        <div class="col-xl-9">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="d-flex">
                        {{-- <img src="assets/images/companies/wechat.svg" alt="" height="50"> --}}
                        <div class="flex-grow-1">
                            <h5 class="fw-semibold">{{ $list['show']->sarana }}</h5>
                            <h6>No. Inventaris : <a href="javascript:void(0);">{{ $list['show']->no_inventaris }}</a></h6>
                            <ul class="list-unstyled hstack gap-2 mb-0">
                                <li>
                                    <i class="bx bx-building-house"></i> <span class="text-muted">Themesbrand</span>
                                </li>
                                <li>
                                    <i class="bx bx-map"></i> <span class="text-muted">California</span>
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
        })

        // SHOWING MODAL
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
                        // refresh();
                        window.location.reload();
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

    </script>
@endsection
