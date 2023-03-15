@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('newassets/assets/extensions/choices.js/public/assets/styles/choices.css')}}">
@endsection
@section('content')
@php
    $array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
    $bln = $array_bln[date('n')];
    $thn = date('Y');
@endphp
<!-- Basic Tables start -->
<section class="section">
<form action="{{route('detailSyaratFaktur/update',$shorder->id)}}" method="POST">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="mb-2 row">
                <label  class="col-sm-1 col-form-label" style="font-size: 12px">Supplier</label>
                <div class="col-sm-4">
                    <div class="form-group">
                        <select class="choices form-select" name="nama_client">
                            <option value="{{$shorder->nama_client}}">{{$shorder->nama_client}}</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <select name="mata_uang" id="" class="form-control align-self-center">
                        <option value="IDR">IDR</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
                <div class="col-sm-3">
                    {{-- <label  class=" col-form-label" style="font-size: 12px">No. Form # *</label>
                    <input type="text" class="form-control" name="no_form" value="Faktur Pembelian" > --}}
                    {{--  --}}
                    <label  class=" col-form-label" style="font-size: 12px">No. Faktur # *</label>
                    <input type="text" class="form-control" name="no_faktur" value="{{ $shorder->no_faktur }}" readonly>
                </div>
                
            </div>
            
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-1 col-form-label" style="font-size: 12px">Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" name="tanggal_faktur" value="{{ $shorder->tanggal_faktur }}">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <p style="font-size: 15px"><i class="bi bi-exclamation "></i><i>TERMS</i></p>
        </div>
        <div class="card-body">
            <div class="row">

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">Shipping Address</label>
                    <div class="col-md-9">
                        <textarea name="alamat" id="" cols="30" class="form-control" >{{ $shorder->alamat }}</textarea>
                    </div>
                </div>

                <div class="mb-3 mt-4 row">
                    <label  class="col-md-3 col-form-label" style="font-size: 12px">Tax</label>
                    <div class="col">
                        <input class="form-check-input" name="pajak" type="radio" value="Kena Pajak" {{$shorder->pajak=="Kena Pajak"? 'checked':''}} id="flexCheckDefault1">
                        <label class="form-check-label" for="flexCheckDefault1" style="font-size: 14px">
                            {{-- {{ $shorder->pajak }} --}} Taxable
                        </label>
                    </div>
                    <div class="col">
                        <input class="form-check-input" name="pajak" type="radio" value="Total termasuk Pajak" {{$shorder->pajak=="Total termasuk Pajak"? 'checked':''}} id="flexCheckDefault">                        <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px">
                            {{-- {{ $shorder->pajak }} --}} Total Including Tax
                        </label>
                    </div>
                </div>

                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">Delivery Date</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" name="tgl_pengiriman" id="" value="{{ $shorder->tgl_pengiriman }}">
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-md-3 col-form-label" style="font-size: 12px">Delivery</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                {{-- <select class="choices form-select " name="pengiriman">
                                    <option value="{{ $shorder->pengiriman }}">{{ $shorder->pengiriman }}</option>
                                </select> --}}
                                <input type="text" class="form-control" name="pengiriman" id="" value="{{ $shorder->pengiriman }}">
                            </div>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-md-3 col-form-label" style="font-size: 12px">Term of Payment</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                {{-- <select class="choices form-select " name="syarat_pembayaran">
                                    <option value="{{ $shorder->syarat_pembayaran }}">{{ $shorder->syarat_pembayaran }}</option>
                                </select> --}}
                                <input type="text" class="form-control" name="syarat_pembayaran" id="" value="{{ $shorder->syarat_pembayaran }}">
                            </div>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-md-3 col-form-label" style="font-size: 12px">FOB</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                {{-- <select class="choices form-select" name="FOB" >
                                    <option value="{{ $shorder->FOB }}">{{ $shorder->FOB }}</option>
                                </select> --}}
                                <input type="text" class="form-control" name="FOB" id="" value="{{ $shorder->FOB }}">
                            </div>
                        </div>
                    </div>
        
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">Information</label>
                        <div class="col-md-9">
                            <textarea name="keterangan" id="" cols="30" class="form-control" >{{ $shorder->keterangan }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-5">
                    <a href="{{route('showPembelian',$shorder->pembelian->id)}}" class="btn btn-secondary ">Back</a>
                    <button class="btn btn-primary d-flex">Save</button>
                </div>

            </div>
        </div>
      
    </div>
    
    
</form>
</section>
<!-- Basic Tables end -->
@endsection
@section('js')
<script src="http://code.jquery.com/jquery-2.1.4.js"></script>
<script src="{{asset('newassets/assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{asset ('newassets/assets/js/pages/form-element-select.js')}}"></script>
@endsection