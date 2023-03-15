@php
    $personal = \Illuminate\Support\Facades\DB::table('personel_teams')->select('id', 'nama_personel')->get();
    $customer =  \Illuminate\Support\Facades\DB::table('customers')->select('id', 'nama')->get();
@endphp
<form action="{{ route('store-TMReimbursement') }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" value="{{$item->id}}" name="opptyproject_id">
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Tanggal Reimbursement</label>
        <div class="col-sm-10">
            <input type="date" class="form-control" name="tanggal_reimbursement" required>
        </div>
    </div> 
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nama PIC Reimbursement</label>
        <div class="col-sm-10">
            <select name="nama_pic_reimbursement" class="form-control">
                <option value="" readonly>------PILIH------</option>
                @foreach($personal as $val)
                    <option value="{{ $val->nama_personel }}">
                        {{ $val->nama_personel }}
                    </option>
                @endforeach
            </select>
        </div>
    </div> 
    
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Nominal Reimbursement</label>
        <div class="col-sm-10">
            <input type="number" class="form-control" name="nominal_reimbursement" required>
        </div>
    </div> 
    
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">PIC Business Channel</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="pic_business_channel" required>
        </div>
    </div> 
    
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Client</label>
        <div class="col-sm-10">
            <select name="client" class="form-control">
                <option value="" reaadonly>------PILIH------</option>
                @foreach($customer as $val)
                    <option value="{{ $val->nama }}">
                        {{ $val->nama }}
                    </option>
                @endforeach
            </select>
        </div>
    </div> 
    
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">PIC Client</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="pic_client" required>
        </div>
    </div> 
    
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Kwitansi</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="file_kwitansi" accept="image/*, application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
        </div>
    </div>
    
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">MoM</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="file_MoM" accept="image/*, application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
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