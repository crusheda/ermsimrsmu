@extends('layouts.index')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card welcome-banner bg-blue-300">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="p-4">
                                <h2 class="text-white">Halo, Selamat {{ $list['waktu'] }} <a class="text-white">{{ $list['user']->nama ? $list['kelamin'].' '.$list['user']->nama : $list['kelamin'].' '.$list['user']->name }}</h2>
                                <p class="text-white">Sudahkan Anda Membaca <b>Peraturan Kepegawaian</b> ?</p>
                                <footer class="blockquote-footer font-size-12 text-white">
                                    Ditetapkan mulai <cite title="Source Title"><strong>1 Juli 2023</strong></cite>
                                </footer>
                                <a href="#" class="btn btn-outline-light" data-bs-toggle="modal"
                                data-bs-target="#peraturan-kepegawaian">Selengkapnya</a>
                            </div>
                        </div>
                        <div class="col-sm-6 text-center">
                            <div class="img-welcome-banner">
                                <img src="{{ asset('images/widget/welcome-banner.png') }}" alt="img" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="peraturan-kepegawaian" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Peraturan Kepegawaian</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <embed src="/doc/073_PR_PERATURAN_PERUSAHAAN_2024.pdf" type="application/pdf" height="700px" width="100%">
                    </div>
                    {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <script>
        // $(document).ready(function() {

        // });
    </script>
@endsection
