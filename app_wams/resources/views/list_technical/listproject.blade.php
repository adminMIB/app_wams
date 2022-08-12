@extends('layouts.main')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
@include('sweetalert::alert')
<section class="section">
  <div class="section-header">
    <h2>List Project Technikal</h2>
  </div>
  <div class="card">
    <div class="card-body">
      <form action="{{route ('simpan-list')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}

        <input type="hidden" name="kode_project" id="kode_project" class="form-control">
        <input type="hidden" name="tgl_sales" id="tgl_sales" class="form-control">
        <input type="hidden" name="no_sales" id="no_sales" class="form-control">
        <div class="row">
          <div class="col">
            <label for="id" class="form-label">Project ID</label>
            <select id="id" class="form-control" name="project_id">
              <option value=""></option>
              @foreach($list as $v)
              <!-- @if (Auth::user()->id == $v->sign_pm) -->
              <option value="{{$v->id}}">{{$v->kode_project}}</option>
              <!-- @endif -->
              @endforeach
            </select>
            @error('project_id')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>


          <div class="col-sm-3">
            <label for="code" class="form-label">Nama Institusi</label>
            <input type="text" id="nama_institusi" name="nama_institusi" class="form-control @error('institusi') is-invalid @enderror" readonly required>
            @error('institusi')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="col-sm-3">
            <label for="institusi" class="form-label">Nama Sales</label>
            <input type="text" id="nama_sales" name="nama_sales" class="form-control @error('name_user') is-invalid @enderror" readonly required>
            @error('name_user')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>
        <br>

        <div class="row g-3">
          <div class="col-sm-6">
            <label for="project" class="form-label">Nama Project</label>
            <input type="text" id="nama_project" name="nama_project" class="form-control @error('project') is-invalid @enderror" readonly required>
            @error('project')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>


          <div class="col-sm-3">
            <label for="jenis_dokumen" class="form-label">Jenis Dokumen</label>
            <select name="jenis_dokumen" id="jenis_dokumen" class="form-control @error('jenis_dokumen') is-invalid @enderror">
              <option selected>Pilih Dokumen</option>
              <option value="pdf">Pdf</option>
              <option value="doc">Doc</option>
              <option value="excel">Excel</option>
            </select>
            @error('jenis_dokumen')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>

          <div class="col-sm">
            <label for="upload_dokumen" class="form-label">Upload Dokumen</label>
            <input type="file" name="upload_dokumen[]" multiple="multiple" class="form-control @error('upload_dokumen') is-invalid @enderror">
            @error('upload_dokumen')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>

        <br>
        <div class="row g-3">
          <div class="col-sm-6">
            <label for="project" class="form-label">HPS</label>
            <input type="text" id="hps" name="hps" class="form-control @error('hps') is-invalid @enderror" readonly required>
            @error('hps')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>


          <div class="col-sm-5">
            <label for="id_label_multiple" class="form-label">Sign Tecnikal</label>
            <select class="form-control select2" multiple="multiple" name="user_id[]">
              @foreach ($user as $l)
              @foreach($l->users as $a)
              <option value="{{$a->id}}">{{$a->name}}</option>
              @endforeach
              @endforeach
            </select>
            @error('user_id')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>
        <!-- <br>
        <div class="needsclick dropzone" id="document-dropzone">

        </div> -->
        <br>
        <a href="{{url ('index-list')}}" class="btn btn-danger" style="border-radius: 3em;">Back</a>
        <button type="submit" class="btn btn-primary" style="border-radius: 3em;">Save</button>

    </div>
    </form>
  </div>
  </div>
  <!-- Nama CLient -->
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
        url: "/work_order"
      }).done(function(res) {
        $("#nama_institusi").val(res.nama_institusi)
        $("#nama_project").val(res.nama_project)
        $("#nama_sales").val(res.nama_sales)
        $("#hps").val(res.hps)
        $("#kode_project").val(res.kode_project)
        $("#tgl_sales").val(res.tgl_sales)
        $("#no_sales").val(res.no_sales)
      })
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.select2').select2();
    });
  </script>

  @endsection