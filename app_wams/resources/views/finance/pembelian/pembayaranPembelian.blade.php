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
                <a class="nav-link {{request()->is('pesananPembelian/*') || request()->is('penawaran-Penjualan*') ? 'active' : ''}}" href="{{ route('pesananPembelian',$shorder->id) }}" aria-selected="true">Purchase Order</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{request()->is('fakturPembelian/*') ? 'active' : ''}}" href="{{ route('fakturPembelian',$shorder->id) }}" aria-selected="false">Purchase Invoice</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{request()->is('pembayaranPembeli*') ? 'active' : ''}}" href="{{ route('pembayaranPembeli',$shorder->id) }}" aria-selected="false">Purchase Payment</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{request()->is('detailFaktur*') ? 'active' : ''}}" href="{{ route('detailFaktur',$shorder->id) }}" aria-selected="false">Invoice Detail</a>
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
                        <th>Number Faktur</th>
                        <th>Date</th>
                        <th>No. Cek</th>
                        <th>Supplier</th>
                        <th>Information</th>
                        <th>Status</th>
                        <th>Age (day)</th>
                        <th>Total</th>
                        <th>Total Transfer</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($shorder->pembelian as $item)
                    @foreach ($item->fakturPembelian->where('status', 'Belum Lunas') as $items)
                    <tr style="font-size: 12px">
                        <td>{{$items->no_faktur}}</td>
                        <td>{{date('d/m/Y', strtotime($items->tanggal_faktur))}}</td>
                        <th></th>
                        <td>{{$items->nama_client}}</td>
                        <td>{{$items->keterangan}}</td>
                        <td>{{$items->status}}</td>
                        <td>-</td>
                        <td>{{$items->total}}</td>
                        <td>{{$items->nialai_pembayaran  }}</td>
                        <td class="text-center">
                            <div class="btn-group dropstart mb-1" style="cursor: pointer;">
                                <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </div>
                                <div class="dropdown-menu text-center">
                                    <a href="{{ route('PembeliShow',$items->id) }}" class="btn btn-sm btn-info">View Stuff</a>
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