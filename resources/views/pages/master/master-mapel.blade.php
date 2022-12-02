@extends('layouts.master')
@section('title', 'Master Mata Pelajaran')
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
                        <img src="{{ asset('images/internal-images/icon-mapel.png') }}"
                            class="d-flex align-items-center me-1" width="16px" height="16px" alt=""> Data
                        Mata Pelajaran
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Mata Pelajaran</h5>
        <div class="d-md-flex align-items-md-center justify-content-md-between mt-2">
            <div class="d-md-flex align-content-md-center">
                <button class="btn-create" id="add-subject" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                </button>
            </div>
            <div class="form-search">
                <input type="search" name="" id="" placeholder="pencarian" />
            </div>
        </div>
        <div class="outher-table" id="subject-table">
            <div class="table-scroll">
                <table class="table-master" style="border: 1px solid black">
                    <tr>
                        <th width="10%">No</th>
                        <th width="81%" class="text-start">Nama Mata Pelajaran</th>
                        <th width="13%">Aksi</th>
                    </tr>
                    @foreach ($subcject as $new)
                        <tr>
                            <td width="10%">{{ $loop->iteration }}</td>
                            <td width="81%">{{ $new->subject_name }}</td>
                            <td width="13%">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn-edit-master me-2" data-id="{{ $new->subject_id }}"
                                        onclick=edit_data($(this))><i class="fa fa-edit text-primary"></i></a>
                                    <a data-id="{{ $new->subject_id }}" onclick=delete_data($(this))
                                        class="btn-edit-master">
                                        <i class="fa fa-trash-o text-danger"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-role">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 m-auto" id="modal-title">
                        Tambah Data Mata Pelajaran
                    </h1>
                </div>
                <div class="modal-body">
                    <form id="form-mapel">
                        @csrf
                        <input type="hidden" name="subject_id" id="subject_id" value="">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="subject_name" class="form-label">Mata Pelajaran</label>
                                    <input type="text" name="subject_name" class="form-control" id="subject_name" />
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-permission bg-red-permission me-md-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" id="button-modal" class="btn btn-permission bg-green-permission">
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

        $("#exampleModal").on("hidden.bs.modal", function (e) {
            const reset_form = $('#form-mapel')[0];
            const reset_form_edit = $('#form_edit_data')[0];
            $(reset_form).removeClass('was-validated');
            $(reset_form_edit).removeClass('was-validated');
            let uniqueField = ["subject_name"]
            for (let i = 0; i < uniqueField.length; i++) {
            $("#" + uniqueField[i]).removeClass('was-validated');
            $("#" + uniqueField[i]).removeClass("is-invalid");
            $("#" + uniqueField[i]).removeClass("invalid-more");
            }
        });

        $(document).ready(function () {
            document.getElementById("add-subject").addEventListener("click", function () {
                document.getElementById("form-mapel").reset();
                $("#modal-title").html("Tambah Data Mata Pelajaran");
                document.getElementById("subject_id").value = null;
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        Array.prototype.filter.call($('#form-mapel'), function (form) {
            form.addEventListener('submit', function (event) {
            event.preventDefault();

            let subject_id = $("#subject_id").val();

            var url = (subject_id !== undefined && subject_id !== null) && subject_id ? "{{ url('subject')}}" + "/" + subject_id : "{{ url('subject')}}"+ "/addsubject";
            $.ajax({
                url: url,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: $('#form-mapel').serialize(),
                // contentType: 'application/json',
                processData: false,
                success: function (response) {
                console.log(response)
                    setTimeout(() => {
                                $("#subject-table").load(window.location.href +
                                    " #subject-table");
                            }, 0);
                    $('#exampleModal').modal('hide');
                    var reset_form = $('#form-mapel')[0];
                    $(reset_form).removeClass('was-validated');
                    reset_form.reset();
                    $('#exampleModal').modal('hide');
                    $("#modal-title").html("Tambah Data Mata Pelajaran")
                    $("#subject_id").val()
                },
                error: function (xhr) {
                console.log(xhr.responseText);
                }
            });
            });
        });

        function edit_data(e) {
            $('#exampleModal').modal('show')
            var url = "{{url('subject')}}" + "/" + e.attr('data-id') + "/" + "edit"
            $.ajax({
                url: url,
                method: "GET",
                // dataType: "json",
                success: function (result) {
                    $("#modal-title").html("Edit Mata Pelajaran")
                    $("#button-modal").html("Edit")
                    $('#subject_id').val(result.subject_id).trigger('change');
                    $('#subject_name').val(result.subject_name);
                },
                error: function (xhr) {
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

            }).then(function (result) {

            if (result.value) {

                var id = e.attr('data-id');
                jQuery.ajax({
                url: "{{url('/subject/delete-subject')}}" + "/" + id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete'
                },
                success: function (result) {

                    if (result.error) {

                    Swal.fire({
                        type: "error",
                        title: 'Oops...',
                        text: result.message,
                        confirmButtonClass: 'btn btn-success',
                    })

                    } else {

                        setTimeout(() => {
                                $("#subject-table").load(window.location.href +
                                    " #subject-table");
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
@endpush
