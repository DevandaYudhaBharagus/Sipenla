@extends('layouts.master')
@section('title', 'Data Master')


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
            </ol>
        </nav>
    </div>
    <div class="box-content" style="min-height: 70vh">

    </div>
@endsection
