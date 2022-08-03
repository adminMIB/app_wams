@extends('layouts.main')
@section('content')
<section></section>
    <div class="title">
        <h1 style="color: black; margin-left: 9px; margin-top:20px">List Sales Opty</h1>
     </div> 
       <div class="card">
        <div class="card-body ">
          <a href="{{route('inputsales')}}"><button type="submit" class="btn btn-primary btn-sm" style="margin-bottom:1%;">Create</button></a>
          <div class="text-right">
          <button type="button" class="btn btn-primary" style="margin-right: 810px;" data-toggle="modal" data-target="#exampleModal">
            Filter Data
          </button>        
            <a href="{{ route('Ycetak') }}" class="btn btn-warning" target="_blank" rel="noopener noreferrer">Cetak</a>
            <a href="{{ route('exportsalesopty') }}" class="btn btn-success"target="_blank" rel="noopener noreferrer">Export</a>
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
                <th colspan="4" style="text-align:center">Timeline</th>
                <th></th>
                <th>Action</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th>Q1</th>
                <th>Q2</th>
                <th>Q3</th>
                <th>Q4</th>
                <th></th>
                <th></th>
               
            </tr>
         </thead>
         
         <tbody>
            @foreach ($sales as $opty)
                <tr> 
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $opty->NamaClient }}</td>
                    <td>{{ $opty->NamaProject }}</td>
                    <td>{{ $opty->elearning_id}}</td>
                    <td>
                        @if ($opty->Timeline == 'Q1')
                            {{ number_format($opty->Angka,0,',','.') }}
                        @endif
                    </td>
                    <td>
                        @if ($opty->Timeline == 'Q2')
                            {{ number_format($opty->Angka,0,',','.') }}
                        @endif
                    </td>
                    <td>
                        @if ($opty->Timeline == 'Q3')
                            {{ number_format($opty->Angka,0,',','.') }}
                        @endif
                    </td>
                    <td>
                        @if ($opty->Timeline == 'Q4')
                            {{ number_format($opty->Angka,0,',','.') }}
                        @endif
                    </td>
                    <td></td>
                    <td>
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" role="button" data-toggle="dropdown"  href="">
                            ...
                        </a>
                        <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
                        <a href="{{url ('Ydetail', $opty->id)}}">  <button type="submit" class="btn btn-warning btn-sm mb-1">Detail</button></a>
                        <a href="{{url ('Yedit', $opty->id)}}">  <button type="submit" class="btn btn-success btn-sm mb-1">Edit</button></a>
                         <a href="{{url ('Ydelete', $opty->id)}}">  <button type="submit" class="btn btn-danger btn-sm mb-1">Delete</button></a>
                        </div>
                    </td>
                    </div>
                </tr>
            @endforeach
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
