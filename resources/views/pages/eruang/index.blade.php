@extends('layouts.default')

@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">E-Ruang</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                {{-- <div class="float-end">
                    <div class="dropdown">
                        <button type="button" class="btn btn-light" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-wallet me-1"></i> <span class="d-none d-sm-inline-block">Wallet Balance <i class="mdi mdi-chevron-down"></i></span></button>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-md">
                            <div class="dropdown-item-text">
                                <div>
                                    <p class="text-muted mb-2">Available Balance</p>
                                    <h5 class="mb-0">$ 9148.23</h5>
                                </div>
                            </div>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="#">
                                BTC : <span class="float-end">1.02356</span>
                            </a>
                            <a class="dropdown-item" href="#">
                                ETH : <span class="float-end">0.04121</span>
                            </a>
                            <a class="dropdown-item" href="#">
                                LTC : <span class="float-end">0.00356</span>
                            </a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item text-primary text-center" href="#">
                                Learn more
                            </a>
                        </div>
                    </div>
                </div> --}}
                <h4 class="card-title mb-4">Peminjaman Ruangan</h4>
                <div class="crypto-buy-sell-nav">
                    <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#buy" role="tab">
                                Pengajuan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#sell" role="tab">
                                Daftar Riwayat
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content crypto-buy-sell-nav-content p-4">
                        <div class="tab-pane active" id="buy" role="tabpanel">
                            <form>
                                <div class="mb-4">
                                    <label><mark>Ketentuan</mark></label><br>
                                    <small><i class="mdi mdi-arrow-right text-primary me-1"></i> Peminjaman ruangan dapat dilakukan apabila ruangan tersebut tersedia/tidak terpakai</small><br>
                                    <small><i class="mdi mdi-arrow-right text-primary me-1"></i> Apabila peminjaman hanya untuk 1 hari, masukkan Tanggal yang sama pada input tanggal <kbd>Mulai</kbd> dan <kbd>Selesai</kbd></small>
                                </div>

                                <div class="mb-2">
                                    <label>Pilih Ruangan <a class="text-danger">*</a></label>

                                    <div class="row">
                                        @if (!empty($list['ruangan']))
                                            @foreach ($list['ruangan'] as $item)
                                                <div class="col-xl-2 col-sm-4">
                                                    <div class="mb-3">
                                                        <label class="card-radio-label mb-2">
                                                            <input type="radio" name="ruangan" id="ruangan{{ $item->id }}" value="{{ $item->id }}" class="card-radio-input">

                                                            <div class="card-radio">
                                                                <div>
                                                                    {{-- <i class="mdi mdi-bitcoin font-size-24 text-warning align-middle me-2"></i> --}}
                                                                    <h5><i class="bx bx-hash text-primary"></i> {{ $item->nama }}</h5>
                                                                    <h6><small>Kapasitas : <mark>{{ $item->kapasitas }} Peserta</mark></small></h6>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                        {{-- <div>
                                            <p class="text-muted mb-1">Kapasitas :</p>
                                            <h5 class="font-size-16"></h5>
                                        </div> --}}
                                    </div>

                                </div>

                                <div class="mb-3">
                                    <label>Pilih Tanggal Acara <a class="text-danger">*</a></label>

                                    <div class="row">
                                        <div class="input-daterange input-group" id="datepicker6" data-date-format="dd-mm-yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                            <div class="col-sm-6">
                                                <div class="input-group mb-2 currency-value">
                                                    <span class="input-group-text">Mulai</span>

                                                    <input type="text" id="tgl_mulai" class="form-control" placeholder="dd-mm-yyyy" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tanggal mulai acara"/>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="input-group mb-2">
                                                    <input type="text" id="tgl_selesai" class="form-control" placeholder="dd-mm-yyyy" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tanggal selesai acara"/>

                                                    <span class="input-group-text">Selesai</span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-2">
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label>Waktu Mulai Acara <a class="text-danger">*</a></label>
                                            <div class="input-group" id="timepicker-input-group1">
                                                <span class="input-group-text"><i class="mdi mdi-clock-fast"></i></span>
                                                <input id="jam_mulai" type="text" class="form-control" data-provide="timepicker" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Waktu/Jam mulai acara">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <label>Waktu Selesai Acara <a class="text-danger">*</a></label>
                                            <div class="input-group" id="timepicker-input-group2">
                                                <span class="input-group-text"><i class="mdi mdi-clock-check-outline"></i></span>
                                                <input id="jam_selesai" type="text" class="form-control" data-provide="timepicker" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Waktu/Jam selesai acara">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label>Pesan Tambahan Untuk Bagian Gizi</label>
                                    <textarea rows="2" class="form-control" id="gizi" placeholder="e.g. Tolong siapkan snack untuk 10 peserta pelatihan terima kasih"></textarea>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="button" class="btn btn-success" id="btn-simpan" onclick="prosesSimpan()"><i class="fas fa-stamp"></i> Ajukan</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="sell" role="tabpanel">
                            <div class=" table-responsive" style="overflow: visible;" id="show-table" style="border: 0px">
                                <table class="table align-middle dt-responsive w-100 table-check table-hover" id="dttable">
                                    <thead>
                                        <tr>
                                            <th scope="col"><center>#ID</center></th>
                                            <th scope="col">Nama Ruangan</th>
                                            <th scope="col">Nama Peminjam</th>
                                            <th scope="col">Tanggal Acara</th>
                                            <th scope="col">Diperbarui</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tampil-tbody"></tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

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

            // DATEPICKER
            // DATE
            const today = new Date();
            var tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            var next = new Date(today);
            next.setDate(next.getDate() + 999999);
            const l = $('.flatpickr');
            const ln = $('.flatpickrnow');
            const lun = $('.flatpickrunl');
            const ltom = $('.flatpickrtom');
            const rang = $('.flatpickrrange');
            // const dates = new Date(Date.now());
            // const tomorow = dates.getTime();
            // const m = new Date(Date.now());
            // const c = new Date(Date.now() + 1728e5); // 3 hari kedepan
            var now = moment().locale('id').format('Y-MM-DD HH:mm');
            l.flatpickr({
                enableTime: 0,
                minuteIncrement: 1,
                // monthSelectorType: "static",
                // inline: true,
                // defaultHour: 12,
                // defaultMinute: "today",
                time_24hr: true,
                // dateFormat: "Y-m-d H:m",
                disable: [{
                    from: tomorrow.toISOString().split("T")[0],
                    to: next.toISOString().split("T")[0]
                }]
            })
            ln.flatpickr({
                enableTime: 0,
                defaultDate: now,
                minuteIncrement: 1,
                time_24hr: true,
                defaultMinute: "today",
                disable: [{
                    from: tomorrow.toISOString().split("T")[0],
                    to: next.toISOString().split("T")[0]
                }]
            })
            lun.flatpickr({
                enableTime: 0,
                minuteIncrement: 1,
                time_24hr: true,
                // defaultMinute: "today",
                // disable: [{
                //     from: tomorrow.toISOString().split("T")[0],
                //     to: next.toISOString().split("T")[0]
                // }]
            })
            ltom.flatpickr({
                enableTime: 0,
                minuteIncrement: 1,
                time_24hr: true,
                // defaultMinute: "today",
                minDate: "today",
                maxDate: "01.01.3000"
                // disable: [{
                //     from: tomorrow.toISOString().split("T")[0],
                //     to: today
                // }]
            })
            rang.flatpickr({
                mode: "range",
                minDate: "today",
                dateFormat: "",
                disable: [
                    // function(date) {
                        // disable every multiple of 8
                    //     return !(date.getDate() % 8);
                    // }
                ],
                enableTime: true,
                dateFormat: "d M y, H:i",
                // dateFormat: "Y-MM-DD HH:mm",
                time_24hr: true
            })
            $('#jam_mulai').timepicker({
                showMeridian: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                appendWidgetTo: "#timepicker-input-group1"
            });
            $('#jam_selesai').timepicker({
                showMeridian: false,
                icons: {
                    up: 'mdi mdi-chevron-up',
                    down: 'mdi mdi-chevron-down'
                },
                // defaultTime: add(30, 'minutes'),
                appendWidgetTo: "#timepicker-input-group2"
            });

    })

    // FUNCTION-FUNCTION
    function prosesSimpan() {
        $("#btn-simpan").prop('disabled', true);
        $("#btn-simpan").find("i").toggleClass("fa-stamp fa-sync fa-spin");

        // Definisi
        var save = new FormData();
        save.append('ruangan',$('input[name="ruangan"]:checked').val());
        save.append('tgl_mulai',$("#tgl_mulai").val());
        save.append('tgl_selesai',$("#tgl_selesai").val());
        save.append('jam_mulai',$("#jam_mulai").val());
        save.append('jam_selesai',$("#jam_selesai").val());
        save.append('gizi',$("#gizi").val());
        save.append('user','{{ Auth::user()->id }}');

        if (
            save.get('ruangan') == "" ||
            save.get('tgl_mulai') == "" ||
            save.get('tgl_selesai') == "" ||
            save.get('jam_mulai') == "" ||
            save.get('jam_selesai') == ""
        ) {
            iziToast.warning({
                title: 'Pesan Ambigu!',
                message: 'Pastikan Anda tidak mengosongi semua isian Wajib',
                position: 'topRight'
            });
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '/api/eruang/store',
                contentType: false,
                processData: false,
                dataType: 'json',
                data: save,
                success: function(res) {
                    iziToast.success({
                        title: 'Sukses!',
                        message: 'Tambah Sarana berhasil pada '+ res,
                        position: 'topRight'
                    });
                    if (res) {
                        // refresh();
                    }
                },
                error: function (res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: res.responseJSON.error,
                        position: 'topRight'
                    });
                }
            });
        }

        $("#btn-simpan").find("i").removeClass("fa-sync fa-spin").addClass("fa-stamp");
        $("#btn-simpan").prop('disabled', false);
    }
</script>
@endsection
