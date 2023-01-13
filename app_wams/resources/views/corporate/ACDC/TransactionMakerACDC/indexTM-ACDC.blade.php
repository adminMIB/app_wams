
<div class="p2">
  <div class="card">
  </div> 
  {{-- <div class="form-group d-flex"> --}}
      <form action="{{route('saveTMAC',$item->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" value="{{$item->id}}" name="cpt_id">
          <div class="mb-2 row">
              <label  class="col-sm-1 col-form-label" style="font-size: 12px">Tanggal</label>
              <div class="col-sm-10">
                  <div class="form-group">
                      <input type="date" class="form-control" name="tanggal">
                  </div>
              </div>
          </div>

          <div class="mb-2 row">
              <label  class="col-sm-1 col-form-label" style="font-size: 12px">Jenis Transaksi</label>
              <div class="col-sm-10">
                  <div class="form-group">
                    <select name="jenis_transaksi" class="form-control" id="">
                      <option value=""></option>
                      <option value="Transfer">Transfer</option>
                      <option value="Cash">Cash</option>
                      <option value="Payment">Payment</option>
                  </select>
                  </div>
              </div>
          </div>

          <div class="mb-2 row">
              <label  class="col-sm-1 col-form-label" style="font-size: 12px">Nama Tujuan</label>
              <div class="col-sm-10">
                  <div class="form-group">
                      <input type="text" class="form-control" name="nama_tujuan" id="">
                  </div>
              </div>
          </div>

          <div class="mb-2 row">
              <label  class="col-sm-1 col-form-label" style="font-size: 12px">Nominal</label>
              <div class="col-sm-10">
                  <div class="form-group">
                      <input type="text" class="form-control" name="nominal" id="">
                  </div>
              </div>
          </div>

          <div class="mb-2 row">
              <label  class="col-sm-1 col-form-label" style="font-size: 12px">Keterangan</label>
              <div class="col-sm-10">
                  <div class="form-group">
                      <input type="text" class="form-control" name="keterangan">
                  </div>
              </div>
          </div>

          <div class="mb-2 row">
            <label  class="col-sm-1 col-form-label" style="font-size: 12px">Upload Request</label>
            <div class="col-sm-10">
                <div class="form-group">
                    <input type="file" class="form-control" name="upload_request">
                </div>
            </div>
          </div>

          <div class="mb-2 row">
            <label  class="col-sm-1 col-form-label" style="font-size: 12px">Upload Release</label>
            <div class="col-sm-10">
                <div class="form-group">
                    <input type="file" class="form-control" name="upload_release">
                </div>
            </div>
          </div>
          
          <div class="modal-footer">
              <button type="submit" class="btn btn-sm btn-info" >Submit</button>
              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
          </button>
      </form>
  {{-- </div>     --}}
</div>
@section('js')
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>
@endsection