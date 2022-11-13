@extends('layouts.lupa-sandi-layout')

@section('title', 'SIPENLA | Kode OTP')

@section('content')
    <div class="container">
        <div class="box-forgot">
            <div class="title-forgot">
                <a href="" class="d-flex align-items-center">
                    <i class="material-icons">arrow_back</i></a>
                Verfikasi Email
            </div>
            <div class="row mt-3 align-items-center row-forgot">
                <div class="col-md-6">
                    <div class="box-input-forgot">
                        <div class="text-forgot">
                            Silahkan Masukkan 4 Digit Kode Yang Dikirim Ke email@gmail.com
                        </div>
                        <form action="">
                            <div class="form-otp">
                                <input type="text" name="" id="" maxlength="1" autofocus />
                                <input type="text" name="" id="" maxlength="1" />
                                <input type="text" name="" id="" maxlength="1" />
                                <input type="text" name="" id="" maxlength="1" />
                            </div>
                            <a href="" class="d-flex justify-content-center resend-code">Kirim Ulang Kode</a>
                            <button class="btn-forgot">Kirim</button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box-image-otp">
                        <img src="{{ asset('images/internal-images/otp.png') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-javascript')
    <script>
        const inputOtp = document.querySelectorAll(".form-otp input");

        inputOtp.forEach((input, index) => {
            input.dataset.index = index;
            input.addEventListener("keydown", clear);
            input.addEventListener("keyup", onKeyUp);
        });

        function clear($event) {
            $event.target.value = "";
        }

        function checkNumber(number) {
            return /[0-9]/g.test(number);
        }

        function onKeyUp($event) {
            const input = $event.target;
            const value = input.value;
            const fieldIndex = +input.dataset.index;

            if ($event.key === "Backspace" && fieldIndex > 0) {
                input.previousElementSibling.focus();
            }

            if (checkNumber(value)) {
                if (value.length > 0 && fieldIndex < inputOtp.length - 1) {
                    input.nextElementSibling.focus();
                }
            } else {
                clear($event);
            }
        }
    </script>
@endpush
