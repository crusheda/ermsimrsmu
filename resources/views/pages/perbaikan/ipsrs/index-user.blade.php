@extends('layouts.index')

@section('content')
    {{-- Sistem Tracking --}}
    <link href="{{ asset('css/tracking.css') }}" rel="stylesheet" />

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Pengaduan</li>
                        <li class="breadcrumb-item">Perbaikan</li>
                        <li class="breadcrumb-item" aria-current="page">IPSRS</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Perbaikan IPSRS</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        {{-- BARIS 1 --}}
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">{{ $list['total'] }}</h3>
                            <p class="text-muted mb-0">Total Pengaduan <b class="text-primary">Anda</b></p>
                        </div>
                        <div class="col-4 text-end"><i class="ti ti-license text-secondary f-36"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">-</h3>
                            <p class="text-muted mb-0">Total Dikerjakan</p>
                        </div>
                        <div class="col-4 text-end"><i class="ti ti-clock text-primary f-36"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">{{ $list['totalselesai'] }}</h3>
                            <p class="text-muted mb-0">Total Diselesaikan</p>
                        </div>
                        <div class="col-4 text-end"><i class="ti ti-clipboard-check text-success f-36"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-1">{{ $list['totalditolak'] }}</h3>
                            <p class="text-muted mb-0">Total Ditolak</p>
                        </div>
                        <div class="col-4 text-end"><i class="ti ti-file-text text-danger f-36"></i></div>
                    </div>
                </div>
            </div>
        </div>
        {{-- BARIS 2 --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <h5 class="mb-0 card-title flex-grow-1">Form Tambah</h5>
                </div>
                <div class="card-body">
                    <form method="POST" id="formTambah" action="{{ route('ipsrs.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="text" name="user_id" value="{{ Auth::user()->id }}" hidden>
                        <div class="form-group mb-3">
                            <label for="defaultFormControlInput" class="form-label">Lokasi <a class="text-danger">*</a></label>
                            <input type="text" name="lokasi" id="clr_lokasi"
                                class="form-control typeahead-bloodhound" placeholder="Teks Otomatis" autocomplete="off"
                                required />
                        </div>
                        <div class="form-group mb-3">
                            <label for="defaultFormControlInput" class="form-label">Pengaduan <a class="text-danger">*</a></label>
                            <div class="form-group">
                                <textarea rows="3" class="autosize1 form-control" name="pengaduan" id="clr_pengaduan"
                                    placeholder="Deskripsi Pengaduan Anda" required></textarea>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="defaultFormControlInput" class="form-label">Lampiran (<strong>Optional</strong>) : </label>
                            <input type="file" name="file" id="imgInp" class="form-control mb-3">
                            <div class="alert alert-secondary">
                                <small>
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> Disarankan untuk menyertakan lampiran foto <br>
                                    <i class="fa-fw fas fa-caret-right nav-icon"></i> Pastikan upload Foto/Gambar bukan Video, berformat <b>jpg,png,jpeg</b>
                                </small>
                            </div>
                            <center>
                                <div class="card" style="width: 18rem;margin-top:20px">
                                    <a class="image-popup-vertical-fit" id="blah_a" href="">
                                        <img class="card-img-top" id="blah" src="{{ asset('images/no-image.png') }}"
                                            alt="Tidak ada lampiran">
                                    </a>
                                </div>
                            </center>
                        </div>
                        <div class="d-flex justify-content-center" style="margin-bottom:-15px">
                            <div class="btn-group">
                                <button class="btn btn-primary" onclick="simpan()" id="btn-simpan" type="submit">
                                    <i class="fa-fw fas fa-save nav-icon"></i> Submit
                                </button>
                    </form>
                                <button class="btn btn-outline-warning" onclick="clearInp()" type="button">
                                    <i class="fa-fw fas fa-eraser nav-icon"></i>
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @if (count($list['recent']) > 0)
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h5 class="mb-0 card-title flex-grow-1">Pengaduan Berjalan <span class="badge bg-secondary text-light">{{ count($list['recent']) }}</span></h5>
                    </div>
                    <div class="card-body">
                        <div> {{-- style="max-height: 295px;" --}}
                            <div class="row">
                                @for ($i = 0; $i < count($list['recent']); $i++)
                                    <div class="col-12 mb-3">
                                        <div class="card shadow border mb-0">
                                            <div class="card-body p-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="flex-shrink-0">
                                                        @if (!empty($list['recent'][$i]->filename_pengaduan))
                                                            <a class="image-popup-no-margins" href="{{ url('storage/' . substr($list['recent'][$i]->filename_pengaduan, 7, 1000)) }}" data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                                data-bs-placement="bottom" data-bs-html="true" title="Klik untuk lihat lampiran">
                                                                <img class="img-fluid" alt="" src="{{ url('storage/' . substr($list['recent'][$i]->filename_pengaduan, 7, 1000)) }}" style="width:3.5rem">
                                                            </a>
                                                            {{-- <img src="{{ url('storage/' . substr($list['recent'][$i]->filename_pengaduan, 7, 1000)) }}"
                                                            class="avatar-md h-auto d-block rounded" alt="Image Request" style="width:6.5rem"/> <!-- height="62" width="62"  --> --}}
                                                        @else
                                                            <img class="img-fluid" alt="" src="{{ url("images/no-image.png") }}" style="width:3.5rem">
                                                        @endif
                                                        {{-- <img src="../assets/images/widget/img-acitivity-3.svg" alt="img" class="wid-30 rounded"> --}}
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h6 class="mb-0">
                                                            {{ $list['recent'][$i]->lokasi }}&nbsp;
                                                            @if (!empty($list['recent'][$i]->tgl_selesai) && empty($list['recent'][$i]->ket_penolakan))
                                                                <span class="badge" style="background-color: turquoise">Selesai</span>
                                                            @elseif (!empty($list['recent'][$i]->ket_penolakan))
                                                                <span class="badge" style="background-color: red">Ditolak</span>
                                                            @elseif (empty($list['recent'][$i]->tgl_diterima))
                                                                <span class="badge" style="background-color: rebeccapurple">Diverifikasi</span>
                                                            @elseif (empty($list['recent'][$i]->tgl_dikerjakan))
                                                                <span class="badge" style="background-color: salmon">Diterima</span>
                                                            @elseif (empty($list['recent'][$i]->tgl_selesai))
                                                                <span class="badge" style="background-color: orange">Dikerjakan</span>
                                                            @endif
                                                        </h6>
                                                        <p class="mb-0">
                                                            <small>{{ $list['recent'][$i]->ket_pengaduan }} <br>
                                                            {{ \Carbon\Carbon::parse($list['recent'][$i]->tgl_pengaduan)->isoFormat('dddd, D MMMM Y, HH:mm a') }}</small>
                                                        </p>
                                                    </div>
                                                    <div class="flex-shrink-0">
                                                        <button class="btn btn-primary btn-sm align-middle" data-bs-target="#track{{ $list['recent'][$i]->id }}" data-bs-toggle="modal">
                                                            Lihat&nbsp;&nbsp;<span class="badge bg-light text-dark">ID : {{ $list['recent'][$i]->id }}</span>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <!-- Tab panes -->
                        </div>
                    </div>
                </div>
            @endif
            <div class="card table-card">
                <div class="card-header d-flex align-items-center justify-content-between py-3">
                    <h5 class="mb-0 card-title flex-grow-1">Riwayat Pengaduan <a class="text-primary">IPSRS</a></h5>
                    <div class="flex-shrink-0">
                        <div class="btn-group">
                            <button type="button" class="btn btn-outline-warning" id="btn-refresh" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                title="Tabel Disposisi Surat Masuk akan disegarkan" onclick="refresh()">
                                <i class="fa-fw fas fa-sync nav-icon me-1"></i>Segarkan</button>
                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                title="Tampilkan Semua Data" onclick="showAll()">
                                <i class="fa-fw fas fa-infinity nav-icon"></i></button>
                            <button type="button" class="btn btn-outline-secondary" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                title="Informasi Sistem Disposisi" disabled>
                                <i class="fa-fw fas fa-info nav-icon me-1"></i><s>Informasi</s></button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="alert alert-secondary m-2">
                        <small>
                            <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Data default yang ditampilkan dibatasi 100 data surat <br>
                            <i class="ti ti-arrow-narrow-right text-primary me-1"></i> Untuk menampilkan semua data, klik tombol berwarna <b class="text-danger">MERAH</b> di atas
                        </small>
                    </div>
                    <div class="table-responsive">
                        <table id="dttable" class="table dt-responsive table-hover nowrap w-100 align-middle">
                            <thead>
                                <tr>
                                    <th>
                                        <center>ID</center>
                                    </th>
                                    <th>LOKASI</th>
                                    <th>STATUS</th>
                                    <th>TGL PENGADUAN</th>
                                    <th>
                                        <center>AKSI</center>
                                    </th>
                                </tr>
                            </thead>
                            <tbody style="text-transform: capitalize;font-size: 13px">
                                @if (count($list['show']) > 0)
                                    @foreach ($list['show'] as $item)
                                        <tr>
                                            <td>
                                                <center>
                                                    <button type="button" class="btn btn-label-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#track{{ $item->id }}"><i
                                                            class="fa-fw fas fa-search nav-icon"></i>
                                                        {{ $item->id }}</button>
                                                </center>
                                            </td>
                                            <td>{{ $item->lokasi }}</td>

                                            @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                                                <td><kbd style="background-color: turquoise">Selesai</kbd></td>
                                            @elseif (!empty($item->ket_penolakan))
                                                <td><kbd style="background-color: red">Ditolak</kbd></td>
                                            @elseif (empty($item->tgl_diterima))
                                                <td><kbd style="background-color: rebeccapurple">Diverifikasi</kbd></td>
                                            @elseif (empty($item->tgl_dikerjakan))
                                                <td><kbd style="background-color: salmon">Diterima</kbd></td>
                                            @elseif (empty($item->tgl_selesai))
                                                <td><kbd style="background-color: orange">Dikerjakan</kbd></td>
                                            @endif

                                            <td>{{ $item->tgl_pengaduan }}</td>
                                            <td>
                                                <center>
                                                    <div class="btn-group">
                                                        @if (empty($item->tgl_selesai))
                                                            @if (!empty($item->tgl_diterima))
                                                                <button type="button" class="btn btn-secondary btn-sm text-white"
                                                                    disabled><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                                                @if (empty($item->filename_pengaduan))
                                                                    <button type="button"
                                                                        class="btn btn-secondary btn-sm text-white" disabled><i
                                                                            class="fa-fw fas fa-image nav-icon"></i></button>
                                                                @else
                                                                    <a class="btn btn-sm btn-info image-popup-vertical-fit" href="{{ url('storage/' . substr($item->filename_pengaduan, 7, 1000)) }}">
                                                                        <i class="fa-fw fas fa-image nav-icon"></i>
                                                                        <img class="img-fluid" alt="" src="{{ url('storage/' . substr($item->filename_pengaduan, 7, 1000)) }}" style="width:6.5rem" hidden>
                                                                    </a>
                                                                    {{-- <button type="button" class="btn btn-info btn-sm text-white"
                                                                        onclick="showLampiran({{ $item->id }})"><i class="fa-fw fas fa-image nav-icon"></i></button> --}}
                                                                @endif
                                                                <button type="button" class="btn btn-secondary btn-sm text-white"
                                                                    disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                            @else
                                                                <button type="button" class="btn btn-warning btn-sm text-white"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#ubah{{ $item->id }}"><i
                                                                        class="fa-fw fas fa-edit nav-icon"></i></button>
                                                                @if (empty($item->filename_pengaduan))
                                                                    <button type="button"
                                                                        class="btn btn-secondary btn-sm text-white" disabled><i
                                                                            class="fa-fw fas fa-image nav-icon"></i></button>
                                                                @else
                                                                    <a class="btn btn-sm btn-info image-popup-vertical-fit" href="{{ url('storage/' . substr($item->filename_pengaduan, 7, 1000)) }}">
                                                                        <i class="fa-fw fas fa-image nav-icon"></i>
                                                                        <img class="img-fluid" alt="" src="{{ url('storage/' . substr($item->filename_pengaduan, 7, 1000)) }}" style="width:6.5rem" hidden>
                                                                    </a>
                                                                    {{-- <button type="button" class="btn btn-info btn-sm text-white"
                                                                        onclick="showLampiran({{ $item->id }})"><i
                                                                            class="fa-fw fas fa-image nav-icon"></i></button> --}}
                                                                @endif
                                                                <button type="button" class="btn btn-danger btn-sm text-white"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#hapus{{ $item->id }}"><i
                                                                        class="fa-fw fas fa-trash nav-icon"></i></button>
                                                            @endif
                                                        @else
                                                            <button type="button" class="btn btn-secondary btn-sm text-white"
                                                                disabled><i class="fa-fw fas fa-edit nav-icon"></i></button>
                                                            @if (empty($item->filename_pengaduan))
                                                                <button type="button" class="btn btn-secondary btn-sm text-white"
                                                                    disabled><i class="fa-fw fas fa-image nav-icon"></i></button>
                                                            @else
                                                                <a class="btn btn-sm btn-info image-popup-vertical-fit" href="{{ url('storage/' . substr($item->filename_pengaduan, 7, 1000)) }}">
                                                                    <i class="fa-fw fas fa-image nav-icon"></i>
                                                                    <img class="img-fluid" alt="" src="{{ url('storage/' . substr($item->filename_pengaduan, 7, 1000)) }}" style="width:6.5rem" hidden>
                                                                </a>
                                                                {{-- <button type="button" class="btn btn-info btn-sm text-white"
                                                                    onclick="showLampiran({{ $item->id }})"><i
                                                                        class="fa-fw fas fa-image nav-icon"></i></button> --}}
                                                            @endif
                                                            <button type="button" class="btn btn-secondary btn-sm text-white"
                                                                disabled><i class="fa-fw fas fa-trash nav-icon"></i></button>
                                                        @endif
                                                    </div>
                                                </center>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL START --}}
    @foreach ($list['show'] as $item)
        <div class="modal fade" id="ubah{{ $item->id }}" data-bs-backdrop="static" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Data <kbd>ID : {{ $item->id }}</kbd></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        {{ Form::model($item, ['route' => ['ipsrs.update', $item->id], 'method' => 'PUT', 'id' => 'formUbah']) }}
                        @csrf
                        <input type="text" name="id" value="{{ $item->id }}" hidden>
                        <div class="form-group mb-3">
                            <label for="defaultFormControlInput" class="form-label">Lokasi</label>
                            <input type="text" name="lokasi" class="form-control typeahead-bloodhound"
                                value="{{ $item->lokasi }}" placeholder="Masukkan Lokasi" autocomplete="off" required />
                        </div>
                        <div class="form-group mb-3">
                            <label for="defaultFormControlInput" class="form-label">Pengaduan</label>
                            <div class="form-group">
                                <textarea rows="3" class="autosize1 form-control" name="pengaduan" placeholder="Deskripsi Pengaduan Anda"
                                    required><?php echo htmlspecialchars($item->ket_pengaduan); ?></textarea>
                            </div>
                        </div>
                        <sub><i class="fa-fw fas fa-caret-right nav-icon"></i> Apabila laporan sudah berada pada status
                            <kbd style="background-color: salmon">DITERIMA</kbd> oleh IPSRS, anda tidak dapat lagi mengubah
                            ataupun menghapus laporan ini.</sub>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary pull-right" type="submit"><i
                                class="fa-fw fas fa-save nav-icon"></i> Simpan</button>
                        {!! Form::close() !!}
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="track{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tracking <kbd>ID : {{ $item->id }}</kbd></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bg-white p-2 border rounded px-3">
                                    <div class="d-flex flex-row justify-content-between align-items-center order">
                                        <div class="d-flex flex-column order-details"><span><b>Pengaduan :</b>
                                                <br>{{ $item->ket_pengaduan }}</span><span class="date">Pada tgl
                                                {{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM, YYYY HH:mm A') }}</span>
                                        </div>
                                    </div>
                                    {{-- Selesai --}}
                                    @if (!empty($item->tgl_selesai) && empty($item->ket_penolakan))
                                        <div
                                            class="d-flex flex-row justify-content-between align-items-center align-content-center">
                                            <span class="dot"></span>
                                            <hr class="flex-fill track-line"><span class="dot"></span>
                                            <hr class="flex-fill track-line"><span class="dot"></span>
                                            <hr class="flex-fill track-line"><span
                                                class="d-flex justify-content-center align-items-center big-dot dot"><i
                                                    class="fa fa-check text-white"></i></span>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex flex-column align-items-start">
                                                <span>{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM') }}</span><span>Pengaduan</span>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <span>{{ \Carbon\Carbon::parse($item->tgl_diterima)->isoFormat('DD MMM') }}</span><span>Diterima</span>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <span>{{ \Carbon\Carbon::parse($item->tgl_dikerjakan)->isoFormat('DD MMM') }}</span><span>Dikerjakan</span>
                                            </div>
                                            <div class="d-flex flex-column align-items-center">
                                                <span>{{ \Carbon\Carbon::parse($item->tgl_selesai)->isoFormat('DD MMM') }}</span><span>Selesai</span>
                                            </div>
                                        </div>
                                        {{-- Ditolak --}}
                                    @elseif (!empty($item->ket_penolakan))
                                        <div
                                            class="d-flex flex-row justify-content-between align-items-center align-content-center">
                                            <span class="dot-ditolak"></span>
                                            <hr class="flex-fill track-line-ditolak"><span class="dot-ditolak"></span>
                                            <hr class="flex-fill track-line-ditolak"><span class="dot-ditolak"></span>
                                            <hr class="flex-fill track-line-ditolak"><span
                                                class="d-flex justify-content-center align-items-center big-dot-ditolak dot-ditolak"><i
                                                    class="fa fa-times text-white"></i></span>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex flex-column align-items-start"></div>
                                            <div class="d-flex flex-column justify-content-center"></div>
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                            </div>
                                            <div class="d-flex flex-column align-items-center">
                                                <span>{{ \Carbon\Carbon::parse($item->tgl_selesai)->isoFormat('DD MMM') }}</span><span>Ditolak</span>
                                            </div>
                                        </div>
                                        {{-- Diverifikasi --}}
                                    @elseif (empty($item->tgl_diterima))
                                        <div
                                            class="d-flex flex-row justify-content-between align-items-center align-content-center">
                                            <span class="d-flex justify-content-center align-items-center big-dot dot"><i
                                                    class="fa fa-check text-white"></i></span>
                                            <hr class="flex-fill"><span class="dot"></span>
                                            <hr class="flex-fill"><span class="dot"></span>
                                            <hr class="flex-fill"><span class="dot"></span>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex flex-column align-items-start">
                                                <span>{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM') }}</span><span>Pengaduan</span>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <span>-</span><span>Diterima</span>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <span>-</span><span>Dikerjakan</span>
                                            </div>
                                            <div class="d-flex flex-column align-items-center">
                                                <span>-</span><span>Selesai</span>
                                            </div>
                                        </div>
                                        {{-- Diterima --}}
                                    @elseif (empty($item->tgl_dikerjakan))
                                        <div
                                            class="d-flex flex-row justify-content-between align-items-center align-content-center">
                                            <span class="dot"></span>
                                            <hr class="flex-fill track-line"><span
                                                class="d-flex justify-content-center align-items-center big-dot dot"><i
                                                    class="fa fa-check text-white"></i></span>
                                            <hr class="flex-fill"><span class="dot"></span>
                                            <hr class="flex-fill"><span class="dot"></span>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex flex-column align-items-start">
                                                <span>{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM') }}</span><span>Pengaduan</span>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <span>{{ \Carbon\Carbon::parse($item->tgl_diterima)->isoFormat('DD MMM') }}</span><span>Diterima</span>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <span>-</span><span>Dikerjakan</span>
                                            </div>
                                            <div class="d-flex flex-column align-items-center">
                                                <span>-</span><span>Selesai</span>
                                            </div>
                                        </div>
                                        {{-- Dikerjakan --}}
                                    @elseif (empty($item->tgl_selesai))
                                        <div
                                            class="d-flex flex-row justify-content-between align-items-center align-content-center">
                                            <span class="dot"></span>
                                            <hr class="flex-fill track-line"><span class="dot"></span>
                                            <hr class="flex-fill track-line"><span
                                                class="d-flex justify-content-center align-items-center big-dot dot"><i
                                                    class="fa fa-check text-white"></i></span>
                                            <hr class="flex-fill"><span class="dot"></span>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                            <div class="d-flex flex-column align-items-start">
                                                <span>{{ \Carbon\Carbon::parse($item->tgl_pengaduan)->isoFormat('DD MMM') }}</span><span>Pengaduan</span>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <span>{{ \Carbon\Carbon::parse($item->tgl_diterima)->isoFormat('DD MMM') }}</span><span>Diterima</span>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center align-items-center">
                                                <span>{{ \Carbon\Carbon::parse($item->tgl_dikerjakan)->isoFormat('DD MMM') }}</span><span>Dikerjakan</span>
                                            </div>
                                            <div class="d-flex flex-column align-items-center">
                                                <span>-</span><span>Selesai</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div><br>
                        @if ($item->ket_penolakan == null)
                            <table class="table table-striped display">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>TGL</th>
                                        <th>KETERANGAN</th>
                                    </tr>
                                </thead>
                                <tbody style="text-transform: capitalize;font-size:13px">
                                    <tr>
                                        <th><i class="fa-fw fas fa-caret-right nav-icon me-1"></i> STATUS DITERIMA</th>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->tgl_diterima)->isoFormat('DD MMM Y, HH:mm a') }}
                                        </td>
                                        <td>{{ $item->ket_diterima }}</td>
                                    </tr>
                                    <tr>
                                        <th>
                                            <button class="btn btn-link btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $item->id }}">
                                                <i class="fa-fw fas fa-caret-right nav-icon me-1"></i> <b>STATUS PENGERJAAN</b>
                                            </button>
                                        </th>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->tgl_dikerjakan)->isoFormat('DD MMM Y, HH:mm a') }}
                                        </td>
                                        <td>{{ $item->ket_dikerjakan }}</td>
                                    </tr>
                                    <tr>
                                        <th><i class="fa-fw fas fa-caret-right nav-icon me-1"></i> STATUS SELESAI</th>
                                        <td>
                                            {{ \Carbon\Carbon::parse($item->tgl_selesai)->isoFormat('DD MMM Y, HH:mm a') }}
                                        </td>
                                        <td>{{ $item->ket_selesai }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p><b># Klik tombol Status <kbd class="bg-primary text-light">DIKERJAKAN</kbd> untuk melihat detail Status Pengerjaan</b></p>
                        @else
                            <p><b>Laporan Ditolak Pada : </b>{{ $item->tgl_selesai }}</p>
                            <p><b>Keterangan Penolakan : </b></p>
                            <textarea class="form-control" disabled><?php echo htmlspecialchars($item->ket_penolakan); ?></textarea>
                        @endif
                        <div class="collapse" id="collapseExample{{ $item->id }}">
                            <div class="card table-card">
                                <div class="card-header d-flex align-items-center justify-content-between py-3">
                                    <h5 class="mb-0 card-title flex-grow-1"><i class="fa-fw fas fa-caret-right nav-icon me-1"></i> Tabel Status <a class="text-primary">Dikerjakan</a></h5>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped display">
                                            <thead>
                                                <tr>
                                                    <th>TGL</th>
                                                    <th>KETERANGAN</th>
                                                    <th>
                                                        <center>LAMPIRAN</center>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody style="font-size:13px">
                                                @php
                                                    $data = \App\Models\perbaikan_ipsrs_catatan::where('pengaduan_id', $item->id)->get();
                                                @endphp
                                                @if (count($data) > 0)
                                                    @foreach ($data as $item)
                                                        <tr>
                                                            <td>{{ $item->created_at }}</td>
                                                            <td>{{ $item->keterangan }}</td>
                                                            <td>
                                                                <center>
                                                                    @if (!empty($item->title))
                                                                        <button class="btn btn-success"
                                                                            onclick="window.location.href='{{ url('pengaduan/ipsrs/lampiran/catatan/' . $item->id) }}'"><i
                                                                                class="fa-fw fas fa-download nav-icon"></i></button>
                                                                    @else
                                                                        <button class="btn btn-secondary disabled"><i
                                                                                class="fa-fw fas fa-download nav-icon"></i></button>
                                                                    @endif
                                                                </center>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i
                                class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Pengaduan&nbsp;<kbd>ID : {{ $item->id }}</kbd>&nbsp;</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p><b>Laporan : </b><br>{{ $item->ket_pengaduan }}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"><i
                                class="fa-fw fas fa-times nav-icon"></i> Tutup</button>
                        @if (count($list) > 0)
                            <form action="{{ route('ipsrs.destroy', $item->id) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-danger"><i class="fas fa-trash"></i>&nbsp;&nbsp;Hapus</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{-- MODAL END --}}

    <script>
        $(document).ready(function() {
            // AUTOCOMPLETE LOKASI
            var path = "{{ route('ipsrs.ac.lokasi') }}";
            $('.typeahead-bloodhound').typeahead({
                source: function(query, process) {
                    return $.get(path, {
                        lokasi: query
                    }, function(data) {
                        return process(data);
                    });
                }
            });

            var table = $('#dttable').DataTable({
                order: [
                    [3, "desc"]
                ],
                displayLength: 7,
                lengthChange: true,
                lengthMenu: [7, 10, 25, 50, 75, 100],
            });

            // SELECT PICKER
            var t = $(".select2");
            t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Pilih",
                    dropdownParent: e.parent()
                })
            })
        });

        // FUNCTION
        function showLampiran(id) {
            Swal.fire({
                // title: 'Lampiran ID : '+id,
                // text: '',
                imageUrl: '/perbaikan/ipsrs/' + id,
                // imageWidth: 400,
                heightAuto: true,
                imageHeight: 275,
                imageAlt: 'Lampiran',
                reverseButtons: true,
                showDenyButton: false,
                showCloseButton: true,
                showCancelButton: true,
                cancelButtonText: `<i class="fa fa-times me-1" style="font-size:13px"></i> Tutup`,
                confirmButtonText: `<i class="fa fa-download"></i> Download`,
                backdrop: `rgba(26,27,41,0.8)`,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/perbaikan/ipsrs/" + id;
                }
            })
        }

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah_a').attr('href', e.target.result);
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function simpan() {
            $("#formTambah").one('submit', function() {
                //stop submitting the form to see the disabled button effect
                $("#btn-simpan").attr('disabled', 'disabled');
                $("#btn-simpan").find("i").toggleClass("fa-save fa-spinner fa-spin");

                return true;
            });
        }

        function clearInp() {
            $("#clr_lokasi").val('');
            $("#clr_pengaduan").val('');
            $("#imgInp").val('');
            $('#blah_a').attr('href', '');
            document.getElementById("blah").src = '{{ url("images/no-image.png") }}';
            iziToast.success({
                title: 'Yeayy!',
                message: 'Form Tambah berhasil dibersihkan',
                position: 'topRight'
            });
        }

        $("#imgInp").change(function() {
            readURL(this);
        });

        // function riwayat() {
        //     window.location.href = "/v2/laporan/pengaduan/ipsrs/riwayat";
        // }
    </script>
@endsection
