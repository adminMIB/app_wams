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
                <th>File</th>
                <th>Status</th>
                <th>Editor</th>
                <th>Action</th>
              </tr>
              @foreach ($products as $item)
              <tr class="text-center">
                <td>{{$loop->iteration }}</td>
                <td>{{$item->no_so }}</td>
                <td>{{$item->created_at->format('d/m/Y')}}</td>
                <td>{{$item->institusi}}</td>
                <td>
                  @foreach ($item->file_dokumens as $i)
                  @foreach (explode("," , $i->file_name) as $a) 
                  <a href="storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                  @endforeach
                  @endforeach
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
                  <a href="{{ route('Sedit', ['id' => $item->id]) }}" class="btn btn-info">Edit</a>
                  <form class="d-inline mx-1" action="{{ route('del', ['id' => $item->id]) }}"
                     method="POST">
                     @method('DELETE')
                     @csrf
                     <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                  {{-- <a href="{{url('/Sedit', $item->id)}}" class="btn btn-info"><i class="far fa-edit"></i></a>
                  <a href="{{url('/del', $item->id)}}" class="btn btn-danger"><i class="fas fa-times"></i></a> --}}
                </td>
              </tr>
              @endforeach
            </tbody>
            </table>
          </div>
        </div>
        {{-- <div class="card-footer">
          {{ $->links() }}
        </div> --}}
      </div>
  </section>
@endsection