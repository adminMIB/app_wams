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
                        <th>Total</th>
                        <th>Total Transfer</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($faktur as $item)
                    @php
                        $buattgl = date_create($item->created_at);
                        $sekarang = date_create();

                        $umur = date_diff($buattgl, $sekarang);
                    @endphp
                    @foreach ($item->faktur as $items)
                    <tr style="font-size: 12px">
                        <td><a href="{{ route('faktur', $items->id) }}">{{$items->no_faktur}}</a></td>
                        <td><a href="{{ route('faktur', $items->id) }}">{{date('d/m/Y', strtotime($items->tgl_pesanan))}}</a></td>
                        <td><a href="{{ route('faktur', $items->id) }}">{{$items->nama_client}}</a></td>
                        <td><a href="{{ route('faktur', $items->id) }}">{{$items->keterangan}}</a></td>
                        <td><a href="{{ route('faktur', $items->id) }}">{{$items->status}}</a></td>
                        <td><a href="{{ route('faktur', $items->id) }}">{{ $umur->days }}</a></td>
                        <td><a href="{{ route('faktur', $items->id) }}">{{$items->total}}</a></td>
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

</section>

@endsection
@section('js')
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>
@endsection