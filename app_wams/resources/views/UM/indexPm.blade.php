@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h2>Report Timeline</h2>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <div class="card-header-form">
                <form action="" method="GET">
                </form>
            </div>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>Client Name</th>
                        <th>Project Name</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($rp as $id)
                    <tr align="center">
                        <td>{{ $id->kode_project }}</td>
                        <td>{{$id->nama_institusi}}</td>
                        <td>{{$id->nama_project}}</td>
                        <td>
                            <a href="{{url('umShowpm',$id->id)}}"><button type="submit" class="btn btn-info" style="border-radius:3em ;">Detail</button></a>
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