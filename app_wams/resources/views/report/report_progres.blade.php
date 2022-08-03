@extends('layouts.main')
@section('content')  
@include('sweetalert::alert')
    <section class="section">
      <h1 style="color: black; margin-left: 10px; margin-top:20px"></h1>
    </section>

    <!-- Table Report -->
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
          <h4>Report Progress</h4>
          
          <div class="card-header-form">
            <form action="/report" method="GET">
              <div class="input-group">
                <a class="btn btn-primary" href="/create" type="submit">Create Weekly Report</a>
                <input type="date" class="form-control" style="margin-left: 10px" value="{{ request('search') }}" name="search">
                <div class="input-group-btn">
                  <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
                <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-danger ml-4" href="/report"><i class="fas fa-times"></i></a>
              </div>
            </form>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped">
              <tbody><tr>
                <th>No</th>
                <th>Nama Client</th>
                <th>Nama Project</th>
                <th>Uraian Pekerjaan</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Note</th>
                <th>Action</th>
              </tr>

              @foreach ($weekly_reports as $key => $w) 
              <tr>
                <td>{{ $weekly_reports->firstItem() + $key }}</td>
                <td>{{ $w->name_client }}</td>
                <td>{{ $w->name_project }}</td> 
                <td>{{ $w->job_essay }}</td> 
                <td>{{ $w->start_date }}</td> 
                <td>{{ $w->end_date }}</td> 
                <td>{{ $w->status }}</td> 
                <td>{{ $w->note }}</td>
                <td><a href="/edit/{{ $w->id }}" class="btn btn-primary">Detail</a></td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="ml-4 d-flex justify-content-start">
        Showing
        {{ $weekly_reports->firstItem() }}
        to
        {{ $weekly_reports->lastItem() }}
        of
        {{ $weekly_reports->total() }}
        </div>
      <div class="card-footer d-flex justify-content-end">
        {{ $weekly_reports->links() }}
        </div>
      </div>
    <!-- Akhir Table Report -->
    @endsection


    {{-- @section('js')
    <script type="text/javascript">
      $(document).ready(function(){
               
      });

      function filter(){
        $("#exampleModal").modal('show');
      }
    </script>
    @endsection --}}
