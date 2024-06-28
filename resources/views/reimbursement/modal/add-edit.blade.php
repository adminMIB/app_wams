<div class="modal fade" id="addEditReimbursement" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-2" id="title-header">Add New Reimbursement</h3>
                </div>
                <form id="addEditReimbursementForm" class="row" enctype="multipart/form-data" method="POST">
                    @csrf
                    <input type="hidden" id="type" name="type">
                    <input type="hidden" id="rembursement_id" name="rembursement_id">
                    <input type="hidden" name="_method" id="_method" value="">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="id_reimbursement">ID Reimbursement </label>
                            <input type="text" id="id_reimbursement" name="id_reimbursement" class="form-control"
                                placeholder="ID Reimbursement" autocomplete="off" autofocus />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="nama_project">Nama Project</label>
                            <select id="nama_project"
                                    name="nama_project"
                                    class="select2 form-select form-select-lg"
                                    data-allow-clear="true"
                                    autofocus>
                                <option value="">----Pilih----</option>
                                @foreach ($projects as $item)
                                    <option value="{{ $item->id }}">{{ $item->project_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="pic_businees_channels">PIC Business Channel</label>
                            <input type="text" id="pic_businees_channels" name="pic_businees_channels"
                                class="form-control" placeholder="PIC Business Channel" autofocus />
                        </div>
                     
                        <div class="col-12 mb-3">
                            <label class="form-label" for="keterangan">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="10" class="form-control"
                                placeholder="Keterangan"></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="file">File</label>
                            <input type="file" id="file" name="file" class="form-control"
                                accept="application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                            <p id="file-info" class="text-muted mt-2">Biarkan kosong jika tidak ingin mengganti file</p>
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
