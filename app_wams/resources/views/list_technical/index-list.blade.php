@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h2>List Project Technikal</h2>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <div class="card-header-form">

                <div class="input-group">
                    <a class="btn btn-primary" href="{{route('listproject')}}" type="submit">Create</a>

                </div>

            </div>
        </div>
        <div class="card-body  p-0">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr align="center">
                            <th>Kode Project</th>
                            <th>Nama Client</th>
                            <th>Nama Project</th>
                            <th>Dokumen</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @foreach($tk as $t)
                        <tr align="center">
                            <td>{{$t->kode_project}}</td>
                            <td>{{$t->nama_institusi}}</td>
                            <td>{{$t->nama_project}}</td>
                            <td>
                            <a href="upload_dokumen/{{$t->upload_dokumen}}">{{$t->upload_dokumen}}</a>
                            </td>
                            <td>
                                <a href="{{url ('list-delete',$t->id)}}"><button type="submit" class="btn btn-danger" style="border-radius:3em ;">Delete</button></a>
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