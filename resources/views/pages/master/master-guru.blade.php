@extends('layouts.master')

@section('title', 'Master Guru')

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
                        <th width="250px">Jabatan 2</th>
                        <th width="250px">Shift Kerja</th>
                        <th width="250px">Foto</th>
                        <th width="250px" style="border-right: none">Aksi</th>
                    </tr>
                    <tr>
                        <td width="50px" class="no-border">1</td>
                        <td width="250px">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Repudiandae, explicabo.
                        </td>
                        <td width="250px">Lorem, ipsum dolor.</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="500px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="500px">Lorem ipsum dolor sit.</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">
                            <div class="dropdown">
                                <div class="btn btn-foto-master m-auto" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="icon-foto-master">
                                        <img src="../../images/foto-master.png" alt="" />
                                    </div>
                                    <div class="fa fa-angle-down"></div>
                                </div>
                                <ul class="dropdown-menu dropdown-foto">
                                    <li>
                                        <h6>Foto</h6>
                                        <div class="box-foto-master">
                                            <img src="../../images/pengumuman.jpg" alt="" />
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
                                <a href="" class="btn-edit-master">
                                    <i class="fa fa-trash-o text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="50px" class="no-border">2</td>
                        <td width="250px">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Repudiandae, explicabo.
                        </td>
                        <td width="250px">Lorem, ipsum dolor.</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="500px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="500px">Lorem ipsum dolor sit.</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">
                            <div class="dropdown">
                                <div class="btn btn-foto-master m-auto" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="icon-foto-master">
                                        <img src="../../images/foto-master.png" alt="" />
                                    </div>
                                    <div class="fa fa-angle-down"></div>
                                </div>
                                <ul class="dropdown-menu dropdown-foto">
                                    <li>
                                        <h6>Foto</h6>
                                        <div class="box-foto-master">
                                            <img src="../../images/pengumuman.jpg" alt="" />
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
                                <a href="" class="btn-edit-master">
                                    <i class="fa fa-trash-o text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="50px" class="no-border">3</td>
                        <td width="250px">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Repudiandae, explicabo.
                        </td>
                        <td width="250px">Lorem, ipsum dolor.</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="500px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="500px">Lorem ipsum dolor sit.</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">
                            <div class="dropdown">
                                <div class="btn btn-foto-master m-auto" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="icon-foto-master">
                                        <img src="../../images/foto-master.png" alt="" />
                                    </div>
                                    <div class="fa fa-angle-down"></div>
                                </div>
                                <ul class="dropdown-menu dropdown-foto">
                                    <li>
                                        <h6>Foto</h6>
                                        <div class="box-foto-master">
                                            <img src="../../images/pengumuman.jpg" alt="" />
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
                                <a href="" class="btn-edit-master">
                                    <i class="fa fa-trash-o text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="50px" class="no-border">4</td>
                        <td width="250px">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Repudiandae, explicabo.
                        </td>
                        <td width="250px">Lorem, ipsum dolor.</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="500px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="500px">Lorem ipsum dolor sit.</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">
                            <div class="dropdown">
                                <div class="btn btn-foto-master m-auto" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="icon-foto-master">
                                        <img src="../../images/foto-master.png" alt="" />
                                    </div>
                                    <div class="fa fa-angle-down"></div>
                                </div>
                                <ul class="dropdown-menu dropdown-foto">
                                    <li>
                                        <h6>Foto</h6>
                                        <div class="box-foto-master">
                                            <img src="../../images/pengumuman.jpg" alt="" />
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
                                <a href="" class="btn-edit-master">
                                    <i class="fa fa-trash-o text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="50px" class="no-border">5</td>
                        <td width="250px">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Repudiandae, explicabo.
                        </td>
                        <td width="250px">Lorem, ipsum dolor.</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="500px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="500px">Lorem ipsum dolor sit.</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">-</td>
                        <td width="250px">
                            <div class="dropdown">
                                <div class="btn btn-foto-master m-auto" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="icon-foto-master">
                                        <img src="../../images/foto-master.png" alt="" />
                                    </div>
                                    <div class="fa fa-angle-down"></div>
                                </div>
                                <ul class="dropdown-menu dropdown-foto">
                                    <li>
                                        <h6>Foto</h6>
                                        <div class="box-foto-master">
                                            <img src="../../images/pengumuman.jpg" alt="" />
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">...</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
