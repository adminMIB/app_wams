@extends('layouts.main')
@section('content')  
@include('sweetalert::alert')
<section class="section">
  <div class="section-header ">
    <h1>All Projects</h1>
  </div>
  <div class="card mt-4e">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr align="center">
                    <th>Project Code</th>
                    <th>Client Name</th>
                    <th>Project Name</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($p as $id)
              @if ($id->listadmin->userTechnikals ?? null )
              @if ($id->status == "Approve")
              <tr align="center">
                <td><a href="{{route('projectsT.view',$id->id)}}">{{ $id->kode_project }}</a></td>
                <td>{{$id->institusi}}</td>
                <td>{{$id->project}}</td>
              </tr>
              @endif
              @else
              
              @endif
              @if ($id->listpipe->userTechnikalsPipe ?? null )
              @if ($id->status == "Approve")
              <tr align="center">
              <td><a href="{{route('projectsT.view',$id->id)}}">{{ $id->kode_project }}</a></td>
              <td>{{$id->institusi}}</td>
              <td>{{$id->project}}</td>
              </tr>
              @endif
              @else
              
              @endif
              @endforeach
            </tbody>
        </table>
    </div>
  </div>
</section>
@endsection
{{-- <table class="table table-striped table-bordered table-hover">
    <thead>
        <tr align="center">
            <th>Kode Project</th>
            <th>Nama Client</th>
            <th>Nama Project</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
      @foreach ($data as $id)
      @foreach ($id->detail as $it)
      @if (Auth::user()->name == $it->nama_technical)
      <tr align="center">
        <td>{{ $id->kode_project }}</td>
        <td>{{ $id->nama_institusi }}</td>
        <td>{{ $id->nama_project }}</td>
        <td>
          <a href="{{route('detailT',$id->id)}}"><button type="submit" class="btn btn-info" style="border-radius:3em ;">Detail</button></a>
          <a href="{{route('editT',$id->id)}}"><button type="submit" class="btn btn-primary" style="border-radius:3em ;">Weekly Report</button></a>
        </td>
      </tr>
      @endif
      @endforeach
      @endforeach
    </tbody>
</table> --}}