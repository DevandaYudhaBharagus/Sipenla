@extends('layouts.dashboard-layouts')

@section('title', 'Profil')

@section('content')
    @if ($student !== null)
        <section class="profile">
            <div class="container">
                <div class="box-profile">
                    <div class="header-profile">
                        <a href="/dashboard" class="d-flex align-items-center">
                            <i class="material-icons">arrow_back</i>
                        </a>
                        Profil
                    </div>
                    <div class="row mt-md-4 mt-3">
                        <div class="col-md-5 col-12">
                            <div class="box-student-profile">
                                <div class="row align-items-center">
                                    <div class="col-5">
                                        <div class="profile-student">
                                            @if (!$student->image)
                                                <img src="{{ asset('images/internal-images/profile-user.png') }}"
                                                    alt="" />
                                            @else
                                                <img src="{{ $student->image }}" alt="" />
                                            @endif
                                            <a href="" class="btn btn-edit-profile">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="name-student">
                                            {{ $student->student_first_name . ' ' . $student->student_last_name }}</div>
                                        <div class="title-student">Siswa</div>
                                    </div>
                                </div>
                                <div class="row mt-4 align-items-center">
                                    <div class="col-md-5 col-12">
                                        <div class="box-weather">
                                            <div class="cloud">
                                                <img src="{{ asset('images/internal-images/cloud.png') }}" alt="" />
                                            </div>
                                            <div class="date-weather">
                                                <div id="date-weather"></div>
                                                <div id="time-weather"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-12">
                                        <a href="{{ url('admission/datasiswa') }}" class="btn link-profile">Data Siswa</a>
                                        <a href="" class="btn link-profile">Mutasi</a>
                                    </div>
                                </div>
                            </div>
                            <div class="box-student-card mt-md-4">
                                <div class="header-card">
                                    <div class="m-auto">
                                        <h6>Kartu Pelajar Digital</h6>
                                    </div>
                                    <a href="">
                                        <i class="material-icons">vertical_align_bottom</i></a>
                                </div>
                                <div class="card-student">
                                    <div class="d-flex align-items-center">
                                        <div class="img-card-student">
                                            <img src="{{ asset('images/internal-images/logo.png') }}" alt="" />
                                        </div>
                                        <div class="text-card-student">SIPENLA Kartu Digital</div>
                                    </div>
                                    <div class="d-flex align-items-center mt-4">
                                        <div class="profile-student-card">
                                            @if (!$student->image)
                                                <img src="{{ asset('images/internal-images/profile-card.png') }}"
                                                    alt="" />
                                            @else
                                                <img src="{{ $student->image }}" alt="" />
                                            @endif
                                        </div>
                                        <div class="content-student-card">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="name-card">Nama</div>
                                                <div class="barrier-card">:</div>
                                                <div class="explain-card">
                                                    {{ $student->student_first_name . ' ' . $student->student_last_name }}
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="name-card">Nisn</div>
                                                <div class="barrier-card">:</div>
                                                <div class="explain-card">{{ $student->nisn }}</div>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="name-card">Tempat/tgl Lahir</div>
                                                <div class="barrier-card">:</div>
                                                <div class="explain-card">
                                                    {{ $student->place_of_birth }}
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="name-card">Alamat</div>
                                                <div class="barrier-card">:</div>
                                                <div class="explain-card">{{ $student->address }}</div>
                                            </div>
                                            <div class="barcode-student">{!! DNS1D::getBarcodeHTML("$student->nisn", 'C128B') !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-12">
                            <div class="box-biografi">
                                <h5>Biodata</h5>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">NISN</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $student->nisn }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Nama</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">
                                            {{ $student->student_first_name . ' ' . $student->student_last_name }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Kelas</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $student->grade_name }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Tempat Lahir</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $student->place_of_birth }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Tanggal Lahir</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $student->date_of_birth }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Jenis Kelamin</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $student->gender }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Nama Ayah</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $student->father_name }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Nama Ibu</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $student->mother_name }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Email</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $student->email }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Wali Kelas</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">
                                            {{ $student->employee_first_name . ' ' . $student->employee_last_name }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Ekstrakulikuler</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $student->extracurricular_name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="profile">
            <div class="container">
                <div class="box-profile">
                    <div class="header-profile">
                        <a href="/dashboard" class="d-flex align-items-center">
                            <i class="material-icons">arrow_back</i>
                        </a>
                        Profil
                    </div>
                    <div class="row mt-md-4 mt-3">
                        <div class="col-md-5 col-12">
                            <div class="box-student-profile">
                                <div class="row align-items-center">
                                    <div class="col-5">
                                        <div class="profile-student">
                                            @if (!$murid)
                                                <img src="{{ asset('images/internal-images/profile-user.png') }}"
                                                    alt="" />
                                            @else
                                                <img src="{{ $murid->image }}" alt="" />
                                            @endif
                                            <a href="" class="btn btn-edit-profile">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-7">
                                        <div class="name-student">{{ $murid->first_name . ' ' . $murid->last_name }}</div>
                                        <div class="title-student">Siswa</div>
                                    </div>
                                </div>
                                <div class="row mt-4 align-items-center">
                                    <div class="col-md-5 col-12">
                                        <div class="box-weather">
                                            <div class="cloud">
                                                <img src="{{ asset('images/internal-images/cloud.png') }}"
                                                    alt="" />
                                            </div>
                                            <div class="date-weather">
                                                <div id="date-weather"></div>
                                                <div id="time-weather"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7 col-12">
                                        {{-- <a href="" class="btn link-profile">Data Penerimaan</a> --}}
                                        <a href="/mutasi" class="btn link-profile">Mutasi</a>
                                    </div>
                                </div>
                            </div>
                            <div class="box-student-card mt-md-4">
                                <div class="header-card">
                                    <div class="m-auto">
                                        <h6>Kartu Pelajar Digital</h6>
                                    </div>
                                    <a href="">
                                        <i class="material-icons">vertical_align_bottom</i></a>
                                </div>
                                <div class="card-student">
                                    <div class="d-flex align-items-center">
                                        <div class="img-card-student">
                                            <img src="{{ asset('images/internal-images/logo.png') }}" alt="" />
                                        </div>
                                        <div class="text-card-student">SIPENLA Kartu Digital</div>
                                    </div>
                                    <div class="d-flex align-items-center mt-4">
                                        <div class="profile-student-card">
                                            @if (!$murid->image)
                                                <img src="{{ asset('images/internal-images/profile-card.png') }}"
                                                    alt="" />
                                            @else
                                                <img src="{{ $murid->image }}" alt="" />
                                            @endif
                                        </div>
                                        <div class="content-student-card">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="name-card">Nama</div>
                                                <div class="barrier-card">:</div>
                                                <div class="explain-card">
                                                    {{ $murid->first_name . ' ' . $murid->last_name }}
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="name-card">Nisn</div>
                                                <div class="barrier-card">:</div>
                                                <div class="explain-card">{{ $murid->nisn }}</div>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="name-card">Tempat/tgl Lahir</div>
                                                <div class="barrier-card">:</div>
                                                <div class="explain-card">
                                                    {{ $murid->place_of_birth . '/' . $murid->date_of_birth }}
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="name-card">Alamat</div>
                                                <div class="barrier-card">:</div>
                                                <div class="explain-card">{{ $murid->address }}</div>
                                            </div>
                                            <div class="barcode-student">{!! DNS1D::getBarcodeHTML('$ ' . $murid->nisn, 'C39', 1, 33) !!}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-12">
                            <div class="box-biografi">
                                <h5>Biodata</h5>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">NISN</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $murid->nisn }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Nama</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $murid->first_name . ' ' . $murid->last_name }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Kelas</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">-</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Tempat Lahir</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $murid->place_of_birth }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Tanggal Lahir</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $murid->date_of_birth }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Jenis Kelamin</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $murid->gender }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Nama Ayah</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $murid->father_name }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Nama Ibu</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $murid->mother_name }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Email</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $murid->email }}</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Wali Kelas</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">-</div>
                                    </div>
                                </div>
                                <div class="box-text-biografi">
                                    <div class="row align-items-center">
                                        <div class="col-3">Ekstrakulikuler</div>
                                        <div class="col-1 text-center">:</div>
                                        <div class="col-8">{{ $murid->extracurricular_name }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

@push('addon-javascript')
    <script>
        function dateTime() {
            const dateWeather = document.querySelector("#date-weather");
            const timeWeather = document.querySelector("#time-weather");
            const clientTime = new Date();
            const timeNow = new Date(clientTime.getTime());
            let hours = timeNow.getHours().toString();
            let minute = timeNow.getMinutes().toString();
            let second = timeNow.getSeconds().toString();
            let date = timeNow.getDate();
            let month = timeNow.getMonth() + 1;
            let year = timeNow.getFullYear();

            if (hours.length == 1) {
                hours = "0" + hours;
            }
            if (minute.length == 1) {
                minute = "0" + minute;
            }
            if (second.length == 1) {
                second = "0" + second;
            }
            if (date < 10) {
                date = "0" + date;
            }
            if (month < 10) {
                month = "0" + month;
            }
            dateWeather.innerHTML = date + "/" + month + "/" + year;
            timeWeather.innerHTML = hours + ":" + minute + ":" + second;

            setTimeout(dateTime, 1000);
        }

        dateTime();
    </script>
@endpush
