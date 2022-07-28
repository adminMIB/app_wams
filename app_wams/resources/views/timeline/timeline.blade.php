@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>List Project Timeline</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <a href="{{route('input')}}"><button type="submit" class="btn btn-primary btn-sm">Create</button></a>

                <hr>
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Technikal</th>
                        <th>Timeline</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($data as $id)
                    <tr align="center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $id->nama_technical }}</td>
                        <td>{{$id->start_date}} - {{$id->finish_date}}</td>
                        <td>
                            <button type="submit" class="btn btn-warning ">Detail</button>
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