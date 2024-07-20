@extends('layouts.index')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboardx') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Profil Akun</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Profil Akun</h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->
    <!-- [ Main Content ] start -->
    <div class="row pt-1"><!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body py-0">
                    <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab"
                                href="#profil-pengguna" role="tab" aria-selected="true">
                                <i class="ti ti-user me-2"></i>Profil Pengguna
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-2" data-bs-toggle="tab"
                                href="#ubah-profil" role="tab" aria-selected="true">
                                <i class="ti ti-file-text me-2"></i>Ubah Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-3" data-bs-toggle="tab"
                                href="#profile-3" role="tab" aria-selected="true">
                                <i class="ti ti-id me-2"></i><s>My Account</s>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab"
                                href="#ubah-password" role="tab" aria-selected="true">
                                <i class="ti ti-lock me-2"></i>Ubah Password
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-5" data-bs-toggle="tab"
                                href="#profile-5" role="tab" aria-selected="true">
                                <i class="ti ti-users me-2"></i><s>Role</s>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-6" data-bs-toggle="tab"
                                href="#profile-6" role="tab" aria-selected="true">
                                <i class="ti ti-settings me-2"></i><s>Settings</s>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane show active" id="profil-pengguna" role="tabpanel"
                    aria-labelledby="profile-tab-1">
                    <div class="row">
                        <div class="col-lg-4 col-xxl-3">
                            <div class="card">
                                <div class="card-body position-relative">
                                    {{-- <div class="position-absolute end-0 top-0 p-3">
                                        <span class="badge bg-primary">Pro</span>
                                    </div> --}}
                                    <div class="text-center">
                                        <div class="chat-avtar d-inline-flex mx-auto mb-2">
                                            @if (empty($list['foto']->filename))
                                                <img class="rounded-circle img-fluid" src="{{ asset('images/pku/user.png') }}" alt="User image" style="height: 100px;width: auto">
                                                {{-- <a class="image-popup-no-margins" href="{{ asset('images/pku/user.png') }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Tekan untuk memperbesar foto profil">
                                                    <img class="img-fluid avatar-sm rounded-circle img-thumbnail" alt="" src="{{ asset('images/pku/user.png') }}" width="75">
                                                </a> --}}
                                            @else
                                                <a href="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" data-toggle="lightbox" class="img-post" data-caption="Nama file foto : {{ $list['foto']->title }}">
                                                    <img class="rounded-circle img-fluid card-img" src="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" alt="User image" style="height: 100px;width: auto">
                                                    <div class="card-img-overlay">
                                                        <i class="ti ti-eye"></i>
                                                    </div>
                                                </a>
                                                {{-- <a class="image-popup-no-margins" href="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Tekan untuk memperbesar foto profil">
                                                    <img class="img-fluid avatar-sm rounded-circle img-thumbnail" alt="" src="{{ url('storage/'.substr($list['foto']->filename,7,1000)) }}" width="75">
                                                </a> --}}
                                            @endif
                                        </div>
                                        <h5 class="mb-1">{{ Auth::user()->nama }}</h5>
                                        <p class="text-muted text-sm">
                                            @foreach ($list['role'] as $val)
                                                @if ($list['show']->id == $val->id_user)
                                                    <span class="badge rounded-pill text-bg-secondary">{{ $val->nama_role }}</span>
                                                @endif
                                            @endforeach
                                        </p>
                                        <hr class="my-2 border border-secondary-subtle">
                                        <div class="row">
                                            <div class="col-6 border border-top-0 border-bottom-0 border-start-0">
                                                <h6 class="mb-0">Status Pegawai</h6>
                                                <small class="text-muted">{{ $list['show']->deleted_at == null? 'Aktif':'Non Aktif' }}</small>
                                            </div>
                                            <div class="col-6 border border-top-0 border-bottom-0 border-end-0">
                                                <h6 class="mb-0">Terakhir Login</h6>
                                                <small class="text-muted">@if (!empty($list['showlog'][1])) {{ \Carbon\Carbon::parse($list['showlog'][1]->log_date)->diffForHumans() }} @else - @endif</small>
                                            </div>
                                            {{-- <div class="col-4">
                                                <h5 class="mb-0">...</h5>
                                                <small class="text-muted">x</small>
                                            </div> --}}
                                        </div>
                                        <hr class="my-3 border border-secondary-subtle">
                                        <div
                                            class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                            <i class="fas fa-id-card-alt me-3"></i>
                                            <p class="mb-0">{{ $list['show']->nip?$list['show']->nip:'-' }}</p>
                                        </div>
                                        <div
                                            class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                            <i class="fas fa-address-card me-3"></i>
                                            <p class="mb-0">{{ $list['show']->nik }}</p>
                                        </div>
                                        <div
                                            class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                            <i class="fas fa-envelope me-3"></i>
                                            <p class="mb-0"><a href="javascript:void(0);"
                                                    class="text-dark">{{ $list['show']->email }}</a>
                                            </p>
                                        </div>
                                        <div
                                            class="d-inline-flex align-items-center justify-content-start w-100">
                                            <i class="fab fa-whatsapp-square me-3"></i>
                                            <p class="mb-0">{{ $list['show']->no_hp }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Media Sosial</h5>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <a href="{{ url('https://www.facebook.com/'.$list['show']->fb) }}" class="btn btn-link-secondary d-grid" target="_blank">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-facebook">
                                                        <i class="fab fa-facebook-f f-16"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">Facebook / <mark>{{ $list['show']->fb }}</mark></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="mb-2">
                                        <a href="{{ url('https://www.instagram.com/'.$list['show']->ig) }}" class="btn btn-link-secondary d-grid" target="_blank">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-instagram">
                                                        <i class="fab fa-instagram f-16"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">Instagram / <mark>{{ $list['show']->ig }}</mark></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="mb-0">
                                        <a href="{{ url('https://www.youtube.com/@rspkumuhsukoharjo1801') }}" class="btn btn-link-secondary d-grid" target="_blank">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-youtube">
                                                        <i class="fab fa-youtube f-16"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">Youtube / <mark>rspkusukoharjo</mark></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    {{-- <div class="d-flex align-items-center mb-3">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-xs btn-light-facebook"><i
                                                    class="fab fa-facebook-f f-16"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Facebook</h6>
                                        </div>
                                        <div class="flex-grow-0 ms-3">
                                            <h6 class="mb-0"><small class="text-muted f-w-400">@ {{ $list['show']->fb }}</small>
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="avtar avtar-xs btn-light-instagram"><i
                                                    class="fab fa-instagram f-16"></i></div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-0">Instagram</h6>
                                        </div>
                                        <div class="flex-grow-0 ms-3">
                                            <h6 class="mb-0"><small class="text-muted f-w-400">@ {{ $list['show']->ig }}</small></h6>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            {{-- <div class="card">
                                <div class="card-header">
                                    <h5>Skills</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center mb-3">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <p class="mb-0">Junior</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 me-3">
                                                    <div class="progress progress-primary" style="height: 6px">
                                                        <div class="progress-bar" style="width: 30%"></div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <p class="mb-0 text-muted">30%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <p class="mb-0">UX Researcher</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 me-3">
                                                    <div class="progress progress-primary" style="height: 6px">
                                                        <div class="progress-bar" style="width: 80%"></div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <p class="mb-0 text-muted">80%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <p class="mb-0">Wordpress</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 me-3">
                                                    <div class="progress progress-primary" style="height: 6px">
                                                        <div class="progress-bar" style="width: 90%"></div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <p class="mb-0 text-muted">90%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <p class="mb-0">HTML</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 me-3">
                                                    <div class="progress progress-primary" style="height: 6px">
                                                        <div class="progress-bar" style="width: 30%"></div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <p class="mb-0 text-muted">30%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center mb-3">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <p class="mb-0">Graphic Design</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 me-3">
                                                    <div class="progress progress-primary" style="height: 6px">
                                                        <div class="progress-bar" style="width: 95%"></div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <p class="mb-0 text-muted">95%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="col-sm-6 mb-2 mb-sm-0">
                                            <p class="mb-0">Code Style</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1 me-3">
                                                    <div class="progress progress-primary" style="height: 6px">
                                                        <div class="progress-bar" style="width: 75%"></div>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0">
                                                    <p class="mb-0 text-muted">75%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-lg-8 col-xxl-9">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Tentang Saya</h5>
                                </div>
                                <div class="card-body">
                                    <p class="mb-0">{{ $list['show']->pengalaman_kerja?$list['show']->pengalaman_kerja:'-' }}</p>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Data Diri</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Nama Lengkap</p>
                                                    <p class="mb-0">{{ $list['show']->nama }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Nama Panggilan</p>
                                                    <p class="mb-0">{{ $list['show']->nick }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Tempat Lahir</p>
                                                    <p class="mb-0">{{ $list['show']->temp_lahir }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Tanggal Lahir</p>
                                                    <p class="mb-0">{{ \Carbon\Carbon::parse($list['show']->tgl_lahir)->isoFormat('D MMMM Y') }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Jenis Kelamin</p>
                                                    <p class="mb-0">{{ $list['show']->jns_kelamin }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Status Kawin</p>
                                                    <p class="mb-0">{{ $list['show']->status_kawin }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <p class="mb-1 text-muted">Alamat Lengkap Sesuai KTP</p>
                                            <p class="mb-0">{{ $list['show']->alamat_ktp }}</p>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <p class="mb-1 text-muted">Alamat Domisili</p>
                                            <p class="mb-0">{{ $list['show']->alamat_dom?$list['show']->alamat_dom:'Sama dengan alamat pada KTP' }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card task-card">
                                <div class="card-header">
                                    <h5>Data Pendidikan</h5>
                                </div>
                                <div class="card-body pb-3">
                                    <ul class="list-unstyled task-list">
                                        @if (!empty($list['show']->s3))
                                        <li>
                                            <i class="feather icon-arrow-right f-w-600 task-icon bg-secondary"></i>
                                            <h5 class="text-muted">S3 - {{ $list['show']->s3 }}</h5>
                                            <p class="m-b-5">Lulus pada tahun {{ $list['show']->th_s3 }}</p>
                                        </li>
                                        @endif
                                        @if (!empty($list['show']->s2))
                                        <li>
                                            <i class="feather icon-arrow-right f-w-600 task-icon bg-secondary"></i>
                                            <h5 class="text-muted">S2 - {{ $list['show']->s2 }}</h5>
                                            <p class="m-b-5">Lulus pada tahun {{ $list['show']->th_s2 }}</p>
                                        </li>
                                        @endif
                                        @if (!empty($list['show']->s1))
                                        <li>
                                            <i class="feather icon-arrow-right f-w-600 task-icon bg-secondary"></i>
                                            <h5 class="text-muted">S1 - {{ $list['show']->s1 }}</h5>
                                            <p class="m-b-5">Lulus pada tahun {{ $list['show']->th_s1 }}</p>
                                        </li>
                                        @endif
                                        @if (!empty($list['show']->d4))
                                        <li>
                                            <i class="feather icon-arrow-right f-w-600 task-icon bg-secondary"></i>
                                            <h5 class="text-muted">D4 - {{ $list['show']->d4 }}</h5>
                                            <p class="m-b-5">Lulus pada tahun {{ $list['show']->th_d4 }}</p>
                                        </li>
                                        @endif
                                        @if (!empty($list['show']->d3))
                                        <li>
                                            <i class="feather icon-arrow-right f-w-600 task-icon bg-secondary"></i>
                                            <h5 class="text-muted">D3 - {{ $list['show']->d3 }}</h5>
                                            <p class="m-b-5">Lulus pada tahun {{ $list['show']->th_d3 }}</p>
                                        </li>
                                        @endif
                                        @if (!empty($list['show']->d2))
                                        <li>
                                            <i class="feather icon-arrow-right f-w-600 task-icon bg-secondary"></i>
                                            <h5 class="text-muted">D2 - {{ $list['show']->d2 }}</h5>
                                            <p class="m-b-5">Lulus pada tahun {{ $list['show']->th_d2 }}</p>
                                        </li>
                                        @endif
                                        @if (!empty($list['show']->sma))
                                        <li>
                                            <i class="feather icon-arrow-right f-w-600 task-icon bg-secondary"></i>
                                            <h5 class="text-muted">{{ $list['show']->sma }}</h5>
                                            <p class="m-b-5">Lulus pada tahun {{ $list['show']->th_sma }}</p>
                                        </li>
                                        @endif
                                        @if (!empty($list['show']->smp))
                                        <li>
                                            <i class="feather icon-arrow-right f-w-600 task-icon bg-secondary"></i>
                                            <h5 class="text-muted">{{ $list['show']->smp }}</h5>
                                            <p class="m-b-5">Lulus pada tahun {{ $list['show']->th_smp }}</p>
                                        </li>
                                        @endif
                                        @if (!empty($list['show']->sd))
                                        <li>
                                            <i class="feather icon-arrow-right f-w-600 task-icon bg-secondary"></i>
                                            <h5 class="text-muted">{{ $list['show']->sd }}</h5>
                                            <p class="m-b-5">Lulus pada tahun {{ $list['show']->th_sd }}</p>
                                        </li>
                                        @endif
                                    </ul>
                                    {{-- <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Master Degree (Year)</p>
                                                    <p class="mb-0">2014-2017</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Institute</p>
                                                    <p class="mb-0">-</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Bachelor (Year)</p>
                                                    <p class="mb-0">2011-2013</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Institute</p>
                                                    <p class="mb-0">Imperial College London</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">School (Year)</p>
                                                    <p class="mb-0">2009-2011</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Institute</p>
                                                    <p class="mb-0">School of London, England</p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul> --}}
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Data Kesehatan</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <p class="mb-1 text-muted">Riwayat Penyakit</p>
                                            <p class="mb-0">{{ $list['show']->riwayat_penyakit }}</p>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <p class="mb-1 text-muted">Riwayat Penyakit Keluarga</p>
                                            <p class="mb-0">{{ $list['show']->riwayat_penyakit_keluarga }}</p>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <p class="mb-1 text-muted">Riwayat Penggunaan Obat</p>
                                            <p class="mb-0">{{ $list['show']->riwayat_penggunaan_obat }}</p>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <p class="mb-1 text-muted">Riwayat Operasi</p>
                                            <p class="mb-0">{{ $list['show']->riwayat_operasi }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="ubah-profil" role="tabpanel" aria-labelledby="profile-tab-2">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Personal Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12 text-center mb-3">
                                            <div class="user-upload wid-75"><img
                                                    src="../assets/images/user/avatar-4.jpg" alt="img"
                                                    class="img-fluid"> <label for="uplfile"
                                                    class="img-avtar-upload"><i
                                                        class="ti ti-camera f-24 mb-1"></i>
                                                    <span>Upload</span></label> <input type="file" id="uplfile"
                                                    class="d-none"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">First Name</label>
                                                <input type="text" class="form-control" value="Anshan"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Last Name</label> <input
                                                    type="text" class="form-control" value="Handgun"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Country</label> <input
                                                    type="text" class="form-control" value="New York"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Zip code</label> <input
                                                    type="text" class="form-control" value="956754"></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3"><label class="form-label">Bio</label> <textarea
                                                    class="form-control">Hello, I’m Anshan Handgun Creative Graphic Designer & User Experience Designer based in Website, I create digital Products a more Beautiful and usable place. Morbid accusant ipsum. Nam nec tellus at.</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3"><label class="form-label">Experience</label>
                                                <select class="form-control">
                                                    <option>Startup</option>
                                                    <option>2 year</option>
                                                    <option>3 year</option>
                                                    <option selected="selected">4 year</option>
                                                    <option>5 year</option>
                                                </select></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Social Network</h5>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-grow-1 me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-twitter"><i
                                                            class="fab fa-twitter f-16"></i></div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">Twitter</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0"><button
                                                class="btn btn-link-primary">Connect</button></div>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="flex-grow-1 me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-facebook"><i
                                                            class="fab fa-facebook-f f-16"></i></div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">Facebook <small
                                                            class="text-muted f-w-400">/Anshan Handgun</small>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0"><button
                                                class="btn btn-link-danger">Remove</button></div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 me-3">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-linkedin"><i
                                                            class="fab fa-linkedin-in f-16"></i></div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">Linkedin</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0"><button
                                                class="btn btn-link-primary">Connect</button></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Contact Information</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Contact Phone</label>
                                                <input type="text" class="form-control"
                                                    value="(+99) 9999 999 999"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Email <span
                                                        class="text-danger">*</span></label> <input type="text"
                                                    class="form-control" value="demo@sample.com"></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3"><label class="form-label">Portfolio Url</label>
                                                <input type="text" class="form-control"
                                                    value="https://demo.com/"></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3"><label class="form-label">Address</label>
                                                <textarea
                                                    class="form-control">3379  Monroe Avenue, Fort Myers, Florida(33912)</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end btn-page">
                            <div class="btn btn-outline-secondary">Cancel</div>
                            <div class="btn btn-primary">Update Profile</div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>General Settings</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Username <span
                                                        class="text-danger">*</span></label> <input type="text"
                                                    class="form-control" value="Ashoka_Tano_16"> <small
                                                    class="form-text text-muted">Your Profile URL:
                                                    https://pc.com/Ashoka_Tano_16</small></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Account Email <span
                                                        class="text-danger">*</span></label> <input type="text"
                                                    class="form-control" value="demo@sample.com"></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Language</label> <select
                                                    class="form-control">
                                                    <option>Washington</option>
                                                    <option>India</option>
                                                    <option>Africa</option>
                                                    <option>New York</option>
                                                    <option>Malaysia</option>
                                                </select></div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3"><label class="form-label">Sign in Using</label>
                                                <select class="form-control">
                                                    <option>Password</option>
                                                    <option>Face Recognition</option>
                                                    <option>Thumb Impression</option>
                                                    <option>Key</option>
                                                    <option>Pin</option>
                                                </select></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Advance Settings</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-1">Secure Browsing</p>
                                                    <p class="text-muted text-sm mb-0">Browsing Securely ( https
                                                        ) when it's necessary</p>
                                                </div>
                                                <div class="form-check form-switch p-0"><input
                                                        class="form-check-input h4 position-relative m-0"
                                                        type="checkbox" role="switch" checked=""></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-1">Login Notifications</p>
                                                    <p class="text-muted text-sm mb-0">Notify when login
                                                        attempted from other place</p>
                                                </div>
                                                <div class="form-check form-switch p-0"><input
                                                        class="form-check-input h4 position-relative m-0"
                                                        type="checkbox" role="switch" checked=""></div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <p class="mb-1">Login Approvals</p>
                                                    <p class="text-muted text-sm mb-0">Approvals is not required
                                                        when login from unrecognized devices.</p>
                                                </div>
                                                <div class="form-check form-switch p-0"><input
                                                        class="form-check-input h4 position-relative m-0"
                                                        type="checkbox" role="switch" checked=""></div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Recognized Devices</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <p class="mb-2">Celt Desktop</p>
                                                    <p class="mb-0 text-muted">4351 Deans Lane</p>
                                                </div>
                                                <div class="">
                                                    <div class="text-success d-inline-block me-2"><i
                                                            class="fas fa-circle f-10 me-2"></i> Current Active
                                                    </div><a href="#!" class="text-danger"><i
                                                            class="feather icon-x-circle"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <p class="mb-2">Imco Tablet</p>
                                                    <p class="mb-0 text-muted">4185 Michigan Avenue</p>
                                                </div>
                                                <div class="">
                                                    <div class="text-muted d-inline-block me-2"><i
                                                            class="fas fa-circle f-10 me-2"></i> 5 days ago
                                                    </div><a href="#!" class="text-danger"><i
                                                            class="feather icon-x-circle"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <p class="mb-2">Albs Mobile</p>
                                                    <p class="mb-0 text-muted">3462 Fairfax Drive</p>
                                                </div>
                                                <div class="">
                                                    <div class="text-muted d-inline-block me-2"><i
                                                            class="fas fa-circle f-10 me-2"></i> 1 month ago
                                                    </div><a href="#!" class="text-danger"><i
                                                            class="feather icon-x-circle"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Active Sessions</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item px-0 pt-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <p class="mb-2">Celt Desktop</p>
                                                    <p class="mb-0 text-muted">4351 Deans Lane</p>
                                                </div><button class="btn btn-link-danger">Logout</button>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="me-2">
                                                    <p class="mb-2">Moon Tablet</p>
                                                    <p class="mb-0 text-muted">4185 Michigan Avenue</p>
                                                </div><button class="btn btn-link-danger">Logout</button>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end"><button class="btn btn-outline-dark ms-2">Bersihkan</button>
                            <button class="btn btn-primary">Perbarui</button></div>
                    </div>
                </div>
                <div class="tab-pane" id="ubah-password" role="tabpanel" aria-labelledby="profile-tab-4">
                    <div class="card">
                        <form action="{{ route('auth.change_password') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="card-header">
                                <h5>Ubah Password</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="alert alert-light" role="alert">
                                            <h5 class="alert-heading fw-bold mb-3">Keamanan Password</h5>
                                            <span>
                                                <ul>
                                                    <li class="mb-2">Jangan berikan <strong>Password</strong> anda kepada orang lain</li>
                                                    <li class="mb-2">Password akan diproses melalui metode <i>Bcrypt Hash Password</i> oleh sistem</li>
                                                    <li>Apabila anda lupa Password akun Simrsmu, silakan masuk ke laman <b>Lupa Password</b>
                                                        pada halaman Login</li>
                                                </ul>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Password Lama <a class="text-danger">*</a></label>
                                            <input type="password" class="form-control" id="oldPassword" name="current_password"
                                            placeholder="&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;" required>
                                            {{-- <div class="valid-feedback">
                                                Looks good!
                                            </div> --}}
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Password Baru <a class="text-danger">*</a></label>
                                            <input type="password" class="form-control is-invalid" id="newPassword" name="new_password"
                                            placeholder="&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Konfirmasi Password Baru <a class="text-danger">*</a></label>
                                            <input type="password" class="form-control is-invalid" id="confirmPassword" name="new_password_confirmation"
                                            placeholder="&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;&nbsp;&#xb7;" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h5>Password harus memenuhi kriteria</h5>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item requirements">
                                                <i class="ti ti-circle-check text-danger f-16 me-2 leng"></i> Melebihi lebih 8 karakter
                                            </li>
                                            {{-- <li class="list-group-item requirements">
                                                <i class="ti ti-circle-check text-success f-16 me-2"></i> At least 1 lower letter (a-z)
                                            </li> --}}
                                            <li class="list-group-item requirements">
                                                <i class="ti ti-circle-check text-danger f-16 me-2 big-letter"></i> Minimal 1 Huruf Kapital (A-Z)
                                            </li>
                                            <li class="list-group-item requirements">
                                                <i class="ti ti-circle-check text-danger f-16 me-2 num"></i> Minimal 1 Angka (0-9)
                                            </li>
                                            <li class="list-group-item requirements">
                                                <i class="ti ti-circle-check text-danger f-16 me-2 special-char"></i> Minimal 1 Karakter Khusus (!@#$%^&*)
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end btn-page pb-0 pt-3 pe-2">
                                {{-- <div class="btn btn-outline-secondary">Cancel</div> --}}
                                <button class="btn btn-secondary" type="submit" value="Submit" id="btn-submit-password" disabled><i class="ti ti-rocket"></i>&nbsp;&nbsp;Perbarui</button>
                            </div>
                    </div>
                </div>
                <div class="tab-pane" id="profile-5" role="tabpanel" aria-labelledby="profile-tab-5">
                    <div class="card">
                        <div class="card-header">
                            <h5>Invite Team Members</h5>
                        </div>
                        <div class="card-body">
                            <h4>5/10 <small>members available in your plan.</small></h4>
                            <hr class="my-3">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3"><label class="form-label">Email Address</label>
                                        <div class="row">
                                            <div class="col"><input type="email" class="form-control"></div>
                                            <div class="col-auto"><button class="btn btn-primary">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-card">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th>MEMBER</th>
                                            <th>ROLE</th>
                                            <th class="text-end">STATUS</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-1.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Addie Bass</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="1974786b7c6f78597e74787075377a7674">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-primary">Owner</span></td>
                                            <td class="text-end"><span class="badge bg-success">Joined</span>
                                            </td>
                                            <td class="text-end"><a href="javascript:void(0);"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-4.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Agnes McGee</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="f59d909794b59298949c99db969a98">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light-info">Manager</span></td>
                                            <td class="text-end"><a href="javascript:void(0);"
                                                    class="btn btn-link-danger">Resend</a> <span
                                                    class="badge bg-light-success">Invited</span></td>
                                            <td class="text-end"><a href="javascript:void(0);"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-5.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Agnes McGee</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="036b66616243646e626a6f2d606c6e">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light-warning">Staff</span></td>
                                            <td class="text-end"><span class="badge bg-success">Joined</span>
                                            </td>
                                            <td class="text-end"><a href="javascript:void(0);"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-1.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Addie Bass</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="6d000c1f081b0c2d0a000c0401430e0200">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-primary">Owner</span></td>
                                            <td class="text-end"><span class="badge bg-success">Joined</span>
                                            </td>
                                            <td class="text-end"><a href="javascript:void(0);"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-4.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Agnes McGee</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="ea828f888baa8d878b8386c4898587">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light-info">Manager</span></td>
                                            <td class="text-end"><a href="javascript:void(0);"
                                                    class="btn btn-link-danger">Resend</a> <span
                                                    class="badge bg-light-success">Invited</span></td>
                                            <td class="text-end"><a href="javascript:void(0);"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-5.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Agnes McGee</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="fa929f989bba9d979b9396d4999597">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light-warning">Staff</span></td>
                                            <td class="text-end"><span class="badge bg-success">Joined</span>
                                            </td>
                                            <td class="text-end"><a href="javascript:void(0);"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-1.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Addie Bass</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="7c111d0e190a1d3c1b111d1510521f1311">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-primary">Owner</span></td>
                                            <td class="text-end"><span class="badge bg-success">Joined</span>
                                            </td>
                                            <td class="text-end"><a href="javascript:void(0);"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-4.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Agnes McGee</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="cfa7aaadae8fa8a2aea6a3e1aca0a2">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light-info">Manager</span></td>
                                            <td class="text-end"><a href="javascript:void(0);"
                                                    class="btn btn-link-danger">Resend</a> <span
                                                    class="badge bg-light-success">Invited</span></td>
                                            <td class="text-end"><a href="javascript:void(0);"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="row">
                                                    <div class="col-auto pe-0"><img
                                                            src="../assets/images/user/avatar-5.jpg"
                                                            alt="user-image" class="wid-40 rounded-circle">
                                                    </div>
                                                    <div class="col">
                                                        <h5 class="mb-0">Agnes McGee</h5>
                                                        <p class="text-muted f-12 mb-0"><a
                                                                href="../cdn-cgi/l/email-protection.html"
                                                                class="__cf_email__"
                                                                data-cfemail="630b06010223040e020a0f4d000c0e">[email&#160;protected]</a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-light-warning">Staff</span></td>
                                            <td class="text-end"><span class="badge bg-success">Joined</span>
                                            </td>
                                            <td class="text-end"><a href="javascript:void(0);"
                                                    class="avtar avtar-s btn-link-secondary"><i
                                                        class="ti ti-dots f-18"></i></a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-end btn-page">
                            <div class="btn btn-link-danger">Cancel</div>
                            <div class="btn btn-primary">Update Profile</div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="profile-6" role="tabpanel" aria-labelledby="profile-tab-6">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Email Settings</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-4">Setup Email Notification</h6>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Email Notification</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Send Copy To Personal Email</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h5>Updates from System Notification</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-4">Email you with?</h6>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">News about PCT-themes products and
                                                feature updates</p>
                                        </div>
                                        <div class="form-check p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Tips on getting more out of PCT-themes
                                            </p>
                                        </div>
                                        <div class="form-check p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Things you missed since you last logged
                                                into PCT-themes</p>
                                        </div>
                                        <div class="form-check p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch"></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">News about products and other services
                                            </p>
                                        </div>
                                        <div class="form-check p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch"></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Tips and Document business products</p>
                                        </div>
                                        <div class="form-check p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Activity Related Emails</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="mb-4">When to email?</h6>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Have new notifications</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">You're sent a direct message</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch"></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Someone adds you as a connection</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                    <hr class="my-4 border border-secondary-subtle">
                                    <h6 class="mb-4">When to escalate emails?</h6>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Upon new order</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">New membership approval</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch"></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div>
                                            <p class="text-muted mb-0">Member registration</p>
                                        </div>
                                        <div class="form-check form-switch p-0"><input
                                                class="m-0 form-check-input h5 position-relative"
                                                type="checkbox" role="switch" checked=""></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end btn-page">
                            <div class="btn btn-outline-secondary">Cancel</div>
                            <div class="btn btn-primary">Update Profile</div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- [ sample-page ] end -->
    </div><!-- [ Main Content ] end -->

    <script>
        addEventListener("DOMContentLoaded", (event) => {
            const password = document.getElementById("newPassword");
            const cpassword = document.getElementById("confirmPassword");
            const leng = $(".leng");
            const bigLetter = $(".big-letter");
            const num = $(".num");
            const specialChar = $(".special-char");

            password.addEventListener("input", () => {
                const value = password.value;
                const isLengthValid = value.length >= 8;
                const hasUpperCase = /[A-Z]/.test(value);
                const hasNumber = /\d/.test(value);
                const hasSpecialChar = /[!@#$%^&*()\[\]{}\\|;:'",<.>/?`~]/.test(value);

                // RESET INPUT KONFIRMASI PASSWORD
                cpassword.value = '';
                $('#btn-submit-password').prop('disabled', true);
                $('#btn-submit-password').removeClass("btn-primary");
                $('#btn-submit-password').addClass("btn-secondary");
                cpassword.classList.remove("is-valid");
                cpassword.classList.add("is-invalid");

                const isPasswordValid = isLengthValid && hasUpperCase && hasNumber && hasSpecialChar;

                // PANJANG MINIMAL 8 KARAKTER
                if (isLengthValid == true) {
                    leng.removeClass('ti-circle-x text-danger');
                    leng.addClass('ti-circle-check text-success');
                } else {
                    leng.removeClass('ti-circle-check text-success');
                    leng.addClass('ti-circle-x text-danger');
                }
                // MINIMAL 1 HURUF BESAR
                if (hasUpperCase == true) {
                    bigLetter.removeClass('ti-circle-x text-danger');
                    bigLetter.addClass('ti-circle-check text-success');
                } else {
                    bigLetter.removeClass('ti-circle-check text-success');
                    bigLetter.addClass('ti-circle-x text-danger');
                }
                // MINIMAL 1 ANGKA
                if (hasNumber == true) {
                    num.removeClass('ti-circle-x text-danger');
                    num.addClass('ti-circle-check text-success');
                } else {
                    num.removeClass('ti-circle-check text-success');
                    num.addClass('ti-circle-x text-danger');
                }
                // MINIMAL 1 KARAKTER KHUSUS
                if (hasSpecialChar == true) {
                    specialChar.removeClass('ti-circle-x text-danger');
                    specialChar.addClass('ti-circle-check text-success');
                } else {
                    specialChar.removeClass('ti-circle-check text-success');
                    specialChar.addClass('ti-circle-x text-danger');
                }

                // CEKLIS INPUT
                if (isPasswordValid) {
                    password.classList.remove("is-invalid");
                    password.classList.add("is-valid");
                } else {
                    password.classList.remove("is-valid");
                    password.classList.add("is-invalid");
                }
            });

            cpassword.addEventListener("input", () => {
                if (password.value == cpassword.value) {
                    $('#btn-submit-password').prop('disabled', false);
                    $('#btn-submit-password').removeClass("btn-secondary");
                    $('#btn-submit-password').addClass("btn-primary");
                    cpassword.classList.remove("is-invalid");
                    cpassword.classList.add("is-valid");
                } else {
                    $('#btn-submit-password').prop('disabled', true);
                    $('#btn-submit-password').removeClass("btn-primary");
                    $('#btn-submit-password').addClass("btn-secondary");
                    cpassword.classList.remove("is-valid");
                    cpassword.classList.add("is-invalid");
                }
            });
        });
        </script>
@endsection
