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
                <a class="nav-link {{request()->is('Faktur-Penjualan*') ? 'active' : ''}}" href="{{ route('pembayaranPembeli',$shorder->id) }}" aria-selected="false">Purchase Payment</a>
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
                        <th>Client Name</th>
                        <th>Project Code</th>
                        <th>Purchase Number</th>
                        <th>Status</th>
                        <th>Purchase Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($shorder->pembelian as $item)
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
                                    <a href="{{ route('showfakturpembelians',$item->id) }}" class="btn btn-sm btn-info">View Stuff</a>
                                    <button type="button" class="btn btn-primary btn-sm" style="float: left" onclick="show({{$item->id}})">Update Status</button>
                                    <form class="d-inline mx-1" action="{{ route('delete/pembelian', $item->id) }}"
                                      method="POST">
                                      @method('DELETE')
                                      @csrf
                                      <button type="submit" onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" class="btn btn-danger btn-sm mb-1">Delete</button>
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

    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Information</h5>
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
        $.get("{{url('editStatus')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit Status')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>
@endsection