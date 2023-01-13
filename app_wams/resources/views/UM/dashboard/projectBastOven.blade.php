@extends('layouts.main')
@section('css')
  <link rel="stylesheet" href="{{ asset('newassets/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/fontawesome.css') }}">
  <link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/datatables.css') }}">
@endsection
@section('content')
  <section class="section">
    <div class="section-header">
      <h1 class="text-center mb-5">Project Bast Oven</h1>
    </div>
    
    <div class="card">
      <div class="card-body ">
        <div class="d-flex justify-content-between">
          <div class="text-left mb-2">
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover table-striped" id="table1">
            <thead>
              <tr>
                <th>No</th>
                <th>Client Name</th>
                <th>Project Name</th>
                <th>AM Name</th>
                <th>PM Name</th>
                <th>Technikal Name</th>
                <th>Project Value</th>
                <th>Status</th>
            </tr>
            </thead>
              <tbody>
                @foreach ($dataBast as $key => $item)
                <tr>
                  <td>{{ $key + 1 }}</td>
                  <td>{{ $item->so->institusi }}</td>
                  <td>{{ $item->so->project }}</td>
                  <td>{{ $item->so->amsales }}</td>
                  <td>{{ $item->so->pmo }}</td>
                  <td>{{ $item->so->presales }}</td>
                  <td>{{ number_format($item->so->contract_amount)}}</td>
                  <td style="color: #5252FF">{{ $item->status}}</td>
                </tr>
                @endforeach
              </tbody>
          </table>
        </div>
        <div class="d-flex  justify-content-end">
          {{-- {{ $data->links() }} --}}
        </div>
      </div> 
    </div>
  </section>


 


  
  <script src="../assets/js/export_exel.js"></script>
@section('js')
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>
@endsection
@endsection

