@extends('layouts.master')
@section('title', 'Master Kelas Siswwa')
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
                        <i class="fa fa-user-o me-1"></i> Data Anggota Siswa Kelas
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Anggota Siswa Kelas</h5>
        <div class="outher-table">
            <table id="example" class="display" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width:10%" class="text-center">No</th>
                        <th style="width:45%" class="text-start">Nama Anggota Kelas</th>
                        <th style="width:30%" class="text-center">NISN</th>
                        <th style="width:15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $g)
                        <tr>
                            <td class="text-center align-items-center">{{ $loop->iteration }}</td>
                            <td class="text-start">{{ $g->first_name . ' ' . $g->last_name }}
                            </td>
                            <td>{{ $g->nisn }}</td>
                            <td class="d-flex justify-content-center">
                                <a data-id="{{ $g->student_id }}" onclick=delete_data($(this)) class="btn-edit-master btn">
                                    <i class="fa fa-trash-o text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('addon-javascript')
    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.js"></script> --}}
    <script src="/js/dataTable.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                scrollY: '60vh',
                scrollCollapse: true,
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
    <script>
        // $("#exampleModal").on("hidden.bs.modal", function(e) {
        //     const reset_form = $('#form-grade')[0];
        //     $(reset_form).removeClass('was-validated');
        //     $("#grade_id").val("");
        //     $("#basic-usage").val("").change();
        //     $("#form-grade").trigger("reset")
        //     let uniqueField = ["grade_name"]
        //     for (let i = 0; i < uniqueField.length; i++) {
        //         $("#" + uniqueField[i]).removeClass('was-validated');
        //         $("#" + uniqueField[i]).removeClass("is-invalid");
        //         $("#" + uniqueField[i]).removeClass("invalid-more");
        //     }
        // });

        // $(document).ready(function() {
        //     $('#basic-usage').select2({
        //         theme: "bootstrap-5",
        //         width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
        //             'style',
        //         placeholder: $(this).data('placeholder'),
        //         dropdownParent: $('#exampleModal'),
        //     });

        //     $('#multiple-select-clear-field').select2({
        //         theme: "bootstrap-5",
        //         width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
        //             'style',
        //         placeholder: $(this).data('placeholder'),
        //         closeOnSelect: false,
        //         allowClear: true,
        //     });

        //     document.getElementById("add-grade").addEventListener("click", function() {
        //         document.getElementById("form-grade").reset();
        //         $("#modal-title").html("Tambah Data Kelas");
        //         document.getElementById("student_grades_id").value = null;
        //     });

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     });
        // })

        // Array.prototype.filter.call($('#form-grade'), function(form) {
        //     form.addEventListener('submit', function(event) {
        //         event.preventDefault();

        //         let student_grades_id = $("#student_grades_id").val();

        //         var url = (student_grades_id !== undefined && student_grades_id !== null) &&
        //             student_grades_id ?
        //             "{{ url('grade') }}" + "/class" + student_grades_id : "{{ url('grade') }}" +
        //             "/addclass";
        //         $.ajax({
        //             url: url,
        //             headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //             },
        //             type: 'post',
        //             data: $('#form-grade').serialize(),
        //             // contentType: 'application/json',
        //             processData: false,
        //             success: function(response) {
        //                 console.log(response)
        //                 setTimeout(() => {
        //                     $("#grade-table").load(window.location.href +
        //                         " #grade-table");
        //                 }, 0);
        //                 $('#exampleModal').modal('hide');
        //                 var reset_form = $('#form-grade')[0];
        //                 $(reset_form).removeClass('was-validated');
        //                 reset_form.reset();
        //                 $('#exampleModal').modal('hide');
        //                 $("#modal-title").html("Tambah Data Kelas")
        //                 $("#student_grades_id").val()
        //             },
        //             error: function(xhr) {
        //                 console.log(xhr.responseText);
        //             }
        //         });
        //     });
        // });

        // function edit_data(e) {
        //     $('#exampleModal').modal('show')
        //     var url = "{{ url('grade') }}" + "/" + e.attr('data-id') + "/" + "edit"
        //     $.ajax({
        //         url: url,
        //         method: "GET",
        //         // dataType: "json",
        //         success: function(result) {
        //             $("#modal-title").html("Edit Jadwal Kerja")
        //             $("#button-modal").html("Edit")
        //             $('#grade_id').val(result.grade_id).trigger('change');
        //             $('#grade_name').val(result.grade_name);
        //             $('#basic-usage').val(result.teacher_id).trigger('change');
        //         },
        //         error: function(xhr) {
        //             console.log(xhr.responseText);
        //         }
        //     });
        // }

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
                        url: "{{ url('/grade/delete-student') }}" + "/" + id,
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
                                    $("#example").load(window.location.href +
                                        " #example");
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
