@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>List Project Timeline</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <a href="{{route('input')}}"><button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Create</button></a>

                <hr>
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Nama Client</th>
                        <th>Nama Project</th>
                        <th>Timeline</th>
                        <th>Technikal</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $id)
                    <tr align="center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$id->lists->institusi}}</td>
                        <td>{{$id->lists->project}}</td>
                        <td>{{$id->start_date}} - {{$id->finish_date}}</td>
                        <td>{{ $id->nama_technical }}</td>
                        <td>
                            <a href="{{route('detail_timeline',$id->id)}}"><button type="submit" class="btn btn-warning ">Detail</button></a>
                            <button type="submit" class="btn btn-primary ">Edit</button>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>



</section>
@endsection
