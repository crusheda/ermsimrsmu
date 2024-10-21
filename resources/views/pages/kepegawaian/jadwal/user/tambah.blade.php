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
                        <li class="breadcrumb-item"><a href="{{ route('kepegawaian.jadwaldinas.index') }}">Jadwal Dinas</a></li>
                        <li class="breadcrumb-item" aria-current="page">Tambah</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Form Tambah Jadwal Dinas</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        <div class="col-xl-12">
            <div class="card table-card mb-0">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <h5 class="mb-0"><button class="btn btn-link-dark" onclick="window.location='{{ route('kepegawaian.jadwaldinas.index') }}'"><i class="fas fa-chevron-left me-2"></i>Kembali</button></h5>
                    <div class="btn-group">
                        <a href="javascript:void(0);" class="avtar avtar-s btn-link-secondary dropdown-toggle arrow-none" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-dots-vertical f-18"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="">#</a>
                                <div class="divider pb-1"></div>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="">#</a>
                                <a class="dropdown-item" href="javascript:void(0);" onclick="">#</a>
                            </li>
                        </ul>
                        {{-- <a href="javascript:void(0);" class="avtar avtar-s btn-light-primary" onclick="tambah()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tambah Ja"><i class="ti ti-refresh f-20"></i></a> --}}
                    </div>
                </div>
                <form action="{{ route('kepegawaian.jadwaldinas.prosesTambah') }}" id="formTambah" class="needs-validation mb-0" method="POST" enctype="multipart/form-data" novalidate>
                    @csrf
                    <input type="text" class="form-control" name="id_jadwal" value="{{ $list["jadwal"]->id }}" hidden>
                    <div class="card-body pb-0">
                        @php
                            $bulan = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                            $totalDay = \Carbon\Carbon::create($list['jadwal']->tahun, $list['jadwal']->bulan)->format('t');
                            $n = 1;
                        @endphp
                        <h4 class="text-center p-10 mb-0 mt-2">Bulan
                            @foreach ($bulan as $key => $value)
                                @if ($key == $list['jadwal']->bulan)
                                    <b class="text-primary">{{ $value }}</b>
                                @endif
                            @endforeach Tahun <b class="text-primary">{{ $list['jadwal']->tahun }}</b>
                        </h4>
                        <div class="table-responsive p-10 pb-0">
                            <table id="dttable" class="table table-bordered" style="width: 100%;table-layout: auto">
                                <thead>
                                    <tr>
                                        <th class="text-center" rowspan="2">NO</th>
                                        <th class="text-center" rowspan="2">NAMA</th>
                                        <th class="text-center" colspan="{{ $totalDay }}">TANGGAL</th>
                                    </tr>
                                    <tr>
                                        @for ($i = 1; $i <= $totalDay; $i++)
                                            @php $dayh = \Carbon\Carbon::create($list['jadwal']->tahun, $list['jadwal']->bulan, $i)->dayName @endphp
                                            @if ($dayh == 'Minggu')
                                                <th class="p-2 text-center" style="background-color: #fed8b9">
                                            @else
                                                <th class="p-2 text-center">
                                            @endif
                                                    {{ sprintf("%02d", $i) }}
                                                </th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($list['ref_users'])
                                        @foreach (json_decode($list['ref_users']->staf) as $item)
                                        <tr>
                                            <td>{{ $n++ }}</td>
                                            <td>
                                                @foreach ($list['users'] as $val)
                                                    @if ($item == $val->id)
                                                        <input type="text" class="form-control" name="id_staf[]" value="{{ $val->id }}" hidden>
                                                        <input type="text" class="form-control" name="nama_staf[]" value="{{ $val->nick != null?$val->nick:$val->name }}" hidden>
                                                        {{ $val->nick != null?$val->nick:$val->name }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            @for ($i = 1; $i <= $totalDay; $i++)
                                                @php $dayb = \Carbon\Carbon::create($list['jadwal']->tahun, $list['jadwal']->bulan, $i)->dayName @endphp
                                                @if ($dayb == 'Minggu')
                                                    <td class="p-2" style="background-color: #fed8b9">
                                                @else
                                                    <td class="p-2">
                                                @endif
                                                        <input type="text" class="form-control inputTgl text-center clearTxt" maxlength="2" onkeyup="checkShift($(this))" name="tgl{{ $i }}[]" id="{{ $n-1 }}tgl{{ $i }}" pattern="[A-Za-z]{1,2}" value="" placeholder="......." style="padding: 0;border-radius: 0" required>
                                                    </td>
                                            @endfor
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="row p-10">
                            <div class="col-md-7">
                                <div class="alert alert-light">
                                    <h5>Hal-hal yang perlu <b class="text-danger">diperhatikan</b></h5>
                                    <small>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Apabila terdapat data gagal saat memproses Jadwal, silakan Refresh Browser <br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Disarankan melakukan pengisian jadwal dinas menggunakan <b>Device Komputer</b> dan <b>Browser Google Chrome</b> <br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Pengisian jadwal wajib menggunakan Kode Shift (e.g. P / S / P6 / etc) menyesuaikan kode shift pada referensi yang sudah ada <br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Penulisan Huruf pada kolom isian Shift Jaga <i><b>Auto Capslock</b></i> meskipun sudah disimpan sekalipun <br>
                                        <i class="ti ti-arrow-narrow-right me-1"></i> Jadwal Dinas akan berpengaruh pada waktu <b>Absensi</b> dikemudian hari, maka dari itu silakan Cek Jadwal kembali sebelum submit
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <h5>Shift Jaga :</h5>
                                <div class="list-group">
                                    <label class="list-group-item border-0 p-2" id="kode-shift">
                                        <ul>
                                            @foreach ($list['ref_shift'] as $item)
                                                <li><b class="me-1">{{ $item->singkat }}</b>(<u>{{ $item->shift }}</u>) : {{ \Carbon\Carbon::parse($item->berangkat)->isoFormat('HH:mm') }} - {{ \Carbon\Carbon::parse($item->pulang)->isoFormat('HH:mm') }} WIB</li>
                                            @endforeach
                                        </ul>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <h5>Keterangan :</h5>
                                <div class="list-group">
                                    <label class="list-group-item border-0 p-2">
                                        <a class="btn btn-light me-2" style="background-color: #fed8b9" href="javascript:void(0);"></a>
                                        Hari Minggu
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer p-2">
                        <div class="text-end btn-page mt-2">
                            <a class="btn btn-link-secondary" id="clear_text" href="javascript:void(0);" onclick="clearInput()">Kosongkan</a>
                            <a class="btn btn-primary" id="btn-simpan" href="javascript:void(0);" onclick="simpan()"><i class="fas fa-save me-1"></i> Simpan</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL START --}}
    <div class="modal fade animate__animated animate__rubberBand" id="modalTambah" role="dialog" aria-labelledby="confirmFormLabel"aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Form Tambah
                    </h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-secondary mb-3">
                        <small>
                            {{-- <i class="ti ti-arrow-narrow-right me-1"></i> <br> --}}
                            <i class="ti ti-arrow-narrow-right me-1"></i> Isian bertanda (<a class="text-danger">*</a>) berarti wajib diisi<br>
                            <i class="ti ti-arrow-narrow-right me-1"></i> Batas ukuran file upload maksimal <b class="text-danger">2 mb</b>
                        </small>
                    </div>
                    <div class="position-relative">
                        <label class="form-label">Pilih Bulan dan Tahun</label>
                        <input type="month" class="form-control" value="" placeholder="" id="tgl" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link-secondary" data-bs-dismiss="modal">Batalkan</button>
                    <button class="btn btn-primary" id="btn-tambah" onclick="prosesTambah()"><i class="fa-fw fas fa-chevron-right nav-icon"></i> Lanjutkan</button>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}

    <script>
        $(document).ready(function() {
            // SELECT2
            // var t = $(".select2");
            // t.length && t.each(function() {
            //     var e = $(this);
            //     e.wrap('<div class="position-relative"></div>').select2({
            //         placeholder: "Pilih",
            //         allowClear: true,
            //         dropdownParent: e.parent()
            //     })
            // });

            // $('.select2Tambah').select2({
            //     dropdownParent: $('#tambah')
            // });
            $('.inputTgl').bind('keypress', onlyInput);
        });

        function checkShift(t) {
            if (t.val().length <= 2 ) {
                $.ajax({
                    url: "/api/kepegawaian/jadwaldinas/shift/"+t.val().toUpperCase()+"/user/{{ Auth::user()->id }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        if (res.code == 200) {
                            t.val(t.val().toUpperCase());
                        } else {
                            t.val('');
                            notifier.show(
                                "Pesan Galat!", res.message,
                                "warning", "{{ asset('images/notification/medium_priority-48.png') }}", 4e3
                            );
                        }
                    },
                    error: function (res) { }
                });
            } else {
                t.val('');
            }
        }

        function onlyInput(event) {
            var value = String.fromCharCode(event.which);
            var pattern = new RegExp(/[a-zåäö ]/i);
            return pattern.test(value);
        }

        // function tambah() {
        //     $('#modalTambah').modal('show');
        // }

        function simpan() {
            $.ajax({
                url: "/api/kepegawaian/jadwaldinas/{{ $list['jadwal']->id }}/shift/user/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    var valid = 1;
                    for (let t = 1; t <= JSON.parse(res.jadwal.staf).length; t++) {
                        for (let i = 1; i <= res.totalDay; i++) {
                            num = $("#"+t+"tgl"+i);
                            if (res.shiftArr.includes(num.val()) == 0) {
                                valid = 0;
                                num.removeClass('is-valid').addClass('is-invalid');
                            } else {
                                num.removeClass('is-invalid').addClass('is-valid');
                            }
                        }
                    }
                    if (valid == 1) {
                        console.log('berhasil');
                        $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
                        $("#btn-simpan").prop('disabled', true);
                        $("#formTambah").submit();
                    } else {
                        console.log('gagal');
                        notifier.show(
                            "Pesan Galat!", "Terdapat beberapa isian yang tidak valid. Mohon cek kembali penulisan Shift Jaga pada setiap isian",
                            "warning", "{{ asset('images/notification/medium_priority-48.png') }}", 4e3
                        );
                    }
                },
                error: function (res) { }
            })
        }

        function clearInput() {
            var jml = parseInt("{{ $list['jml_tgl'] }}",10);
            for (let i = 0; i <= jml; i++) {
                $(".clearTxt").val("");
            }
        }
    </script>
@endsection
