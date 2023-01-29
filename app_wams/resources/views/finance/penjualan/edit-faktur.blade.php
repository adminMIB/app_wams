@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('newassets/assets/extensions/choices.js/public/assets/styles/choices.css')}}">
@endsection
@section('content')
<!-- Basic Tables start -->
<section class="section">
<form action="{{route('faktur.update',$shorder->id)}}" method="POST">
    @csrf
    @method('put')
    <div class="card">
        <div class="card-body">
            <div class="mb-2 row">
                <label  class="col-sm-1 col-form-label" style="font-size: 12px">Customer</label>
                <div class="col-sm-4">
                    <div class="form-group">
                        <select class="choices form-select" name="nama_client" required>
                            <option value="{{$shorder->fp->nama_client}}">{{$shorder->fp->nama_client}}</option>
                            @foreach ($customer as $item)
                            <option value="{{$item->nama}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <select name="mata_uang" id="" class="form-control align-self-center" required>
                        <option value="{{$shorder->fp->mata_uang}}">{{$shorder->fp->mata_uang}}</option>
                        <option value="IDR">IDR</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
                <label  class="col-sm-2 col-form-label" style="font-size: 12px">No. Faktur :</label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" name="no_faktur" value="{{ $shorder->fp->no_faktur }}" readonly required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-1 col-form-label" style="font-size: 12px">Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" value="{{$shorder->fp->tgl_pesanan}}" name="tgl_pesanan" required>
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
                        <input type="number" class="form-control text-sm" value="1" name="kuantitas" value="{{$shorder->kuantitas}}" id="q" required>
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
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">No.PO</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="{{$shorder->fp->no_po}}" name="no_po" id="" required>
                        </div>
                    </div>
    
                    <div class="mb-3 mt-4 row">
                        <label  class="col-md-3 col-form-label" style="font-size: 12px">Tax</label>
                        <div class="col">
                            <input class="form-check-input" name="pajak" type="radio" value="Kena Pajak" {{$shorder->fp->pajak=="Kena Pajak"? 'checked':''}} id="flexCheckDefault1">
                            <label class="form-check-label" for="flexCheckDefault1" style="font-size: 14px">
                                Taxable
                            </label>
                        </div>
                        <div class="col">
                            <input class="form-check-input" name="pajak" type="radio" value="Total termasuk Pajak" {{$shorder->fp->pajak=="Total termasuk Pajak"? 'checked':''}} id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px">
                                Total Including Tax
                            </label>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-md-3 col-form-label" style="font-size: 12px">Document Type</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$shorder->fp->jenis_dok}}" name="jenis_dok" required>
                            </div>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">Tax Faktur Date</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" value="{{$shorder->fp->tgl_faktur}}" name="tgl_faktur" id="" required>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">No Faktur Tax</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" value="{{$shorder->fp->no_faktur_pajak}}" name="no_faktur_pajak" id="" required>
                        </div>
                    </div>
                    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">Address</label>
                        <div class="col-md-9">
                            <textarea name="alamat" id="" cols="30" class="form-control" required>{{$shorder->fp->alamat}}</textarea>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">Branch</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="cabang" value="{{$shorder->fp->cabang}}" id="" required>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">Delivery Date</label>
                        <div class="col-md-9">
                            <input type="date" class="form-control" name="tgl_pengiriman" value="{{$shorder->fp->tgl_pengiriman}}" id="" required>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-md-3 col-form-label" style="font-size: 12px">Delivery</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" class="form-control" name="pengiriman" value="{{$shorder->fp->pengiriman}}">
                            </div>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-md-3 col-form-label" style="font-size: 12px">Terms of payment</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" class="form-control" name="syarat_pembayaran" value="{{$shorder->fp->syarat_pembayaran}}" required>
                            </div>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-md-3 col-form-label" style="font-size: 12px">FOB</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" class="form-control" name="FOB" value="{{$shorder->fp->FOB}}" required>
                            </div>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">End User</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="{{$shorder->fp->end_user}}" name="end_user" id="" required>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">Attention</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="attention" value="{{$shorder->fp->attention}}" id="" required>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-md-3 col-form-label" style="font-size: 12px">Choose Bank</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <select class="choices form-select " name="bank" required>
                                    <option value="{{ $shorder->fp->bank }}">{{ $shorder->fp->bank }}</option>
                                    @foreach ($bank as $item)
                                    <option value="{{ $item->NamaBank }} - {{$item->NoRekg}}">{{ $item->NamaBank }} - {{$item->NoRekg}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">Information</label>
                        <div class="col-md-9">
                            <textarea name="keterangan" id="" cols="30" class="form-control">{{$shorder->fp->keterangan}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="p-2">
                        <button type="submit" class="btn btn-primary w-100 " style="height: 120px"><img src="{{ asset('newassets/assets/images/logo/icons8-save-50.png') }}" style="color: white" alt="Save"></button>
                    </div>
                    <div class="p-2 mt-3">
                        <a href="javascript:void(0)" onClick="window.location.reload();"><button type="button" class="btn btn-danger w-100 " style="height: 120px"><img src="{{ asset('newassets/assets/images/logo/icons8-broom-64.png') }}" style="color: white" alt="Clear"></button></a>
                    </div>
                    <div class="p-2 mt-3">
                        <a href="{{route('faktur',$shorder->fp->id)}}"><button type="button" class="btn btn-secondary w-100 " style="height: 120px"><img src="{{ asset('newassets/assets/images/logo/icons8-back-arrow-50.png') }}" style="color: white" alt="Back"></button></a>
                    </div>
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
        <input type="hidden" name="pesanan_id" value="{{$shorder->id}}">
        <input type="hidden" name="lto_id" value="{{$shorder->lto_id}}">
    </div>
    <div class="card">
        <div class="card-header">
            <p style="font-size: 15px"><i class="bi bi-exclamation "></i><i>More Information</i></p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-9">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-md-3 col-form-label" style="font-size: 12px">NPWP</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="npwp" value="{{ $shorder->fp->npwp }}" id="">
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-md-3 col-form-label" style="font-size: 12px">No. Phone</label>
                        <div class="col-md-9">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{ $shorder->fp->phone }}" name="phone">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
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