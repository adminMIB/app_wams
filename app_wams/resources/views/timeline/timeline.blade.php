@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h2>List Project Timeline</h2>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <div class="card-header-form">
                <form action="/timeline" method="GET">
                    <div class="input-group">
                        <a class="btn btn-primary" href="{{route('input')}}" type="submit">Create</a>
                        <input type="text" class="form-control" style="margin-left:6px" placeholder="Search" name="search">
                        <br>
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="submit"> <i class="fas fa-search"></i> </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body  p-0">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Nama Client</th>
                        <th>Nama Project</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody>
                    @foreach ($time as $id)
                    <tr align="center">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$id->nama_institusi}}</td>
                        <td>{{$id->nama_project}}</td>
                        <td>
                            <a href="{{route('detail_timeline',$id->id)}}"><button type="submit" class="btn btn-success" style="border-radius:3em ;">Detail</button></a>
                            <a href="{{route('edittml', $id->id)}}"><button type="submit" class="btn btn-primary" style="border-radius: 3em;">Edit</button></a>
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