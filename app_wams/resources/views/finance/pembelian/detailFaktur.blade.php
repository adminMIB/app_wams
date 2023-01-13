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
                <a class="nav-link {{request()->is('pesananPembelian/*') || request()->is('pesananPembelian*') ? 'active' : ''}}" href="{{ route('pesananPembelian',$shorder->id) }}" aria-selected="true">Purchase order</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{request()->is('fakturPembelian*') ? 'active' : ''}}" href="{{ route('fakturPembelian',$shorder->id) }}" aria-selected="false">Purchase Invoice</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{request()->is('pembayaranPembeli*') ? 'active' : ''}}" href="{{ route('pembayaranPembeli',$shorder->id) }}" aria-selected="false">Purchase Payment</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link {{request()->is('detailFaktur*') ? 'active' : ''}}" href="{{ route('detailFaktur',$shorder->id) }}" aria-selected="false">Invoice Details</a>
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
                        <th>Supplier</th>
                        <th>Bank</th>
                        <th>Information</th>
                        <th>Status</th>
                        <th>Age (day)</th>
                        <th>Total</th>
                        {{-- <th>Total Transfer</th> --}}
                    </tr>
                </thead>

                <tbody>
                    @foreach ($shorder->pembelian as $item)
                    @foreach ($item->fakturPembelian as $items)
                    <tr style="font-size: 13px">
                        <td><a href="{{ route('fakturpembelian', $items->id) }}">{{$items->no_faktur}}</a></td>
                        <td><a href="{{ route('fakturpembelian', $items->id) }}">{{date('d/m/Y', strtotime($items->tgl_pesanan))}}</a></td>
                        <td><a href="{{ route('fakturpembelian', $items->id) }}">{{$items->nama_client}}</a></td>
                        <td><a href="{{ route('fakturpembelian', $items->id) }}">{{$items->bank ?? null}}</a></td>
                        <td><a href="{{ route('fakturpembelian', $items->id) }}">{{$items->keterangan}}</a></td>
                        <td><a href="{{ route('fakturpembelian', $items->id) }}">{{$items->status}}</a></td>
                        <td><a href="{{ route('fakturpembelian', $items->id) }}">-</a></td>
                        <td><a href="{{ route('fakturpembelian', $items->id) }}">{{$items->total}}</a></td>
                        {{-- <td><a href="{{ route('showPembelian', $item->id) }}">0</a></td> --}}
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