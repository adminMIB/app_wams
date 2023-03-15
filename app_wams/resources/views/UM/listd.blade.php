@extends('layouts.main')
@section('content')
    <section class="section">
      <div class="section-header">
        <h1>List Document</h1>
      </div>
      <div class="card">
        <div class="card-body">
            <div class="text-right">
                <a href="#" class="btn text-white mr-2" style=" background-color: #5252FF">Add New Document</a>
                {{-- <a href="#" class="btn btn-info">Export Excel</a> --}}
            </div>
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped mt-2">
                <thead>
                  <tr>
                    <th scope="col">No Dokumen</th>
                    <th scope="col">Tgl Dokumen</th>
                    <th scope="col">Nama Client</th>
                    <th scope="col">Nama Project</th>
                    <th scope="col">Jenis Dokumen</th>
                    <th scope="col">Nama File</th>
                    <th scope="col">Editor</th>
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
      </div>
    </section>
    @endsection