<h5>Tugas Dinas</h5>
<form action="" method="post">
    <div class="mb-3">
        <label for="">Nama Lengkap</label>
        <input type="text" name="" id="" class="form-control" placeholder="Nama Lengkap" />
    </div>
    <div class="mb-3">
        <label for="">NUPTK /ID Pegawai</label>
        <input type="text" name="" id="" class="form-control" placeholder="NUPTK" />
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
        <label for="">Jam</label>
        <input type="text" name="" id="time" class="form-control" placeholder="00:00" />
        <div class="icon-input">
            <i class="fa fa-clock-o"></i>
        </div>
    </div>
    <div class="mb-3">
        <label for="">Tempat</label>
        <input type="text" name="" id="" class="form-control" placeholder="Tempat" />
    </div>
    <div class="mb-3">
        <label for="">Keterangan Tugas</label>
        <input type="text" name="" id="" class="form-control" placeholder="Keterangan Tugas" />
    </div>
    <div class="mb-3">
        <label for="">Unggah Dokumen</label>
        <div class="upload-document" onclick="uploadDocument()">
            Pilih Dokumen
        </div>
        <input type="file" name="" id="document" style="display: none" class="form-control" multiple />
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
