@extends('layouts.main')

@section('title', 'All Projects')

@section('content')
<section class="section">
    <div class="section-header">
        <div class="card">

            <div class="alert">
            <h2 class="text-capitalize">All Projects</h2>
        </div>
        </div>
        
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <button type="button" class="btn btn-warning ml-2" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Filter Data</button>
        </div>
        <div class="card-body">
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

                    <td>{{ $item->contract_amount ?? null }}</td>
                    {{-- @if ($item->contract_amount != null)
                      <td>{{ $item->contract_amount ?? null }}</td>
                    @else
                    <td>
                        @foreach ($item->ltoproject as $value)
                        {{ $value->contract_amount ?? null }}
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
        </div>
    </div>

</section>
<div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Filter Data Table</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/data_report" method="GET">
          <div class="modal-body">
            <label for="dari">Client Name</label>
            <select name="NamaClient" id="" class="form-control">
              <option value="">All Client</option>
              @foreach ($dataProjects as $key => $item)
              <option value="{{ $item->NamaClient }}">{{ $item->NamaClient}}</option>
              @endforeach
            </select>
            <label for="name" class="">Technical Name</label>
          <select class="form-control" name="nameTechnikal">
            <option></option>
            @foreach ($namaTechnikal as $item)  
              @foreach ($item->users as $value)
              <option value="{{ $value->name }}">{{ $value->name ?? null }}</option>
              @endforeach  
            @endforeach
          </select>
          <label for="sampai" class="">Status</label>
          <select class="form-control" name="Status">
            <option></option>
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
@endsection