@extends('layouts.dashboard-layouts')

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
                            <h5>Selamat Datang,Bambang Pamungkas</h5>
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
                    <div class="col-md-6 col-12">
                        <div class="schedule-welcome">
                            <h5>Mata Pelajaran Hari Ini</h5>
                            <!-- start looping schedule week -->
                            <div class="schedule-week">
                                <div class="subject">
                                    <div class="text-subject">Matematika</div>
                                    <div class="teacher">Hadi Wijayakusuma.,S.Pd</div>
                                </div>
                                <div class="time-schedule">07:00 - 09:30</div>
                            </div>
                            <!-- finish schedule week -->
                            <div class="schedule-week">
                                <div class="subject">
                                    <div class="text-subject">Istirahat</div>
                                </div>
                                <div class="time-schedule">07:00 - 09:30</div>
                            </div>
                            <div class="schedule-week">
                                <div class="subject">
                                    <div class="text-subject">Ilmu Pengetahuan Alam</div>
                                    <div class="teacher">Heri Waluyo.,S.Pd</div>
                                </div>
                                <div class="time-schedule">07:00 - 02:30</div>
                            </div>
                            <div class="schedule-week">
                                <div class="subject">
                                    <div class="text-subject">Istirahat</div>
                                </div>
                                <div class="time-schedule">07:00 - 09:30</div>
                            </div>
                            <div class="schedule-week">
                                <div class="subject">
                                    <div class="text-subject">Bahasa Inggris</div>
                                    <div class="teacher">Endang.,S.Pd</div>
                                </div>
                                <div class="time-schedule">14:00 - 15:30</div>
                            </div>
                        </div>
                    </div>
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
            <div class="row justify-content-between mb-3" data-aos="fade-up" data-aos-delay="100">
                <div class="col-md-3 col-6 mb-3">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/absen.png') }}" alt="" />
                                </div>
                                <div class="card-text">Absensi</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/monitoring.png') }}" alt="" />
                                </div>
                                <div class="card-text">Monitoring</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/registrasi.png') }}" alt="" />
                                </div>
                                <div class="card-text">Registrasi</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/perpustakaan.png') }}" alt="" />
                                </div>
                                <div class="card-text">Perpustakaan</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row justify-content-between mb-3" data-aos="fade-up" data-aos-delay="200">
                <div class="col-md-3 col-6 mb-3">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/jadwal.png') }}" alt="" />
                                </div>
                                <div class="card-text">Jadwal</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/koperasi.png') }}" alt="" />
                                </div>
                                <div class="card-text">Koperasi</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/siswa.png') }}" alt="" />
                                </div>
                                <div class="card-text">Data Siswa</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/mutasi.png') }}" alt="" />
                                </div>
                                <div class="card-text">Mutasi</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row justify-content-between mb-3" data-aos="fade-up" data-aos-delay="300">
                <div class="col-md-3 col-6 mb-3">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/penilaian.png') }}" alt="" />
                                </div>
                                <div class="card-text">Penilaian</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/fasilitas.png') }}" alt="" />
                                </div>
                                <div class="card-text">Fasilitas</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/data-pegawai.png') }}" alt="" />
                                </div>
                                <div class="card-text">Data Pegawai</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/siswa-baru.png') }}" alt="" />
                                </div>
                                <div class="card-text">Penerimaan Siswa Baru</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row mb-3" data-aos="fade-up" data-aos-delay="400">
                <div class="col-md-3 col-6 mb-3">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/rapot.png') }}" alt="" />
                                </div>
                                <div class="card-text">Rapor</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/kantin.png') }}" alt="" />
                                </div>
                                <div class="card-text">Kantin</div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-6">
                    <a href="">
                        <div class="card-category">
                            <div class="card-body-category">
                                <div class="card-image">
                                    <img src="{{ asset('images/internal-images/keuangan.png') }}" alt="" />
                                </div>
                                <div class="card-text">Laporan Keuangan</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section class="announcement" data-aos="fade-up">
        <div class="container">
            <div class="box-announcement">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between align-items-center mb-3">
                        <h6 class="text-announcement ">Berita dan Pengumuman</h6>
                        <div class="box-add-news">
                            <a href=""><i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </div>
                <!-- start looping announcement -->
                <div class="announcement-item">
                    <div class="btn-item-annnouncement">
                        <div class="icon-announcement">
                            <a href=""><i class="fa fa-trash-o text-danger"></i></a>
                        </div>
                        <div class="icon-announcement">
                            <a href=""><i class="fa fa-edit text-primary"></i></a>
                        </div>
                    </div>
                    <div class="title-announcement">
                        SMP Lorem Ipsum Class Meeting 2021/2022
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="image-announcement">
                                <img src="{{ asset('images/internal-images/pengumuman.jpg') }}" alt="" />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <a href="">
                                <div class="text-item-announcement">
                                    <div class="title-item-announcement">
                                        SMP Lorem Ipsum Class Meeting 2021/2022 Hadir untuk
                                        menghibur kalian yang suntuk abis UAS dengan beragam lomba
                                        Olahraga dan Kesenian yang pastinya bakal bikin fresh
                                        lagi, illo. ....
                                    </div>
                                    <div class="date-item-announcement">
                                        Acara dimulai tanggal 9 Maret 2022
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end looping announcement -->
                <!-- example announcement -->
                <div class="announcement-item">
                    <div class="btn-item-annnouncement">
                        <div class="icon-announcement">
                            <a href=""><i class="fa fa-trash-o text-danger"></i></a>
                        </div>
                        <div class="icon-announcement">
                            <a href=""><i class="fa fa-edit text-primary"></i></a>
                        </div>
                    </div>
                    <div class="title-announcement">
                        Peringatan hari jadi kota Surabaya dan Hari proklamasi Kemerdekaan
                        Republik Indonesia
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="image-announcement">
                                <img src="{{ asset('images/internal-images/pengumuman.jpg') }}" alt="" />
                            </div>
                        </div>
                        <div class="col-md-9">
                            <a href="">
                                <div class="text-item-announcement">
                                    <div class="title-item-announcement">
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                        Quia obcaecati pariatur temporibus a repellat ab aperiam
                                        cum minus laudantium, earum culpa adipisci possimus
                                        voluptatem, neque itaque eligendi, dignissimos voluptates
                                        nam illo recusandae placeat magni incidunt harum
                                        consequatur. Deleniti, maxime eligendi? ....
                                    </div>
                                    <div class="date-item-announcement">
                                        Acara dimulai tanggal 9 Maret 2022
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- end example announcement -->
            </div>
        </div>
    </section>

    <div class="message">
        <button><img src="{{ asset('images/internal-images/cs.png') }}" alt="" /></button>
    </div>
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
