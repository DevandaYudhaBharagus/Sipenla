<h5>Permohonan Izin / Cuti</h5>
<form action="{{ url('absensi/cuti') }}" method="post">
    @csrf
    <div class="mb-3">
        <select class="form-select" id="cuti" name="leave_type_id" aria-label="Default select example">
            <option selected value="">Jenis Cuti</option>
            @foreach ( $leave as $l )
                <option value="{{ $l->leave_type_id }}">{{ $l->leave_type_name }}</option>
            @endforeach
        </select>
        <div class="icon-input">
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
    <div class="mb-3">
        <label for="">Nama Lengkap</label>
        <input type="text" class="form-control" disabled value="{{$employee->first_name. ' '. $employee->last_name}}" />
    </div>
    <div class="mb-3">
        <label for="">NUPTK /ID Pegawai</label>
        <input type="text" class="form-control" disabled value="{{$employee->nuptk}}" />
    </div>
    <div class="mb-3">
        <label for="">Kuota Cuti Tahunan</label>
        <input type="text" class="form-control" disabled value="{{$employee->total_balance}}"/>
    </div>
    <div class="mb-3">
        <label for="">Tanggal Mulai</label>
        <input type="text" name="application_from_date" id="application_from_date" placeholder="dd-mm-yy" class="form-control" />
        <div class="icon-input">
            <i class="fa fa-calendar"></i>
        </div>
    </div>
    <div class="mb-3">
        <label for="">Tanggal Berakhir</label>
        <input type="text" name="application_to_date" id="application_to_date" placeholder="dd-mm-yy" class="form-control" />
        <div class="icon-input">
            <i class="fa fa-calendar"></i>
        </div>
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
