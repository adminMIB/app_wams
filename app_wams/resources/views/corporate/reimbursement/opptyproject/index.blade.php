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
            <div class="text-center mt-2">
                <h2 class="text-capitalize">Project / Oppty</h2>
            </div>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <a href="{{ route('opptyprojectcreate') }}" class="btn btn-primary">Create</a>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>No</th>
                        <th>Jenis</th>
                        <th>ID</th>
                        <th>Nama Project</th>
                        <th>PIC Business Channel</th>
                        <th>Client</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($op as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->jenis }}</td>
                        <td>{{ $item->ID_opptyproject }}</td>
                        <td>{{ $item->nama_project }}</td>
                        <td>{{ $item->pic_bussiness_channel }}</td>
                        <td>{{ $item->client }}</td>
                        <td>
                            <div class="btn-group  mb-1" style="cursor: pointer;">
                                <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </div>
                                <div class="dropdown-menu text-center">
                                    <a style="float: left;" onclick="CreateTMReim({{$item->id}})">Transaction Maker</a>
                                    <br>
                                    <a href="{{route('showcpt',$item->id)}}" style="color: gray;float:left;margin-top:6%">Detail</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</section>
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
@endsection
@section('js')
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>
<script>
    function CreateTMReim(id){
        $.get("{{url('createTMReim')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit Oppty/Project')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>
@endsection