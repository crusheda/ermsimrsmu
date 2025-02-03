@extends('layouts.auth2')

@section('content')
<div class="auth-main">
    <div class="auth-wrapper v1">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">
                    <a href="javascript: void(0);"><img src="{{ asset('images/logo/logo_simrsmu_new_kop_31.png') }}" class="mb-4" height="50" alt="img"></a>
                    <form method="POST" action="{{ route('lupa.password.post') }}">
                        {{ csrf_field() }}
                        <div class="d-flex justify-content-between align-items-end mb-4">
                            <h3 class="mb-0"><b>Lupa Password</b></h3><a href="{{ route('auth.login') }}"
                                class="link-primary">Ke halaman login</a>
                        </div>
                        {{-- START MESSAGE ERROR --}}
                        @if($errors->count() > 0)
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Error Message!</strong>
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="mb-3"><label class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Tuliskan Email Aktif Anda" required autofocus>
                        </div>
                        @if($errors->has('email'))
                            <em class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </em>
                        @endif
                        <p class="mt-4 text-sm text-muted">Pesan reset password akan dikirimkan ke email aktif Anda. Silakan memasukkan email Anda dengan benar (<strong>terdaftar</strong>).
                            <br><br><mark><b>Lupa email</b>?</mark> Hubungi bagian <u><b>Kepegawaian</b></u>
                        </p>
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-primary">Kirim Email Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- [ Main Content ] end --><!-- Required Js -->
@endsection
