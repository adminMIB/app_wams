@extends('layouts.main')

@section('title', 'All Projects')

@section('css')
<link rel="stylesheet" href="{{ asset('newassets/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/datatables.css') }}">
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <div class="card">
            <div class="alert">
                <h2 class="text-capitalize text-center">List Transaction Maker</h2>
            </div>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Create</button>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>Tanggal PO</th>
                        <th>Project Name</th>
                        <th>Klien Name</th>
                        <th>EU Name</th>
                        <th>Nominal PO</th>
                    </tr>
                </thead>
                @foreach ($tmcmm as $item)
                <tbody>
                    <tr style="font-size:13px">
                        <td>{{ date('d-m-Y', strtotime($item->tgl_po)) }}</td>
                        <td>{{$item->nama_project}}</td>
                        <td>{{$item->nama_klien}}</td>
                        <td>{{$item->nama_eu}}</td>
                        <td>Rp. {{number_format($item->nominal_po)}}</td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        </div>
    </div>
</section>
@endsection
<div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center" style="text-align: center" id="exampleModalLabel">Create Transaction Maker ACDC</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('saveTMCMM')}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="modal-body">

            <label for="dari">Tanggal PO</label>
            <input type="date" class="form-control" name="tgl_po">

            <label for="" class="mt-2">Project Name</label>
            <input type="text" class="form-control" name="nama_project">

            <label for="" class="mt-2">Client Name</label>
            <input type="text" class="form-control" name="nama_klien" id="">

            <label for="" class="mt-2">EU Name</label>
            <input type="text" class="form-control" name="nama_eu" id="">

            <label for="" class="mt-2">Nominal PO</label>
            <input type="number" class="form-control" name="nominal_po">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
              <button type="submit" class="btn text-white" style="background-color: #5252FF">Kirim</button>
            </button>
          </div>
        </form>
      </div>
    </div>
</div>
@section('js')
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>
@endsection