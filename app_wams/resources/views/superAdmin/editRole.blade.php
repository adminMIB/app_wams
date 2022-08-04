@extends('layouts.main')
@section('content')
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>Welcome</h1>
        </div>
        <div class="card-body">
          <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
              <div class="card-header">
                <h4>Role</h4>
              </div>
              <div class="card-body">
                <form action="{{route('/dashboard/updateEdit', $getid->id)}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                <div class="form-group mb-2">
                      <label>Edit Role</label>
                      <input type="text" name="name" class="form-control" value="{{$getid->name}}">
                      {{-- permissions --}}
                      <p class="text-danger mt-2">Old permissions:</p>
                    <div class="form-group">
                      @foreach ($getid->permissions as $ermission)
                      {{-- <option value="{{$role->name}}">{{$role->name}}</option> --}}
                      <div class="d-flex bg-light p-3">
                            <p>{{$ermission->name}}</p>
                      </div>
                        @endforeach
                      <hr />
                      <p>New Permissions</p>
                        @foreach ($permisions as $permision)
                        <div class="mb-1">
                            <input type="checkbox" name="names[]" value="{{$permision->name}}">
                            <label class="form-check-label" name="names" for="defaultCheck1" style="font-size: 12px">
                              {{$permision->name}}
                            </label>
                        </div>
                          @endforeach

                    </div>
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

