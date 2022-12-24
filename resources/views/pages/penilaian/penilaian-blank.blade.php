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
                        <a href class="d-flex align-items-center"><i class="material-icons">home</i> Beranda</a>
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
                    Penilaian Pembelajaran
                </div>
                <form action="{{ route('getStudentForPenilaian') }}" method="GET">
                    <div class="row mt-mb-3 mt-md-4  mt-3 mb-md-2">
                        <div class="col-md-2 col-6 mb-2 mb-md-0">
                            <select class="form-select" name="semester" id="semester" data-placeholder="Semester">
                                <option></option>
                                @foreach ($semester as $newsemester )
                                    <option value="{{ $newsemester->semester_id }}">{{ $newsemester->semester_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-6">
                            <select class="form-select" name="tahun" id="tahun" data-placeholder="Tahun">
                                <option></option>
                                @foreach ($academic as $newAcademicYears )
                                    <option value="{{ $newAcademicYears->academic_year_id }}">{{ $newAcademicYears->academic_year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-6 mb-2 mb-md-0">
                            <select class="form-select" name="mapel" id="mapel" data-placeholder="Mapel">
                                <option></option>
                                @foreach ($subject as $newsubject )
                                    <option value="{{ $newsubject->subject_id }}">{{ $newsubject->subject_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-6">
                            <select class="form-select" name="grade" id="kelas" data-placeholder="Kelas">
                                <option></option>
                                @foreach ($grade as $newgrade )
                                <option value="{{ $newgrade->grade_id }}">{{ $newgrade->grade_name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-6">
                            <select class="form-select" name="penilaian" id="penilaian-tugas" data-placeholder="Penilaian">
                                <option></option>
                            @foreach ($assessment as $newassessment )
                                <option value="{{ $newassessment->assessment_id }}">{{ $newassessment->assessment_name }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 col-6">
                            <button type="submit" class="search-penilaian">Cari</button>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <div class="text-blank text-center">--- Pilih Kelas dan Mata Pelajaran terlebih dahulu ---</div>
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
