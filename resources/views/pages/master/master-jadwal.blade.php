@extends('layouts.master')
@section('title', 'Master Jadwal Pelajaran')
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection


@section('content')

    <div class="box-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center"><i class="material-icons">home</i>
                        Beranda</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/internal-images/icon-master.png') }}"
                            class="d-flex align-items-center me-1" width="16px" height="16px" alt=""> Data
                        Master
                    </div>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/internal-images/icon-fasilitas.png') }}"
                            class="d-flex align-items-center me-1" width="16px" height="16px" alt=""> Data
                        Jadwal
                    </div>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/internal-images/icon-jadwal-pelajaran.png') }}"
                            class="d-flex align-items-center me-1" width="16px" height="16px" alt=""> Jadwal Mata
                        Pelajaran
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Jadwal Mata Pelajaran</h5>
        <div class="d-md-flex align-items-md-center justify-content-md-between mt-2">
            <button class="btn-create" id="add-schedule" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Data
            </button>
            <div class="form-search">
                <input type="text" name="" id="search" placeholder="Cari Mata Pelajaran" />
            </div>
        </div>
        <div class="outher-table" id="table-schedule">
            <div class="table-scroll">
                <table id="master-jadwal" class="table-master" style="width:100%;">
                    <thead>
                        <tr>
                            <th style="width:20%" class="text-center">Mata Pelajaran</th>
                            <th style="width:10%" class="text-center">Kelas</th>
                            <th style="width:20%" class="text-center">Guru</th>
                            <th style="width:10%" class="text-center">Hari</th>
                            <th style="width:15%" class="text-center">Jam Mulai</th>
                            <th style="width:15%" class="text-center">Jam Selesai</th>
                            <th style="width:10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedule as $new)
                            <tr>
                                <td style="width:20%">{{ $new->subject_name }}</td>
                                <td style="width:10%">{{ $new->grade_name }}</td>
                                <td style="width:20%">{{ $new->first_name . ' ' . $new->last_name }}</td>
                                <td style="width:10%">{{ $new->day_name }}</td>
                                <td style="width:15%">{{ $new->start_time }}</td>
                                <td style="width: 15%">{{ $new->end_time }}</td>
                                <td style="width:10%">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="btn-edit-master me-2" data-id="{{ $new->lesson_schedule_id }}"
                                            onclick=edit_data($(this))><i class="fa fa-edit text-primary"></i></a>
                                        <a data-id="{{ $new->lesson_schedule_id }}" onclick=delete_data($(this))
                                            class="btn-edit-master">
                                            <i class="fa fa-trash-o text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-role">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 m-auto" id="modal-title">
                        Tambah Data Jadwal
                    </h1>
                </div>
                <div class="modal-body">
                    <form id="form-schedule">
                        @csrf
                        <input type="hidden" name="lesson_schedule_id" id="lesson_schedule_id" value="">
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label for="subject_id" class="form-label">Mata Pelajaran</label>
                                <select class="form-select" name="subject_id" id="subject_id"
                                    data-placeholder="--- Pilih Mata Pelajaran ---">
                                    <option></option>
                                    @foreach ($subject as $subjects)
                                        <option value="{{ $subjects->subject_id }}">{{ $subjects->subject_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="grade_id" class="form-label">Kelas</label>
                                <select class="form-select" name="grade_id" id="grade_id"
                                    aria-label="Default select example" data-placeholder="--- Pilih Kelas ---">
                                    <option></option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->grade_id }}">{{ $grade->grade_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="teacher_id" class="form-label">Guru</label>
                                <select class="form-select" name="teacher_id" id="teacher_id"
                                    data-dropdown-parent="body" data-placeholder="--- Pilih Guru ---">
                                    <option></option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->employee_id }}">
                                            {{ $teacher->first_name . ' ' . $teacher->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="day_id" class="form-label">Hari</label>
                                <select class="form-select" name="days_id" id="day_id" data-dropdown-parent="body"
                                    aria-label="Default select example" data-placeholder="--- Pilih Hari ---">
                                    <option></option>
                                    @foreach ($days as $day)
                                        <option value="{{ $day->day_id }}">{{ $day->day_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="" class="form-label">Jam Mulai</label>
                                <input type="text" name="start_time" id="start_time" class="form-control bg-down">
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="" class="form-label">Jam Selesai</label>
                                <input type="text" name="end_time" id="end_time" class="form-control bg-down">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-permission bg-red-permission me-md-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" id="button-modal" class="btn-permission bg-green-permission">
                        Tambah
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('addon-javascript')
    <script>
        const inpuTSearch = document.querySelector("#search");
        inpuTSearch.addEventListener("keyup", searchDataTable);

        function searchDataTable() {
            let filter, table, tr, td, i, txtValue;
            filter = inpuTSearch.value.toUpperCase();
            table = document.querySelector("#master-jadwal");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
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
        const selected = document.querySelectorAll(".selected");
        const optionsContainer = document.querySelectorAll(".options-container");
        const searchBox = document.querySelectorAll(".search-box input");

        function uploadImage() {
            document.querySelector("#image-master").click();
        }
    </script>
    <script>
        $('#subject_id').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $('#exampleModal'),
        });

        $('#teacher_id').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $('#exampleModal'),
        });

        $('#day_id').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $('#exampleModal'),
        });

        $('#grade_id').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            dropdownParent: $('#exampleModal'),
        });
        $("#exampleModal").on("hidden.bs.modal", function(e) {
            const reset_form = $('#form-schedule')[0];
            $(reset_form).removeClass('was-validated');
            $("#lesson_schedule_id").val("");
            $("#grade_id").val("").change();
            $("#teacher_id").val("").change();
            $("#day_id").val("").change();
            $("#subject_id").val("").change();
            $("#form-grade").trigger("reset")
            let uniqueField = ["start_time"]
            for (let i = 0; i < uniqueField.length; i++) {
                $("#" + uniqueField[i]).removeClass('was-validated');
                $("#" + uniqueField[i]).removeClass("is-invalid");
                $("#" + uniqueField[i]).removeClass("invalid-more");
            }
        });

        $(document).ready(function() {
            document.getElementById("add-schedule").addEventListener("click", function() {
                document.getElementById("form-schedule").reset();
                $("#modal-title").html("Tambah Data Jadwal Mata Pelajaran");
                document.getElementById("lesson_schedule_id").value = null;
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })

        Array.prototype.filter.call($('#form-schedule'), function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                let lesson_schedule_id = $("#lesson_schedule_id").val();

                var url = (lesson_schedule_id !== undefined && lesson_schedule_id !== null) &&
                    lesson_schedule_id ? "{{ url('schedules') }}" + "/" + lesson_schedule_id :
                    "{{ url('schedules') }}" + "/addschedule";
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    data: $('#form-schedule').serialize(),
                    // contentType: 'application/json',
                    processData: false,
                    success: function(response) {
                        if (response.error) {
                                Swal.fire({
                                    type: "error",
                                    title: 'Oops...',
                                    text: `${response.error}`,
                                    confirmButtonClass: 'btn btn-success',
                                });
                        }else{
                            setTimeout(() => {
                            $("#table-schedule").load(window.location.href +
                                " #table-schedule");
                            }, 0);
                            $('#exampleModal').modal('hide');
                            var reset_form = $('#form-schedule')[0];
                            $(reset_form).removeClass('was-validated');
                            reset_form.reset();
                            $('#exampleModal').modal('hide');
                            $("#modal-title").html("Tambah Data Jadwal Kelas")
                            $("#employee_id").val()
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        function edit_data(e) {
            $('#exampleModal').modal('show')
            var url = "{{ url('schedules') }}" + "/" + e.attr('data-id') + "/" + "edit"
            $.ajax({
                url: url,
                method: "GET",
                // dataType: "json",
                success: function(result) {
                    $("#modal-title").html("Edit Jadwal Mata Pelajaran")
                    $("#button-modal").html("Edit")
                    $('#lesson_schedule_id').val(result.lesson_schedule_id).trigger('change');
                    $('#subject_id').val(result.subject_id).trigger('change');
                    $('#teacher_id').val(result.teacher_id).trigger('change');
                    $('#grade_id').val(result.grade_id).trigger('change');
                    $('#day_id').val(result.days_id).trigger('change');
                    $('#start_time').val(result.start_time);
                    $('#end_time').val(result.end_time);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        function delete_data(e) {
            Swal.fire({
                text: "Apakah anda yakin ingin menghapus ?",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Setuju',
                reverseButtons: true

            }).then(function(result) {

                if (result.value) {

                    var id = e.attr('data-id');
                    jQuery.ajax({
                        url: "{{ url('/schedules/delete-schedules') }}" + "/" + id,
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            '_method': 'delete'
                        },
                        success: function(result) {

                            if (result.error) {

                                Swal.fire({
                                    type: "error",
                                    title: 'Oops...',
                                    text: result.message,
                                    confirmButtonClass: 'btn btn-success',
                                })

                            } else {

                                setTimeout(() => {
                                    $("#table-schedule").load(window.location.href +
                                        " #table-schedule");
                                }, 0);

                                Swal.fire({
                                    type: "success",
                                    title: 'Menghapus!',
                                    text: result.message,
                                    confirmButtonClass: 'btn btn-success',
                                })

                            }
                        }
                    });
                }
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#start_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });

        flatpickr("#end_time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    </script>
@endpush
