@extends('layouts.dashboard-layouts')

@section('title', 'Jadwal Mata Pelajaran')
@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@endsection
@section('content')
    <div class="container">
        <div class="box-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#" class="d-flex align-items-center"><i class="material-icons">home</i> Beranda</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/internal-images/icon-calendar.png') }}"
                                class="d-flex align-items-center me-1" width="20px" height="20px" />
                            Jadwal
                        </div>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/internal-images/icon-jadwal-pelajaran.png') }}"
                                class="d-flex align-items-center me-1" width="20px" height="20px" />
                            Jadwal Ekstrakurikuler
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="profile">
        <div class="container">
            <div class="box-profile mapel">
                <div class="row justify-content-center mt-md-5 mt-3">
                    <div class="col-md-2 col-6 me-md-3 mb-3 mb-md-0">
                        <div class="box-schedule">
                            <h6>SENIN</h6>
                            @if (count($senin) == 0)
                            <div class="box-mapel-schedule">
                                <div class="content-schedule text-center">Tidak Ada Jadwal Ekstrakurikuler</div>
                            </div>
                            @endif
                            @foreach ($senin as $s)
                            <div class="box-mapel-schedule">
                                <div class="content-schedule">{{ date('H:i', strtotime($s->start_time)) }} - {{ date('H:i', strtotime($s->end_time)) }}</div>
                                <div class="content-schedule">{{ $s->extracurricular_name }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-2 col-6 me-md-3 mb-3 mb-md-0">
                        <div class="box-schedule">
                            <h6>SELASA</h6>
                            @if (count($selasa) == 0)
                            <div class="box-mapel-schedule">
                                <div class="content-schedule text-center">Tidak Ada Jadwal Extrakurikuler</div>
                            </div>
                            @endif
                            @foreach ($selasa as $s)
                            <div class="box-mapel-schedule">
                                <div class="content-schedule">{{ date('H:i', strtotime($s->start_time)) }} - {{ date('H:i', strtotime($s->end_time)) }}</div>
                                <div class="content-schedule">{{ $s->extracurricular_name }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-2 col-6 me-md-3 mb-3 mb-md-0">
                        <div class="box-schedule">
                            <h6>RABU</h6>
                            @if (count($rabu) == 0)
                            <div class="box-mapel-schedule">
                                <div class="content-schedule text-center">Tidak Ada Jadwal Extrakurikuler</div>
                            </div>
                            @endif
                            @foreach ($rabu as $s)
                            <div class="box-mapel-schedule">
                                <div class="content-schedule">{{ date('H:i', strtotime($s->start_time)) }} - {{ date('H:i', strtotime($s->end_time)) }}</div>
                                <div class="content-schedule">{{ $s->extracurricular_name }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-2 col-6 me-md-3 mb-3 mb-md-0">
                        <div class="box-schedule">
                            <h6>KAMIS</h6>
                            @if (count($kamis) == 0)
                            <div class="box-mapel-schedule">
                                <div class="content-schedule text-center">Tidak Ada Jadwal Extrakurikuler</div>
                            </div>
                            @endif
                            @foreach ($kamis as $s)
                            <div class="box-mapel-schedule">
                                <div class="content-schedule">{{ date('H:i', strtotime($s->start_time)) }} - {{ date('H:i', strtotime($s->end_time)) }}</div>
                                <div class="content-schedule">{{ $s->extracurricular_name }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-2 col-6 me-md-3 mb-3 mb-md-0">
                        <div class="box-schedule">
                            <h6>JUM'AT</h6>
                            @if (count($jumat) == 0)
                            <div class="box-mapel-schedule">
                                <div class="content-schedule text-center">Tidak Ada Jadwal Extrakurikuler</div>
                            </div>
                            @endif
                            @foreach ($jumat as $s)
                            <div class="box-mapel-schedule">
                                <div class="content-schedule">{{ date('H:i', strtotime($s->start_time)) }} - {{ date('H:i', strtotime($s->end_time)) }}</div>
                                <div class="content-schedule">{{ $s->extracurricular_name }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addon-javascript')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('#select-class').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
        $('#select-mapel').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
        });
    </script>
@endpush
