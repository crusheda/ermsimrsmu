@extends('layouts.index')

@section('content')
    <style>
        #calendar {
            /* max-width: 900px; */
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            padding: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
    </style>

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Kalender Digital</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Kalender Digital <b class="text-primary">Manajemen</b></h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        <div class="col-xl-12">
            <div class="card mb-3">
                <div class="card-header d-flex align-items-center justify-content-between py-2 px-2">
                    {{-- <button type="button" class="btn btn-info rounded" onclick="refresh()" disabled><i class="fa-fw fas fa-sort-amount-down nav-icon me-1"></i></button> --}}
                    <h6 class="ms-2 mb-0">Klik <span class="badge text-bg-primary">BARIS KALENDER</span> untuk melihat <mark>Detail Acara</mark></h6>
                    <div class="btn-group">
                        <button type="button" class="btn btn-info rounded" onclick="window.location='{{ route('eruang.index') }}'" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Tambah Acara / Kegiatan"><i class="fa-fw fas fa-plus-square nav-icon me-1"></i> Tambah Acara <span class="badge bg-light text-dark ms-1 p-1">E-Ruang</span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div id="calendar" class="calendar"><center><i class="fa-fw fas fa-spinner fa-spin nav-icon me-1"></i> Memuat Kalender...</center></div>
        </div>
    </div>

    <div class="modal fade" id="calendar-modal" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="calendar-modal-title f-w-600 text-truncate">Modal title</h4><a href="#"
                        class="avtar avtar-s btn-link-danger btn-pc-default ms-auto" data-bs-dismiss="modal"><i
                            class="ti ti-x f-20"></i></a>
                </div>
                <div class="modal-body">
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-xs bg-light-secondary"><i class="ti ti-heading f-20"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><b>Agenda / Kegiatan</b></h5>
                            <p class="pc-event-title text-muted"></p>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-xs bg-light-warning"><i class="ti ti-map-pin f-20"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><b>Ruangan</b></h5>
                            <p class="pc-event-venue text-muted"></p>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-xs bg-light-danger"><i class="ti ti-calendar-event f-20"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><b>Waktu</b></h5>
                            <p class="pc-event-date text-muted"></p>
                        </div>
                    </div>
                    <div class="d-flex mb-2">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-xs bg-light-primary"><i class="ti ti-file-text f-20"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><b>Keterangan</b></h5>
                            <p class="pc-event-description text-muted"></p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avtar avtar-xs bg-light-info"><i class="ti ti-user-check f-20"></i></div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="mb-1"><b>Ditambahkan Oleh</b></h5>
                            <p class="pc-event-user text-muted"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <p class="pc-event-created"></p>
                    {{-- <ul class="list-inline me-auto mb-0">
                        <li class="list-inline-item align-bottom"><a href="#" id="pc_event_remove"
                                class="avtar avtar-s btn-link-danger btn-pc-default w-sm-auto" data-bs-toggle="tooltip"
                                title="Delete"><i class="ti ti-trash f-18"></i></a></li>
                        <li class="list-inline-item align-bottom"><a href="#" id="pc_event_edit"
                                class="avtar avtar-s btn-link-success btn-pc-default" data-bs-toggle="tooltip"
                                title="Edit"><i class="ti ti-edit-circle f-18"></i></a></li>
                    </ul> --}}
                    <div class="flex-grow-1 text-end"><button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Tutup</button></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            loadCalendar();

            // 🔹 Jika punya dropdown filter ruangan
            $('#filter-unit').on('change', function() {
                loadCalendar($(this).val());
            });
        });

        function loadCalendar(unit = null) {

            $('#calendar').html('');

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'id',
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                },
                themeSystem: "bootstrap",
                selectable: true,
                editable: false,
                dayMaxEvents: true,

                events: {
                    url: '/api/kalender/data',
                    method: 'GET',
                    extraParams: {
                        unit: unit
                    },
                    failure: function() {
                        alert('Gagal memuat data event!');
                    }
                },

                eventDidMount: function(info) {
                    info.el.style.backgroundColor = info.event.backgroundColor;
                    info.el.style.borderColor = info.event.backgroundColor;
                    info.el.style.color = info.event.textColor;
                },

                eventClick: function(info) {
                    let ev = info.event;
                    let ket = ev.extendedProps.ket ?? '-';
                    let ruangan = ev.extendedProps.ruangan ?? '-';
                    let addedBy = ev.extendedProps.added_by ?? '-';
                    let addedAt = ev.extendedProps.added_at ?? '-';

                    // Format tanggal ke: Senin, 1 Desember 2025
                    let start = new Date(ev.start);
                    let end = ev.end ? new Date(ev.end) : null;

                    const hari = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
                    const bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

                    function formatJam(tgl) {
                        let jam = String(tgl.getHours()).padStart(2, '0');
                        let menit = String(tgl.getMinutes()).padStart(2, '0');
                        return `${jam}:${menit}`;
                    }

                    let tglText = `${hari[start.getDay()]}, ${start.getDate()} ${bulan[start.getMonth()]} ${start.getFullYear()}`;

                    let jamMulai = formatJam(start);
                    let jamSelesai = end ? formatJam(end) : jamMulai;

                    let finalDateText = `${tglText} Pukul ${jamMulai} - ${jamSelesai} WIB`;

                    // Isi modal
                    $('.calendar-modal-title').html('<span class="badge text-bg-dark">Detail Acara</span> '+ev.title);
                    $('.pc-event-title').text(ev.title);
                    $('.pc-event-venue').text(ruangan);
                    $('.pc-event-date').text(finalDateText);
                    $('.pc-event-description').text(ket);
                    $('.pc-event-user').text(addedBy);
                    $('.pc-event-created').text('Ditambahkan pada '+new Date(addedAt).toLocaleString("sv-SE"));

                    // Tampilkan modal
                    $('#calendar-modal').modal('show');
                }
            });

            calendar.render();
        }
    </script>
@endsection
