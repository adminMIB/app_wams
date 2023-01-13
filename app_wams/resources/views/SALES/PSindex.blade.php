@extends('layouts.main')
@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Product / Solution</h1>
        </div>
        <div class="card">
            <div class="card-body">
            <div class="text-right mb-2">
                <a href="{{ route('pscreate') }}" class="btn btn-icon icon-left btn-primary"><i class="far fa-plus"></i> Tambah Produk/Solusi</a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-md">
                <tbody>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Principal</th>
                        <th>Distributor</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($data_prosol as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->principal }}</td>
                        <td>{{ $item->distributor }}</td>
                        <td>
                            <a href="{{route ('psedit', $item->id)}}" class="btn btn-info"><i class="far fa-edit"></i></a>
                            <a href="{{route ('psdelete', $item->id)}}" class="btn btn-danger"><i class="fas fa-times"></i></a>
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