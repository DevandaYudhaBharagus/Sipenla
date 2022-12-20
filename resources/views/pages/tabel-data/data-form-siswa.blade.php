@extends('layouts.dashboard-layouts')

@section('title', 'Data Formulir Siswa')

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
                            Data Formulir Siswa
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
                    Data Formulir Siswa
                </div>
                <div class="d-flex justify-content-between px-md-5 mt-4">
                    <div class="sipenla"></div>
                    <div class="tut-wuri"></div>
                </div>
                <div class="row justify-content-center mt-2 mb-3">
                    <div class="col-md-3 col-12 text-center">
                        <h6 class="form-pegawai">FORMULIR DATA SISWA</h6>
                        <P>BIODATA SISWA</P>
                    </div>
                </div>
                <div class="row justify-content-center mt-md-3 mb-3">
                    <div class="col-md-9 col-12">
                        <table style="width: 100%">
                            <tr>
                                <td style="width: 4%;font-weight:600">1.</td>
                                <td style="width:40%;font-weight:600">Nama Depan</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Lorem ipsum dolor sit amet.</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">2.</td>
                                <td style="width:40%;font-weight:600">Nama Belakang</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">adipisicing elit. Voluptatem, voluptas?</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">3.</td>
                                <td style="width:40%;font-weight:600">NISN</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">1254698552001478562</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">4.</td>
                                <td style="width:40%;font-weight:600">Tempat, tanggallahir</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Surabaya, 28-10-1998</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">5.</td>
                                <td style="width:40%;font-weight:600">Jenis Kelamin</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Laki-laki</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">6.</td>
                                <td style="width:40%;font-weight:600">Agama</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Konghucu</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">7.</td>
                                <td style="width:40%;font-weight:600">Alamat Tinggal</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Jl Surabaya</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">8.</td>
                                <td style="width:40%;font-weight:600">Asal Sekolah</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Konoha</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">9.</td>
                                <td style="width:40%;font-weight:600">Diterima di Sekolah Ini</td>
                            </tr>
                        </table>
                        <table style="width: 100%;margin-left:2rem">
                            <tr>
                                <td style="width: 4%;font-weight:600">a.</td>
                                <td style="width:33%;font-weight:600">Kelas</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%;">8A</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">b.</td>
                                <td style="width:33%;font-weight:600">Tanggal Penerimaan</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%;">21-10-2022</td>
                            </tr>
                        </table>

                        <table style="width:100%">
                            <tr>
                                <td style="width: 4%;font-weight:600">10.</td>
                                <td style="width:40%;font-weight:600">Nama Ayah</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Kamu nanya</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">11.</td>
                                <td style="width:40%;font-weight:600">Pekerjaan Ayah</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Kamu nanya</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">12.</td>
                                <td style="width:40%;font-weight:600">Pendidikan Terakhir Ayah</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Kamu nanya</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">13.</td>
                                <td style="width:40%;font-weight:600">Nama Ibu</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Kamu nanya</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">14.</td>
                                <td style="width:40%;font-weight:600">Pekerjaan Ibu</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Kamu nanya</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">15.</td>
                                <td style="width:40%;font-weight:600">Pendidikan Terakhir Ibu</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Kamu nanya</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">16.</td>
                                <td style="width:40%;font-weight:600">Alamat Orang Tua</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Sama</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">17.</td>
                                <td style="width:40%;font-weight:600">Nama Wali</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">email@gmail.com</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">18.</td>
                                <td style="width:40%;font-weight:600">Alamat Wali</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Kepala Sekolah</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">19.</td>
                                <td style="width:40%;font-weight:600">Pekerjaan Wali</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Kepala Sekolah</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">20.</td>
                                <td style="width:40%;font-weight:600">Ekstrakulikuler</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">Guru</td>
                            </tr>
                            <tr>
                                <td style="width: 4%;font-weight:600">21.</td>
                                <td style="width:40%;font-weight:600">Foto</td>
                                <td style="width: 5%;text-align:center">:</td>
                                <td style="width:51%">
                                    <div class="box-image-employee">
                                        <img src="{{ asset('images/internal-images/pengumuman.jpg') }}">
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
