@extends('layouts.master')

@section('title', 'Master Pegawai')

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
        <div class="outher-table">
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
                        <td width="250px">{{ $employee->date_of_birth }}</td>
                        <td width="250px">{{ $employee->place_of_birth }}</td>
                        <td width="250px">{{ $employee->gender }}</td>
                        <td width="250px">{{ $employee->religion }}</td>
                        <td width="500px">{{ $employee->address }}</td>
                        <td width="250px">{{ $employee->education }}</td>
                        <td width="250px">{{ $employee->family_name }}</td>
                        <td width="500px">{{ $employee->family_address }}</td>
                        <td width="250px">{{ $employee->email }}</td>
                        <td width="250px">{{ $employee->position }}</td>
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
                                <a href="" class="btn-edit-master me-2">
                                    <i class="fa fa-edit text-primary"></i>
                                </a>
                                <a href="{{ url('/employee'.'/'.$employee->user_id) }}" class="btn-edit-master">
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
                    <h1 class="modal-title fs-5 m-auto" id="exampleModalLabel">Tambah Data Pegawai</h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">NUPTK / ID Pegawai</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">NPSN</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Tempat Lahir</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>--- Pilih Jenis Kelamin ---</option>
                                    <option value="1">Laki-laki</option>
                                    <option value="2">Perempuan</option>
                                </select>
                                <div class="down-form">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Agama</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Alamat Tinggal</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Riwayat Pendidikan</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Ibu</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Alamat Orang Tua</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Jabatan 1</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Jabatan 2</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>--- Pilih Shift ---</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
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
                                        <img src="{{ asset('images/internal-images/no-img.png') }}" alt="">
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
                    <button type="submit" class="btn btn-permission bg-green-permission">
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
    </script>
@endpush
