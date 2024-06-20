



    <div class="modal fade" id="pindahDataReimbursementMaker" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content p-3 p-md-5">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h3 class="mb-2" id="title-header">Move Transaction Maker {{ $reimbursement['id'] }}</h3>
                    </div>
                    <form id="addEditReimbursementFormMaker" class="row" action="{{ route('reimbursement-maker-move-transaction.update', $reimbursement['id']) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" id="type" name="type">
                        <input type="hidden" id="id_maker" name="id_maker" >
                        <input type="hidden" id="rembursement_id" name="rembursement_id" value="{{ $reimbursement['id'] }}">
                        <input type="hidden" name="_method" id="_method" value="">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label" for="id_project_reimbursement">ID Projects Reimbursement </label>
                                <select id="id_project_reimbursement"
                                        name="id_project_reimbursement"
                                        class="select2 form-select form-select-lg"
                                        data-allow-clear="true"
                                        autofocus>
                                    <option value="">----Pilih----</option>
                                    @foreach ($dataIDReimbursements as $item)
                                        <option value="{{ $item->id_reimbursement }}" {{ $item->id_reimbursement == $reimbursement['id_reimbursement'] ? 'selected' : '' }}>
                                            {{ $item->id_reimbursement }}
                                        </option>
                                    @endforeach
                                </select>
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
