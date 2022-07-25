@extends('layouts.main')
@section('content')
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>List Document</h1>
        </div>
        <div class="card-body">
            <div class="text-right">
                <a href="#" class="btn btn-info mr-2">Add New Document</a>
                <a href="#" class="btn btn-info">Export Excel</a>
            </div>
            <table class="table table-hover mt-2">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">No Dokumen</th>
                      <th class="text-white" scope="col">Tgl Dokumen</th>
                      <th class="text-white" scope="col">Nama Institusi</th>
                      <th class="text-white" scope="col">Nama Project</th>
                      <th class="text-white" scope="col">Jenis Dokumen</th>
                      <th class="text-white" scope="col">Nama File</th>
                      <th class="text-white" scope="col">Editor</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
            </table>
        </div>
      </div>
    </section>
@endsection