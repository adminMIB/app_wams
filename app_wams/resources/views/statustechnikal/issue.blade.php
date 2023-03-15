@extends('layouts.main')
@section('content')
    <section class="section">
    <div class="section-header">
       <h1>Status Issue</h1>
    </div>
    <div class="card">
        <div class="card-header">
          <a href="{{route('dashboardpm')}}"><button class="btn btn-secondary">Back</button></a>
        </div>
        <div class="card-body">
            <div class="text-right">
            </div>
            <table id="task" class="table table-hover mt-2 table-responsive">
            <thead style="background-color: #12406c;">
                <tr>
                <th class="text-white" scope="col">Kode Project</th>
                <th class="text-white" scope="col">Nama Client</th>
                <th class="text-white" scope="col">Nama Project</th>
                <th class="text-white" scope="col">Start Date</th>
                <th class="text-white" scope="col">End Date</th>
                <th class="text-white" scope="col">Note</th>
                <th class="text-white" scope="col">Nama Technical</th>
                <th class="text-white" scope="col">Pekerjaan</th>
                <th class="text-white" scope="col">Status Pekerjaan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datas as $d) 
                <tr>
                <td>{{$d->timelines->lists->kode_project}}</td>
                <td>{{$d->timelines->lists->nama_institusi}}</td>
                <td>{{$d->timelines->lists->nama_project}}</td>
                <td>{{$d->start_date}}</td>
                <td>{{$d->end_date}}</td>
                <td>{{$d->note}}</td>
                <td>{{$d->name_technikal}}</td>
                <td>{{$d->job_essay}}</td>
                <td>
                @if ($d->status == 'OnProgress')
                <div class="badge badge-warning">{{$d->status}}</div>
                @elseif ($d->status == 'Issue')
                <div class="badge badge-danger">{{$d->status}}</div>
                @elseif ($d->status == 'Done')
                <div class="badge badge-success">{{$d->status}}</div>
                @endif 
                </td>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
    </section>
  
@endsection