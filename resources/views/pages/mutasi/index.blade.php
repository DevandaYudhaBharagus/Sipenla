@extends('layouts.dashboard-layouts')

@section('title', 'Mutasi')
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
            <div class="header-profile mb-3">
                Mutasi Siswa
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="box-student-profile mb-3">
                        <div class="d-flex">
                            <img src="" alt="" class="profile-student">
                            <div class="">
                                <p>{{auth()->user()->student->first_name}} {{auth()->user()->student->last_name}}</p>
                                <p>Siswa</p>
                            </div>
                        </div>
                    </div>
                    <div class="box-student-profile">
                        <h6 class="text-center">Pengajuan Mutasi</h6>
                        <div class="d-flex justify-content-center my-5">
                            <a class="btn btn-primary" href="/mutasi/ajukan" style="background: #3774C3">Ajukan Mutasi</a>
                        </div>
                    </div>
                    <div class="box-student-profile mt-3">
                        <h6 class="text-center">Tata Cara dan Persyaratan Pengajuan Mutasi</h6>
                        <ol>
                            <li class="fs-6">Serahkan surat permohonan pindah dari orang tua / wali ke pihak TU sekolah.</li>
                            <li class="fs-6"> Ajukan surat pernyataan tidak sedang menjalani sanksi sekolah, surat permohonan pindah dari sekolah asal, dan surat rekomendasi dinas melalui TU.</li>
                            <li class="fs-6">Selanjutnya masukkan data dan unggah semua dokumen dalam fitur mutasi SIPENLA dan simpan.</li>
                            <li class="fs-6">Cek status riwayat pengajuan mutasi hingga terkonfirmasi oleh kepala sekolah.</li>
                            <li class="fs-6">Jika terkonfirmasi maka akun siswa akan berubah seperti akun wali murid.</li>
                        </ol>
                    </div>
                </div>
                <div class="col-md-7 box-student-profile">
                    <div class="mb-3">
                        <h6><b>Riwayat Pengajuan Mutasi</b></h6>
                        <hr>
                        @foreach ($mutasi as $item)
                        <div class="box-student-profile mb-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="">
                                    <p><b>{{auth()->user()->student->first_name}} {{auth()->user()->student->last_name}}</b></p>
                                    <p>NISN : {{auth()->user()->student->nisn}}</p>
                                </div>
                                <a href="/mutasi/ajukan/{{$item->mutasi_id}}">Detail</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection()