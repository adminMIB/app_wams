@extends('layouts.main')
@section('content')
<table class="table">
  <h1 style="color: black; margin-left: 10px; margin-top:10px">List View Work Order</h1>
  <thead>
    <tr>
      <th scope="col">No Work Order</th>
      <th scope="col">Kode Project</th>
      <th scope="col">Tanggal WO</th>
      <th scope="col">Nama Institusi</th>
      <th scope="col">Nama Project</th>
      <th scope="col">Nama Sales</th>
      <th scope="col">HPS</th>
    </tr>
  </thead>

  <tbody>

    @foreach ($cb as $item)
    @if($item->status =='Approve')
    @if (Auth::user()->id == $item->signPm_lead)
    <tr>
      <td>{{$item->no_so}}</td>
      <td>B{{$item->kode_project}}</td>
      <td>{{$item->tgl_so}}</td>
      <td>{{$item->institusi}}</td>
      <td>{{$item->project}}</td>
      <td>{{$item->name_user}}</td>
      <td>{{$item->hps}}</td>
    </tr>
    @endif
    @endif
    @endforeach
  </tbody>
</table>
@endsection