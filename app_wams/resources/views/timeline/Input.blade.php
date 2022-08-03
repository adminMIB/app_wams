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

      <div class="col-md-4">
        <label for="id" class="form-label">ID</label>
        <select name="" id="id" class="form-control" >
          <option value="">--pilih id--</option>
          @foreach($time as $t)
          <option value="{{$t->id}}">{{$t->id}}</option>
          @endforeach
        </select>
      </div>

      <div class="col-md-4">
        <label for="institusi" class="form-label">Nama Institusi</label>
        <input type="text" class="form-control" id="institusi" name="institusi" readonly>
      </div>

      <div class="col-md-4">
        <label for="project" class="form-label">Nama Project</label>
        <input type="text" class="form-control" id="project" name="project" readonly>
      </div>



      <div class="col-md-3">
        <label for="" class="form-label">Star Date</label>
        <input type="date" class="form-control" name="start_date[]">
      </div>
      <div class="col-md-3">
        <label for="" class="form-label">Finis Date</label>
        <input type="date" class="form-control" name="finish_date[]">
      </div>

      <div class="col-md-3">
        <label for="" class="form-label">Jenis Pekerjaan</label>
        <input type="text" class="form-control" name="jenis_pekerjaan[]">
      </div>

      <div class="col-md-3">
        <label for="" class="form-label">Nama Technical</label>
        <select name="nama_technical[]" id="" class="form-control">
          @foreach($b as $t)
          <option value="{{$t->name}}">{{$t->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="technical"></div>
  </div>
</div>

<br>
<div class="col-12">
  <button type="submit" class="btn btn-primary">Save</button>
  <a href="{{route('timeline')}}" class="btn btn-danger">Back</a>
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
    var technical = '<div class="col-md-12"><label for="" class="">Star Date</label><input type="date" class="form-control" name="start_date[]"> </div> <div class="col-md-12"> <label for="" class="">Finis Date</label><input type="date" class="form-control" name="finish_date[]"></div> <div class="col-md-12"><label for="" class="">Jenis Pekerjaan</label><input type="text" class="form-control" name="jenis_pekerjaan[]"></div><div class="col-md-12"><label for="" class="">Nama Technical</label><select name="nama_technical[]" id="" class="form-control">@foreach($b as $t)<option value="{{$t->name}}">{{$t->name}}</option>@endforeach</select>';
    $('.technical').append(technical);
  };
  $('.remove').live('click', function() {
    $(this).parent().parent().remove();
  });
</script>

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
        url: "/list-project"
      }).done(function(res) {
        $("#institusi").val(res.institusi)
        $("#project").val(res.project)
      })
    });
  </script>

@endsection