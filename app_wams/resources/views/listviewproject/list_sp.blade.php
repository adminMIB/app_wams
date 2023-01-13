@extends('layouts.main')
@section('title','Project Pipeline')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="alert">
            <h2 style="color: rgb(13, 13, 13)" class="text-capitalize">  Project Pipeline</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped ">
                    <thead>
                        <tr align="center" style="font-size: 13px">
                            <th>Kode Project</th>
                            <th>Nama Client</th>
                            <th>Nama Project</th>
                            <th>Date</th>
                            <th>Estimated Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach ($sp as $item)
                        @if (Auth::user()->name == $item->pmo)
                        <tr align="center" style="font-size: 13px">
                            <td>{{$item->ID_project}}</td>
                            <td>{{$item->NamaClient}}</td>
                            <td>{{$item->NamaProject}}</td>
                            <td>{{$item->Date}}</td>
                            <td>{{$item->estimated_amount}}</td>
                            <td>
                                <a href="{{route('detail_sp',$item->id)}}" class="btn btn-info">Detail</a>
                            </td>
                                {{-- {{$item->file_project}} --}}
                            {{-- <td> <a href="/storage/">{{$item->listpadmin->UploadDocument}}</a></td> --}}
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>



</section>
@endsection