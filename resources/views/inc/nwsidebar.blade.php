<ul class="pc-navbar">
    <li class="pc-item">
        <a href="{{ route('portal') }}" class="pc-link">
            <span class="pc-micon">
                {{-- <svg class="pc-icon">
                    <use xlink:href="#custom-notification-status"></use>
                </svg> --}}
                <i class="fas fa-tachometer-alt"></i>
            </span>
            <span class="pc-mtext">Portal</span>
        </a>
    </li>
    <li class="pc-item">
        <a href="{{ route('dashboard') }}" class="pc-link">
            <span class="pc-micon">
                {{-- <svg class="pc-icon">
                    <use xlink:href="#custom-notification-status"></use>
                </svg> --}}
                <i class="fas fa-home"></i>
            </span>
            <span class="pc-mtext">Dashboard</span>
        </a>
    </li>
    @if (
            Auth::user()->getPermission('struktur_organisasi') == true ||
            Auth::user()->getPermission('profil_karyawan') == true ||
            Auth::user()->getRole('it') == true
        )
        <li class="pc-item pc-caption"><label>Kepegawaian</label></li>
        @if (Auth::user()->getPermission('profil_karyawan') == true || Auth::user()->getRole('it') == true)
            <li class="pc-item">
                <a href="{{ route('profilkaryawan.index') }}" class="pc-link">
                    <span class="pc-micon">
                        <i class="fas fa-id-card-alt"></i>
                    </span>
                    <span class="pc-mtext">Profil Kepegawaian</span>
                </a>
            </li>
        @endif
        @if (Auth::user()->getPermission('struktur_organisasi') == true || Auth::user()->getRole('it') == true)
            <li class="pc-item">
                <a href="{{ route('strukturorganisasi.index') }}" class="pc-link">
                    <span class="pc-micon">
                        <i class="fas fa-sitemap"></i>
                    </span>
                    <span class="pc-mtext">Struktur Organisasi</span>
                </a>
            </li>
        @endif
    @endif
    @if (
            Auth::user()->getPermission('akses_jabatan') == true ||
            Auth::user()->getPermission('akun_pengguna') == true ||
            Auth::user()->getRole('it') == true
        )
        <li class="pc-item pc-caption"><label>Atur Pengguna</label></li>
        @if (Auth::user()->getPermission('akses_jabatan') == true || Auth::user()->getPermission('akun_pengguna') == true)
            <li class="pc-item pc-hasmenu">
                <a href="javascript: void(0);" class="pc-link">
                    <span class="pc-micon">
                        <i class="fas fa-users-cog"></i>
                    </span>
                    <span class="pc-mtext">Hak Akses</span>
                    <span class="pc-arrow mt-1">
                        <i data-feather="chevron-right"></i>
                    </span>
                </a>
                <ul class="pc-submenu">
                    @if (Auth::user()->getPermission('akses_jabatan') == true || Auth::user()->getRole('it') == true)
                        <li class="pc-item"><a class="pc-link" href="{{ route('aksesjabatan.index') }}">Akses Jabatan</a></li>
                    @endif
                    @if (Auth::user()->getPermission('akun_pengguna') == true || Auth::user()->getRole('it') == true)
                        <li class="pc-item"><a class="pc-link" href="{{ route('akunpengguna.index') }}">Akun Pengguna</a></li>
                    @endif
                </ul>
            </li>
        @endif
    @endif
    <li class="pc-item pc-caption"><label>Administrasi</label></li>
    <li class="pc-item pc-hasmenu">
        <a href="javascript: void(0);" class="pc-link">
            <span class="pc-micon">
                {{-- <svg class="pc-icon">
                    <use xlink:href="#custom-status-up"></use>
                </svg> --}}
                <i class="fas fa-archive"></i>
            </span>
            <span class="pc-mtext">Berkas</span>
            <span class="pc-arrow mt-1">
                <i data-feather="chevron-right"></i>
            </span>
            {{-- <span class="pc-badge">2</span> --}}
        </a>
        <ul class="pc-submenu">
            <li class="pc-item"><a class="pc-link" href="{{ route('bulanan.index') }}">Laporan Rutin</a></li>
            <li class="pc-item"><a class="pc-link" href="{{ route('rapat.index') }}">Rapat</a></li>
            <li class="pc-item"><a class="pc-link" href="{{ route('rka.index') }}">RKA</a></li>
            <li class="pc-item"><a class="pc-link" href="{{ route('regulasi.index') }}">Regulasi</a></li>
            @if (
                    Auth::user()->getPermission('disposisi') == true ||
                    Auth::user()->getPermission('surat_masuk') == true ||
                    Auth::user()->getPermission('surat_keluar') == true
                )
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link">Surat<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                    <ul class="pc-submenu">
                        @if (Auth::user()->getPermission('disposisi') == true)
                            <li class="pc-item"><a class="pc-link" href="{{ route('disposisi.index') }}">Disposisi</a></li>
                        @endif
                        @if (Auth::user()->getPermission('surat_masuk') == true)
                            <li class="pc-item"><a class="pc-link" href="{{ route('suratmasuk.index') }}">Surat Masuk</a></li>
                        @endif
                        @if (Auth::user()->getPermission('surat_keluar') == true)
                            <li class="pc-item"><a class="pc-link" href="{{ route('suratkeluar.index') }}">Surat Keluar</a></li>
                        @endif
                    </ul>
                </li>
            @endif
        </ul>
    </li>
    <li class="pc-item pc-hasmenu">
        <a href="javascript: void(0);" class="pc-link">
            <span class="pc-micon">
                {{-- <svg class="pc-icon">
                    <use xlink:href="#custom-status-up"></use>
                </svg> --}}
                <i class="fas fa-dolly-flatbed"></i>
            </span>
            <span class="pc-mtext">Inventaris</span>
            <span class="pc-arrow mt-1">
                <i data-feather="chevron-right"></i>
            </span>
            {{-- <span class="pc-badge">2</span> --}}
        </a>
        <ul class="pc-submenu">
            <li class="pc-item"><a class="pc-link" href="{{ route('aset.index') }}">Aset</a></li>
        </ul>
    </li>
    @if (Auth::user()->getPermission('pengadaan') == true)
    <li class="pc-item">
        <a href="{{ route('pengadaan.index') }}" class="pc-link">
            <span class="pc-micon">
                <i class="fas fa-shopping-cart"></i>
            </span>
            <span class="pc-mtext">Pengadaan</span>
        </a>
    </li>
    @endif
    <li class="pc-item">
        <a href="{{ route('eruang.index') }}" class="pc-link">
            <span class="pc-micon">
                {{-- <svg class="pc-icon">
                    <use xlink:href="#custom-notification-status"></use>
                </svg> --}}
                <i class="fas fa-key"></i>
            </span>
            <span class="pc-mtext">E-Ruang</span>
        </a>
    </li>
    @if (Auth::user()->getPermission('perbaikan_ipsrs') == true)
    <li class="pc-item pc-caption"><label>Pengaduan</label></li>
    @endif
    @if (Auth::user()->getPermission('perbaikan_ipsrs') == true)
    <li class="pc-item pc-hasmenu">
        <a href="javascript: void(0);" class="pc-link">
            <span class="pc-micon">
                <i class="fas fa-wrench"></i>
            </span>
            <span class="pc-mtext">Perbaikan</span>
            <span class="pc-arrow mt-1">
                <i data-feather="chevron-right"></i>
            </span>
        </a>
        <ul class="pc-submenu">
            <li class="pc-item"><a class="pc-link" href="{{ route('ipsrs.index') }}">IPSRS</a></li>
        </ul>
    </li>
    @endif
    @if (Auth::user()->getPermission('skl') == true)
    <li class="pc-item pc-caption"><label>Pelayanan</label></li>
    @endif
    @if (Auth::user()->getPermission('skl') == true)
    <li class="pc-item">
        <a href="{{ route('skl.index') }}" class="pc-link">
            <span class="pc-micon">
                <i class="fas fa-baby"></i>
            </span>
            <span class="pc-mtext">Surat Keterangan Lahir</span>
        </a>
    </li>
    @endif
    <li class="pc-item pc-caption"><label>Akreditasi</label></li>
    <li class="pc-item">
        <a href="{{ route('accidentreport.index') }}" class="pc-link">
            <span class="pc-micon">
                <i class="fas fa-running"></i>
            </span>
            <span class="pc-mtext">Kecelakaan Kerja</span>
        </a>
    </li>
</ul>
