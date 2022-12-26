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
                <div class="row justify-content-center schedule ">
                    <div class="col-md-3 col-12 mb-3 mb-md-0">
                        <a href="">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-user.png') }}" alt="">
                                <div class="text-blank-schedule">Pegawai</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-12">
                        {{-- catetan ini munculin hanya role guru --}}
                        <a href="">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-user.png') }}" alt="">
                                <div class="text-blank-schedule">Siswa</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-12">
                        {{-- catetan ini munculin hanya role guru --}}
                        <a href="">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-user.png') }}" alt="">
                                <div class="text-blank-schedule">Wali Murid</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
