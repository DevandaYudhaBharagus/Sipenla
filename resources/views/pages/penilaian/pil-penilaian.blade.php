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
                            Penilaian Pembelajaran
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
                    @if (Auth::User()->role == 'guru')
                    <div class="col-md-3 col-12 mb-3 mb-md-0">
                        <a href="{{ url('/penilaian') }}">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-pil-penilaian.png') }}" alt="">
                                <div class="text-blank-schedule text-center">Masukkan Nilai Pembelajaran</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3  col-12">
                        <a href="{{ url('/penilaian/riwayat') }}">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-pil-penilaian.png') }}" alt="">
                                <div class="text-blank-schedule text-center">Riwayat Penilaian Pembelajaran</div>
                            </div>
                        </a>
                    </div>
                    @elseif (Auth::User()->role == 'pembinaextra')
                    <div class="col-md-3 col-12 mb-3 mb-md-0">
                        <a href="{{ url('/penilaian-extra') }}">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-pil-penilaian.png') }}" alt="">
                                <div class="text-blank-schedule text-center">Masukkan Nilai Ekstrakurikuler</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3  col-12">
                        <a href="{{ url('/penilaian-extra/riwayat') }}">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-pil-penilaian.png') }}" alt="">
                                <div class="text-blank-schedule text-center">Riwayat Penilaian Ekstrakurikuler</div>
                            </div>
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
