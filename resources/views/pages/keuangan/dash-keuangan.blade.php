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
                            <img src="{{ asset('images/internal-images/icon-keuangan.png') }}"
                                class="d-flex align-items-center me-1" width="16px" height="16px" />
                            Laporan Keuangan
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="profile">
        <div class="container">
            <div class="profile-finance">
                <div class="d-flex justify-content-center">
                    <img src="/images/internal-images/pengumuman.jpg" class="logo-finance" alt="">
                </div>
                <div class="text-logo-finance">
                    Admin
                </div>

                <div class="d-md-flex justify-content-center mt-4">
                    <div class="icon-saldo-finance me-3">
                        <div class="color-finance bg-green"></div>
                        <div class="saldo-finance">
                            <div class="text-sald">Saldo Masuk</div>
                            <div class="price-finance">Rp 10.000.000</div>
                        </div>
                    </div>
                    <div class="icon-saldo-finance ms-3">
                        <div class="color-finance bg-red"></div>
                        <div class="saldo-finance">
                            <div class="text-sald">Saldo Keluar</div>
                            <div class="price-finance">Rp 100.000.000</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="history-finance">
                <h6>History Keuangan</h6>
                <div class="box-history-finance">
                    <div class="icon-history-finance">
                        <div class="color-finance bg-green"></div>
                        <div class="saldo-finance">
                            <div class="text-sald">Saldo Masuk</div>
                            <div class="price-finance">Rp 10.000.000</div>
                        </div>
                    </div>
                    <div class="text-history-finance">
                        -Rp 50.000
                    </div>
                </div>
            </div>
    </section>
@endsection
