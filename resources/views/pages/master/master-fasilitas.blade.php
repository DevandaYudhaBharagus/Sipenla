@extends('layouts.master')
@section('title', 'Master Fasilitas')


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
                        <img src="{{ asset('images/internal-images/icon-fasilitas.png') }}"
                            class="d-flex align-items-center me-1" width="16px" height="16px" alt=""> Data
                        Fasilitas
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Fasilitas</h5>
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
                        <th width="11%">Kode</th>
                        <th width="25%">Nama Fasilitas</th>
                        <th width="12%">Jumlah</th>
                        <th width="14%">Tahun</th>
                        <th width="20%">Foto</th>
                        <th width="200px">Aksi</th>
                    </tr>
                    @foreach ( $facility as $new )
                    <tr>
                        <td width="11%">{{ $new->facility_code }}</td>
                        <td width="25%">{{ $new->facility_name }}</td>
                        <td width="12%"> {{ $new->number_of_facility }} </td>
                        <td width="14%">
                            {{ $new->year }}
                        </td>
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
                                            @if(!$new->image)
                                            <img src="{{ asset('images/internal-images/pengumuman.jpg') }}"
                                            alt="" />
                                            @else
                                            <img src="{{ $new->image }}" alt="" />
                                        @endif
                                        
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
                        <td width="200px">
                            <div class="d-flex align-items-center justify-content-center">
                                <a href="" class="btn-edit-master me-2">
                                    <i class="fa fa-edit text-primary"></i>
                                </a>
                                <a href="{{ url('facility/delete-facility/'.$new->facility_id ) }}" class="btn-edit-master">
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
                    <h1 class="modal-title fs-5 m-auto" id="exampleModalLabel">
                        Tambah Data Fasilitas
                    </h1>
                </div>
                <div class="modal-body">
                    <form action="{{ route('addfacility') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Kode Fasilitas</label>
                                    <input type="text" class="form-control" id="" />
                                </div>
                            </div> --}}
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Fasilitas</label>
                                    <input type="text" name="facility_name" class="form-control" id="" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Jumlah</label>
                                    <input type="number" name="number_of_facility" class="form-control" id="" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Tahun</label>
                                    <input type="number" name="year" class="form-control" id="" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <input type="file" name="image-facility" id="image-master" style="display: none" multiple />
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
    </script>
@endpush
