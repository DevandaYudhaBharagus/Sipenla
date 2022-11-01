@extends('layouts.dashboard-layouts')

@section('title', 'Dashboard')

@section('content')
    <section class="page-content">
        <div class="container">
            <div class="row text-center title-dashboard">
                <div class="col-md-6 col-12">
                    <div class="welcome-dashboard">
                        Selamat Datang, Bambang Pamungkas
                    </div>
                    <div class="sub-welcome">
                        SIPENLA - Sistem Informasi Pendidikan Sekolah
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="text-welcome">
                        “Sekolah Yang Berilmu Menghasilkan Generasi Cerdas Dan Berakhlak”
                    </div>
                </div>
            </div>

            <div class="row content-dashboard">
                <div class="col-md-5 col-12">
                    <div class="box-news">
                        <div class="d-flex align-items-center mb-3">
                            <div class="title-news">Berita Sekolah</div>
                            <a href="" class="edit-berita ms-auto"><i class="fa fa-edit"></i>
                            </a>
                        </div>
                        <!-- start looping news -->
                        <div class="content-news mb-3">
                            <div class="row">
                                <div class="col-md-5 col-12 bg-news">
                                    <img src="{{ asset('images/internal-images/news.jpg') }}" alt="">
                                </div>
                                <div class="col-md-7 col-12">
                                    <div class="title-content-news">
                                        Siswa SMPN 4 Singaraja Juara KST IPA
                                    </div>
                                    <div class="sub-title-content">
                                        <p>
                                            Siswa kelas IX/A1 SMPN 4 Singaraja, I Putu Rajendra
                                            Pradana Putra, menyabet gelar juara KST
                                            <a href="" style="text-decoration: none">...</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end looping neews -->
                        <!-- hapus dibawah -->
                        <div class="content-news mb-3">
                            <div class="row">
                                <div class="col-md-5 col-12 bg-news">
                                    <img src="{{ asset('images/internal-images/news.jpg') }}" alt="">
                                </div>
                                <div class="col-md-7 col-12">
                                    <div class="title-content-news">
                                        Siswa SMPN 4 Singaraja Juara KST IPA
                                    </div>
                                    <div class="sub-title-content">
                                        <p>
                                            Siswa kelas IX/A1 SMPN 4 Singaraja, I Putu Rajendra
                                            Pradana Putra, menyabet gelar juara KST
                                            <a href="" style="text-decoration: none">...</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-news mb-4">
                            <div class="row">
                                <div class="col-md-5 col-12 bg-news">
                                    <img src="{{ asset('images/internal-images/news.jpg') }}" alt="">
                                </div>
                                <div class="col-md-7 col-12">
                                    <div class="title-content-news">
                                        Siswa SMPN 4 Singaraja Juara KST IPA
                                    </div>
                                    <div class="sub-title-content">
                                        <p>
                                            Siswa kelas IX/A1 SMPN 4 Singaraja, I Putu Rajendra
                                            Pradana Putra, menyabet gelar juara KST
                                            <a href="" style="text-decoration: none">...</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- hapus sampai sini -->
                    </div>
                </div>
                <div class="col-md-2 col-12">
                    <!-- start looping announcement max 3-->
                    <div class="box-announcement mb-3">
                        <img src="{{ asset('images/internal-images/pengumuman.jpg') }}" alt="">
                        <!-- start pengondisian hanya role admin akan muncul button -->
                        <div class="box-button d-md-flex align-items-center">
                            <div class="announcement-delete">
                                <button><i class="fa fa-trash-o"></i></button>
                            </div>
                            <div class="announcement-edit">
                                <button><i class="fa fa-edit"></i></button>
                            </div>
                        </div>
                        <!-- akhir pengondisian hanya role admin akan muncul button -->
                    </div>
                    <!-- akhir looping announcement -->

                    <!-- announcement khusu admins ada kotak kosong apabila belum upload -->
                    <div class="box-announcement mb-3">
                        <!-- <img src="../images/pengumuman.jpg" alt="" /> -->
                        <!-- start pengondisian hanya role admin akan muncul button dan announcement tidak kosong -->
                        <!-- <div class="box-button d-flex align-items-center">
                                                            <div class="announcement-delete">
                                                              <button><i class="fa fa-trash-o"></i></button>
                                                            </div>
                                                            <div class="announcement-edit">
                                                              <button><i class="fa fa-edit"></i></button>
                                                            </div>
                                                          </div> -->
                        <!-- akhir pengondisian hanya role admin akan muncul button  dan announcement tidak kosong-->
                        <div class="announcement-upload">
                            <button data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa fa-edit"></i>
                            </button>
                        </div>
                    </div>
                    <!--  akhir announcement khusus admin ada kotak kosong apabila belum upload -->
                </div>
                <div class="col-md-5 col-12">
                    <div class="box-category">
                        <div class="row">
                            <div class="col-12 text-category">Kategori</div>
                        </div>
                        <div class="content-category">
                            <div class="row mb-4">
                                <div class="col-md-3 col-4 mb-3">
                                    <a href="" class="circle-category">
                                        <div class="icon-category">
                                            <img src="{{ asset('images/internal-images/absen.png') }}" alt="" />
                                        </div>
                                        <div class="icon-text">Absensi</div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-4 mb-3">
                                    <a href="" class="circle-category">
                                        <div class="icon-category">
                                            <img src="{{ asset('images/internal-images/jadwal.png') }}" alt="" />
                                        </div>
                                        <div class="icon-text">Jadwal</div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-4 mb-3">
                                    <a href="" class="circle-category">
                                        <div class="icon-category">
                                            <img src="{{ asset('images/internal-images/koperasi.png') }}" alt="" />
                                        </div>
                                        <div class="icon-text">Koperasi</div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-4 mb-3">
                                    <a href="" class="circle-category">
                                        <div class="icon-category">
                                            <img src="{{ asset('images/internal-images/kantin.png') }}" alt="" />
                                        </div>
                                        <div class="icon-text">Kantin</div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-4 mb-3">
                                    <a href="" class="circle-category">
                                        <div class="icon-category">
                                            <img src="{{ asset('images/internal-images/registrasi.png') }}"
                                                alt="" />
                                        </div>
                                        <div class="icon-text">Registrasi</div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-4 mb-3">
                                    <a href="" class="circle-category">
                                        <div class="icon-category">
                                            <img src="{{ asset('images/internal-images/siswa.png') }}" alt="" />
                                        </div>
                                        <div class="icon-text">Data Siswa</div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-4 mb-3">
                                    <a href="" class="circle-category">
                                        <div class="icon-category">
                                            <img src="{{ asset('images/internal-images/data-pegawai.png') }}"
                                                alt="" />
                                        </div>
                                        <div class="icon-text">Data Pegawai</div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-4 mb-3">
                                    <a href="" class="circle-category">
                                        <div class="icon-category">
                                            <img src="{{ asset('images/internal-images/keuangan.png') }}"
                                                alt="" />
                                        </div>
                                        <div class="icon-text">Laporan Keuangan</div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-4 mb-3">
                                    <a href="" class="circle-category">
                                        <div class="icon-category">
                                            <img src="{{ asset('images/internal-images/perpustakaan.png') }}"
                                                alt="" />
                                        </div>
                                        <div class="icon-text">Perpustakaan</div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-4 mb-3">
                                    <a href="" class="circle-category">
                                        <div class="icon-category">
                                            <img src="{{ asset('images/internal-images/mutasi.png') }}" alt="" />
                                        </div>
                                        <div class="icon-text">Mutasi</div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-4 mb-3">
                                    <a href="" class="circle-category">
                                        <div class="icon-category">
                                            <img src="{{ asset('images/internal-images/siswa-baru.png') }}"
                                                alt="" />
                                        </div>
                                        <div class="icon-text">Penerimaan Siswa Baru</div>
                                    </a>
                                </div>
                            </div>
                            <div class="new-student">
                                <div class="announcement-new-student">
                                    Penerimaan Siswa Baru
                                </div>
                                <div class="date-new-student">Ditutup pada 12/12/2022</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-upload">
                <div class="modal-header">
                    <button type="button" class="btn-close-upload" data-bs-dismiss="modal" aria-label="Close">
                        x
                    </button>
                </div>
                <div class="box-upload">
                    <form action="" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="frame-image-upload">
                                <!-- <img src="../images/pengumuman.jpg" alt="" /> -->
                            </div>
                            <div class="button-upload">
                                <input type="file" name="" id="file-announcement" style="display: none"
                                    multiple />
                                <button type="button" onclick="thisUploadFile()">
                                    Upload File
                                </button>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn-hapus">Hapus</button>
                            <button type="button" class="btn-simpan">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('addon-javascript')
    <script>
        function thisUploadFile() {
            document.querySelector("#file-announcement").click();
        }
    </script>
@endpush
