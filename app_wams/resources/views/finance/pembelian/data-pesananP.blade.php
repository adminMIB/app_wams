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
                    <a class="nav-link {{request()->is('data-pembelian') ? 'active' : ''}}" href="{{ route('data-pembelian') }}" aria-selected="true">Penawaran Penjualan</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{request()->is('data-pesanan-pembelian') ? 'active' : ''}}" href="{{ route('data-pesanan-pembelian') }}" aria-selected="false">Pesanan Penjualan</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link {{request()->is('data-faktur-pembelian') ? 'active' : ''}}" href="{{ route('data-faktur-pembelian') }}" aria-selected="false">Faktur Penjualan</a>
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
                        <th>Nama Client</th>
                        <th>Kode Project</th>
                        <th>Nomor Penjualan</th>
                        <th>Status</th>
                        <th>Tanggal Penjualan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($pembelian as $item)
                    <tr style="font-size:13px">
                        <td><a href="{{route('penawaranpesanan', $item->id)}}">{{$item->nama_client}}</a></td>
                        <td><a href="{{route('penawaranpesanan', $item->id)}}">{{$item->kode_project}}</a></td>
                        <td><a href="{{route('penawaranpesanan', $item->id)}}">{{$item->no_penjualan}}</a></td>
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
        <h5 class="modal-title" id="exampleModalLabel">Komentar</h5>
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