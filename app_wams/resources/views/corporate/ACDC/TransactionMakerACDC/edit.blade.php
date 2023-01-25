<form action="{{route('update-TMACDC',$item->id)}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nama Tujuan</label>
        <div class="col-sm-10">
             <input name="nama_tujuan" type="text" class="form-control" value="{{ $item->nama_tujuan }}">
        </div>
    </div> 
    
    <div class="mb-2 row">
        <input type="hidden" name="cpt_id" value="{{ $item->cpt_id }}">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Jenis Transaksi</label>
        <div class="col-sm-10">
          <select name="jenis_transaksi" class="form-control">
            <option value=""></option>
                @php $type = ['Transfer', 'Cash', 'Payment'];  @endphp
                @foreach ($type as $val)
                    <option value="{{$val}}" {{ $item->jenis_transaksi == $val ? 'selected' : '' }}>
                        {{ $val }}
                    </option>                        
                @endforeach
            </select>
        </div>
    </div> 

    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nominal</label>
        <div class="col-sm-10">
            <input name="nominal" type="number" class="form-control" value="{{ $item->nominal }}">
        </div>
    </div> 

    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Keterangan</label>
        <div class="col-sm-10">
            <textarea name="keterangan" rows="10" class="form-control">{{ $item->keterangan }}</textarea>
        </div>
    </div> 
{{--     
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
    </div>  --}}
    
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-info" >Submit</button>
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
        <i class="bx bx-x d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Close</span>
        </button>
    </div>
</form>

<script>
    $(".select2").select2();

    // $("#client").select2().val($("#client_val")).trigger("change");
    
</script>