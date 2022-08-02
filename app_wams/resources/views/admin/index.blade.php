@extends('layouts.main')
@section('content')
    <div class="title">
        <h1 style="color: black; margin-left: 9px; margin-top:20px">List Sales Opty</h1>
     </div> 
       <div class="card">
        <div class="card-body ">
         
          <a href="{{route('/adminproject/create')}}"><button type="submit" class="btn btn-primary btn-sm" style="margin-bottom:1%;">Create</button></a>
          <div class="text-right">
          <button type="button" class="btn btn-primary" style="margin-right: 810px;" data-toggle="modal" data-target="#exampleModal">
            Filter Data
          </button>        
            <a href="#" class="btn btn-warning" target="_blank" rel="noopener noreferrer">Cetak</a>
            <a href="#" class="btn btn-success"target="_blank" rel="noopener noreferrer">Export</a>
          </div>
          <table class="table table-striped table-hover">
            <div class="card-header-action">
          </div>
        </div>
         <hr>
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Client</th>
                <th>Nama Project</th>
                <th>Produk / Solusi</th>
                <th>Pm_Lead</th>
                <th>Technikal_Lead</th>
                <th>Action</th>
            </tr>
            <tr>
              
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
               
            </tr>
         </thead>
         
         <tbody>
     
         </tbody>
        </table>
        </div> 
       </div>
      <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/index-sales" method="GET">
			<label>PILIH TANGGAL</label>
			<input type="date" name="cari">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Pilih">
      </div>
    </div>
  </div>
</div>
@endsection
