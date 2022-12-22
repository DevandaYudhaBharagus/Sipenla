@extends('layouts.dashboard-layouts')

@section('title', 'Data Formulir Pegawai')

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
                            Data Formulir Pegawai
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
                    Data Formulir Pegawai
                </div>
                <div class="d-flex justify-content-between px-md-5 mt-4">
                    <div class="sipenla"></div>
                    <div class="tut-wuri"></div>
                </div>
                <div class="row justify-content-center mt-2 mb-3">
                    <div class="col-md-3 col-12 text-center">
                        <h6 class="form-pegawai">FORMULIR DATA PEGAWAI</h6>
                        <P>BIODATA PEGAWAI</P>
                    </div>
                </div>
                <div class="row justify-content-center mt-md-3 mb-3">
                    <div class="col-md-9 col-12">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 4%;font-weight:600">1.</td>
                                <td style="width:40%;font-weight:600">Nama Depan</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">{{ $employee->first_name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">2.</td>
                                <td style="width:40%;font-weight:600">Nama Belakang</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">{{ $employee->last_name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">3.</td>
                                <td style="width:40%;font-weight:600">NUPTK/ID Pegawai</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">{{ $employee->nuptk }}</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">4.</td>
                                <td style="width:40%;font-weight:600">NPSN</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">{{ $employee->npsn }}</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">5.</td>
                                <td style="width:40%;font-weight:600">Tempat, tanggallahir</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">{{ $employee->place_of_birth.", ".$employee->date_of_birth }}</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">6.</td>
                                <td style="width:40%;font-weight:600">Jenis Kelamin</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">{{ $employee->gender }}</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">7.</td>
                                <td style="width:40%;font-weight:600">Agama</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">{{ $employee->religion }}</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">8.</td>
                                <td style="width:40%;font-weight:600">Alamat Tinggal</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">{{ $employee->address }}</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">9.</td>
                                <td style="width:40%;font-weight:600">Pendidikan Terakhir</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">{{ $employee->education }}</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">10.</td>
                                <td style="width:40%;font-weight:600">Nama Ibu</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">{{ $employee->family_name }}</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">11.</td>
                                <td style="width:40%;font-weight:600">Alamat Orang Tua</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">{{ $employee->family_address }}</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">12.</td>
                                <td style="width:40%;font-weight:600">Email</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">{{ $employee->email }}</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">13.</td>
                                <td style="width:40%;font-weight:600">Jabatan 1</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">{{ $employee->position }}</td>
                            </tr>
                            {{-- <tr>
                                <td style="width: 4%;font-weight:600">14.</td>
                                <td style="width:40%;font-weight:600">Jabatan 2</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Guru</td>
                            </tr> --}}
                            <tr>
                                <td style="width: 4%;font-weight:600">15.</td>
                                <td style="width:40%;font-weight:600">Foto</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">
                                    <div class="box-image-employee">
                                        <img src="{{$employee->image }}">
                                    </div>
                                </td>
                            </tr>
                        </table>
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
