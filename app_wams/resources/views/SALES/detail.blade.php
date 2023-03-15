@extends('layouts.main')
@section('content')
    <section class="section">
    <div class="section-header">
        <h1>Detail Pipeline</h1>
     </div> 
       <div class="card">
        <div class="card-body">
                <div class="mb-3 row">
                    <label for="inputNamaClient" class="col-sm-3 col-form-label">Client Name</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{$detail->NamaClient}}" readonly>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputNamaProject" class="col-sm-3 col-form-label">Project Name</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{$detail->NamaProject}}" readonly>
                    </div>
                </div>
        
                <div class="mb-2 row">
                    <label for="inputProduk/Solusi" class="col-sm-3 col-form-label">Principal</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{$detail->elearning_id}}" readonly>
                    </div>
                </div>
                
                <div class="mb-2 row">
                    <label for="inputProduk/Solusi" class="col-sm-3 col-form-label">Distributor</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{$detail->elearning_id}}" readonly>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label class="col-sm-3 col-form-label">Date</label>
                    <div class="col-sm-9">
                    <input type="date" class="form-control" value="{{$detail->Date}}" readonly>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputTimeline" class="col-sm-3 col-form-label">Timeline</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{$detail->Timeline}}" readonly>
                    </div>
                </div>
                
                <div class="mb-2 row">
                    <label class="col-sm-3 col-form-label">Estimated Amount</label>
                    <div class="col-sm-9">
                    <input type="date" class="form-control" value="{{$detail->estimated_amount}}" readonly>
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputAngka" class="col-sm-3 col-form-label">Progress Status</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{$detail->Status}}" readonly >
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputAngka" class="col-sm-3 col-form-label">Confidence Level</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{$detail->confidence_level}}" readonly >
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputAngka" class="col-sm-3 col-form-label">Contract Amount</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{$detail->contract_amount}}" readonly >
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputAngka" class="col-sm-3 col-form-label">Presales</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{$detail->presales}}" readonly >
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputAngka" class="col-sm-3 col-form-label">PMO</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{$detail->pmo}}" readonly >
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputAngka" class="col-sm-3 col-form-label">SBU</label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" value="{{$detail->sbu}}" readonly >
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="" class="col-sm-3 col-form-label">Note</label>
                    <div class="col-sm-9">
                    <textarea class="form-control" name="Note"  readonly>{{$detail->Note}} </textarea>
                    </div>
                </div>
                <a href="/index-sales" class="btn btn-secondary">Back</a>
        </div>
       </div>

      
    
    </section>
@endsection