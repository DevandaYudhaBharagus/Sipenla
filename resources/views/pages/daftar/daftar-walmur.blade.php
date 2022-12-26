@extends('layouts.dashboard-layouts')

@section('title', 'Daftar')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection
@section('content')
    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center"><i class="material-icons">home</i> Beranda</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/internal-images/icon-registrasi.png') }}"
                                class="d-flex align-items-center me-1" width="16px" height="16px" />
                            Daftar
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="profile">
        <div class="container">
            <div class="box-profile ">
                <div class="header-profile">
                    Daftar Wali Murid
                </div>
                <form action="{{ route('addGuardian') }}" method="POST">
                    @csrf
                    <input type="text" style="display: none" name="role" value="walimurid">
                    <div class="form-new-regis search-student">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Sandi</label>
                            <input type="password" name="password" class="form-control" id="password">
                            <span class="show-hide" style="left:62rem">
                                <i class="material-icons" id="material-password">visibility</i></span>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Konfirmasi</label>
                            <input type="password" name="password_confirmation" class="form-control" id="password">
                            <span class="show-hide" style="left:62rem">
                                <i class="material-icons" id="material-password">visibility</i></span>
                        </div>
                        <div class="mb-3">
                            <label for="" class="mb-3">Cari Siswa</label>
                            <select class="form-select" name="student_id" id="single-select-field"
                                data-placeholder="--- Pilih Siswa ---">
                                <option></option>
                                @foreach ($students as $new)
                                    <option value="{{ $new->user_id }}">{{ $new->first_name . ' ' . $new->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-save-regis">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('addon-javascript')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
    <script>
        const btnPassword = document.querySelectorAll("#material-password");
        const password = document.querySelectorAll("#password");

        for (let i = 0; i < btnPassword.length; i++) {
            btnPassword[i].addEventListener("click", () => {
                if (password[i].type == "password") {
                    password[i].type = "text";
                    btnPassword[i].innerHTML = "visibility_off"
                } else {
                    password[i].type = "password";
                    btnPassword[i].innerHTML = "visibility"
                }
            })
        }
    </script>
@endpush
