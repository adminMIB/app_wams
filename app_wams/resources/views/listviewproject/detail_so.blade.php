@extends('layouts.main')
@section('css')
    {{-- CSS assets in head section --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <style>
      .dz-image img {
         width: 120px;
         height: 120px;
      }
    </style>
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
          <h1>Details View Project</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <input type="hidden" class="form-control" name="file_project" value="{{ $dtorder->file_project }}" id="file_project" readonly>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">No Sales Order</label>
                        <input type="text" class="form-control" name="no_so"  value="{{$dtorder->no_so}}" id="exampleInputEmail1" readonly>
                    </div>
                    <div class="form-group">
                        <label>Tanggal Sales Order</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datetimepicker-input" name="tgl_so"  value="{{$dtorder->tgl_so}}" id="Date" placeholder="TGL Sales Order" data-target="#reservationdate"readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Distributor</b></label>
                        <input type="text" name="distributor" id="distributor" class="form-control"  value="{{$dtorder->distributor}}" placeholder="Distributor" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>SBU</b></label>
                        <input type="text" name="sbu" id="sbu" class="form-control"  value="{{$dtorder->sbu}}" placeholder="SBU" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Confidence Level</b></label>
                        <input type="text" name="confidence_level" id="confidence_level" value="{{$dtorder->confidence_level}}" class="form-control" placeholder="Presales"readonly>
                    </div>
                </div>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Project</label>
                        <input type="text" class="form-control" name="project" value="{{$dtorder->project}}" id="exampleInputEmail1" placeholder="Project" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Estimated Amount</b></label>
                        <input type="text" name="estimated_amount" id="estimated_amount" value="{{$dtorder->estimated_amount}}" class="form-control" placeholder="Estimated Amount" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Principal</b></label>
                        <input type="text" name="principal" id="principal" value="{{$dtorder->principal}}" class="form-control" placeholder="Principal" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Progress Status</b></label>
                        <input type="text" name="status_project" id="Status" value="{{$dtorder->status_project}}" class="form-control" placeholder="Progress Status" readonly>
                    </div>                
                    <div class="form-group">
                        <label class="required"><b>Contract Amount</b></label>
                        <input type="text" name="contract_amount" id="contract" value="{{$dtorder->contract_amount}}" class="form-control" placeholder="Contract Amount" readonly>
                    </div>                
                </div>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Institusi</label>
                        <input type="text" class="form-control" name="institusi" value="{{$dtorder->institusi}}" id="exampleInputEmail1" placeholder="Institusi" readonly>
                    </div>
                    <div class="form-group">
                        <label for="ID_project">Kode Project</label>
                        <input type="text" class="form-control" id="ID_project" value="{{$dtorder->kode_project}}" name="kode_project" placeholder="Project ID" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>PMO</b></label>
                        <input type="text" name="pmo" id="pmo" value="{{$dtorder->pmo}}" class="form-control" placeholder="PMO" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Prasales</b></label>
                        <input type="text" name="presales" id="presales" value="{{$dtorder->presales}}" class="form-control" placeholder="Presales" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>AM/sales</b></label>
                        <input type="text" name="amsales" id="amsales" value="{{$dtorder->amsales}}" class="form-control" placeholder="Presales" readonly>
                    </div>
                </div>
            </div>
            <div>
                <h3>Cost Amount</h3>
                @foreach ($dtorder->amdetail as $item)
                    <div>
                        <div class="col-lg-6">
                            <div class="row mb-2">
                                <div class="mr-2">
                                    <input type="text" class="form-control" name="title[]" value="{{ $item->title }}" readonly>
                                </div>
                                <div class="mr-2">
                                    <input type="number" class="form-control amountT" name="amount[]" value="{{ $item->amount }}" readonly>
                                </div>
                            </div>
                        </div>    
                    </div>
                @endforeach
                <div class="form-group w-25">
                    <label for="total">Total</label>
                    <input type="number" class="form-control total" name="totalSO" value="{{ $dtorder->total }}" readonly>
                </div>
                <h3 class="mt-3">Product</h3>
                @foreach ($dtorder->pddetail as $it)
                    <div>
                        <div class="container mb-3">
                            <div class="row">
                                <div class="mr-2">
                                    <label for="" class="">Nama Product</label>
                                    <input type="text" class="form-control" name="product_name[]" value="{{ $it->product_name }}" readonly>
                                </div>
                                <div class="mr-2">
                                    <label for="" class="">Quantity</label>
                                    <input type="text" class="form-control" name="product_quantity[]" value="{{ $it->product_quantity }}" readonly>
                                </div>
                                <div class="mr-2">
                                    <label for="" class="">Harga</label>
                                    <input type="text" class="form-control" name="harga_product[]" value="{{ $it->harga_product }}" readonly>
                                </div>
                                <div class="mr-2">
                                    <label for="" class="">Total</label>
                                    <input type="text" class="form-control" name="total[]" value="{{ $it->total }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div>
                <a href="{{ url('list_so') }}" class="btn btn-secondary">Back</a>
                <button class="btn btn-success ml-2" onclick="tableToExcel('soexel')" >Export</button>
                <a href="{{url ('Sshow/sopdf', $dtorder->id)}}" class="btn btn-danger float-right">Cetak PDF</a>
            </div>
        </div>
    </div>

    <div class="d-none" id="soexel">

        <div class="page-container">
            Page
            <span class="page"></span>
            of
            <span class="pages"></span>
        </div>
        
        <img style="height: 100px;" src="https://mitraintibersama.com/assets/img/logo-mib.png">
        <div class="">
            <h3 class="text-primary">Sales Orders</h3>
            <table class="w-50">
            <thead>
                <tr>
                <th>Referensi</th>
                <td>{{ $dtorder->no_so }}</td>
                </tr>
                <tr>
                <th>Tanggal</th>
                <td>{{ $dtorder->tgl_so }}</td>
                </tr>
                <tr>
                <th>Status</th>
                <td><b>{{ $dtorder->status }}</b></td>
                </tr>
            </thead>
            </table>
        </div>

            <table class="mt-5">
            <thead>
                <tr>
                <th class="text-center">Info Perusahaan <hr></th>
                <th></th>
                <th></th>
                <th></th>
                <th class="text-center">Order Dari <hr></th>
                </tr>
                <tr>
                <th class="text-center">PT. Mitra Inti Bersama</th>
                <th></th>
                <th></th>
                <th></th>
                <th class="text-center">{{ $dtorder->distributor }}</th>
                </tr>
                <tr>
                <td class="text-center">
                    Rukan Mangga Dua Squere Blok F 7-11, 
                    Jl. Gunung Sahari Raya No. 1, Jakarta Utara, 
                    DKI Jakarta, 14430 
                    Indonesia
                </td>
                <td></td>
                <td></td>
                <td></td>
                <td class="text-center">
                    Gd Palma One Lt 5 Suite 500 , 
                    Jl HR Rasuna Said Blok X2 Kav 4 Kuningan Timur 
                    Setiabudi, Jakarta Selatan, 
                    DKI Jakarta, 12950
                    Indonesia
                </td>
                </tr>
            </thead>
            </table>
        
        {{-- <div class="d-flex">
            <div class="w-25" style="margin-right: 125px;">
            <h6>Info Perusahaan</h6><hr>
            <h5>PT. Mitra Inti Bersama</h5>
            <p>
                Gd Palma One Lt 5 Suite 500 , 
                Jl HR Rasuna Said Blok X2 Kav 4 Kuningan Timur 
                Setiabudi, Jakarta Selatan, 
                DKI Jakarta, 12950
                Indonesia
            </p>
            <p>Telp</p>
            <p>Email</p>
            </div>
            <div class="w-25">
            <h6>Order Dari</h6><hr>
            <h5>{{ $dtorder->distributor }}</h5>
            <p>
                Rukan Mangga Dua Squere Blok F 7-11, 
                Jl. Gunung Sahari Raya No. 1, Jakarta Utara, 
                DKI Jakarta, 14430 
                Indonesia
            </p>
            <p>Telp</p>
            <p>Email</p>
            </div>
        </div> --}}
        
        <table class="table" style="margin-top: 50px;">
            <thead class="table-dark">
            <tr>
                <th>Produk</th>
                <th>Kuantitas</th>
                <th>Harga</th>
                <th class="text-right">Total</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($dtorder->pddetail as $item)
                @php
                $ab = $item->total + $item->total;
                @endphp
                <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->product_quantity }}</td>
                <td>{{ $item->harga_product }}</td>
                <td>{{ $item->total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <table class="line-items-container has-bottom-border">
            <thead>
            <tr>
                <th>Syarat dan Ketentuan</th>
                <th>di Buat Tanggal</th>
                <th>Sub Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="payment-info">
                <div>
                    TOP :
                </div>
                <div>
                    Back to Back
                </div>
                </td>
                <td class="large">{{ date('D, M Y') }}</td>
                <td class="large total">Rp. {{ $dtorder->grandtotal }}</td>
            </tr>
            </tbody>
        </table>

    </div>

    <script src="../assets/js/export_exel.js"></script>
</section>
@endsection