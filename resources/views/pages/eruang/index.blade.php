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
                            <a class="nav-link active" data-bs-toggle="tab" href="#pengajuan" role="tab">
                                Pengajuan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#riwayat" role="tab">
                                Daftar Riwayat
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#display" role="tab">
                                Display Gizi
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content crypto-buy-sell-nav-content p-4">
                        <div class="tab-pane active" id="pengajuan" role="tabpanel">
                            <form>
                                <div class="mb-4">
                                    <label><mark>Ketentuan</mark></label><br>
                                    <small><i class="mdi mdi-arrow-right text-primary me-1"></i> Peminjaman ruangan dapat dilakukan apabila ruangan tersebut tersedia/tidak terpakai</small><br>
                                    <small><i class="mdi mdi-arrow-right text-primary me-1"></i> Perubahan data hanya dapat dilakukan <kbd>H-1</kbd> Acara dan maksimal sebelum <kbd>Jam 12:00 WIB</kbd></small><br>
                                    <small><i class="mdi mdi-arrow-right text-primary me-1"></i> Pada pemilihan Jam & Menit tidak boleh sama</small>
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

                                <div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label>Agenda Acara <a class="text-danger">*</a></label>
                                            <input type="text" id="agenda" class="form-control" placeholder="e.g. Rapat Rutin Bagian **" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tuliskan nama acara"/>

                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label>Pilih Tanggal Acara <a class="text-danger">*</a></label>
                                            <div class="input-daterange input-group" id="datepicker6" data-date-format="dd-mm-yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                                <input type="text" id="tgl" class="form-control" placeholder="dd-mm-yyyy" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tanggal acara"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label>Pilih Waktu Acara <a class="text-danger">*</a></label>

                                    <div class="row" style="text-align: center">
                                        {{-- <div class="input-daterange input-group" id="datepicker6" data-date-format="dd-mm-yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'> --}}
                                            <div class="col-sm-6 mb-3">
                                                <div class="input-daterange input-group clock-value" id="timepicker-input-group1">
                                                    <span class="input-group-text">Mulai</span>
                                                    <input id="jam_mulai" type="text" class="form-control" data-provide="timepicker" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Waktu/Jam mulai acara">
                                                </div>
                                            </div>

                                            <div class="col-sm-6 mb-3">
                                                <div class="input-daterange input-group" id="timepicker-input-group2">
                                                    <input id="jam_selesai" type="text" class="form-control" data-provide="timepicker" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Waktu/Jam selesai acara">
                                                    <span class="input-group-text">Selesai</span>
                                                </div>
                                            </div>
                                        {{-- </div> --}}
                                    </div>
                                </div>

                                <div>
                                    <div class="row">
                                        <div class="col-sm-6 mb-3">
                                            <label>Keterangan</label>
                                            <textarea rows="2" class="form-control" id="ket" placeholder="Optional"></textarea>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <label>Pesan Tambahan Untuk Bagian Gizi</label>
                                            <textarea rows="2" class="form-control" id="gizi" placeholder="e.g. Tolong siapkan snack untuk 10 peserta pelatihan terima kasih"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-4">
                                    <button type="button" class="btn btn-success" id="btn-simpan" onclick="prosesSimpan()" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Ajukan untuk melanjutkan proses Verifikasi Jadwal"><i class="fas fa-stamp"></i> Ajukan</button>
                                </div>
                            </form>
                        </div>

                        <div class="tab-pane" id="riwayat" role="tabpanel">
                            <div class=" table-responsive" style="overflow: visible;" id="show-table" style="border: 0px">
                                <table class="table align-middle dt-responsive w-100 table-check table-hover" id="dttable">
                                    <thead>
                                        <tr>
                                            <th scope="col"><center>Aksi</center></th>
                                            <th scope="col">Nama Ruangan</th>
                                            <th scope="col">Peminjam</th>
                                            <th scope="col">Tanggal Acara</th>
                                            <th scope="col">Waktu Acara</th>
                                            <th scope="col">Keterangan</th>
                                            <th scope="col">Diperbarui</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tampil-tbody"></tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane" id="display" role="tabpanel">
                            INI TAMPILAN DISPLAY
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


        // <th scope="col"><center>Aksi</center></th>
        // <th scope="col">Nama Ruangan</th>
        // <th scope="col">Peminjam</th>
        // <th scope="col">Tanggal Acara</th>
        // <th scope="col">Waktu Acara</th>
        // <th scope="col">Keterangan</th>
        // <th scope="col">Diperbarui</th>

    })

    // FUNCTION-FUNCTION
    // ----------------------------------------------------------------------------------------
    function riwayat() {
        $("#tampil-tbody").empty().append(
            `<tr><td colspan="20"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr>`
        );
        $.ajax({
            url: "/api/eruang/table",
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                $("#tampil-tbody").empty();
                $('#dttable').DataTable().clear().destroy();
                var userID = "{{ Auth::user()->id }}";
                var adminID = "{{ Auth::user()->getManyRole(['it','kasubag-tata-usaha']) }}";
                var date = new Date().toLocaleDateString();
                res.show.forEach(item => {
                    var updet = new Date(item.created_at).toLocaleDateString();
                    // var unit = JSON.parse(item.unit.replace(/"/g,""));
                    if (adminID == true) {
                    } else {
                        if (userID == item.id_user) {
                            if (updet == date) {
                            }
                        }
                    }
                    content = `<tr><td><div class="d-flex align-items-center">
                                        <div class="dropdown">
                                            <a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0 btn-icon" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="javascript:;" onclick="ubah(` + item.id + `)" class="dropdown-item text-warning"><i class='bx bx-edit scaleX-n1-rtl'></i> Ubah</a>
                                                <a href="javascript:;" onclick="hapus(` + item.id + `)" class="dropdown-item text-danger"><i class='bx bx-trash scaleX-n1-rtl'></i> Hapus</a>
                                            </div>
                                        </div>
                                    </div></td>`;
                    content += `<td></td>`;
                    content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                    <div class='d-flex justify-content-start align-items-center'>
                                        <div class='d-flex flex-column'>
                                            <h6 class='mb-0'><span class="badge bg-secondary">`+item.kapasitas+`P</span> <u>`+item.nama_ruangan+`</u></h6>
                                            <h6 class='mb-0'><small class='text-truncate text-muted'>`+item.agenda+`</small></h6>
                                        </div>
                                    </div>
                                </td>`;
                    content += `<td style='white-space: normal !important;word-wrap: break-word;'>
                                    <div class='d-flex justify-content-start align-items-center'>
                                        <div class='d-flex flex-column'>
                                            <h6 class='mb-0'>`+item.nama_user+`</h6>
                                            <h6 class='mb-0'><small class='text-truncate text-muted'>`+item.unit+`</small></h6>
                                            <h6 class='mb-0'><small class='text-truncate text-muted'>`+item.no_hp+`</small></h6>
                                        </div>
                                    </div>
                                </td>`;
                    content += `<td>`+item.tgl+`</td>`;
                    content += `<td>`+item.tgl+`</td>`;
                    content += `<td>`+item.jam_mulai+` - `+item.jam_selesai+` WIB</td>`;
                    content += `<td>`+item.ket+`</td>`;
                    // unit.forEach(val => {
                    //     res.role.forEach(pus => {
                    //         if (val == pus.id) {
                    //             content += `<span class="badge bg-dark">` + pus.name +
                    //                 `</span>&nbsp;`;
                    //         }
                    //     })
                    // })
                    content += `<td>`+item.updated_at.substring(0, 19).replace('T',' ')+`</td></tr>`;
                    $('#tampil-tbody').append(content);
                })

                var table = $('#dttable').DataTable({
                    order: [
                        [6, "desc"]
                    ],
                    // bAutoWidth: false,
                    // aoColumns : [
                    //     { sWidth: '5%' },
                    //     { sWidth: '20%' },
                    //     { sWidth: '20%' },
                    //     { sWidth: '25%' },
                    //     { sWidth: '10%' },
                    // ],
                    displayLength: 7,
                    lengthChange: true,
                    lengthMenu: [7, 10, 25, 50, 75, 100],
                    buttons: ['copy', 'excel', 'pdf', 'colvis']
                });

                table.buttons().container()
                    .appendTo('#dttable_wrapper .col-md-6:eq(0)');

                // Showing Tooltip
                $('[data-bs-toggle="tooltip"]').tooltip({
                    trigger: 'hover'
                })
            }
        })
    }

    function prosesSimpan() {
        // $("#btn-simpan").prop('disabled', true);
        $("#btn-simpan").find("i").toggleClass("fa-stamp fa-sync fa-spin");

        // Definisi
        var save = new FormData();
        save.append('agenda',$("#agenda").val());
        save.append('ruangan',$('input[name="ruangan"]:checked').val());
        save.append('tgl',$("#tgl").val());
        save.append('jam_mulai',$("#jam_mulai").val());
        save.append('jam_selesai',$("#jam_selesai").val());
        save.append('ket',$("#ket").val());
        save.append('gizi',$("#gizi").val());
        save.append('user','{{ Auth::user()->id }}');

        console.log(save.get('ruangan'));
        if (
            $('input[name="ruangan"]:checked').val() == null ||
            save.get('agenda') == "" ||
            save.get('tgl') == "" ||
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
                    if (res.code == 400) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: res.message,
                            position: 'topRight',
                            buttons: [
                                [
                                    '<button>Tutup</button>',
                                    function (instance, toast) {
                                        instance.hide({
                                            transitionOut: 'fadeOutUp'
                                        }, toast);
                                    }
                                ]
                            ]
                        });
                        // iziToast.show(
                        // {
                        //     color: 'danger',
                        //     icon: 'fa fa-user',
                        //     title: 'Halo {{ Auth::user()->nama }}, ',
                        //     message: res.message,
                        //     position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                        //     progressBarColor: 'rgb(0, 255, 184)',
                        //     buttons: [
                        //         // [
                        //         //     '<button>Ok</button>',
                        //         //     function (instance, toast) {
                        //         //     alert("Hello world!");
                        //         //     }
                        //         // ],
                        //         [
                        //             '<button>Tutup</button>',
                        //             function (instance, toast) {
                        //                 instance.hide({
                        //                     transitionOut: 'fadeOutUp'
                        //                 }, toast);
                        //             }
                        //         ]
                        //     ]
                        // });
                    } else {
                        iziToast.success(
                        {
                            icon: 'fa fa-check',
                            title: 'Pesan Sukses',
                            message: res.message,
                            position: 'topRight', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                            progressBarColor: 'rgb(0,0,0)',
                            buttons: [
                                [
                                    '<button>Tutup</button>',
                                    function (instance, toast) {
                                        instance.hide({
                                            transitionOut: 'fadeOutUp'
                                        }, toast);
                                    }
                                ]
                            ]
                        });
                    }
                    // iziToast.success({
                    //     title: 'Sukses!',
                    //     message: 'Tambah Sarana berhasil pada '+ res,
                    //     position: 'topRight'
                    // });
                    // if (res) {
                    // }
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
        // iziToast.error({
        //     title: 'Pesan Developer!',
        //     message: 'Sistem sedang dalam pengembangan',
        //     position: 'topRight'
        // });
    }
</script>
@endsection
