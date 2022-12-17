@extends('layouts.master')

@section('title', 'Master Guru')
@section('meta_header')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* div.dataTables_wrapper {
                width: 1000px;
                margin: 0 auto;
            } */
    </style>
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
        </div>
        <div class="outher-table" id="teacher-table">
            {{-- <div class="table-scroll">
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
                    @foreach ($teacher as $new)
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
            </div> --}}
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th style="width:100px">No</th>
                        <th style="width: 150px;text-align:center">Nama Depan</th>
                        <th>Nama Belakang</th>
                        <th>NUPTK / ID Pegawai</th>
                        <th>NIPSN</th>
                        <th>Tempat Lahir</th>
                        <th>Tanggal Lahir</th>
                        <th>Jenis Kelamin</th>
                        <th>Agama</th>
                        <th>Alamat Tinggal</th>
                        <th>Riwayat Pendidikan</th>
                        <th>Nama Ibu</th>
                        <th>Alamat Orang Tua</th>
                        <th>Email</th>
                        <th>Jabatan 1</th>
                        <th>Shift Kerja</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="width:100px">1</td>
                        <td style="width: 150px;text-align:center">Lorem ipsum dolor sit amet consectetur, adipisicing
                            elit.
                            Natus, quas? Lorem
                            ipsum, dolor sit amet consectetur adipisicing elit. Cum,
                        </td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur
                            adipisicing elit. Odio, architecto?</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>Aksi</td>
                    </tr>
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
                    <h1 class="modal-title fs-5 m-auto" id="exampleModalLabel">Tambah Data Guru</h1>
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
                                    <input type="text" name="date_of_birth" placeholder="dd/mm/yy" class="form-control"
                                        id="date_of_birth" />
                                    {{-- <div class="down-form-full">
                                        <i class="fa fa-calendar"></i>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="gender" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="gender" id="gender"
                                    aria-label="Default select example">
                                    <option selected>--- Pilih Jenis Kelamin ---</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                {{-- <div class="down-form">
                                    <i class="fa fa-angle-down"></i>
                                </div> --}}
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
                                <select class="form-select" name="workshift_id" id="workshift_id"
                                    data-dropdown-parent="body" data-placeholder="Pilih Shift Kerja">
                                    <option selected disabled value=''>--- Pilih Shift ---</option>
                                    {{-- @foreach ($workshift as $test)
                                        <option value="{{ $test->workshift_id }}">{{ $test->shift_name }}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <input type="file" name="" id="image-master-guru" style="display: none"
                                    multiple />
                                <div class="mb-3">
                                    <div class="box-image-upload-master">
                                        <label for="" class="form-label">Foto</label>
                                        <img id="image-edit" src="{{ asset('images/internal-images/no-img.png') }}"
                                            alt="">
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
            $('#example').DataTable({
                scrollY: 400,
                scrollX: true,
                paging: false,

            });
        });
        window.addEventListener("load", function() {
            const input = document.querySelector("#example_filter");
            const elemenInput = input.children[0].children[0];
            elemenInput.setAttribute("placeholder", "pencarian")
            input.children[0].childNodes[0].textContent = " ";
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function uploadImage() {
            document.querySelector("#image-master-guru").click();
        }
        flatpickr("#date_of_birth", {
            altInput: true,
            altFormat: "j F, Y",
            dateFormat: "d-m-Y",
        });
        const inputImage = document.querySelector("#image-master-guru");
        const choseImage = document.querySelector("#image-edit");
        const btnRemove = document.querySelector("#btn-remove");


        inputImage.addEventListener("change", () => {
            let reader = new FileReader();
            reader.readAsDataURL(inputImage.files[0]);
            reader.onload = () => {
                choseImage.setAttribute("src", reader.result);
            }
        });

        btnRemove.addEventListener("click", () => {
            choseImage.setAttribute("src", `{{ asset('images/internal-images/no-img.png') }}`);
            inputImage.value = "";
        })
    </script>
    <script>
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
            document.getElementById("add-workshift").addEventListener("click", function() {
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

        Array.prototype.filter.call($('#form-workshift'), function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                let workshift_id = $("#workshift_id").val();

                var url = (workshift_id !== undefined && workshift_id !== null) && workshift_id ?
                    "{{ url('workshift') }}" + "/" + workshift_id : "{{ url('workshift') }}" +
                    "/addshift";
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    data: $('#form-workshift').serialize(),
                    // contentType: 'application/json',
                    processData: false,
                    success: function(response) {
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
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        function edit_data(e) {
            $('#exampleModal').modal('show')
            var url = "{{ url('workshift') }}" + "/" + e.attr('data-id') + "/" + "edit"
            $.ajax({
                url: url,
                method: "GET",
                // dataType: "json",
                success: function(result) {
                    $("#modal-title").html("Edit Jadwal Kerja")
                    $("#button-modal").html("Edit")
                    $('#workshift_id').val(result.workshift_id).trigger('change');
                    $('#shift_name').val(result.shift_name);
                    $('#start_time').val(result.start_time);
                    $('#end_time').val(result.end_time);
                    $('#max_arrival').val(result.max_arrival);
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
                        url: "{{ url('/teacher/delete-teacher') }}" + "/" + id,
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
