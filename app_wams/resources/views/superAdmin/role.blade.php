@extends('layouts.main')
@section('content')
   
    <section class="section">
      <div class="section-header">
        <h1>List Role</h1>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="text-right">
              <a href="{{route('/dashboard/addRole')}}" class="btn btn-primary">Add Role</a>
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped mt-2">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Role</th>
                  <th scope="col">Permissions</th>
                  <th scope="col"></th>
                  <th scope="col">action</th>
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
                    <a  onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" href="{{url('/dashboard/deleteRole',$d->id)}}">Delete</a>
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
      



