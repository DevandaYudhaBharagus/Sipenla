@extends('layouts.master')
@section('title', 'Master Jadwal')


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
                <li class="breadcrumb-item" aria-current="page">
                    <div class="d-flex align-items-center">
                        <img src="{{ asset('images/internal-images/icon-fasilitas.png') }}"
                            class="d-flex align-items-center me-1" width="16px" height="16px" alt=""> Data
                        Jadwal
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Jadwal</h5>
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
                        <th width="22%">Mata Pelajaran</th>
                        <th width="10%">Kelas</th>
                        <th width="20%">Guru</th>
                        <th width="10%">Hari</th>
                        <th width="11%">Jam Mulai</th>
                        <th width="11%">Jam Selesai</th>
                        <th width="180px">Aksi</th>
                    </tr>
                    <tr>
                        <td width="22%">Bahasa Indonesia</td>
                        <td width="10%">7A</td>
                        <td width="20%"> Aziz Mutohar </td>
                        <td width="10%">Senin</td>
                        <td width="11%">09:00</td>
                        <td width="11%">11:00</td>
                        <td width="180px">
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
                        Tambah Data Jadewal
                    </h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Mata Pelajaran</label>
                                <div class="select-box">
                                    <div class="options-container">
                                        <div class="option" id="option1">
                                            <input type="radio" class="radio" />
                                            <label for="film">Matematika </label>
                                        </div>
                                        <div class="option" id="option1">
                                            <input type="radio" class="radio" />
                                            <label for="film">Bahasa Indonesia </label>
                                        </div>
                                        <div class="option" id="option1">
                                            <input type="radio" class="radio" />
                                            <label for="film">Bahasa Inggris </label>
                                        </div>
                                        <div class="option" id="option1">
                                            <input type="radio" class="radio" />
                                            <label for="film">Seni Budaya </label>
                                        </div>
                                        <div class="option" id="option1">
                                            <input type="radio" class="radio" />
                                            <label for="film">Penjaskes </label>
                                        </div>
                                    </div>
                                    <div class="selected">
                                        --- Pilih Mata Pelajaran ---
                                    </div>
                                    <div class="down-form-jadwal">
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                    <div class="search-box">
                                        <input type="text" placeholder="Pencarian..." />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Guru</label>
                                <div class="select-box">
                                    <div class="options-container">
                                        <div class="option" id="option1">
                                            <input type="radio" class="radio" />
                                            <label for="film">Aziz </label>
                                        </div>
                                        <div class="option" id="option1">
                                            <input type="radio" class="radio" />
                                            <label for="film">Lesti Pranaja </label>
                                        </div>
                                        <div class="option" id="option1">
                                            <input type="radio" class="radio" />
                                            <label for="film">Aziz </label>
                                        </div>
                                    </div>
                                    <div class="selected">
                                        --- Pilih Guru ---
                                    </div>
                                    <div class="down-form-jadwal">
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                    <div class="search-box">
                                        <input type="text" placeholder="Pencarian..." />
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Hari</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>--- Pilih Hari ---</option>
                                    <option value="senin">Senin</option>
                                    <option value="selasa">Selasa</option>
                                    <option value="rabu">Rabu</option>
                                    <option value="kamis">Kamis</option>
                                    <option value="jumat">Jum'at</option>
                                    <option value="sabtu">Sabtu</option>
                                </select>
                                <div class="down-form-full">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Jam Mulai</label>
                                <input type="text" id="jam-mulai" class="form-control">
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Jam Selesai</label>
                                <input type="text" id="jam-mulai" class="form-control">
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

@push('addon-javascript')
    <script>
        const selected = document.querySelectorAll(".selected");
        const optionsContainer = document.querySelectorAll(".options-container");
        const searchBox = document.querySelectorAll(".search-box input");

        const optionsList = document.querySelectorAll(".option");

        for (let i = 0; i < selected.length; i++) {
            selected[i].addEventListener("click", () => {
                optionsContainer[i].classList.toggle("active");

                searchBox[i].value = "";
                filterList("");

                if (optionsContainer[i].classList.contains("active")) {
                    searchBox[i].focus();
                }
            });
        }
        for (let j = 0; j < optionsList.length; j++) {
            optionsList[j].addEventListener("click", () => {
                let label = optionsList[j].querySelector("label").innerHTML;
                optionsList[j].parentElement.parentElement.children[1].innerHTML = label
                const contains = optionsList[j].parentElement.parentElement.children[0];
                contains.classList.remove("active");
            });
        }

        for (let k = 0; k < searchBox.length; k++) {
            searchBox[k].addEventListener("keyup", function(e) {
                filterList(e.target.value);
            });
        }

        const filterList = searchTerm => {
            searchTerm = searchTerm.toLowerCase();
            optionsList.forEach(option => {
                let label = option.firstElementChild.nextElementSibling.innerText.toLowerCase();
                if (label.indexOf(searchTerm) != -1) {
                    option.style.display = "block";
                } else {
                    option.style.display = "none";
                }
            });
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#jam-mulai", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
    </script>
@endpush
