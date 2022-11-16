@extends('layouts.dashboard-layouts')

@section('title', 'Profil')

@section('content')
    <section class="profile">
        <div class="container">
            <div class="box-profile">
                <div class="header-profile">
                    <a href="" class="d-flex align-items-center">
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
                                        <img src="{{ asset('images/internal-images/profile-user.png') }}" alt="" />
                                        <a href="" class="btn btn-edit-profile">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-7">
                                    <div class="name-student">Bambang Pamungkas</div>
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
                                    <a href="" class="btn link-profile">Data Penerimaan</a>
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
                                        <img src="{{ asset('images/internal-images/profile-card.png') }}" alt="" />
                                    </div>
                                    <div class="content-student-card">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="name-card">Nama</div>
                                            <div class="barrier-card">:</div>
                                            <div class="explain-card">Bambang Pamungkas</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="name-card">Nisn</div>
                                            <div class="barrier-card">:</div>
                                            <div class="explain-card">0254789652</div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="name-card">Tempat/tgl Lahir</div>
                                            <div class="barrier-card">:</div>
                                            <div class="explain-card">
                                                Surabaya 10 November 2000
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="name-card">Alamat</div>
                                            <div class="barrier-card">:</div>
                                            <div class="explain-card">Jl Wonokromo Surabaya</div>
                                        </div>
                                        <div class="barcode-student">barcode</div>
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
                                    <div class="col-8">Lorem ipsum dolor sit amet.</div>
                                </div>
                            </div>
                            <div class="box-text-biografi">
                                <div class="row align-items-center">
                                    <div class="col-3">Nama</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-8">Bambang Pamungkas</div>
                                </div>
                            </div>
                            <div class="box-text-biografi">
                                <div class="row align-items-center">
                                    <div class="col-3">Kelas</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-8">Lorem ipsum dolor sit amet.</div>
                                </div>
                            </div>
                            <div class="box-text-biografi">
                                <div class="row align-items-center">
                                    <div class="col-3">NIK</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-8">Lorem ipsum dolor sit amet.</div>
                                </div>
                            </div>
                            <div class="box-text-biografi">
                                <div class="row align-items-center">
                                    <div class="col-3">Tempat Lahir</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-8">Lorem ipsum dolor sit amet.</div>
                                </div>
                            </div>
                            <div class="box-text-biografi">
                                <div class="row align-items-center">
                                    <div class="col-3">Tanggl Lahir</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-8">Lorem ipsum dolor sit amet.</div>
                                </div>
                            </div>
                            <div class="box-text-biografi">
                                <div class="row align-items-center">
                                    <div class="col-3">Jenis Kelamin</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-8">Lorem ipsum dolor sit amet.</div>
                                </div>
                            </div>
                            <div class="box-text-biografi">
                                <div class="row align-items-center">
                                    <div class="col-3">Nama Ayah</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-8">Lorem ipsum dolor sit amet.</div>
                                </div>
                            </div>
                            <div class="box-text-biografi">
                                <div class="row align-items-center">
                                    <div class="col-3">Nama Ibu</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-8">Lorem ipsum dolor sit amet.</div>
                                </div>
                            </div>
                            <div class="box-text-biografi">
                                <div class="row align-items-center">
                                    <div class="col-3">Email</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-8">Lorem ipsum dolor sit amet.</div>
                                </div>
                            </div>
                            <div class="box-text-biografi">
                                <div class="row align-items-center">
                                    <div class="col-3">Wali Kelas</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-8">Lorem ipsum dolor sit amet.</div>
                                </div>
                            </div>
                            <div class="box-text-biografi">
                                <div class="row align-items-center">
                                    <div class="col-3">Ekstrakulikuler</div>
                                    <div class="col-1 text-center">:</div>
                                    <div class="col-8">Lorem ipsum dolor sit amet.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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