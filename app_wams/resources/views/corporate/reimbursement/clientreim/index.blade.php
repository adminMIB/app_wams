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
                <h2 class="text-capitalize">Client</h2>
            </div>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <a href="{{ route('clientcreate') }}" class="btn btn-primary">Create</a>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered " id="table1">
                <thead>
                    <tr align="center" style="font-size: 13px">
                        <th>No</th>
                        <th>Nama Client</th>
                        <th>Alamat Client</th>
                        <th>Nama PIC</th>
                        <th>Jabatan PIC</th>
                        <th>Email PIC</th>
                        <th>Nomor HP</th>
                        <th>Nomor Telephone</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($cstmr as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->nama_pic }}</td>
                        <td>{{ $item->jabatan_pic }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>{{ $item->no_telp }}</td>
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