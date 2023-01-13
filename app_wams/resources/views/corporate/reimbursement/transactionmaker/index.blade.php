@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{ asset('newassets/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/datatables.css') }}">
@endsection
@section('content')
<section class="section">
    <div class="section-header">
        <div class="card">
            <div class="text-center mt-2">
                <h2 class="text-capitalize">Project / Oppty</h2>
            </div>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <a href="{{ route('create-TMReimbursement') }}" class="btn btn-primary">Create</a>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>No</th>
                        <th>Tanggal Reimbursement</th>
                        <th>Nama PIC Reimbursement</th>
                        <th>Nominal Reimbursement</th>
                        <th>PIC Business Channel</th>
                        <th>Client</th>
                        <th>PIC Client</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tmreim as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal_reimbursement }}</td>
                        <td>{{ $item->nama_pic_reimbursement }}</td>
                        <td>{{ $item->nominal_reimbursement }}</td>
                        <td>{{ $item->pic_business_channel }}</td>
                        <td>{{ $item->client }}</td>
                        <td>{{ $item->pic_client }}</td>
                        <td>
                            
                        </td>
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