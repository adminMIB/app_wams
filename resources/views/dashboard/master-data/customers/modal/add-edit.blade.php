<div class="modal fade" id="addEditCustomers" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content p-3 p-md-5">
            <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="text-center mb-4">
                    <h3 class="mb-2" id="title-header">Add New Customer</h3>
                </div>
                <form id="addEditCustomerForm" class="row" onsubmit="return false">
                    @csrf
                    <input type="hidden" id="type">
                    <input type="hidden" id="cus_id">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="name">Nama Perusahaan</label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Nama Perusahaan" autocomplete="off" autofocus />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="no_npwp">NPWP Perusahaan</label>
                            <input type="text" id="no_npwp" name="no_npwp" class="form-control"
                                placeholder="NPWP Perusahaan" autofocus />
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label" for="address">Alamat Perusahaan</label>
                            <textarea name="address" id="address" rows="10" class="form-control" placeholder="Alamat Perusahaan"></textarea>
                        </div>
                        <div class="col-4 mb-3">
                            <label class="form-label" for="name_pic">Nama PIC</label>
                            <input type="text" id="pic_name" name="pic_name" class="form-control" placeholder="Nama PIC" autocomplete="off" autofocus />
                        </div>
                        <div class="col-4 mb-3">
                            <label class="form-label" for="email_pic">Nama PIC</label>
                            <input type="email" id="email_pic" name="email_pic" class="form-control" placeholder="Email PIC" autocomplete="off" autofocus />
                        </div>
                        <div class="col-4 mb-3">
                            <label class="form-label" for="phone_pic">No Telp PIC</label>
                            <input type="email" id="phone_pic" name="phone_pic" class="form-control" placeholder="No Telp PIC" autocomplete="off" autofocus />
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
