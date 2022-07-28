@extends('layouts.main')
@section('content')
  <section class="section">
      <div class="section-header">
        <h1>Sales Order</h1>
      </div>
      <div class="card">
        <div class="card-body">
          {{-- <div class="text-right mb-2">
            <a href="{{route('createodr')}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Tambah Sales Order</a>
            <a href="{{route('slsorder-export')}}" class="btn btn-primary"><i class="fas fa-file-excel"></i> Export Excel</a>
          </div> --}}
          <div class="text-right mb-2">
            <div class="row ml-1">
              <div>
                <a href="{{route('createodr')}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Tambah Sales Order</a>
              </div>
              <div class="col mr-1">
                {{-- <a href="{{route('order-export')}}" class="btn btn-primary"><i class="fas fa-file-excel"></i> Export Excel</a> --}}
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-md">
              <tbody>
              <tr class="text-center">
                <th>No</th>
                <th>No Sales Order</th>
                <th>TGL Project</th>
                <th>Nama Institusi</th>
                <th>Jenis Dokumen</th>
                <th>File</th>
                <th>Status</th>
                <th>Editor</th>
                <th>Action</th>
              </tr>
              @foreach ($odr as $item)
              <tr class="text-center">
                <td>{{$loop->iteration }}</td>
                <td>{{$item->no_so }}</td>
                <td>{{$item->created_at->format('d/m/Y')}}</td>
                <td>{{$item->institusi}}</td>
                <td>{{$item->jenis_dok}}</td>
                <td><a href="/files/dokumen/{{$item->file_dokumen}}">{{$item->file_dokumen}}</a></td>
                <td>
                  @if ($item->status == 'Pending')
                  <div class="text-warning">{{$item->status}}</div>
                  @elseif ($item->status == 'Reject')
                  <div class="text-danger">{{$item->status}}</div>
                  @elseif ($item->status == 'Approve')
                  <div class="text-success">{{$item->status}}</div>
                  @endif 
                 </td>
                 <td>{{$item->name_user}}</td>
                <td>
                  <a href="{{url('/Sedit', $item->id)}}" class="btn btn-info"><i class="far fa-edit"></i></a>
                  <a href="{{url('/del', $item->id)}}" class="btn btn-danger"><i class="fas fa-times"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">
          {{ $odr->links() }}
        </div>
      </div>
  </section>
@endsection