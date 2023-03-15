@extends('layouts.main')

@section('title', 'All Projects')

@section('css')
<link rel="stylesheet" href="{{ asset('newassets/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/datatables.css') }}">
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <div class="card">
            <div class="alert">
                <h2 class="text-capitalize">Project Deals</h2>
            </div>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>Project Code</th>
                        <th>Client Name</th>
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($data->where('status', 'Approve' and 'Pending') as $id)
                    <tr align="center" style="font-size:13px">
                        <td><a href="{{route('viewprojectF',$id->id)}}">{{ $id->kode_project }}</a></td>
                        <td>{{$id->institusi}}</td>
                        <td>{{$id->project}}</td>
                        @if ($id->start_date)
                        <td>{{ date('d-m-Y', strtotime($id->start_date)) }}</td>
                        @else
                        <td></td>
                        @endif
                        @if ($id->end_date)
                        <td>{{ date('d-m-Y', strtotime($id->end_date)) }}</td>
                        @else
                        <td></td>
                        @endif
                        <td>{{$id->st_project}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
<script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script src="{{ asset('newassets/assets/js/pages/datatables.js') }}"></script>
@endsection