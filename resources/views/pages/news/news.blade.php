@extends('layouts.dashboard-layouts')

@section('title', 'News')

@section('content')
    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center"><i class="material-icons">home</i> Beranda</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Berita Sekolah
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="news">
        <div class="container">
            <div class="box-news">
                <div class="d-lg-flex d-block align-items-center justify-content-between">
                    <div class="title-news">Input Berita Sekolah</div>
                    <div class="form-news">
                        <form action="" class="d-flex align-items-center">
                            <input type="search" name="" id="" placeholder="Pencarian" />
                            <button type="submit" class="btn-search">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col-l2">
                        <a href="" class="create-news">Tambah Berita</a>
                    </div>
                </div>
                <!-- start looping list news  -->
                <div class="list-news">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="box-img-news">
                                <img src="{{ asset('images/internal-images/berita-terbaru.jpg') }}" alt="" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="title-news d-md-flex d-block justify-content-between">
                                <h6>Siswa SMPN 4 Singaraja Juara KST IPA</h6>
                                <!-- muncul hanya pada role admin edit news -->
                                <div class="icon-news d-md-flex d-none align-items-center">
                                    <a href="" class="icon text-danger"><i class="fa fa-trash-o"></i>
                                    </a>
                                    <a href="" class="icon text-primary"><i class="fa fa-edit"></i>
                                    </a>
                                </div>
                                <!-- akhir muncul pada role admin edit -->
                            </div>
                            <a href="">
                                <div class="text-news">
                                    <p>
                                        SURABAYA-Desa Wisata River Tubing, Watu Kandang Pandean,
                                        merupakan salah satu destinasi unggulan di Kabupaten
                                        Trenggalek. Destinasi wisata ini salah satu yang
                                        diperhitungkan dalam Anugerah Desa Wisata Indonesia (ADWI)
                                        2022.
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end looping list news -->

                <div class="list-news">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <div class="box-img-news">
                                <img src="{{ asset('images/internal-images/berita-terbaru.jpg') }}" alt="" />
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="title-news d-md-flex d-block justify-content-between">
                                <h6>Siswa SMPN 4 Singaraja Juara KST IPA</h6>
                                <!-- muncul hanya pada role admin edit news -->
                                <div class="icon-news d-md-flex d-none align-items-center">
                                    <a href="" class="icon text-danger"><i class="fa fa-trash-o"></i>
                                    </a>
                                    <a href="" class="icon text-primary"><i class="fa fa-edit"></i>
                                    </a>
                                </div>
                                <!-- akhir muncul pada role admin edit -->
                            </div>
                            <a href="">
                                <div class="text-news">
                                    <p>
                                        SURABAYA-Desa Wisata River Tubing, Watu Kandang Pandean,
                                        merupakan salah satu destinasi unggulan di Kabupaten
                                        Trenggalek. Destinasi wisata ini salah satu yang
                                        diperhitungkan dalam Anugerah Desa Wisata Indonesia (ADWI)
                                        2022.
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
