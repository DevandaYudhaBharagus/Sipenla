@extends('layouts.master')

@section('title', 'Master Pegawai')
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
        <div class="outher-table" id="employee-table">
            <div class="table-scroll">
                <table class="table-master">
                    <tr>
                        <th width="50px">No</th>
                        <th width="250px">Nama Depan</th>
                        <th width="250px">Nama Belakang</th>
                        <th width="250px">NUPTK / ID Pegawai</th>
                        <th width="250px">NPSN</th>
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
                        <th width="250px">Aksi</th>
                    </tr>
                    @foreach ($employees as $employee)
                    <tr>
                        <td width="50px">{{ $loop->iteration }}</td>
                        <td width="250px">
                            {{ $employee->first_name }}
                        </td>
                        <td width="250px">{{ $employee->last_name }}</td>
                        <td width="250px">{{ $employee->nuptk }}</td>
                        <td width="250px">{{ $employee->npsn }}</td>
                        <td width="250px">{{ $employee->place_of_birth }}</td>
                        <td width="250px">{{ $employee->date_of_birth }}</td>
                        <td width="250px">{{ $employee->gender }}</td>
                        <td width="250px">{{ $employee->religion }}</td>
                        <td width="500px">{{ $employee->address }}</td>
                        <td width="250px">{{ $employee->education }}</td>
                        <td width="250px">{{ $employee->family_name }}</td>
                        <td width="500px">{{ $employee->family_address }}</td>
                        <td width="250px">{{ $employee->email }}</td>
                        <td width="250px">{{ $employee->position }}</td>
                        <td width="250px">{{ $employee->shift_name }}</td>
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
                                            @if(!$employee->image)
                                                <img src="{{ asset('images/internal-images/berita-terbaru.jpg') }}" alt="" />
                                            @else
                                                <img src="{{ $employee->image }}" alt="" />
                                            @endif
                                            <div class="d-flex align-items-center edit-master justify-content-end">
                                                <form action="{{ url('/employee'.'/photo/'.$employee->employee_id) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                    <input type="file" name="profile_employee" class="form-control" id="fotoSiswa"
                                                        style="display: none" multiple />
                                                    <button class="btn-edit-master" type="button" onclick="uploadPhotoSiswa()">
                                                        <i class="fa fa-edit text-primary"></i>
                                                    </button>
                                                </form>
                                                <a href="{{ url('/employee'.'/photo/'.$employee->employee_id) }}" class="btn-edit-master">
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
                                <a  class="btn-edit-master me-2" data-id="{{ $employee->employee_id }}" onclick=edit_data($(this))><i class="fa fa-edit text-primary"></i></a>
                                <a data-id="{{ $employee->user_id }}" onclick=delete_data($(this)) class="btn-edit-master">
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
                    <h1 class="modal-title fs-5 m-auto" id="modal-title">Tambah Data Pegawai</h1>
                </div>
                <div class="modal-body">
                    <form id="form-employee">
                        @csrf
                        <input type="hidden" name="employee_id" id="employee_id" value="">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="first_name" class="form-label">Nama Depan</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="last_name" class="form-label">Nama Belakang</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="nuptk" class="form-label">NUPTK / ID Pegawai</label>
                                    <input type="text" name="nuptk" class="form-control" id="nuptk" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="npsn" class="form-label">NPSN</label>
                                    <input type="text" name="npsn" class="form-control" id="npsn" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="place_of_birth" class="form-label">Tempat Lahir</label>
                                    <input type="text" name="place_of_birth" class="form-control" id="place_of_birth" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="date_of_birth" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="gender" id="gender" aria-label="Default select example">
                                    <option selected>--- Pilih Jenis Kelamin ---</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div class="down-form">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="religion" class="form-label">Agama</label>
                                    <input type="text" name="religion" class="form-control" id="religion" />
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat Tinggal</label>
                                    <textarea class="form-control" name="address" id="address" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="education" class="form-label">Riwayat Pendidikan</label>
                                    <input type="text" name="education" class="form-control" id="education" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="family_name" class="form-label">Nama Ibu</label>
                                    <input type="text" name="family_name" class="form-control" id="family_name" />
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="mb-3">
                                    <label for="family_address" class="form-label">Alamat Orang Tua</label>
                                    <textarea class="form-control" name="family_address" id="family_address" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Jabatan</label>
                                    <input type="text" name="position" class="form-control" id="position" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="workshift_id" class="form-label">Shift Kerja</label>
                                <select class="form-select" name="workshift_id" id="workshift_id" data-dropdown-parent="body" data-placeholder="Pilih Shift Kerja">
                                    <option selected disabled value=''>--- Pilih Shift ---</option>
                                    @foreach ( $workshift as $test )
                                        <option value="{{ $test->workshift_id }}">{{ $test->shift_name }}</option>
                                    @endforeach
                                </select>
                                <div class="down-form">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <input type="file" name="" id="image-master" style="display: none" multiple />
                                <div class="mb-3">
                                    <div class="box-image-upload-master">
                                        <label for="" class="form-label">Foto</label>
                                        <img id="image-edit" src="{{ asset('images/internal-images/no-img.png') }}" alt="">
                                        <div class="d-flex align-items-center justify-content-end edit-upload-book">
                                            <button type="button" class="btn-edit-master me-2" onclick="uploadImage()">
                                                <i class="fa fa-edit text-primary"></i>
                                            </button>
                                            <a href="" class="btn-edit-master">
                                                <i class="fa fa-trash-o text-danger"></i>
                                            </a>
                                        </div>
                                    </div>
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
        function uploadImage() {
            document.querySelector("#image-master").click();
        }
        function uploadPhotoSiswa() {
            document.querySelector("#fotoSiswa").click();
        }

        $(document).ready(function () {

            $( '#workshift_id' ).select2( {
                theme: "bootstrap-5",
                width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
                placeholder: $( this ).data( 'placeholder' ),
                dropdownParent: $('#exampleModal'),
            } );

            $( '#gender' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            dropdownParent: $('#exampleModal'),
        } );

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })

        Array.prototype.filter.call($('#form-employee'), function (form) {
            form.addEventListener('submit', function (event) {
            event.preventDefault();

            let employee_id = $("#employee_id").val();

            var url = (employee_id !== undefined && employee_id !== null) && employee_id ? "{{ url('employee')}}" + "/" + employee_id : "{{ url('employee')}}";
            $.ajax({
                url: url,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'post',
                data: $('#form-employee').serialize(),
                // contentType: 'application/json',
                processData: false,
                success: function (response) {
                console.log(response)
                    setTimeout(() => {
                                $("#employee-table").load(window.location.href +
                                    " #employee-table");
                            }, 0);
                    $('#exampleModal').modal('hide');
                    var reset_form = $('#form-employee')[0];
                    $(reset_form).removeClass('was-validated');
                    reset_form.reset();
                    $('#exampleModal').modal('hide');
                    $("#modal-title").html("Tambah Data Pegawai")
                    $("#employee_id").val()
                },
                error: function (xhr) {
                console.log(xhr.responseText);
                }
            });
            });
        });

        function edit_data(e) {
            $('#exampleModal').modal('show')
            var url = "{{url('employee')}}" + "/" + e.attr('data-id') + "/" + "edit"
            $.ajax({
                url: url,
                method: "GET",
                // dataType: "json",
                success: function (result) {
                    $("#modal-title").html("Edit Pegawai")
                    $("#button-modal").html("Edit")
                    $('#employee_id').val(result.employee_id).trigger('change');
                    $('#first_name').val(result.first_name);
                    $('#last_name').val(result.last_name);
                    $('#nuptk').val(result.nuptk);
                    $('#npsn').val(result.npsn);
                    $('#place_of_birth').val(result.place_of_birth);
                    $('#date_of_birth').val(result.date_of_birth);
                    $('#gender').val(result.gender).trigger('change');
                    $('#address').val(result.address);
                    $('#religion').val(result.religion);
                    $('#education').val(result.education);
                    $('#position').val(result.position);
                    $('#family_name').val(result.family_name);
                    $('#family_address').val(result.family_address);
                    $('#workshift_id').val(result.workshift_id).trigger('change');
                    if(result.image !== null){
                        document.getElementById("image-edit").src =result.image;
                    }
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
                url: "{{url('/employee')}}" + "/" + id,
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
                                $("#employee-table").load(window.location.href +
                                    " #employee-table");
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
