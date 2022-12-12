<h5>Permohonan Izin / Cuti</h5>
<form action="" method="post">
    <div class="mb-3">
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
        <input type="text" class="form-control" disabled
            value="{{ $employee->first_name . ' ' . $employee->last_name }}" />
    </div>
    <div class="mb-3">
        <label for="">NUPTK /ID Pegawai</label>
        <input type="text" class="form-control" disabled value="{{ $employee->nuptk }}" />
    </div>
    <div class="mb-3">
        <label for="">Kuota Cuti Tahunan</label>
        <input type="text" class="form-control" disabled value="{{ $employee->total_balance }}" />
    </div>
    <div class="mb-3">
        <label for="">Tanggal Mulai</label>
        <input type="text" name="application_from_date" id="application_from_date" placeholder="dd-mm-yy"
            class="form-control bg-calendar" />
    </div>
    <div class="mb-3">
        <label for="">Tanggal Berakhir</label>
        <input type="text" name="application_to_date" id="application_to_date" placeholder="dd-mm-yy"
            class="form-control bg-calendar" />
    </div>
    <div class="mb-3">
        <label for="">Keterangan Cuti</label>
        <input type="text" name="purpose" id="" class="form-control" placeholder="Keterangan Cuti" />
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
