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
                <h2 class="text-capitalize text-center">List Create Principal</h2>
            </div>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <a href="{{route('/cpt')}}"><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Create</button></a>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>ID Project</th>
                        <th>Project Name</th>
                        <th>Principal Name</th>
                        <th>Client Name</th>
                        <th>File</th>
                        <th>Total BMT+Services - Final</th>
                        <th>Action</th>
                    </tr>
                </thead>
                @foreach ($cpt as $item)
                <tbody>
                    <tr style="font-size:13px">
                        <td>{{$item ->id_project}}</td>
                        <td>{{$item ->project_name}}</td>
                        <td>{{$item ->principal_name}}</td>
                        <td>{{$item ->client_name}}</td>
                        <td>{{$item ->file}}</td>
                        <td>Rp. {{number_format($item ->total_final)}}</td>
                        <td>
                            <div class="btn-group  mb-1" style="cursor: pointer;">
                                <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </div>
                                <div class="dropdown-menu text-center">
                                    <a class="btn btn-primary btn-sm" onclick="CreateTM({{$item->id}})">Transaction Maker</a>
                                    <a href="{{route('showcpt',$item->id)}}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{route('deletecpt',$item->id)}}" class="btn btn-danger btn-sm">Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="page" class="p-2">
    
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>
<script>
    function CreateTM(id){
        $.get("{{url('createTM')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit Product')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>
@endsection