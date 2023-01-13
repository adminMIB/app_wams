
@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('newassets/assets/extensions/choices.js/public/assets/styles/choices.css')}}">
<style>
    .overflow-me {
        -ms-overflow-style: none; /* for Internet Explorer, Edge */
        scrollbar-width: none; /* for Firefox */
        overflow-x: scroll; 
    }

    .overflow-me::-webkit-scrollbar {
        display: none; /* for Chrome, Safari, and Opera */
    }
</style>
@endsection
@section('content')
<!-- Basic Tables start -->
<section class="section">
<form action="{{route('createPesananPembelian/store',$shorder->id)}}" method="POST">   
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="mb-2 row">
                <label  class="col-sm-1 col-form-label" style="font-size: 12px">Supplier</label>
                <div class="col-sm-5">
                    <div class="form-group">
                        <select class="choices form-select" name="nama_client">
                            {{-- <option value="{{$shorder->institusi}}">{{$shorder->institusi}}</option> --}}
                            @foreach ($customer as $item)
                                <option value="{{$item->nama}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                {{-- <div class="col-sm-2">
                    <select name="mata_uang" id="" class="form-control align-self-center">
                        <option value="IDR">IDR</option>
                        <option value="USD">USD</option>
                    </select>
                </div> --}}
                <label  class="col-sm-1 col-form-label" style="font-size: 12px">Number #</label>
                <div class="col-sm-3">
                    <input type="number" class="form-control" name="no_penjualan">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-1 col-form-label" style="font-size: 12px">Date</label>
                <div class="col-sm-3">
                    <input type="date" class="form-control" name="tgl_penjualan">
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex">
        <div class="card col-9">
            <div class="card-header">
                <p style="font-size: 12px"><i class="bi bi-pencil"></i> Detail Stuff</p>
            </div>
            <div class="card-body">
                <input type="hidden" name="lto_id" value="{{$shorder->id}}" id="">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Project Code</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-sm" name="kode_project" value="{{$shorder->kode_project}}" readonly>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Client Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-sm" name="" value="{{$shorder->institusi}}" readonly>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Project Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control text-sm" name="proyek" value="{{$shorder->project}}" readonly>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Barang Name</label>
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
                        <input type="number" class="form-control text-sm" name="kuantitas" id="q" value="1">
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

                        <label class="form-check-label " for="flexCheckDefault3" style="margin-left:2%">
                        PPN 11 %
                        </label>
                    </div>
                </div>

                {{-- <div class="mb-3 mt-4 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Pajak</label>
                    <div class="col-sm-10 d-flex ml-3">
                        <input class="form-check-input " type="checkbox" value="11" id="flexCheckDefault3" name="ppn">

                        <label class="form-check-label " for="flexCheckDefault3" style="margin-left:2%">
                        PPN 11 %
                        </label>
                    </div>
                </div> --}}

                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Distributor</label>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <div class="form-group">
                                <select class="choices form-select" name="distributor">
                                    @foreach ($distributor as $item)
                                    <option value="{{$item->distributor}}">{{$item->distributor}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Department</label>
                    <div class="col-sm-10">
                        <div class="form-group">
                            <select class="choices form-select" name="departemen">
                                @foreach ($departemen as $item)
                                    <option value="{{$item->nama_departemen}}">{{$item->nama_departemen}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="p-2">
                <button type="submit" class="btn btn-primary w-100 " style="height: 120px">
                    <img src="{{ asset('newassets/assets/images/logo/icons8-save-50.png') }}" style="color: white" alt="Save">
                </button>
            </div>
            <div class="p-2 mt-3">
                <a href="javascript:void(0)" onClick="window.location.reload();">
                    <button type="button" class="btn btn-danger w-100 " style="height: 120px">
                        <img src="{{ asset('newassets/assets/images/logo/icons8-broom-64.png') }}" style="color: white" alt="Clear">
                    </button>
                </a>
            </div>
            <div class="p-2 mt-3">
                <a href="{{route('pesananPembelian',$shorder->id)}}">
                    <button type="button" class="btn btn-secondary w-100 " style="height: 120px">
                        <img src="{{ asset('newassets/assets/images/logo/icons8-back-arrow-50.png') }}" style="color: white" alt="Back">
                    </button>
                </a>
            </div>
        </div>
    </div>

    <div class="card ">
        <div class="card-header">
            <p style="font-size: 15px"><i class="bi bi-exclamation "></i><i>TERMS</i></p>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Shipping Address</label>
                    <div class="col-sm-6">
                        <textarea name="alamat" id="" cols="30" class="form-control" ></textarea>
                    </div>
                </div>

                <div class="mb-3 mt-4 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Tax</label>
                    <div class="col-sm-4">
                        <input class="form-check-input" name="pajak" type="checkbox" value="Kena Pajak" id="flexCheckDefault1">
                        <label class="form-check-label" for="flexCheckDefault1" style="font-size: 14px">
                            Taxable
                        </label>
                    </div>
                    <div class="col-sm-6">
                        <input class="form-check-input" name="pajak" type="checkbox" value="Total termasuk Pajak" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px">
                        Total Including Tax
                        </label>
                    </div>
                </div>

                {{-- <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">No.PO</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="nopo" id="">
                    </div>
                </div> --}}

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Delivery Date</label>
                    <div class="col-sm-6">
                        <input type="date" class="form-control" name="tgl_pengiriman" id="">
                    </div>
                </div>

                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Delivery</label>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="pengiriman" id="">
                        </div>
                    </div>
                </div>

                {{-- <div class="mb-3 mt-4 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Tutup Pesanan</label>
                    <div class="col-sm-4">
                        <input class="form-check-input" type="checkbox" value=" Ya (Tidak dapat diproses lagi)" id="flexCheckDefault2" name="tutup_pesanan">
                        <label class="form-check-label" for="flexCheckDefault2" style="font-size: 14px">
                            Ya (Tidak dapat diproses lagi)
                        </label>
                    </div>
                </div> --}}

                {{-- <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Cabang</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="cabang" id="">
                    </div>
                </div> --}}

                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">Term of Payment</label>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="syarat_pembayaran" id="">
                        </div>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label  class="col-sm-2 col-form-label" style="font-size: 12px">FOB</label>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="FOB" id="">
                        </div>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Information</label>
                    <div class="col-sm-6">
                        <textarea name="keterangan" id="" cols="30" class="form-control" ></textarea>
                    </div>
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
{{-- <script>
    var harga3 = document.getElementById('inputAngka3');
    harga3.addEventListener('keyup', function(e)
    {
        harga3.value = formatRupiah(this.value, );
    });
    
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ?  + rupiah : '');
    }
</script> --}}

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

