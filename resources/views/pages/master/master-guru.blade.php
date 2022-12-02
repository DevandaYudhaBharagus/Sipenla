@extends('layouts.master')

@section('title', 'Master Guru')
@section('meta_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="box-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center"><i class="material-icons">home</i> Beranda</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Data Master</li>
                <li class="breadcrumb-item" aria-current="page">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-user-plus me-1"></i> Data User
                    </div>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-user-plus me-1"></i> Data Guru
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Guru</h5>
        <div class="d-md-flex align-items-md-center justify-content-md-between mt-2">
            <div class="d-md-flex align-content-md-center">
                <a href="" class="btn-excel">Export Excel</a>
                <button class="btn-create" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                </button>
            </div>
            <div class="form-search">
                <input type="search" name="" id="" placeholder="pencarian" />
            </div>
        </div>
        <div class="outher-table" id="teacher-table">
            <div class="table-scroll">
                <table class="table-master">
                    <tr>
                        <th width="50px" style="border-left: none">No</th>
                        <th width="250px">Nama Depan</th>
                        <th width="250px">Nama Belakang</th>
                        <th width="250px">NUPTK / ID Pegawai</th>
                        <th width="250px">NIPSN</th>
                        <th width="250px">Tempat Lahir</th>
                        <th width="250px">Tanggal Lahir</th>
                        <th width="250px">Jenis Kelamin</th>
                        <th width="250px">Agama</th>
                        <th width="500px">Alamat Tinggal</th>
                        <th width="250px">Riwayat Pendidikan</th>
                        <th width="250px">Nama Ibu</th>
                        <th width="500px">Alamat Orang Tua</th>
                        <th width="250px">Email</th>
                        <th width="250px">Jabatan 1</th>
                        <th width="250px">Shift Kerja</th>
                        <th width="250px">Foto</th>
                        <th width="250px" style="border-right: none">Aksi</th>
                    </tr>
                    @foreach ( $teacher as $new )
                    <tr>
                            <td width="50px" class="no-border">{{ $loop->iteration }}</td>
                            <td width="250px">
                                {{ $new->first_name }}
                            </td>
                            <td width="250px">{{ $new->last_name }}</td>
                            <td width="250px"> {{ $new->nuptk }}</td>
                            <td width="250px"> {{ $new->npsn }}</td>
                            <td width="250px"> {{ $new->place_of_birth }}</td>
                            <td width="250px">{{ $new->date_of_birth }}</td>
                            <td width="250px">{{ $new->gender }}</td>
                            <td width="250px">{{ $new->religion }}</td>
                            <td width="500px">{{ $new->address }}</td>
                            <td width="250px">{{ $new->education }}</td>
                            <td width="250px">{{ $new->family_name }}</td>
                            <td width="500px">{{ $new->family_address }}</td>
                            <td width="250px">{{ $new->email }}</td>
                            <td width="250px">{{ $new->position }}</td>
                            <td width="250px">{{ $new->shift_name }}</td>
                            <td width="250px">
                                <div class="dropdown">
                                    <div class="btn btn-foto-master m-auto" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <div class="icon-foto-master">
                                            <img src="{{ asset('images/internal-images/foto-master.png') }}" alt="" />
                                        </div>
                                        <div class="fa fa-angle-down"></div>
                                    </div>
                                    <ul class="dropdown-menu dropdown-foto">
                                        <li>
                                            <h6>Foto</h6>
                                            <div class="box-foto-master">
                                                @if(!$new->image)
                                                    <img src="../../images/pengumuman.jpg" alt="" />
                                                    @else
                                                    <img src="{{ $new->image }}" alt="" />
                                                @endif
                                                <div class="d-flex align-items-center edit-master justify-content-end">
                                                    <a href="" class="btn-edit-master">
                                                        <i class="fa fa-edit text-primary"></i>
                                                    </a>
                                                    <a href="" class="btn-edit-master">
                                                        <i class="fa fa-trash-o text-danger"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td width="250px">
                                <div class="d-flex align-items-center justify-content-center">
                                    <a href="" class="btn-edit-master me-2">
                                        <i class="fa fa-edit text-primary"></i>
                                    </a>
                                    <a data-id="{{ $new->user_id }}" onclick=delete_data($(this)) class="btn-edit-master">
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">...</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
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
                url: "{{url('/teacher/delete-teacher')}}" + "/" + id,
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
                                $("#teacher-table").load(window.location.href +
                                    " #teacher-table");
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
