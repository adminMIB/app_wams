@extends('layouts.main')
@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
@endsection
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h6>Filter Report CMM</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Tanggal</label>
                        </div>
                        <div class="col-sm-9">
                            <div id="date-range" class="form-control">
                                <i class="fa fa-calendar"></i>;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-3">
                            <label for="">Jenis Kolateral</label>
                        </div>
                        <div class="col-sm-9">
                            <select name="client" id="jenis" class="form-control select2" style="width: 100%">
                                <option value="">------All------</option>
                                <option value="Aset Fisik"></option>
                                <option value="Deposito"></option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="padding-top: 40px;">
                        <button class="btn btn-success" id="export">Export  <i class="fa fa-file-excel"></i></button>
                    </div>
                </div>
            </div>
        </div> 
    </section>
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('js/report/cmm.js') }}"></script>

@endsection