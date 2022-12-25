@extends('layouts.landing')

@section('title', 'SIPENLA')

@section('content')
    <section class="header-landing" id="home">
        <div class="bg-landing-page"></div>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/internal-images/logo.png') }}" class="img-fluid" alt="" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"><i class="material-icons">view_headline</i></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-center">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#home">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#news">BERITA SEKOLAH</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#service">LAYANAN</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about-me">TENTANG KAMI</a>
                        </li>
                        <li class="nav-item">
                            <a class=" btn-landing-login" href="/login">Masuk</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div class="content-landing">
                <div class="page-text">
                    <h3>Selamat Datang di</h3>
                    <h1>SIPENLA</h1>
                    <div class="description">
                        <p>
                            Smart School (SIPENLA) merupakan sistem informasi pendidikan
                            layanan berbasis aplikasi android dan wesbite yang memberikan
                            kemudahan akses dimana saja dan kapan saja, bagi seluruh
                            pengguna terkait berbagai informasi dan layanan seputar sekolah.
                        </p>
                    </div>
                    <a href="{{ url('/login') }}" class="btn btn-mulai">YUK MULAI!</a>
                </div>
                <div class="page-image">
                    <div class="frame-image">
                        <img src="{{ asset('images/internal-images/img-landing-page.png') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="news" id="news">
        <div class="title-news">
            <div class="container">
                <div class="row text-center">
                    <div class="col align-self-center">
                        <div class="text-news">Berita</div>
                        <div class="sub-text-news">Berita Terkini Sekolah</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="box-hot-news">
            <div class="container">
                <h6>Berita Terbaru</h6>
                <div class="hot-news mt-4 mb-4">
                    @foreach ($hots as $hot)
                        <?php
                        $description = substr($hot->news_content, 0, 350);
                        ?>
                        <div class="blog-news">
                            <div class="row">
                                <div class="col-md-5 col-12">
                                    <div class="image-news ms-auto">
                                        @if (!$hot->news_image)
                                            <img src="{{ asset('images/internal-images/no-img.png') }}" alt="" />
                                        @else
                                            <img src="{{ $hot->news_image }}" alt="" />
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-7 col-12 mt-3">
                                    <div class="title-hot-news">
                                        {{ $hot->news_title }}
                                    </div>
                                    <div class="date-hot-news">
                                        {{ $hot->created_at->format('j F, Y') }}
                                    </div>
                                    <div class="text-hot-news">
                                        <p>
                                            {!! $description !!}
                                            <a href="{{ url('detail-news/' . $hot->news_id) }}"> BACA SELENGKAPNYA</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="box-new-news">
            <div class="container">
                <h6>Berita Lainnya</h6>
                <div class="news-new">
                    <!-- start looping card new news -->
                    @foreach ($news as $new)
                        <div class="card card-news">
                            <div class="card-image">
                                @if (!$new->news_image)
                                    <img src="{{ asset('images/internal-images/berita-terbaru.jpg') }}" alt="" />
                                @else
                                    <img src="{{ $new->news_image }}" alt="" />
                                @endif
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $new->news_title }}
                                </h5>
                                <div class="date-new-news">{{ $new->created_at->format('j F, Y') }}</div>
                                <div class="d-flex justify-content-end mt-2">
                                    <a href="{{ url('detail-news/' . $new->news_id) }}" class="link-new-news">Baca
                                        Selengkapnya...</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- end looping new news -->
                </div>
            </div>
        </div>
    </section>

    <section class="service" id="service">
        <div class="container">
            <div class="row text-center">
                <div class="col align-self-center">
                    <div class="text-service">Layanan</div>
                    <div class="sub-text-service">Layanan Fitur Yang Kami Hadirkan</div>
                </div>
            </div>
            <div class="box-service">
                <div class="center mt-3">
                    <!-- awal card -->
                    <div class="card-service-center">
                        <div class="card-service">
                            <div class="header-card-service">
                                <div class="image-service">
                                    <img src="{{ asset('images/internal-images/service.png') }}" alt="" />
                                </div>
                                <div class="text-card-service">
                                    Sistem Akademik & Non Akademik
                                </div>
                            </div>
                            <p class="description-service">
                                DataBase Pendidikan, Presensi, Jadwal Pembelajaran, Penilaian
                                Akademik, Raport, Monitoring Kegiatan Ekstrakurikuler, dan
                                Peminjaman Fasilitas Sekolah
                            </p>
                            <div class="footer-card-service">SIPENLA</div>
                        </div>
                    </div>
                    <!-- akhir card -->
                    <div class="card-service-center">
                        <div class="card-service">
                            <div class="header-card-service">
                                <div class="image-service">
                                    <img src="{{ asset('images/internal-images/service.png') }}" alt="" />
                                </div>
                                <div class="text-card-service">PPDB</div>
                            </div>
                            <p class="description-service">
                                Platform Pengelola Sistem Penerimaan Peserta Didik baru
                            </p>
                            <div class="footer-card-service">SIPENLA</div>
                        </div>
                    </div>

                    <div class="card-service-center">
                        <div class="card-service">
                            <div class="header-card-service">
                                <div class="image-service">
                                    <img src="{{ asset('images/internal-images/service.png') }}" alt="" />
                                </div>
                                <div class="text-card-service">Keuangan & Administrasi</div>
                            </div>
                            <p class="description-service">
                                Pengelolaan SPP, Pembayaran, Tabungan, Gaji, Denda, dan Mutasi
                                Siswa
                            </p>
                            <div class="footer-card-service">SIPENLA</div>
                        </div>
                    </div>

                    <div class="card-service-center">
                        <div class="card-service">
                            <div class="header-card-service">
                                <div class="image-service">
                                    <img src="{{ asset('images/internal-images/service.png') }}" alt="" />
                                </div>
                                <div class="text-card-service">
                                    Sistem Akademik & Non Akademik
                                </div>
                            </div>
                            <p class="description-service">
                                DataBase Pendidikan, Presensi, Jadwal Pembelajaran, Penilaian
                                Akademik, Raport, Monitoring Kegiatan Ekstrakurikuler, dan
                                Peminjaman Fasilitas Sekolah
                            </p>
                            <div class="footer-card-service">SIPENLA</div>
                        </div>
                    </div>
                    <div class="card-service-center">
                        <div class="card-service">
                            <div class="header-card-service">
                                <div class="image-service">
                                    <img src="{{ asset('images/internal-images/service.png') }}" alt="" />
                                </div>
                                <div class="text-card-service">
                                    Sistem Akademik & Non Akademik
                                </div>
                            </div>
                            <p class="description-service">
                                DataBase Pendidikan, Presensi, Jadwal Pembelajaran, Penilaian
                                Akademik, Raport, Monitoring Kegiatan Ekstrakurikuler, dan
                                Peminjaman Fasilitas Sekolah
                            </p>
                            <div class="footer-card-service">SIPENLA</div>
                        </div>
                    </div>
                    <div class="card-service-center">
                        <div class="card-service">
                            <div class="header-card-service">
                                <div class="image-service">
                                    <img src="{{ asset('images/internal-images/service.png') }}" alt="" />
                                </div>
                                <div class="text-card-service">
                                    Sistem Akademik & Non Akademik
                                </div>
                            </div>
                            <p class="description-service">
                                DataBase Pendidikan, Presensi, Jadwal Pembelajaran, Penilaian
                                Akademik, Raport, Monitoring Kegiatan Ekstrakurikuler, dan
                                Peminjaman Fasilitas Sekolah
                            </p>
                            <div class="footer-card-service">SIPENLA</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer id="about-me">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5 col-12">
                    <div class="d-flex align-items-center">
                        <div class="logo-footer">
                            <img src="{{ asset('images/internal-images/logo.png') }}" alt="" />
                        </div>
                        <div class="desk-logo-footer">SIPENLA</div>
                    </div>
                    <div class="desk-footer">
                        <p>
                           Sistem Smart School (SIPENLA) ini merupakan sistem pendidikan yang berbasis aplikasi android dan website yang menghubungkan antar pengguna seperti administrator, kepala sekolah, guru/wali kelas, pembina ekstrakurikuler, pegawai TU, siswa, wali murid, pengawas sekolah, pegawai perpustakaan, pegawai koperasi sekolah, pegawai kantin, dan dinas pendidikan.
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="call-footer">
                        <h6>Hubungi Kami</h6>
                        <div class="about-contact">
                            <div class="contact-me">
                                <div class="img-contact">
                                    <img src="{{ asset('images/internal-images/telp.png') }}" alt="" />
                                </div>
                                <a href="" class="text-contact">+62 812345678969</a>
                            </div>
                            <div class="contact-me">
                                <div class="img-contact">
                                    <img src="{{ asset('images/internal-images/linked.png') }}" alt="" />
                                </div>
                                <a href="" class="text-contact">Sipenla.webschool</a>
                            </div>
                            <div class="contact-me">
                                <div class="img-contact">
                                    <img src="{{ asset('images/internal-images/mail.png') }}" alt="" />
                                </div>
                                <a href="" class="text-contact">sipenla@school.co.id</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-12">
                    <div class="sosmed">
                        <h6>Sosial Media</h6>
                        <div class="icon-sosmed">
                            <a href="" class="icon"><img src="{{ asset('images/internal-images/fb.png') }}"
                                    alt="" /></a>
                            <a href="" class="icon"><img src="{{ asset('images/internal-images/ig.png') }}"
                                    alt="" /></a>
                            <a href="" class="icon"><img src="{{ asset('images/internal-images/twit.png') }}"
                                    alt="" /></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-footer">
                <div class="row text-center">
                    <div class="col-12 text-bottom-footer">
                        &copy
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        SIPENLA. All Rights Reserved
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="top">
        <a href="#home"><i class="material-icons">expand_less</i></a>
    </div>
@endsection

@push('addon-javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $(".news-new").slick({
                dots: true,
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 2,
                autoplay: true,
                arrows: false,
                speed: 300,
                centerPadding: "100px",
                autoplaySpedd: 0.1,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: true,
                        },
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                        },
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                        },
                    },
                ],
            });
        });
        $(".hot-news").slick({
            autoplay: true,
            arrows: false,
            dots: true,
        });

        $(".center").slick({
            centerMode: true,
            centerPadding: "100px",
            slidesToShow: 3,
            autoplay: true,
            autoplaySpeed: 3000,
            responsive: [{
                    breakpoint: 768,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: "40px",
                        slidesToShow: 3,
                    },
                },
                {
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        centerMode: true,
                        centerPadding: "40px",
                        slidesToShow: 1,
                    },
                },
            ],
        });
    </script>
    <script>
        const toTop = document.querySelector(".top");

        window.addEventListener("scroll", () => {
            if (window.pageYOffset > 100) {
                toTop.classList.add("active");
            } else {
                toTop.classList.remove("active");
            }
        });
    </script>
@endpush
