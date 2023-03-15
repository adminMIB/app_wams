@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
      <h2>List Project Sales Pipeline</h2>
    </div>
    <div class="card">
        <div class="card-body">
        {{-- <button type="button" class="btn btn-warning ml-2 mb-2" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Filter Data</button> --}}
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr align="center">
                    <th>Project Code</th>
                    <th>Client Name</th>
                    <th>Project Name</th>
                    <th>Date</th>
                    <th>Distributor</th>
                    <th>Principal</th>
                    <th>Status</th>
                    <th>Document</th>
                </tr>
            </thead>
  
            <tbody>
                @foreach ($lt as $item)
                <tr>
                    <td>{{$item->ID_project}}</td>
                    <td>{{$item->NamaClient}}</td>
                    <td>{{$item->NamaProject}}</td>
                    <td>{{date('d/m/Y', strtotime($item->Date))}}</td>
                    <td>{{$item->distributor}}</td>
                    <td>{{$item->principal}}</td>
                    <td>{{$item->Status}}</td>
                    <td>
                    @foreach ($item->UploadDocuments as $i)
                        @foreach (explode("," , $i->file_name) as $a) 
                        <a href="/storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                        @endforeach
                    @endforeach
                    </td>
                </tr>
                @endforeach

                @foreach ($pipe as $item)
                <tr>
                    <td>{{$item->ID_project}}</td>
                    <td>{{$item->NamaClient}}</td>
                    <td>{{$item->NamaProject}}</td>
                    <td>{{date('d/m/Y', strtotime($item->Date))}}</td>
                    <td>{{$item->distributor}}</td>
                    <td>{{$item->elearning_id}}</td>
                    <td>{{$item->Status}}</td>
                    <td>
                      @foreach ($item->UploadDocuments as $i)
                        @foreach (explode("," , $i->file_name) as $a) 
                        <a href="/storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                        @endforeach
                      @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        </div>
    </div>
</section>
{{--     
    
    <div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Filter Data Table</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/viewproject" method="GET">
        <div class="modal-body">
            <label for="dari">Dari</label>
            <input type="date" class="form-control" id="dari" name="dari_tgl">
            <label for="sampai" class="mt-2">Sampai</label>
            <input type="date" class="form-control" id="sampai" name="sampai_tgl">
           
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Pilih</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
          </div>
        </form>
      </div>
    </div> --}}



@endsection