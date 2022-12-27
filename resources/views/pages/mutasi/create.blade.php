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
                        <a href="#" class="d-flex align-items-center"><img src="{{ asset('images/internal-images/absen.png') }}" alt="" style="width:15px" class="me-1"/>
                            Mutasi</a>
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
                    Pengajuan Mutasi
                </div>
                <hr class="border-form" />
            </div>
            <form action="{{ route('createMutation') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="box-form-input">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Nama Depan</label>
                                <input disabled type="text" name="first_name" class="form-control" id="namaLengkap"
                                    placeholder="Nama Lengkap" value="{{$student->first_name}}"/>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Nama Belakang</label>
                                <input disabled type="text" name="last_name" class="form-control" id="namaLengkap"
                                    placeholder="Nama Lengkap" value="{{$student->last_name}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">NISN</label>
                        <input disabled type="number" name="nisn" class="form-control" id="nisn"
                            placeholder="No Induk Siswa Nasional" value="{{$student->nisn}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tempat, Tanggal Lahir</label>
                        <div class="row">
                            <div class="col-6">
                                <input disabled type="text" name="place_of_birth" class="form-control" id="tempatLahir"
                                    placeholder="Tempat Lahir" value="{{$student->place_of_birth}}"/>
                            </div>
                            <div class="col-6">
                                <input disabled type="text" name="date_of_birth" class="form-control bg-calendar"
                                    id="tglLahir" placeholder="dd-mm-yy" value="{{$student->date_of_birth}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jenis Kelamin</label>
                        <input disabled type="text" name="gender" class="form-control" id="gender"
                            placeholder="Jenis Kelamin" value="{{$student->gender}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Agama</label>
                        <input disabled type="text" name="religion" class="form-control" id="religion"
                            placeholder="Agama" value="{{$student->religion}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Alamat</label>
                        <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"
                            placeholder="Alamat Lengkap">{{$student->address}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Asal Sekolah</label>
                        <input disabled type="text" name="school_origin" class="form-control" id="asalSekolah"
                            placeholder="Asal Sekolah" value="{{$student->school_origin}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Pindah ke</label>
                        <input type="text" name="to_school" class="form-control  @error('to_school') is-invalid @enderror" id="to_school"
                            placeholder="Pindah ke" />
                            @error('to_school')
                            <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                              @enderror
                            
                    </div>
                    <label for="" class="form-label">Nama Orang Tua/Wali Murid</label>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Ayah</label>
                        <input disabled type="text" name="father_name" class="form-control" id="father_name"
                            placeholder="Nama Ayah" value="{{$student->father_name}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Ibu</label>
                        <input disabled type="text" name="mother_name" class="form-control" id="mother_name"
                            placeholder="Nama Ibu" value="{{$student->mother_name}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Alamat Orang Tua</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                            placeholder="Alamat Lengkap Orang Tua" name="parent_address">{{$student->parent_address}}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="letter_school_transfer" class="form-label">Surat Permohonan Pindah Dari Orang Tua / Wali</label>
                        <input class="form-control @error('letter_school_transfer') is-invalid @enderror" type="file" id="letter_school_transfer" name="letter_school_transfer">
                        @error('letter_school_transfer')
                        <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                      </div>
                    <div class="mb-3">
                        <label for="letter_ijazah" class="form-label">Ijazah</label>
                        <input class="form-control @error('letter_ijazah') is-invalid @enderror" type="file" id="letter_ijazah" name="letter_ijazah">
                        @error('letter_ijazah')
                        <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                    </div>
                    <div class="mb-3">
                        <label for="rapor" class="form-label">Rapot</label>
                        <input class="form-control @error('rapor') is-invalid @enderror" type="file" id="rapor" name="rapor">
                        @error('rapor')
                        <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                    </div>
                    <div class="mb-3">
                        <label for="letter_no_sanksi" class="form-label">Surat Pernyataan Tidak Sedang Menjalani Sanksi</label>
                        <input class="form-control @error('letter_no_sanksi') is-invalid @enderror" type="file" id="letter_no_sanksi" name="letter_no_sanksi">
                        @error('letter_no_sanksi')
                        <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                    </div>
                    <div class="mb-3">
                        <label for="letter_recom_diknas" class="form-label">Surat Rekomendasi Dari Diknas</label>
                        <input class="form-control @error('letter_recom_diknas') is-invalid @enderror" type="file" id="letter_recom_diknas" name="letter_recom_diknas">
                        @error('letter_recom_diknas')
                        <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                    </div>
                    <div class="mb-3">
                        <label for="kartu_keluarga" class="form-label">KK</label>
                        <input class="form-control @error('kartu_keluarga') is-invalid @enderror" type="file" id="kartu_keluarga" name="kartu_keluarga">
                        @error('kartu_keluarga')
                        <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                    </div>
                    <div class="mb-3">
                        <label for="surat_keterangan_pindah_sekolah" class="form-label">Surat Keterangan Pindah Dari Sekolah Asal</label>
                        <input class="form-control @error('surat_keterangan_pindah_sekolah') is-invalid @enderror" type="file" id="surat_keterangan_pindah_sekolah" name="surat_keterangan_pindah_sekolah">
                        @error('surat_keterangan_pindah_sekolah')
                        <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                    </div>
                </div>
                <button class="submit-form-siswa" type="submit">Kirim</button>
            </form>
        </div>
    </div>
    </section>
</section>
@endsection
@push('addon-javascript')
    <script>
        function uploadPhotoSiswa() {
            document.querySelector("#fotoSiswa").click();
        }
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