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
                        <a href="/mutasi/choice" class="d-flex align-items-center"><img src="{{ asset('images/internal-images/absen.png') }}" alt="" style="width:15px" class="me-1"/>
                            Mutasi Siswa</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center"><img src="{{ asset('images/internal-images/absen.png') }}" alt="" style="width:15px" class="me-1"/>
                            Data Pengajuan Siswa</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container">
        <div class="box-profile">
            <h6 class="mb-5">Riwayat Mutasi</h6>
                <div class="row">
                    @foreach ($mutasi as $item)
                    <div class="box-profile col-md-8 mx-auto">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="">
                                <p>{{$item->student->first_name}} {{$item->student->last_name}}</p>
                                <p>NISN : {{$item->student->nisn}}</p>
                                <p>{{$item->created_at}}</p>
                            </div>
                            <div class="">
                                
                                @if($item->status=='konfirmasi')
                                <p class="text-success">Dikonfirmasi</p>
                                @elseif($item->status=='tolak')
                                <p class="text-danger">Ditolak</p>
@endif
                                <a href="/mutasi/pengajuan/{{$item->mutasi_id}}">Detail</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
            </div>
        </div>
    </div>
</section>
@endsection