<ul class="pc-navbar">
    <li class="pc-item">
        <a href="../other/sample-page.html" class="pc-link">
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
    <li class="pc-item pc-caption"><label>Administrasi</label></li>
    <li class="pc-item pc-hasmenu">
        <a href="#!" class="pc-link">
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
            <li class="pc-item"><a class="pc-link" href="#">Laporan Bulanan</a></li>
            <li class="pc-item"><a class="pc-link" href="{{ route('rapat.index') }}">Rapat</a></li>
            <li class="pc-item"><a class="pc-link" href="{{ route('rapat.index') }}">RKA</a></li>
            <li class="pc-item"><a class="pc-link" href="{{ route('rapat.index') }}">Regulasi</a></li>
            <li class="pc-item pc-hasmenu">
                <a href="#!" class="pc-link">Surat<span class="pc-arrow"><i data-feather="chevron-right"></i></span></a>
                <ul class="pc-submenu">
                    <li class="pc-item"><a class="pc-link" href="#!">Disposisi</a></li>
                    <li class="pc-item"><a class="pc-link" href="#!">Surat Masuk</a></li>
                    <li class="pc-item"><a class="pc-link" href="#!">Surat Keluar</a></li>
                </ul>
            </li>
        </ul>
    </li>
    <li class="pc-item pc-hasmenu">
        <a href="#!" class="pc-link">
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
</ul>
