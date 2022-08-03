@extends('layouts.main')
@section('content')
      <div class="title">
        <h1 style="color: black; margin-left: 9px; margin-top:20px">List Project Admin</h1>
      </div> 
        <div class="card">
        <div class="card-body ">
         
          
          
          <table class="table table-striped table-hover">
            <div class="card-header-action">
          </div>
        </div>
         <hr>
            <thead>
            <tr>
                <th>ID</th>
                <th>Nama Client</th>
                <th>Nama Project</th>
                <th>TGL Opty</th>
                <th>Document</th>
                <th>Status</th>
            </tr>
         </thead>
         
         <tbody>
            @foreach ($ds as $it)
            <tr>
                <td>{{$it->id}}</td>
                <td>{{$it->NamaClient}}</td>
                <td>{{$it->NamaProject}}</td>
                <td>{{$it->Date}}</td>
                <td><a href="/admins/{{$it->UploadDocument}}">{{$it->UploadDocument}}</a></td>
                <td>{{$it->Status}}</td>
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
