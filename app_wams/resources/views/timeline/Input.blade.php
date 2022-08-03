@extends('layouts.main')
@section('content')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

<div class="card">
  <h3 class="font-weight-bold">Create Project Timeline</h3>
  <div class="card-body">

    <br>
  </div>
  <div class="card-body">

    <form class="row g-5" action="{{route('simpan-data')}}" method="POST">
      {{csrf_field()}}
     <div class="col-md-6">
        @foreach($time as $l)
        <label for="" class="form-label">Nama Institusi</label>
        <input type="text" class="form-control" id="" value="{{$l->projects->institusi}}" >
      
      </div>
      <div class="col-6">
    
        <label for="" class="form-label">Nama Project</label>
        <input type="text" class="form-control" id="" placeholder="" value="{{$l->projects->project}}">
        @endforeach
      </div> 

      <div class="container mt-5 mb-3">
        <div class="row">
          <div class="col-6 col-sm-4">
            <label for="" class="">Star Date</label>
            <input type="date" class="form-control" name="start_date[]"> 
          </div>
          <div class="col-6 col-sm-4">
            <label for="" class="">Finis Date</label>
            <input type="date" class="form-control" name="finish_date[]">
          </div>
          <div class="w-100 d-none d-md-block"></div>
          <div class="col-6 col-sm-4">
            <label for="" class="">Jenis Pekerjaan</label>
            <input type="text" class="form-control" name="jenis_pekerjaan[]">
          </div>
          <div class="col-6 col-sm-4">
            <label for="" class="">Nama Technical</label>
            <select name="nama_technical[]" id="" class="form-control">
              @foreach($b as $t)
              <option value="{{$t->name}}">{{$t->name}}</option>
              @endforeach
            </select>
          </form>
          </div>
        </div>
      </div>

      


      </div>
      <div class="technical"></div>
  </div>
</div>

<br>
<div class="col-12">
  <a href=""><button type="submit" class="btn btn-primary btn-sm">Save</button></a>
</div>

</form>




<br>
<a href="#"><button class="addtechnical btn btn-success btn-sm" style="float:right ;">Tambah</button></a>
</div>
</div>

@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
  $('.addtechnical').on('click', function() {
    addtechnical();
  });

  function addtechnical() {
    var technical = '<div class="container"><div class="row"><div class="col-6 col-sm-4"><label for="" class="">Star Date</label><input type="date" class="form-control" name="start_date[]"> </div><div class="col-6 col-sm-4"><label for="" class="">Finis Date</label><input type="date" class="form-control" name="finish_date[]"></div><div class="w-100 d-none d-md-block"></div><div class="col-6 col-sm-4"><label for="" class="">Jenis Pekerjaan</label><input type="text" class="form-control" name="jenis_pekerjaan[]"></div><div class="col-6 col-sm-4"><label for="" class="">Nama Technical</label><select name="nama_technical[]" id="" class="form-control">@foreach($b as $t)<option value="{{$t->name}}">{{$t->name}}</option>@endforeach</select></form></div></div></div>';
    $('.technical').append(technical);
  };
  $('.remove').live('click', function() {
    $(this).parent().parent().remove();
  });
</script>

@endsection