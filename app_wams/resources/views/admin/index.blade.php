@extends('layouts.main')
@section('content')
    <div class="title">
        <h1 style="color: black; margin-left: 9px; margin-top:20px">List Project Admin</h1>
     </div> 
       <div class="card">
        <div class="card-body ">
         
          <a href="{{route('/adminproject/create')}}"><button type="submit" class="btn btn-primary btn-sm" style="margin-bottom:1%;">Create</button></a>
          <div class="text-right">
          {{-- <button type="button" class="btn btn-primary" style="margin-right: 810px;" data-toggle="modal" data-target="#exampleModal">
            Filter Data
          </button>  --}}
            <div class="mb-3">
              <a href="#" class="btn btn-warning" target="_blank" rel="noopener noreferrer">Cetak</a>
              <a href="#" class="btn btn-success"target="_blank" rel="noopener noreferrer">Export</a>
            </div>
          </div>
          <table class="table table-bordered table-md">
            <tbody>
            <tr class="text-center">
              <th>Nama Client</th>
              <th>Nama Project</th>
              <th>Date</th>
              <th>Angka</th>
              <th>Status</th>
              <th>Pm Lead ID</th>
              <th>Technikal Lead ID</th>
              <th>Sales ID</th>
              <th>Action</th>
            </tr>
            @foreach ($admin as $item)
            <tr class="text-center">
              <td>{{$item->NamaClient }}</td>
              <td>{{$item->NamaProject }}</td>
              <td>{{$item->Date}}</td>
              <td>{{$item->Angka}}</td>
              {{-- <td><a href="/files/dokumen/{{$item->Status}}">{{$item->Status}}</a></td> --}}
              <td>{{$item->Status}}</td>
              <td>{{$item->signPm_lead}}</td>
              <td>{{$item->signTechnikel_lead}}</td>
              <td>{{$item->signAmSales_id}}</td>
              <td class="d-flex">
                <div class="mr-2">
                  {{-- detail --}}
                  <a href="{{url('/adminprojectShow', $item->id)}}" class="btn btn-info">
                    <i class="far fa-edit"></i>
                  </a>
                </div>
                {{-- delete --}}
                <a href="{{url('/adminprojecDelete', $item->id)}}" class="btn btn-secondary">
                  <i class="fas fa-times"></i>
                </a>
              </td>
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
