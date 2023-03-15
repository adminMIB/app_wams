@extends('layouts.main')
@section('content')
  <section class="section">
      <div class="section-header">
        <h1>Project Deals</h1>
      </div>
      <div class="card">
        <div class="card-header">
          <button type="button" class="btn btn-warning ml-2" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Filter Data</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
              <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Project Code</th>
                  <th>Project Date</th>
                  <th>Client Name</th>
                  <th>Status</th>
                  <th>Editor</th>
                  <th>Start date</th>
                  <th>Dead Line</th>
                </tr>
              </thead>
              <tbody>
              @foreach ($products as $item)
              @foreach ($item->bast as $items)
              @if (Auth::user()->name == "Dian Octavia")
              <tr class="text-center">
                <td>{{$loop->iteration }}</td>
                <td><a href="{{ route('VIEWLTOEDIT', $item->id) }}">{{$item->kode_project }}</a></td>
                <td>{{date('d/m/Y', strtotime($item->tgl_so))}}</td>
                <td>{{$item->institusi}}</td>
                <td>
                  {{ $item->st_project}}
                </td>
                <td>{{$item->name_user}}</td>
                @if (!$item->start_date)
                  <td></td>
                @elseif($item->start_date)
                <td>{{ date('d-m-Y', strtotime($item->start_date)) }}</td>
                @endif
                @if (!$item->end_date)
                <td></td>
                @elseif($item->end_date)
                <td>{{ date('d-m-Y', strtotime($item->end_date)) }}</td>
                @endif
              </tr>
              @else
                @if (Auth::user()->name == $item->name_user)
                <tr class="text-center">
                  <td>{{$loop->iteration }}</td>
                  <td><a href="{{ route('VIEWLTOEDIT', $item->id) }}">{{$item->kode_project }}</a></td>
                  <td>{{date('d/m/Y', strtotime($item->tgl_so))}}</td>
                  <td>{{$item->institusi}}</td>
                  <td>
                    {{ $item->st_project}}
                  </td>
                  <td>{{$item->name_user}}</td>
                  @if (!$item->start_date)
                    <td></td>
                  @elseif($item->start_date)
                  <td>{{ date('d-m-Y', strtotime($item->start_date)) }}</td>
                  @endif
                  @if (!$item->end_date)
                  <td></td>
                  @elseif($item->end_date)
                  <td>{{ date('d-m-Y', strtotime($item->end_date)) }}</td>
                  @endif
                </tr>
                @endif
              @endif
              @endforeach
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

  <!-- Modal -->
  <div id="exampleModalScrollable" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Filter Data Table</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="/Project" method="GET">
          <div class="modal-body">
            <label for="dari">Client Name</label>
            <select name="institusi" id="" class="form-control">
              <option value="">All Client</option>
              @foreach ($products as $it)
              <option value="{{ $item->institusi }}">{{ $item->institusi }}</option>
              @endforeach
            </select>
            <label for="dari">Status</label>
            <select name="status" id="" class="form-control">
              <option value="">All Status</option>
              <option value="Completed">Completed</option>
              <option value="Hold">Hold</option>
              <option value="Open">Open</option>
            </select>
            @if (Auth::user()->name == "Dian Octavia")
            <label for="dari">Sales Name</label>
            <select name="name_user" id="" class="form-control">
              <option value="">All Sales</option>
              @foreach ($sales as $item)
                  @foreach ($item->users as $user)
                      <option  value="{{$user->name}}">{{$user->name}}</option>
                  @endforeach
              @endforeach
            </select>
            @endif
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="bx bx-x d-block d-sm-none"></i>
              <span class="d-none d-sm-block">Close</span>
            </button>
          </div>
        </form>
      </div>
  </div>
@endsection