@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <div class="alert">
            <h2 style="color: rgb(13, 13, 13)" class="text-capitalize"> List View Project LTO</h2>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped ">
                    <thead>
                        <tr align="center">
                            <th>Kode Project</th>
                            <th>Nama Client</th>
                            <th>Nama Project</th>
                            <th>Date</th>
                            <th>Estimated Amount</th>
                            <th>Dokumen</th>
                            <th>Action</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach ($bc as $item)
                        @if (Auth::user()->name == $item->pmo)
                        <tr align="center">
                            <td>{{$item->kode_project}}</td>
                            <td>{{$item->institusi}}</td>
                            <td>{{$item->project}}</td>
                            <td>{{$item->tgl_so}}</td>
                            <td>{{$item->estimated_amount}}</td>
                            <td>
                                @foreach ($item->file_dokumens as $i)
                                @foreach (explode("," , $i->file_name) as $a) 
                                <a href="storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                                @endforeach
                                @endforeach
                            </td>
                            <td>
                                <a href="{{route('detail_so',$item->id)}}" class="btn btn-info">Detail</a>
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