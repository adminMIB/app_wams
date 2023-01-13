<div class="p2">
    <div class="card">
        <div class="card-header">
            <div class="mb-2 row">
                <label  class="col-sm-1 col-form-label" style="font-size: 10px">Order By</label>
                <div class="col-sm-5">
                    <input type="text" class="form-control text-sm" value="{{$item->nama_client}}" readonly >
                </div>
                <div class="col-sm-2">
                    <input type="text" class="form-control text-sm" name="" id="" value="{{$item->mata_uang}}" readonly>
                </div>
                <label  class="col-sm-1 col-form-label" style="font-size: 10px">Number :</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control text-sm" name="no_penjualan" value="{{$item->no_penjualan}}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-1 col-form-label" style="font-size: 10px">Date</label>
                <div class="col-sm-3">
                    <input type="text" value="{{$item->tgl_penjualan}}" class="form-control text-sm" name="tgl_penjualan">
                </div>
            </div>
        </div>
    </div> 
    {{-- <div class="form-group d-flex"> --}}
        <form action="{{route('penawaran.status',$item->id)}}" method="POST">
            @csrf
            <div class="mb-2 row">
                <label  class="col-sm-1 col-form-label" style="font-size: 12px">Status</label>
                <div class="col-sm-10">
                    <div class="form-group">
                        <select class="form-select" name="status">
                            <option value="" ></option>
                            <option value="menunggu pesanan">Order</option>
                            <option value="Terproses">Invoice</option>
                        </select>
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


