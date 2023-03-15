
@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('newassets/assets/extensions/choices.js/public/assets/styles/choices.css')}}">
@endsection
@section('content')
<!-- Basic Tables start -->
<section class="section">
    @if ($edt->pp->tutup_pesanan)
    <form action="{{ route('pesanan.update', $edt->id) }}" method="POST">
        @method('put')
        @csrf
        {{-- @foreach ($edt as $item) --}}
        <div class="card">
            <div class="card-body">
                <div class="mb-2 row">
                    <label  class="col-sm-1 col-form-label" style="font-size: 12px">Order By</label>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{$edt->pp->nama_client}}" readonly>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <input type="text" class="form-control align-self-center" value="{{$edt->pp->mata_uang}}" readonly>
                    </div>
                    <label  class="col-sm-1 col-form-label" style="font-size: 12px">Number :</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="no_penjualan" value="{{$edt->pp->no_pesanan}}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-1 col-form-label" style="font-size: 12px">Date</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" name="tgl_penjualan" value="{{$edt->pp->tgl_penjualan}}" readonly>
                    </div>
                </div>
            </div>
        </div>
        {{-- @endforeach --}}
        
    
        <div class="d-flex">
            <div class="card col-9">
                <div class="card-header">
                    <p style="font-size: 12px"><i class="bi bi-pencil"></i> Detail Barang</p>
                </div>
                <div class="card-body">
                    <input type="hidden" name="lto_id" value="{{$edt->pp->id}}" id="">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Project Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-sm" name="kode_project" value="{{$edt->pp->kode_project}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Client Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-sm" name="" value="{{$edt->pp->nama_client}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Project Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-sm" name="proyek" value="{{$edt->pp->proyek}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Stuff Name</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$edt->nama_barang}}" readonly>
                            </div>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control text-sm" name="kuantitas" id="q" value="{{$edt->kuantitas}}" readonly>
                        </div>
                    </div> 
    
                    <div class="mb-2 mt-4 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Price</label>
                        <div class="col-sm-10 mr-3">
                            <input type="text" class="form-control text-sm" name="harga" placeholder="Rp." id="inputAngka3" value="{{$edt->harga}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-3 mt-4 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Discount</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control text-sm" name="diskon" placeholder="%" id="diskon" value="{{$edt->diskon}}"  readonly>
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control text-sm " placeholder="Rp." id="total" name="total_diskon" value="{{ $edt->total_diskon }}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-2 mt-4 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Total Price</label>
                        <div class="col-sm-10 mr-3">
                            <input type="text" class="form-control" name="total_harga" placeholder="Rp." id="subtot" style="background-color: gray;color:white;" value="{{$edt->total_harga}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-3 mt-4 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Tax</label>
                        <div class="col-sm-10 d-flex ml-3">
                            <input class="form-check-input " type="checkbox" value="11" {{ $edt->ppn=="11"? 'checked':'' }} id="flexCheckDefault3" name="ppn" disabled>
    
                            <label class="form-check-label " for="flexCheckDefault3" style="margin-left:2%">
                            PPN 11 %
                            </label>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Distributor</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <div class="form-group">
                                    <input type="text" class="form-control" value="{{$edt->pp->nama_disti}}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Department</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <input type="text" class="form-control" value="{{$edt->pp->departemen}}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="p-2">
                    <button type="submit" class="btn btn-primary w-100 " style="height: 120px"><img src="{{ asset('newassets/assets/images/logo/icons8-save-50.png') }}" style="color: white" alt="Save"></button>
                </div>
                <div class="p-2 mt-3">
                    <a href="javascript:void(0)" onClick="window.location.reload();"><button type="button" class="btn btn-danger w-100 " style="height: 120px"><img src="{{ asset('newassets/assets/images/logo/icons8-broom-64.png') }}" style="color: white" alt="Clear"></button></a>
                </div>
                <div class="p-2 mt-3">
                    <a href="{{route('penawaran',$edt->pp->id)}}"><button type="button" class="btn btn-secondary w-100 " style="height: 120px"><img src="{{ asset('newassets/assets/images/logo/icons8-back-arrow-50.png') }}" style="color: white" alt="Back"></button></a>
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
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Address</label>
                        <div class="col-sm-6">
                            <textarea name="alamat" id="" cols="30" class="form-control" required readonly>{{$edt->pp->alamat}}</textarea>
                        </div>
                    </div>
    
                    <div class="mb-3 mt-4 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Tax</label>
                        <div class="col-sm-4">
                            <input class="form-check-input" name="pajak" type="radio" value="Kena Pajak" {{$edt->pp->pajak=="Kena Pajak"? 'checked':''}} id="flexCheckDefault1" disabled>
                            <label class="form-check-label" for="flexCheckDefault1" style="font-size: 14px">
                                Taxable
                            </label>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-check-input" name="pajak" type="radio" value="Total termasuk Pajak" {{$edt->pp->pajak=="Total termasuk Pajak"? 'checked':''}} id="flexCheckDefault" disabled>
                            <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px">
                            Total Including Tax
                            </label>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">No.PO</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nopo" id="" value="{{$edt->pp->nopo}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Delivery Date</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" name="tgl_pengiriman" id="" value="{{$edt->pp->tgl_pengiriman}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Delivery</label>
                        <div class="col-sm-6">
                            <input type="text" name="pengiriman" class="form-control" value="{{$edt->pp->pengiriman}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-3 mt-4 row">
                            <label  class="col-sm-2 col-form-label" style="font-size: 12px">Close Order</label>
                        <div class="col-sm-4">
                            <input class="form-check-input" type="checkbox" value="Ya" {{$edt->pp->tutup_pesanan=="Ya"? 'checked':''}}  id="flexCheckDefault2" name="tutup_pesanan" disabled>
                            <label class="form-check-label" for="flexCheckDefault2" style="font-size: 14px">
                                Yes (Cannot be processed anymore)
                            </label>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Branch</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="cabang" id="" value="{{$edt->pp->cabang}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Terms of payment</label>
                        <div class="col-sm-6">
                            <input type="text" name="syarat_pembayaran" class="form-control" value="{{$edt->pp->syarat_pembayaran}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">FOB</label>
                        <div class="col-sm-6">
                            <input type="text" name="FOB" class="form-control" value="{{$edt->pp->FOB}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Information</label>
                        <div class="col-sm-6">
                            <textarea name="keterangan" id="" cols="30" class="form-control" readonly>{{$edt->pp->keterangan}}</textarea>
                        </div>
                    </div>
    
                </div>
            </div>
    
        </div>
    </form>
    @else
    <form action="{{ route('pesanan.update', $edt->id) }}" method="POST">
        @method('put')
        @csrf
        {{-- @foreach ($edt as $item) --}}
        <div class="card">
            <div class="card-body">
                <div class="mb-2 row">
                    <label  class="col-sm-1 col-form-label" style="font-size: 12px">Order By</label>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <select class="choices form-select" name="nama_client" required>
                                <option value="{{$edt->pp->nama_client}}" selected>{{$edt->pp->nama_client}}</option>
                                @foreach ($customer as $item)
                                <option value="{{$item->nama}}">{{$item->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <select name="mata_uang" id="" class="form-control align-self-center" required>
                            <option value="{{$edt->pp->mata_uang}}" selected >{{$edt->pp->mata_uang}}</option>
                            <option value="IDR">IDR</option>
                            <option value="USD">USD</option>
                        </select>
                    </div>
                    <label  class="col-sm-1 col-form-label" style="font-size: 12px">Number :</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control" name="no_pesanan" value="{{$edt->pp->no_pesanan}}" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="staticEmail" class="col-sm-1 col-form-label" style="font-size: 12px">Date</label>
                    <div class="col-sm-3">
                        <input type="date" class="form-control" name="tgl_penjualan" value="{{$edt->pp->tgl_penjualan}}" required>
                    </div>
                </div>
            </div>
        </div>
        {{-- @endforeach --}}
        
    
        <div class="d-flex">
            <div class="card col-9">
                <div class="card-header">
                    <p style="font-size: 12px"><i class="bi bi-pencil"></i> Detail Stuff</p>
                </div>
                <div class="card-body">
                    <input type="hidden" name="lto_id" value="{{$edt->pp->id}}" id="">
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Project Code</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-sm" name="kode_project" value="{{$edt->pp->kode_project}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Client Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-sm" name="" value="{{$edt->pp->nama_client}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Project Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control text-sm" name="proyek" value="{{$edt->pp->proyek}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Stuff Name</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <select class="choices form-select " name="nama_barang" required>
                                    <option value="{{$edt->nama_barang}}" selected>{{$edt->nama_barang}}</option>
                                    @foreach ($brg as $item)
                                    <option value="{{$item->nama_barang}}">{{$item->nama_barang}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control text-sm" name="kuantitas" id="q" value="{{$edt->kuantitas}}" required>
                        </div>
                    </div> 
    
                    <div class="mb-2 mt-4 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Price</label>
                        <div class="col-sm-10 mr-3">
                            <input type="text" class="form-control text-sm" name="harga" placeholder="Rp." id="inputAngka3" value="{{$edt->harga}}" required>
                        </div>
                    </div>
    
                    <div class="mb-3 mt-4 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Discount</label>
                        <div class="col-sm-4">
                            <input type="number" class="form-control text-sm" name="diskon" placeholder="%" id="diskon" value="{{$edt->diskon}}" >
                        </div>
                        <div class="col-sm-6">
                            <input type="number" class="form-control text-sm " placeholder="Rp." id="total" name="total_diskon" value="{{ $edt->total_diskon }}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-2 mt-4 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Total Price</label>
                        <div class="col-sm-10 mr-3">
                            <input type="text" class="form-control" name="total_harga" placeholder="Rp." id="subtot" style="background-color: gray;color:white;" value="{{$edt->total_harga}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-3 mt-4 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">TAX</label>
                        <div class="col-sm-10 d-flex ml-3">
                            <input class="form-check-input " type="checkbox" value="11" {{ $edt->ppn=="11"? 'checked':'' }} id="flexCheckDefault3" name="ppn">
    
                            <label class="form-check-label " for="flexCheckDefault3" style="margin-left:2%">
                            PPN 11 %
                            </label>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Distributor</label>
                        <div class="col-sm-10">
                            <div class="form-group">
                                <div class="form-group">
                                    <select class="form-select" name="nama_disti" required>
                                        <option value="{{$edt->pp->nama_disti}}" selected>{{$edt->pp->nama_disti}}</option>
                                        @foreach ($disti as $item)
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
                                <select class="form-select" name="departemen" required>
                                <option value="{{$edt->pp->departemen}}" selected>{{$edt->pp->departemen}}</option>
                                @foreach ($dept as $item)
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
                    <button type="submit" class="btn btn-primary w-100 " style="height: 120px"><img src="{{ asset('newassets/assets/images/logo/icons8-save-50.png') }}" style="color: white" alt="Save"></button>
                </div>
                <div class="p-2 mt-3">
                    <a href="javascript:void(0)" onClick="window.location.reload();"><button type="button" class="btn btn-danger w-100 " style="height: 120px"><img src="{{ asset('newassets/assets/images/logo/icons8-broom-64.png') }}" style="color: white" alt="Clear"></button></a>
                </div>
                <div class="p-2 mt-3">
                    <a href="{{route('penawaranpesanan',$edt->pp->id)}}"><button type="button" class="btn btn-secondary w-100 " style="height: 120px"><img src="{{ asset('newassets/assets/images/logo/icons8-back-arrow-50.png') }}" style="color: white" alt="Back"></button></a>
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
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Address</label>
                        <div class="col-sm-6">
                            <textarea name="alamat" id="" cols="30" class="form-control" required>{{$edt->pp->alamat}}</textarea>
                        </div>
                    </div>
    
                    <div class="mb-3 mt-4 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Tax</label>
                        <div class="col-sm-4">
                            <input class="form-check-input" name="pajak" type="radio" value="Kena Pajak" {{$edt->pp->pajak=="Kena Pajak"? 'checked':''}} id="flexCheckDefault1" >
                            <label class="form-check-label" for="flexCheckDefault1" style="font-size: 14px">
                                Taxable
                            </label>
                        </div>
                        <div class="col-sm-6">
                            <input class="form-check-input" name="pajak" type="radio" value="Total termasuk Pajak" {{$edt->pp->pajak=="Total termasuk Pajak"? 'checked':''}} id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault" style="font-size: 14px">
                            Total Including Tax
                            </label>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">No.PO</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="nopo" id="" value="{{$edt->pp->nopo}}" required>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Delivery Date</label>
                        <div class="col-sm-6">
                            <input type="date" class="form-control" name="tgl_pengiriman" id="" value="{{$edt->pp->tgl_pengiriman}}" required>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Delivery</label>
                        <div class="col-sm-6">
                            <input type="text" name="pengiriman" class="form-control" value="{{$edt->pp->pengiriman}}">
                        </div>
                    </div>
    
                    <div class="mb-3 mt-4 row">
                            <label  class="col-sm-2 col-form-label" style="font-size: 12px">Close Order</label>
                        <div class="col-sm-4">
                            <input class="form-check-input" type="checkbox" value="Ya" {{$edt->pp->tutup_pesanan=="Ya"? 'checked':''}}  id="flexCheckDefault2" name="tutup_pesanan">
                            <label class="form-check-label" for="flexCheckDefault2" style="font-size: 14px">
                                Yes (Cannot be processed anymore)
                            </label>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Branch</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="cabang" id="" value="{{$edt->pp->cabang}}" required>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">Terms of payment</label>
                        <div class="col-sm-6">
                            <input type="text" name="syarat_pembayaran" class="form-control" value="{{$edt->pp->syarat_pembayaran}}" required>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label  class="col-sm-2 col-form-label" style="font-size: 12px">FOB</label>
                        <div class="col-sm-6">
                            <input type="text" name="FOB" class="form-control" value="{{$edt->pp->FOB}}" required>
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label" style="font-size: 12px">Information</label>
                        <div class="col-sm-6">
                            <textarea name="keterangan" id="" cols="30" class="form-control" >{{$edt->pp->keterangan}}</textarea>
                        </div>
                    </div>
    
                </div>
            </div>
    
        </div>
    </form>
    @endif

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

