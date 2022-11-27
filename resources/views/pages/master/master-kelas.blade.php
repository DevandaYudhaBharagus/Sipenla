@extends('layouts.master')
@section('title', 'Master Kelas')


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
                        <i class="fa fa-user-o me-1"></i> Data Kelas
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Role Master</h5>
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
                        <th width="11%">No</th>
                        <th width="25%%">Nama Kelas</th>
                        <th width="25%">Wali Kelas</th>
                        <th width="20%">Anggota Kelas</th>
                        <th width="200px">Aksi</th>
                    </tr>
                    <tr>
                        <td width="11%">1.</td>
                        <td width="25%">7D</td>
                        <td width="25%">Aziz Pranaja</td>
                        <td width="20%">
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
                        <td width="200px">
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
                        <td width="11%">2.</td>
                        <td width="25%">8D</td>
                        <td width="25%">Aziz Pranaja</td>
                        <td width="20%">
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
                        <td width="200px">
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
                        <td width="11%">3.</td>
                        <td width="25%">7A</td>
                        <td width="25%">Aziz Pranaja</td>
                        <td width="20%">
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
                        <td width="200px">
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
                        Tambah Data Kelas
                    </h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label for="" class="form-label">Kelas</label>
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>--- Pilih Kelas ---</option>
                                    <option value="1">7A</option>
                                    <option value="2">8A</option>
                                    <option value="3">8D</option>
                                </select>
                                <div class="down-form">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="" class="form-label">Wali Kelas</label>
                                <div class="select-box">
                                    <div class="options-container">
                                        <div class="option" id="option1">
                                            <input type="radio" class="radio" />
                                            <label for="film">Hadi Jaya Kusumo </label>
                                        </div>
                                        <div class="option">
                                            <input type="radio" class="radio" />
                                            <label for="film">Lorem ipsum, dolor sit </label>
                                        </div>
                                    </div>
                                    <div class="selected">
                                        --- Pilih Guru ---
                                    </div>
                                    <div class="down-form-kelas">
                                        <i class="fa fa-angle-down"></i>
                                    </div>
                                    <div class="search-box">
                                        <input type="text" placeholder="Pencarian..." />
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label for="" class="form-label">Anggota Kelas</label>
                                <div class="select-cekbox" id="select-cekbox">
                                    --- Pilih Anggota Kelas ---
                                </div>
                                <div class="down-form-full">
                                    <i class="fa fa-angle-down"></i>
                                </div>
                                <div class="ceklist-ready">
                                </div>
                                <div class="ceklist">
                                    <div class="cekbox-permission">
                                        <label class="checkbox" id="labelCekbox">Aziz Taher
                                            <input type="checkbox" name="" id="cekboxAnggota" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox" id="labelCekbox">Aziz saudara aldi taher
                                            <input type="checkbox" name="" id="cekboxAnggota" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox" id="labelCekbox">Lorem, ipsum dolor.
                                            <input type="checkbox" name="" id="cekboxAnggota" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox" id="labelCekbox">Lesti Pranaja
                                            <input type="checkbox" name="" id="cekboxAnggota" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox" id="labelCekbox">Lesti Pranaja
                                            <input type="checkbox" name="" id="cekboxAnggota" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                    <div class="cekbox-permission">
                                        <label class="checkbox" id="labelCekbox">Lesti Pranaja
                                            <input type="checkbox" name="" id="cekboxAnggota" />
                                            <span class="check"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-permission bg-red-permission me-md-3"
                                data-bs-dismiss="modal">
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
            const selected = document.querySelector(".selected");
            const optionsContainer = document.querySelector(".options-container");
            const searchBox = document.querySelector(".search-box input");

            const optionsList = document.querySelectorAll(".option");

            selected.addEventListener("click", () => {
                optionsContainer.classList.toggle("active");

                searchBox.value = "";
                filterList("");

                if (optionsContainer.classList.contains("active")) {
                    searchBox.focus();
                }
            });

            optionsList.forEach(o => {
                o.addEventListener("click", () => {
                    selected.innerHTML = o.querySelector("label").innerHTML;
                    optionsContainer.classList.remove("active");
                });
            });

            searchBox.addEventListener("keyup", function(e) {
                filterList(e.target.value);
            });

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
        <script>
            const selectCek = document.querySelector("#select-cekbox");
            const listName = document.querySelector(".ceklist");
            const boxCekbox = document.querySelectorAll("#cekboxAnggota");
            const labelCekbox = document.querySelectorAll("#labelCekbox")
            const ceklistReady = document.querySelector(".ceklist-ready");
            selectCek.addEventListener("click", () => {
                listName.classList.toggle("open");
            })
            for (let i = 0; i < boxCekbox.length; i++) {
                boxCekbox[i].addEventListener("click", () => {
                    if (boxCekbox[i].checked) {
                        const divCekbox = document.createElement("div");
                        divCekbox.setAttribute("class", "cekbox-permission");
                        const label = document.createElement("label");
                        label.setAttribute("class", "checkbox");
                        label.innerText = labelCekbox[i].innerText;
                        const input = document.createElement("input");
                        input.setAttribute("type", "checkbox");
                        input.setAttribute("checked", true);
                        const span = document.createElement("span");
                        span.setAttribute("class", "check");
                        label.appendChild(input);
                        label.appendChild(span);
                        divCekbox.appendChild(label);
                        ceklistReady.appendChild(divCekbox);
                    } else if (!boxCekbox[i].checked) {
                        const elem = boxCekbox[i].parentElement.parentElement.parentElement.parentElement.children[3]
                            .children;
                        console.log(elem[0]);
                        for (let j = 0; j < elem.length; j++) {
                            if (elem[j].innerText == labelCekbox[i].innerText) {
                                elem[j].remove();
                            }
                        }
                    }
                });
            }

            ceklistReady.addEventListener("click", getButtonElement);

            function getButtonElement(e) {
                if (e.target.classList.contains("checkbox")) {
                    const elemen = e.target.parentElement;
                    removeElement(elemen);
                    elemen.remove();
                }
            }

            function removeElement(elemen) {
                for (let i = 0; i < boxCekbox.length; i++) {
                    if (boxCekbox[i].parentElement.innerText == elemen.firstElementChild.innerText) {
                        boxCekbox[i].checked = false;
                    }
                }
            }
        </script>
    @endpush
