@extends('layouts.master')
@section('title', 'Role Perpustakaan | Buku Baru')


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
                        <i class="fa fa-book me-1"></i> Data Perpustakaan
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Buku Baru</h5>
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
                        <th width="15%">Kode Buku</th>
                        <th width="31%">Nama Buku</th>
                        <th width="21%">Pengarang</th>
                        <th width="10%">Tahun</th>
                        <th width="10%">Jumlah</th>
                        <th width="145px">Aksi</th>
                    </tr>
                    <tr>
                        <td width="15%">L-001</td>
                        <td width="31%">Cerita Spiderman jadi Batman</td>
                        <td width="21%">Azizz</td>
                        <td width="10%">2025</td>
                        <td width="10%">Tak Tebatas</td>
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
                    <tr>
                        <td width="15%">AZ-001</td>
                        <td width="31%">Cerita Aziz jadi Batman</td>
                        <td width="21%">Pranaja</td>
                        <td width="10%">2045</td>
                        <td width="10%">1000</td>
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
                    <tr>
                        <td width="15%">AZ-001</td>
                        <td width="31%">Cerita Aziz jadi Spiderman</td>
                        <td width="21%">Pranaja</td>
                        <td width="10%">2045</td>
                        <td width="10%">1000</td>
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
                        Tambah Data Buku
                    </h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row mb-3">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Kode Buku</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Buku</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Pengarang</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Tahun</label>
                                    <input type="number" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <input type="file" name="" id="image-library" style="display: none"
                                        multiple />
                                    <div class="mb-3">
                                        <div class="box-image-upload-master">
                                            <label for="" class="form-label">Foto</label>
                                            <img src="{{ asset('images/internal-images/no-img.png') }}" id="image-master"
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-permission bg-red-permission me-md-3" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="button" class="btn-permission bg-green-permission">
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
            document.querySelector("#image-library").click();
        }
        const inputImage = document.querySelector("#image-library");
        const choseImage = document.querySelector("#image-master");
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
    </script>
@endpush
