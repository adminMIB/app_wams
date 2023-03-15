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
                    <a class="nav-link {{request()->is('data-penawaran') ? 'active' : ''}}" href="{{ route('data-penjualan') }}" aria-selected="true">Sales Offer</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{request()->is('data-pesanan') ? 'active' : ''}}" href="{{ route('data-pesanan') }}" aria-selected="false">Sales Order</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{request()->is('data-faktur') ? 'active' : ''}}" href="{{ route('data-faktur') }}" aria-selected="false">Sales Invoice</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        {{-- <div class="card-header">
            <a href=""><button type="submit" class="btn btn-primary btn-sm" style="float: right">Create</button></a>
        </div> --}}
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>Client Name</th>
                        <th>Project Code</th>
                        <th>Order Number</th>
                        <th>Status</th>
                        <th>Sales Date</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($penawaran as $item)
                    <tr style="font-size:13px">
                        <td><a href="{{route('penawaranpesanan', $item->id)}}">{{$item->nama_client}}</a></td>
                        <td><a href="{{route('penawaranpesanan', $item->id)}}">{{$item->kode_project}}</a></td>
                        <td><a href="{{route('penawaranpesanan', $item->id)}}">{{$item->no_pesanan}}</a></td>
                        <td><a href="{{route('penawaranpesanan', $item->id)}}">{{$item->status}}</a></td>
                        @if ($item->tgl_penjualan)
                        <td><a href="{{route('penawaranpesanan', $item->id)}}">{{ date('d-m-Y', strtotime($item->tgl_penjualan)) }}</a></td>
                        @else
                        <td></td>
                        @endif
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
    function show(id){
        $.get("{{url('edit-status')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit Product')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>
@endsection