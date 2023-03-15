@extends('layouts.main')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>List Sales Pipeline</h1>
  </div>
  <div class="card">
    <div class="card-body ">
      <div class="d-flex justify-content-between">
        <div class="d-flex">
          <a href="{{route('inputsales')}}"><button type="submit" class="btn btn-primary" style="margin-bottom:1%;">Create</button></a>
          <button type="button" class="btn btn-warning ml-2" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Filter Data</button>
        </div>
        <div class="d-flex">
          {{-- <button class="btn btn-warning" onclick="demoFromHTML()">Cetak</button> --}}
          <button class="btn btn-success ml-2" onclick="tableToExcel('pipeline')">Export</button>
        </div>
      </div>
      <hr>
      <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <th></th>
              <th></th>
              <th></th>
              <th colspan="2" class="text-center">Product / Solution</th>
              <th colspan="4" class="text-center">PIC</th>
              <th colspan="4" class="text-center">Timeline</th>
              <th></th>
              <th colspan="3" class="text-center">Project Amount (IDR)</th>
              <th></th>
            </tr>
            <tr>
              <th>No</th>
              <th>Client Name</th>
              <th>Project Name</th>
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
              <th>Status Progress</th>
              <th>Estimated Amount</th>
              <th>Confidence Level</th>
              <th>Contract Amount</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            {{-- @if (Auth::user()->hasRole('AM/Sales') || Auth::user()->hasRole('Super Admin'))
            @endif --}}
            @foreach ($sales as $opty)
            @if (Auth::user()->name == "Dian Octavia")
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
                      Rp. {{ number_format($opty->estimated_amount) }}
                  @endif
              </td>
              <td>
                  @if ($opty->Timeline == 'Q2')
                      Rp. {{ number_format($opty->estimated_amount) }}
                  @endif
              </td>
              <td>
                  @if ($opty->Timeline == 'Q3')
                      Rp. {{ number_format($opty->estimated_amount) }}
                  @endif
              </td>
              <td>
                  @if ($opty->Timeline == 'Q4')
                      Rp. {{ number_format($opty->estimated_amount) }}
                  @endif
              </td>
              <td>{{ $opty->Status }}</td>
              <td>Rp. {{ number_format($opty->estimated_amount) }}</td>
              <td>{{ $opty->confidence_level}}</td>
              <td>Rp. {{ number_format($opty->contract_amount) }}</td>
              <td class="text-center">
                <div class="btn-group dropstart mb-1" style="cursor: pointer;">
                  <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  </div>
                  <div class="dropdown-menu text-center">
                    <a href="{{url ('Ydetail', $opty->id)}}" class="btn btn-info btn-sm mb-1">Detail</a>
                    @if (Auth::user()->hasRole('AM/Sales') || Auth::user()->hasRole('Super Admin'))
                        
                    <a href="{{url ('Yedit', $opty->id)}}" class="btn btn-warning btn-sm mb-1">Edit</a>
                    <a href="{{url ('Ydelete', $opty->id)}}" onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" class="btn btn-danger btn-sm mb-1">Delete</a>
                    @endif
                  </div>
                </div>
              </td>
              </div>
            </tr>
            @else
              @if (Auth::user()->name == $opty->name_user)
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
                        Rp. {{ number_format($opty->estimated_amount) }}
                    @endif
                </td>
                <td>
                    @if ($opty->Timeline == 'Q2')
                        Rp. {{ number_format($opty->estimated_amount) }}
                    @endif
                </td>
                <td>
                    @if ($opty->Timeline == 'Q3')
                        Rp. {{ number_format($opty->estimated_amount) }}
                    @endif
                </td>
                <td>
                    @if ($opty->Timeline == 'Q4')
                        Rp. {{ number_format($opty->estimated_amount) }}
                    @endif
                </td>
                <td>{{ $opty->Status }}</td>
                <td>Rp. {{ number_format($opty->estimated_amount) }}</td>
                <td>{{ $opty->confidence_level}}</td>
                <td>Rp. {{ number_format($opty->contract_amount) }}</td>
                <td class="text-center">
                  <div class="btn-group dropstart mb-1" style="cursor: pointer;">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </div>
                    <div class="dropdown-menu text-center">
                      <a href="{{url ('Ydetail', $opty->id)}}" class="btn btn-info btn-sm mb-1">Detail</a>
                      @if (Auth::user()->hasRole('AM/Sales') || Auth::user()->hasRole('Super Admin'))
                          
                      <a href="{{url ('Yedit', $opty->id)}}" class="btn btn-warning btn-sm mb-1">Edit</a>
                      <a href="{{url ('Ydelete', $opty->id)}}" onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" class="btn btn-danger btn-sm mb-1">Delete</a>
                      @endif
                    </div>
                  </div>
                </td>
                </div>
              </tr>
              @endif
            @endif
            
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

  {{-- exel export --}}
  <table id="pipeline" class="table table-striped table-hover table-responsive d-none">
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
      </tr>
    </thead>
    <tbody>
      {{-- @if (Auth::user()->hasRole('AM/Sales') || Auth::user()->hasRole('Super Admin'))
      @endif --}}
      @foreach ($sales as $opty)
      @if (Auth::user()->name == $opty->name_user)
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
                Rp. {{ number_format($opty->estimated_amount) }}
            @endif
        </td>
        <td>
            @if ($opty->Timeline == 'Q2')
                Rp. {{ number_format($opty->estimated_amount) }}
            @endif
        </td>
        <td>
            @if ($opty->Timeline == 'Q3')
                Rp. {{ number_format($opty->estimated_amount) }}
            @endif
        </td>
        <td>
            @if ($opty->Timeline == 'Q4')
                Rp. {{ number_format($opty->estimated_amount) }}
            @endif
        </td>
        <td>{{ $opty->Status }}</td>
        <td>Rp. {{ number_format($opty->estimated_amount) }}</td>
        <td>{{ $opty->confidence_level}}</td>
        <td>Rp. {{ number_format($opty->contract_amount) }}</td>
        </div>
      </tr>
      @endif
      @endforeach
    </tbody>
  </table>
  {{-- end exel export --}}

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
      <form action="/index-sales" method="GET">
      <div class="modal-body">
          <label for="dari">From</label>
          <input type="date" class="form-control" id="dari" name="dari_tgl">
          <label for="sampai" class="mt-2">To</label>
          <input type="date" class="form-control" id="sampai" name="sampai_tgl">
          <label for="sampai" class="mt-2">Status</label>
          <select class="form-control" name="Status">
            <option value="">All Status</option>
            @foreach ($prostat as $item)
                <option value="{{ $item->title }}">{{ $item->title }}</option>
            @endforeach
          </select>
          @if (Auth::user()->name == "Dian Octavia")
            <label for="dari">Sales Name</label>
            <select name="name_user" id="" class="form-control">
              <option value="">All Sales</option>
              @foreach ($user as $item)
                  @foreach ($item->users as $user)
                      <option  value="{{$user->name}}">{{$user->name}}</option>
                  @endforeach
              @endforeach
            </select>
            @endif
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
          </button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>

  <script src="../assets/js/export_exel.js"></script>
@endsection
