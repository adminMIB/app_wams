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
                <h2 class="text-capitalize">Transaction Maker</h2>
            </div>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <a href="{{ route('TMDLcreate') }}" class="btn btn-primary">Create</a>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>No</th>
                        <th>Tanggal PO</th>
                        <th>Nama Project</th>
                        <th>Nama Client</th>
                        <th>Nama EU</th>
                        <th>Nominal PO</th>
                        <th>Nama SBU</th>
                        <th>Nama PIC</th>
                        <th>PIC Business Channel</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($tmdcl as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->tanggal_po }}</td>
                        <td>{{ $item->nama_project }}</td>
                        <td>{{ $item->nama_client }}</td>
                        <td>{{ $item->nama_eu }}</td>
                        <td>{{ $item->nominal_po }}</td>
                        <td>{{ $item->nama_sbu }}</td>
                        <td>{{ $item->nama_pic }}</td>
                        <td>{{ $item->pic_business_channel }}</td>
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