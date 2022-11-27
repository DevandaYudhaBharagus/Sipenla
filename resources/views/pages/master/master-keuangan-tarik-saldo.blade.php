@extends('layouts.master')
@section('title', 'Master Keuangan | Tarik Saldo')


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
                        <img src="{{ asset('images/internal-images/icon-keuangan.png') }}"
                            class="d-flex align-items-center me-1" width="16px" height="16px" alt=""> Data
                        Keuangan
                    </div>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/internal-images/icon-keuangan.png') }}"
                            class="d-flex align-items-center me-1" width="16px" height="16px" alt=""> Data
                        Tarik Saldo
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Tarik Saldo</h5>
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
                <table class="table-master">
                    <tr>
                        <th width="10%">No</th>
                        <th width="25%">NISN</th>
                        <th width="26%">Nama</th>
                        <th width="26%">Uang Keluar</th>
                        <th width="145px">Aksi</th>
                    </tr>
                    <tr>
                        <td width="10%">1.</td>
                        <td width="25%">0254147857</td>
                        <td width="26%">Aziz Taher</td>
                        <td width="26%">Rp 15.000</td>
                        <td width="145px">
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
                        Tambah Data SPP
                    </h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">NISN</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Siswa</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Uang Keluar</label>
                                    <input type="number" class="form-control" id="nama-role" />
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-permission bg-red-permission me-md-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn btn-permission bg-green-permission">
                        Tambah
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
