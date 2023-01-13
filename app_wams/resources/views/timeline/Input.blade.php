@extends('layouts.main')
@section('content')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
<div class="section">
  <div class="section-header">
   
  </div>
  <nav class="navbar navbar-expand-lg" style="background-color: white; border-radius:15px" >
    <div class="container-fluid">
    {{-- <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button> --}}
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
        <li class="nav-item ">
            <a class="nav-link  "  href="{{route('detail_project',$cb->id)}}">LTO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('input',$cb->id)}}">Timeline</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('bast',$cb->id)}}">Bast</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="">Dokumen</a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="">Report</a>
        </li>
        </ul>
    </div>
    </div>
  </nav>
<br>
  <div class="card">
    <div class="card-body">
      <form class="row" action="{{route('simpan-data')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="container">
          <div class="row">
            <div class="column col-4">
              <input type="hidden" class="form-control" name="so_id" value="{{$cb->id}}">
                <div class="form-group">
                    <label for="exampleInputEmail1">No Sales Order</label>
                    <input type="text" class="form-control" name="no_sales" id="no_so" readonly value="{{$cb->no_so}}">
                </div>
                <div class="form-group">
                    <label>Tanggal Sales Order</label>
                    <div class="input-group date">
                        <input type="text" class="form-control datetimepicker-input" name="tgl_sales" id="tgl_so" value="{{$cb->tgl_so}}" readonly/>
                    </div>
                </div>
            </div>
            <div class="column col-4">
                <input type="hidden" class="form-control" name="nama_project" id="project" placeholder="Project" readonly>
                <div class="form-group">
                    <label>Nama Project</label>
                    <input type="text" class="form-control" value="{{$cb->project}}">
                </div>
                    <input type="hidden" name="hps" id="hps" class="form-control" value="{{$cb->estimated_amount}}"  readonly>
                    <div class="form-group">
                      <label for="kode_project">Kode Project</label>
                      <input type="text" class="form-control" id="kode_project" name="kode_project" value="{{$cb->kode_project}}" readonly>
                  </div>
            </div>
            <div class="column col-4">
                <div class="form-group">
                    <label for="institusi">Nama Institusi</label>
                    <input type="text" class="form-control" value="{{$cb->institusi}}" name="nama_institusi" id="institusi" placeholder="Institusi" readonly>
                </div>
                <input type="hidden" id="name_user" name="nama_sales" class="form-control">
                {{-- <div class="form-group">
                    <label>Upload File Document</label>
                    <input type="file" class="form-control" name="file_dokumen[]" multiple="multiple">
                </div> --}}
                {{-- <div class="form-group">
                    <label for="exampleInputEmail1">Nama Project</label>
                </div> --}}
            </div>
            <div class="column col-4">
              <div class="form-group">
                <label for="jenis_dokumen" >Nama Dokumen</label>
                <input type="text" name="nama_dokumen" id="" class="form-control">
              </div>
            </div>
            <div class="column col-4">
              <div class="form-group">
                <label for="" >Upload Dokumen</label>
                <input type="file" class="form-control" id="" name="upload_dokumen[]" multiple="multiple" >
              </div>
              <a href="#" class="adddok btn btn-success" style="float:right;"><i class="bi bi-plus"></i> </a>
            </div>
            <div class="dok"></div>
            
          </div>
        </div>
        <div class="container mt-5 mb-3">
          <div class="row">
            {{-- <div class="col-6 col-sm-4">
              <label for="" class="">PM</label>
              <input type="text" class="form-control" name="">
            </div> --}}
            <div class="col-6 col-sm-4">
              <label for="" class="">Nama PM</label>
              <select name="nama_pm[]" id="" class="form-control">
                <option value=""></option>
                <option value="{{auth()->user()->name}}">{{auth()->user()->name}}</option>
              </select>
            </div>
            <div class="col-6 col-sm-4">
              <label for="" class="">Star Date</label>
              <input type="date" class="form-control " name="start_date[]">
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
              <label for="" class="">Nama Technikal</label>
              <select name="nama_technical[]" id="" class="form-control">
                <option value=""></option>
                @foreach ($user as $l)
                @foreach($l->users as $a)
                <option value="{{$a->name}}">{{$a->name}}</option>
                @endforeach
                @endforeach
              </select>
            </div>
          </div>
          <a href="#" class="addtechnical btn btn-success" style="float:right;"><i class="bi bi-plus"></i> </a>
        </div>
        <div class="technical"></div>
        
        <div class="col-12">
          <a href="{{route('timeline')}}" class="btn btn-secondary" style="border-radius:3em ;"> <i class="fas fa-arrow-left"></i> Back</a>
          <button type="submit" class="btn btn-success " style="border-radius: 3em;">Save</button>
        </div>
      </form>
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
    var technical = '<div class="container"><div class="row"><div class="col-6 col-sm-5"><label for="" class="">Start Date</label><input type="date" class="form-control" name="start_date[]"> </div><div class="col-6 col-sm-5"><label for="" class="">Finish Date</label><input type="date" class="form-control" name="finish_date[]"></div><div class="w-100 d-none d-md-block"></div><div class="col-6 col-sm-5"><label for="" class="">Jenis Pekerjaan</label><input type="text" class="form-control" name="jenis_pekerjaan[]"></div><div class="col-6 col-sm-4"><label for="" class="">Nama PM</label><select name="nama_pm[]" id="" class="form-control"><option value=""></option><option value="{{auth()->user()->name}}">{{auth()->user()->name}}</option></select></div><div class="col-8 col-sm-5 "><label for="" class="">Nama Technikal</label><select name="nama_technical[]" id="" class="form-control"><option value=""></option>@foreach ($user as $l)@foreach($l->users as $a)<option value="{{$a->name}}">{{$a->name}}</option>@endforeach @endforeach</select><br><a href="#" class="remove btn btn-danger" style="float:right;"><i class="bi bi-trash"></i></a></form></div></div></div>';
    $('.technical').append(technical);
  };
  $('.remove').live('click', function() {
    $(this).parent().parent().parent().remove();
  });


  $('.adddok').on('click', function() {
    adddok();
  });

  function adddok() {
    var dok = '<div class="container"><div class="row"><div class="col-4 col-sm-4"><label for="" class="">Nama Dokumen</label><input type="text" class="form-control" name="nama_dokumen[]"> </div><div class="col-4 col-sm-4"><label for="" class="">Upload Dokumen</label><input type="file" class="form-control" name="upload_dokumen[]"></div><div class="w-100 d-none d-md-block"><br><a href="#" class="remove btn btn-danger" style="float:right;"><i class="bi bi-trash"></i></a></form></div></div></div>';
    $('.dok').append(dok);
  };
  $('.remove').live('click', function() {
    $(this).parent().parent().parent().remove();
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
          $("#so_id").val(res.id)
          $("#institusi").val(res.institusi)
          $("#project").val(res.project)
          $("#no_so").val(res.no_so)
          $("#tgl_so").val(res.tgl_so)
          $("#kode_project").val(res.kode_project)
          $("#hps").val(res.estimated_amount)
          $("#name_user").val(res.name_user)
          $("#file_project").val(res.file_project)
        
    })
  });
</script>




@endsection