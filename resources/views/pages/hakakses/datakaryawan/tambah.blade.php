@extends('layouts.default')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Akun Pengguna - Tambah</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <button class="btn btn-outline-secondary" onclick="window.location.href='{{ URL::previous() }}'"><i
                        class="bx bx-chevron-left"></i>&nbsp;&nbsp;Kembali</button>
            </h4>
            <hr>

            <form class="form-auth-small" name="formTambah" action="{{ route('datakaryawan.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="defaultFormControlInput" class="form-label">Username</label>
                            <div class="input-group">
                                <input type="text" name="name" id="name" class="form-control" placeholder=""
                                    required />
                                <button class="btn btn-outline-primary" type="button" onclick="verifName()">Check</button>
                            </div>
                            <sub>Klik Check untuk validasi ketersediaan Username</sub>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="defaultFormControlInput" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="" required />
                        </div>
                    </div>
                    <div class="col-md-12 mb-4">
                        <div class="form-group">
                            <label for="defaultFormControlInput" class="form-label">Role</label>
                            <div class="select2-dark">
                                <select id="role" name="role[]" class="select2 form-control select2-multiple"
                                    data-bs-auto-close="outside" required multiple="multiple"
                                    data-placeholder="Pilih Role ..." style="width: 100%">
                                    @if (count($role) > 0)
                                        @foreach ($role as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="defaultFormControlInput" class="form-label">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password1" minlength="8"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    onpaste="return false" required />
                                <button class="btn btn-outline-primary" type="button" id="open-password1"><i
                                        class="bx bx-hide"></i></button>
                            </div>
                            <sub>Masukkan password minimal 8 karakter</sub>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-group">
                            <label for="defaultFormControlInput" class="form-label">Retype Password</label>
                            <div class="input-group">
                                <input type="password" name="repassword" class="form-control" id="password2" minlength="8"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    onpaste="return false" required />
                                <button class="btn btn-outline-primary" type="button" id="open-password2"><i
                                        class="bx bx-hide"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <h5 class="font-size-14"><i class="mdi mdi-arrow-right text-primary"></i> Password will be Encrypted
                            with Laravel Bcrypt Hash </h5>
                        <button class="btn btn-primary" id="btn-simpan" onclick="saveData()" disabled>
                            <i class="fas fa-save fa-md"></i>&nbsp;&nbsp;
                            <span class="align-middle d-sm-inline-block d-none me-sm-1">Simpan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".select2").select2();
        })

        // FUNCTION
        function saveData() {
            var pas1 = $("#password1").val();
            var pas2 = $("#password2").val();
            $("#formTambah").one('submit', function() {
                if (pas1 == '' && pas2 != '') {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Mohon untuk melengkapi pengisian Password',
                        position: 'topRight'
                    });
                    return false;
                } else {
                    if (pas1 != '' && pas2 == '') {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Mohon untuk melengkapi pengisian Password',
                            position: 'topRight'
                        });
                        return false;
                    } else {
                        if (pas1 === pas2) {
                            $("#btn-simpan").attr('disabled', 'disabled');
                            $("#btn-simpan").find("i").toggleClass("fa-save fa-sync fa-spin");
                            return true;
                        } else {
                            iziToast.error({
                                title: 'Pesan Galat!',
                                message: 'Mohon maaf, kombinasi password tidak cocok',
                                position: 'topRight'
                            });
                            return false;
                        }
                    }
                }
            });
        }

        function verifName() {
            var name = $("#name").val();
            $.ajax({
                url: "/api/hakakses/datakaryawan/verif/" + name,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    if (res === 1) {
                        iziToast.error({
                            title: 'Pesan Galat!',
                            message: 'Mohon maaf, username sudah ada, silakan coba lagi dengan username yang berbeda',
                            position: 'topRight'
                        });
                    } else {
                        iziToast.success({
                            title: 'Pesan Sukses!',
                            message: 'Username dapat digunakan',
                            position: 'topRight'
                        });
                        $("#btn-simpan").prop('disabled', false);
                    }
                },
                error: function(res) {
                    iziToast.error({
                        title: 'Pesan Galat!',
                        message: 'Mohon maaf, username sudah ada, silakan coba lagi dengan username yang berbeda',
                        position: 'topRight'
                    });
                }
            });
        }
    </script>
@endsection
