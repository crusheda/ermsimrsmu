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
    <meta name="keywords"
        content="simrs, simrsmu, sim rspkuskh, pkuskh, rspkuskh, sistem pku, sistem informasi majemen rumah sakit">
    <meta name="author" content="Yussuf Faisal" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('images/pku/pku_ico.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/pku/pku_ico.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/pku/pku_ico.png') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <!-- App js -->
    <script src="{{ asset('js/plugin.js') }}"></script>
    <!-- Initialize js -->
    <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script>

    <!-- Start Addon css -->
    <!-- Sweet Alert-->
    <link href="{{ asset('libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link href="{{ asset('libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- Form Advanced examples -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link href="{{ asset('libs/select2/css/select2.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('libs/spectrum-colorpicker2/spectrum.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('libs/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('libs/@chenfengyuan/datepicker/datepicker.min.css') }}" rel="stylesheet">

    <!-- Responsive datatable examples -->
    <link href="{{ asset('libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('libs/admin-resources/rwd-table/rwd-table.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Notif examples -->
    <link rel="stylesheet" href="{{ asset('css/iziToast.css') }}" />

    <!-- End Addon css -->

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

    <!-- Logout Form -->
    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>
    <!-- JAVASCRIPT -->
    {{-- <script src="{{ asset('libs/jquery/jquery.min.js') }}"></script> --}}
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

    <!-- Start Addon js -->
    <!-- Required datatable js -->
    <script src="{{ asset('libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Buttons DT examples -->
    <script src="{{ asset('libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('libs/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('libs/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('libs/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Form Advanced examples -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    <script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('libs/spectrum-colorpicker2/spectrum.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <script src="{{ asset('libs/@chenfengyuan/datepicker/datepicker.min.js') }}"></script>

    <!-- Responsive examples -->
    <script src="{{ asset('libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('libs/admin-resources/rwd-table/rwd-table.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('js/pages/datatables.init.js') }}"></script>

    <!-- Sweet Alerts js -->
    <script src="{{ asset('libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/pages/sweet-alerts.init.js') }}"></script>

    <!-- Notif js -->
    <script src="{{ asset('js/iziToast.js') }}"></script>
    <!-- End Addon js -->
</body>

</html>
