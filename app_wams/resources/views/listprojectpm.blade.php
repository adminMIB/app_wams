@extends('layouts.main')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')

<section class="section">
  <div class="title">
    <h1 style="color: black; margin-left: 10px; margin-top:10px">List Project</h1>
  </div>

  <!-- Nama CLient -->
  <form action="{{route ('simpan-dok')}}" method="POST" enctype="multipart/form-data">
    {{csrf_field()}}

    <div class="row">
      <div class="col">
        <label for="id" class="form-label" style="font-weight: bold; color:black">ID Project</label>
        <select name="" id="id" class="form-control">
          <option value=""></option>
          @foreach($cb as $t)
          <option value="{{$t->id}}">{{$t->id}}</option>
          @endforeach
        </select>
      </div>

      <div class="col">
        <label for="no_sales" class="form-label" style="font-weight: bold; color:black">No Sales Order</label>
        <input type="text" name="no_sales" id="no_sales" class="form-control" readonly>
        @error('no_sales')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>


      <div class="col-sm-6">
        <label for="tgl_sales" class="form-label" style="font-weight: bold; color:black">Tanggal Sales Order</label>
        <input type="text" name="tgl_sales" id="tgl_sales" class="form-control" readonly>
        @error('tgl_sales')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
    </div>
    <br>

    <div class="row g-3">
      <div class="col-sm-6">
        <label for="nama_sales" class="form-label" style="font-weight: bold; color:black">Nama Sales</label>
        <input type="text" name="nama_sales" id="nama_sales" class="form-control" readonly>
        @error('nama_sales')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="col-sm-6">
        <label for="nama_institusi" class="form-label" style="font-weight: bold; color:black">Nama Institusi</label>
        <input type="text" name="nama_institusi" id="nama_institusi" class="form-control" readonly>
        @error('nama_institusi')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="col-sm-6">
        <label for="nama_project" class="form-label" style="font-weight: bold; color:black">Nama project</label>
        <input type="text" name="nama_project" id="nama_project" class="form-control" readonly>
        @error('nama_project')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>

      <div class="col-sm-6">
        <label for="sign_pm" class="form-label" style="font-weight: bold; color:black">Sign To Pm</label>
        <select name="sign_pm" id="sign_pm" class="form-control">
          <option selected>Pilih Pm</option>
          @foreach ($user as $item)
            @foreach ($item->users as $user)
            <option class="" value="{{$user->id}}">{{$user->name }}</option>
            @endforeach
          @endforeach
        </select>
        @error('sign_pm_lead')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
    </div>

    <br>
    <div class="row">
      <div class="col-sm-6">
        <label for="hps" class="form-label" style="font-weight: bold; color:black">Hps</label>
        <input type="text" name="hps" id="hps" class="form-control" readonly>
        @error('hps')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
      </div>
    </div>
    <br /> <br />
    <button type="submit" class="btn btn-primary btn-sm">Save</button>
  </form>

  @endsection

  @section('js')
  <script>
    //change to two ? how?

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
        url: "/listprojectpm"
      }).done(function(res) {
        $("#no_sales").val(res.no_sales)
        $("#nama_sales").val(res.nama_sales)
        $("#tgl_sales").val(res.tgl_sales)
        $("#nama_institusi").val(res.nama_institusi)
        $("#nama_project").val(res.nama_project)
        $("#hps").val(res.hps)
      })
    });
  </script>
  @endsection