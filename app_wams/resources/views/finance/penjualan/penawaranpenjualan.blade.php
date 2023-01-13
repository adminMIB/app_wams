@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('newassets/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/datatables.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{request()->is('Penawaran*') || request()->is('penawaran-Penjualan*') ? 'active' : ''}}" href="{{ route('penawaran-Penjualan',$shorder->id) }}" aria-selected="true">Sales Offer</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{request()->is('Pesanan-Penjualan*') ? 'active' : ''}}" href="{{ route('pesananpenjualan',$shorder->id) }}" aria-selected="false">Sales Order</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{request()->is('Faktur-Penjualan*') ? 'active' : ''}}" href="{{ route('fakturpenjualan',$shorder->id) }}" aria-selected="false">Sales invoice</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{request()->is('Penerimaan-Penjualan*') ? 'active' : ''}}" href="{{ route('penerimaanpenjualan',$shorder->id) }}" aria-selected="false">Receipt of payment</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{request()->is('detailFaktur-Penjualan*') ? 'active' : ''}}" href="{{ route('detailfakturpenjualan',$shorder->id) }}" aria-selected="false">Invoice Details</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <a href="{{route('penawaran.create',$shorder->id)}}"><button type="submit" class="btn btn-primary btn-sm" style="float: right">Create</button></a>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>Client Name</th>
                        <th>Project Code</th>
                        <th>Offer Number</th>
                        <th>Status</th>
                        <th>Sales Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($shorder->pps as $item)
                    <tr style="font-size:13px">
                        <td>{{$item->nama_client}}</td>
                        <td>{{$item->kode_project}}</td>
                        <td>{{$item->no_penjualan}}</td>
                        <td>{{$item->status}}</td>
                        @if ($item->tgl_penjualan)
                        <td>{{ date('d-m-Y', strtotime($item->tgl_penjualan)) }}</td>
                        @else
                        <td></td>
                        @endif
                        <td class="text-center">
                            <div class="btn-group dropstart mb-1" style="cursor: pointer;">
                                <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </div>
                                <div class="dropdown-menu text-center">
                                    <a href="{{ route('penawaran',$item->id) }}" class="btn btn-sm btn-primary">View Stuff</a>
                                    @if ($item->status == 'Terproses')
                                    <button type="button" class="btn btn-warning btn-sm"  >{{$item->status}}</button>
                                    @elseif($item->status == 'Faktur')
                                    <button type="button" class="btn btn-warning btn-sm"  >{{$item->status}}</button>
                                    @else
                                    <button type="button" class="btn btn-primary btn-sm" style="float: left" onclick="show({{$item->id}})">Update Status</button>
                                    @endif
                                    <form class="d-inline mx-1" action="{{ route('del-p', ['id' => $item->id]) }}"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" class="btn btn-danger btn-sm mt-1">Delete</button>
                                    </form>
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

{{-- @foreach ($shorder->pps->where('status', 'menunggu proses') as $item)
<div id="upst{{$item->id}}" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <div class="mb-2 row">
                        <label  class="col-sm-1 col-form-label" style="font-size: 10px">Dipesan Oleh</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control text-sm" value="{{$item->nama_client}}" readonly >
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control text-sm" name="" id="" value="{{$item->mata_uang}}" readonly>
                        </div>
                        <label  class="col-sm-1 col-form-label" style="font-size: 10px">Nomor :</label>
                        <div class="col-sm-3">
                            <input type="text" class="form-control text-sm" name="no_penjualan" value="{{$item->no_penjualan}}">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-1 col-form-label" style="font-size: 10px">Tanggal</label>
                        <div class="col-sm-3">
                            <input type="text" value="{{$item->tgl_penjualan}}" class="form-control text-sm" name="tgl_penjualan">
                        </div>
                    </div>
                </div>
            </div> 
            <form action="{{route('penawaran.status',$item->id)}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="mb-2 row">
                        <label  class="col-sm-1 col-form-label" style="font-size: 12px">Status</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select class="form-select" name="status">
                                    <option value="" ></option>
                                    <option value="Terproses">Pesanan</option>
                                    <option value="Faktur">Faktur</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-info" >Submit</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach --}}

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
    function show(id){
        $.get("{{url('edit-status')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit Product')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>
@endsection