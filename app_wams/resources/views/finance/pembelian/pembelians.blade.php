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
            <a href="{{ route('pesananPembelian', $shorder->lto_id) }}" class="btn btn-secondary btn-sm">Back</a>
            <a href="{{route('pesanan-pembelian-pdf', $shorder->id) }}" class="btn btn-danger btn-sm">Print Pdf</a>
            <button type="submit" class="btn btn-primary btn-sm" style="float: right" data-bs-toggle="modal" data-bs-target="#addbrg{{$shorder->id}}">Add Stuff</button>
        </div>
        <div class="card-body">
            <table class="table" id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>Stuff Name</th>
                        <th>Project Code</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>@Price</th>
                        <th>@Discount</th>
                        <th>Total Price</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $total_harga2 = 0;
                    $total_ppn = 0;
                    $total = 0;
                        foreach ($shorder->barang as $i){
                            ?>
                        {{-- <a href="{{route('penawaran.edit',$i->id)}}">     --}}
                            <tr  style="font-size: 13px;">
                                @if ($shorder->status == "Faktur")
                                <td>{{$i->nama_barang}}</td>
                                <td>{{$shorder->kode_project}}</td>
                                @else
                                <td><a href="{{route('pembelian/edit',$i->id)}}">{{$i->nama_barang}}</a></td>
                                <td><a href="{{route('pembelian/edit',$i->id)}}">{{$shorder->kode_project}}</a></td>
                                @endif
                                <td>{{$i->kuantitas}}</td>
                                @if ($i->satuan)
                                <td>{{$i->satuan}}</td>
                                @else
                                <td> - </td>
                                @endif
                                <td> Rp. {{number_format($i->harga)}}</td>
                                <td>{{ $i->diskon }}%</td>
                                <td>Rp. {{number_format($i->total_harga)}} </td>
                            </tr>
                        {{-- </a>     --}}
                            <?php

                            $total_harga2 +=$i->total_harga;
                            $total_ppn += $i->total_diskon;
                            $total = $total_harga2 + $total_ppn;
                            // $diskon = $i->diskon;
                        }
                    ?>
                </tbody>
                
            </table>
        </div>


        <div class="card-footer">
            <div class="row justify-content-end">
                <div class="col-md-3">
                    <div class="p-1 text-sm" style="border: 1px solid;border-top: 2px solid rgb(0, 166, 255);border-bottom: 2px solid rgb(0, 166, 255);">
                        <label for=""><b>Sub Total</b></label>
                        <h6 class="text-end">Rp. {{number_format($total_harga2)}}</h6>
                    </div>
                </div>
                {{-- <div class="col-md-3">
                    <div class="p-1 text-sm" style="border: 1px solid;border-top: 2px solid rgb(255, 0, 0);border-bottom: 2px solid rgb(255, 0, 0);">
                        <label for=""><b>Diskon %</b></label>
                        <h6 class="text-end">Rp.{{ ($diskon) }} </h6>
                    </div>
                </div> --}}
                <div class="col-md-3">
                    <div class="p-1 text-sm" style="border: 1px solid;border-top: 2px solid rgb(255, 191, 0);border-bottom: 2px solid rgb(255, 191, 0);">
                        <label for=""><b>Total</b></label>
                        <h6 class="text-end">Rp. {{number_format($total)}}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="addbrg{{$shorder->id}}" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card">
                    <div class="card-header">
                        <div class="mb-2 row">
                            <label  class="col-sm-1 col-form-label" style="font-size: 10px">Ordered By</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control text-sm" value="{{$shorder->nama_client}}" readonly >
                            </div>
                            {{-- <div class="col-sm-2">
                                <input type="text" class="form-control text-sm" name="" id="" value="{{$shorder->mata_uang}}" readonly>
                            </div> --}}
                            <label  class="col-sm-1 col-form-label" style="font-size: 10px">Number :</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control text-sm" name="no_penjualan" value="{{$shorder->no_penjualan}}">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-1 col-form-label" style="font-size: 10px">Date</label>
                            <div class="col-sm-3">
                                <input type="text" value="{{$shorder->tgl_penjualan}}" class="form-control text-sm" name="tgl_penjualan">
                            </div>
                        </div>
                    </div>
                </div> 
                <form action="{{route('addBarangPembelian',$shorder->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <input type="hidden" name="so_id" value="{{$shorder->id}}">

                        <div class="mb-2 row">
                            <label  class="col-sm-2 col-form-label" style="font-size: 12px">Stuff Name</label>
                            <div class="col-sm-10">
                                <div class="form-group">
                                    <select class="choices form-select " name="nama_barang">
                                        @foreach ($barang as $item)
                                            <option value="{{$item->nama_barang}}">{{$item->nama_barang}}</option>
                                        @endforeach    
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-2 row">
                            <label  class="col-sm-2 col-form-label" style="font-size: 12px">Quantity</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control text-sm" name="kuantitas" id="q" >
                            </div>
                        </div> 
        
                        <div class="mb-2 mt-4 row">
                            <label  class="col-sm-2 col-form-label" style="font-size: 12px">Price</label>
                            <div class="col-sm-10 mr-3">
                                <input type="text" class="form-control text-sm" name="harga" placeholder="Rp." id="inputAngka3" >
                            </div>
                        </div>
        
                        <div class="mb-3 mt-4 row">
                            <label  class="col-sm-2 col-form-label" style="font-size: 12px">Discount</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control text-sm" name="diskon" placeholder="%" id="diskon" >
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control text-sm " name="total_diskon" placeholder="Rp." id="total" readonly>
                            </div>
                        </div>
                        
                        {{-- <div class="mb-3 mt-4 row">
                            <label  class="col-sm-2 col-form-label" style="font-size: 12px">Pajak</label>
                            <div class="col-sm-10 d-flex ml-3">
                                <input class="form-check-input " type="checkbox" value="11" id="flexCheckDefault3" name="ppn" >
                                <label class="form-check-label " for="flexCheckDefault3" style="margin-left:2%">
                                PPN 11 %
                                </label>
                            </div>
                        </div> --}}

                        <div class="mb-2 mt-4 row">
                            <label  class="col-sm-2 col-form-label" style="font-size: 12px">Total Price</label>
                            <div class="col-sm-10 mr-3">
                                <input type="text" class="form-control" name="total_harga" placeholder="Rp." id="subtot" readonly style="background-color: gray;color:white;"  >
                            </div>
                        </div>
                        <div class="mb-3 mt-4 row">
                            <label  class="col-sm-2 col-form-label" style="font-size: 12px">Tax</label>
                            <div class="col-sm-10 d-flex ml-3">
                                <input class="form-check-input " type="checkbox" value="11" id="flexCheckDefault3" name="ppn">
        
                                <label class="form-check-label " for="flexCheckDefault3"  style="margin-left:2%">
                                PPN 11 %
                                </label>
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

<script type="text/javascript">
    $(document).ready(function(){
      $("#inputAngka3,#diskon").keyup(function(){
        var kuantitas = parseInt($("#q").val());
        var harga  = parseInt($("#inputAngka3").val());
        var diskon  = parseInt($("#diskon").val());
        var subtot = kuantitas * harga ;
        var total =  ((diskon/100)*subtot);
        var total2 = subtot-total;
        $("#total").val(total);
        if (diskon) {
            $("#subtot").val(total2);
        } else {
            $("#subtot").val(subtot);
        }
      });
    });
  </script>


@endsection