<div class="modal fade" id="addEditOptyMakerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content p-3 p-md-2">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-4" id="title-detail">Create Opty Maker</h3>
                </div>

                <form id="addEditOptyMakerFrom" class="row" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="date_trx">
                                Tanggal Transaksi
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input type="date" class="form-control" name="date_trx" id="date_trx"
                                    placeholder="Tanggal Transaksi" autocomplete="Off" required>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Transaksi</label>
                            <div class="col-sm-12 col-md-7">
                                <select
                                    class="form-control"
                                    name="jenis_trx"
                                    id="jenis_trx"
                                    autocomplete="Off"
                                    required
                                >
                                    <option value="">----PILIH----</option>
                                    <option value="transfer">Transfer</option>
                                    <option value="cash">Cash</option>
                                    <option value="PO">PO</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="nominal_trx">
                                Nominal Transaksi
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input
                                        type="text"
                                        class="form-control uang"
                                        id="nominal_trx"
                                        name="nominal_trx"
                                        min=1 required autocomplete="off">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="nama_penerima">
                                Nama Penerima
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="nama_penerima"
                                    id="nama_penerima"
                                    placeholder="Nama Penerima"
                                    autocomplete="Off"
                                    required
                                >
                                <p class="text-danger">{{ $errors->first('nama_penerima') }}</p>
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="keterangan">
                                Keterangan Kode Akun
                            </label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control select2" name="keterangan" id="keterangan" required style="width: 100%">
                                    <option value="">----PILIH----</option>
                                    <option value="1">HPP</option>
                                    <option value="2">Biaya BMT</option>
                                    <option value="3">Fotocopy/Jilid</option>
                                    <option value="4">Materai</option>
                                    <option value="5">Biaya Pengiriman Dokumen</option>
                                    <option value="6">Biaya Jaminan Asuransi</option>
                                    <option value="7">Biaya Sertifikat Tenaga Ahli</option>
                                    <option value="8">Biaya Training</option>
                                    <option value="9">Entertain</option>
                                    <option value="10">Tiket</option>
                                    <option value="11">Hotel</option>
                                    <option value="12">Sewa Mobil</option>
                                    <option value="13">Uang Dinas</option>
                                    <option value="14">Denda/Pinalty</option>
                                    <option value="15">Biaya Lain-Lain</option>
                                </select>
                                <p class="text-danger">{{ $errors->first('keterangan') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center demo-vertical-spacing">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">Discard</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Add Permission Modal -->
