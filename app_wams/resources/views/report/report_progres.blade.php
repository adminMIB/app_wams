@extends('layouts.main')
@section('content')  
@include('sweetalert::alert')
<section class="section">
  <div class="section-header">
    <h1>Report Progress Technical</h1>
  </div>
  <div class="card" style="border-radius: 2em">
    <div class="card-header">
      <div class="card-header-form">
        <form action="/report" method="GET">
          {{-- <a class="btn btn-primary" href="/create" type="submit">Create Weekly Report</a> --}}
          <label style="margin-left: 14px">Start Date</label>
          <label style="margin-left: 106px">End Date</label>
          <div class="input-group">
            <input type="date" class="form-control" style="margin-left: 10px" name="start" id="start">
            <input type="date" class="form-control" style="margin-left: 30px; margin-right: 20px"  name="end" id="end">
            <div class="input-group-btn">
              <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
            </div> 
            <button type="button" class="btn btn-success" onclick="tableToExcel('reports')" style="margin-left: 450px">
              Export
            </button>   
            {{-- <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-primary" href="/create" style="margin-left: 20px">Create</a> --}}
          </div>
        </form><hr>
      </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr align="center">
                    <th>Kode Project</th>
                    <th>Nama Client</th>
                    <th>Nama Project</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
              @foreach ($data as $id)
              {{-- @foreach ($id->detail as $it) --}}
              {{-- @if (Auth::user()->name == $it->nama_technical) --}}
              <tr align="center">
                <td>{{ $id->kode_project }}</td>
                <td>{{ $id->nama_institusi }}</td>
                <td>{{ $id->nama_project }}</td>
                <td>
                  <a href="{{route('detailT',$id->id)}}"><button type="submit" class="btn btn-info" style="border-radius:3em ;">Detail</button></a>
                  <a href="{{route('editT',$id->id)}}"><button type="submit" class="btn btn-primary" style="border-radius:3em ;">Weekly Report</button></a>
                </td>
              </tr>
              {{-- @endif --}}
              {{-- @endforeach --}}
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
    
  <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/index-sales" method="GET">
			<label>Start Date</label>
			<input type="date" class="form-control"    name="start" id="start" style="margin-bottom: 10px">
			<label>Finish Date</label>
			<input type="date" class="form-control"    name="end" id="end">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Pilih">
      </div>
    </div>
  </div>
</div>

<table class="table table-striped d-none" id="reports">
  <thead>
      <tr align="center">
          <th>Kode Project</th>
          <th>Nama Client</th>
          <th>Nama Project</th>
          <th>Nama Sales</th>
          <th>Nama PM</th>
          <th>Nama Technical</th>
          <th>Estimated Amount</th>
          <th>Jenis Pekerjaan</th>
      </tr>
  </thead>

  <tbody>
    @foreach ($data as $id)
    {{-- @foreach ($id->detail as $it) --}}
    {{-- @if (Auth::user()->name == $id->nama_technical) --}}
    <tr align="center">
      <td>{{ $id->kode_project }}</td>
      <td>{{ $id->nama_institusi }}</td>
      <td>{{ $id->nama_project }}</td>
      <td>{{ $id->nama_sales }}</td>
      <td>{{ $id->nama_pm }}</td>
      <td>
        @foreach ($id->detail as $it)
        @if (Auth::user()->name == $it->nama_technical)
        {{ $it->nama_technical }}
        @endif
        @endforeach
      </td>
      <td>{{ $id->hps }}</td>
      <td>
        @foreach ($id->detail as $it)
        @if (Auth::user()->name == $it->nama_technical)
        {{ $it->jenis_pekerjaan }}
        @endif
        @endforeach
      </td>
    </tr>
    {{-- @endif --}}
    {{-- @endforeach --}}
    @endforeach
  </tbody>
</table>

<script src="../assets/js/export_exel.js"></script>
    @endsection


    @section('js')
    <script type="text/javascript">
      $(document).ready(function(){
               
      });

      function filter(){
        $("#exampleModal").modal('show');
      }
    </script>
    @endsection
