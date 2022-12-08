<h5>Permohonan Izin / Cuti</h5>
<form action="" method="post">
    <div class="mb-3">
        {{-- <select class="form-select" aria-label="Default select example">
            <option selected>Jenis Cuti</option>
            <option value="cuti melahirkan">Cuti Melahirkan</option>
            <option value="cuti berobat">Cuti Berobat</option>
            <option value="cuti kematian ahli keluarga">
                Cuti Kematian Ahli Keluarga
            </option>
            <option value="cuti haji/umroh">
                Cuti Haji / Umroh
            </option>
            <option value="cuti lain-lain">Cuti Lain-lain</option>
        </select> --}}
        {{-- <div class="icon-input">
            <i class="fa fa-angle-down"></i>
        </div> --}}
        <select class="form-select" id="select-2-field" data-placeholder="Jenis Cuti">
            <option></option>
            <option>Cuti Melahirkan</option>
            <option>Cuti Berobat</option>
            <option>Cuti Kematian Ahli Keluarga</option>
            <option>Cuti Haji/Umroh</option>
            <option>Cuti lain-lain</option>
        </select>

    </div>
    <div class="mb-3">
        <label for="">Nama Lengkap</label>
        <input type="text" name="" id="" class="form-control" placeholder="Nama Lengkap" />
    </div>
    <div class="mb-3">
        <label for="">NUPTK /ID Pegawai</label>
        <input type="text" name="" id="" class="form-control" placeholder="NUPTK" />
    </div>
    <div class="mb-3">
        <label for="">Kuota Cuti Tahunan</label>
        <input type="text" name="" id="" class="form-control" placeholder="Kuota Cuti Tahunan" />
    </div>
    <div class="mb-3">
        <label for="">Tanggal Pengajuan</label>
        <input type="text" name="" id="date" placeholder="dd-mm-yy" class="form-control" />
        <div class="icon-input">
            <i class="fa fa-calendar"></i>
        </div>
    </div>
    <div class="mb-3">
        <label for="">Tanggal Mulai</label>
        <input type="text" name="" id="date" placeholder="dd-mm-yy" class="form-control" />
        <div class="icon-input">
            <i class="fa fa-calendar"></i>
        </div>
    </div>
    <div class="mb-3">
        <label for="">Tanggal Berakhir</label>
        <input type="text" name="" id="date" placeholder="dd-mm-yy" class="form-control" />
        <div class="icon-input">
            <i class="fa fa-calendar"></i>
        </div>
    </div>
    <div class="mb-3">
        <label for="">Lama Hari</label>
        <input type="number" name="" id="" class="form-control" placeholder="Lama Hari" />
    </div>
    <div class="mb-3">
        <label for="">Keterangan Cuti</label>
        <input type="text" name="" id="" class="form-control" placeholder="Keterangan Cuti" />
    </div>
    <div class="mb-3">
        <label for="">Pekerjaan Yang Ditinggalkan</label>
        <input type="text" name="" id="" class="form-control"
            placeholder="Pekerjaan Yang Ditinggalkan" />
    </div>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn-submit">Kirim</button>
    </div>
</form>
