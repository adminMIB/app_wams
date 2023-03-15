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
                <input type="hidden" class="form-control" name="file_project" value="{{ $pa->UploadDocument }}" id="file_project" readonly>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Kode Project</label>
                        <input type="text" class="form-control" name="no_so"  value="{{$pa->ID_project}}" id="exampleInputEmail1" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Client</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datetimepicker-input" name="tgl_so"  value="{{$pa->NamaClient}}" id="Date" placeholder="TGL Sales Order" data-target="#reservationdate"readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Nama Project</b></label>
                        <input type="text" name="distributor" id="distributor" class="form-control"  value="{{$pa->NamaProject}}" placeholder="Distributor" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Tanggal</b></label>
                        <input type="text" name="sbu" id="sbu" class="form-control"  value="{{$pa->Date}}" placeholder="SBU" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Estimated Amount</b></label>
                        <input type="text" name="confidence_level" id="confidence_level" value="{{$pa->Angka}}" class="form-control" placeholder="Presales"readonly>
                    </div>
                </div>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Distributor</label>
                        <input type="text" class="form-control" name="project" value="{{$pa->distributor}}" id="exampleInputEmail1" placeholder="Project" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Principal</b></label>
                        <input type="text" name="estimated_amount" id="estimated_amount" value="{{$pa->principal}}" class="form-control" placeholder="Estimated Amount" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Progress Status</b></label>
                        <input type="text" name="principal" id="principal" value="{{$pa->Status}}" class="form-control" placeholder="Principal" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Note</b></label>
                        <input type="text" name="status_project" id="Status" value="{{$pa->note}}" class="form-control" readonly>
                    </div>                              
                </div>
            </div>
            <div>
                <a href="{{ url('list_project') }}" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>

</section>
@endsection