@extends('layouts.master')
@section('title', 'Master Ekstrakulikuler')
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
                        <img src="{{ asset('images/internal-images/icon-extra.png') }}"
                            class="d-flex align-items-center me-1" width="16px" height="16px" alt=""> Data
                        Ekstrakulikuler
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Ekstrakulikuler</h5>
        <div class="d-md-flex align-items-md-center justify-content-md-between mt-2">
            <div class="d-md-flex align-content-md-center">
                <button class="btn-create" id="add-extra" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                </button>
            </div>
        </div>
        <div class="outher-table" id="extra-table">
            {{-- <div class="table-scroll">
                <table class="table-master" style="border: 1px solid black">
                    <tr>
                        <th width="11%">No</th>
                        <th width="70%" class="text-start">Nama Ekstrakulikuler</th>
                        <th width="200px">Aksi</th>
                    </tr>
                    @foreach ($extra as $new)
                        <tr>
                            <td width="11%">{{ $loop->iteration }}</td>
                            <td width="70%" class="text-start">{{ $new->extracurricular_name }}</td>
                            <td width="200px">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn-edit-master me-2" data-id="{{ $new->extracurricular_id }}"
                                        onclick=edit_data($(this))><i class="fa fa-edit text-primary"></i></a>
                                    <a data-id="{{ $new->extracurricular_id }}" onclick=delete_data($(this))
                                        class="btn-edit-master">
                                        <i class="fa fa-trash-o text-danger"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div> --}}
            <table id="master-extra" class="display" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width:10%" class="text-center">No</th>
                        <th style="width:70%" class="text-start">Nama Ekstrakulikuler</th>
                        <th style="width:20%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($extra as $new)
                        <tr>
                            <td class="text-center align-items-center " style="width: 10%">{{ $loop->iteration }}</td>
                            <td style="width:70%" class="text-start">{{ $new->extracurricular_name }}</td>
                            <td style="width:20%">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a class="btn-edit-master me-2" data-id="{{ $new->extracurricular_id }}"
                                        onclick=edit_data($(this))><i class="fa fa-edit text-primary"></i></a>
                                    <a data-id="{{ $new->extracurricular_id }}" onclick=delete_data($(this))
                                        class="btn-edit-master">
                                        <i class="fa fa-trash-o text-danger"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
                        Tambah Data Ekstrakurikuler
                    </h1>
                </div>
                <div class="modal-body">
                    <form id="form-extra">
                        @csrf
                        <input type="hidden" name="extracurricular_id" id="extracurricular_id" value="">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="extracurricular_name" class="form-label">Nama Ekstrakulikuler</label>
                                    <input type="text" name="extracurricular_name" class="form-control"
                                        id="extracurricular_name" />
                                </div>
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
            $('#master-extra').DataTable({
                scrollY: '60vh',
                scrollCollapse: true,
                paging: false,
            });
        });
        window.addEventListener("load", function() {
            const input = document.querySelector("#master-extra_filter");
            const elemenInput = input.children[0].children[0];
            elemenInput.setAttribute("placeholder", "pencarian")
            input.children[0].childNodes[0].textContent = " ";
        });
    </script>
    <script>
        $("#exampleModal").on("hidden.bs.modal", function(e) {
            const reset_form = $('#form-extra')[0];
            const reset_form_edit = $('#form_edit_data')[0];
            $(reset_form).removeClass('was-validated');
            $(reset_form_edit).removeClass('was-validated');
            let uniqueField = ["extracurricular_name"]
            for (let i = 0; i < uniqueField.length; i++) {
                $("#" + uniqueField[i]).removeClass('was-validated');
                $("#" + uniqueField[i]).removeClass("is-invalid");
                $("#" + uniqueField[i]).removeClass("invalid-more");
            }
        });

        $(document).ready(function() {
            document.getElementById("add-extra").addEventListener("click", function() {
                document.getElementById("form-extra").reset();
                $("#modal-title").html("Tambah Data Ekstrakurikuler");
                document.getElementById("extracurricular_id").value = null;
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })

        Array.prototype.filter.call($('#form-extra'), function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                let extra_id = $("#extracurricular_id").val();

                var url = (extra_id !== undefined && extra_id !== null) && extra_id ?
                    "{{ url('ekstrakurikuler') }}" + "/" + extra_id : "{{ url('ekstrakurikuler') }}" +
                    "/addekstra";
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    data: $('#form-extra').serialize(),
                    // contentType: 'application/json',
                    processData: false,
                    success: function(response) {
                        console.log(response)
                        setTimeout(() => {
                            $("#extra-table").load(window.location.href +
                                " #extra-table");
                        }, 0);
                        $('#exampleModal').modal('hide');
                        var reset_form = $('#form-extra')[0];
                        $(reset_form).removeClass('was-validated');
                        reset_form.reset();
                        $('#exampleModal').modal('hide');
                        $("#modal-title").html("Tambah Data Ekstrakurikuler")
                        $("#extracurricular_id").val()
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        function edit_data(e) {
            $('#exampleModal').modal('show')
            var url = "{{ url('ekstrakurikuler') }}" + "/" + e.attr('data-id') + "/" + "edit"
            $.ajax({
                url: url,
                method: "GET",
                // dataType: "json",
                success: function(result) {
                    $("#modal-title").html("Edit Ekstrakurikuler")
                    $("#button-modal").html("Edit")
                    $('#extracurricular_id').val(result.extracurricular_id).trigger('change');
                    $('#extracurricular_name').val(result.extracurricular_name);
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
                        url: "{{ url('/ekstrakurikuler/delete-ekstra') }}" + "/" + id,
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
                                    $("#extra-table").load(window.location.href +
                                        " #extra-table");
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
