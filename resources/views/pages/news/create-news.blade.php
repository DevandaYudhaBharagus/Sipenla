@extends('layouts.dashboard-layouts')

@section('title', 'Create News')

@section('content')
    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center"><i class="material-icons">home</i> Beranda</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Berita Sekolah
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="new-news">
        <div class="container">
            <div class="box-news">
                <div class="title-news">Input Berita & Pengumuman Sekolah</div>
                <div class="box-form">
                    <form action="" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" class="form-control" id="title"
                                        aria-describedby="titleHelp" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Upload Foto</label>
                                    <input type="file" name="" id="image-news" style="display: none" multiple />
                                    <div class="box-image-news">
                                        <img src="{{ asset('images/internal-images/no-img.png') }}" alt=""
                                            id="image-upload-btn" />
                                        <div class="btn-upload d-flex justify-content-end">
                                            <button type="button" onclick="thisUploadImage()" id="upload-btn">
                                                <i class="fa fa-plus text-black"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" id="text-news" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" id="title"
                                        aria-describedby="titleHelp" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="checkbox">Landing Page
                                        <input type="checkbox" name="" />
                                        <span class="check"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <div class="d-md-flex d-block justify-content-end">
                                    <button type="reset" class="btn-news red">Batal</button>
                                    <button type="submit" class="btn-news blue">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addon-javascript')
    <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script>
    <script>
        function thisUploadImage() {
            document.querySelector("#image-news").click();
        }

        CKEDITOR.replace("text-news");

        const inputImage = document.querySelector("#image-news");
        const choseImage = document.querySelector("#image-upload-btn");

        inputImage.addEventListener("change", () => {
            let reader = new FileReader();
            reader.readAsDataURL(inputImage.files[0]);
            reader.onload = () => {
                choseImage.setAttribute("src", reader.result);
            }
        });
    </script>
@endpush
