@extends('layouts.dashboard-layouts')

@section('title', 'Penilaian')
@section('content')
    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/dashboard" class="d-flex align-items-center"><i class="material-icons">home</i> Beranda</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/internal-images/icon-penilaian.png') }}"
                                class="d-flex align-items-center me-1" width="16px" height="16px" />
                            Raport
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
                    Daftar
                </div>
                <div class="row justify-content-center schedule ">
                    <div class="col-md-3 col-12 mb-3 mb-md-0">
                        {{-- ini ke masukkan nilai pembelajaran --}}
                        <a href="{{ url('/mapel-siswa') }}">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-pil-raport.png') }}" alt="">
                                <div class="text-blank-schedule text-center">Data Pembelajaran Siswa</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3  col-12">
                        {{-- ini ke riwayat penilaian --}}
                        <a href="{{ url('/mapel-guru') }}">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-pil-raport.png') }}" alt="">
                                <div class="text-blank-schedule text-center">Riwayat Raport</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
