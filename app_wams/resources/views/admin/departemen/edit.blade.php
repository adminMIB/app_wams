<div class="p2">
    {{-- <div class="form-group d-flex"> --}}
        <form action="{{route('departemen-update',$dept->id)}}" method="POST">
            @csrf
            <div class="mb-2 row">
                <label  class="col-sm-3 col-form-label" style="font-size: 12px">Department Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nama_departemen" value="{{$dept->nama_departemen}}">
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


