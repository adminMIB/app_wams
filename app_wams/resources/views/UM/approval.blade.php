@extends('layouts.main')
@section('content')
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>Approval SO</h1>
        </div>
        <div class="card-body">
            <div class="text-right">
                <a href="#" class="btn btn-info">Export Excel</a>
            </div>
            <table class="table table-hover mt-2">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Kode Project</th>
                      <th class="text-white" scope="col">Nama Institusi</th>
                      <th class="text-white" scope="col">Nama Project</th>
                      <th class="text-white" scope="col">Nama AM</th>
                      <th class="text-white" scope="col">HPS</th>
                      <th class="text-white" scope="col">Status Approve</th>
                      <th class="text-white" scope="col">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $item)    
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>B{{$item->kode_project}}</td>
                      <td>{{$item->institusi}}</td>
                      <td>{{$item->project}}</td>
                      <td>{{$item->name_user}}</td>
                      <td>{{$item->hps}}</td>
                      <td>{{$item->status}}</td>
                      @if ($item->status !== 'Pending')
                      <td></td>
                      @elseif($item->status !== 'Approve ')
                      <td><a href="{{url('/detailapproval', $item->id)}}">Detail</a></td>
                      @elseif($item->status !== 'Approve ')
                      @endif
                    </tr>
                    @endforeach
                  </tbody>
            </table>
        </div>
      </div>
    </section>
@endsection