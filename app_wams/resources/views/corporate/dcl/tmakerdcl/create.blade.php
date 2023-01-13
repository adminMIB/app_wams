
<div class="p2">
    <div class="card">
    </div> 
    {{-- <div class="form-group d-flex"> --}}
        <form action="{{route('saveTMAC',$item->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{$item->id}}" name="cpt_id">
            <div class="mb-2 row">
                <label  class="col-sm-2 col-form-label" style="font-size: 12px">Tanggal PO</label>
                <div class="col-sm-10">
                    <div class="form-group">
                        <input type="date" class="form-control" name="tanggal_po" required>
                    </div>
                </div>
            </div>

            <div class="mb-2 row">
                <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nama Project</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_project" required>
                </div>
            </div> 
            
            <div class="mb-2 row">
                <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nama Client</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_client" required>
                </div>
            </div> 
            
            <div class="mb-2 row">
                <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nama EU</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_eu" required>
                </div>
            </div> 
            
            <div class="mb-2 row">
                <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nominal PO</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="nominal_po" required>
                </div>
            </div> 
            
            <div class="mb-2 row">
                <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nama SBU</label>
                <div class="col-sm-10">
                    <select name="nama_sbu" class="form-select">
                        <option value=""></option>
                        @foreach ($sbu as $it)
                            <option value="{{ $it->name }}">{{ $it->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div> 
            
            <div class="mb-2 row">
                <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nama PIC(Sales)</label>
                <div class="col-sm-10">
                    <select name="nama_pic" class="form-select">
                        <option value=""></option>
                        @foreach ($sbu as $item)
                            <option value="{{ $item->PicSales }}">{{ $item->PicSales }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-2 row">
                <label  class="col-sm-2 col-form-label" style="font-size: 12px">PIC Business Channel</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="pic_business_channel" required>
                </div>
            </div>

            <div class="mb-2 row">
                <label  class="col-sm-2 col-form-label" style="font-size: 12px">PO Client</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="file_po_client" required>
                </div>
            </div>
            
            <div class="mb-2 row">
                <label  class="col-sm-2 col-form-label" style="font-size: 12px">PO MIB</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="file_po_mib" required>
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