@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('newassets/assets/extensions/choices.js/public/assets/styles/choices.css')}}">
@endsection
@section('content')
<!-- Basic Tables start -->
<section class="section">
<form action="{{route('faktur.updateFP',$shorder->id)}}" method="POST">
    @csrf
    @method('put')
    <div class="card">
        <div class="card-body">
            <div class="mb-2 row">
                <label  class="col-sm-1 col-form-label" style="font-size: 12px">Supplier</label>
                <div class="col-sm-4">
                    <div class="form-group">
                        <select class="choices form-select" name="nama_client" required>
                            <option value="{{$shorder->fpn->nama_client}}">{{$shorder->fpn->nama_client}}</option>
                            @foreach ($customer as $item)
                            <option value="{{$item->nama}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <select name="mata_uang" id="" class="form-control align-self-center" required>
                        <option value="{{$shorder->fpn->mata_uang}}">{{$shorder->fpn->mata_uang}}</option>
                        <option value="IDR">IDR</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
                <label  class="col-sm-2 col-form-label" style="font-size: 12px">No. Faktur :</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="no_faktur" value="{{ $shorder->fpn->no_faktur }}" readonly required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-1 col-form-label" style="font-size: 12px">Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" value="{{$shorder->fpn->tanggal_faktur}}" name="tanggal_faktur" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-1 col-form-label" style="font-size: 12px">No Form</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" value="{{$shorder->fpn->no_form}}" name="no_form" required>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-row flex-nowrap overflow-auto">
        <div class="card col-9" style="margin-right: 20px;">
            <div class="card-header">
                <p style="font-size: 12px"><i class="bi bi-pencil"></i> Detail Stuff</p>
            </div>
            <div class="card-body">
                {{-- <input type="hidden" name="fajul_id" value="{{$shorder->id}}" id=""> --}}
                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Stuff Name</label>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <select class="choices form-select " name="nama_barang" required>
                                <option value="{{$shorder->nama_barang}}">{{$item->nama_barang}}</option>
                                @foreach ($brg as $it)
                                <option value="{{$it->nama_barang}}">{{$it->nama_barang}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Quantity</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control text-sm"  name="kuantitas" value="{{$shorder->kuantitas}}" id="q" required>
                    </div>
                </div> 

                <div class="mb-2 mt-4 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Price</label>
                    <div class="col-sm-10 mr-3">
                        <input type="text" class="form-control text-sm" name="harga" value="{{$shorder->harga}}" placeholder="Rp." id="inputAngka3" required>
                    </div>
                </div>

                <div class="mb-3 mt-4 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Discount</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control text-sm" name="diskon" value="{{$shorder->diskon}}" placeholder="%" id="diskon" >
                    </div>
                    <div class="col-sm-6">
                        <input type="number" class="form-control text-sm " name="total_diskon" value="{{$shorder->total_diskon}}" placeholder="Rp." id="total" readonly>
                    </div>
                </div>

                <div class="mb-2 mt-4 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Total Price</label>
                    <div class="col-sm-10 mr-3">
                        <input type="text" class="form-control" name="total_harga" value="{{$shorder->total_harga}}" placeholder="Rp." id="subtot" readonly style="background-color: gray;color:white;"  >
                    </div>
                </div>

                <div class="mb-3 mt-4 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Tax</label>
                    <div class="col-sm-10 d-flex ml-3">
                        <input class="form-check-input " type="checkbox" value="11" {{ $shorder->ppn=="11"? 'checked':'' }} id="flexCheckDefault3" name="ppn">

                        <label class="form-check-label " for="flexCheckDefault3" style="margin-left:2%">
                        PPN 11 %
                        </label>
                    </div>
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
                
                <div class="col-md-9">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">Shipping Address</label>
                        <div class="col-md-9">
                            <textarea name="alamat" id="" cols="30" class="form-control" >{{ $shorder->fpn->alamat }}</textarea>
                        </div>
                    </div>
    
                    <div class="mb-3 mt-4 row">
                        <label  class="col-md-3 col-form-label" style="font-size: 12px">Tax</label>
                        <div class="col">
                            <input class="form-check-input" name="pajak" type="radio" value="Kena Pajak" {{$shorder->fpn->pajak=="Kena Pajak"? 'checked':''}} id="flexCheckDefault1">
                            <label class="form-check-label" for="flexCheckDefault1" style="font-size: 14px">
                                {{-- {{ $shorder->pajak }} --}} Taxable
                            </label>
                        </div>
                        <div class="col">
                            <input class="form-check-input" name="pajak" type="radio" value="Total termasuk Pajak" {{$shorder->fpn->pajak=="Total termasuk Pajak"? 'checked':''}} id="flexCheckDefault">                        <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px">
                                {{-- {{ $shorder->pajak }} --}} Total Including Tax
                            </label>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">Delivery Date</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" name="tgl_pengiriman" id="" value="{{ $shorder->fpn->tgl_pengiriman }}">
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-md-3 col-form-label" style="font-size: 12px">Delivery</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                {{-- <select class="choices form-select " name="pengiriman">
                                    <option value="{{ $shorder->pengiriman }}">{{ $shorder->pengiriman }}</option>
                                </select> --}}
                                <input type="text" class="form-control" name="pengiriman" id="" value="{{ $shorder->fpn->pengiriman }}">
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
                                <input type="text" class="form-control" name="syarat_pembayaran" id="" value="{{ $shorder->fpn->syarat_pembayaran }}">
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
                                <input type="text" class="form-control" name="FOB" id="" value="{{ $shorder->fpn->FOB }}">
                            </div>
                        </div>
                    </div>
        
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">Information</label>
                        <div class="col-md-9">
                            <textarea name="keterangan" id="" cols="30" class="form-control" >{{ $shorder->fpn->keterangan }}</textarea>
                        </div>
                    </div>
                </div>

                
                <div class="d-flex mt-4 justify-content-center">
                    
                    <button type="submit" class="btn btn-primary w-40 " style="height: 80px">
                        <img src="{{ asset('newassets/assets/images/logo/icons8-save-50.png') }}" style="color: white" alt="Save">
                    </button>
                
                    <a href="javascript:void(0)" onClick="window.location.reload();">
                        <button type="button" class="btn btn-danger w-40 " style="height: 80px;margin-left:20%">
                            <img src="{{ asset('newassets/assets/images/logo/icons8-broom-64.png') }}" style="color: white" alt="Clear">
                        </button></a>
                
                
                    <a href="{{url('PembelianFaktur',$shorder->fpn->id)}}">
                        <button type="button" class="btn btn-secondary w-40  " style="height: 80px;margin-left:50%">
                            <img src="{{ asset('newassets/assets/images/logo/icons8-back-arrow-50.png') }}" style="color: white" alt="Back">
                        </button>
                    </a>
                
            </div>

            </div>
        </div>
        {{-- Total get --}}
        <?php
        $total_harga2 = 0;
        $total_ppn = 0;
        $total = 0;
                ?>
                <?php
                $total_harga2 +=$shorder->total_harga;
                $total_ppn += $shorder->total_ppn;
                $total = $total_harga2 + $total_ppn;
        ?>
        <input type="hidden" name="total" value="{{$total}}">
        <input type="hidden" name="pembelian_id" value="{{$shorder->id}}">
        <input type="hidden" name="lto_id" value="{{$shorder->lto_id}}">
    </div>
</form>
{{-- </form> --}}
</section>
<!-- Basic Tables end -->
@endsection
@section('js')
<script src="http://code.jquery.com/jquery-2.1.4.js"></script>
<script src="{{asset('newassets/assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{asset ('newassets/assets/js/pages/form-element-select.js')}}"></script>

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