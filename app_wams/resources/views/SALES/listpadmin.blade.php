@extends('layouts.main')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>List Admin Project</h1>
    </div> 
    <div class="card">
      <div class="card-body">
        <div class="text-right mb-3">
          <button type="button" class="btn btn-warning ml-2" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Filter Data</button>
          <button class="btn btn-success ml-2 btn-md " onclick="tableToExcel('pipeline')">Export Excel</button>
        </div>
        <div class="table-responsive">
          <table id="pipeline" class="table table-bordered table-striped table-hover">
            <thead>
              <tr class="text-center ">
                <th>Project ID</th>
                <th>Client Name</th>
                <th>Project Name</th>
                <th>Date</th>
                <th>Distributor</th>
                <th>Principal</th>
                <th>Status</th>
                <th>Document Upload</th>
                <th>Note</th>
                <th>Technical</th>
                <th>AM</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($ds as $it)
              @foreach ($it->userTechnikals as $item)
                @if (Auth::user()->id ==  $item->user_id_am)
                <tr class="text-center">
                  <td>{{$it->ID_project }}</td>
                  <td>{{$it->NamaClient }}</td>
                  <td>{{$it->NamaProject }}</td>
                  <td>{{date('d/m/Y', strtotime($it->Date))}}</td>
                  <td>{{$it->distributor}}</td>
                  <td>{{$it->principal}}</td>    
                  <td>{{$it->Status}}</td>          
                  <td>
                  @foreach ($it->UploadDocuments as $i)
                    @foreach (explode("," , $i->file_name) as $a) 
                      <a href="/storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                    @endforeach 
                  @endforeach
                  </td>
                  <td>{{$it->Note}}</td>
                  <td>
                    @foreach ($it->userTechnikals as $value)  
                      {{$value->userTechnikal->name ?? null}}
                    @endforeach
                  </td>
                  <td>
                    @foreach ($it->userTechnikals as $value)  
                      {{$value->AM->name ?? null}}
                    @endforeach
                  </td>
                </tr>
                @endif
              @endforeach
            @endforeach
            </tbody>
          </table>
        </div>
      </div> 
    </div>
  </section>

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
                <form action="/slistpa" method="GET">
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
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      <i class="bx bx-x d-block d-sm-none"></i>
                      <span class="d-none d-sm-block">Close</span>
                    </button>
                  </div>
                </form>
              </div>
        </div>
          
          <script src="../assets/js/export_exel.js"></script>
@endsection

