@extends('layouts.dashboard-layouts')

@section('title', 'Daftar')
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
                    Daftar Siswa
                </div>
                <form action="{{ route('formregister') }}" method="POST">
                    @csrf
                    <input type="text" style="display: none" name="role" value="student" >
                    <div class="form-new-regis">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Sandi</label>
                            <input type="password" name="password" class="form-control" id="exampleInputEmail1">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Konfirmasi</label>
                            <input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail1">
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
