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
                        <th>Action</th>
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
                    <tr style="font-size: 12px">
                        <td>{{$items->no_faktur}}</td>
                        <td>{{date('d/m/Y', strtotime($items->tgl_pesanan))}}</td>
                        <td>{{$items->nama_client}}</td>
                        <td>{{$items->keterangan}}</td>
                        <td>{{$items->status}}</td>
                        <td>{{ $umur->days }}</td>
                        {{-- <td>{{$items->total}}</td> --}}
                        @if ($items->nilai_pembayaran)
                        <td><a href="{{ route('pembayaran', $items->id) }}">{{ $items->nilai_pembayaran }}</a></td>
                        @else
                        <td><a href="{{ route('pembayaran', $items->id) }}">0</a></td>
                        @endif
                        <td class="text-center">
                            <div class="btn-group dropstart mb-1" style="cursor: pointer;">
                                <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </div>
                                <div class="dropdown-menu text-center">
                                    <a href="{{ route('pembayaran',$items->id) }}" class="btn btn-sm btn-info">View Stuff</a>
                                    {{-- <form class="d-inline mx-1" action="{{ route('del-p', ['id' => $item->id]) }}"
                                        method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" class="btn btn-danger btn-sm">Delete</button>
                                    </form> --}}
                                </div>
                            </div>
                        </td>
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