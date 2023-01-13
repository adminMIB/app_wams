@extends('layouts.main')
@section('content')
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>List LTO</h1>
        </div>
        <div class="card-body">
            <div class="text-right mb-3">
              <button type="button" class="btn btn-warning ml-2" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable" >Filter Data</button>
              <button class="btn text-white ml-2 btn-md" style="background-color: #32735F" onclick="tableToExcel('pipeline')">Export Excel</button>
            </div>
            <table class="table table-hover mt-2 table-responsive">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Project Code</th>
                      <th class="text-white" scope="col">Client Name</th>
                      <th class="text-white" scope="col">Project Name</th>
                      <th class="text-white" scope="col">AM Name</th>
                      <th class="text-white" scope="col">PM Name</th>
                      <th class="text-white" scope="col">Technical Name</th>
                      <th class="text-white" scope="col">Project Value</th>
                      <th class="text-white" scope="col">Status Approve</th>
                      <th class="text-white" scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)
                    @if ($item->status == 'Pending')
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$item->kode_project}}</td>
                      <td>{{$item->institusi}}</td>
                      <td>{{$item->project}}</td>
                      <td class="text-primary font-weight-bold">{{$item->name_user}}</td>
                      <td>{{$item->pmo}}</td>
                      <td>{{$item->presales}}</td>
                      <td>{{$item->contract_amount}}</td>
                      <td class="text-danger">{{$item->status}}</td>
                      <td><a href="{{url('/detailapproval', $item->id)}}">Detail</a></td>

                      {{-- @if ($item->status !== 'Pending')
                      <td></td>
                      @elseif($item->status !== 'Approve ')
                      <td><a href="{{url('/detailapproval', $item->id)}}">Detail</a></td>
                      @elseif($item->status !== 'Approve ')
                      @endif --}}
                    </tr>
                    @else
                    @endif    
                    @endforeach
                    {{-- {{ dd($data) }} --}}
                  </tbody>
            </table>
            {{ $data->links() }}
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
            <form action="/approval" method="GET">
            <div class="modal-body">
                <label for="dari">From</label>
                <input type="date" class="form-control" id="dari" name="dari_tgl">
                <label for="sampai" class="mt-2">To</label>
                <input type="date" class="form-control" id="sampai" name="sampai_tgl">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
    </div>  


        {{-- table hidden --}}

        <table id="pipeline" class="table table-hover mt-2 table-responsive d-none">
          <thead style="background-color: #12406c;">
              <tr>
                <th class="text-white" scope="col">No</th>
                <th class="text-white" scope="col">Kode Project</th>
                <th class="text-white" scope="col">Nama Client</th>
                <th class="text-white" scope="col">Nama Project</th>
                <th class="text-white" scope="col">Nama AM</th>
                <th class="text-white" scope="col">Nama PM</th>
                <th class="text-white" scope="col">Nama Technikal</th>
                <th class="text-white" scope="col">Nilai Project</th>
                <th class="text-white" scope="col">Status Approve</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $item)
              @if ($item->status == 'Pending' || $item->status == 'Reject')
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->kode_project}}</td>
                <td>{{$item->institusi}}</td>
                <td>{{$item->project}}</td>
                <td>{{$item->name_user}}</td>
                <td>{{$item->pmo}}</td>
                <td>{{$item->presales}}</td>
                <td>{{$item->estimated_amount}}</td>
                <td class="text-danger">{{$item->status}}</td>

                {{-- @if ($item->status !== 'Pending')
                <td></td>
                @elseif($item->status !== 'Approve ')
                <td><a href="{{url('/detailapproval', $item->id)}}">Detail</a></td>
                @elseif($item->status !== 'Approve ')
                @endif --}}
              </tr>
              @else
              @endif    
              @endforeach
            </tbody>
      </table>
  </div>

  <table id="pipeline" class="table table-hover mt-2 table-responsive d-none">
    <thead style="background-color: #12406c;">
        <tr>
          <th class="text-white" scope="col">No</th>
          <th class="text-white" scope="col">Kode Project</th>
          <th class="text-white" scope="col">Nama Client</th>
          <th class="text-white" scope="col">Nama Project</th>
          <th class="text-white" scope="col">Nama AM</th>
          <th class="text-white" scope="col">Nama PM</th>
          <th class="text-white" scope="col">Nama Technikal</th>
          <th class="text-white" scope="col">HPS</th>
          <th class="text-white" scope="col">Status Approve</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
        @if ($item->status == 'Pending' || $item->status == 'Reject')
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$item->kode_project}}</td>
          <td>{{$item->institusi}}</td>
          <td>{{$item->project}}</td>
          <td>{{$item->name_user}}</td>
          <td>{{$item->pmo}}</td>
          <td>{{$item->presales}}</td>
          <td>{{$item->estimated_amount}}</td>
          <td class="text-danger">{{$item->status}}</td>

          {{-- @if ($item->status !== 'Pending')
          <td></td>
          @elseif($item->status !== 'Approve ')
          <td><a href="{{url('/detailapproval', $item->id)}}">Detail</a></td>
          @elseif($item->status !== 'Approve ')
          @endif --}}
        </tr>
        @else
        @endif    
        @endforeach
      </tbody>
</table>

  <script src="../assets/js/export_exel.js"></script>
@endsection