@extends('layouts.master')
@section('title', 'Master Kelas')
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
                        <i class="fa fa-user-o me-1"></i> Data Kelas
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Kelas</h5>
        <div class="d-md-flex align-items-md-center justify-content-md-between mt-2">

            <button class="btn-create" id="add-grade" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Data
            </button>
            <div class="form-search">
                <input type="text" name="" id="search" placeholder="Cari Kelas" />
            </div>

        </div>
        <div class="outher-table" id="grade-table">
            <div class="table-scroll">
                <table id="master-kelas" class="table-master" style="width:100%;">
                    <thead>
                        <tr>
                            <th style="width:10%" class="text-center">No</th>
                            <th style="width:30%" class="text-center">Nama Kelas</th>
                            <th style="width:45%" class="text-center">Wali kelas</th>
                            <th style="width:15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($grades as $new)
                            <tr>
                                <td class="text-center align-items-center " style="width: 10%">{{ $loop->iteration }}</td>
                                <td style="width:30%">{{ $new->grade_name }}</td>
                                <td style="width:45%">{{ $new->first_name . ' ' . $new->last_name }}</td>
                                <td style="width:15%">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="btn-edit-master me-2" data-id="{{ $new->grade_id }}"
                                            onclick=edit_data($(this))><i class="fa fa-edit text-primary"></i></a>
                                        <a data-id="{{ $new->grade_id }}" onclick=delete_data($(this))
                                            class="btn-edit-master">
                                            <i class="fa fa-trash-o text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Tidak ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
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
                    <h1 class="modal-title fs-5 m-auto" id="exampleModalLabel">
                        Tambah Data Kelas
                    </h1>
                </div>
                <div class="modal-body">
                    <form id="form-grade">
                        @csrf
                        <input type="hidden" name="grade_id" id="grade_id" value="">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="grade_name" class="form-label">Nama Kelas</label>
                                <input type="text" name="grade_name" class="form-control" id="grade_name" />
                            </div>
                            <div class="col-12 nb-3">
                                <label for="status" class="form-label">Wali Kelas</label>
                                <select class="form-select" name="teacher_id" id="basic-usage"
                                    data-placeholder="--Pilih Wali Kelas ---">
                                    <option></option>
                                    @foreach ($teacher as $new)
                                        <option value="{{ $new->employee_id }}">
                                            {{ $new->first_name . ' ' . $new->last_name }}
                                        </option>
                                    @endforeach
                                </select>
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
    </div>
@endsection

@push('addon-javascript')
    <script>
        const inpuTSearch = document.querySelector("#search");
        inpuTSearch.addEventListener("keyup", searchDataTable);

        function searchDataTable() {
            let filter, table, tr, td, i, txtValue;
            filter = inpuTSearch.value.toUpperCase();
            table = document.querySelector("#master-kelas");
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
        $("#exampleModal").on("hidden.bs.modal", function(e) {
            const reset_form = $('#form-grade')[0];
            $(reset_form).removeClass('was-validated');
            $("#grade_id").val("");
            $("#basic-usage").val("").change();
            $("#form-grade").trigger("reset")
            let uniqueField = ["grade_name"]
            for (let i = 0; i < uniqueField.length; i++) {
                $("#" + uniqueField[i]).removeClass('was-validated');
                $("#" + uniqueField[i]).removeClass("is-invalid");
                $("#" + uniqueField[i]).removeClass("invalid-more");
            }
        });

        $(document).ready(function() {
            $('#basic-usage').select2({
                theme: "bootstrap-5",
                width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                    'style',
                placeholder: $(this).data('placeholder'),
                dropdownParent: $('#exampleModal'),
            });

            document.getElementById("add-grade").addEventListener("click", function() {
                document.getElementById("form-grade").reset();
                $("#modal-title").html("Tambah Data Kelas");
                document.getElementById("grade_id").value = null;
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })

        Array.prototype.filter.call($('#form-grade'), function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                let grade_id = $("#grade_id").val();

                var url = (grade_id !== undefined && grade_id !== null) && grade_id ?
                    "{{ url('grade') }}" + "/" + grade_id : "{{ url('grade') }}" + "/addgrade";
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    data: $('#form-grade').serialize(),
                    // contentType: 'application/json',
                    processData: false,
                    success: function(response) {
                        console.log(response)
                        setTimeout(() => {
                            $("#grade-table").load(window.location.href +
                                " #grade-table");
                        }, 0);
                        $('#exampleModal').modal('hide');
                        var reset_form = $('#form-grade')[0];
                        $(reset_form).removeClass('was-validated');
                        reset_form.reset();
                        $('#exampleModal').modal('hide');
                        $("#modal-title").html("Tambah Data Kelas")
                        $("#grade_id").val()
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        function edit_data(e) {
            $('#exampleModal').modal('show')
            var url = "{{ url('grade') }}" + "/" + e.attr('data-id') + "/" + "edit"
            $.ajax({
                url: url,
                method: "GET",
                // dataType: "json",
                success: function(result) {
                    $("#modal-title").html("Edit Jadwal Kerja")
                    $("#button-modal").html("Edit")
                    $('#grade_id').val(result.grade_id).trigger('change');
                    $('#grade_name').val(result.grade_name);
                    $('#basic-usage').val(result.teacher_id).trigger('change');
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
                        url: "{{ url('/grade/delete-grade') }}" + "/" + id,
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
                                    $("#grade-table").load(window.location.href +
                                        " #grade-table");
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
