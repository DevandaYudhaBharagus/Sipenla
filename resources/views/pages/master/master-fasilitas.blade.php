@extends('layouts.master')
@section('title', 'Master Fasilitas')
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
                        Fasilitas
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Fasilitas</h5>
        <div class="d-md-flex align-items-md-center justify-content-md-between mt-2">
            <button class="btn-create" id="add-facility" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Tambah Data
            </button>
            <div class="form-search">
                <input type="text" name="" id="search" placeholder="Cari Fasilitas" />
            </div>

        </div>
        <div class="outher-table" id="facility-table">
            <div class="table-scroll">
                <table id="master-fasilitas" class="table-master" style="width:100%;">
                    <thead>
                        <tr>
                            <th style="width:10%" class="text-center">Kode</th>
                            <th style="width:30%" class="text-center">Nama Fasilitas</th>
                            <th style="width:15%" class="text-center">Jumlah</th>
                            <th style="width:15%" class="text-center">Tahun</th>
                            <th style="width:15%" class="text-center">Foto</th>
                            <th style="width:15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($facility as $new)
                            <tr>
                                <td class="text-center align-items-center" style="width: 10%">{{ $new->facility_code }}</td>
                                <td style="width:30%">{{ $new->facility_name }}</td>
                                <td style="width:15%">{{ $new->number_of_facility }} </td>
                                <td style="width:15%">{{ $new->year }}</td>
                                <td style="width:15%">
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
                                                        <img src="{{ asset('images/internal-images/pengumuman.jpg') }}"
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
                                <td style="width:15%">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <a class="btn-edit-master me-2" data-id="{{ $new->facility_id }}"
                                            onclick=edit_data($(this))><i class="fa fa-edit text-primary"></i></a>
                                        <a data-id="{{ $new->facility_id }}" onclick=delete_data($(this))
                                            class="btn-edit-master">
                                            <i class="fa fa-trash-o text-danger"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Tidak ada data</td>
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
                    <h1 class="modal-title fs-5 m-auto" id="modal-title">
                        Tambah Data Fasilitas
                    </h1>
                </div>
                <div class="modal-body">
                    <form id="form-facility" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="facility_id" id="facility_id" value="">
                        <div class="row">
                            {{-- <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Kode Fasilitas</label>
                                    <input type="text" class="form-control" id="" />
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="facility_name" class="form-label">Nama Fasilitas</label>
                                    <input type="text" name="facility_name" class="form-control"
                                        id="facility_name" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="number_of_facility" class="form-label">Jumlah</label>
                                    <input type="number" name="number_of_facility" class="form-control"
                                        id="number_of_facility" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Tahun</label>
                                    <input type="number" name="year" class="form-control" id="year" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <input type="file" id="image-facility" name="image-facility" style="display: none"
                                    multiple />
                                <div class="mb-3">
                                    <div class="box-image-upload-master">
                                        <label for="image-facility" class="form-label">Foto</label>
                                        <img src="{{ asset('images/internal-images/no-img.png') }}" id="image-edit"
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
    <script>
        const inpuTSearch = document.querySelector("#search");
        inpuTSearch.addEventListener("keyup", searchDataTable);

        function searchDataTable() {
            let filter, table, tr, td, i, txtValue;
            filter = inpuTSearch.value.toUpperCase();
            table = document.querySelector("#master-fasilitas");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
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
        function uploadImage() {
            document.querySelector("#image-facility").click();
        }

        $("#exampleModal").on("hidden.bs.modal", function(e) {
            const reset_form = $('#form-facility')[0];
            const reset_form_edit = $('#form_edit_data')[0];
            $(reset_form).removeClass('was-validated');
            $(reset_form_edit).removeClass('was-validated');
            let uniqueField = ["facility_name"]
            for (let i = 0; i < uniqueField.length; i++) {
                $("#" + uniqueField[i]).removeClass('was-validated');
                $("#" + uniqueField[i]).removeClass("is-invalid");
                $("#" + uniqueField[i]).removeClass("invalid-more");
            }
        });

        $(document).ready(function() {
            document.getElementById("add-facility").addEventListener("click", function() {
                document.getElementById("form-facility").reset();
                $("#modal-title").html("Tambah Data Fasilitas");
                document.getElementById("facility_id").value = null;
                // document.getElementById("image-edit").src = "";
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })

        Array.prototype.filter.call($('#form-facility'), function(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                var form = $('#form-facility')[0];
                var data = new FormData(form);

                let facility_id = $("#facility_id").val();

                var url = (facility_id !== undefined && facility_id !== null) && facility_id ?
                    "{{ url('facility') }}" + "/" + facility_id : "{{ url('facility') }}" +
                    "/addfacility";
                $.ajax({
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    enctype: 'multipart/form-data',
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response)
                        setTimeout(() => {
                            $("#facility-table").load(window.location.href +
                                " #facility-table");
                        }, 0);
                        $('#exampleModal').modal('hide');
                        var reset_form = $('#form-facility')[0];
                        $(reset_form).removeClass('was-validated');
                        reset_form.reset();
                        $('#exampleModal').modal('hide');
                        $("#modal-title").html("Tambah Data Fasilitas")
                        $("#facilityt_id").val()
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        function edit_data(e) {
            $('#exampleModal').modal('show')
            var url = "{{ url('facility') }}" + "/" + e.attr('data-id') + "/" + "edit"
            $.ajax({
                url: url,
                method: "GET",
                // dataType: "json",
                success: function(result) {
                    $("#modal-title").html("Edit Jadwal Kerja")
                    $("#button-modal").html("Edit")
                    $('#facility_id').val(result.facility_id).trigger('change');
                    $('#facility_name').val(result.facility_name);
                    $('#number_of_facility').val(result.number_of_facility);
                    $('#year').val(result.year);
                    document.getElementById("image-edit").src = result.image;
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        const inputImage = document.querySelector("#image-facility");
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
                        url: "{{ url('/facility/delete-facility') }}" + "/" + id,
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
                                    $("#facility-table").load(window.location.href +
                                        " #facility-table");
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
