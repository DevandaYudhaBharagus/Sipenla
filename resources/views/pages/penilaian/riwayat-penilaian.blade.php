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
                <div class="row mt-mb-3 mt-md-4  mt-3 mb-md-2">
                    <div class="col-md-2 col-6 mb-2 mb-md-0">
                        <select class="form-select" name="semester" id="semester" data-placeholder="Semester">
                            <option>{{ $semesters->semester_name }}</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-6">
                        <select class="form-select" name="tahun" id="tahun" data-placeholder="Tahun">
                            <option>{{ $academics->academic_year }}</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-6 mb-2 mb-md-0">
                        <select class="form-select" name="mapel" id="mapel" data-placeholder="Mapel">
                            <option>{{ $subjects->subject_name }}</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-6">
                        <select class="form-select" name="grade" id="kelas" data-placeholder="Kelas">
                            <option>{{ $grades->grade_name }}</option>
                        </select>
                    </div>
                    <div class="col-md-2 col-6">
                        <select class="form-select" name="penilaian" id="penilaian-tugas" data-placeholder="Penilaian">
                            <option>{{ $assessments->assessment_name }}</option>
                        </select>
                    </div>
                </div>
                <div class="table-dash">
                    <table id="penilaian" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:30%">NISN</th>
                                <th style="width:30%">Nama</th>
                                <th style="width:20%">Nilai</th>
                                <th style="width:20%">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilai as $new)
                                <tr>
                                    <td style="width:30%">{{ $new->nisn }}</td>
                                    <td style="width:30%">{{ $new->first_name . ' ' . $new->last_name }}</td>
                                    <td style="width:20%">{{$new->nilai}}</td>
                                    <td style="width:20%">
                                        <a class="btn-edit-master me-2" data-id="{{ $new->penilaian_id }}"
                                            onclick=edit_data($(this))><i class="fa fa-edit text-primary"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('modal-dashboard')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-penilaian">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 m-auto" id="modal-title">Edit Nilai</h1>
                </div>
                <div class="modal-body">
                    <form id="form-penilaian">
                        @csrf
                        <input type="hidden" name="penilaian_id" id="penilaian_id" value="">
                        <table>
                            <tr>
                                <td style="width: 25%" class="label-name">Nama</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width: 70%" id="name"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%" class="label-name">Nisn</td>
                                <td style="width: 5%; text-align:center">:</td>
                                <td style="width: 70%" id="nisn"></td>
                            </tr>
                            <tr>
                                <td style="width: 25%" class="label-name">Nilai</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width: 70%">
                                    <input type="text" name="nilai" id="nilai"
                                        onkeypress="return hanyaAngka(event)" maxlength="3">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-penilaian bg-red-permission me-md-3"
                        data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn-penilaian bg-green-permission">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('addon-javascript')
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

        $("#exampleModal").on("hidden.bs.modal", function(e) {
            const reset_form = $('#form-workshift')[0];
            const reset_form_edit = $('#form_edit_data')[0];
            $(reset_form).removeClass('was-validated');
            $(reset_form_edit).removeClass('was-validated');
            let uniqueField = ["shift_name"]
            for (let i = 0; i < uniqueField.length; i++) {
                $("#" + uniqueField[i]).removeClass('was-validated');
                $("#" + uniqueField[i]).removeClass("is-invalid");
                $("#" + uniqueField[i]).removeClass("invalid-more");
            }
        });

        $(document).ready(function() {
            // document.getElementById("add-workshift").addEventListener("click", function() {
            //     document.getElementById("form-penilaian").reset();
            //     $("#modal-title").html("Edit Data Penilaian");
            //     document.getElementById("workshift_id").value = null;
            // });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })

        Array.prototype.filter.call($('#form-penilaian'), function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                let penilaian_id = $("#penilaian_id").val();

                var url = (penilaian_id !== undefined && penilaian_id !== null) && penilaian_id ?
                    "{{ url('penilaian') }}" + "/" + penilaian_id : "{{ url('penilaian') }}";
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    data: $('#form-penilaian').serialize(),
                    // contentType: 'application/json',
                    processData: false,
                    success: function(response) {
                        console.log(response)
                        setTimeout(() => {
                            $("#employee-table").load(window.location.href +
                                " #employee-table");
                        }, 0);
                        $('#exampleModal').modal('hide');
                        var reset_form = $('#form-penilaian')[0];
                        $(reset_form).removeClass('was-validated');
                        reset_form.reset();
                        $('#exampleModal').modal('hide');
                        $("#modal-title").html("Tambah Data Penilaian")
                        $("#penilaian_id").val()
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        function edit_data(e) {
            $('#exampleModal').modal('show')
            var url = "{{ url('penilaian') }}" + "/" + e.attr('data-id') + "/" + "edit"
            $.ajax({
                url: url,
                method: "GET",
                // dataType: "json",
                success: function(result) {
                    $("#modal-title").html("Edit Penilaian")
                    $("#button-modal").html("Edit")
                    $('#penilaian_id').val(result.penilaian_id).trigger('change');
                    $('#name').html(`${result.first_name} ${result.last_name}`);
                    $('#nisn').html(result.nisn);
                    $('#nilai').val(result.nilai);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

    </script>
@endpush
