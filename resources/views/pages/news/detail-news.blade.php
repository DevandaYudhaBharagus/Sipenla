@extends('layouts.dashboard-layouts')

@section('title', 'Detail News')

@section('content')
    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/dashboard') }}" class="d-flex align-items-center"><i class="material-icons">home</i> Beranda</a>
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
                <div class="title-news">Berita Sekolah</div>
                <div class="row mt-4">
                    <div class="col-md-7 col-12">
                        <div class="box-detail-news">
                            <div class="title-detail text-center">
                                <h5>{{ $news->news_title }}</h5>
                                <div class="create-detail">
                                    Jumat 14 Oktober 2022 - Eleaner Pena
                                </div>
                            </div>
                            <div class="box-image-detail">
                                @if(!$news->news_image)
                                <img src="{{ asset('images/internal-images/berita-terbaru.jpg') }}" alt="" />
                                @else
                                <img src="{{ $news->news_image }}" alt="" />
                                @endif
                            </div>
                            <div class="text-detail-news">
                                <p>
                                    {{$news->news_content}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-12">
                        @foreach ($datas as $data)
                        <div class="detail-new-news">
                            <a href="" class="content-new-news">
                                <div class="box-img-new-news">
                                    @if(!$data->news_image)
                                    <img src="{{ asset('images/internal-images/berita-terbaru.jpg') }}" alt="" />
                                    @else
                                    <img src="{{ $data->news_image }}" alt="" />
                                    @endif
                                </div>
                                <div class="text-new-news">
                                    <div class="title-new-news">
                                        {{$data->news_title}}
                                    </div>
                                    <div class="text-content-news">
                                        <p>
                                            {{ $data->news_content }}
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
