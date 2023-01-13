@extends('layouts.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <h4>Detail Page</h4>
        </div>
        <div class="card" id="mycard-dimiss" style="border-radius: 2em">
            <div class="card-body">
    
                <div class="mb-3 row">
                    <label for="inputinstitusi" class="col-sm-3 col-form-label">No Sales Order</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $p->no_sales }}" readonly>
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label for="inputinstitusi" class="col-sm-3 col-form-label">Tanggal Sales</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $p->tgl_sales }}" readonly>
                    </div>
                </div>
    
                <div class="mb-3 row">
                    <label for="inputinstitusi" class="col-sm-3 col-form-label">Kode Project</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $p->kode_project }}" readonly>
                    </div>
                </div>
    
                <div class="mb-2 row">
                    <label for="inputproject" class="col-sm-3 col-form-label">Nama Sales</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $p->nama_sales }}" readonly>
                    </div>
                </div>
                
                <div class="mb-2 row">
                    <label for="inputproject" class="col-sm-3 col-form-label">Nama Client</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $p->nama_institusi }}" readonly>
                    </div>
                </div>
                
                <div class="mb-2 row">
                    <label for="inputproject" class="col-sm-3 col-form-label">Nama Project</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $p->nama_project }}" readonly>
                    </div>
                </div>
    
                <div class="mb-2 row">
                    <label for="inputproject" class="col-sm-3 col-form-label">Nama PM</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $p->nama_pm }}" readonly>
                    </div>
                </div>
                
                <div class="mb-2 row">
                    <label for="inputproject" class="col-sm-3 col-form-label">Jenis Pekerjaan</label>
                    <div class="col-sm-9">
                        <div style="background-color: #e9ecef;border-radius: 0.25rem;color: #495057;width: 100%;font-size: 14px;padding: 10px 15px;height: 42px;">
                            @foreach ($pp as $t)
                                @if ($p->id == $t->list_id) 
                                    @if (Auth::user()->name == $t->nama_technical) 
                                    {{$t->jenis_pekerjaan}},
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
    
                <div class="mb-2 row">
                    <label for="inputproject" class="col-sm-3 col-form-label">Estimated Amount</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{ $p->hps }}" readonly>
                    </div>
                </div>
    
            </div>
    
            <div class="card-footer text-right">
                <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-primary" href="/viewtime">Back</a>
            </div>
    
        </div>
    </section>
@endsection
