@extends('layouts.auth2')

@section('content')
<div class="auth-main">
    <div class="auth-wrapper v1">
        <div class="auth-form">
            <div class="card my-5">
                <div class="card-body">
                    <a href="javascript: void(0);"><img src="{{ asset('images/logo/logo_simrsmu_new_kop_31.png') }}" height="50" class="mb-4 img-fluid" alt="img"></a>
                    <form method="POST" action="{{ route('reset.password.post') }}">
                        {{ csrf_field() }}
                        <input name="token" value="{{ $token }}" type="hidden">
                        <div class="mb-4">
                            <h3 class="mb-2"><b>Reset Password</b></h3>
                            <p class="text-muted">Masukkan password <mark>BARU</mark> Anda</p>
                        </div>
                        <div class="mb-3"><label class="form-label">Email Anda</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Tuliskan E-Mail Aktif Anda" required autofocus>
                        </div>
                        <div class="mb-3"><label class="form-label">Password Baru</label>
                            <input type="password" class="form-control" id="password1" name="password" placeholder="Password Baru" required>
                        </div>
                        @if($errors->has('password'))
                            <em class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </em>
                        @endif
                        <div class="mb-3"><label class="form-label">Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" id="password2" name="password" placeholder="Konfirmasi Password Baru" required>
                        </div>
                        @if($errors->has('password_confirmation'))
                            <em class="invalid-feedback">
                                {{ $errors->first('password_confirmation') }}
                            </em>
                        @endif
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div><!-- [ Main Content ] end --><!-- Required Js -->
@endsection
