@extends('layouts.main')
@section('content')
    <section class="section">
      <div style="display:flex;">
        <a class="nav-link active bg-white" id="approve-tab" data-bs-toggle="tab" href="#approve" role="tab"
        aria-controls="home" aria-selected="true">
        <div style="padding-left:10px; padding-right:10px; padding-top:10px; cursor:pointer">
          <h6 class="text-center p-2">Approve</h6>
        </div>
      </a>
      <a class="nav-link" id="reject-tab" data-bs-toggle="tab" href="#reject" role="tab" aria-controls="reject" aria-selected="false">
        <div style="padding-left:10px; padding-right:10px; padding-top:10px; cursor:pointer">
          <h6 class="text-center p-2">Reject</h6>
        </div>
      </a>
      </div>
      <div class="page">
        {{-- page approve --}}
        <div class="card approve" style="margin-top: -10px;" id="approve" role="tabpanel" aria-labelledby="approve-tab">
          <div class="card-header">
            <h1>List Approve SO</h1>
          </div>
          @if ($dataFilter)
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
                    <tbody style="font-size: 15px;">
                      @foreach ($dataFilter as $item)    
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->kode_project}}</td>
                        <td>{{$item->institusi}}</td>
                        <td>{{$item->project}}</td>
                        <td class="text-primary font-weight-bold">{{$item->name_user}}</td>
                        <td>{{$item->pmo}}</td>
                        <td>{{$item->presales}}</td>
                        <td>{{$item->contract_amount}}</td>
                        @if ($item->status == 'Approve')
                        <td class="text-success">{{$item->status}}</td>
                        @else
                        <td class="text-danger">{{$item->status}}</td>                          
                        @endif
                          <td><a href="{{url('/detailapproval', $item->id)}}">Detail</a></td>

                        {{-- @if ($item->status !== 'Pending')
                        <td></td>
                        @elseif($item->status !== 'Approve ')
                        <td><a href="{{url('/detailapproval', $item->id)}}">Detail</a></td>
                        @elseif($item->status !== 'Approve ')
                        @endif --}}
                      </tr>
                      @endforeach
                    </tbody>
              </table>
              {{ $data->links() }}
            </div>
          @else    
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
                      <tbody style="font-size: 15px;">
                        @foreach ($data as $item)    
                        @if ($item->status == 'Approve')
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$item->kode_project}}</td>
                          <td>{{$item->institusi}}</td>
                          <td>{{$item->project}}</td>
                          <td class="text-primary font-weight-bold">{{$item->name_user}}</td>
                          <td>{{$item->pmo}}</td>
                          <td>{{$item->presales}}</td>
                          <td>{{$item->contract_amount}}</td>
                          @if ($item->status == 'Approve')
                          <td class="text-success">{{$item->status}}</td>
                          @else
                          <td class="text-danger">{{$item->status}}</td>                          
                          @endif
                            <td><a href="{{url('/detailapproval', $item->id)}}">Detail</a></td>
                        </tr>
                        @endif
                        @endforeach
                      </tbody>
                </table>
                {{ $data->links() }}
            </div>
          @endif
        </div>
        {{-- page reject --}}
        <div class="card reject d-none" style="margin-top: -10px;" id="reject" role="tabpanel" aria-labelledby="reject-tab">
          <div class="card-header">
            <h1>List Reject</h1>
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
                    <tbody style="font-size: 15px;">
                      @foreach ($dataReject as $item)    
                      @if ($item->status == 'Reject')
                      <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->kode_project}}</td>
                        <td>{{$item->institusi}}</td>
                        <td>{{$item->project}}</td>
                        <td class="text-primary font-weight-bold">{{$item->name_user}}</td>
                        <td>{{$item->pmo}}</td>
                        <td>{{$item->presales}}</td>
                        <td>{{$item->contract_amount}}</td>
                        @if ($item->status == 'Approve')
                        <td class="text-success">{{$item->status}}</td>
                        @else
                        <td class="text-danger">{{$item->status}}</td>                          
                        @endif
                          <td><a href="{{url('/detailapproval', $item->id)}}">Detail</a></td>
                      </tr>
                      @endif
                      @endforeach
                    </tbody>
              </table>
              {{ $data->links() }}
          </div>
        </div>
      </div>

    </section>
        <div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Filter Data Table</h5>
                </div>
                <form action="/inputTwo" method="GET">
                <div class="modal-body">
                    <label for="dari">From</label>
                    <input type="date" class="form-control" id="dari" name="dari_tgl">
                    <label for="sampai" class="mt-2">To</label>
                    <input type="date" class="form-control" id="sampai" name="sampai_tgl">
                      <label for="sampai" class="">Status</label>
                        <select class="form-control" name="status">
                          <option value=""></option>
                          <option value="Approve">Approve</option>
                          <option value="Reject">Reject</option>
                        </select>
                    <label for="name" class="">Name AM</label>
                    <select class="form-control" name="name">
                          <option></option>
                          @foreach ($namaAm as $item)  
                            @foreach ($item->users as $value)
                            <option value="{{ $value->name }}">{{ $value->name }}</option>
                            @endforeach  
                          @endforeach
                      </select>   
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary pilih">Pilih</button>
                  </div>
                </form>
              </div>
            </div>
        </div>  
    

        {{-- table hidden --}}
        <div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
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
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $item)    
              @if ($item->status == 'Approve')
              <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->kode_project}}</td>
                <td>{{$item->institusi}}</td>
                <td>{{$item->project}}</td>
                <td>{{$item->name_user}}</td>
                <td>{{$item->pmo}}</td>
                <td>{{$item->presales}}</td>
                <td>{{$item->estimated_amount}}</td>
                <td class="text-success">{{$item->status}}</td>

                {{-- @if ($item->status !== 'Pending')
                <td></td>
                @elseif($item->status !== 'Approve ')
                <td><a href="{{url('/detailapproval', $item->id)}}">Detail</a></td>
                @elseif($item->status !== 'Approve ')
                @endif --}}
              </tr>
              @endif
              @endforeach
            </tbody>
      </table>
  </div>

  <table id="pipeline" class="table table-hover mt-2 table-responsive d-none">
    <thead style="background-color: #12406c;">
        <tr>
          <th class="text-white" scope="col">No</th>
          <th class="text-white" scope="col">Project Code</th>
          <th class="text-white" scope="col">Client Name</th>
          <th class="text-white" scope="col">Project Name</th>
          <th class="text-white" scope="col">AM Name</th>
          <th class="text-white" scope="col">PM Name</th>
          <th class="text-white" scope="col">Technical Name</th>
          <th class="text-white" scope="col">HPS</th>
          <th class="text-white" scope="col">Status Approve</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)    
        @if ($item->status == 'Approve' || $item->status == 'Reject')
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$item->kode_project}}</td>
          <td>{{$item->institusi}}</td>
          <td>{{$item->project}}</td>
          <td>{{$item->name_user}}</td>
          <td>{{$item->pmo}}</td>
          <td>{{$item->presales}}</td>
          <td>{{$item->estimated_amount}}</td>
          <td class="text-success">{{$item->status}}</td>
        </tr>
        @endif
        @endforeach
      </tbody>
</table>

  <script src="../assets/js/export_exel.js"></script>
  <script>
    const approveTab    = document.getElementById(`approve-tab`);
    const rejectTab     = document.getElementById(`reject-tab`);
    const classApprove  = document.querySelector('.approve');
    const classReject   = document.querySelector('.reject');

    approveTab.addEventListener('click', () => {
      //tab
      approveTab.classList.add('bg-white')
      rejectTab.classList.remove('bg-white')

      // page
      classApprove.classList.remove(`d-none`);
      classReject.classList.add(`d-none`);
    })

    rejectTab.addEventListener('click', () => {
      // tab
      rejectTab.classList.add('bg-white')
      approveTab.classList.remove('bg-white')

      // page
      classApprove.classList.add(`d-none`);
      classReject.classList.remove(`d-none`);
    })



  </script>
@endsection