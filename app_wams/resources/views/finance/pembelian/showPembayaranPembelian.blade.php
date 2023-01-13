@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('newassets/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/datatables.css') }}">
<link rel="stylesheet" href="{{ asset('newassets/assets/extensions/choices.js/public/assets/styles/choices.css')}}">
@endsection
@section('content')
<!-- Basic Tables start -->
<section class="section">
    <div class="card">
        <div class="card-header">
            <a href="{{route('pembayaranPembeli', $shorder->pembelian->lto_id)}}" class="btn btn-secondary btn-sm">Back</a>
            <button type="submit" class="btn btn-primary btn-sm" style="float: right" data-bs-toggle="modal" data-bs-target="#addbrg{{$shorder->id}}">Buat Pembayaran</button>
        </div>
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>No Faktur</th>
                        <th>Faktur Date</th>
                        <th>Total Faktur</th>
                        <th>owed</th>
                        <th>Pay</th>
                        <th>Discount</th>
                        <th>Payment</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $lebih = $shorder->nilai_pembayaran - $shorder->total;
                            ?>
                        {{-- <a href="{{route('penawaran.edit',$i->id)}}">     --}}
                            <tr  style="font-size: 13px;">
                                <td>{{ $shorder->no_faktur }}</td>
                                <td>{{ $shorder->tanggal_faktur }}</td>
                                <td>{{ $shorder->total }}</td>
                                <td>{{ $lebih  }}</td>
                                <td>{{ $shorder->total }}</td>
                                <td>0</td>
                                <td>{{ $shorder->total }}</td>
                            </tr>
                </tbody>
                
            </table>
        </div>


        <div class="card-footer">
            <div class="row justify-content-end">
                <div class="col-md-3">
                    <div class="p-1 text-sm" style="border: 1px solid;border-top: 2px solid rgb(0, 166, 255);border-bottom: 2px solid rgb(0, 166, 255);">
                        <label for=""><b>Payment Value</b></label>
                        <h6 class="text-end">Rp. {{number_format($shorder->nilai_pembayaran)}}</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="p-1 text-sm" style="border: 1px solid;border-top: 2px solid rgb(255, 0, 0);border-bottom: 2px solid rgb(255, 0, 0);">
                        <label for=""><b>Invoice Paid</b></label>
                        <h6 class="text-end">Rp. {{number_format($shorder->total)}}</h6>
                    </div>
                </div>
                {{-- <div class="col-md-3">
                    <div class="p-1 text-sm" style="border: 1px solid;border-top: 2px solid rgb(255, 191, 0);border-bottom: 2px solid rgb(255, 191, 0);">
                        <label for=""><b>Lebih Bayar</b></label>
                        <h6 class="text-end">Rp. {{number_format($lebih)}}</h6>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>

    
    <div id="addbrg{{$shorder->id}}" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('pembayarranPembeli',$shorder->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-header">
                                <div class="mb-2 row">
                                    <label  class="col-sm-1 col-form-label" style="font-size: 12px">Payment To*</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control text-sm" name="nama_client" value="{{$shorder->nama_client}}" readonly >
                                    </div>
                                    <div class="col-sm-2">
                                        <select name="mata_uang" id="" class="form-control align-self-center">
                                            <option value="{{$shorder->mata_uang}}" hidden>{{$shorder->mata_uang}}</option>
                                            <option value="IDR">IDR</option>
                                            <option value="USD">USD</option>
                                        </select>
                                    </div>
                                    <label  class="col-sm-2 col-form-label" style="font-size: 10px">No Evidence :</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control text-sm" name="no_bukti">
                                    </div>
                                </div>
        
                                <div class="mb-2 row">
                                    <label  class="col-sm-1 col-form-label" style="font-size: 12px">Bank</label>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <select class="choices form-select" name="bank">
                                                @foreach ($bank as $item)
                                                    <option value="{{$item->NamaBank}}" hidden>{{$item->NamaBank}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 10px">Date</label>
                                    <div class="col-sm-3">
                                        <input type="date" class="form-control text-sm" value="{{ $shorder->tgl_pesanan }}" name="tgl_bayar">
                                    </div>
                                </div>

                                <div class="mb-2 row">
                                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Payment method</label>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="metode_pembayaran">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mb-2 row">
                                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Payment Value</label>
                                    <div class="col-sm-4">
                                        <input type="number" class="form-control text-sm" name="nilai_pembayaran">
                                    </div>
                                </div>
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

    
    
</section>
<!-- Basic Tables end -->
@endsection
@section('js')
<script src="http://code.jquery.com/jquery-2.1.4.js"></script>
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>
@endsection