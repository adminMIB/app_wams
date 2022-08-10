<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal{{$item->id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12">
                        <!-- <div class="card"> -->
                        <!-- <div class="card-header">
        <h4>HTML5 Form Basic</h4>
      </div> -->
                        <!-- <div class="card-body"> -->
                        <!-- <div class="alert alert-info">
          <b>Note!</b> Not all browsers support HTML5 type input.
        </div> -->

                        <div class="form-group">
                            <label>No WO</label>
                            <input type="text" class="form-control" value="{{$item->no_sales}}">
                        </div>
                        <div class="form-group">
                            <label>Tanggal WO</label>
                            <input type="text" class="form-control" value="{{$item->tgl_sales}}">
                        </div>
                        <div class="form-group">
                            <label>Kode Project</label>
                            <input type="text" class="form-control" value="B{{$item->kode_project}}">
                        </div>
                        <div class="form-group">
                            <label>Nama Institusi</label>
                            <input type="text" class="form-control" value="{{$item->nama_institusi}}">
                        </div>
                        <div class="form-group">
                            <label>Nama Project</label>
                            <input type="text" class="form-control" value="{{$item->nama_project}}">
                        </div>
                        <div class="form-group">
                            <label>Nama Sales</label>
                            <input type="text" class="form-control" value="{{$item->nama_sales}}">
                        </div>
                        <div class="form-group">
                            <label>HPS</label>
                            <input type="text" class="form-control" value="{{$item->hps}}">
                        </div>

                        <!-- </div> -->
                        <!-- </div> -->
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</div>