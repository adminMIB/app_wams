@extends('layouts.main')
@section('content')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
<div class="section">
  <div class="section-header">
    <h2>Create Project Timeline</h2>
  </div>
  <div class="card">
    <div class="card-body">
      <form class="row g-5" action="{{route('simpan-data')}}" method="POST">
        {{csrf_field()}}

        <input type="hidden" id="no_sales" name="no_sales" class="form-control">
        <input type="hidden" id="tgl_sales" name="tgl_sales" class="form-control">
        <input type="hidden" id="kode_project" name="kode_project" class="form-control">
        <input type="hidden" id="hps" name="hps" class="form-control">
        <input type="hidden" id="nama_sales" name="nama_sales" class="form-control">

        <div class="col-md-4">
          <label for="id" class="form-label">ID</label>
          <select name="" id="id" class="form-control">
            <option value=""></option>
            @foreach($time as $t)
            <option value="{{$t->id}}">{{$t->id}}</option>
            @endforeach
          </select>
        </div>

        <div class="col-md-4">
          <label for="nama_institusi" class="form-label">Nama Institusi</label>
          <input type="text" class="form-control" id="nama_institusi" name="nama_institusi" readonly>
        </div>

        <div class="col-md-4">
          <label for="nama_project" class="form-label">Nama Project</label>
          <input type="text" class="form-control" id="nama_project" name="nama_project" readonly>
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

            </div>
          </div>
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
      $("#nama_institusi").val(res.nama_institusi)
      $("#nama_project").val(res.nama_project)
      $("#no_sales").val(res.no_sales)
      $("#tgl_sales").val(res.tgl_sales)
      $("#kode_project").val(res.kode_project)
      $("#hps").val(res.hps)
      $("#nama_sales").val(res.nama_sales)


    })
  });
</script>

@endsection