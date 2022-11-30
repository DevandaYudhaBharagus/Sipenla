@extends('layouts.dashboard-layouts')

@section('title', 'SIPENLA | Registrasi')

@section('css')
    <link rel="stylesheet" href="/css/css-internal/bs-select.css" />
@endsection

@section('content')
    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center"><i class="material-icons">home</i> Beranda</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/internal-images/icon-registrasi.png') }}"
                                class="d-flex align-items-center me-1" width="16px" height="16px" alt=""> Daftar
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="new-news">
        <div class="container">
            <div class="box-news">
                <div class="title-news">Daftar</div>
                <div class="box-form">
                    <form action="" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class=" col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="title"
                                        aria-describedby="titleHelp" />
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Sandi</label>
                                    <input type="password" class="form-control" id="password"
                                        aria-describedby="titleHelp" />
                                    <span class="show-hide">
                                        <i class="material-icons" id="material-password">visibility</i></span>
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Konfirmasi</label>
                                    <input type="password" class="form-control" id="password"
                                        aria-describedby="titleHelp" />
                                    <span class="show-hide">
                                        <i class="material-icons" id="material-password">visibility</i></span>
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Role</label>
                                    <select class="form-select" aria-label="Default select example" id="select-role">
                                        <option selected>Pilih Role</option>
                                        <option value="guru">Guru</option>
                                        <option value="wali-murid">Wali Murid</option>
                                        <option value="kepala-sekolah">Kepala Sekolah</option>
                                        <option value="wali-kelas">Wali Kelas</option>
                                        <option value="pegawai-tu">Pegawai TU</option>
                                        <option value="pegawai-perpustakaan">Pegawai Perpsutakaan</option>
                                        <option value="pegawai-kantin">Pegawai Kantin</option>
                                        <option value="pegawai-koperasi">Pegawai Koperasi</option>
                                        <option value="pegawas-sekolah">Pengawas Sekolah</option>
                                        <option value="dinas-pendidikan">Dinas Pendidikan</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 search-student" id="search-student">
                            <div class="mb-3 d-flex flex-column">
                                <label for="title" class="form-label">Cari Siswa</label>
                                <select class="selectpicker" data-live-search="true">
                                    <option data-tokens="aziz taher">Aziz Taher</option>
                                    <option data-tokens="aziz">Aziz</option>
                                    <option data-tokens="pranja">Pranaja</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="d-md-flex d-block justify-content-md-center">
                                    <button type="submit" class="btn-news blue">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addon-javascript')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    {{-- <script>
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

        })
    </script> --}}
    <script>
        const btnPassword = document.querySelectorAll("#material-password");
        const password = document.querySelectorAll("#password");

        for (let i = 0; i < btnPassword.length; i++) {
            btnPassword[i].addEventListener("click", () => {
                if (password[i].type == "password") {
                    password[i].type = "text";
                    btnPassword[i].innerHTML = "visibility_off"
                } else {
                    password[i].type = "password";
                    btnPassword[i].innerHTML = "visibility"
                }
            })
        }
    </script>
    <script>
        const role = document.querySelector("#select-role");
        const searchStudent = document.querySelector("#search-student")
        role.addEventListener("click", () => {
            if (role.value == "wali-murid") {
                searchStudent.classList.toggle("show");
            }
        });
    </script>
@endpush
