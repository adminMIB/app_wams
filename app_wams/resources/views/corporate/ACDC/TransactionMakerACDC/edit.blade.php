<form action="{{ route('update-TMACDC', $item->id) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="mb-2 row">
        <label class="col-sm-2 col-form-label" style="font-size: 12px">Nama Tujuan</label>
        <div class="col-sm-10">
            <input name="nama_tujuan" type="text" class="form-control" value="{{ $item->nama_tujuan }}">
        </div>
    </div>

    <div class="mb-2 row">
        <input type="hidden" name="cpt_id" value="{{ $item->cpt_id }}">
        <label class="col-sm-2 col-form-label" style="font-size: 12px">Jenis Transaksi</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="jenis_transaksi" value="{{ $item->jenis_transaksi }}">
        </div>

        <div class="mb-2 row">
            <label class="col-sm-2 col-form-label" style="font-size: 12px">Nominal</label>
            <div class="col-sm-10">
                <input name="nominal" type="number" class="form-control" value="{{ $item->nominal }}">
            </div>
        </div>

        <div class="mb-2 row">
            <label class="col-sm-2 col-form-label" style="font-size: 12px">Keterangan</label>
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
                <select class="form-control select2" name="keterangan" required style="width: 100%">
                    <option value="">----PILIH----</option>
                    @foreach($keteranganOptions as $value => $label)
                        <option value="{{ $value }}" {{ $item->keterangan == $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-sm btn-info">Submit</button>
            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                <i class="bx bx-x d-block d-sm-none"></i>
                <span class="d-none d-sm-block">Close</span>
            </button>
        </div>
</form>

<script>
    $(".select2").select2();

    // $("#client").select2().val($("#client_val")).trigger("change");
</script>
