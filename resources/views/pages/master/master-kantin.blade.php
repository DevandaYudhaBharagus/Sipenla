@extends('layouts.master')
@section('title', 'Master Kantin')


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
                <li class="breadcrumb-item" aria-current="page">Data Kantin</li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Kantin</h5>
        <div class="d-md-flex align-items-md-center justify-content-md-between mt-2">
            <div class="d-md-flex align-content-md-center">
                <button class="btn-create" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Tambah Data
                </button>
            </div>
        </div>
        <div class="outher-table">
            {{-- <div class="table-scroll">
                <table class="table-master">
                    <tr>
                        <th width="10%">No</th>
                        <th width="20%">Foto</th>
                        <th width="25%">Nama Kantin</th>
                        <th width="21%">Nama Barang</th>
                        <th width="11%">Harga</th>
                        <th width="145px">Aksi</th>
                    </tr>
                    <tr>
                        <td width="10%">1.</td>
                        <td width="20%">
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
                                            <img src="{{ asset('images/internal-images/pengumuman.jpg') }}"
                                                alt="" />
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
                        <td width="25%">Kantin A</td>
                        <td width="21%">Soto Betawi</td>
                        <td width="11%">Rp 15.000</td>
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
            </div> --}}
            <table id="example" class="display" style="width:100%;">
                <thead>
                    <tr>
                        <th style="width:10%" class="text-center">No</th>
                        <th style="width:20%" class="text-center">Foto</th>
                        <th style="width:20%" class="text-center">Nama Kantin</th>
                        <th style="width:20%" class="text-center">Nama Barang</th>
                        <th style="width:15%" class="text-center">Harga</th>
                        <th style="width:15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center align-items-center" style="width: 10%">1.</td>
                        <td style="width:20%">
                            <div class="dropdown">
                                <div class="btn btn-foto-master m-auto" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="icon-foto-master">
                                        <img src="{{ asset('images/internal-images/foto-user.png') }}" alt="" />
                                    </div>
                                    <div class="fa fa-angle-down"></div>
                                </div>
                                <ul class="dropdown-menu dropdown-name">
                                    <li>
                                        Ajiz Bilar
                                    </li>
                                    <li>
                                        Ajiz Bilar
                                    </li>
                                    <li>
                                        Ajiz Lesti
                                    </li>
                                    <li>
                                        Ajiz Lesti Bilar
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td style="width:20%">Kantin A</td>
                        <td style="width:20%">Soto Ayam</td>
                        <td style="width:15%">Rp 10.000</td>
                        <td style="width:15%">
                            <div class="d-flex align-items-center justify-content-center">
                                <a class="btn-edit-master btn me-2" data-id="" onclick=edit_data($(this))><i
                                        class="fa fa-edit text-primary"></i></a>
                                <a data-id="" onclick=delete_data($(this)) class="btn-edit-master btn">
                                    <i class="fa fa-trash-o text-danger"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
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
                        Tambah Data Kantin
                    </h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row mb-3">
                            <div class="col-md-6 col-12">
                                <input type="file" name="" id="image-master" style="display: none" multiple />
                                <div class="mb-3">
                                    <div class="box-image-upload-master">
                                        <label for="" class="form-label">Foto</label>
                                        <img src="{{ asset('images/internal-images/no-img.png') }}" alt=""
                                            id="image-upload-btn">
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

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Kantin</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Barang</label>
                                    <input type="text" class="form-control" id="nama-role" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Harga</label>
                                    <input type="number" class="form-control" id="nama-role" />
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
        function uploadImage() {
            document.querySelector("#image-master").click();
        }

        const inputImage = document.querySelector("#image-master");
        const choseImage = document.querySelector("#image-upload-btn");
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
