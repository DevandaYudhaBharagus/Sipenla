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
                @if($student->status=='proses')
                <div class="alert alert-success" role="alert">
                Data sedang diproses
            </div>
            @elseif($student->status=='konfirmasi')
            <div class="alert alert-success" role="alert">
                Data telah dikonfirmasi
            </div>
            @else
            <div class="alert alert-danger" role="alert">
                Data ditolak
            </div>
                @endif
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
            <div>
                <div class="box-form-input">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Nama Depan</label>
                                <input disabled type="text" name="first_name" class="form-control" id="namaLengkap"
                                    placeholder="Nama Lengkap" value="{{$student->student->first_name}}"/>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Nama Belakang</label>
                                <input disabled type="text" name="last_name" class="form-control" id="namaLengkap"
                                    placeholder="Nama Lengkap" value="{{$student->student->last_name}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">NISN</label>
                        <input disabled type="number" name="nisn" class="form-control" id="nisn"
                            placeholder="No Induk Siswa Nasional" value="{{$student->student->nisn}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Tempat, Tanggal Lahir</label>
                        <div class="row">
                            <div class="col-6">
                                <input disabled type="text" name="place_of_birth" class="form-control" id="tempatLahir"
                                    placeholder="Tempat Lahir" value="{{$student->student->place_of_birth}}"/>
                            </div>
                            <div class="col-6">
                                <input disabled type="text" name="date_of_birth" class="form-control bg-calendar"
                                    id="tglLahir" placeholder="dd-mm-yy" value="{{$student->student->date_of_birth}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Jenis Kelamin</label>
                        <input disabled type="text" name="gender" class="form-control" id="gender"
                            placeholder="Jenis Kelamin" value="{{$student->student->gender}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Agama</label>
                        <input disabled type="text" name="religion" class="form-control" id="religion"
                            placeholder="Agama" value="{{$student->student->religion}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Alamat</label>
                        <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3"
                            placeholder="Alamat Lengkap">{{$student->student->address}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Asal Sekolah</label>
                        <input disabled type="text" name="school_origin" class="form-control" id="asalSekolah"
                            placeholder="Asal Sekolah" value="{{$student->student->school_origin}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Pindah ke</label>
                        <input type="text" name="to_school" class="form-control" id="to_school"
                            placeholder="Pindah ke" value="{{$student->to_school}}"/>
                    </div>
                    <label for="" class="form-label">Nama Orang Tua/Wali Murid</label>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Ayah</label>
                        <input disabled type="text" name="father_name" class="form-control" id="father_name"
                            placeholder="Nama Ayah" value="{{$student->student->father_name}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Nama Ibu</label>
                        <input disabled type="text" name="mother_name" class="form-control" id="mother_name"
                            placeholder="Nama Ibu" value="{{$student->student->mother_name}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Alamat Orang Tua</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                            placeholder="Alamat Lengkap Orang Tua" name="parent_address">{{$student->student->parent_address}}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="letter_school_transfer" class="form-label">Surat Permohonan Pindah Dari Orang Tua / Wali</label>
                        <div class="">
                        <a target="_blank" noreferer noopener href="{{$student->letter_school_transfer}}" class="btn btn-outline-primary"><img src="{{asset('images/internal-images/pdf.png')}}" style="width: 20px;margin-right:10px" alt="">Buka PDF</a>
                    </div>
                      </div>
                    <div class="mb-3">
                        <label for="letter_ijazah" class="form-label">Ijazah</label>
                        <div class="">
                        <a target="_blank" noreferer noopener href="{{$student->letter_ijazah}}" class="btn btn-outline-primary"><img src="{{asset('images/internal-images/pdf.png')}}" style="width: 20px;margin-right:10px" alt="">Buka PDF</a>
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="rapor" class="form-label">Rapot</label>
                        <div class="">
                        <a target="_blank" noreferer noopener href="{{$student->rapor}}" class="btn btn-outline-primary"><img src="{{asset('images/internal-images/pdf.png')}}" style="width: 20px;margin-right:10px" alt="">Buka PDF</a>
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="letter_no_sanksi" class="form-label">Surat Pernyataan Tidak Sedang Menjalani Sanksi</label>
                        <div class="">
                        <a target="_blank" noreferer noopener href="{{$student->letter_no_sanksi}}" class="btn btn-outline-primary"><img src="{{asset('images/internal-images/pdf.png')}}" style="width: 20px;margin-right:10px" alt="">Buka PDF</a>
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="letter_recom_diknas" class="form-label">Surat Rekomendasi Dari Diknas</label>
                        <div class="">
                        <a target="_blank" noreferer noopener href="{{$student->letter_recom_diknas}}" class="btn btn-outline-primary"><img src="{{asset('images/internal-images/pdf.png')}}" style="width: 20px;margin-right:10px" alt="">Buka PDF</a>
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="kartu_keluarga" class="form-label">KK</label>
                        <div class="">
                        <a target="_blank" noreferer noopener href="{{$student->kartu_keluarga}}" class="btn btn-outline-primary"><img src="{{asset('images/internal-images/pdf.png')}}" style="width: 20px;margin-right:10px" alt="">Buka PDF</a>
                    </div>
                    </div>
                    <div class="mb-3">
                        <label for="surat_keterangan_pindah_sekolah" class="form-label">Surat Keterangan Pindah Dari Sekolah Asal</label>
                        <div class="">
                        <a target="_blank" noreferer noopener href="{{$student->surat_keterangan_pindah_sekolah}}" class="btn btn-outline-primary"><img src="{{asset('images/internal-images/pdf.png')}}" style="width: 20px;margin-right:10px" alt="">Buka PDF</a>
                    </div>
                    </div>
                </div>
            </div>
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