@extends('layouts.lanpage-login')

@section('title', 'SIPENLA | REGISTRASI')

@section('content')
    <div class="box-regis">
        <div class="content-regis">
            <a href="/dashboard" class="title-regis">
                <i class="material-icons">arrow_back</i> Registrasi
            </a>
            <form action="{{ route('formregister') }}" method="POST">
                @csrf
                <div class="mb-2 form-regis mt-3">
                    <label for="exampleInputEmail1" class="form-label">Email </label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp" placeholder="Email" />
                </div>
                <div class="mb-2 form-regis">
                    <label for="exampleInputEmail1" class="form-label">Role </label>
                    <select class="form-select" aria-label="Default select example" name="role">
                        <option selected>--------- Pilih Role ---------</option>
                        {{-- start looping --}}
                        <option value="student">Siswa</option>
                        <option value="guru">Guru</option>
                        <option value="kepsek">Kepala Sekolah</option>
                        <option value="perpus">Pegawai Perpustakaan</option>
                        <option value="pegawaikoperasi">Pegawai Koperasi</option>
                        <option value="pegawaikantin">Pegawai Kantin</option>
                        <option value="tu">Pegawai TU</option>
                        <option value="pegawaikantin">Pegawai Kantin</option>
                        <option value="pembinaextra">Pembina Ekstrakulikuler</option>
                        <option value="pengawassekolah">Pengawas Sekolah</option>
                        <option value="dinaspendidikan">Dinas Pendidikan</option>
                      
                        {{-- end looping --}}
                    </select>
                    <span class="form-material">
                        <i class="material-icons">expand_more</i>
                    </span>
                </div>
                <div class="mb-2 form-regis">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password" />
                </div>
                <div class="mb-2 form-regis">
                    <label for="exampleInputPassword1" class="form-label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" id="confirm-password"
                        placeholder="Konfirmasi Password" />
                    <span class="confirm-password"><i class="material-icons" id="password-gagal">highlight_off</i></span>
                    <span class="confirm-password"><i class="material-icons" id="password-sukses">check_circle</i></span>
                </div>
                <div class="btn-regis">
                    <button type="submit" class="btn btn-register" id="btn-registrasi">
                        Registrasi
                        <i class="material-icons" id="icon-register">arrow_forward</i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-javascript')
    <script>
        const btnRegister = document.querySelector("#btn-registrasi");
        const iconRegister = document.querySelector("#icon-register");
        const passGagal = document.querySelector("#password-gagal");
        const passSukses = document.querySelector("#password-sukses");
        const password = document.querySelector("#password");
        const confirmPassword = document.querySelector("#confirm-password");

        btnRegister.addEventListener("mouseover", () => {
            iconRegister.style.display = "block";
        });
        btnRegister.addEventListener("mouseout", () => {
            iconRegister.style.display = "none";
        });
        confirmPassword.addEventListener("keyup", () => {
            if (password.value !== confirmPassword.value) {
                passGagal.style.display = "block";
                passSukses.style.display = "none";
            } else if (password.value == confirmPassword.value) {
                passSukses.style.display = "block";
                passGagal.style.display = "none";
            }
        })
    </script>
@endpush
