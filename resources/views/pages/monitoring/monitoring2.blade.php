@extends('layouts.dashboard-layouts')

@section('title', 'Monitoring')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="/css/css-internal/select2-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" />
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
                            <img src="{{ asset('images/internal-images/icon-monitoring.png') }}"
                                class="d-flex align-items-center me-1" width="16px" height="16px" />
                            Monitoring
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
                    Monitoring
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
                                <div class="col-12 mb-3">
                                    <button class="btn btn-choice-monitoring w-100" >
                                        Monitoring Pembelajaran
                                    </button>
                                </div>
                                {{-- <div class="col-12">
                                    <button class="btn btn-choice-monitoring w-100" id="btn-monitoring">
                                        Monitoring Ekstrakulikuler
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                        <div class="box-student-card mt-md-4" id="mapel-class">
                            <div class="mb-3">
                                <select class="form-select monitoring" id="single-select-field"
                                    data-placeholder="Mata Pelajaran">
                                    <option></option>
                                    <option>{{ $subjects->subject_name }}</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select class="form-select monitoring" id="single-select-class" data-placeholder="Kelas">
                                    <option></option>
                                    <option>{{ $grades->grade_name }}</option>
                                </select>
                            </div>
                            {{-- <div class="down-form">
                                <i class="fa fa-angle-down"></i>
                            </div> --}}
                        </div>
                        <div class="box-student-card mt-md-4" id="mapel-class">
                            <h3>Ini Ekstrakulikuler</h3>
                        </div>
                        <div class="box-student-card mt-md-4">
                            <div class="chart-present">
                                <div class="desk-date">
                                    <div class="date-chart">
                                        Selasa, 06 Desember 2022
                                    </div>
                                    <div class="class-chart">
                                        Kelas 7A
                                    </div>
                                </div>
                                <div class="input-date-chart">
                                    <input type="text" name="" id="date-chart" placeholder="Tanggal">
                                </div>
                            </div>
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-7 col-12">
                        <div class="box-biografi present">
                            <div class="show" id="show-monitoring">
                                <div class="table-monitoring-present">
                                    <form action="" method="post">
                                        <input type="text" style="display: none" name="mapel" value="{{ $subjects->subject_id }}">
                                        <input type="text" style="display: none" name="grade" value="{{ $grades->grade_id }}">
                                        <table class="table-responsive table-borderless table-monitoring">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">No</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">NISN</th>
                                                    <th scope="col">H</th>
                                                    <th scope="col">I</th>
                                                    <th scope="col">S</th>
                                                    <th scope="col">A</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($student as $new )
                                                <tr>
                                                    <td class="text-cente widt-1">{{ $loop->iteration }}</td>
                                                
                                                   <td class="widt-3"> <input type="text"  multiple
                                                    value="{{ $new->first_name.' '.$new->last_name }}" disabled> </td>
                                                    <td class="widt-2"><input type="text" multiple
                                                            value="139857468525" disabled></td>
                                                    <td class="widt-5"> <input type="checkbox" name="status"
                                                            class="form-check-input present" id="exampleCheck1">
                                                    </td>
                                                    <td class="widt-5"><input type="checkbox" name="status"
                                                            class="form-check-input izin" id="exampleCheck1">
                                                    </td>
                                                    <td class="widt-5"><input type="checkbox" name="status"
                                                            class="form-check-input sick" id="exampleCheck1">
                                                    </td>
                                                    <td class="widt-5"><input type="checkbox" name="status"
                                                            class="form-check-input alpha" id="exampleCheck1">
                                                    </td>
                                                
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="submit-monitoring ">Perbarui Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="show-monitoring">
                                <h5>Bahasa Inggris</h5>
                                <div class="sub-text">Kelas 7A</div>
                                <div class="table-monitoring-present">
                                    <form action="" method="post">
                                        <table class="table-responsive table-borderless table-monitoring">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="text-center">No Absen</th>
                                                    <th scope="col">Nama</th>
                                                    <th scope="col">NISN</th>
                                                    <th scope="col">H</th>
                                                    <th scope="col">I</th>
                                                    <th scope="col">S</th>
                                                    <th scope="col">A</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-cente widt-1">1</td>
                                                    <td class="widt-3"> <input type="text" name="nameStudent[]" multiple
                                                            value="Aziz" disabled> </td>
                                                    <td class="widt-2"><input type="text" name="nisn[]" multiple
                                                            value="139857468525" disabled></td>
                                                    <td class="widt-5"> <input type="checkbox"
                                                            class="form-check-input present" id="exampleCheck1">
                                                    </td>
                                                    <td class="widt-5"><input type="checkbox"
                                                            class="form-check-input izin" id="exampleCheck1">
                                                    </td>
                                                    <td class="widt-5"><input type="checkbox"
                                                            class="form-check-input sick" id="exampleCheck1">
                                                    </td>
                                                    <td class="widt-5"><input type="checkbox"
                                                            class="form-check-input alpha" id="exampleCheck1">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-cente widt-1">2</td>
                                                    <td class="widt-3"> <input type="text" name="nameStudent[]"
                                                            multiple value="Pranaja" disabled> </td>
                                                    <td class="widt-2"><input type="text" name="nisn[]" multiple
                                                            value="139857468525" disabled></td>
                                                    <td class="widt-5"> <input type="checkbox"
                                                            class="form-check-input present" id="exampleCheck1">
                                                    </td>
                                                    <td class="widt-5"><input type="checkbox"
                                                            class="form-check-input izin" id="exampleCheck1">
                                                    </td>
                                                    <td class="widt-5"><input type="checkbox"
                                                            class="form-check-input sick" id="exampleCheck1">
                                                    </td>
                                                    <td class="widt-5"><input type="checkbox"
                                                            class="form-check-input alpha" id="exampleCheck1">
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="submit-monitoring ">Perbarui Data</button>
                                        </div>
                                    </form>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.1.0/chartjs-plugin-datalabels.min.js"
        integrity="sha512-Tfw6etYMUhL4RTki37niav99C6OHwMDB2iBT5S5piyHO+ltK2YX8Hjy9TXxhE1Gm/TmAV0uaykSpnHKFIAif/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        $('#single-select-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
    <script>
        $('#single-select-class').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Hadir', 'Sakit', 'Izin', 'Alpa'],
                datasets: [{
                    label: 'Siswa',
                    data: [12, 3, 2, 2],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(75, 85, 107)',
                        '#FFB711',
                        '#3774C3',
                        '#FF4238'
                    ],
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'right',
                        fullSize: false
                    },
                    datalabels: {
                        color: 'white',
                        labels: {
                            value: {},
                            title: {
                                color: 'white'
                            },
                            font: {
                                size: 18,
                                weight: 'bold'
                            }
                        }
                    }
                }

            }
        });
    </script>
    <script>
        flatpickr("#date-chart", {
            altInput: true,
            altFormat: "j F, Y",
            dateFormat: "d-m-Y",
        });
    </script>
    <script>
        const btnMonitoring = document.querySelectorAll("#btn-monitoring");
        const optionClass = document.querySelectorAll("#mapel-class");
        const monitoring = document.querySelectorAll("#show-monitoring");
        for (let i = 0; i < btnMonitoring.length; i++) {
            btnMonitoring[i].addEventListener("click", () => {
                if (i == 0) {
                    monitoring[0].style.display = "none";
                    monitoring[1].style.display = "block";
                } else {
                    monitoring[0].style.display = "block";
                    monitoring[1].style.display = "none";

                }
                btnMonitoring.forEach((btn) => {
                    btn.classList.remove("active");
                });
                optionClass.forEach((option) => {
                    option.classList.remove("show");
                });
                btnMonitoring[i].classList.add("active");
                optionClass[i].classList.add("show");
            });
        }
    </script>
@endpush
