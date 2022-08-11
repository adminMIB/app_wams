@extends('layouts.main')
@section('content')
@include('sweetalert::alert')
<section class="section">
    <h1 style="color: black; margin-left: 10px; margin-top:10px"></h1>
</section>

<!-- Table Report -->
<div class="card" style="border-radius: 2em">
    <div class="card-header">
        <h4>List View Project</h4>

        <div class="card-header-form">
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Project</th>
                        <th>Nama Institusi</th>
                        <th>Nama Project</th>
                        <th>Nama AM</th>
                        <th>HPS</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($lt as $item)
                    @if (Auth::user()->name == $item->nama_technical)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>B{{$item->lists->kode_project}}</td>
                        <td>{{$item->lists->nama_institusi}}</td>
                        <td>{{$item->lists->nama_project}}</td>
                        <td>{{$item->lists->nama_sales}}</td>
                        <td>{{$item->lists->hps}}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- Akhir Table Report -->
@endsection