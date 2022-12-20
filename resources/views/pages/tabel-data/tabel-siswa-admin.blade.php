@extends('layouts.dashboard-layouts')

@section('title', 'Data Siswa')

@section('content')
    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href class="d-flex align-items-center"><i class="material-icons">home</i> Beranda</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/internal-images/icon-jadwal-mengajar.png') }}"
                                class="d-flex align-items-center me-1" width="16px" height="16px" />
                            Data Siswa
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="profile">
        <div class="container">
            <div class="box-profile">
                <div class="header-profile">
                    Data Siswa
                </div>
                <div class="table-dash">
                    <table id="table-student" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th style="width:25%">Nama</th>
                                <th style="width:20%">NISN</th>
                                <th style="width: 20%">Email</th>
                                <th style="width: 15%">Kelas</th>
                                <th style="width: 10%">Absensi</th>
                                <th style="width: 10%">Formulir Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Lorem ipsum dolor sit amet.
                                </td>
                                <td>loremyhyyy@gmail.com</td>
                                <td>Guru</td>
                                <td>Guru</td>
                                <td> <a href="/absensi-siswa" class="btn-data">Lihat</a> </td>
                                <td>
                                    <a href="/data-form-siswa" class="btn-data">Lihat</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('addon-javascript')
    <script src="/js/dataTable.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-student').DataTable({
                scrollY: '60vh',
                scrollCollapse: true,
                paging: false,
            });
        });
        window.addEventListener("load", function() {
            const input = document.querySelector("#table-student_filter");
            const elemenInput = input.children[0].children[0];
            elemenInput.setAttribute("placeholder", "pencarian")
            input.children[0].childNodes[0].textContent = " ";
        });
    </script>
@endpush
