@extends('layouts.master')

@section('title', 'Master Siswa')
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
                <li class="breadcrumb-item" aria-current="page">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/internal-images/icon-master.png') }}"
                            class="d-flex align-items-center me-1" width="16px" height="16px" alt=""> Data
                        Master
                    </div>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-user-plus me-1"></i> Data User
                    </div>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-user-plus me-1"></i> Data Siswa
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Siswa</h5>
        <div class="d-md-flex align-items-md-center justify-content-md-between mt-2">
            <div class="d-md-flex align-content-md-center">
                <a href="" class="btn-excel">Export Excel</a>
                {{-- <button class="btn-create" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                </button> --}}
            </div>
            <div class="form-search">
                <input type="search" name="" id="" placeholder="pencarian" />
            </div>
        </div>
        @if (count($student) !== 0)
            <div class="outher-table" id="table-student">
                <div class="table-scroll">
                    <table class="table-master">
                        <tr>
                            <th width="50px">No</th>
                            <th width="250px">Nama Depan</th>
                            <th width="250px">Nama Belakang</th>
                            <th width="250px">NISN</th>
                            <th width="250px">Tempat Lahir</th>
                            <th width="250px">Tanggal Lahir</th>
                            <th width="250px">Jenis Kelamin</th>
                            <th width="250px">Agama</th>
                            <th width="500px">Alamat Tinggal</th>
                            <th width="250px">Asal Sekolah</th>
                            <th width="250px">Kelas</th>
                            <th width="250px">Tanggal Diterima</th>
                            <th width="250px">Nama Ayah</th>
                            <th width="250px">Nama Ibu</th>
                            <th width="500px">Alamat Orang Tua</th>
                            <th width="250px">Pekerjaan Ayah</th>
                            <th width="250px">Pekerjaan Ibu</th>
                            <th width="250px">Pendidikan Terakhir Ayah</th>
                            <th width="250px">Pendidikan Terakhir Ibu</th>
                            <th width="250px">Nama Wali</th>
                            <th width="500px">Alamat Wali</th>
                            <th width="250px">Pekerjaan Wali</th>
                            <th width="250px">Ekstrakulikuler</th>
                            <th width="250px">Foto</th>
                            <th width="250px">Aksi</th>
                        </tr>
                        {{-- start looping atbel master --}}
                        @foreach ($student as $new)
                            <tr>
                                <td width="50px">{{ $loop->iteration }}</td>
                                <td width="250px">
                                    {{ $new->first_name }}
                                </td>
                                <td width="250px">{{ $new->last_name }}</td>
                                <td width="250px">{{ $new->nisn }}</td>
                                <td width="250px">{{ $new->place_of_birth }}</td>
                                <td width="250px">{{ $new->date_of_birth }}</td>
                                <td width="250px">{{ $new->gender }}</td>
                                <td width="250px">{{ $new->religion }}</td>
                                <td width="500px">{{ $new->address }}</td>
                                <td width="250px">{{ $new->school_now }}</td>
                                <td width="250px">{{ $new->grade_name }}</td>
                                <td width="250px">{{ $new->date_school_now }}</td>
                                <td width="250px">{{ $new->father_name }}</td>
                                <td width="250px">{{ $new->mother_name }}</td>
                                <td width="500px">{{ $new->parent_address }}</td>
                                <td width="250px">{{ $new->father_profession }}</td>
                                <td width="250px">{{ $new->mother_profession }}</td>
                                <td width="250px">{{ $new->father_education }}</td>
                                <td width="250px">{{ $new->mother_education }}</td>
                                <td width="250px">{{ $new->family_name }}</td>
                                <td width="500px">{{ $new->family_address }}</td>
                                <td width="250px">{{ $new->family_profession }}</td>
                                <td width="250px">{{ $new->extracurricular_name }}</td>
                                <td width="250px">
                                    <div class="dropdown">
                                        <div class="btn btn-foto-master m-auto" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <div class="icon-foto-master">
                                                <img src="{{ asset('images/internal-images/foto-master.png') }}"
                                                    alt="" />
                                            </div>
                                            <div class="fa fa-angle-down"></div>
                                        </div>
                                        <ul class="dropdown-menu dropdown-foto">
                                            <li>
                                                <h6>Foto</h6>
                                                <div class="box-foto-master">
                                                    @if (!$new->image)
                                                        <img src="{{ asset('images/internal-images/no-img.png') }}"
                                                            alt="" />
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
                                        <a class="btn-edit-master me-2" data-id="{{ $new->student_id }}"
                                            onclick=edit_data($(this))><i class="fa fa-edit text-primary"></i></a>
                                        <a class="btn-edit-master me-2" data-id="{{ $new->user_id }}"
                                            onclick=delete_data($(this))><i class="fa fa-trash-o text-danger"></i></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        {{-- end looping tabel master --}}
                    </table>
                </div>
            </div>
        @else
            <div class="outher-table" id="table-student">
                <div class="table-scroll">
                    <table class="table-master">
                        <tr>
                            <th width="50px">No</th>
                            <th width="250px">Nama Depan</th>
                            <th width="250px">Nama Belakang</th>
                            <th width="250px">NISN</th>
                            <th width="250px">Tempat Lahir</th>
                            <th width="250px">Tanggal Lahir</th>
                            <th width="250px">Jenis Kelamin</th>
                            <th width="250px">Agama</th>
                            <th width="500px">Alamat Tinggal</th>
                            <th width="250px">Asal Sekolah</th>
                            <th width="250px">Kelas</th>
                            <th width="250px">Tanggal Diterima</th>
                            <th width="250px">Nama Ayah</th>
                            <th width="250px">Nama Ibu</th>
                            <th width="500px">Alamat Orang Tua</th>
                            <th width="250px">Pekerjaan Ayah</th>
                            <th width="250px">Pekerjaan Ibu</th>
                            <th width="250px">Pendidikan Terakhir Ayah</th>
                            <th width="250px">Pendidikan Terakhir Ibu</th>
                            <th width="250px">Nama Wali</th>
                            <th width="500px">Alamat Wali</th>
                            <th width="250px">Pekerjaan Wali</th>
                            <th width="250px">Ekstrakulikuler</th>
                            <th width="250px">Foto</th>
                            <th width="250px">Aksi</th>
                        </tr>
                        {{-- start looping atbel master --}}
                        @foreach ($murid as $new)
                            <tr>
                                <td width="50px">{{ $loop->iteration }}</td>
                                <td width="250px">
                                    {{ $new->first_name }}
                                </td>
                                <td width="250px">{{ $new->last_name }}</td>
                                <td width="250px">{{ $new->nisn }}</td>
                                <td width="250px">{{ $new->place_of_birth }}</td>
                                <td width="250px">{{ $new->date_of_birth }}</td>
                                <td width="250px">{{ $new->gender }}</td>
                                <td width="250px">{{ $new->religion }}</td>
                                <td width="500px">{{ $new->address }}</td>
                                <td width="250px">{{ $new->school_now }}</td>
                                <td width="250px">-</td>
                                <td width="250px">{{ $new->date_school_now }}</td>
                                <td width="250px">{{ $new->father_name }}</td>
                                <td width="250px">{{ $new->mother_name }}</td>
                                <td width="500px">{{ $new->parent_address }}</td>
                                <td width="250px">{{ $new->father_profession }}</td>
                                <td width="250px">{{ $new->mother_profession }}</td>
                                <td width="250px">{{ $new->father_education }}</td>
                                <td width="250px">{{ $new->mother_education }}</td>
                                <td width="250px">{{ $new->family_name }}</td>
                                <td width="500px">{{ $new->family_address }}</td>
                                <td width="250px">{{ $new->family_profession }}</td>
                                <td width="250px">{{ $new->extracurricular_name }}</td>
                                <td width="250px">
                                    <div class="dropdown">
                                        <div class="btn btn-foto-master m-auto" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <div class="icon-foto-master">
                                                <img src="{{ asset('images/internal-images/foto-master.png') }}"
                                                    alt="" />
                                            </div>
                                            <div class="fa fa-angle-down"></div>
                                        </div>
                                        <ul class="dropdown-menu dropdown-foto">
                                            <li>
                                                <h6>Foto</h6>
                                                <div class="box-foto-master">
                                                    @if (!$new->image)
                                                        <img src="{{ asset('images/internal-images/no-img.png') }}"
                                                            alt="" />
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
                                        <a class="btn-edit-master me-2" data-id="{{ $new->student_id }}"
                                            onclick=edit_data($(this))><i class="fa fa-edit text-primary"></i></a>
                                        <a class="btn-edit-master me-2" data-id="{{ $new->user_id }}"
                                            onclick=delete_data($(this))><i class="fa fa-trash-o text-danger"></i></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        {{-- end looping tabel master --}}
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-role">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 m-auto" id="modal-title">Tambah Data Siswa</h1>
                </div>
                <div class="modal-body">
                    <form id="form-edit">
                        {{csrf_field()}}
                        <input type="hidden" name="student_id" id="student_id" value="">
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
                                    <label for="nisn" class="form-label">NISN</label>
                                    <input type="text" name="nisn" class="form-control" id="nisn" />
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
                                <select class="form-select" name="gender" id="gender">
                                    <option selected>--- Pilih Jenis Kelamin ---</option>
                                    <option value="laki-laki">laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div class="down-form">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="religion" class="form-label">Agama</label>
                                    <input type="text" name="religion" id="religion" class="form-control" />
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="mb-3">
                                    <label for="school_origin" class="form-label">Asal Sekolah</label>
                                    <textarea class="form-control" name="school_origin" id="school_origin" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="date_school_now" class="form-label">Tanggal Diterima</label>
                                    <input type="date" name="date_school_now" id="date_school_now" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="father_name" class="form-label">Nama Ayah</label>
                                    <input type="text" name="father_name" id="father_name" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="mother_name" class="form-label">Nama Ibu</label>
                                    <input type="text" name="mother_name" id="mother_name" class="form-control" />
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="mb-3">
                                    <label for="parent_address" class="form-label">Alamat Orang Tua</label>
                                    <textarea class="form-control" name="parent_address" id="parent_address" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="father_profession" class="form-label">Pekerjaan Ayah</label>
                                    <input type="text" name="father_profession" class="form-control" id="father_profession" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="mother_profession" class="form-label">Pekerjaan Ibu</label>
                                    <input type="text" name="mother_profession" class="form-control" id="mother_profession" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="father_education" class="form-label">Pendidikan Terakhir Ayah</label>
                                    <input type="text" class="form-control" name="father_education" id="father_education" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="mother_education" class="form-label">Pendidikan Terkahir Ibu</label>
                                    <input type="text" class="form-control" id="mother_education" name="mother_education" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="family_name" class="form-label">Nama Wali</label>
                                    <input type="text" class="form-control" id="family_name" name="family_name" />
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="mb-3">
                                    <label for="family_address" class="form-label">Alamat Wali</label>
                                    <textarea class="form-control" id="family_address" name="family_address" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="family_profession" class="form-label">Pekerjaan Wali</label>
                                    <input type="text" class="form-control" id="family_profession" name="family_profession" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="extracurricular_id" class="form-label">Ekstrakulikuler</label>
                                <select class="form-select" name="extracurricular_id" id="extracurricular_id" data-dropdown-parent="body" data-placeholder="Pilih Extracurricular">
                                    <option selected disabled value=''>--- Pilih Ekstrakulikuler ---</option>
                                    @foreach ($extra as $test)
                                            <option value="{{ $test->extracurricular_id }}">{{ $test->extracurricular_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <input type="file" name="" id="image-master" style="display: none" multiple />
                                <div class="mb-3">
                                    <div class="box-image-upload-master">
                                        <label for="" class="form-label">Foto</label>
                                        <img id="image" src="{{ asset('images/internal-images/no-img.png') }}" alt="">
                                        <div class="d-flex align-items-center justify-content-end edit-upload-book">
                                            <button type="button" class="btn-edit-master me-2" id="upload-btn"
                                                onclick="uploadImage()">
                                                <i class="fa fa-edit text-primary"></i>
                                            </button>
                                            <button type="button" class="btn-edit-master" id="btn-remove">
                                                <i class="fa fa-trash-o text-danger"></i>
                                            </button>
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

        $( '#extracurricular_id' ).select2( {
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


        $(document).ready(function () {


            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        Array.prototype.filter.call($('#form-edit'), function (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    let student_id = $("#student_id").val();
                    var url = (student_id !== undefined && student_id !== null) && student_id ? "{{ url('student')}}" + "/" + student_id : "{{ url('student')}}";
                    $.ajax({
                        url: url,
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        data: $('#form-edit').serialize(),
                        // contentType: 'application/json',
                        processData: false,
                        success: function (response) {
                        console.log(response)
                            setTimeout(() => {
                                $("#table-student").load(window.location.href +
                                    " #table-student");
                            }, 0);
                            $('#exampleModal').modal('hide');
                        },
                        error: function (xhr) {
                        console.log(xhr.responseText);
                        }
                    });
                });
        });

        function edit_data(e) {
            $('#exampleModal').modal('show')
            var url = "{{url('student')}}" + "/" + e.attr('data-id') + "/" + "edit"
            $.ajax({
                url: url,
                method: "GET",
                // dataType: "json",
                success: function (result) {
                    $("#modal-title").html("Edit Siswa")
                    $("#button-modal").html("Edit")
                    $('#student_id').val(result.student_id).trigger('change');
                    $('#first_name').val(result.first_name);
                    $('#last_name').val(result.last_name);
                    $('#nisn').val(result.nisn);
                    $('#place_of_birth').val(result.place_of_birth);
                    $('#date_of_birth').val(result.date_of_birth);
                    $('#gender').val(result.gender).trigger('change');
                    $('#religion').val(result.religion);
                    $('#school_origin').val(result.school_origin);
                    $('#date_school_now').val(result.date_school_now);
                    $('#father_name').val(result.father_name);
                    $('#mother_name').val(result.mother_name);
                    $('#parent_address').val(result.parent_address);
                    $('#father_profession').val(result.father_profession);
                    $('#mother_profession').val(result.mother_profession);
                    $('#father_education').val(result.father_education);
                    $('#mother_education').val(result.mother_education);
                    $('#family_name').val(result.family_name);
                    $('#family_address').val(result.family_address);
                    $('#family_profession').val(result.family_profession);
                    $('#extracurricular_id').val(result.extracurricular_id).trigger('change');
                    if(result.image !== null){
                        document.getElementById("image").src =result.image;
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
            url: "{{url('/student/delete-student')}}" + "/" + id,
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
                            $("#table-student").load(window.location.href +
                                " #table-student");
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
