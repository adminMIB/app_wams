@extends('layouts.main')
@section('content')


<section class="section">
  
  <div class="card">
    <div class="card-header">
      <h1>Input Work Orders</h1>
    </div>
    <div class="card-body">
      <form action="{{route('/inputWo/sendPmLead')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
      {{-- cek jika status pending jangan ditampilkan --}}
   
       
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">No Sales Order</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" readonly  name="no_sales" id="inputEmail3" value="{{$detailId->no_so}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail2" class="col-sm-3 col-form-label">Tanggal Sales Order</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" readonly name="tgl_sales" id="inputEmail2" value="{{$detailId->updated_at}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Sales</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" readonly name="nama_sales" id="inputEmail3" placeholder="Institusi" value="{{$detailId->name_user}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Institusi</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" readonly name="nama_institusi" id="inputEmail3" placeholder="Institusi" value="{{$detailId->institusi}}"> 
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Project</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" readonly name="nama_project" id="inputEmail3" placeholder="Project" value="{{$detailId->project}}">
            </div>
        </div>
      
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">HPS</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" readonly name="hps" id="inputEmail3" placeholder="editor name" value="{{$detailId->hps}}">
            </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail5" class="col-sm-3 col-form-label">Sign to WO</label>
          <div class="col-sm-9">
            <select class="form-control select2"  style="width: 100%;" name="sign_pm_lead" id="inputEmail5">
              <option></option>
              @foreach ($user as $item)
                  @foreach ($item->users as $user)
                  <option class="" name="sign_pm_lead" value="{{$user->id}}">{{$user->name }}</option>
                  @endforeach
              @endforeach
             
            </select>
          </div>
        </div>
        <div class="text-right">
          <button class="btn btn-primary mt-5 d-flex flex-end">Kirim</button>
        </div>
      
        
      </form>


    </div>
  </div>
</section>
@endsection