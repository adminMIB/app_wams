@extends('layouts.main')

@section('title','Detail Projects')
@section('content')
<section class="section">
    <div class="d-flex justify-content-between mb-1">
        <h3>{{$shorder->institusi}}</h3>
        <a href="{{ route('Penagihan-Penjualan') }}" class="btn btn-secondary">Back</a>
    </div>
    <div class="">
        <div class="card p-3">
            <div class="row">
                <input type="hidden" class="form-control" name="file_project" value="{{ $shorder->file_project }}" id="file_project" readonly>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">No LTO</label>
                        <input type="text" class="form-control" name="no_so"  value="{{$shorder->no_so}}" id="exampleInputEmail1" readonly>
                    </div>
                    <div class="form-group">
                        <label>Date LTO</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datetimepicker-input" name="tgl_so"  value="{{ date('d-m-Y', strtotime($shorder->tgl_so)) }}" id="Date" placeholder="TGL LTO" data-target="#reservationdate"readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Distributor</b></label>
                        <input type="text" name="distributor" id="distributor" class="form-control"  value="{{$shorder->distributor}}" placeholder="Distributor" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>SBU</b></label>
                        <input type="text" name="sbu" id="sbu" class="form-control"  value="{{$shorder->sbu}}" placeholder="SBU" readonly>
                    </div>
                </div>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Project Name</label>
                        <input type="text" class="form-control" name="project" value="{{$shorder->project}}" id="exampleInputEmail1" placeholder="Project" readonly>
                    </div>
                    <div class="form-group">
                        {{-- <label class="required"><b>Estimated Amount</b></label> --}}
                        <input type="hidden" name="estimated_amount" id="estimated_amount" value="{{$shorder->estimated_amount}}" class="form-control" placeholder="Estimated Amount" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Principal</b></label>
                        <input type="text" name="principal" id="principal" value="{{$shorder->principal}}" class="form-control" placeholder="Principal" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Progress Status</b></label>
                        <input type="text" name="status_project" id="Status" value="{{$shorder->status_project}}" class="form-control" placeholder="Progress Status" readonly>
                    </div>                
                    <div class="form-group">
                        <label class="required"><b>Confidence Level</b></label>
                        <input type="text" name="confidence_level" id="confidence_level" value="{{$shorder->confidence_level}}" class="form-control" placeholder="Presales"readonly>
                    </div>
                        <input type="hidden" name="contract_amount" id="contract" value="{{$shorder->contract_amount}}" class="form-control" placeholder="Contract Amount" readonly>               
                </div>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Client Name</label>
                        <input type="text" class="form-control" name="institusi" value="{{$shorder->institusi}}" id="exampleInputEmail1" placeholder="Institusi" readonly>
                    </div>
                    <div class="form-group">
                        <label for="ID_project">Project Code</label>
                        <input type="text" class="form-control" id="ID_project" value="{{$shorder->kode_project}}" name="kode_project" placeholder="Project ID" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>PMO</b></label>
                        <input type="text" name="pmo" id="pmo" value="{{$shorder->pmo}}" class="form-control" placeholder="PMO" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Prasales</b></label>
                        <input type="text" name="presales" id="presales" value="{{$shorder->presales}}" class="form-control" placeholder="Presales" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>AM/Sales</b></label>
                        <input type="text" name="amsales" id="amsales" value="{{$shorder->amsales}}" class="form-control" placeholder="Presales" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mr-2 col">
                    <label for="" class=""><b>Distributor Price Offers</b></label>
                    <a href="/DocumentLTO/{{$shorder->file_PHD}}" class="form-control">{{$shorder->file_PHD}}</a>
                </div>
                <div class="mr-2 col">
                    <label for="" class=""><b>SPK/PO/SPBBJ Client</b></label>
                    <a href="/DocumentLTO/{{$shorder->file_SPSC}}" class="form-control">{{$shorder->file_SPSC}}</a>
                </div>
                <div class="mr-2 col">
                    <label for="" class=""><b>Sales Offer</b></label>
                    <a href="/DocumentLTO/{{$shorder->file_PS}}" class="form-control">{{$shorder->file_PS}}</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection