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
            <input type="text" class="form-control" name="nama_pic_reimbursement" required>
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
            <input type="text" class="form-control" name="client" required>
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
            <input type="file" class="form-control" name="file_kwitansi" required>
        </div>
    </div>
    
    <div class="mb-2 row">
        <label  class="col-sm-2 col-form-label" style="font-size: 12px">MoM</label>
        <div class="col-sm-10">
            <input type="file" class="form-control" name="file_MoM" required>
        </div>
    </div>
    <div class="text-end">
        <a href="{{ route('TMReimbursement') }}" class="btn btn-secondary">Back</a>
        <button type="submit" class="btn btn-success">Kirim</button>
    </div>
</form>