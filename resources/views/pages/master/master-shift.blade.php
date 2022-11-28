@extends('layouts.master')
@section('title', 'Master Shift')
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
                <li class="breadcrumb-item" aria-current="page">Data Master</li>
                <li class="breadcrumb-item" aria-current="page">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/internal-images/icon-shift.png') }}"
                            class="d-flex align-items-center me-1" width="16px" height="16px" alt=""> Data
                        Shift
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Shitt</h5>
        <div class="d-md-flex align-items-md-center justify-content-md-between mt-2">
            <div class="d-md-flex align-content-md-center">
                <button class="btn-create" id="add-workshift" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                </button>
            </div>
            <div class="form-search">
                <input type="search" name="" id="" placeholder="pencarian" />
            </div>
        </div>
        <div class="outher-table">
            <div class="table-scroll">
                <table id="table-workshift" class="table-master" style="border: 1px solid black">
                    <tr>
                        <th width="8%">No</th>
                        <th width="22%">Nama Shift</th>
                        <th width="20%">Petugas</th>
                        <th width="10%">Jam Mulai</th>
                        <th width="10%">Jam Selesai</th>
                        <th width="15%">Batas Kedatangan</th>
                        <th width="150px">Aksi</th>
                    </tr>
                    @foreach ( $shifts as $new )
                        <tr>
                            <td width="8%">{{ $loop->iteration }}</td>
                            <td width="22%">{{ $new->shift_name }}</td>
                            <td width="10%">{{ $new->start_time }}</td>
                            <td width="10%">{{ $new->end_time }}</td>
                            <td width="16%">{{ $new->max_arrival }}</td>
                            <td width="150px">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a  class="btn-edit-master me-2" data-id="{{ $new->workshift_id }}" onclick=edit_data($(this))><i class="fa fa-edit text-primary"></i></a>
                                    <a data-id="{{ $new->workshift_id }}" onclick=delete_data($(this)) class="btn-edit-master">
                                        <i class="fa fa-trash-o text-danger"></i>
                                    </a>
                                </div>
                                <ul class="dropdown-menu dropdown-name">
                                    <li>
                                        Ajiz Bilar
                                    </li>
                                    <li>
                                        Ajiz Bilar
                                    </li>
                                    <li>
                                        Ajiz Lesti
                                    </li>
                                    <li>
                                        Ajiz Lesti Bilar
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td width="10%">08:00</td>
                        <td width="10%">16:00</td>
                        <td width="16%">09:00</td>
                        <td width="150px">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="" class="btn-edit-master me-2">
                                    <i class="fa fa-edit text-primary"></i>
                                </a>
                                <a href="" class="btn-edit-master">
                                    <i class="fa fa-trash-o text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
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
                        Tambah Data Shift
                    </h1>
                </div>
                <div class="modal-body">
                    <form id="form-workshift">
                        @csrf
                        <input type="hidden" name="workshift_id" id="workshift_id" value="">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="shift_name" class="form-label">Nama Shift</label>
                                    <input type="text" name="shift_name" class="form-control" id="shift_name" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="" class="form-label">Petugas</label>
                                <div class="select-cekbox" id="select-cekbox">
                                    --- Pilih Petugas ---
                                </div>
                                <div class="down-form-shift">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="ceklist-ready">
                                </div>
                                <div class="ceklist">
                                    <div class="cekbox-permission">
                                        <label class="checkbox" id="labelCekbox">Aziz Taher
                                            <input type="checkbox" name="" id="cekboxAnggota" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox" id="labelCekbox">Aziz saudara aldi taher
                                            <input type="checkbox" name="" id="cekboxAnggota" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox" id="labelCekbox">Lorem, ipsum dolor.
                                            <input type="checkbox" name="" id="cekboxAnggota" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox" id="labelCekbox">Lesti Pranaja
                                            <input type="checkbox" name="" id="cekboxAnggota" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox" id="labelCekbox">Lesti Pranaja
                                            <input type="checkbox" name="" id="cekboxAnggota" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox" id="labelCekbox">Lesti Pranaja
                                            <input type="checkbox" name="" id="cekboxAnggota" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="start_time" class="form-label">Jam Mulai</label>
                                <input type="time" name="start_time" id="start_time" class="form-control">
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="end_time" class="form-label">Jam Akhir</label>
                                <input type="time" name="end_time" id="end_time" class="form-control">
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="max_arrival" class="form-label">Batas Waktu Kedatangan</label>
                                <input type="time" name="max_arrival" id="max_arrival" class="form-control">
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

        $(document).ready(function () {
            document.getElementById("add-workshift").addEventListener("click", function () {
                document.getElementById("form-workshift").reset();
                $("#modal-title").html("Tambah Data Jadwal Kerja");
                document.getElementById("workshift_id").value = null;
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })

        Array.prototype.filter.call($('#form-workshift'), function (form) {
            form.addEventListener('submit', function (event) {
            event.preventDefault();

            let workshift_id = $("#workshift_id").val();

            var url = (workshift_id !== undefined && workshift_id !== null) && workshift_id ? "{{ url('workshift')}}" + "/" + workshift_id : "{{ url('workshift')}}"+ "/addshift";
            $.ajax({
                url: url,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: $('#form-workshift').serialize(),
                // contentType: 'application/json',
                processData: false,
                success: function (response) {
                console.log(response)
                    setTimeout(() => {
                                $("#table-workshift").load(window.location.href +
                                    " #table-workshift");
                            }, 0);
                    $('#exampleModal').modal('hide');
                    var reset_form = $('#form-workshift')[0];
                    $(reset_form).removeClass('was-validated');
                    reset_form.reset();
                    $('#exampleModal').modal('hide');
                    $("#modal-title").html("Tambah Data Jadwal Kerja")
                    $("#workshift_id").val()
                },
                error: function (xhr) {
                console.log(xhr.responseText);
                }
            });
            });
        });

        function edit_data(e) {
            $('#exampleModal').modal('show')
            var url = "{{url('workshift')}}" + "/" + e.attr('data-id') + "/" + "edit"
            $.ajax({
                url: url,
                method: "GET",
                // dataType: "json",
                success: function (result) {
                    $("#modal-title").html("Edit Jadwal Kerja")
                    $("#button-modal").html("Edit")
                    $('#workshift_id').val(result.workshift_id).trigger('change');
                    $('#shift_name').val(result.shift_name);
                    $('#start_time').val(result.start_time);
                    $('#end_time').val(result.end_time);
                    $('#max_arrival').val(result.max_arrival);
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
                url: "{{url('/workshift/delete-shift')}}" + "/" + id,
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
                                $("#table-workshift").load(window.location.href +
                                    " #table-workshift");
                            }, 0);

                    Swal.fire({
                        type: "success",
                        title: 'Deleted!',
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
