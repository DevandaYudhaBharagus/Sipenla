@extends('layouts.dashboard-layouts')

@section('title', 'Penlian Siswa')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.css" />
@endsection
@section('content')
    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="/dashboard" class="d-flex align-items-center"><i class="material-icons">home</i>
                            Beranda</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/internal-images/icon-penilaian.png') }}"
                                class="d-flex align-items-center me-1" width="16px" height="16px" />
                            Rapor
                        </div>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/internal-images/icon-penilaian.png') }}"
                                class="d-flex align-items-center me-1" width="16px" height="16px" />
                            Detail Pembelajaran Siswa
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
                    Data Pembelajaran Siswa
                </div>
                <div class="d-md-flex align-items-md-center justify-content-md-between mt-4 mb-3">
                    <form action="{{ route('getStudentForPenilaian') }}" method="GET">
                        <div class="row">
                            <div class="col-5 mb-2 mb-md-0">
                                <select class="form-select" name="semester" id="semester" data-placeholder="Semester">
                                    <option></option>
                                    <option>semester</option>
                                    {{-- @foreach ($semester as $newsemester)
                                    <option value="{{ $newsemester->semester_id }}">{{ $newsemester->semester_name }}</option>
                                @endforeach --}}
                                </select>
                            </div>
                            <div class="col-5">
                                <select class="form-select" name="tahun" id="tahun" data-placeholder="Tahun Ajaran">
                                    <option></option>
                                    {{-- @foreach ($academic as $newAcademicYears)
                                    <option value="{{ $newAcademicYears->academic_year_id }}">{{ $newAcademicYears->academic_year }}</option>
                                @endforeach --}}
                                    <option>20222</option>
                                </select>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="search-penilaian">Cari</button>
                            </div>
                        </div>
                    </form>
                    <div class="form-search">
                        <input type="text" name="" id="search" placeholder="Cari Ekstrakulikuler" />
                    </div>
                </div>
                <div class="table-dash mt-4">
                    <table id="tabel-pembelajaran" class="display-dashboard" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:10%">No</th>
                                <th style="width:10%">Kelas</th>
                                <th style="width:20%">Semester</th>
                                <th style="width:20%">Tahun Ajaran</th>
                                <th style="width:20%">Wali Kelas</th>
                                <th style="width:20%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form action="">
                                {{-- start looping --}}
                                <tr>
                                    <td>1.</td>
                                    <td>8A</td>
                                    <td>Ganjil</td>
                                    <td>2021/2022</td>
                                    <td>
                                        {{-- walkel sudah conirm --}}
                                        {{-- <div class="confirmed-walkel">
                                            Aziz Taher
                                        </div> --}}
                                        <div class="not-confirmed-walkel">
                                            Telah Terkonfirmasi
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between px-2">
                                            <a href="" class="btn-detail-raport">Detail</a>
                                            <button class="btn-confirm-raport" type="submit">Konfirmasi</button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1.</td>
                                    <td>8A</td>
                                    <td>Ganjil</td>
                                    <td>2021/2022</td>
                                    <td>
                                        {{-- walkel sudah conirm --}}
                                        {{-- <div class="confirmed-walkel">
                                            Aziz Taher
                                        </div> --}}
                                        <div class="not-confirmed-walkel">
                                            Telah Terkonfirmasi
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-between px-2">
                                            <a href="" class="btn-detail-raport">Detail</a>
                                            <button class="btn-confirm-raport" type="submit">Konfirmasi</button>
                                        </div>
                                    </td>
                                </tr>
                                {{-- end looping --}}
                            </form>
                        </tbody>
                    </table>
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
    <script src="/js/dataTable.js"></script>
    <script>
        const inpuTSearch = document.querySelector("#search");
        inpuTSearch.addEventListener("keyup", searchDataTable);

        function searchDataTable() {
            let filter, table, tr, td, i, txtValue;
            filter = inpuTSearch.value.toUpperCase();
            table = document.querySelector("#tabel-pembelajaran");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    // console.log(txtValue.toUpperCase().indexOf(filter))
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
    <script>
        function hanyaAngka(event) {
            var angka = (event.which) ? event.which : event.keyCode
            if (angka != 46 && angka > 31 && (angka < 48 || angka > 57))
                return false;
            return true;
        }
    </script>
    <script>
        window.addEventListener("load", function() {
            $('#tahun').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
            });
            $('#mapel').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
            });
            $('#kelas').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
            });
            $('#penilaian-tugas').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
            });
            $('#semester').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
            });
        });
    </script>
    <script>
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
    </script>
@endpush
