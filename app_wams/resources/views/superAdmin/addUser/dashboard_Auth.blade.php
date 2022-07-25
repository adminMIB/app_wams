@extends('layouts.main')
@section('content')
   
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>User Management</h1>
        </div>


        <div class="card-body">
          <div class="card-body">
            <div class="text-right">
                <a href="{{route('/dashboard/addUser')}}" class="btn btn-primary">Add user</a>
            </div>
            <table class="table table-hover mt-2">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Name</th>
                      <th class="text-white" scope="col">Email</th>
                      <th class="text-white" scope="col">Role</th>
                      <th class="text-white" scope="col">action</th>
                      </tr>
                  </thead>
                  @foreach ($user as $dd)
                  <tbody>
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$dd->name}}</td>
                      <td>{{$dd->email}}</td>
                      
                      @foreach($dd->roles as $d)
                      <td>{{$d->name}}</td>
                      @endforeach
                      <td>
                        <a href={{url('/editUser', $dd->id)}}>Edit</a> |
                        <a href="{{url('/dashboard/deleteUser',$dd->id)}}">Delete</a>
                      </td>
                    </tr>
                  </tbody>
                  @endforeach
            </table>
        </div>
        </div>
      </div>
    </section>
@endsection
      



