@extends('layouts.dashboard-layouts')

@section('title', 'Absensi Pegawai')

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
                            <img src="{{ asset('images/internal-images/icon-absensi.png') }}"
                                class="d-flex align-items-center me-1" width="16px" height="16px" />
                            Absensi
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="profile">
        <div class="container">
            <div class="box-profile">
                <div class="header-profile">
                    <a href="" class="d-flex align-items-center">
                        <i class="material-icons">arrow_back</i>
                    </a>
                    Absensi
                </div>
                <div class="row mt-md-4 mt-3">
                    <div class="col-md-5 col-12">
                        <div class="box-student-profile">
                            <div class="row align-items-center">
                                <div class="col-5">
                                    <div class="profile-student">
                                        <img src="{{ asset('images/internal-images/kantin.png') }}" alt="" />
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="name-student">Bambang Pamungkas</div>
                                    <div class="title-student">Guru</div>
                                </div>
                            </div>
                            <div class="row mt-4 align-items-center">
                                <div class="col-md-5 col-12">
                                    <div class="box-weather">
                                        <div class="date-weather d-flex flex-column w-100">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <i class="fa fa-calendar me-2"></i>
                                                <div id="date-weather"></div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center mt-2">
                                                <i class="fa fa-clock-o me-2"></i>
                                                <div id="time-weather"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7 col-12">
                                    <button class="btn btn-choice-monitoring active w-100" id="btn-action-present">
                                        Absensi
                                    </button>
                                    <div class="row mt-2">
                                        <div class="col-md-6 col-12">
                                            <button class="btn-choice-monitoring w-100" id="btn-action-present">
                                                Tugas Dinas
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <button class="btn-choice-monitoring w-100 mb-md-0 mb-2"
                                                id="btn-action-present">
                                                Izin/Cuti
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-student-card mt-md-4">
                            {{-- belum absensi --}}
                            <div class="d-flex  flex-column">
                                <div class="icon-camera m-auto">
                                    <img src="{{ asset('images/internal-images/icon-camera-red.png') }}">
                                </div>
                                <div class="text-present d-flex justify-content-center">Anda belum melakukan absensi hari
                                    ini</div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="" class=" btn-present">Lakukan Absensi</a>
                            </div>
                            {{-- akhir belum absensi --}}

                            {{-- sudah absensi --}}
                            {{-- <div class="d-flex  flex-column">
                                <div class="icon-camera m-auto">
                                    <img src="{{ asset('images/internal-images/icon-camera-green.png') }}">
                                </div>
                                <div class="text-present d-flex justify-content-center">Anda sudah absen</div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="" class=" btn-present">Absen Keluar</a>
                            </div> --}}
                            {{-- Akhir sudah absensi --}}
                        </div>
                    </div>
                    <div class="col-md-7 col-12">
                        <div class="box-biografi present">
                            <div id="show-list-box-biografi" class="show">
                                <h5>Riwayat Absensi</h5>
                                <div class="mb-3">
                                    <label for="">Minggu 1</label>
                                    <div class="history-present" id="drop-present">
                                        <div class="d-flex justify-content-between align-items-center">
                                            Riwayat Absensi
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                    <div class="list-history-present" id="list-present">
                                        <div class="list-history">
                                            <div class="d-md-flex justify-content-md-between align-items-md-center">
                                                <div class="time-present">
                                                    <div class="date">01 September 2022</div>
                                                    <div class="time">08:00 WIIB</div>
                                                </div>
                                                <div class="status-present d-flex flex-column justify-content-center">
                                                    <h6 id="izin">Izin</h6>
                                                    <div class="status">Status -</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-history">
                                            <div class="d-md-flex justify-content-md-between align-items-md-center">
                                                <div class="time-present">
                                                    <div class="date">02 September 2022</div>
                                                    <div class="time">08:00 WIIB</div>
                                                </div>
                                                <div class="status-present d-flex flex-column justify-content-center">
                                                    <h6 id="absen">Tidak Hadir</h6>
                                                    <div class="status">Status -</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-history">
                                            <div class="d-md-flex justify-content-md-between align-items-md-center">
                                                <div class="time-present">
                                                    <div class="date">03 September 2022</div>
                                                    <div class="time">08:00 WIIB</div>
                                                </div>
                                                <div class="status-present d-flex flex-column justify-content-center">
                                                    <h6 id="sakit">Hadir</h6>
                                                    <div class="status">Status -</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="list-history">
                                            <div class="d-md-flex justify-content-md-between align-items-md-center">
                                                <div class="time-present">
                                                    <div class="date">03 September 2022</div>
                                                    <div class="time">08:00 WIIB</div>
                                                </div>
                                                <div class="status-present d-flex flex-column justify-content-center">
                                                    <h6 id="sakit">Hadir</h6>
                                                    <div class="status">Status -</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="">Minggu 2</label>
                                    <div class="history-present" id="drop-present">
                                        <div class="d-flex justify-content-between align-items-center">
                                            Riwayat Absensi
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                    <div class="list-history-present null" id="list-present">
                                        <!-- history apabila belum absen -->
                                        <div class="list-history null d-flex justify-content-center py-4">
                                            ---- Belum ada riwayat absensi ----
                                        </div>
                                        <!-- alhir history belum absen -->
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="">Minggu 3</label>
                                    <div class="history-present" id="drop-present">
                                        <div class="d-flex justify-content-between align-items-center">
                                            Riwayat Absensi
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                    <div class="list-history-present null" id="list-present">
                                        <!-- history apabila belum absen -->
                                        <div class="list-history null d-flex justify-content-center py-4">
                                            ---- Belum ada riwayat absensi ----
                                        </div>
                                        <!-- alhir history belum absen -->
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="">Minggu 4</label>
                                    <div class="history-present" id="drop-present">
                                        <div class="d-flex justify-content-between align-items-center">
                                            Riwayat Absensi
                                            <i class="fa fa-angle-down"></i>
                                        </div>
                                    </div>
                                    <div class="list-history-present null" id="list-present">
                                        <!-- history apabila belum absen -->
                                        <div class="list-history null d-flex justify-content-center py-4">
                                            ---- Belum ada riwayat absensi ----
                                        </div>
                                        <!-- alhir history belum absen -->
                                    </div>
                                </div>
                            </div>
                            <div id="show-list-box-biografi">
                                @include('pages.absensi.form-dinas')
                            </div>
                            <div id="show-list-box-biografi">
                                @include('pages.absensi.form-cuti')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addon-javascript')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function dateTime() {
            const dateWeather = document.querySelector("#date-weather");
            const timeWeather = document.querySelector("#time-weather");
            const clientTime = new Date();
            const timeNow = new Date(clientTime.getTime());
            let hours = timeNow.getHours().toString();
            let minute = timeNow.getMinutes().toString();
            let date = timeNow.getDate();
            let month = timeNow.getMonth() + 1;
            let year = timeNow.getFullYear();

            if (hours.length == 1) {
                hours = "0" + hours;
            }
            if (minute.length == 1) {
                minute = "0" + minute;
            }
            if (date < 10) {
                date = "0" + date;
            }
            if (month < 10) {
                month = "0" + month;
            }
            dateWeather.innerHTML = date + "/" + month + "/" + year;
            timeWeather.innerHTML = hours + ":" + minute;

            setTimeout(dateTime, 1000);
        }

        dateTime();

        const btnDrop = document.querySelectorAll("#drop-present");
        const listDrop = document.querySelectorAll("#list-present");

        for (let i = 0; i < btnDrop.length; i++) {
            btnDrop[i].addEventListener("click", () => {
                listDrop[i].classList.toggle("show");
            });
        }

        flatpickr("#date", {
            altInput: true,
            altFormat: "j F, Y",
            dateFormat: "d-m-Y",
        });
        flatpickr("#time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });

        const btnPresent = document.querySelectorAll("#btn-action-present");
        const listView = document.querySelectorAll("#show-list-box-biografi");
        for (let i = 0; i < btnPresent.length; i++) {
            btnPresent[i].addEventListener("click", () => {
                btnPresent.forEach((btn) => {
                    btn.classList.remove("active");
                });
                listView.forEach((list) => {
                    list.classList.remove("show");
                });
                btnPresent[i].classList.add("active");
                listView[i].classList.add("show");
            });
        }
    </script>
@endpush
