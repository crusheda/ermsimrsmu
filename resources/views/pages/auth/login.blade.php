@extends('layouts.auth')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card">
                <div class="card-body ">
                    <div class="w-100">
                        <h5 class="text-primary">Selamat Datang! 👋</h5>
                        <p class="text-muted">Silakan masuk terlebih dahulu.</p>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-3" data-validate="Username is required">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="Enter username" value="{{ old('name') }}" required
                                    autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                {{-- @if ($errors->has('name'))
                                        <span class="">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif --}}
                            </div>

                            <div class="mb-3" data-validate="Password is required">
                                @if (Route::has('password.request'))
                                    <div class="float-end">
                                        <a href="{{ route('password.request') }}" class="text-muted">Forgot password?</a>
                                    </div>
                                @endif
                                <label class="form-label">Password</label>
                                <div class="input-group auth-pass-inputgroup">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter password" aria-label="Password" aria-describedby="password-addon"
                                        id="password" name="password" required autocomplete="current-password">
                                    <button class="btn btn-light " type="button" id="open-password"><i
                                            class="mdi mdi-eye-outline"></i></button>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember"
                                    id="remember {{ old('remember') ? 'checked' : '' }}">
                                <label class="form-check-label" for="remember-check">
                                    Remember me
                                </label>
                            </div>

                            <div class="mt-3 mb-3 d-grid">
                                <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                            </div>


                            {{-- <div class="mt-4 text-center">
                                <h5 class="font-size-14 mb-3">Sign in with</h5>

                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="javascript::void()"
                                            class="social-list-item bg-primary text-white border-primary">
                                            <i class="mdi mdi-facebook"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript::void()"
                                            class="social-list-item bg-info text-white border-info">
                                            <i class="mdi mdi-twitter"></i>
                                        </a>
                                    </li>
                                    <li class="list-inline-item">
                                        <a href="javascript::void()"
                                            class="social-list-item bg-danger text-white border-danger">
                                            <i class="mdi mdi-google"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div> --}}

                        </form>
                        <div class="text-center">
                            <p>Belum mempunyai akun ? <a href="javascript: void(0);" class="fw-medium text-primary"> Silakan
                                    hubungi IT </a> </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <p>
            <script>
                document.write(new Date().getFullYear())
            </script> © Made with <i class="mdi mdi-heart text-danger"></i> by
            Yussuf Faisal
        </p>
    </div>
    <script>
        $(document).ready(function() {
            $("#open-password").on("click", function() {
                var x = $("#password");
                if (x[0].type === "password") {
                    x[0].type = "text";
                } else {
                    x[0].type = "password";
                }
            });
        })
    </script>
@endsection
