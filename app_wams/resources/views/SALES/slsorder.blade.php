@extends('layouts.main')
@section('content')
  <section class="section">
      <div class="section-header">
        <h1>LTO</h1>
      </div>
      <div class="card">
        <div class="card-body">
          {{-- <div class="text-right mb-2">
            <a href="{{route('createodr')}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Tambah LTO</a>
            <a href="{{route('slsorder-export')}}" class="btn btn-primary"><i class="fas fa-file-excel"></i> Export Excel</a>
          </div> --}}
          <div class="text-right mb-2">
            <div class="row ml-1">
              <div>
                <a href="{{route('createodr')}}" class="btn btn-icon icon-left btn-primary"><i class="far fa-edit"></i> Tambah LTO</a>
              </div>
              <div class="col mr-1">
                {{-- <a href="{{route('order-export')}}" class="btn btn-primary"><i class="fas fa-file-excel"></i> Export Excel</a> --}}
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>No LTO</th>
                  <th>Project Date</th>
                  <th>Client Name</th>
                  <th>PM</th>
                  <th>Status</th>
                  <th>Editor</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($products as $item)
              @if (Auth::user()->name == "Dian Octavia")
              <tr class="text-center">
                <td>{{$loop->iteration }}</td>
                <td>{{$item->no_so }}</td>
                <td>{{date('d/m/Y', strtotime($item->tgl_so))}}</td>
                <td>{{$item->institusi}}</td>
                <td>{{ $item->pmo }}</td>
                <td>
                  @if ($item->status == 'Pending')
                  <div class="text-warning" data-bs-toggle="tooltip" data-bs-title="Waiting for the Directors and Finance Review">{{$item->status}}</div>
                  @elseif ($item->status == 'Reject')
                  <div class="text-danger" data-bs-toggle="tooltip" data-bs-title="Reject from Directors">{{$item->status}}</div>
                  @elseif ($item->status == 'Approve')
                  <div class="text-success" data-bs-toggle="tooltip" data-bs-title="Approve from Directors">{{$item->status}}</div>
                  @endif 
                </td>
                <td>{{$item->name_user}}</td>
                <td>
                  <div class="btn-group dropstart mb-1" style="cursor: pointer;">
                    <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    </div>
                    <div class="dropdown-menu text-center">
                      <a href="{{url ('Sshow', $item->id)}}">  <button type="submit" class="btn btn-info btn-sm mb-1">Detail</button></a>
                      @if (Auth::user()->hasRole('AM/Sales') || Auth::user()->hasRole('Super Admin'))
                          
                      <a href="{{url ('Sedit', $item->id)}}">  <button type="submit" class="btn btn-warning btn-sm mb-1">Edit</button></a>
                      <form class="d-inline mx-1" action="{{ route('del', ['id' => $item->id]) }}"
                        method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit" onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" class="btn btn-danger btn-sm mb-1">Delete</button>
                      </form>
                      @endif
                    </div>
                  </div>
                </td>
              </tr>
              @else
                @if (Auth::user()->name == $item->name_user)
                <tr class="text-center">
                  <td>{{$loop->iteration }}</td>
                  <td>{{$item->no_so }}</td>
                  <td>{{date('d/m/Y', strtotime($item->tgl_so))}}</td>
                  <td>{{$item->institusi}}</td>
                  <td>{{ $item->pmo }}</td>
                  <td>
                    @if ($item->status == 'Pending')
                    <div class="text-warning" data-bs-toggle="tooltip" data-bs-title="Waiting for the Directors and Finance Review">{{$item->status}}</div>
                    @elseif ($item->status == 'Reject')
                    <div class="text-danger" data-bs-toggle="tooltip" data-bs-title="Reject from Directors">{{$item->status}}</div>
                    @elseif ($item->status == 'Approve')
                    <div class="text-success" data-bs-toggle="tooltip" data-bs-title="Approve from Directors">{{$item->status}}</div>
                    @endif 
                  </td>
                  <td>{{$item->name_user}}</td>
                  <td>
                    <div class="btn-group dropstart mb-1" style="cursor: pointer;">
                      <div class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      </div>
                      <div class="dropdown-menu text-center">
                        <a href="{{url ('Sshow', $item->id)}}">  <button type="submit" class="btn btn-info btn-sm mb-1">Detail</button></a>
                        @if (Auth::user()->hasRole('AM/Sales') || Auth::user()->hasRole('Super Admin'))
                            
                        <a href="{{url ('Sedit', $item->id)}}">  <button type="submit" class="btn btn-warning btn-sm mb-1">Edit</button></a>
                        <form class="d-inline mx-1" action="{{ route('del', ['id' => $item->id]) }}"
                          method="POST">
                          @method('DELETE')
                          @csrf
                          <button type="submit" onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" class="btn btn-danger btn-sm mb-1">Delete</button>
                        </form>
                        @endif
                      </div>
                    </div>
                  </td>
                </tr>
                @endif
              @endif
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
@section('js')
  <script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  </script>
@endsection