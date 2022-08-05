@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h2>List View Project</h2>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead>
                    <tr align="center">
                        <th>No Work Order</th>
                        <th>Tanggal WO</th>
                        <th>Kode Project</th>
                        <th>Nama Institusi</th>
                        <th>Nama Project</th>
                        <th>Nama Sales</th>
                        <th>HPS</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($cb as $item)
                    @if (Auth::user()->id == $item->sign_pm)
                    <tr align="center">
                        <td>{{$item->no_sales}}</td>
                        <td>{{$item->tgl_sales}}</td>
                        <td>B{{$item->kode_project}}</td>
                        <td>{{$item->nama_institusi}}</td>
                        <td>{{$item->nama_project}}</td>
                        <td>{{$item->nama_sales}}</td>
                        <td>{{$item->hps}}</td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



</section>
@endsection