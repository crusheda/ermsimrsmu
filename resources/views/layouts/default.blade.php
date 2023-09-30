{{-- @include('inc.simrsmuv2.sidebar') --}}
<!doctype html>
<html lang="en" data-layout-width="boxed" data-topbar="dark" data-preloader="disable" data-card-layout="borderless"
    data-bs-theme="light" data-topbar-image="pattern-1">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <title>SIMRS V3 - {{ Auth::user()->name }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistem Manajemen Rumah Sakit PKU Muhammadiyah Sukoharjo" />
    <meta name="keywords" content="simrs, simrsmu, sim rspkuskh, pkuskh, rspkuskh, sistem pku, sistem informasi majemen rumah sakit">
    <meta name="author" content="Yussuf Faisal" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/logo/logo_light.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/logo/logo_light.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/logo/logo_light.png') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- App js -->
    <script src="{{ asset('js/plugin.js') }}"></script>
</head>

<body data-sidebar="dark">
    <div id="layout-wrapper">

        @include('inc.header')

        @include('inc.sidebar')

        <!-- Start main Content -->
        <div class="main-content">

            <!-- Page-content -->
            <div class="page-content">
                <!-- container-fluid -->
                <div class="container-fluid">

                    @yield('content') <!-- ALL CONTENT HERE -->

                </div>
                <!-- End container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('inc.modal')

            @include('inc.footer')

        </div>
        <!-- end main Content-->

    </div>
    <!-- END layout-wrapper -->

    @include('inc.floatmenu')

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!-- JAVASCRIPT -->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('libs/node-waves/waves.min.js') }}"></script>
    <!-- apexcharts -->
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- dashboard init -->
    <script src="{{ asset('js/pages/dashboard.init.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
