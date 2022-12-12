@extends('layouts.dashboard-layouts')

@section('title', 'Absensi Pegawai')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection
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
                                    <div class="name-student">{{ $employee->first_name . ' ' . $employee->last_name }}</div>
                                    <div class="title-student">{{ Auth::user()->role }}</div>
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
                                        <div class="col-md-6 col-12 mb-md-0 mb-3">
                                            <button class="btn-choice-monitoring w-100" id="btn-action-present">
                                                Tugas Dinas
                                            </button>
                                        </div>
                                        <div class="col-md-6 col-12 mb-md-0 mb-3">
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
                            @if (!$attendance)
                                <div class="d-flex  flex-column">
                                    <div class="icon-camera m-auto">
                                        <img src="{{ asset('images/internal-images/icon-camera-red.png') }}">
                                    </div>
                                    <div class="text-present d-flex justify-content-center">Anda belum melakukan absensi
                                        hari
                                        ini</div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ url('/absensi') }}" class=" btn-present">Lakukan Absensi</a>
                                </div>
                            @else
                                {{-- sudah absensi --}}
                                <div class="d-flex  flex-column">
                                    <div class="icon-camera m-auto">
                                        <img src="{{ asset('images/internal-images/icon-camera-green.png') }}">
                                    </div>
                                    <div class="text-present d-flex justify-content-center">Anda sudah absen</div>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ url('/absensi/page-checkout') }}" class=" btn-present">Absen Keluar</a>
                                </div>
                                {{-- Akhir sudah absensi --}}
                            @endif
                            {{-- akhir belum absensi --}}
                        </div>

                    </div>
                    <div class="col-md-7 col-12">
                        <div class="box-biografi present">
                            <div id="show-list-box-biografi" class="show">
                                <h5>Riwayat Absensi</h5>
                                <div class="mb-3">
                                    @foreach ($byweek as $w => $attendance)
                                        <label for="">Minggu {{ $w }}</label>
                                        <div class="history-present" id="drop-present">
                                            <div class="d-flex justify-content-between align-items-center">
                                                Riwayat Absensi
                                                <i class="fa fa-angle-down"></i>
                                            </div>
                                        </div>
                                        <div class="list-history-present" id="list-present">
                                            @foreach ($attendance as $att)
                                                <div class="list-history">
                                                    <div class="d-md-flex justify-content-md-between align-items-md-center">
                                                        <div class="time-present">
                                                            <div class="date">
                                                                {{ date('D, d M Y', strtotime($att->date)) }}</div>
                                                            <div class="time">Absensi Masuk :
                                                                {{ date('H:i:s', strtotime($att->check_in)) }}</div>
                                                            <div class="time">Absensi Keluar :
                                                                {{ date('H:i:s', strtotime($att->check_out)) }}</div>
                                                        </div>
                                                        @if ($att->status == 'ace')
                                                            <div
                                                                class="status-present d-flex flex-column justify-content-center">
                                                                <h6 id="sakit">Hadir</h6>
                                                                <div class="status">Status -</div>
                                                            </div>
                                                        @elseif ($att->status == 'aae')
                                                            <div
                                                                class="status-present d-flex flex-column justify-content-center">
                                                                <h6 id="absen">Tidak Hadir</h6>
                                                                <div class="status">Status -</div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        window.addEventListener("load", function() {
            $('#select-2-field').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
            });
        });
    </script>
    <script>
        function uploadDocument() {
            document.querySelector("#documentCuti").click();
        }

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

        flatpickr("#application_from_date", {
            allowInput: true,
            altInput: true,
            altFormat: "j F, Y",
            dateFormat: "Y-m-d",
        });

        flatpickr("#application_to_date", {
            allowInput: true,
            altInput: true,
            altFormat: "j F, Y",
            dateFormat: "Y-m-d",
        });

        flatpickr("#duty_from_date", {
            allowInput: true,
            altInput: true,
            altFormat: "j F, Y",
            dateFormat: "Y-m-d",
        });

        flatpickr("#duty_to_date", {
            allowInput: true,
            altInput: true,
            altFormat: "j F, Y",
            dateFormat: "Y-m-d",
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
