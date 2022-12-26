@extends('layouts.dashboard-layouts')

@section('title', 'Data Absensi Pegawai')

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
                            <img src="{{ asset('images/internal-images/icon-pegawai-tabel.png') }}"
                                class="d-flex align-items-center me-1" width="16px" height="16px" />
                            Data Absensi Pegawai
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
                    Data Absensi Pegawai
                </div>
                <div class="row justify-content-between employee-text mb-4">
                    <div class="col-md-4  col-12">
                        <table style="width:100%">
                            <tr>
                                <td style="width:25%;font-weight:600">Nama</td>
                                <td style="width:5%;text-align:center;font-weight:600">:</td>
                                <td style="width:70%;font-weight:600">{{ $employee->first_name.' '.$employee->last_name }}</td>
                            </tr>
                            <tr>
                                <td style="width:25%;">Jabatan</td>
                                <td style="width:5%;text-align:center"> :</td>
                                <td style="width:70%;">{{ $employee->position }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 col-12  text-end">
                        <table style="width:100%;text-align:center">
                            <thead>
                                <tr>
                                    <th>Alpha</th>
                                    <th>Hadir</th>
                                    <th>Izin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $alpha }}</td>
                                    <td>{{ $hadir }}</td>
                                    <td>{{ $izin }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row justify-content-center mt-5 mb-4 scroll-history-present">
                    @foreach ( $listAbsen as $newabsen )
                    <div class="col-md-7 col-12 mb-3">
                        <div class="history-present">
                            <div class="date-present">
                                <div class="date-text">
                                    Tanggal Presensi
                                </div>
                                <div class="date">
                                    {{ date('d - m - Y', strtotime($newabsen->check_in)) }}
                                </div>
                            </div>
                            <div class="display-present">
                                @if ( $newabsen->status == 'ace' )
                                    H
                                @elseif ($newabsen->status == 'aab')
                                    A
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


{{-- @push('addon-javascript')
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
@endpush --}}
