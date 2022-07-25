@extends('layouts.main')
@section('content')
   
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>List permision</h1>
        </div>

        <div class="card-body">
          <div class="text-right">
              <a href="{{route('/dashboard/addPermission')}}" class="btn btn-primary">Add Permission</a>
          </div>
          <table class="table table-hover mt-2">
              <thead style="background-color: #12406c;">
                  <tr>
                    <th class="text-white" scope="col">No</th>
                    <th class="text-white" scope="col">Permission</th>
                    <th class="text-white" scope="col">action</th>
                    </tr>
                </thead>
                @foreach ($permission as $d)
                <tbody>
                  <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$d->name}}</td>
                    <td>
                      
                      <a href="{{url('/editPermission',$d->id)}}">Edit</a> |
                      <a href="{{url('/dashboard/deletePermission',$d->id)}}">Delete</a>
                    </td>
                  </tr>
                </tbody>
                @endforeach
          </table>
      </div>
      
      </div>
    </section>
@endsection
      



