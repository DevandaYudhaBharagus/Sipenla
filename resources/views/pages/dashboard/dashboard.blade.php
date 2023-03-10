@extends('layouts.new-layouts-dashboard')

@section('title', 'Dashboard')

@section('content')

    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center"><i class="material-icons">home</i>
                            Beranda</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="header-dashboard">
        <div class="container">
            <div class="box-welcome">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="text-welcome">
                            @if (Auth::user()->role == 'student')
                                <h5>Selamat Datang, {{ $student->first_name . ' ' . $student->last_name }}</h5>
                            @elseif (Auth::user()->role == 'walimurid')
                                <h5>Selamat Datang, {{ $guardian->father_name}}</h5>
                            @else
                                <h5>Selamat Datang, {{ $employee->first_name . ' ' . $employee->last_name }}</h5>
                            @endif
                            <div class="sub-text-welcome">
                                SIPENLA - Sistem Informasi Pendidikan Sekolah
                            </div>
                            <div class="date-time" id="date-time">
                                <div class="time-welcome" id="time-welcome"></div>
                                <div class="date-welcome" id="date-welcome"></div>
                            </div>
                            <div class="box-new-student">
                                <div class="text-new-student">Penerimaan Siswa Baru</div>
                                <div class="sub-text-student">Ditutup pada 12/12/2022</div>
                            </div>
                        </div>
                    </div>
                    @if (Auth::User()->role == 'student')
                        <div class="col-md-6 col-12">
                            <div class="schedule-welcome">
                                <h5>Mata Pelajaran Hari Ini</h5>
                                <!-- start looping schedule week -->
                                @foreach ($schedule as $new)
                                    <div class="schedule-week">
                                        <div class="subject">
                                            <div class="text-subject">{{ $new->subject_name }}</div>
                                            <div class="teacher">{{ $new->first_name . ' ' . $new->last_name }}</div>
                                        </div>
                                        <div class="time-schedule">
                                            {{ date('H:i', strtotime($new->start_time)) . ' - ' . date('H:i', strtotime($new->end_time)) }}
                                        </div>
                                    </div>
                                @endforeach
                                <!-- finish schedule week -->
                            </div>
                        </div>
                    @endif
                    @if (Auth::User()->role == 'guru')
                        <div class="col-md-6 col-12">
                            <div class="schedule-welcome">
                                <h5>Jadwal Mengajar Hari Ini</h5>
                                <!-- start looping schedule week -->
                                @foreach ($schedule as $new)
                                    <div class="schedule-week">
                                        <div class="subject">
                                            <div class="text-subject">{{ $new->grade_name }}</div>
                                            <div class="teacher">{{ $new->subject_name }}</div>
                                        </div>
                                        <div class="time-schedule">{{ $new->start_time . ' - ' . $new->end_time }}</div>
                                    </div>
                                @endforeach
                                <!-- finish schedule week -->
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="category">
        <div class="container">
            <div class="row" data-aos="fade-up">
                <div class="col-12">
                    <h6 class="text-category">Kategori</h6>
                </div>
            </div>
            @if (Auth::User()->role == 'admin')
                @include('pages.dashboard.kategori.admin')
            @elseif (Auth::User()->role == 'guru')
                @include('pages.dashboard.kategori.guru')
            @elseif (Auth::User()->role == 'kepsek')
                @include('pages.dashboard.kategori.kepalasekolah')
            @elseif (Auth::User()->role == 'tu')
                @include('pages.dashboard.kategori.tu')
            @elseif (Auth::User()->role == 'walimurid')
                @include('pages.dashboard.kategori.walimurid')
            @elseif (Auth::User()->role == 'perpus')
                @include('pages.dashboard.kategori.perpus')
            @elseif (Auth::User()->role == 'pengawassekolah')
                @include('pages.dashboard.kategori.pengawas')
            @elseif (Auth::User()->role == 'pegawaikoperasi')
                @include('pages.dashboard.kategori.koperasi')
            @elseif (Auth::User()->role == 'pegawaikantin')
                @include('pages.dashboard.kategori.kantin')
            @elseif (Auth::User()->role == 'pembinaextra')
                @include('pages.dashboard.kategori.ekstra')
            @elseif (Auth::User()->role == 'dinaspendidikan')
                @include('pages.dashboard.kategori.dinaspendidikan')
            @elseif (Auth::User()->role == 'student')
                @include('pages.dashboard.kategori.siswa')
            @endif
        </div>
    </section>
    <section class="announcement" data-aos="fade-up">
        <div class="container">
            <div class="box-announcement">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-announcement ">Berita dan Pengumuman</h6>
                        @if (Auth::User()->role == 'admin')
                            <div class="box-add-news">
                                <a href="{{ url('/news') }}"><i class="fa fa-plus"></i></a>
                            </div>
                        @endif
                    </div>
                </div>
                @foreach ($news as $newsku)
                    <!-- start looping announcement -->
                    <div class="announcement-item">
                        @if (Auth::User()->role == 'admin')
                            <div class="btn-item-annnouncement">
                                <div class="icon-announcement">
                                    <a href=""><i class="fa fa-trash-o text-danger"></i></a>
                                </div>
                                <div class="icon-announcement">
                                    <a href=""><i class="fa fa-edit text-primary"></i></a>
                                </div>
                            </div>
                        @endif
                        <div class="title-announcement">
                            {{ $newsku->news_title }}
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="image-announcement">
                                    @if (!$newsku->news_image)
                                        <img src="{{ asset('images/internal-images/no-img.png') }}" alt="" />
                                    @else
                                        <img src="{{ $newsku->news_image }}" alt="" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-9">
                                <a href="{{ url('detail-news/' . $newsku->news_id) }}">
                                    <div class="text-item-announcement">
                                        <div class="title-item-announcement">
                                            {{ $newsku->news_content }}
                                        </div>

                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-center">
                    <a href="{{ url('/news') }}" class="btn btn-login">Lihat Selengkapnya</a>
                </div>
                <!-- end looping announcement -->
            </div>
        </div>
    </section>
