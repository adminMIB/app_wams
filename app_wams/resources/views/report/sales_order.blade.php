@extends('layouts.main')
@section('content')
@include('sweetalert::alert')
<section class="section">
    <div class="section-header">
      <h4>LTO</h4>
    </div>
    <!-- Table Report -->
    <div class="card" style="border-radius: 2em">
      <div class="card-header">
          <div class="card-header-form">
              <button type="button" class="btn btn-warning ml-2" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Filter Data</button>
          </div>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover">
                  <thead>
                      <tr>
                          <th>No Sales Order</th>
                          <th>Tanggal Project</th>
                          <th>Nama Client</th>       
                          <th>Status</th>
                          <th>Editor</th>
                          <th>Action</th>
                      </tr>
                  </thead>
                  <tbody>
                      @foreach ($so as $item)
                      <tr>
                          <td>{{$item->no_so}}</td>
                          <td>{{$item->tgl_so}}</td>
                          <td>{{$item->institusi}}</td>
                          <td>{{$item->status}}</td>
                          <td>{{$item->name_user}}</td>
                          <td>
                    
                              <a href="/detailso/{{ $item->id }}" class="btn btn-info">Detail</a>
                      
                          </td>
                      </tr>
                      
                      @endforeach
                  </tbody>
              </table>
          </div>
      </div>
    </div>
</section>
<!-- Akhir Table Report -->
 <!-- Modal -->
 <div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Filter Data Table</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/sales_order" method="GET">
        <div class="modal-body">
            <label for="dari">Dari</label>
            <input type="date" class="form-control" id="dari" name="dari_tgl">
            <label for="sampai" class="mt-2">Sampai</label>
            <input type="date" class="form-control" id="sampai" name="sampai_tgl">
            {{-- <label for="sampai" class="mt-2">Nama Sales</label> --}}
            {{-- <select class="form-control" name="name_user">
              <option value="">Nama sales</option>
              @foreach ($user as $l)
                @foreach($l->users as $a)
                <option value="{{$a->name}}">{{$a->name}}</option>
                @endforeach
              @endforeach
            </select> --}}
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Pilih</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  
@endsection