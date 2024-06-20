



<div class="modal fade" id="addEditReimbursementMaker" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-2" id="title-header">Add New Transaction Maker </h3>
                </div>
                <form id="addEditReimbursementFormMaker" class="row" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" id="type" name="type">
                    <input type="hidden" id="id" name="id" >
                    <input type="hidden" id="rembursement_id" name="rembursement_id" value="{{ $reimbursement['id'] }}">
                    <input type="hidden" name="_method" id="_method" value="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="tanggal_reimbursement">Tanggal Reimbursement </label>
                            <input type="date" id="tanggal_reimbursement" name="tanggal_reimbursement" class="form-control"
                                autocomplete="off" autofocus />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama_pic">Nama PIC Reimbursement </label>
                            <!-- <input type="text" id="nama_pic" name="nama_pic" class="form-control" placeholder="nama_pic"
                                autofocus value="{{ $reimbursement['pic_bussiness_channel'] }}" /> -->
                             <select id="nama_pic"
                                    name="nama_pic"
                                    class="select2 form-select form-select-lg"
                                    data-allow-clear="true"
                                    autofocus>
                                <option value="">----Pilih----</option>
                                @foreach ($personelTeams as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">    
                            <label class="form-label" for="nominal_reimbursement">Nominal Reimbursement</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="rp">Rp</span>
                                        <input
                                            type="text"
                                            id="nominal_reimbursement"
                                            name="nominal_reimbursement"
                                            class="form-control nominal"
                                            placeholder="Nominal"
                                            autofocus
                                            autocomplete="off"
                                            value="{{ old('nominal', isset($opty) ? number_format($opty->nominal) : '') 
                                        }}">
                                    </div>
                                    <p class="text-danger">{{ $errors->first('nominal') }}</p>
                        </div>
                     
                        <div class="col-12 mb-3">
                            <label class="form-label" for="file_kwitansi">File Kwitansi</label>
                            <input type="file" id="file_kwitansi" name="file_kwitansi" class="form-control"
                                accept="application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            <p id="file-info" class="text-muted mt-2">Biarkan kosong jika tidak ingin mengganti file</p>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="file_mom">File MoM</label>
                            <input type="file" id="file_mom" name="file_mom" class="form-control"
                                accept="application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            <p id="file-info2" class="text-muted mt-2">Biarkan kosong jika tidak ingin mengganti file</p>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="10" class="form-control"
                                placeholder="Keterangan"></textarea>
                        </div>
                        <div class="col-12 text-center demo-vertical-spacing">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
                            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Discard</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
