@extends('layouts.main')
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
                <h2 class="text-capitalize">All Barang</h2>
            </div>
        </div>
    </div>
    
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <a href="" data-bs-toggle="modal" data-bs-target="#barang" class="btn btn-success btn-sm">Add Stuff</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered " id="table1">
                    <thead>
                        <tr align="center" style="font-size: 13px">
                            <th>Stuff Code</th>
                            <th>Stuff Name</th>
                            <th>Type of Stuff</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    @foreach($brg as $item)
                    <tbody>
                        <tr style="font-size:13px">
                            <td>{{$item->kode_barang}}</td>
                            <td>{{$item->nama_barang}}</td>
                            <td>{{$item->jenis_barang}}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" onclick="show({{$item->id}})">Edit</a>
                                <a href="{{route('delete.barang',$item->id)}}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</section>

<div id="barang" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" >Add Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('barang.simpan')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-sm text-black">Stuff Code</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control text-sm " name="kode_barang" id="inputEmail3" value="KB{{$dd}}" readonly >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-sm text-black">Stuff Name</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control text-sm " name="nama_barang" id="inputEmail3"  >
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label text-sm text-black">Type of Stuff</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control text-sm " name="jenis_barang" id="inputEmail3"  >
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-info" >Submit</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Stuff</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="page" class="p-2">

            </div>
        </div>
    </div>
    </div>
</div>



@endsection
@section('js')
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>

<script>
    function show(id){
        $.get("{{url('Barang/edit')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit Barang')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>
@endsection