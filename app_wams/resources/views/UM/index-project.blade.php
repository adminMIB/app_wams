@extends('layouts.main')
@section('content')
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>All Projects</h1>
        </div>
        <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped mt-2">
                <thead>
                  <tr align="center">
                    {{-- <th scope="col">No</th> --}}
                    <th scope="col">Project Code</th>
                    <th scope="col">Client Name</th>
                    <th scope="col">Project Name</th>
                    {{-- <th scope="col">Nama AM</th> --}}
                    {{-- <th scope="col">Nama PM</th> --}}
                    {{-- <th scope="col">Nama Technikal</th> --}}
                    {{-- <th scope="col">HPS</th> --}}
                    {{-- <th scope="col">Status Approve</th> --}}
                    {{-- <th scope="col">Actions</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @foreach ($data as $item)    
                  @if ($item->status == 'Approve')
                  <tr align="center">
                    {{-- <td>{{$loop->iteration}}</td> --}}
                    <td><a href="{{url('showP',$item->id)}}">{{ $item->kode_project }}</a></td>
                    <td>{{$item->institusi}}</td>
                    <td>{{$item->project}}</td>
                    {{-- <td>{{$item->name_user}}</td> --}}
                    {{-- <td>{{$item->pmo}}</td> --}}
                    {{-- <td>{{$item->presales}}</td> --}}
                    {{-- <td>{{$item->estimated_amount}}</td> --}}
                    {{-- <td class="text-success">{{$item->status}}</td> --}}
                      {{-- <td><a href="{{url('/detailapproval', $item->id)}}">Detail</a></td> --}}
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
        </div>
      </div>
    </section>
@endsection