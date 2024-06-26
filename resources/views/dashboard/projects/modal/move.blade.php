<div class="modal fade" id="moveData" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content p-3 p-md-2">
            <button type="reset" class="btn-close btn-pinned close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-2" id="title-detail">Move Data</h3>
                    <p class="text-muted">Pindah Data Transaksi Maker.</p>
                </div>

                <form action="/project-maker/move" method="POST" id="moveForm">
                    @csrf
                    <input type="hidden" name="project" id="p_id">
                    <input type="hidden" name="pm_id" id="pm_id">
                    <div class="form-group row mb-3">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="type">
                            Pindah Opsi
                        </label>
                        <div class="col-sm-12 col-md-7">
                            <select name="type" class="form-control form-select" id="type" required>
                                <option value="" readonly>------PILIH------</option>
                                <option value="opty">Pindah Ke Opty</option>
                                <option value="project">Pindah Ke Project</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3" style="display: none" id="showOpty">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="type">
                            Pilih Opty
                        </label>
                        <div class="col-sm-12 col-md-7">
                            <select name="opty" class="select2 form-select form-select-md" id="opty" style="width: 100%;">
                                <option value="" readonly>------PILIH------</option>
                                @foreach ($optyData as $item)
                                    <option value="{{ $item->id }}">{{ $item->project_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3" style="display: none" id="showProject">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="type">
                            Pilih Project
                        </label>
                        <div class="col-sm-12 col-md-7">
                            <select name="project" class="select2 form-select form-select-md" id="project" style="width: 100%;">
                                <option value="" readonly>------PILIH------</option>
                                @foreach ($projectData as $item)
                                    <option value="{{ $item->id }}">{{ $item->project_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 text-center demo-vertical-spacing mt-10">
                        <button type="submit" class="btn btn-primary me-sm-3 me-1" id="btn-submit">
                            Submit
                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                        </button>
                        <button type="reset" class="btn btn-label-secondary close" data-bs-dismiss="modal" aria-label="Close">Discard</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
