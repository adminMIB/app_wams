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
                <h2 class="text-capitalize text-center">List Create Bank</h2>
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
                        <th>Nama Bank</th>
                        <th>Alamat</th>
                        <th>PIC Bank</th>
                        <th>Email PIC Bank</th>
                        <th>HP PIC Bank</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($cb as $item)
                <tbody>
                    <tr style="font-size:13px">
                        <td>{{$item->nama_bank}}</td>
                        <td>{{$item->alamat}}</td>
                        <td>{{$item->pic_bank}}</td>
                        <td>{{$item->email_pic_bank}}</td>
                        <td>{{$item->hp_pic_bank}}</td>
                        <td></td>
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
          <h5 class="modal-title text-center" style="text-align: center" id="exampleModalLabel">Create Bank</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('saveCB')}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          <div class="modal-body">

            <label for="dari">Bank Name</label>
            <input type="text" class="form-control" name="nama_bank">

            <label for="sampai" class="mt-2">Address</label>
            <input type="text" name="alamat" class="form-control" id="">

            <label for="" class="mt-2">PIC Bank</label>
            <input type="text" class="form-control" name="pic_bank">

            <label for="" class="mt-2">Email PIC Bank</label>
            <input type="text" class="form-control" name="email_pic_bank" id="">

            <label for="" class="mt-2">HP PIC Bank</label>
            <input type="text" class="form-control" name="hp_pic_bank" id="">
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