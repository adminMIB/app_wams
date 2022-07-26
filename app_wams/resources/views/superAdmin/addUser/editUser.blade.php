@extends('layouts.main')
@section('content')
   
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>Edit User</h1>
        </div>

        <div class="card-body">
          <form action="{{route('/dashboard/updateUser', $getid->id)}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                  {{-- name --}}
                <div class="form-group">
                  <label>name</label>
                  <input type="text" name="name" class="form-control" value="{{$getid->name}}" autofocus>
                </div>
                {{-- email --}}
                <div class="form-group">
                  <label>email</label>
                  <input type="email" name="email" class="form-control" value="{{$getid->email}}">
                </div>
                {{-- password--}}
                <div class="form-group">
                  <label>password</label>
                  <input type="password" name="password" class="form-control" placeholder="new password">
                </div>
                {{-- role --}}
                <div class="form-group">
                    @foreach ($getid->roles as $role)
                  {{-- <option value="{{$role->name}}">{{$role->name}}</option> --}}
                  <P><span class="text-danger mr-2 font-bold">Old Role:</span> {{$role->name}}</P>
                    @endforeach
                    
                  <select class="custom-select mb-3" name="names" id="inputGroupSelect01">
                    @foreach ($allRole as $role)
                  <option value="{{$role->name}}">{{$role->name}}</option> --}}
                    @endforeach
                  </select>

                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
              </div>
      </div>
    </section>
@endsection
      



