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
        <a href="{{ route('dashboardx') }}" class="pc-link">
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
        </ul>
    </li>
</ul>
