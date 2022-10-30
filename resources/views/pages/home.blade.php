@extends('layouts.lanpage-login')

@section('title', 'SIPENLA')

@section('content')
    <div class="content-landing">
        <div class="page-text">
            <h3>Selamat Datang di</h3>
            <h1>SIPENLA</h1>
            <div class="description">
                <p>
                    Smart School (SIPENLA) merupakan sistem informasi pendidikan
                    layanan berbasis aplikasi android dan wesbite yang memberikan
                    kemudahan akses dimana saja dan kapan saja, bagi seluruh
                    pengguna terkait berbagai informasi dan layanan seputar sekolah.
                </p>
            </div>
            <a href="/login" class="btn btn-mulai">YUK MULAI!</a>
        </div>
        <div class="page-image">
            <div class="frame-image">
                <img src="{{ asset('images/internal-images/img-landing-page.png') }}" alt="" />
            </div>
        </div>
    </div>
@endsection
