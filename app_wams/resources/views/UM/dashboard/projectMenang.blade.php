@extends('layouts.main')

@section('content')
  <section class="section">
    <div class="section-header">
      <h1 class="text-center mb-5">Projects Win</h1>
    </div>
    <form class="mb-3" action="/ProjectMenang" method="GET">
      {{-- {{csrf_field()}} --}}
      <div class="modal-body d-flex justify-content-center align-items-center mr-2">
        <div class=""> 
          <label for="dari">From</label>
          <input type="date" class="form-control" id="dari" name="dari_tgl">
        </div>
        <div class=""> 
          <label for="sampai" class="">To</label>
          <input type="date" class="form-control" id="sampai" name="sampai_tgl">
        </div>
        <div class=""> 
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
        <div class=""> 
          <label for="name" class="">Name Technikal</label>
          <select class="form-control" name="nameTechnikal">
            <option></option>
            @foreach ($namaTechnikal as $item)  
              @foreach ($item->users as $value)
              <option value="{{ $value->name }}">{{ $value->name ?? null }}</option>
              @endforeach  
            @endforeach
          </select>
        </div>
        {{-- <div>
          <label for="sampai" class="">Status</label>
            <select class="form-control" name="Status">
              <option></option>
              @foreach ($prostat as $item)    
                <option value="{{ $item->title }}">{{ $item->title }}</option>
              @endforeach
            </select>
        </div> --}}
        <div>
          <button type="submit" class="btn  text-white mt-4" style="background-color: #5252FF">Search</button>
        </div>
      </div>
      <div class="modal-footer">
        {{-- <button type="submit" class="btn text-white" style="background-color: #5252FF">Cari</button> --}}
      </div>
    </form>
    <div class="card">
      <div class="card-body ">
        <div class="d-flex justify-content-between">
          <div class="text-left mb-2">
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Date</th>
                <th>Project Name</th>
                <th>Client Name</th>
                <th>AM Name</th>
                <th>PM Name</th>
                <th>Technical Name</th>
                {{-- <th></th> --}}
                {{-- <th></th> --}}
                <th>Project Value</th>
                <th>Status Approve</th>
            </tr>
            </thead>
            <tbody>
              <tbody>
                @foreach ($dataProjects as $key => $item)
                  <tr>
                    {{-- {{$no += '1'}} --}}
                    <td>{{ $key + 1 }}</td>
                    <td>
                      <input style="background: none; border:none;" disabled type="date" value="{{ $item->Date }}">
                    </td>
                    <td>{{ $item->NamaProject }}</td>
                    <td>{{ $item->NamaClient }}</td>
                    {{-- <td>{{$item->userTechnikals}}</td> --}}
                    @if ($item->userTechnikals != null)
                    <td>
                      @foreach ($item->userTechnikals as $value)
                      @if ( $value->AM === null)
                      @else
                        {{ $value->AM->name }}
                      @endif
                      @endforeach
                    </td>
                    @else
                      <td>{{ $item->name_user ?? null }}</td>
                    @endif
                    {{-- <td>dasa</td> --}}
                    @if($item->ltoproject != null)
                    <td>
                          @foreach ($item->ltoproject as $value)
                          {{ $value->pmo ?? null }}
                          @endforeach
                      </td>
                    @else 
                      <td>{{ $item->pmo ?? null }}</td>
                    @endif

                    {{-- @if ($item->presales != null || $item->userTechnikalsPipe != null)
                      @if ($item->userTechnikalsPipe != null)
                        @foreach ($item->userTechnikalsPipe as $value)
                          <td>{{ $value->userTechnikal->name ?? null }}</td>
                          @endforeach
                        @else
                        <td>{{  $item->presales }}</td>
                      @endif
                    @elseif( $item->userTechnikals != null)
                      @foreach ($item->userTechnikals as $value)
                        <td>{{ $value->userTechnikal->name  ?? null }}</td>
                      @endforeach
                    @endif --}}


                      @if ($item->userTechnikalsPipe != null)
                      <td>
                        @foreach ($item->userTechnikalsPipe as $value)
                          {{ $value->userTechnikal->name }}
                        @endforeach
                      </td>
                    @elseif( $item->userTechnikals != null)
                    <td>
                        @foreach ($item->userTechnikals as $value)
                          {{ $value->userTechnikal->name ?? null  }}
                        @endforeach
                      </td>
                    @endif

                      
                    <td>{{ number_format($item->contract_amount) ?? null }}</td>
                    {{-- @if ($item->contract_amount != null)
                    @else
                    <td>
                        @foreach ($item->ltoproject as $value)
                        {{ number_format($value->contract_amount) ?? null }}
                        @endforeach
                    </td>
                    @endif --}}
                    <td>{{ $item->Status }}</td>
                  </tr>
                @endforeach
              </tbody>
            </tbody>
          </table>
        </div>
        <div class="d-flex  justify-content-end">
          {{-- {{ $data->links() }} --}}
        </div>
      </div> 
    </div>
  </section>


 


  
  <script src="../assets/js/export_exel.js"></script>
@endsection

