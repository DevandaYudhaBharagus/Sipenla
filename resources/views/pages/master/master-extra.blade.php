@extends('layouts.master')
@section('title', 'Master Ekstrakulikuler')


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
                        <img src="{{ asset('images/internal-images/icon-extra.png') }}"
                            class="d-flex align-items-center me-1" width="16px" height="16px" alt=""> Data
                        Ekstrakulikuler
                    </div>
                </li>
            </ol>
        </nav>
    </div>
    <div class="box-content">
        <h5>Data Ekstrakulikuler</h5>
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
                        <th width="80%" class="text-start">Nama Ekstrakulikuler</th>
                        <th width="15%">Aksi</th>
                    </tr>
                    <tr>
                        <td width="11%">1.</td>
                        <td width="80%" class="text-start">Pramuka</td>
                        <td width="15%">
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
                        Tambah Data Ekstrakulikuler
                    </h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nama Ekstrakulikuler</label>
                                    <input type="text" class="form-control" id="" />
                                </div>
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

{{-- @push('addon-javascript')
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
@endpush --}}
