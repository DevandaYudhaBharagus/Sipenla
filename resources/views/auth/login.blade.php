@extends('layouts.lanpage-login')

@section('title', 'SIPENLA | LOGIN')

@section('content')
    <div class="box-login">
        <div class="content-login">
            <div class="frame-logo-login">
                <img src="{{ asset('images/internal-images/logo.png') }}" alt="" />
            </div>
            <h5>Selamat Datang</h5>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-4 mt-3">
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email" />
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" />
                    <span class="show-hide">
                        <i class="material-icons" id="material-password">visibility</i></span>
                </div>
                <div class="mb-3 d-flex align-items-center">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" />
                    <label class="label-cekbok ms-2" for="exampleCheck1">Simpan sandi</label>
                    <a href="{{ url('/lupa-sandi') }}" class="ms-auto lupa-sandi">Lupa sandi?</a>
                </div>
                <button type="submit" class="btn btn-login" id="btn-login">
                    Masuk
                    <i class="material-icons" id="icon-login">arrow_forward</i>
                </button>
            </form>
        </div>
    </div>
@endsection

@push('addon-javascript')
    <script>
        const btnLogin = document.querySelector("#btn-login");
        const iconLLogin = document.querySelector("#icon-login");
        const inputPassword = document.querySelector("#password");
        const iconPassword = document.querySelector("#material-password");

        btnLogin.addEventListener("mouseover", () => {
            iconLLogin.style.display = "block";
        });
        btnLogin.addEventListener("mouseout", () => {
            iconLLogin.style.display = "none";
        });

        iconPassword.addEventListener("click", () => {
            if (inputPassword.type == "password") {
                inputPassword.type = "text";
                iconPassword.innerHTML = "visibility_off";
            } else {
                inputPassword.type = "password";
                iconPassword.innerHTML = "visibility";
            }
        });
    </script>
@endpush
