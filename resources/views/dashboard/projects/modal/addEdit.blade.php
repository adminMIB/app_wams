<form action="{{ isset($pm) ? route('project-maker.update', $pm->id) : route('project-maker.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @isset($pm)
        @method('PUT')
    @endisset

    <div class="form-group row mb-4">
        <input type="hidden" name="project_id" id="projectID">
        <label class="col-sm-2 col-form-label">Tanggal</label>
        <div class="col-sm-10">
            <div class="input-group">
                <span class="input-group-text"><i class="ti ti-calendar"></i></span>
                <input
                    type="text"
                    id="date_trx"
                    name="tanggal"
                    class="form-control"
                    placeholder="Tanggal Transaksi"
                    value="{{ old('tanggal', $pm->tanggal ?? '') }}"
                    required
                    readonly
                    autocomplete="off">
            </div>
        </div>
    </div>

    <div class="form-group row mb-4">
        <label class="col-sm-2 col-form-label">Nama Tujuan</label>
        <div class="col-sm-10">
            <input name="nama_tujuan" type="text" class="form-control"
                value="{{ old('nama_tujuan', $pm->nama_tujuan ?? '') }}" required autocomplete="off">
        </div>
    </div>

    <div class="form-group row mb-4">
        <label class="col-sm-2 col-form-label">Jenis Transaksi</label>
        <div class="col-sm-10">
            @php $jenis = ['transfer', 'cash', 'PO'] @endphp
            <select class="form-control form-select" name="jenis_transaksi" autocomplete="off" required>
                <option value="" readonly>----PILIH----</option>
                @foreach ($jenis as $item)
                    <option value="{{ $item }}"
                        {{ (old('jenis_transaksi') ?? ($pm->jenis_transaksi ?? '')) == $item ? 'selected' : '' }}>
                        {{ ucwords($item) }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row mb-4">
        <label class="col-sm-2 col-form-label">Nominal</label>
        <div class="col-sm-10">
            <input name="nominal" class="form-control nominal"
                value="{{ old('nominal', $pm->nominal ?? '') }}" required autocomplete="off">
        </div>
    </div>

    <div class="form-group row mb-4">
        <label class="col-sm-2 col-form-label">Keterangan</label>
        <div class="col-sm-10">
            @php
                $keteranganOptions = [
                    '1' => 'HPP',
                    '2' => 'Biaya BMT',
                    '3' => 'Fotocopy/Jilid',
                    '4' => 'Materai',
                    '5' => 'Biaya Pengiriman Dokumen',
                    '6' => 'Biaya Jaminan Asuransi',
                    '7' => 'Biaya Sertifikat Tenaga Ahli',
                    '8' => 'Biaya Training',
                    '9' => 'Entertain',
                    '10' => 'Tiket',
                    '11' => 'Hotel',
                    '12' => 'Sewa Mobil',
                    '13' => 'Uang Dinas',
                    '14' => 'Denda/Pinalty',
                    '15' => 'Biaya Lain-Lain',
                ];
            @endphp
            <select class="form-select form-select-md select2" name="keterangan" required style="width: 100%">
                <option value="">----PILIH----</option>
                @foreach ($keteranganOptions as $value => $label)
                    <option value="{{ $value }}" {{ (isset($pm) && $pm->keterangan == $value) ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row mb-4">
        <label class="col-sm-2 col-form-label">File</label>
        <div class="col-sm-10">
            <input
                type="file"
                name="file"
                id="file"
                class="form-control"
                accept="application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
            <p class="text-danger">{{ $errors->first('file') }}</p>
            @isset($pm)
                <p class="text-muted">Biarkan kosong jika tidak ingin mengganti file</p>
            @endisset
        </div>
    </div>

    <div class="col-12 text-center demo-vertical-spacing">
        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal" aria-label="Close">Discard</button>
    </div>
</form>
