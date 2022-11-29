@extends('layouts.dashboard-layouts')

@section('title', 'News')
@section('meta_header')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

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

    <section class="news">
        <div class="container">
            <div class="box-news">
                <div class="d-lg-flex d-block align-items-center justify-content-between">
                    <div class="title-news">Input Berita Sekolah</div>
                    <div class="form-news">
                        <form action="" class="d-flex align-items-center">
                            <input type="search" name="" id="" placeholder="Pencarian" />
                            <button type="submit" class="btn-search">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="row mt-4 mb-4">
                    <div class="col-l2">
                        <a href="{{ url('/news/create-news') }}" class="create-news">Tambah Berita</a>
                    </div>
                </div>
                @foreach ($news as $new)
                    <div class="list-news" id="list-news">
                        <div class="row align-items-center">
                            <div class="col-md-4">
                                <div class="box-img-news">
                                    @if(!$new->news_image)
                                    <img src="{{ asset('images/internal-images/berita-terbaru.jpg') }}" alt="" />
                                    @else
                                    <img src="{{ $new->news_image }}" alt="" />
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="title-news d-md-flex d-block justify-content-between">
                                    <h6>{{ $new->news_title }}</h6>
                                    <!-- muncul hanya pada role admin edit news -->
                                    <div class="icon-news d-md-flex d-none align-items-center">
                                        <a data-id="{{ $new->news_id }}" onclick=delete_data($(this)) class="icon text-danger">
                                            <i class="fa fa-trash-o text-danger"></i>
                                        </a>
                                        <a href="" class="icon text-primary"><i class="fa fa-edit"></i>
                                        </a>
                                    </div>
                                    <!-- akhir muncul pada role admin edit -->
                                </div>
                                <a href="{{ url('detail-news/'.$new->news_id) }}">
                                    <div class="text-news">
                                        <p>
                                            {{ $new->news_content }}
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('addon-javascript')
    <script>

        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        function delete_data(e) {
            Swal.fire({
                text: "Apakah anda yakin ingin menghapus ?",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Setuju',
                reverseButtons: true

            }).then(function (result) {

            if (result.value) {

                var id = e.attr('data-id');
                jQuery.ajax({
                url: "{{url('/news/delete-news')}}" + "/" + id,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    '_method': 'delete'
                },
                success: function (result) {

                    if (result.error) {

                    Swal.fire({
                        type: "error",
                        title: 'Oops...',
                        text: result.message,
                        confirmButtonClass: 'btn btn-success',
                    })

                    } else {

                        setTimeout(() => {
                                $("#list-news").load(window.location.href +
                                    " #list-news");
                            }, 0);

                    Swal.fire({
                        type: "success",
                        title: 'Menghapus!',
                        text: result.message,
                        confirmButtonClass: 'btn btn-success',
                    })

                    }
                }
                });
            }
            });
        }
    </script>
@endpush
