<form action="{{route('update-TMReimbursement',$item->id)}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nama PIC Reimbursement</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="nama_pic_reimbursement" value="{{ $item->nama_pic_reimbursement }}" required readonly>
        </div>
    </div> 
    
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">PIC Business Channel</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="pic_business_channel" value="{{ $item->pic_business_channel }}" required readonly>
        </div>
    </div> 
    
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">ID</label>
        <div class="col-sm-10">
            <select name="opptyproject_id" class="form-select" id="">
                <option value="{{ $item->opptyproject_id }}" hidden>{{ $item->tmaker->jenis }} - {{ $item->tmaker->ID_opptyproject }}</option>
                @foreach ($opptprjt as $it)
                    <option value="{{ $it->id }}">{{ $it->jenis }} - {{ $it->ID_opptyproject }}</option>
                @endforeach
            </select>
        </div>
    </div> 
    
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-info" >Submit</button>
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
        <i class="bx bx-x d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Close</span>
        </button>
    </div>
</form>