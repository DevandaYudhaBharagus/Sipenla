@extends('layouts.dashboard-layouts')

@section('title', 'Jadwal')
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
                            <img src="{{ asset('images/internal-images/icon-jadwal.png') }}"
                                class="d-flex align-items-center me-1" width="16px" height="16px" />
                            Jadwal
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
                    @if (Auth::User()->role == 'student')
                    <div class="col-md-3 col-12 mb-3 mb-md-0">
                        {{-- catetan ini munculin hanya pada role student --}}
                        <a href="{{ url('/mapel-siswa') }}">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-pelajaran.png') }}" alt="">
                                <div class="text-blank-schedule">Jadwal Pelajaran</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-3 col-12 mb-3 mb-md-0">
                        {{-- catetan ini munculin hanya pada role student --}}
                        <a href="{{ url('/extra-siswa') }}">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-pelajaran.png') }}" alt="">
                                <div class="text-blank-schedule">Jadwal Ekstrakurikuler</div>
                            </div>
                        </a>
                    </div>
                    @elseif (Auth::User()->role == 'guru')
                    <div class="col-md-3  col-12">
                        {{-- catetan ini munculin hanya role guru --}}
                        <a href="{{ url('/mapel-guru') }}">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-mengajar.png') }}" alt="">
                                <div class="text-blank-schedule">Jadwal Mengajar</div>
                            </div>
                        </a>
                    </div>
                    @elseif (Auth::User()->role == 'walimurid')
                    <div class="col-md-3 col-12 mb-3 mb-md-0">
                        {{-- catetan ini munculin hanya pada role student --}}
                        <a href="{{ url('/mapel-siswa') }}">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-pelajaran.png') }}" alt="">
                                <div class="text-blank-schedule">Jadwal Pelajaran</div>
                            </div>
                        </a>
                    </div>
                    @else
                    <div class="col-md-3  col-12">
                        <a href="{{ url('/jadwal/jadwal-kerja') }}">
                            <div class="box-icon-schedule">
                                <img src="{{ asset('images/internal-images/icon-mengajar.png') }}" alt="">
                                <div class="text-blank-schedule">Jadwal Kerja</div>
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
