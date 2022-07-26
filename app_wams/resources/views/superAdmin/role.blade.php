@extends('layouts.main')
@section('content')
   
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>List Role</h1>
        </div>
        <div class="card-body">
            <div class="text-right">
                <a href="{{route('/dashboard/addRole')}}" class="btn btn-primary">Add Role</a>
            </div>
            <table class="table table-hover mt-2">
                <thead style="background-color: #12406c;">
                    <tr>
                      <th class="text-white" scope="col">No</th>
                      <th class="text-white" scope="col">Role</th>
                      <th class="text-white" scope="col">Permissions</th>
                      <th class="text-white" scope="col"></th>
                      <th class="text-white" scope="col">action</th>

                      </tr>
                  </thead>
                  @foreach ($role as $d)
                  <tbody>              
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td >{{$d->name}}</td>
                      @foreach ($d->permissions as $item) 
                      <td colspan="3" class="d-flex flex-col mt-2">
                        <p class="text-danger">{{$item->name}}</p>
                      </td>
                      @endforeach
                      <td></td>
                  
                        <td  colspan="4">
                          <a href="{{url('/editRole',$d->id)}}">Edit</a> |
                          <a href="{{url('/dashboard/deleteRole',$d->id)}}">Delete</a>
                        </td>
                    
                      </tr>

                  </tbody>
                  @endforeach
            </table>
        </div>
      </div>
    </section>
@endsection
      



