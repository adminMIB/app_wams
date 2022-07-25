@extends('layouts.main')
@section('content')
   
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>Add User</h1>
        </div>
        <div class="card-body">


          {{-- add role --}}
          <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-header">
                <h4>Add User</h4>
              </div>
              <div class="card-body">
                <form action="{{route('/dashboard/saveUser')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                  {{-- name --}}
                <div class="form-group">
                  <label>name</label>
                  <input type="text" name="name" class="form-control">
                </div>
                {{-- email --}}
                <div class="form-group">
                  <label>email</label>
                  <input type="email" name="email" class="form-control">
                </div>
                {{-- password--}}
                <div class="form-group">
                  <label>password</label>
                  <input type="password" name="password" class="form-control">
                </div>
                {{-- role --}}
                <div class="form-group">
                  <p>Select Role</p>
                <select class="custom-select mb-3"  name="names" id="inputGroupSelect01">
                    @foreach ($role as $r)
                  <option value="{{$r->name}}">{{$r->name}}</option> --}}
                    @endforeach
                  </select>
                </div>
                <button class="btn btn-primary">Kirim</button>
                </form>
              </div>
            </div>
          
          </div>
            
        </div>
      </div>
    </section>
@endsection
      



