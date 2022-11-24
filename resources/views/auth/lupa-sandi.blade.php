@extends('layouts.lupa-sandi-layout')

@section('title', 'SIPENLA | Lupa Kata Sandi')

@section('content')
    <div class="container">
        <div class="box-forgot">
            <div class="title-forgot">
                <a href="{{ url('/login') }}" class="d-flex align-items-center">
                    <i class="material-icons">arrow_back</i>
                </a>
                Lupa Sandi
            </div>
            <div class="row mt-3 align-items-center row-forgot">
                <div class="col-md-6">
                    <div class="box-input-forgot">
                        <div class="text-forgot">
                            Silahkan Masukkan Alamat Email Anda Untuk Menerima Kode
                            Verifikasi
                        </div>
                        <form action="{{ route('forgotpass') }}" method="post">
                            @csrf
                            <div class="form-forgot">
                                <input type="email" name="email" placeholder="Alamat Email" />
                            </div>
                            <button class="btn-forgot">Kirim</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box-image">
                        <img src="{{ asset('images/internal-images/forgot-password.png') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
