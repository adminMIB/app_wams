@extends('layouts.main')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header"><h2>Transaction Maker</h2></div>
            <div class="card-body">
                <form action="{{ route('store-TMRevCost') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $item->id }}" name="sldawl_id">
                    <div class="row mb-1">
                        <label for="" class="col-md-3">Choose Type</label>
                        <div class="col-md-9">
                            <select id="choice" class="form-select">
                                <option value="" selected disabled>----> Pilih <----</option>
                                <option value="Acceptance">Acceptance</option>
                                <option value="Expenses">Expenses</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="" class="col-md-3">Project ID</label>
                        <div class="col-md-9">
                            <input type="text" name="project_id" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="" class="col-md-3">Project Name</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_project" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="" class="col-md-3">Client Name</label>
                        <div class="col-md-9">
                            <input type="text" name="nama_client" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="" class="col-md-3">PIC Sales</label>
                        <div class="col-md-9">
                            <input type="text" name="pic_sales" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="" class="col-md-3">PIC Business Channel</label>
                        <div class="col-md-9">
                            <input type="text" name="pic_business_channel" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="d-none" id="penerimaan">
                        <div class="row mb-1">
                            <label for="" class="col-md-3">Project Acceptance</label>
                            <div class="col-md-9">
                                <input type="number" name="penerimaan_project" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="" class="col-md-3">Project Acceptance Date</label>
                            <div class="col-md-9">
                                <input type="date" name="tanggal_penerimaan" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="d-none" id="pengeluaran">
                        <div class="row mb-1">
                            <label for="" class="col-md-3">Project Expenses</label>
                            <div class="col-md-9">
                                <input type="number" name="pengeluaran_project" class="form-control" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-1">
                            <label for="" class="col-md-3">Expenses Date</label>
                            <div class="col-md-9">
                                <input type="date" name="tanggal_pengeluaran" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="" class="col-md-3">Information</label>
                        <div class="col-md-9">
                            <input type="text" name="keterangan" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('index-saldo') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script>
    $(function () {
        'use strict';

        // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        // var form = $("#revenuecost");

        $("#choice").on('change', function (e) {
            if (this.value === 'Acceptance') {
                $('#penerimaan').removeClass('d-none').addClass('show');
                $('#pengeluaran').removeClass('show').addClass('d-none');

                // form.find('input, select, textarea').not("#choice").val('');
            } else {
                $('#pengeluaran').removeClass('d-none').addClass('show');
                $('#penerimaan').removeClass('show').addClass('d-none');

                // form.find('input, select, textarea').not("#choice").val('');
            }
        });

    })
</script>
@endsection
