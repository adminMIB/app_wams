@extends('layouts.main')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <section class="section">
    <div class="section-header">
        <h1>Detail Sales Pipelanes</h1>
    </div>
    <form action="{{route('/adminShowSalesUpdate', $detail->id)}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="card">
            <input type="text" class="form-control d-none" name="ID_project" value="{{$nomer}}" readonly>
            <input type="hidden" class="form-control" name="salesopty_id" value="{{$detail->id}}" readonly>
            {{-- arr2 --}}
            <input type="text" class="@error('ID_project') is-invalid @enderror form-control d-none " name="arr2" placeholder="ID_project" id="inputID_project" value="{{$nomer}}" readonly>
            {{-- end arr2 --}}
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
                        <label for="inputTimeline" class="col-sm-3 col-form-label">Timeline</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$detail->Timeline}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label class="col-sm-3 col-form-label">Date</label>
                        <div class="col-sm-9">
                        <input type="date" class="form-control" value="{{$detail->Date}}" readonly>
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label for="inputAngka" class="col-sm-3 col-form-label">Estimated Amount</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$detail->estimated_amount}}" readonly >
                        </div>
                    </div>
    
                    <div class="mb-2 row">
                        <label for="inputAngka" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$detail->Status}}" readonly >
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <label for="inputAngka" class="col-sm-3 col-form-label">PMO</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$detail->pmo}}" readonly >
                        </div>
                    </div>

                    <div class="mb-2 row">
                        <label for="inputAngka" class="col-sm-3 col-form-label">Presales</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$detail->presales}}" readonly >
                        </div>
                    </div>
    
                    <div class="mb-3 row">
                        <label for="" class="col-sm-3 col-form-label">Note</label>
                        <div class="col-sm-9">
                        <textarea class="form-control" name="Note"  readonly>{{$detail->Note}} </textarea>
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

                    

                    {{-- @if ($jumlah == 0)
                    <div class="mb-2 row d-none">
                        <label for="inputAngka" class="col-sm-3 col-form-label"></label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" value="" readonly >
                        </div>
                    </div>
                    @else
                    <div class="mb-2 row d-">
                        <label for="inputAngka" class="col-sm-3 col-form-label">PM</label>
                        <div class="col-sm-9">
                        <input type="text" class="form-control" value="{{$detail->pmLead->name}}" readonly >
                        </div>
                    </div>
                    @endif --}}
                    
                    @if ($jumlah == 0)    
                    <div class="mb-2 row d-none">
                    </div>
                    @else
                    <div class="mb-2 row">
                        <label for="inputAngka" class="col-sm-3 col-form-label">Technical</label>
                        @foreach ($detailss as $item)  
                            <div class="col-sm-3">
                                <input type="text" class="form-control" value="{{$item->userTechnikal->name}}" readonly >
                            </div>
                        @endforeach
                    </div>
                    @endif
                    <div class="form-group mt-3">
                        <label>Download Document</label>
                        <div>
                            {{-- @foreach (explode(",", $detailId->UploadDocument) as $file)
                            <a href="/tmp/uploads/{{$file}}">{{$file}}<br></a>
                            @endforeach --}}
                            @foreach ($detail->UploadDocuments as $i)
                            @foreach (explode("," , $i->file_name) as $a) 
                            <a href="/storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                            @endforeach
                            @endforeach
                        </div>
                    </div>
                    <div style="d-flex  justify-content-bettwen  ">
                        <a href="/umViewPiplane" class="btn btn-secondary btn-md mt-4  mr-3">Back</a>
                    </div>
            </div>
         </div>
    </form>     
    
    {{--  --}}
    <table id="pipeline" class="table d-none table-hover table-responsive">
        <thead>
          <tr>
            <th>No</th>
            <th>Client Name</th>
            <th>Project Name</th>
            <th colspan="2" class="text-center">Product / Solution</th>
            <th colspan="4" class="text-center">PIC</th>
            <th colspan="4" class="text-center">Timeline</th>
            <th>Status Progress</th>
            <th colspan="3" class="text-center">Project Amount (IDR)</th>
            <th>PM</th>
            <th  colspan="5" class="text-center">Technical</th>
          </tr>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th>Principal</th>
            <th>Distributor</th>
            <th>AM</th>
            <th>Presales</th>
            <th>PMO</th>
            <th>SBU</th>
            <th>Q1</th>
            <th>Q2</th>
            <th>Q3</th>
            <th>Q4</th>
            <th></th>
            <th>Estimated Amount</th>
            <th>Confidence Level</th>
            <th>Contract Amount</th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          {{-- @if (Auth::user()->hasRole('AM/Sales') || Auth::user()->hasRole('Super Admin'))
          @endif --}}
         
          <tr> 
            <td>1</td>
            <td>{{ $detail->NamaClient }}</td>
            <td>{{ $detail->NamaProject }}</td>
            <td>{{ $detail->elearning_id}}</td>
            <td>{{ $detail->distributor}}</td>
            <td>{{ $detail->name_user}}</td>
            <td>{{ $detail->presales}}</td>
            <td>{{ $detail->pmo}}</td>
            <td>{{ $detail->sbu}}</td>
            <td>
                @if ($detail->Timeline == 'Q1')
                    {{ $detail->Angka }}
                @endif
            </td>
            <td>
                @if ($detail->Timeline == 'Q2')
                    {{ $detail->Angka }}
                @endif
            </td>
            <td>
                @if ($detail->Timeline == 'Q3')
                    {{ $detail->Angka }}
                @endif
            </td>
            <td>
                @if ($detail->Timeline == 'Q4')
                    {{ $detail->Angka }}
                @endif
            </td>
            <td>{{ $detail->Status }}</td>
            <td>{{ $detail->estimated_amount}}</td>
            <td>{{ $detail->confidence_level}}</td>
            <td>{{ $detail->contract_amount}}</td>
            @if ($detail->pmLead == null)
            <td></td>
            @else                    
            <td>{{ $detail->pmLead->name }}</td>
            @endif
            @foreach ($detailss as $item)
                @if ($detail->id == $item->projectSalesOpties->id )
                <td>{{$item->userTechnikal->name}}</td>
                @endif
            @endforeach
            <td></td>
            <td></td>
            <td></td>
            
            </div>
          </tr>
        </tbody>
      </table>


    </section>
    {{-- <script src="../assets/js/export_exel.js"></script> --}}
    @endsection
  