@extends('layouts.dashboard-layouts')

@section('title', 'SIPENLA | Formulir Peserta')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center" style="text-decoration: none"><i
                                class="material-icons">home</i> HOME</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="material-icons">assignment</i> Formulir
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="formulir">
        <div class="container">
            <div class="box-formulir">
                <div class="header-formulir">
                    <div class="title-formulir">Data Penerimaan</div>
                    <div class="down-formulir">
                        <a href="" style="text-decoration: none;">
                            <i class="material-icons">vertical_align_bottom</i></a>
                    </div>
                </div>
                <div class="image-formulir">
                    <div class="box-image-formulir">
                        <img src="{{ asset('images/internal-images/logo.png') }}" alt="" />
                    </div>
                    <div class="box-image-tut-wuri">
                        <img src="{{ asset('images/internal-images/tut-wuri.png') }}" alt="" />
                    </div>
                </div>
                <div class="text-formulir text-center">
                    <div class="header-text">Formulir</div>
                    <div class="sub-header-text">
                        DAFTAR ULANG PENERIMAAN SISWA BARU
                    </div>
                    <hr class="border-form" />
                    <div class="biodata-text-form">BIODATA PESERTA DIDIK</div>
                </div>
                <form action="{{ route('formstudent') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-form-input">
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <label for="" class="form-label">Nama Depan</label>
                                    <input type="text" name="first_name" class="form-control" id="namaLengkap"
                                        placeholder="Nama Lengkap" />
                                </div>
                                <div class="col-md-6 col-12">
                                    <label for="" class="form-label">Nama Belakang</label>
                                    <input type="text" name="last_name" class="form-control" id="namaLengkap"
                                        placeholder="Nama Lengkap" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">NISN</label>
                            <input type="number" name="nisn" class="form-control" id="nisn"
                                placeholder="No Induk Siswa Nasional" />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tempat, Tanggal Lahir</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="place_of_birth" class="form-control" id="tempatLahir"
                                        placeholder="Tempat Lahir" />
                                </div>
                                <div class="col-6">
                                    <input type="text" name="date_of_birth" class="form-control bg-calendar"
                                        id="tglLahir" placeholder="dd-mm-yy" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="gender" name="gender" aria-label="Default select example" data-dropdown-parent="body" data-placeholder="--- Pilih Jenis Kelamin ---">
                                <option></option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Jenis Kelamin</label>
                            <select class="form-select" id="religion" name="religion" aria-label="Default select example" data-dropdown-parent="body" data-placeholder="--- Pilih Agama ---">
                                <option></option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katolik">Katolik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Budha">Budha</option>
                                <option value="Konghucu">Konghucu</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Alamat</label>
                            <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"
                                placeholder="Alamat Lengkap"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Asal Sekolah</label>
                            <input type="text" name="school_origin" class="form-control" id="asalSekolah"
                                placeholder="Asal Sekolah" />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Diterima di Sekolah ini</label>
                            <div class="row">
                                <div class="col-6">
                                    <input type="text" name="school_now" class="form-control" id="kelas"
                                        placeholder="Kelas" />
                                </div>
                                <div class="col-6">
                                    <input type="text" name="date_school_now" class="form-control bg-calendar"
                                        id="tglMasuk" placeholder="dd-mm-yy" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Orang Tua</label>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3">
                                    <input type="text" name="father_name" class="form-control" id="ayah"
                                        placeholder="Nama Ayah" />
                                </div>
                                <div class="col-md-6 col-12">
                                    <input type="text" name="mother_name" class="form-control" id="ibu"
                                        placeholder="Nama Ibu" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Alamat Orang Tua</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                placeholder="Alamat Lengkap Orang Tua" name="parent_address"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Pekerjaan Orang Tua</label>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3">
                                    <input type="text" class="form-control" id="pekerjaanAyah"
                                        placeholder="Pekerjaan Ayah" name="father_profession" />
                                </div>
                                <div class="col-md-6 col-12">
                                    <input type="text" class="form-control" id="pekerjaanIbu"
                                        placeholder="Pekerjaan Ibu" name="mother_profession" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Pendidikan Terkahir Orang Tua</label>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-3">
                                    <input type="text" class="form-control" id="pendidikanAyah"
                                        placeholder="Pendidikan Ayah" name="father_education" />
                                </div>
                                <div class="col-md-6 col-12">
                                    <input type="text" class="form-control" id="penddikanIbu"
                                        placeholder="Pendidikan Ibu" name="mother_education" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Nama Wali</label>
                            <input type="text" name="family_name" class="form-control" id="wali"
                                placeholder="Nama Wali" />
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Alamat Wali</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                placeholder="Alamat Lengkap Orang Tua" name="family_address"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Pekerjaan Wali</label>
                            <input type="text" name="family_profession" class="form-control" id="nisn"
                                placeholder="No Induk Siswa Nasional" />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">No Telp</label>
                            <input type="number" name="phone" class="form-control" id="nisn"
                                placeholder="Nomor Telp" />
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Foto</label>
                            <input type="file" name="profile_student" class="form-control" id="fotoSiswa"
                                style="display: none" multiple />
                            <div class="col-md-6 col-12">
                                <button class="d-block btn-photo-siswa" type="button" onclick="uploadPhotoSiswa()">
                                    Upload Photo
                                </button>
                                <div id="text-preview"
                                    style="font-size: 12px;margin-top:10px; font-weight:400;color:#4b556b"></div>
                                <span class="ket-photo-siswa">*Foto harus background merah dan berseragam putih
                                    biru</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Ekstrakulikuler</label>
                            <select class="form-select" name="extracurricular_id" id="extracurricular_id" aria-label="Default select example" data-dropdown-parent="body" data-placeholder="--- Pilih Jenis Ekstrakulikuler ---">
                                <option></option>
                                @foreach ($ekstra as $e)
                                <option value="{{ $e->extracurricular_id }}">{{ $e->extracurricular_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button class="submit-form-siswa" type="submit">Kirim</button>
                </form>
            </div>
        </div>
    </section>
@endsection

@push('addon-javascript')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function uploadPhotoSiswa() {
            document.querySelector("#fotoSiswa").click();
        }

        $('#extracurricular_id').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $('#exampleModal'),
        });

        $('#gender').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $('#exampleModal'),
        });

        $('#religion').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $('#exampleModal'),
        });

        flatpickr("#tglLahir", {
            altInput: true,
            altFormat: "j F, Y",
            dateFormat: "d-m-Y",
        });
        flatpickr("#tglMasuk", {
            altInput: true,
            altFormat: "j F, Y",
            dateFormat: "d-m-Y",
        });

        const inputImage = document.querySelector("#fotoSiswa");
        const text = document.querySelector("#text-preview");
        inputImage.addEventListener("change", () => {
            let reader = new FileReader();
            reader.readAsDataURL(inputImage.files[0]);
            text.textContent = inputImage.files[0].name;
            console.log(inputImage.files[0].name);
            // reader.onload = () => {
            //     choseImage.setAttribute("src", reader.result);
            // }
        });
    </script>
@endpush
