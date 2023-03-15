@extends('layouts.main')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1>Report Admin Project</h1>
    </div>
    <div class="card">
      <div class="card-body ">
        <div class="d-flex justify-content-end">
          <div class="text-right mb-3">
            <button type="button" class="btn ml-2 btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Filter Data</button>
            <button class="btn ml-2 btn-md text-white" style="background-color: #32735F" onclick="tableToExcel('pipeline')">Export Excel</button>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped">
            <thead>
              <tr class="text-center">
                <th>NO</th>
                <th>Project ID</th>
                <th>No Customer</th>
                <th>Client Name</th>
                <th>Project Name</th>
                <th>Date</th>
                {{-- <th>Estimasi Amount</th> --}}
                <th>Distributor</th>
                <th>Principal</th>
                <th>Document Upload</th>
                <th>Note</th>
                {{-- <th>PM</th> --}}
                <th>Technical</th>
                <th>AM</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody style="font-size: 16px;">
              @foreach ($admin as $key => $item)
              @if ($item->id % 2 == 1)
              <tr class="text-center">
                <td>{{$key + $admin->firstItem() }}</td>
                <td>{{$item->ID_project }}</td>
                <td>{{$item->ID_Customer }}</td>
                <td>{{$item->NamaClient }}</td>
                <td>{{$item->NamaProject }}</td>
                <td>{{$item->Date}}</td>
                {{-- <td>{{$item->Angka}}</td> --}}
                <td>{{$item->distributor}}</td>
                <td>{{$item->principal}}</td> 
                <td>
                    @foreach ($item->UploadDocuments as $i)
                      @foreach (explode("," , $i->file_name) as $a) 
                    <a href="/storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                    @endforeach 
                  @endforeach
                </td>
                <td>{{$item->Note}}</td>
                {{-- <td>{{$item->Pm->name }}</td> --}}
                <td>
                  @foreach ($item->userTechnikals as $value)  
                    {{$value->userTechnikal->name ?? null}}
                  @endforeach
                </td>
                <td>
                  @foreach ($item->userTechnikals as $value)  
                    {{$value->AM->name ?? null}}
                  @endforeach
                </td>
                @if ($item->Status == 'PO/Contract')                  
                  <td class="text-success">{{$item->Status}}</td>          
                @else
                  <td class="text-info">{{$item->Status}}</td>          
                @endif
                <td>
                  <div class="btn-group dropstart mb-1" style="cursor: pointer;">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </div>
                  <div class="dropdown-menu dropdown-menu-right text-center " aria-labelledby="navbarDropdown">
                    <a target="" href="{{url('/umShowAdmin', $item->id)}}" class="btn text-white" style="background-color: #0EC8F8">
                      Detail
                    </a>
                  </div>
                  </div>
                </td>
              </tr>          
              @else
              <tr class="text-center">
                <td>{{$key + $admin->firstItem() }}</td>
                <td>{{$item->ID_project }}</td>
                <td>{{$item->ID_Customer }}</td>
                <td>{{$item->NamaClient }}</td>
                <td>{{$item->NamaProject }}</td>
                <td>{{$item->Date}}</td>
                {{-- <td>{{$item->Angka}}</td> --}}
                <td>{{$item->distributor}}</td>
                <td>{{$item->principal}}</td> 
                <td>
                    @foreach ($item->UploadDocuments as $i)
                      @foreach (explode("," , $i->file_name) as $a) 
                    <a href="/storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                    @endforeach 
                  @endforeach
                </td>
                <td>{{$item->Note}}</td>
                {{-- <td>{{$item->Pm->name }}</td> --}}
                <td>
                  @foreach ($item->userTechnikals as $value)  
                    {{$value->userTechnikal->name ?? null}}
                  @endforeach
                </td>
                <td>
                  @foreach ($item->userTechnikals as $value)  
                    {{$value->AM->name ?? null}}
                  @endforeach
                </td>
                @if ($item->Status == 'PO/Contract')                  
                  <td class="text-success">{{$item->Status}}</td>          
                @else
                  <td class="text-info">{{$item->Status}}</td>          
                @endif
                <td>
                  <div class="btn-group dropstart mb-1" style="cursor: pointer;">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </div>
                  <div class="dropdown-menu dropdown-menu-right text-center " aria-labelledby="navbarDropdown">
                    <a target="" href="{{url('/umShowAdmin', $item->id)}}" class="btn text-white" style="background-color: #0EC8F8">
                      Detail
                    </a>
                  </div>
                  </div>
                </td>
              </tr>   
              @endif
              @endforeach
            </tbody>
          </table>
          {{ $admin->links() }}
        </div>
      </div> 
    </div>
  </section>
  
  {{-- hidden --}}
  <table id="pipeline" class="table table-bordered table-responsive table-bordered d-none">
    <tbody>
        <tr class="text-center " style="color: black; font-weight:500;">
          <th>NO</th>
          <th>Project ID</th>
          <th>Client Name</th>
          <th>Project Name</th>
          <th>Date</th>
          {{-- <th>Estimasi Amount</th> --}}
          <th>Distributor</th>
          <th>Principal</th>
          <th>Document Upload</th>
          <th>Note</th>
          {{-- <th>PM</th> --}}
          <th>Technical</th>
          <th>AM</th>
          <th>Status</th>
        </tr>
    @foreach ($admin as $item)
    <tr class="text-center">
      <td>{{$key + $admin->firstItem() }}</td>
      <td>{{$item->ID_project }}</td>
      <td>{{$item->NamaClient }}</td>
      <td>{{$item->NamaProject }}</td>
      <td>{{$item->Date}}</td>
      {{-- <td>{{$item->Angka}}</td> --}}
      <td>{{$item->distributor}}</td>
      <td>{{$item->principal}}</td> 
      <td>
          @foreach ($item->UploadDocuments as $i)
            @foreach (explode("," , $i->file_name) as $a) 
          <a href="/storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
          @endforeach 
        @endforeach
      </td>
      <td>{{$item->Note}}</td>
      {{-- <td>{{$item->Pm->name }}</td> --}}
      <td>
        @foreach ($item->userTechnikals as $value)  
          {{$value->userTechnikal->name ?? null}}
        @endforeach
      </td>
      <td>
        @foreach ($item->userTechnikals as $value)  
          {{$value->AM->name ?? null}}
        @endforeach
      </td>
      @if ($item->Status == 'PO/Contract')                  
        <td class="text-success">{{$item->Status}}</td>          
      @else
        <td class="text-info">{{$item->Status}}</td>          
      @endif
      {{-- <td class="col-span-2 w-full">
        <a target="" href="{{url('/adminprojectShow', $item->id)}}" class="btn d-block mt-4  mb-4 text-white" style="background-color: #0EC8F8">
          Detail
        </a>
        <a href="{{url('/adminprojectShowEdit', $item->id)}}" class="btn d-block mb-5 text-white" style="background-color: #FF7C57">Edit</a>
          <a href="{{url('/adminprojecDelete', $item->id)}}"  class="btn btn-danger d-block mb-2">
            Hapus
          </a>
      </td> --}}
    </tr>
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
        <form action="/umViewAdmin" method="GET">
          <div class="modal-body">
            <label for="dari">From</label>
            <input type="date" class="form-control" id="dari" name="dari_tgl">
            <label for="sampai" class="mt-2">To</label>
            <input type="date" class="form-control" id="sampai" name="sampai_tgl">
            <label for="sampai" class="mt-2">Status</label>
            <select class="form-control" name="Status">
              <option></option>
              @foreach ($prostat as $item)    
                <option value="{{ $item->title }}">{{ $item->title }}</option>
              @endforeach
            </select>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn text-white" style="background-color: #5252FF">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
          
  <script src="../assets/js/export_exel.js"></script>
@endsection

