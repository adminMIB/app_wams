
<div class="p2">
  <div class="card">
  </div> 
  {{-- <div class="form-group d-flex"> --}}
      <form action="{{route('saveTMCMM',$item->id)}}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="hidden" value="{{$item->id}}" name="cmm_id">
          <div class="mb-2 row">
              <label  class="col-sm-1 col-form-label" style="font-size: 12px">Tanggal PO</label>
              <div class="col-sm-10">
                  <div class="form-group">
                      <input type="date" class="form-control" name="tgl_po">
                  </div>
              </div>
          </div>

          <div class="mb-2 row">
              <label  class="col-sm-1 col-form-label" style="font-size: 12px">Project Name</label>
              <div class="col-sm-10">
                  <div class="form-group">
                    <input type="text" name="nama_project" class="form-control">
                  </div>
              </div>
          </div>

          <div class="mb-2 row">
              <label  class="col-sm-1 col-form-label" style="font-size: 12px">Client Name</label>
              <div class="col-sm-10">
                  <div class="form-group">
                      <input type="text" class="form-control" name="nama_klien" id="">
                  </div>
              </div>
          </div>

          <div class="mb-2 row">
              <label  class="col-sm-1 col-form-label" style="font-size: 12px">EU Name</label>
              <div class="col-sm-10">
                  <div class="form-group">
                      <input type="text" class="form-control" name="nama_eu" id="">
                  </div>
              </div>
          </div>

          <div class="mb-2 row">
              <label  class="col-sm-1 col-form-label" style="font-size: 12px">Nominal PO</label>
              <div class="col-sm-10">
                  <div class="form-group">
                      <input type="number" class="form-control" name="nominal_po">
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