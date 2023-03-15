@extends('layouts.main')
@section('content')
  <section class="section">
    <div class="section-header">
      <h1>List Sales Pipeline</h1>
    </div> 
    <div class="card">
      <div class="card-body ">
        <div class="d-flex justify-content-between">
          <div class="d-flex mb-4">
            <button type="button" class="btn text-black ml-2" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable" style="background-color: #FFDDA9">Filter Data</button>
          </div>
          <div class="d-flex mb-4">
            <button class="btn text-white ml-2 btn-md" style="background-color: #32735F" onclick="tableToExcel('pipeline')">Export Excel</button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-hover table-bordered">
            <thead>
              <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th colspan="2" class="text-center">Product / Solution</th>
                {{-- <th colspan="4" class="text-center">PIC</th> --}}
                <th colspan="4" class="text-center">Timeline</th>
                <th></th>
                <th colspan="2" class="text-center">Project Amount (IDR)</th>
                {{-- <th></th> --}}
                <th></th>
              </tr>
              <tr>
                <th>No</th>
                <th>Client Name</th>
                <th>Project Name</th>
                <th>AM</th>
                <th>PMO</th>
                <th colspan="2">Engineer & Presales</th>
                <th>Principal</th>
                <th>Distributor</th>
                {{-- <th>Presales</th> --}}
                {{-- <th>PMO</th> --}}
                <th>SBU</th>
                <th>Q1</th>
                <th>Q2</th>
                <th>Q3</th>
                <th>Q4</th>
                <th>Status Progress</th>
                {{-- <th>Estimated Amount</th> --}}
                <th>Estimated Amount</th>
                <th>Confidence Level</th>
                {{-- <th>Contract Amount</th> --}}
                {{-- <th>PM</th> --}}
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              {{-- @if (Auth::user()->hasRole('AM/Sales') || Auth::user()->hasRole('Super Admin'))
              @endif --}}
              @foreach ($sales as $opty)
              <tr> 
                <td>{{ $loop->iteration }}</td>
                <td>{{ $opty->NamaClient }}</td>
                <td>{{ $opty->NamaProject }}</td>
                <td class="text-primary">{{ $opty->name_user}}</td>
                <td>{{ $opty->pmo }}</td>
                {{-- <td>{{ $opty->presales }}</td> --}}
                <td colspan="2">
                  @foreach ($opty->userTechnikalsPipe as $item)
                      {{ $item->userTechnikal->name ?? null}}
                  @endforeach
                </td>
                <td>{{ $opty->elearning_id}}</td>
                <td>{{ $opty->distributor}}</td>
                {{-- <td>{{ $opty->presales}}</td> --}}
                {{-- <td>{{ $opty->pmo}}</td> --}}
                <td>{{ $opty->sbu}}</td>
                <td>  
                    @if ($opty->Timeline == 'Q1')
                        {{ number_format($opty->estimated_amount) }}
                    @endif
                </td>
                <td>
                    @if ($opty->Timeline == 'Q2')
                        {{ number_format($opty->estimated_amount) }}
                    @endif
                </td>
                <td>
                    @if ($opty->Timeline == 'Q3')
                        {{ number_format($opty->estimated_amount) }}
                    @endif
                </td>
                <td>
                    @if ($opty->Timeline == 'Q4')
                        {{ number_format($opty->estimated_amount) }}
                    @endif
                </td>
                @if ($opty->Status == 'PO/Contract')
                  <td class="text-success">{{ $opty->Status }}</td>
                @else
                  <td class="text-info">{{ $opty->Status }}</td>
                @endif
                <td>{{ number_format($opty->estimated_amount) }}</td>
                <td>{{ $opty->confidence_level}}</td>
                {{-- <td>{{ $opty->contract_amount}}</td> --}}
                {{-- @if ($opty->pmLead == null) --}}
                {{-- <td></td> --}}
                {{-- @else                     --}}
                {{-- <td>{{ $opty->pmLead->name }}</td> --}}
                {{-- @endif --}}
                
                {{-- @if ($jumlah == 0)
                @else
                  @foreach ($detailss as $item)
                      @if ($opty->id == $item->projectSalesOpties->id )
                      <td>{{$item->userTechnikal->name}}</td>
                      @endif
                  @endforeach
                @endif  --}}
                <td class="text-center">
                  <div class="btn-group dropstart mb-1" style="cursor: pointer;">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </div>
                    <div class="dropdown-menu text-center">
                      {{-- {{$opty->detailss}} --}}
                      <a href="{{url ("/adminShowSales", $opty->id)}}" class="btn text-white btn-sm" style="background-color: #0EC8F8">Detail</a>
                      {{-- @if ($detailss) --}}
                            @if ($opty->UploadDocument == null)
                                
                            @else
                            <a href="{{url ("adminprojectSalesEdits", $opty->id)}}" class="btn text-white btn-sm btn-danger">Edit</a>
                            @endif
                          
                      {{-- @else --}}
                      {{-- @endif --}}

                    </div>
                  </div>
                </td>
                </div>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $sales->links() }}
        </div>
      </div> 
    </div>
  </section>

  {{-- Table Hidden  --}}
  <table id="pipeline" class="table table-hover table-responsive d-none">
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
        {{-- <th>PM</th> --}}
        <th  colspan="3" class="text-center">Technical</th>
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
        {{-- <th>Contract Amount</th> --}}
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
      @foreach ($sales as $opty)
      <tr> 
        <td>{{ $loop->iteration }}</td>
        <td>{{ $opty->NamaClient }}</td>
        <td>{{ $opty->NamaProject }}</td>
        <td>{{ $opty->elearning_id}}</td>
        <td>{{ $opty->distributor}}</td>
        <td>{{ $opty->name_user}}</td>
        <td>{{ $opty->presales}}</td>
        <td>{{ $opty->pmo}}</td>
        <td>{{ $opty->sbu}}</td>
        <td>
            @if ($opty->Timeline == 'Q1')
                {{ number_format($opty->Angka) }}
            @endif
        </td>
        <td>
            @if ($opty->Timeline == 'Q2')
                {{ number_format($opty->Angka) }}
            @endif
        </td>
        <td>
            @if ($opty->Timeline == 'Q3')
                {{ number_format($opty->Angka) }}
            @endif
        </td>
        <td>
            @if ($opty->Timeline == 'Q4')
                {{ number_format($opty->Angka) }}
            @endif
        </td>
        <td>{{ $opty->Status }}</td>
        <td>{{ number_format($opty->estimated_amount) }}</td>
        <td>{{ $opty->confidence_level}}</td>
        {{-- <td>{{ $opty->contract_amount}}</td> --}}
        {{-- @if ($opty->pmLead == null)
        <td></td>
        @else                    
        <td>{{ $opty->pmLead->name }}</td>
        @endif --}}
      
      @endforeach
    </tbody>
  </table>

  <!-- Modal -->
  <div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Filter Data Table</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/adminproject/sales" method="GET">
          <div class="modal-body">
            <label for="dari">From</label>
            <input type="date" class="form-control" id="dari" name="dari_tgl">
            <label for="sampai" class="mt-2">To</label>
            <input type="date" class="form-control" id="sampai" name="sampai_tgl">
            <label for="sampai" class="mt-2">Status</label>
            <select class="form-control" name="Status">
              <option value=""></option>
              @foreach ($prostat as $item)
              <option value="{{ $item->title }}">{{ $item->title }}</option>
              @endforeach
            </select>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
            <button type="submit" class="btn text-white" style="background-color: #5252FF">Cari</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="../assets/js/export_exel.js"></script>
@endsection
