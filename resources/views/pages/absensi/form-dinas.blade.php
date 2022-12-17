<h5>Tugas Dinas</h5>
<form action="{{ url('absensi/duty') }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="">Nama Lengkap</label>
        <input type="text" class="form-control" disabled */
            value=" {{ $employee->first_name . ' ' . $employee->last_name }}" />
    </div>
    <div class="mb-3">
        <label for="">NUPTK /ID Pegawai</label>
        <input type="text" class="form-control" disabled value="{{ $employee->nuptk }}" />
    </div>
    <div class="mb-3">
        <label for="">Tanggal Mulai</label>
        <input type="text" name="duty_from_date" id="duty_from_date" placeholder="dd-mm-yy"
            class="form-control bg-calendar" />
    </div>
    <div class="mb-3">
        <label for="">Tanggal Berakhir</label>
        <input type="text" name="duty_to_date" id="duty_to_date" placeholder="dd-mm-yy"
            class="form-control bg-calendar" />
    </div>
    <div class="mb-3">
        <label for="">Jam</label>
        <input type="text" name="time" id="time" class="form-control bg-time" placeholder="00:00" />
    </div>
    <div class="mb-3">
        <label for="">Tempat</label>
        <input type="text" name="place" id="" class="form-control" placeholder="Tempat" />
    </div>
    <div class="mb-3">
        <label for="">Keterangan Tugas</label>
        <input type="text" name="purpose" id="" class="form-control" placeholder="Keterangan Tugas" />
    </div>
    <div class="mb-3">
        <label for="">Unggah Dokumen</label>
        <input type="file" name="" id="documentCuti" multiple style="display:none">
        <div class="upload-document" onclick="uploadDocument()">
            Pilih Dokumen
        </div>
        <input type="file" name="attachment" id="document" style="display: none" class="form-control" multiple />
    </div>
    <div class="mb-3">
        <label for="">Pekerjaan Yang Ditinggalkan</label>
        <input type="text" name="abandoned_job" id="" class="form-control"
            placeholder="Pekerjaan Yang Ditinggalkan" />
    </div>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn-submit">Kirim</button>
    </div>
</form>
