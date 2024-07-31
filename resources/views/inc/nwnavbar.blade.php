<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="javascript:void(0);" class="b-brand text-primary">
                {{-- <img src="{{ asset('images/logo-dark.svg') }}" class="img-fluid logo-lg" alt="logo"> --}}
                <img src="{{ asset('images/logo/logo_new_simrsmu_black.png') }}" alt="logo" class="img-fluid" width="150px">
                <span class="badge bg-light-primary rounded-pill ms-2 theme-version">v3.1</span>
            </a>
        </div>
        <div class="navbar-content">
            <div class="card pc-user-card">
                <div class="card-body">
                    <?php $foto_profil = \DB::table('users_foto')->where('user_id', Auth::user()->id)->first();
                    $time = \Carbon\Carbon::now()->isoFormat('H');
                    // PENGHITUNGAN WAKTU PAGI / SIANG / SORE / MALAM
                    if ($time < "10") {
                        $waktu = "Pagi";
                    } else {
                        if ($time >= "10" && $time < "15") {
                            $waktu = "Siang";
                        } else {
                            if ($time >= "15" && $time < "19") {
                                $waktu = "Sore";
                            } else {
                                if ($time >= "19") {
                                    $waktu = "Malam";
                                }
                            }
                        }
                    }?>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            @if (empty($foto_profil->filename))
                                <img src="{{ asset('images/pku/user.png') }}" alt="Header Avatar" class="user-avtar wid-45 rounded-circle">
                            @else
                                <img src="{{ url('storage/'.substr($foto_profil->filename,7,1000)) }}" alt="Header Avatar" class="user-avtar wid-45 rounded-circle">
                            @endif
                        </div>
                        <div class="flex-grow-1 ms-3 me-2">
                            <small>Selamat {{ $waktu }},</small>
                            <h6 class="mb-0"><a class="text-primary">{{ Auth::user()->nick?Auth::user()->nick:Auth::user()->name }}</a></h6>
                        </div>
                        <a class="btn btn-icon btn-link-secondary avtar" data-bs-toggle="collapse" href="#pc_sidebar_userlink">
                            <svg class="pc-icon">
                                <use xlink:href="#custom-sort-outline"></use>
                            </svg>
                        </a>
                    </div>
                    <div class="collapse pc-user-links @if(URL::current() == url('/profil')) collapse show @endif" id="pc_sidebar_userlink">
                        <div class="pt-3">
                            <a href="{{ route('profil.index') }}" class="@if(URL::current() == url('/profil')) text-primary @endif">
                                <i class="ti ti-user"></i> <span>Profil Saya</span>
                            </a>
                            {{-- <a href="#!">
                                <i class="ti ti-settings"></i> <span>Settings</span>
                            </a>
                            <a href="#!">
                                <i class="ti ti-lock"></i> <span>Lock Screen</span>
                            </a> --}}
                            <a class="button" href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                <i class="ti ti-power"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @include('inc.nwsidebar')
        </div>
    </div>
</nav>
