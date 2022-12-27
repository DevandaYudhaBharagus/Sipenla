@extends('layouts.dashboard-layouts')

@section('title', 'Penilaian Siswa')

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
                            Penilaian
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
                    Penilaian Ekstrakurikuler
                </div>
                <div class="row mt-mb-3 mt-md-4  mt-3 mb-md-2">
                    <div class="col-md-2 col-6 mb-2 mb-md-0">
                        <select class="form-select" name="semester" id="semester" data-placeholder="Semester">
                            <option>{{ $semesters->semester_name }}</option>
                            {{-- <option value="{{ $semesters->semester_id }}">{{ $semesters->semester_name }}</option> --}}
                        </select>
                    </div>
                    <div class="col-md-2 col-6">
                        <select class="form-select" name="tahun" id="tahun" data-placeholder="Tahun">
                            <option>{{ $academics->academic_year }}</option>
                            {{-- <option value="{{ $academics->academic_year_id }}">{{ $academics->academic_year }}</option> --}}
                        </select>
                    </div>
                </div>
                <div class="table-dash">
                    <form action="{{ route('penilaianExtraStore') }}" method="post">
                        {{ csrf_field() }}
                        <table id="penilaian" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width:30%">NISN</th>
                                    <th style="width:30%">Nama</th>
                                    <th style="width:20%">Penilaian</th>
                                </tr>
                            </thead>
                            <tbody>
                                <input type="text" name="extracurricular_id" style="display: none"
                                    value="{{ $employee->extracurricular_id }}">
                                <input type="text" name="semester_id" style="display: none"
                                    value="{{ $semesters->semester_id }}">
                                <input type="text" name="academic_year_id" style="display: none"
                                    value="{{ $academics->academic_year_id }}">
                                @foreach ($student as $new)
                                    <input type="text" style="display: none" name="student_id[]"
                                        value="{{ $new->student_id }}" multiple="true">
                                    <tr>
                                        <td style="width:30%">{{ $new->nisn }}</td>
                                        <td style="width:30%">{{ $new->first_name . ' ' . $new->last_name }}</td>
                                        <td style="width:20%">
                                            <input type="text" class="form-control entry-nilai" name="nilai[]"
                                                multiple="true" id="" onkeypress="return hanyaAngka(event)"
                                                maxlength="3">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn-save">Simpan</button>
                        </div>
                    </form>
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
        $(document).ready(function() {
            $('#penilaian').DataTable({
                scrollY: '60vh',
                scrollCollapse: true,
                paging: false,
            });
        });
        window.addEventListener("load", function() {
            const input = document.querySelector("#penilaian_filter");
            const elemenInput = input.children[0].children[0];
            elemenInput.setAttribute("placeholder", "pencarian")
            input.children[0].childNodes[0].textContent = " ";
        });

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
