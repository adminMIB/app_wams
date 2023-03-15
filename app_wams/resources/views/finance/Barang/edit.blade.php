<div class="p2">
    {{-- <div class="form-group d-flex"> --}}
        <form action="{{route('update.barang',$brg->id)}}" method="POST">
            @csrf

            <div class="mb-2 row">
                <label  class="col-sm-1 col-form-label" style="font-size: 12px">Stuff Code</label>
                <div class="col-sm-10">
                    <input type="text" name="kode_barang" class="form-control" value="{{$brg->kode_barang}}" readonly>
                </div>
            </div>
            

            <div class="mb-2 row">
                <label  class="col-sm-1 col-form-label" style="font-size: 12px">Stuff Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama_barang"  value="{{$brg->nama_barang}}">
                </div>
            </div>
            <div class="mb-2 row">
                <label  class="col-sm-1 col-form-label" style="font-size: 12px">Type of Stuff</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="jenis_barang"  value="{{$brg->jenis_barang}}">
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


