@extends('layouts.dashboard-layouts')

@section('title', 'Raport Siswa')

@section('content')
    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href class="d-flex align-items-center"><i class="material-icons">home</i> Beranda</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/internal-images/icon-raport.png') }}"
                                class="d-flex align-items-center me-1" width="16px" height="16px" />
                            Raport
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="profile">
        <div class="container">
            <div class="box-profile">
                <div class="row">
                    <div class="col-12">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#semester-gasal" type="button" role="tab" aria-controls="nav-home"
                                    aria-selected="true">SEMESTER GASAL</button>
                                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab"
                                    data-bs-target="#semester-genap" type="button" role="tab"
                                    aria-controls="nav-profile" aria-selected="false">SEMESTER GENAP</button>
                            </div>
                        </nav>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-md-10 col-12">
                        <div class="tab-content" id="nav-tabContent">
                            {{-- raport semester gasal --}}
                            <div class="tab-pane fade show active" id="semester-gasal" role="tabpanel"
                                aria-labelledby="nav-home-tab" tabindex="0">
                                <div class="d-flex justify-content-between mt-3">
                                    <div class="sipenla"></div>
                                    <div class="tut-wuri"></div>
                                </div>
                                <div class="row  mt-3">
                                    <div class="col-md-6 col-12">
                                        <table style="width:100%;border:">
                                            <tr>
                                                <td style="width: 40%;font-weight:600">Nama Sekolah</td>
                                                <td style="width: 5%; text-align:center">:</td>
                                                <td style="width: 55%">SMAN 1 Surabaya
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;font-weight:600">Nama Siswa</td>
                                                <td style="width: 5%; text-align:center">:</td>
                                                <td style="width: 55%">Doni Tri Pamungkas
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;font-weight:600">NISN</td>
                                                <td style="width: 5%; text-align:center">:</td>
                                                <td style="width: 55%">1254785874
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <table style="width:100%;border:">
                                            <tr>
                                                <td style="width: 40%;font-weight:600">Kelas</td>
                                                <td style="width: 5%; text-align:center">:</td>
                                                <td style="width: 55%">8A
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;font-weight:600">Semester</td>
                                                <td style="width: 5%; text-align:center">:</td>
                                                <td style="width: 55%">Genap
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;font-weight:600">Tahun Ajaran</td>
                                                <td style="width: 5%; text-align:center">:</td>
                                                <td style="width: 55%">2022/2023
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="study-value text-center">Capaian Hasil Belajar</h5>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <h6 class="text-raport">A. Pengetahuan dan Keterampilan</h6>
                                        <table class="table-raport">
                                            <thead>
                                                <tr>
                                                    <th>Mata Pelajaran</th>
                                                    <th>Nilai</th>
                                                    <th>Predikat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Bahasa Indonesia</td>
                                                    <td>90</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr>
                                                    <td>Matematika</td>
                                                    <td>85</td>
                                                    <td>B+</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-raport">B. Ekstrakulikuler</h6>
                                        <table class="table-raport">
                                            <thead>
                                                <tr>
                                                    <th>Ekstrakulikuler</th>
                                                    <th>Nilai</th>
                                                    <th>Predikat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Basket</td>
                                                    <td>90</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr>
                                                    <td>Futsal</td>
                                                    <td>85</td>
                                                    <td>B+</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-raport">C. Ketidakhadiran</h6>
                                        <table style="width: 100%;">
                                            <tr>
                                                <td style="width:5%;text-align:center;font-weight:600">1.</td>
                                                <td style="width: 20%;;font-weight:600">Sakit</td>
                                                <td style="width:5%;text-align:center">:</td>
                                                <td style="width: 70%;">1</td>
                                            </tr>
                                            <tr>
                                                <td style="width:5%;text-align:center;font-weight:600">2.</td>
                                                <td style="width: 20%;;font-weight:600">Izin</td>
                                                <td style="width:5%;text-align:center">:</td>
                                                <td style="width: 70%;">-</td>
                                            </tr>
                                            <tr>
                                                <td style="width:5%;text-align:center;font-weight:600">3.</td>
                                                <td style="width: 20%;;font-weight:600">Tanpa Keterangan</td>
                                                <td style="width:5%;text-align:center">:</td>
                                                <td style="width: 70%;">-</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-raport">Keterangan</h6>
                                        <table style="width: 100%">
                                            <tr>
                                                <td style="width: 5%; text-align:center;font-weight:600">A</td>
                                                <td style="width: 3%; text-align:center">:</td>
                                                <td style="width: 92%">Sangat Baik</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 5%; text-align:center;font-weight:600">B</td>
                                                <td style="width: 3%; text-align:center">:</td>
                                                <td style="width: 92%">Baik</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 5%; text-align:center;font-weight:600">C</td>
                                                <td style="width: 3%; text-align:center">:</td>
                                                <td style="width: 92%">Cukup</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-12">
                                        <h6 class="text-raport">Mengetahui, </h6>
                                        <div class="row justify-content-center text-center mt-3">
                                            <div class="col-md-4 col-12">
                                                <div class="raport-signature">
                                                    <div class="ket-signature">
                                                        Orang Tua
                                                    </div>
                                                    <div class="title-signature">
                                                        <div class="title ">Nama Ortu</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="raport-signature">
                                                    <div class="ket-signature">
                                                        Kepala Sekolah
                                                    </div>
                                                    <div class="title-signature">
                                                        <div class="title">Nama Kepsek</div>
                                                        <div class="number">0001245879658</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <div class="raport-signature">
                                                    <div class="ket-signature">
                                                        Wali Kelas
                                                    </div>
                                                    <div class="title-signature">
                                                        <div class="title">Nama Walkel</div>
                                                        <div class="number">00045875220548</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- akhir raport semester gasal --}}

                            {{-- raport semester genap --}}
                            <div class="tab-pane fade" id="semester-genap" role="tabpanel"
                                aria-labelledby="nav-profile-tab" tabindex="0">
                                <div class="tab-pane fade show active" id="semester-gasal" role="tabpanel"
                                    aria-labelledby="nav-home-tab" tabindex="0">
                                    <div class="d-flex justify-content-between mt-3">
                                        <div class="sipenla"></div>
                                        <div class="tut-wuri"></div>
                                    </div>
                                    <div class="row  mt-3">
                                        <div class="col-md-6 col-12">
                                            <table style="width:100%;border:">
                                                <tr>
                                                    <td style="width: 40%;font-weight:600">Nama Sekolah</td>
                                                    <td style="width: 5%; text-align:center">:</td>
                                                    <td style="width: 55%">SMAN 1 Surabaya
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 40%;font-weight:600">Nama Siswa</td>
                                                    <td style="width: 5%; text-align:center">:</td>
                                                    <td style="width: 55%">Doni Tri Pamungkas
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 40%;font-weight:600">NISN</td>
                                                    <td style="width: 5%; text-align:center">:</td>
                                                    <td style="width: 55%">1254785874
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <table style="width:100%;border:">
                                                <tr>
                                                    <td style="width: 40%;font-weight:600">Kelas</td>
                                                    <td style="width: 5%; text-align:center">:</td>
                                                    <td style="width: 55%">8A
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 40%;font-weight:600">Semester</td>
                                                    <td style="width: 5%; text-align:center">:</td>
                                                    <td style="width: 55%">Genap
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 40%;font-weight:600">Tahun Ajaran</td>
                                                    <td style="width: 5%; text-align:center">:</td>
                                                    <td style="width: 55%">2022/2023
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="study-value text-center">Capaian Hasil Belajar</h5>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-12">
                                            <h6 class="text-raport">A. Pengetahuan dan Keterampilan</h6>
                                            <table class="table-raport">
                                                <thead>
                                                    <tr>
                                                        <th>Mata Pelajaran</th>
                                                        <th>Nilai</th>
                                                        <th>Predikat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Bahasa Indonesia</td>
                                                        <td>90</td>
                                                        <td>A</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Matematika</td>
                                                        <td>85</td>
                                                        <td>B+</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-12">
                                            <h6 class="text-raport">B. Ekstrakulikuler</h6>
                                            <table class="table-raport">
                                                <thead>
                                                    <tr>
                                                        <th>Ekstrakulikuler</th>
                                                        <th>Nilai</th>
                                                        <th>Predikat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Basket</td>
                                                        <td>90</td>
                                                        <td>A</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Futsal</td>
                                                        <td>85</td>
                                                        <td>B+</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-12">
                                            <h6 class="text-raport">C. Ketidakhadiran</h6>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td style="width:5%;text-align:center;font-weight:600">1.</td>
                                                    <td style="width: 20%;;font-weight:600">Sakit</td>
                                                    <td style="width:5%;text-align:center">:</td>
                                                    <td style="width: 70%;">1</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:5%;text-align:center;font-weight:600">2.</td>
                                                    <td style="width: 20%;;font-weight:600">Izin</td>
                                                    <td style="width:5%;text-align:center">:</td>
                                                    <td style="width: 70%;">-</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:5%;text-align:center;font-weight:600">3.</td>
                                                    <td style="width: 20%;;font-weight:600">Tanpa Keterangan</td>
                                                    <td style="width:5%;text-align:center">:</td>
                                                    <td style="width: 70%;">-</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12">
                                            <h6 class="text-raport">Keterangan</h6>
                                            <table style="width: 100%">
                                                <tr>
                                                    <td style="width: 5%; text-align:center;font-weight:600">A</td>
                                                    <td style="width: 3%; text-align:center">:</td>
                                                    <td style="width: 92%">Sangat Baik</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 5%; text-align:center;font-weight:600">B</td>
                                                    <td style="width: 3%; text-align:center">:</td>
                                                    <td style="width: 92%">Baik</td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 5%; text-align:center;font-weight:600">C</td>
                                                    <td style="width: 3%; text-align:center">:</td>
                                                    <td style="width: 92%">Cukup</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12">
                                            <h6 class="text-raport">Keputusan</h6>
                                            <p class="text-kep">Memutuskan untuk meneruskan ke kelas selanjutnya</p>
                                        </div>
                                        <div class="col-12">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-md-6 col-12 ">
                                                    <h6 class="text-raport">Naik Kelas / <span>Tinggal Kelas</span> </h6>
                                                    {{-- tidak naik --}}
                                                    {{-- <h6 class="text-raport"> <span> Naik Kelas</span> /Tinggal Kelas </h6> --}}
                                                    <div class="d-flex">
                                                        <div class="next-grade">Naik ke kelas</div>
                                                        <div class="class-grade">: 8 (Delapan) / 9 (Sembilan)</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-12 ">
                                                    <div class="text-grade">Dinyatakan: </div>
                                                    <div class="box-grade-class">
                                                        Naik ke kelas
                                                        <h6>IX (SEMBILAN)</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <h6 class="text-raport">Mengetahui, </h6>
                                            <div class="row justify-content-center text-center mt-3">
                                                <div class="col-md-4 col-12">
                                                    <div class="raport-signature">
                                                        <div class="ket-signature">
                                                            Orang Tua
                                                        </div>
                                                        <div class="title-signature">
                                                            <div class="title ">Nama Ortu</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="raport-signature">
                                                        <div class="ket-signature">
                                                            Kepala Sekolah
                                                        </div>
                                                        <div class="title-signature">
                                                            <div class="title">Nama Kepsek</div>
                                                            <div class="number">0001245879658</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-12">
                                                    <div class="raport-signature">
                                                        <div class="ket-signature">
                                                            Wali Kelas
                                                        </div>
                                                        <div class="title-signature">
                                                            <div class="title">Nama Walkel</div>
                                                            <div class="number">00045875220548</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- akhir raport semestrer genap --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


{{-- @push('addon-javascript')
    <script src="/js/dataTable.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-student').DataTable({
                scrollY: '60vh',
                scrollCollapse: true,
                paging: false,
            });
        });
        window.addEventListener("load", function() {
            const input = document.querySelector("#table-student_filter");
            const elemenInput = input.children[0].children[0];
            elemenInput.setAttribute("placeholder", "pencarian")
            input.children[0].childNodes[0].textContent = " ";
        });
    </script>
@endpush --}}
