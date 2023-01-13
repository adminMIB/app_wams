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
    <div class="section-header">
        <h1 class="text-center mb-5">Detail Approval SO</h1>
    </div>
    <div class="card">
        <form action="{{route('updateStatusApproval', $dtorder->id)}}" method="POST" enctype="multipart/form-data" class="m-2 p-2" ">
          {{csrf_field()}}
            <div class="row">
                <input type="hidden" class="form-control" name="file_project" value="{{ $dtorder->file_project }}" id="file_project" readonly>
                <div class="column col-md-4 col-12 mb-4">
                    <div class="form-group mb-3">
                        <label for="exampleInputEmail1"><b>No Sales Order</b></label>
                        <input type="text" class="form-control" name="no_so"  value="{{$dtorder->no_so}}" id="exampleInputEmail1" readonly>
                    </div>
                    <div class="form-group mb-3 ">
                        <label><b>Date Sales Order</b></label>
                        <div class="input-group date">
                            <input type="text" class="form-control datetimepicker-input" name="tgl_so"  value="{{$dtorder->tgl_so}}" id="Date" placeholder="TGL Sales Order" data-target="#reservationdate"readonly />
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="required"><b>Distributor</b></label>
                        <input type="text" name="distributor" id="distributor" class="form-control"  value="{{$dtorder->distributor}}" placeholder="Distributor" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="required"><b>SBU</b></label>
                        <input type="text" name="sbu" id="sbu" class="form-control"  value="{{$dtorder->sbu}}" placeholder="SBU" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="required"><b>Confidence Level</b></label>
                        <input type="text" name="confidence_level" id="confidence_level" value="{{$dtorder->confidence_level}}" class="form-control" placeholder="Presales"readonly>
                    </div>
                </div>
                <div class="column col-md-4 col-12 mb-4">
                    <div class="form-group mb-3 ">
                        <label for="exampleInputEmail1"><b>Project Name</b></label>
                        <input type="text" class="form-control font-weight-bold" name="project" value="{{$dtorder->project}}" id="exampleInputEmail1" placeholder="Project" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="required"><b>Contract Amount</b></label>
                        <input type="text" name="estimated_amount" id="estimated_amount" value="{{$dtorder->contract_amount}}" class="form-control" placeholder="Estimated Amount" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="required"><b>Principal</b></label>
                        <input type="text" name="principal" id="principal" value="{{$dtorder->principal}}" class="form-control" placeholder="Principal" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="required"><b>Progress Status</b></label>
                        <input type="text" name="status_project" id="Status" value="{{$dtorder->status_project}}" class="form-control" placeholder="Progress Status" readonly>
                    </div>                
                    <div class="form-group mb-3">
                        <label class="required"><b>Contract Amount</b></label>
                        <input type="text" name="contract_amount" id="contract" value="{{$dtorder->contract_amount}}" class="form-control" placeholder="Contract Amount" readonly>
                    </div>                
                </div>
                <div class="column col-md-4 col-12 mb-4">
                    <div class="form-group mb-3 ">
                        <label for="exampleInputEmail1"><b>Client Name</b></label>
                        <input type="text" class="form-control" name="institusi" value="{{$dtorder->institusi}}" id="exampleInputEmail1" placeholder="Institusi" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label for="ID_project"><b>Project Name</b></label>
                        <input type="text" class="form-control" id="ID_project" value="{{$dtorder->kode_project}}" name="kode_project" placeholder="Project ID" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="required"><b>PMO</b></label>
                        <input type="text" style="color: #435EBE" name="pmo" id="pmo" value="{{$dtorder->pmo}}" class="form-control" placeholder="PMO" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="required"><b>Prasales</b></label>
                        <input type="text" style="color: #435EBE" name="presales" id="presales" value="{{$dtorder->presales}}" class="form-control" placeholder="Presales" readonly>
                    </div>
                    <div class="form-group mb-3">
                        <label class="required"><b>AM/sales</b></label>
                        <input type="text" style="color: #435EBE" name="amsales" id="amsales" value="{{$dtorder->amsales}}" class="form-control" placeholder="Presales" readonly>
                    </div>
                </div>
                {{-- dari admin --}}
                @if ($dtorder->listadmin == null)
                    
                @else
                <div class="form-group col-sm-12 mb-4">
                    <label class="required"><b>Document Admin</b></label>
                    <br>
                    {{-- @foreach ($dtorder->listadmin->UploadDocuments as $i)
                        @foreach (explode("," , $i->UploadDocument) as $a) 
                            <a href="/storage/{{$i->id}}/{{$dtorder->listadmin->UploadDocument}}">{{  $dtorder->listadmin->UploadDocument }}<br></a>
                        @endforeach 
                  @endforeach --}}
                    @foreach ($dtorder->listadmin->UploadDocuments as $i)
                        @foreach (explode("," , $i->file_name) as $a) 
                            <a href="/storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                        @endforeach 
                    @endforeach 
                </div>
                @endif
                {{-- dkomene piplane --}}
                @if ($dtorder->listpipe == null)
                @else
                <div class="form-group col-sm-12 mb-4">
                    <label class="required"><b>Document Admin</b></label>
                    <br>
                    {{-- @foreach ($item->UploadDocuments as $i)
                      @foreach (explode("," , $i->file_name) as $a) 
                    <a href="/storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                    @endforeach 
                  @endforeach --}}
                    @foreach ($dtorder->listpipe->UploadDocuments as $i)
                        @foreach (explode("," , $i->file_name) as $a) 
                        <a href="/storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                        @endforeach 
                    @endforeach
                    {{-- @foreach ($dtorder->listpipe->UploadDocuments as $i)
                        @foreach (explode("," , $i->UploadDocument) as $a) 
                            <a href="/storage/{{$i->id}}/{{$dtorder->listpipe->UploadDocument}}">{{  $dtorder->listpipe->UploadDocument }}<br></a>
                        @endforeach 
                    @endforeach --}}
                </div>
                @endif
                <div class="row">
                    <div class="mr-2 col">
                        <label for="" class=""><b>Distributor Price Offers</b></label>
                        <a href="/DocumentLTO/{{$dtorder->file_PHD}}" class="form-control">{{$dtorder->file_PHD}}</a>
                    </div>
                    <div class="mr-2 col">
                        <label for="" class=""><b>SPK/PO/SPBBJ Client</b></label>
                        <a href="/DocumentLTO/{{$dtorder->file_SPSC}}" class="form-control">{{$dtorder->file_SPSC}}</a>
                    </div>
                    <div class="mr-2 col">
                        <label for="" class=""><b>Sales Offer</b></label>
                        <a href="/DocumentLTO/{{$dtorder->file_PS}}" class="form-control">{{$dtorder->file_PS}}</a>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="mr-2 col">
                        <label for="" class="text-danger"><b>Note from Distributor Price Offers</b></label>
                        <textarea name="note_for_file1" id="" class="form-control" readonly>{{$dtorder->note_for_file1}}</textarea>
                    </div>
                    <div class="mr-2 col">
                        <label for="" class="text-danger"><b>Note from SPK/PO/SPBBJ Client</b></label>
                        <textarea name="note_for_file2" id="" class="form-control" readonly>{{$dtorder->note_for_file2}}</textarea>
                    </div>
                    <div class="mr-2 col">
                        <label for="" class="text-danger"><b>Note from Sales Offer</b></label>
                        <textarea name="note_for_file3" id="" class="form-control" readonly>{{$dtorder->note_for_file3}}</textarea>
                    </div>
                </div>
                @if ($dtorder->bast == null)
                @else
                <div class="form-group col-sm-12 mb-4">
                    <label class="required"><b>Document BAST</b></label>
                    <br>
                    @foreach ($dtorder->bast as $i)
                        @foreach (explode("," , $i->bast_dokumen) as $a) 
                            <a href="/bast_dokumen/{{$i->bast_dokumen}}">{{  $i->bast_dokumen }}<br></a>
                        @endforeach 
                  @endforeach
                </div>
                @endif
                <div class="form-group col-sm-12 {{ $dtorder->note == null ? 'd-none' : 'd-block'   }} ">
                    <label class="required"><b>Note</b></label>
                    <textarea class="form-control" readonly name="" id="" cols="30" rows="10" style="height: 200px; font-size:13px;">{{$dtorder->note }}</textarea>
                </div>
            </div>
            <div class="mt-3 d-none">
                <h3>Cost Amount</h3>
                @foreach ($dtorder->amdetail as $item)
                    <div>
                        <div class="col-lg-10">
                            <div class="row mb-2">
                                <div class="col-md-4 mr-2">
                                    <input type="text" class="form-control" name="title[]" value="{{ $item->title }}" readonly>
                                </div>
                                <div class="col-md-4 mr-2">
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
                        <div class="col-lg-12 mb-3">
                            <div class="row">
                                <div class="col-md-3 mr-2">
                                    <label for="" class="">Nama Product</label>
                                    <input type="text" class="form-control" name="product_name[]" value="{{ $it->product_name }}" readonly>
                                </div>
                                <div class="col-md-3 mr-2">
                                    <label for="" class="">Quantity</label>
                                    <input type="text" class="form-control" name="product_quantity[]" value="{{ $it->product_quantity }}" readonly>
                                </div>
                                <div class="col-md-3 mr-2">
                                    <label for="" class="">Harga</label>
                                    <input type="text" class="form-control" name="harga_product[]" value="{{ $it->harga_product }}" readonly>
                                </div>
                                <div class="col-md-3 mr-2">
                                    <label for="" class="">Total</label>
                                    <input type="text" class="form-control" name="total[]" value="{{ $it->total }}" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if (Auth::user()->hasRole('Management') || Auth::user()->hasRole('Super Admin'))
            <div class="form-group row mt-5" onchange="">
                <h4 class="ml-3">Status</h4>
              <div class="col-sm-12">
                @if ($dtorder->status == 'Approve' )
                <div class="alert alert-success col-sm-4" role="alert">
                  {{$dtorder->status}}
                </div>
                @else
                <div class="alert alert-danger col-sm-4" role="alert">
                  {{$dtorder->status}}
                </div>
                @endif
                <select class="form-control select2" style="width: 100%;" name="status" id="status" autofocus onchange="myFunction()">
                  <option></option>
                  <option value="Approve">Approve</option>
                  <option value="Reject">Reject</option>
                </select>
              </div>
            </div>
            @endif
                

            <div id="tes" class="tes form-group " >                  
              <label class="font-weight-bold">Note</label>
              <input type="text" name="note" class="form-control" value="">
            </div>
                
            <div class="d-flex justify-content-between mt-5">
                <a href="/inputTwo" class="btn btn-secondary ">Back</a>
                <button class="btn btn-success d-flex">Submit</button>
            </div>
        </form>
    </div>
</section>
@endsection
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<script>
    function myFunction() {
        console.log("hello");   
    
      let x = document.getElementById("status").value;
      if (x == 'Reject') {
        // jika reject munculkam note
        console.log(x);
        var bukaNote = document.querySelector('.tes');
        bukaNote.classList.add('d-block')          
      }
      // jika approve -> note hilangkan
      if (x == 'Approve') {
        var bukaNote = document.querySelector('.tes');
          bukaNote.classList.add('d-block')
        }
      // document.getElementById("demo").innerHTML = "You selected: " + x;
    }
    </script>