@endsection

@push('addon-javascript')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        function dateTime() {
            const dateWelcome = document.querySelector("#date-welcome");
            const clientTime = new Date();
            const timeNow = new Date(clientTime.getTime());
            let hours = timeNow.getHours().toString();
            let minute = timeNow.getMinutes().toString();
            let day = timeNow.getDay();
            let month = timeNow.getMonth();
            let date = timeNow.getDate();
            let year = timeNow.getFullYear().toString();

            if (hours.length == 1) {
                hours = "0" + hours;
            }
            if (minute.length == 1) {
                minute = "0" + minute;
            }
            if (date < 10) {
                date = "0" + date;
            }

            switch (day) {
                case 0:
                    day = "Minggu";
                    break;
                case 1:
                    day = "Senin";
                    break;
                case 2:
                    day = "Selasa";
                    break;
                case 3:
                    day = "Rabu";
                    break;
                case 4:
                    day = "Kamis";
                    break;
                case 5:
                    day = "Jum'at";
                    break;
                case 6:
                    day = "Sabtu";
                    break;
            }

            switch (month) {
                case 0:
                    month = "Januari";
                    break;
                case 1:
                    month = "Februari";
                    break;
                case 2:
                    month = "Maret";
                    break;
                case 3:
                    month = "April";
                    break;
                case 4:
                    month = "Mei";
                    break;
                case 5:
                    month = "Juni";
                    break;
                case 6:
                    month = "Juli";
                    break;
                case 7:
                    month = "Agustus";
                    break;
                case 8:
                    month = "September";
                    break;
                case 9:
                    month = "Oktober";
                    break;
                case 10:
                    month = "November";
                    break;
                case 11:
                    month = "Desember";
                    break;
            }
            let getTime = hours + " : " + minute;
            document.querySelector("#time-welcome").innerHTML = getTime;
            dateWelcome.innerHTML =
                day + "," + " " + date + " " + month + " " + year;

            setTimeout(dateTime, 10000);
        }
        dateTime();
    </script>
    <script>
        AOS.init();
    </script>
@endpush
