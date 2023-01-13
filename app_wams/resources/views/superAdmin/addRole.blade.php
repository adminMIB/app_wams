@extends('layouts.main')
@section('content')
   
    <section class="section">
      <div class="section-header">
        <h1>Add Role</h1>
      </div>
      <div class="card">
        <div class="card-body">


          {{-- add role --}}
          <div class="col-12 col-md-5 col-lg-5 ">
            <div class="card">
              <div class="card-header">
                <h4>Role</h4>
              </div>

              <div class="card-body">
                <form action="{{route('/dashboard/saveRole')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}

                {{-- <div class="form-group"> --}}
                  <label>New Role</label>
                  <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror">

                  @error('name')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
              {{-- </div> --}}
              
              {{-- read data --}}
              <div class="card-header -ml-2">
                <h4>Add Permissions</h4>
                
              </div>
              <div class="form-check">
                @foreach ($permisions as $permision)
                  <div class="mb-1">
                      <input type="checkbox" name="names[]" value="{{$permision->name}}">
                      <label class="form-check-label " name="name" for="defaultCheck1" style="font-size: 12px">
                        {{$permision->name}}
                      </label>
                  </div>
                    @endforeach
              </div>
              <button class="btn btn-primary mt-5 d-flex ">Kirim</button>
            </form>
            <div>

              <a href="/dashboard/role" class="btn btn-secondary mt-5 d-block flex-end">Kembali</a>
            </div>
              </div>
            </div>
          
          </div>
            
        </div>
      </div>
    </section>
@endsection
      



