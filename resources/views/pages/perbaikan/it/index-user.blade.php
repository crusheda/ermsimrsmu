@extends('layouts.index')

@section('content')
    <!-- [ breadcrumb ] start -->
    <link href="{{ asset('css/tracking.css') }}" rel="stylesheet" />

    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Pengaduan</li>
                        <li class="breadcrumb-item">Perbaikan</li>
                        <li class="breadcrumb-item" aria-current="page">IT</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Perbaikan <b class="text-primary">IT</b></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">

    </div>
    <!-- [ Main Content ] end -->
@endsection