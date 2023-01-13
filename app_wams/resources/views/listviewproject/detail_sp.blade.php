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
                <input type="hidden" class="form-control" name="file_project" value="{{ $sp->UploadDocument }}" id="file_project" readonly>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">No Sales Pipeline</label>
                        <input type="text" class="form-control" name="no_so"  value="{{$sp->no_opty}}" id="exampleInputEmail1" readonly>
                    </div>
                    <div class="form-group">
                        <label>Kode Project</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datetimepicker-input" name="tgl_so"  value="{{$sp->ID_project}}" id="Date" placeholder="TGL Sales Order" data-target="#reservationdate"readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Nama Client</b></label>
                        <input type="text" name="distributor" id="distributor" class="form-control"  value="{{$sp->NamaClient}}" placeholder="Distributor" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Nama Project</b></label>
                        <input type="text" name="sbu" id="sbu" class="form-control"  value="{{$sp->NamaProject}}" placeholder="SBU" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Timeline</b></label>
                        <input type="text" name="confidence_level" id="confidence_level" value="{{$sp->Timeline}}" class="form-control" placeholder="Presales"readonly>
                    </div>
                </div>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Date</label>
                        <input type="text" class="form-control" name="project" value="{{$sp->Date}}" id="exampleInputEmail1" placeholder="Project" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Status</b></label>
                        <input type="text" name="estimated_amount" id="estimated_amount" value="{{$sp->Status}}" class="form-control" placeholder="Estimated Amount" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Distributor</b></label>
                        <input type="text" name="principal" id="principal" value="{{$sp->Distributor}}" class="form-control" placeholder="Principal" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>PMO</b></label>
                        <input type="text" name="status_project" id="Status" value="{{$sp->pmo}}" class="form-control" placeholder="Progress Status" readonly>
                    </div>                
                    <div class="form-group">
                        <label class="required"><b>SBU</b></label>
                        <input type="text" name="contract_amount" id="contract" value="{{$sp->sbu}}" class="form-control" placeholder="Contract Amount" readonly>
                    </div>                
                </div>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Presales</label>
                        <input type="text" class="form-control" name="institusi" value="{{$sp->presales}}" id="exampleInputEmail1" placeholder="Institusi" readonly>
                    </div>
                    <div class="form-group">
                        <label for="ID_project">Estimated Amount</label>
                        <input type="text" class="form-control" id="ID_project" value="{{$sp->estimated_amount}}" name="kode_project" placeholder="Project ID" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Confidence Level</b></label>
                        <input type="text" name="pmo" id="pmo" value="{{$sp->confidence_level}}" class="form-control" placeholder="PMO" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Contract Amount </b></label>
                        <input type="text" name="presales" id="presales" value="{{$sp->contract_amount}}" class="form-control" placeholder="Presales" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Note</b></label>
                        <input type="text" name="amsales" id="amsales" value="{{$sp->Note}}" class="form-control"  readonly>
                    </div>
                </div>
            </div>
            <div>
                <a href="{{ url('list_sp') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>

</section>
@endsection