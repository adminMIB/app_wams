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
                <h2 class="text-capitalize">PIC Distributor</h2>
            </div>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <a href="{{ route('picdisticreate') }}" class="btn btn-primary">Create</a>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>No</th>
                        <th>Nama Distributor</th>
                        <th>PIC Distributor</th>
                        <th>Jabatan PIC</th>
                        <th>Email PIC</th>
                        <th>Nomor HP</th>
                        <th>Pengjuan CL</th>
                        <th>Jumlah CL</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pic as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama_disti }}</td>
                        <td>{{ $item->pic_disti }}</td>
                        <td>{{ $item->jabatan_pic }}</td>
                        <td>{{ $item->email_pic }}</td>
                        <td>{{ $item->nomor_hp }}</td>
                        <td>{{ $item->pengajuan_cl }}</td>
                        <td>{{ $item->jumlah_cl }}</td>
                        <td>
                            <div class="btn-group  mb-1" style="cursor: pointer;">
                                <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </div>
                                <div class="dropdown-menu text-center">
                                    <a class="btn btn-primary btn-sm" onclick="CreateTM({{$item->id}})">Transaction Maker</a>
                                    <a href="{{route('TMDLshow',$item->id)}}" class="btn btn-info btn-sm">Detail</a>
                                    <a href="{{ route('picdistidelete', $item->id) }}" onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" class="btn btn-danger btn-sm">Delete</a>
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
        $.get("{{url('Transaction-Maker/DCL')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit Product')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>
@endsection