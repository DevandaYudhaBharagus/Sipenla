@extends('layouts.master')
@section('title', 'Role Master')


@section('content')
    <div class="box-breadcrumb">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#" class="d-flex align-items-center"><i class="material-icons">home</i>
                        Beranda</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Data Master</li>
                <li class="breadcrumb-item" aria-current="page">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-user-o me-1"></i> Data Role
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Role Master</h5>
        <div class="d-md-flex align-items-md-center justify-content-md-between mt-2">
            <div class="d-md-flex align-content-md-center">
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
                <table class="table-master" style="border: 1px solid black">
                    <tr>
                        <th width="15%">No</th>
                        <th width="62%" class="text-start">Nama Role</th>
                        <th width="200px">Aksi</th>
                    </tr>
                    <tr>
                        <td width="20%">1.</td>
                        <td width="62%" class="text-start">Guru</td>
                        <td width="200px">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="" class="btn-edit-master me-2">
                                    <i class="fa fa-edit text-primary"></i>
                                </a>
                                <a href="" class="btn-edit-master">
                                    <i class="fa fa-trash-o text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">2.</td>
                        <td width="62%" class="text-start">Siswa</td>
                        <td width="200px">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="" class="btn-edit-master me-2">
                                    <i class="fa fa-edit text-primary"></i>
                                </a>
                                <a href="" class="btn-edit-master">
                                    <i class="fa fa-trash-o text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="20%">3.</td>
                        <td width="62%" class="text-start">Wali Murid</td>
                        <td width="200px">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="" class="btn-edit-master me-2">
                                    <i class="fa fa-edit text-primary"></i>
                                </a>
                                <a href="" class="btn-edit-master">
                                    <i class="fa fa-trash-o text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
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
                    <h1 class="modal-title fs-5 m-auto" id="exampleModalLabel">
                        Buat Role Baru
                    </h1>
                    <!-- <button
                              type="button"
                              class="btn-close"
                              data-bs-dismiss="modal"
                              aria-label="Close"
                            ></button> -->
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Role</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-12">
                                <label for="">Permission</label>
                                <div class="cekbox-permission mt-2">
                                    <label class="checkbox">Pilih Semua
                                        <input type="checkbox" name="" />
                                        <span class="check"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <!-- start role permission -->
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Absensi</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- akhir role permission -->
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Berita Sekolah</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Data Master</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Fasilitas</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <!-- start role permission -->
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Form Data Pegawai</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- akhir role permission -->
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Jadwal</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Kantin</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Koperasi</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <!-- start role permission -->
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Laporan Keuangan</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- akhir role permission -->
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Monitoring</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Mutasi</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Penerimaan Siswa Baru</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <!-- start role permission -->
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Penilaian</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- akhir role permission -->
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Perpustakaan</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Profil</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Rapor</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <!-- start role permission -->
                            <div class="col-md-3 col-6">
                                <div class="box-permission">
                                    <div class="title-permission">Registrasi</div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Create
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Edit
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox">Delete
                                            <input type="checkbox" name="" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- akhir role permission -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-permission bg-red-permission me-md-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn-permission bg-green-permission">
                        Tambah
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
