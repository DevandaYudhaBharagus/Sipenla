@extends('layouts.lupa-sandi-layout')

@section('title', 'SIPENLA | Kata Sandi Baru')

@section('content')
    <div class="container">
        <div class="box-forgot">
            <div class="title-forgot">
                <a href="" class="d-flex align-items-center">
                    <i class="material-icons">arrow_back</i>
                </a>
                Buat Sandi Baru
            </div>
            <div class="row mt-3 align-items-center row-forgot">
                <div class="col-md-6">
                    <div class="box-input-forgot">
                        <div class="text-forgot">
                            Sandi Baru Anda Harus Berbeda Dari Sandi Yang Digunakan
                            Sebelumnya.
                        </div>
                        <form action="">
                            <div class="form-forgot">
                                <input type="password" name="" id="password" placeholder="Sandi Baru" />
                                <div class="icon-pass">
                                    <i class="material-icons" id="icon-forgot">visibility</i>
                                </div>
                            </div>
                            <div class="form-forgot">
                                <input type="password" name="" id="password" placeholder="Konfirmasi Sandi" />
                                <div class="icon-pass">
                                    <i class="material-icons" id="icon-forgot">visibility</i>
                                </div>
                            </div>
                            <button class="btn-forgot">Kirim</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box-image">
                        <img src="{{ asset('images/internal-images/new-pass.png') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-javascript')
    <script>
        const iconForgot = document.querySelectorAll("#icon-forgot");
        const password = document.querySelectorAll("#password");

        for (let i = 0; i < iconForgot.length; i++) {
            iconForgot[i].addEventListener("click", () => {
                if (password[i].type === "password") {
                    password[i].type = "text";
                    iconForgot[i].innerHTML = "visibility_off";
                } else {
                    password[i].type = "password";
                    iconForgot[i].innerHTML = "visibility";
                }
            });
        }
    </script>
@endpush
