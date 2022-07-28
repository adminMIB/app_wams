@extends('layouts.main')
@section('content')
<table class="table">
  <h1 style="color: black; margin-left: 10px; margin-top:10px">Task Progress Report</h1>
  <a href="{{route ('exporttask')}}" class="btn btn-primary"><i class="fas fa-file-excel"></i> Export Excel</a>
  <button type="button" class="btn btn-primary plus float-right" data-toggle="modal" data-target="#exampleModal">
    Filter Data
  </button>
  <thead>
    <tr>


      <!-- Button trigger modal -->

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Filter Data Tanggal</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="/task" method="GET">
                <label class="form-label" style="font-weight: bold; color:black">PILIH TANGGAL</label>
                <br /> <br />
                <input type="date" name="cari" class="form-control">
                <br /> <br />

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" value="Pilih">
            </div>
          </div>
        </div>
      </div>

      <br /> <br />
      <th>Id</th>
      <th>Nama</th>
      <th>Nama Project</th>
      <th>Nilai Project </th>
      <th>Nama Am</th>
      <th>Nama Pm</th>
      <th>Nama Tecnikal</th>
      <th>Status Pekerjaan</th>
      <!-- <th>Tanggal</th> -->
    </tr>
  </thead>


  <tbody>
  
    <tr>
     
    </tr>


  </tbody>

</table>

@endsection