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
          <label for="id" class="col-sm-3 col-form-label">No Sales Order</label>
          <div class="col-sm-9">
          <select id="id" class="form-control">
            <option selected></option>
            @foreach($data as $v)
            @if ($v->status !== 'Pending')
            <option value="{{$v->id}}">{{$v->no_so}}</option>
                
            @else
                
            @endif
            @endforeach
          </select>
          </div>
        </div>
        <input type="hidden" class="form-control" readonly name="no_sales" id="no_so" value="">
        <div class="form-group row">
            <label for="created_at" class="col-sm-3 col-form-label">Tanggal Sales Order</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" readonly name="tgl_sales" id="created_at" value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="name_user" class="col-sm-3 col-form-label">Nama Sales</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" readonly name="nama_sales" id="name_user" value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="institusi" class="col-sm-3 col-form-label">Nama Institusi</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" readonly name="nama_institusi" id="institusi" value=""> 
            </div>
        </div>
        <div class="form-group row">
            <label for="project" class="col-sm-3 col-form-label">Nama Project</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" readonly name="nama_project" id="project" value="">
            </div>
        </div>
      
        <div class="form-group row">
            <label for="hps" class="col-sm-3 col-form-label">HPS</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" readonly name="hps" id="hps" value="">
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
@section('js')
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script>
  $('#id').change(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      method: "POST",
      type: "JSON",
      data: {
        id: this.value
      },
      url: "/input_wo"
    }).done(function(res) {
      $("#no_so").val(res.no_so)
      $("#created_at").val(res.created_at.substr(0,10))
      $("#name_user").val(res.name_user)
      $("#institusi").val(res.institusi)
      $("#project").val(res.project)
      $("#hps").val(res.hps)
    })
  });
</script>
@endsection