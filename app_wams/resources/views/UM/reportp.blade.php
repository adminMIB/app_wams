@extends('layouts.main')
@section('content')
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>Report Project</h1>
        </div>
        <div class="card-body">
            <div class="text-right">
                <a href="#" class="btn btn-info">Export Excel</a>
            </div>
            <table class="table table-hover mt-2">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">ID</th>
                      <th class="text-white" scope="col">Nama Institusi</th>
                      <th class="text-white" scope="col">Nama Project</th>
                      <th class="text-white" scope="col">Nilai Project</th>
                      <th class="text-white" scope="col">Nama AM</th>
                      <th class="text-white" scope="col">Nama PM</th>
                      <th class="text-white" scope="col">Nama Technical</th>
                      <th class="text-white" scope="col">Status Pekerjaan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($datas as $d) 
                    <tr>
                      <td>{{$d->listp->kode_project}}</td>
                      <td>{{$d->name_client}}</td>
                      <td>{{$d->name_project}}</td>
                      <td>{{$d->listp->hps}}</td>
                      <td>{{$d->listp->nama_sales}}</td>
                      <td>{{$d->listp->nama_pm}}</td>
                      <td>{{$d->name_technikal}}</td>
                      <td>{{$d->status}}</td>
                    </tr>
                    @endforeach
                  </tbody>
            </table>
        </div>
      </div>
    </section>
@endsection