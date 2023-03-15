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
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>Invoice Number</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Information</th>
                        <th>Status</th>
                        <th>Age (day)</th>
                        {{-- <th>Total</th> --}}
                        <th>Total Transfer</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($shorder->pps as $item)
                    @php
                        $buattgl = date_create($item->created_at);
                        $sekarang = date_create();

                        $umur = date_diff($buattgl, $sekarang);
                    @endphp
                    @foreach ($item->faktur as $items)
                    <tr style="font-size: 13px">
                        <td><a href="{{ route('faktur', $items->id) }}">{{$items->no_faktur}}</a></td>
                        <td><a href="{{ route('faktur', $items->id) }}">{{date('d/m/Y', strtotime($items->tgl_pesanan))}}</a></td>
                        <td><a href="{{ route('faktur', $items->id) }}">{{$items->nama_client}}</a></td>
                        <td><a href="{{ route('faktur', $items->id) }}">{{$items->keterangan}}</a></td>
                        <td><a href="{{ route('faktur', $items->id) }}">{{$items->status}}</a></td>
                        <td><a href="{{ route('faktur', $items->id) }}">{{ $umur->days }}</a></td>
                        {{-- <td><a href="{{ route('faktur', $items->id) }}">{{$items->total}}</a></td> --}}
                        @if ($items->nilai_pembayaran)
                        <td><a href="{{ route('faktur', $items->id) }}">{{ $items->nilai_pembayaran }}</a></td>
                        @else
                        <td><a href="{{ route('faktur', $items->id) }}">0</a></td>
                        @endif
                    </tr>
                    @endforeach
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
    function show(id){
        $.get("{{url('edit-status')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit Product')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>
@endsection