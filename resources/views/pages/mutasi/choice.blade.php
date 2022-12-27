@extends('layouts.dashboard-layouts')

@section('title', 'Ajukan Mutasi')

@section('content')
<section class="profile">
    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/dashboard" class="d-flex align-items-center"><i class="material-icons">home</i>
                            Beranda</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center"><img src="{{ asset('images/internal-images/absen.png') }}" alt="" style="width:15px" class="me-1"/>
                            Mutasi</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="box-profile">
            <div class="d-flex justify-content-center align-items-center">
                <div class="d-flex">
                    <a class="box-profile d-flex column flex-column mx-3" href="/mutasi/pengajuan">
                        <img src="{{asset('images/internal-images/icon-user.png')}}" alt="">
                        <p>Data Pengajuan Mutasi</p>
                    </a>
                    <a class="box-profile d-flex column flex-column mx-3" href="/mutasi/riwayat">
                        <img src="{{asset('images/internal-images/icon-user.png')}}" alt="">
                        <p>Riwayat Mutasi</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection