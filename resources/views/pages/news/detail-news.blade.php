@extends('layouts.dashboard-layouts')

@section('title', 'Detail News')

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
                <div class="title-news">Berita Sekolah</div>
                <div class="row mt-4">
                    <div class="col-md-7 col-12">
                        <div class="box-detail-news">
                            <div class="title-detail text-center">
                                <h5>Siswa SMPN 4 Singaraja Juara KTSP</h5>
                                <div class="create-detail">
                                    Jumat 14 Oktober 2022 - Eleaner Pena
                                </div>
                            </div>
                            <div class="box-image-detail">
                                <img src="{{ asset('images/internal-images/berita-terbaru.jpg') }}" alt="" />
                            </div>
                            <div class="text-detail-news">
                                <p>
                                    Siswa kelas IX/A1 SMPN 4 Singaraja, I Putu Rajendra Pradana
                                    Putra, menyabet gelar juara KST (Kompetisi Sains Terpadu)
                                    VIII Mata Pelajaran IPA Tahun 2022 yang diselenggarakan MGMP
                                    (Musyawarah Guru Mata Pelajaran) IPA SMPN Karangasem di Aula
                                    Sabha Widya Praja Kantor Disdikpora Karangasem, Jalan
                                    Veteran, Amlapura, Sabtu (23/4). Final KST dengan 20
                                    peserta. Peringkat kedua direbut siswa SMPN 2 Amlapura I
                                    Gede Wahyu Dipta Pariandika dan peringkat ketiga siswa SMPN
                                    4 Singaraja, Joshua Setia Imanuel. Putu Rajendra mulai ikut
                                    KST sejak dua tahun lalu, baru kali ini meraih juara. Saat
                                    tampil di final, Putu Rajendra mengaku kesulitan mengerjakan
                                    soal-soal. Beda dengan saat babak penyisihan, masih mampu
                                    mengerjakan hingga 90 persen. “Materi soal di babak final
                                    lebih sulit, terutama Fisika,” jelas Putu Rajendra.
                                    Alasannya, Fisika banyak menghitung dan lebih banyak
                                    menganalisa. “Saya bersyukur menjadi yang terbaik,” ungkap
                                    putra sulung dari dua bersaudara pasangan I Gede Merdana dan
                                    Ni Made Puji Wahyuni ini. Peraih juara II, I Gede Wahyu
                                    mengungkapkan, materi soal di final lebih sulit, setiap soal
                                    mesti dianalisa. Duta Anak Daerah Karangasem 2022 ini pernah
                                    juara kabupaten KSN mata pelajaran IPS pada tahun 2021. Kali
                                    ini mencoba ikut lomba IPA dan meraih juara II. Sementara
                                    Ketua MGMP IPA SMPN Karangasem, I Gede Sarya mengakui materi
                                    soal di final jauh berbeda dengan babak penyisihan.
                                    “Semuanya mesti dianalisa,” kata guru mata pelajaran IPA di
                                    SMPN 4 Abang ini. Gede Sarya menjelaskan, peserta yang lolos
                                    ke final menjawab soal dalam bentuk uraian. Tingkat analisa
                                    jauh lebih tinggi. KST VIII dimulai Rabu (20/4). Babak
                                    penyisihan secara daring melibatkan 242 peserta SMP se-Bali.
                                    Selanjutnya meloloskan 20 siswa ke final. Babak final secara
                                    luring, memunculkan pemenang yang masuk 10 besar. Juara I
                                    berhak atas Piala Bergilir Bupati Karangasem, piala tetap,
                                    sertifikat, dan uang pembinaan Rp 700.000. Juara II
                                    mendapatkan piala tetap, sertifikat, dan uang pembinaan Rp
                                    500.000. Juara III mendapatkan piala tetap, sertifikat, dan
                                    uang pembinaan Rp 350.000.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-12">
                        <!-- start looping new news right -->
                        <div class="detail-new-news">
                            <a href="" class="content-new-news">
                                <div class="box-img-new-news">
                                    <img src="{{ asset('images/internal-images/news.jpg') }}" alt="" />
                                </div>
                                <div class="text-new-news">
                                    <div class="title-new-news">
                                        Siswa SMPN 4 Singaraja Juara 1 Olimpiade
                                    </div>
                                    <div class="text-content-news">
                                        <p>
                                            Siswa kelas IX/A1 SMPN 4 Singaraja, I Putu Rajendra
                                            Pradana Putra, menyabet gelar juara KST ...
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- end looping new news right -->

                        <div class="detail-new-news">
                            <a href="" class="content-new-news">
                                <div class="box-img-new-news">
                                    <img src="{{ asset('images/internal-images/news.jpg') }}" alt="" />
                                </div>
                                <div class="text-new-news">
                                    <div class="title-new-news">
                                        Siswa SMPN 4 Singaraja Juara 1 Olimpiade
                                    </div>
                                    <div class="text-content-news">
                                        <p>
                                            Siswa kelas IX/A1 SMPN 4 Singaraja, I Putu Rajendra
                                            Pradana Putra, menyabet gelar juara KST ...
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
