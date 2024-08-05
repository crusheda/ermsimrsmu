@extends('layouts.index')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
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
                                href="#ubah-foto-profil" role="tab" aria-selected="true">
                                <i class="ti ti-id me-2"></i>Ubah Foto Profil
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab"
                                href="#ubah-password" role="tab" aria-selected="true">
                                <i class="ti ti-lock me-2"></i>Ubah Password
                            </a>
                        </li>
                        {{-- <li class="nav-item">
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
                        </li> --}}
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
                                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                            <i class="fas fa-id-card-alt me-3"></i>
                                            <p class="mb-0">{{ $list['show']->nip?$list['show']->nip:'-' }}</p>
                                        </div>
                                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                            <i class="fas fa-address-card me-3"></i>
                                            <p class="mb-0">{{ $list['show']->nik?$list['show']->nik:'-' }}</p>
                                        </div>
                                        <div class="d-inline-flex align-items-center justify-content-start w-100 mb-3">
                                            <i class="fas fa-envelope me-3"></i>
                                            <p class="mb-0"><a href="javascript:void(0);"
                                                    class="text-dark">{{ $list['show']->email }}</a>
                                            </p>
                                        </div>
                                        <div class="d-inline-flex align-items-center justify-content-start w-100">
                                            <i class="fab fa-whatsapp-square me-3"></i>
                                            <p class="mb-0">{{ $list['show']->no_hp?$list['show']->no_hp:'-' }}</p>
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
                                                <div class="flex-grow-1 ms-4 text-start">
                                                    <h6 class="mb-0">Facebook / <mark>{{ $list['show']->fb ? $list['show']->fb : 'xxx' }}</mark></h6>
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
                                                <div class="flex-grow-1 ms-4 text-start">
                                                    <h6 class="mb-0">Instagram / <mark>{{ $list['show']->ig ? $list['show']->ig : 'xxx' }}</mark></h6>
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
                                                <div class="flex-grow-1 ms-4 text-start">
                                                    <h6 class="mb-0">Youtube / <mark>rspkusukoharjo</mark></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
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
                                                    <p class="mb-0">{{ $list['show']->nama?$list['show']->nama:'-' }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Nama Panggilan</p>
                                                    <p class="mb-0">{{ $list['show']->nick?$list['show']->nick:'-' }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Tempat Lahir</p>
                                                    <p class="mb-0">{{ $list['show']->temp_lahir?$list['show']->temp_lahir:'-' }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Tanggal Lahir</p>
                                                    <p class="mb-0">{{ $list['show']->tgl_lahir?\Carbon\Carbon::parse($list['show']->tgl_lahir)->isoFormat('D MMMM Y'):'-' }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Jenis Kelamin</p>
                                                    <p class="mb-0">{{ $list['show']->jns_kelamin?$list['show']->jns_kelamin:'-' }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <p class="mb-1 text-muted">Status Kawin</p>
                                                    <p class="mb-0">{{ $list['show']->status_kawin?$list['show']->status_kawin:'-' }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <p class="mb-1 text-muted">Alamat Lengkap Sesuai KTP</p>
                                            <p class="mb-0">{{ $list['show']->alamat_ktp?$list['show']->alamat_ktp:'-' }}</p>
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
                                    @if (!empty($list['show']->nik))
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
                                    @else
                                    -
                                    @endif
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
                                            <p class="mb-0">{{ $list['show']->riwayat_penyakit?$list['show']->riwayat_penyakit:'-' }}</p>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <p class="mb-1 text-muted">Riwayat Penyakit Keluarga</p>
                                            <p class="mb-0">{{ $list['show']->riwayat_penyakit_keluarga?$list['show']->riwayat_penyakit_keluarga:'-' }}</p>
                                        </li>
                                        <li class="list-group-item px-0">
                                            <p class="mb-1 text-muted">Riwayat Penggunaan Obat</p>
                                            <p class="mb-0">{{ $list['show']->riwayat_penggunaan_obat?$list['show']->riwayat_penggunaan_obat:'-' }}</p>
                                        </li>
                                        <li class="list-group-item px-0 pb-0">
                                            <p class="mb-1 text-muted">Riwayat Operasi</p>
                                            <p class="mb-0">{{ $list['show']->riwayat_operasi?$list['show']->riwayat_operasi:'-' }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FORM UBAH PROFIL --}}
                <div class="tab-pane" id="ubah-profil" role="tabpanel" aria-labelledby="profile-tab-2">
                    <form id="formUpdate" class="form-auth-small needs-validation" action="{{ route('profil.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Deskripsi Pengalaman Kerja</h5>
                                    </div>
                                    <div class="card-body">
                                        <textarea class="form-control" name="pengalaman_kerja" placeholder="e.g. Saya pernah bekerja pada suatu instansi swasta ternama yang bertempat di Kota X dan berprofesi sebagai X . . ."><?php echo htmlspecialchars($list['show']->pengalaman_kerja); ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Data Sensitif</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor Induk Pegawai (NIP) <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" value="{{ $list['show']->nip }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="mb-3">
                                                    <label class="form-label">Nomor Induk Kependudukan (NIK) <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="nik" value="{{ $list['show']->nik }}" minlength="16" maxlength="16" placeholder="Isi dengan kombinasi Angka" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="mb-3">
                                                    <label class="form-label">Email Aktif <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="email" value="{{ $list['show']->email }}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div>
                                                    <label class="form-label">No. HP Aktif (Whatsapp +62) <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control telphone_with_code" name="no_hp" value="{{ $list['show']->no_hp }}" maxlength="13" placeholder="628**********" data-mask="(62) 9999-9999-9999">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Data Diri</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            {{-- <div class="col-sm-12 text-center mb-3">
                                                <div class="user-upload wid-75"><img
                                                        src="../assets/images/user/avatar-4.jpg" alt="img"
                                                        class="img-fluid"> <label for="uplfile"
                                                        class="img-avtar-upload"><i
                                                            class="ti ti-camera f-24 mb-1"></i>
                                                        <span>Upload</span></label> <input type="file" id="uplfile"
                                                        class="d-none"></div>
                                            </div> --}}
                                            <div class="col-sm-8">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Lengkap, <mark><i>Beserta Gelar</i></mark> <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="nama" value="{{ $list['show']->nama }}"
                                    placeholder="e.g. Sunaryo, S.Kep" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Panggilan <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="nick" value="{{ $list['show']->nick }}"
                                    placeholder="e.g. Soenaryo" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                                    <select class="select2 form-control" id="temp_lahir" name="temp_lahir" required>
                                                        @foreach ($list['kota'] as $item)
                                                            <option value="{{ $item->nama_kabkota }}"
                                                                @if ($list['show']->temp_lahir == $item->nama_kabkota) selected @endif>{{ $item->nama_kabkota }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" name="tgl_lahir"
                                                        value="{{ $list['show']->tgl_lahir }}" placeholder="YYYY-MM-DD" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                                    <select class="select2 form-control" id="jns_kelamin" name="jns_kelamin" required>
                                                        <option value="LAKI-LAKI" @if ($list['show']->jns_kelamin == 'LAKI-LAKI') echo selected @endif>
                                                            Laki-laki</option>
                                                        <option value="PEREMPUAN" @if ($list['show']->jns_kelamin == 'PEREMPUAN') echo selected @endif>
                                                            Perempuan</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="">
                                                    <label class="form-label">Status Kawin <span class="text-danger">*</span></label>
                                                    <select class="select2 form-control" name="status_kawin" required>
                                                        <option value="BELUM" @if ($list['show']->status_kawin == 'BELUM') echo selected @endif>Belum
                                                        </option>
                                                        <option value="SUDAH" @if ($list['show']->status_kawin == 'SUDAH') echo selected @endif>Sudah
                                                        </option>
                                                        <option value="CERAI" @if ($list['show']->status_kawin == 'CERAI') echo selected @endif>Cerai
                                                        </option>
                                                        <option value="RAHASIA" @if ($list['show']->status_kawin == 'RAHASIA') echo selected @endif>Tidak
                                                            ingin memberi tahu</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Alamat Sesuai KTP</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="alert alert-light">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                @if (!empty($list['show']->alamat_dom)) value="1" @else value="0" checked @endif
                                                name="cek_dom" id="checkbox_alamat">
                                                <label class="form-check-label" for="checkbox_alamat"><u><b>Alamat Domisili sama dengan KTP</b></u></label>
                                            </div>
                                            <small>Hilangkan centang untuk menampilkan Pilihan Domisili</small>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Provinsi <span class="text-danger">*</span></label>
                                                    <select class="select2 form-control" name="ktp_provinsi" id="apiprovinsi"
                                                        style="width: 100%" required>
                                                        @foreach ($list['provinsi'] as $item)
                                                            <option value="{{ $item->provinsi }}"
                                                                @if ($item->provinsi == $list['show']->ktp_provinsi) echo selected @endif>{{ $item->provinsi }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kabupaten <span class="text-danger">*</span></label>
                                                    <select class="select2 form-control" name="ktp_kabupaten" id="apikota" style="width: 100%"
                                                        disabled required>
                                                        @if (!empty($list['show']->ktp_kabupaten))
                                                            <option value="{{ $list['show']->ktp_kabupaten }}">
                                                                {{ $list['show']->ktp_kabupaten }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                                    <select class="select2 form-control" name="ktp_kecamatan" id="apikecamatan"
                                                        style="width: 100%" disabled required>
                                                        @if (!empty($list['show']->ktp_kecamatan))
                                                            <option value="{{ $list['show']->ktp_kecamatan }}">
                                                                {{ $list['show']->ktp_kecamatan }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kelurahan / Desa <span class="text-danger">*</span></label>
                                                    <select class="select2 form-control" name="ktp_kelurahan" id="apidesa"
                                                        style="width: 100%" disabled required>
                                                        @if (!empty($list['show']->ktp_kelurahan))
                                                            <option value="{{ $list['show']->ktp_kelurahan }}">
                                                                {{ $list['show']->ktp_kelurahan }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="">
                                                    <label class="form-label">Alamat Lengkap <span class="text-danger">*</span></label>
                                                    <textarea class="form-control" name="alamat_ktp" required placeholder="Tuliskan alamat lengkap sesuai KTP Anda"><?php echo htmlspecialchars($list['show']->alamat_ktp); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card" id="hidedom" @if (empty($list['show']->alamat_dom)) style="display: none" @endif>
                                    <div class="card-header">
                                        <h5>Alamat Domisli (Bila Ada)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Provinsi</label>
                                                    <select class="select2 form-control" name="dom_provinsi" id="apiprovinsidom"
                                                        style="width: 100%">
                                                        @foreach ($list['provinsi'] as $item)
                                                            <option value="{{ $item->provinsi }}"
                                                                @if ($item->provinsi == $list['show']->dom_provinsi) echo selected @endif>
                                                                {{ $item->provinsi }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kabupaten</label>
                                                    <select class="select2 form-control" name="dom_kabupaten" id="apikotadom"
                                                        style="width: 100%" disabled>
                                                        @if (!empty($list['show']->dom_kabupaten))
                                                            <option value="{{ $list['show']->dom_kabupaten }}">
                                                                {{ $list['show']->dom_kabupaten }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kecamatan</label>
                                                    <select class="select2 form-control" name="dom_kecamatan" id="apikecamatandom"
                                                        style="width: 100%" disabled>
                                                        @if (!empty($list['show']->dom_kecamatan))
                                                            <option value="{{ $list['show']->dom_kecamatan }}">
                                                                {{ $list['show']->dom_kecamatan }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Kelurahan</label>
                                                    <select class="select2 form-control" name="dom_kelurahan" id="apidesadom"
                                                        style="width: 100%" disabled>
                                                        @if (!empty($list['show']->dom_kelurahan))
                                                            <option value="{{ $list['show']->dom_kelurahan }}">
                                                                {{ $list['show']->dom_kelurahan }}</option>
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="">
                                                    <label class="form-label">Alamat Lengkap</label>
                                                    <textarea class="form-control" name="alamat_dom" id="apialamatdom" placeholder="Tuliskan alamat lengkap domisili Anda"><?php echo htmlspecialchars($list['show']->alamat_dom); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Media Sosial</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="input-group mb-3">
                                            <div class="d-flex align-items-center input-group-text">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-facebook">
                                                        <i class="fab fa-facebook-f f-16"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">Facebook /</h6>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="fb" value="{{ $list['show']->fb }}" placeholder="Tuliskan Username Facebook Anda">
                                        </div>
                                        <div class="input-group">
                                            <div class="d-flex align-items-center input-group-text">
                                                <div class="flex-shrink-0">
                                                    <div class="avtar avtar-xs btn-light-instagram">
                                                        <i class="fab fa-instagram f-16"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="mb-0">Instagram /</h6>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control" name="ig" value="{{ $list['show']->ig }}" placeholder="Tuliskan Username Instagram Anda">
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Data Pendidikan</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="alert alert-light">
                                                    <h6>Keterangan Pengisian</h6>
                                                    <i class="ti ti-arrow-narrow-right text-primary"></i> Kolom pertama adalah nama sekolah/universitas<br>
                                                    <i class="ti ti-arrow-narrow-right text-primary"></i> Kolom kedua adalah tahun lulus sesuai ijazah
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Sekolah Dasar (SD) atau sederajat</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="sd" value="{{ $list['show']->sd }}" placeholder="Nama Sekolah">
                                                        <input type="number" class="form-control" name="th_sd" value="{{ $list['show']->th_sd }}" placeholder="Tahun Lulus" maxlength="4">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">SMP/SLTP atau sederajat</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="smp" value="{{ $list['show']->smp }}" placeholder="Nama Sekolah">
                                                        <input type="number" class="form-control" name="th_smp" value="{{ $list['show']->th_smp }}" placeholder="Tahun Lulus">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">SMA/SMK atau sederajat</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="sma" value="{{ $list['show']->sma }}" placeholder="Nama Sekolah">
                                                        <input type="number" class="form-control" name="th_sma" value="{{ $list['show']->th_sma }}" placeholder="Tahun Lulus">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Diploma 2</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="d2" value="{{ $list['show']->d2 }}" placeholder="Nama Universitas">
                                                        <input type="number" class="form-control" name="th_d2" value="{{ $list['show']->th_d2 }}" placeholder ="Tahun Lulus">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Diploma 3</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="d3" value="{{ $list['show']->d3 }}" placeholder="Nama Universitas">
                                                        <input type="number" class="form-control" name="th_d3" value="{{ $list['show']->th_d3 }}" placeholder ="Tahun Lulus">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Diploma 4</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="d4" value="{{ $list['show']->d4 }}" placeholder="Nama Universitas">
                                                        <input type="number" class="form-control" name="th_d4" value="{{ $list['show']->th_d4 }}" placeholder ="Tahun Lulus">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Sarjana 1</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="s1" value="{{ $list['show']->s1 }}" placeholder="Nama Universitas">
                                                        <input type="number" class="form-control" name="th_s1" value="{{ $list['show']->th_s1 }}" placeholder ="Tahun Lulus">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Sarjana 1 <b>Khusus Profesi</b></label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="s1_profesi" value="" placeholder="Nama Universitas" disabled>
                                                        <input type="number" class="form-control" name="th_s1_profesi" value="" placeholder ="Tahun Lulus" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Sarjana 2</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" name="s2" value="{{ $list['show']->s2 }}" placeholder="Nama Universitas">
                                                        <input type="number" class="form-control" name="th_s2" value="{{ $list['show']->th_s2 }}" placeholder ="Tahun Lulus">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="">
                                                    <label class="form-label">Sarjana 3</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" name="s3" value="{{ $list['show']->s3 }}" placeholder="Nama Universitas">
                                                        <input type="number" class="form-control" name="th_s3" value="{{ $list['show']->th_s3 }}" placeholder="Tahun Lulus">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Data Kesehatan</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Riwayat Penyakit</label>
                                                    <textarea name="riwayat_penyakit" class="form-control" placeholder="Tuliskan bila ada"><?php echo htmlspecialchars($list['show']->riwayat_penyakit); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Riwayat Penyakit Keluarga</label>
                                                    <textarea name="riwayat_penyakit_keluarga" class="form-control" placeholder="Tuliskan bila ada"><?php echo htmlspecialchars($list['show']->riwayat_penyakit_keluarga); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Riwayat Operasi</label>
                                                    <textarea name="riwayat_operasi" class="form-control" placeholder="Tuliskan bila ada"><?php echo htmlspecialchars($list['show']->riwayat_operasi); ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="">
                                                    <label class="form-label">Riwayat Penggunaan Obat</label>
                                                    <textarea name="riwayat_penggunaan_obat" class="form-control" placeholder="Tuliskan bila ada"><?php echo htmlspecialchars($list['show']->riwayat_penggunaan_obat); ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-end btn-page">
                                <button type="submit" class="btn btn-primary" id="btn-submit-profil"><i class="ti ti-rocket"></i>&nbsp;&nbsp;Perbarui</button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- UBAH FOTO PROFIL --}}
                <div class="tab-pane" id="ubah-foto-profil" role="tabpanel" aria-labelledby="ubah-foto-profil-tab-3">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Ubah Foto Profil</h5>
                                </div>
                                <div class="card-body">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <input type="file" id="fileInput" accept="image/*" />
                                                <input type="button" id="btnCrop" value="Crop" />
                                                <input type="button" id="btnRestore" value="Restore" />
                                            </div>
                                            <div class="col-md-7 mb-3 mb-md-0">
                                                <canvas id="canvas" style="height: 600px;width: 600px;background-color: #ffffff;cursor:default;border: 1px solid black;">
                                                    Your browser does not support the HTML5 canvas element.
                                                </canvas>
                                                {{-- <div class="cropper">
                                                    <img src="{{ asset('images/light-box/l1.jpg') }}" alt="image" id="croppr" style="max-width: 100%; width:100%; height:100%">
                                                </div> --}}
                                            </div>
                                            <div class="col-md-12">
                                                <div id="result" style="height: 100px;width: 100px;"></div>
                                                {{-- <div class="rounded bg-light px-4 py-3 mb-3">
                                                    <h5>Selection value</h5>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <p id="valX"><strong>x: </strong>&nbsp;500</p>
                                                            <p class="mb-1" id="valY"><strong>y: </strong>&nbsp;500</p>
                                                        </div>
                                                        <div class="col-6">
                                                            <p id="valW"><strong>width: </strong>&nbsp;500</p>
                                                            <p class="mb-1" id="valH"><strong>height: </strong>&nbsp;500</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <h6>Aspect Ratio</h6>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                                                value="" id="cb-ratio"> <label class="form-check-label"
                                                                for="cb-ratio">Enable</label></div>
                                                    </div>
                                                </div>
                                                <div class="input-group mb-3"><span class="input-group-text">A</span> <input
                                                        type="text" class="form-control" id="input-ratio" value="1.0"
                                                        disabled="disabled"></div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <h6>Maximum size</h6>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                                                value="" id="max-checkbox"> <label class="form-check-label"
                                                                for="max-checkbox">Enable</label></div>
                                                    </div>
                                                </div>
                                                <div class="row g-1 g-sm-3 mb-4">
                                                    <div class="col-4">
                                                        <div class="input-group"><span class="input-group-text">W</span> <input
                                                                type="text" class="form-control" id="max-input-width"
                                                                value="150" disabled="disabled"></div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-group"><span class="input-group-text">H</span> <input
                                                                type="text" class="form-control" id="max-input-height"
                                                                value="150" disabled="disabled"></div>
                                                    </div>
                                                    <div class="col-4"><select id="max-input-unit" disabled="disabled"
                                                            class="form-control">
                                                            <option>px</option>
                                                            <option value="%">%</option>
                                                        </select></div>
                                                </div>
                                                <div class="row mb-1">
                                                    <div class="col">
                                                        <h6>Minimum size</h6>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="form-check"><input class="form-check-input" type="checkbox"
                                                                value="" id="min-checkbox"> <label class="form-check-label"
                                                                for="min-checkbox">Enable</label></div>
                                                    </div>
                                                </div>
                                                <div class="row g-1 g-sm-3">
                                                    <div class="col-4">
                                                        <div class="input-group"><span class="input-group-text">W</span> <input
                                                                type="text" class="form-control" id="min-input-width"
                                                                value="150" disabled="disabled"></div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="input-group"><span class="input-group-text">H</span> <input
                                                                type="text" class="form-control" id="min-input-height"
                                                                value="150" disabled="disabled"></div>
                                                    </div>
                                                    <div class="col-4"><select id="min-input-unit" disabled="disabled"
                                                            class="form-control">
                                                            <option>px</option>
                                                            <option value="%">%</option>
                                                        </select></div>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="row">
                                        <div class="col-sm-12">Sedang dalam pengembangan</div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label class="form-label">Username <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" value="Ashoka_Tano_16">
                                                <small class="form-text text-muted">Your Profile URL: https://pc.com/Ashoka_Tano_16</small>
                                            </div>
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
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-primary disabled" id="btn-submit-foto-profil">Perbarui</button>
                        </div>
                    </div>
                </div>

                {{-- UBAH PASSWORD --}}
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
                                            <small>Tuliskan password yang sama untuk konfirmasi password baru Anda </small>
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
                {{-- <div class="tab-pane" id="profile-5" role="tabpanel" aria-labelledby="profile-tab-5">
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
                </div> --}}
            </div>
        </div><!-- [ sample-page ] end -->
    </div><!-- [ Main Content ] end -->

    <script>
        addEventListener("DOMContentLoaded", (event) => {
            // "use strict";
            const password = document.getElementById("newPassword");
            const cpassword = document.getElementById("confirmPassword");
            const leng = $(".leng");
            const bigLetter = $(".big-letter");
            const num = $(".num");
            const specialChar = $(".special-char");
            var isPasswordValid = null;

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

                isPasswordValid = isLengthValid && hasUpperCase && hasNumber && hasSpecialChar;

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

            // VALIDASI KONFIRMASI PASSWORD
            cpassword.addEventListener("input", () => {
                if (password.value == cpassword.value && isPasswordValid) {
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

            $("#checkbox_alamat").on('change', function() {
                if ($(this).is(':checked')) {
                    $("#apiprovinsidom").val("").trigger('change').find('selected').remove();
                    $("#apikotadom").val("").trigger('change').find('selected').remove();
                    $("#apikecamatandom").val("").trigger('change').find('selected').remove();
                    $("#apidesadom").val("").trigger('change').find('selected').remove();
                    $("#apialamatdom").val("").text("").trigger('change');
                    // $('#apiprovinsidom').prop('disabled', true);
                    // $('#apikotadom').prop('disabled', true);
                    // $('#apikecamatandom').prop('disabled', true);
                    // $('#apidesadom').prop('disabled', true);
                    // $('#alamat_dom').prop('disabled', true);
                    $("#hidedom").removeClass('show').hide();
                    $(this).val("0");
                } else {
                    // $('#alamatdomisili').prop('hidden', false);
                    $('#apiprovinsidom').prop('disabled', false);
                    $('#apikotadom').prop('disabled', true);
                    $('#apikecamatandom').prop('disabled', true);
                    $('#apidesadom').prop('disabled', true);
                    $("#hidedom").addClass('show').show();
                    $(this).val("1");
                }
            });

            // ALAMAT KTP
            $('#apiprovinsi').change(function() {
                $.ajax({
                    url: "/api/provinsi/" + this.value,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        // console.log(this.value);
                        // var valprovinsi = $("#apiprovinsi").val();
                        $("#apikota").val("").find('option').remove();
                        $("#apikecamatan").val("").find('option').remove();
                        $("#apidesa").val("").find('option').remove();
                        $("#apikota").attr('disabled', false);
                        $("#apikecamatan").attr('disabled', true);
                        $("#apidesa").attr('disabled', true);
                        $("#apikota").append('<option value="">Pilih</option>');
                        // res.forEach(item => {
                        //     $("#apikota").val(item.nama_kabkota);
                        // });
                        // var ary = res.;
                        var len = res.length;
                        var sel = document.getElementById('apikota');
                        for (var i = 0; i < len; i++) {
                            var opt = document.createElement('option');
                            opt.innerHTML = res[i]['nama_kabkota'];
                            opt.value = res[i]['nama_kabkota'];
                            sel.appendChild(opt);
                            // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                        }
                    }
                });
            });

            $('#apikota').change(function() {
                $.ajax({
                    url: "/api/kota/" + this.value,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#apikecamatan").val("").find('option').remove();
                        $("#apidesa").val("").find('option').remove();
                        $("#apikecamatan").attr('disabled', false);
                        $("#apidesa").attr('disabled', true);
                        $("#apikecamatan").append('<option value="">Pilih</option>');
                        // res.forEach(item => {
                        //     $("#apikota").val(item.nama_kabkota);
                        // });
                        // var ary = res.;
                        var len = res.length;
                        var sel = document.getElementById('apikecamatan');
                        for (var i = 0; i < len; i++) {
                            var opt = document.createElement('option');
                            opt.innerHTML = res[i]['kecamatan'];
                            opt.value = res[i]['kecamatan'];
                            sel.appendChild(opt);
                            // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                        }
                    }
                });
            });

            $('#apikecamatan').change(function() {
                $.ajax({
                    url: "/api/kecamatan/" + this.value,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#apidesa").val("").find('option').remove();
                        $("#apidesa").attr('disabled', false);
                        $("#apidesa").append('<option value="">Pilih</option>');
                        // res.forEach(item => {
                        //     $("#apikota").val(item.nama_kabkota);
                        // });
                        // var ary = res.;
                        var len = res.length;
                        var sel = document.getElementById('apidesa');
                        for (var i = 0; i < len; i++) {
                            var opt = document.createElement('option');
                            opt.innerHTML = res[i]['desa'];
                            opt.value = res[i]['desa'];
                            sel.appendChild(opt);
                            // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                        }
                    }
                });
            });

            // ALAMAT DOMISILI
            $('#apiprovinsidom').change(function() {
                $.ajax({
                    url: "/api/provinsi/" + this.value,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        // var valprovinsi = $("#apiprovinsi").val();
                        $("#apikotadom").val("").find('option').remove();
                        $("#apikecamatandom").val("").find('option').remove();
                        $("#apidesadom").val("").find('option').remove();
                        $("#apikotadom").attr('disabled', false);
                        $("#apikecamatandom").attr('disabled', true);
                        $("#apidesadom").attr('disabled', true);
                        $("#apikotadom").append('<option value="">Pilih</option>');
                        // res.forEach(item => {
                        //     $("#apikota").val(item.nama_kabkota);
                        // });
                        // var ary = res.;
                        var len = res.length;
                        var sel = document.getElementById('apikotadom');
                        for (var i = 0; i < len; i++) {
                            var opt = document.createElement('option');
                            opt.innerHTML = res[i]['nama_kabkota'];
                            opt.value = res[i]['nama_kabkota'];
                            sel.appendChild(opt);
                            // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                        }
                    }
                });
            });

            $('#apikotadom').change(function() {
                $.ajax({
                    url: "/api/kota/" + this.value,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#apikecamatandom").val("").find('option').remove();
                        $("#apidesadom").val("").find('option').remove();
                        $("#apikecamatandom").attr('disabled', false);
                        $("#apidesadom").attr('disabled', true);
                        $("#apikecamatandom").append('<option value="">Pilih</option>');
                        // res.forEach(item => {
                        //     $("#apikota").val(item.nama_kabkota);
                        // });
                        // var ary = res.;
                        var len = res.length;
                        var sel = document.getElementById('apikecamatandom');
                        for (var i = 0; i < len; i++) {
                            var opt = document.createElement('option');
                            opt.innerHTML = res[i]['kecamatan'];
                            opt.value = res[i]['kecamatan'];
                            sel.appendChild(opt);
                            // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                        }
                    }
                });
            });

            $('#apikecamatandom').change(function() {
                $.ajax({
                    url: "/api/kecamatan/" + this.value,
                    type: 'GET',
                    dataType: 'json', // added data type
                    success: function(res) {
                        $("#apidesadom").val("").find('option').remove();
                        $("#apidesadom").attr('disabled', false);
                        $("#apidesadom").append('<option value="">Pilih</option>');
                        // res.forEach(item => {
                        //     $("#apikota").val(item.nama_kabkota);
                        // });
                        // var ary = res.;
                        var len = res.length;
                        var sel = document.getElementById('apidesadom');
                        for (var i = 0; i < len; i++) {
                            var opt = document.createElement('option');
                            opt.innerHTML = res[i]['desa'];
                            opt.value = res[i]['desa'];
                            sel.appendChild(opt);
                            // $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");
                        }
                    }
                });
            });

            // IMG CROPPER
            var canvas  = $("#canvas"),
                context = canvas.get(0).getContext("2d"),
                $result = $('#result');

            $('#fileInput').on( 'change', function(){
                if (this.files && this.files[0]) {
                    if ( this.files[0].type.match(/^image\//) ) {
                        var reader = new FileReader();
                        reader.onload = function(evt) {
                            var img = new Image();
                            img.onload = function() {
                                context.canvas.height = img.height;
                                context.canvas.width  = img.width;
                                context.drawImage(img, 0, 0);
                                var cropper = canvas.cropper({
                                    aspectRatio: 1 / 1
                                });
                                $('#btnCrop').click(function() {
                                    // Get a string base 64 data url
                                    var croppedImageDataURL = canvas.cropper('getCroppedCanvas').toDataURL("image/png");
                                    $result.append( $('<img>').attr('src', croppedImageDataURL).height(100).width(100) );
                                });
                                $('#btnRestore').click(function() {
                                    canvas.cropper('reset');
                                    $result.empty();
                                });
                            };
                            img.src = evt.target.result;
                        };
                        reader.readAsDataURL(this.files[0]);
                    }
                    else {
                        alert("Invalid file type! Please select an image file.");
                    }
                }
                else {
                    alert('No file(s) selected.');
                }
            });

        });

        // FUNCTION
        </script>
@endsection
