@extends('layouts.master')
@section('title', 'Master Jadwal EkstraKulikuler')
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
                        <img src="{{ asset('images/internal-images/icon-extra.png') }}"
                            class="d-flex align-items-center me-1" width="16px" height="16px" alt="">
                        Jadwal Esktrakulikuler
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Jadwal Ekstrakulikuler</h5>
        <div class=" mt-4">
            <button class="btn-create" id="add-schedule" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Data
            </button>
        </div>
        <div class="outher-table" id="table-schedule">
            <table id="master-jadwal" class="display " style="width:100%;">
                <thead>
                    <tr>
                        <th class="text-center">Nama Ekstrakulikuler</th>
                        <th class="text-center">Guru</th>
                        <th class="text-center">Hari</th>
                        <th class="text-center">Jam Mulai</th>
                        <th class="text-center">Jam Selesai</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width:25%">Basket Lorem ipsum dolor sit amet.</td>
                        <td style="width:20%">asas Lorem ipsum dolor sit.</td>
                        <td style="width:10%">Senin </td>
                        <td style="width:15%">Lorem ipsum dolor sit.</td>
                        <td style="width:15%">Lorem ipsum dolor sit.</td>
                        <td style="width:15%">
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-edit-master me-2" data-id="" onclick=edit_data($(this))><i
                                        class="fa fa-edit text-primary"></i></a>
                                <a data-id="" onclick=delete_data($(this)) class="btn-edit-master">
                                    <i class="fa fa-trash-o text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Basket Lorem ipsum dolor sit amet.</td>
                        <td>asas Lorem ipsum dolor sit.</td>
                        <td>Senin </td>
                        <td>Lorem ipsum dolor sit.</td>
                        <td>Lorem ipsum dolor sit.</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-edit-master me-2" data-id="" onclick=edit_data($(this))><i
                                        class="fa fa-edit text-primary"></i></a>
                                <a data-id="" onclick=delete_data($(this)) class="btn-edit-master">
                                    <i class="fa fa-trash-o text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
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
                                <label for="subject_id" class="form-label">Ekstrakulikuler</label>
                                <select class="form-select" name="subject_id" id="subject_id" data-dropdown-parent="body"
                                    data-placeholder="--- Pilih Ekstrakulikuler ---">
                                    <option></option>
                                    {{-- @foreach ($subject as $subjects)
                                        <option value="{{ $subjects->subject_id }}">{{ $subjects->subject_name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="teacher_id" class="form-label">Guru</label>
                                <select class="form-select" name="teacher_id" id="teacher_id" data-dropdown-parent="body"
                                    data-placeholder="--- Pilih Guru ---">
                                    {{-- @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->employee_id }}">
                                            {{ $teacher->first_name . ' ' . $teacher->last_name }}</option>
                                    @endforeach  --}}
                                </select>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="day_id" class="form-label">Hari</label>
                                <select class="form-select" name="days_id" id="day_id" data-dropdown-parent="body"
                                    aria-label="Default select example" data-placeholder="--- Pilih Hari ---">
                                    {{-- @foreach ($days as $day)
                                        <option value="{{ $day->day_id }}">{{ $day->day_name }}</option>
                                    @endforeach --}}
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
    <script src="/js/dataTable.js"></script>
    <script>
        $(document).ready(function() {
            $('#master-jadwal').DataTable({
                scrollY: '60vh',
                scrollCollapse: true,
                paging: false,
            });
        });
        window.addEventListener("load", function() {
            const input = document.querySelector("#master-jadwal_filter");
            const elemenInput = input.children[0].children[0];
            elemenInput.setAttribute("placeholder", "pencarian")
            input.children[0].childNodes[0].textContent = " ";
        });
    </script>
    <script>
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

            $('#subject_id').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $('#exampleModal'),
            });

            $('#teacher_id').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $('#exampleModal'),
            });

            $('#day_id').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $('#exampleModal'),
            });

            $('#grade_id').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $('#exampleModal'),
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
                        console.log(response)
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
