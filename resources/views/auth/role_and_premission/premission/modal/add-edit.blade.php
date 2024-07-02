<!-- Add Permission Modal -->
<div class="modal fade" id="addEditPremission" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-2" id="title-header">Add New Premission</h3>
                </div>
                <form id="addEditPremissionForm" class="row" onsubmit="return false">
                    @csrf
                    <input type="hidden" id="type">
                    <input type="hidden" id="premission_id">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Name" autocomplete="off" autofocus />
                        </div>
                        <!-- <div class="col-md-6 mb-3">
                            <label class="form-label" for="guard_name">Guard name</label>
                            <input type="text" id="guard_name" name="guard_name" class="form-control"
                                placeholder="Guard name" autofocus />
                        </div> -->
                        
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
