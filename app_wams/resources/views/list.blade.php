@extends('layouts.main')
@section('content')
<table class="table">
  <h1 style="color: black; margin-left: 10px; margin-top:10px">List View Work Order</h1>
  <thead>
    <tr>
      <th scope="col">No Work Order</th>
      <th scope="col">Tanggal WO</th>
      <th scope="col">Nama Institusi</th>
      <th scope="col">Nama Project</th>
      <th scope="col">Quantity</th>
      <th scope="col">Nama Sales</th>
      <th scope="col">HPS</th>
    </tr>
  </thead>

  <tbody>
    
    @foreach ($cb as $item)
    @if (Auth::user()->id == $item->sign_pm_lead)
    <tr>
      <td>{{$item->no_sales}}</td>
      <td>{{$item->tgl_sales}}</td>
      <td>{{$item->nama_institusi}}</td>
      <td>{{$item->nama_project}}</td>
      <td>-</td>
      <td>{{$item->nama_sales}}</td>
      <td>{{$item->hps}}</td>
    </tr>
    @endif
    @endforeach
  </tbody>
</table>
@endsection