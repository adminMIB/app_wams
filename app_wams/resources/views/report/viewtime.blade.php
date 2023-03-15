@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h2>List Project Timeline</h2>
    </div>
    <div class="card">
      <div class="card-body">
        <button type="button" class="btn btn-warning ml-2 mb-2" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Filter Data</button>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr align="center">
                    <th>No Sales</th>
                    <th>Tanggal Sales</th>
                    <th>Kode Project</th>
                    <th>Nama Sales</th>
                    <th>Nama Institusi</th>
                    <th>Nama Project</th>
                    <th>Nama PM</th>
                    <th>Jenis Pekerjaan</th>
    
                    <th>Estimated Amount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pt as $item)
                <tr align="center">
                  <td>{{$item->no_sales}}</td>
                    <td>{{$item->tgl_sales}}</td>
                    <td>{{$item->kode_project}}</td>
                    <td>{{$item->nama_sales}}</td>
                    <td>{{$item->nama_institusi}}</td>
                    <td>{{$item->nama_project}}</td>
                    <td>{{$item->nama_pm}}</td>
                    <td>
                      @foreach ($item->userpm as $it)
                      @if (Auth::user()->name == $it->nama_technical)
                      {{$it->jenis_pekerjaan}},
                      @endif
                      @endforeach
                    </td>
                    <td>{{$item->hps}}</td>
                    <td><a href="/detailtime/{{ $item->id }}" class="btn btn-primary">Detail</a></td>
                </tr>
                @endforeach
            </tbody>
          </table>  
        </div>
      </div>
    </div>
</section>
    

<div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Filter Data Table</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/viewtime" method="GET">
        <div class="modal-body">
            <label for="dari">Dari</label>
            <input type="date" class="form-control" id="dari" name="dari_tgl">
            <label for="sampai" class="mt-2">Sampai</label>
            <input type="date" class="form-control" id="sampai" name="sampai_tgl">
           
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