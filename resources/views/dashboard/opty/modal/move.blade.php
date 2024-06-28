<div class="modal fade" id="moveData" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content p-3 p-md-2">
            <button type="reset" class="btn-close btn-pinned close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-2" id="title-detail">Move Data</h3>
                    <p class="text-muted">Memindahkan Data Opty Ke Project.</p>
                </div>

                <form action="" class="row" method="POST" id="moveForm">
                    @csrf
                    <input type="hidden" name="opty_id" id="op_id">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="id_project">
                        ID Project
                    </label>
                    <div class="col-sm-12 col-md-7">
                        <input
                            type="text"
                            class="form-control mb-2"
                            name="id_project"
                            id="id_project"
                            placeholder="ID Project"
                            autocomplete="off"
                            required
                        >
                        <p id="show-available"></p>
                    </div>
                    <div class="col-12 text-center demo-vertical-spacing">
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
