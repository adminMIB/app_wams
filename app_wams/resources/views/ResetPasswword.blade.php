@extends('layouts.main')
@section('content')
   
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>Reset Password</h1>
        </div>
        <div class="card-body">


          {{-- add role --}}
          <div class="col-12 col-md-6 col-lg-6">
            <div class="card">
             
              <div class="card-body">
                <form action="{{route('/updatePasswords')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                  {{-- name --}}
                <div class="form-group">
                  <label>Konfirmas Password</label>
                  <input type="password" password="password" name="konfirmasiPassword" class="form-control @error('password') is-invalid @enderror">

                  @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
                {{-- new password --}}
                <div class="form-group">
                  <label>Buat Password Baru</label>
                  <input type="password" name="password" class="form-control @error('new password') is-invalid @enderror">

                  @error('new password')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
                </div>
                {{-- password--}}
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input type="password" name="cek_password" class="form-control @error('password') is-invalid @enderror">

                  @error('password')
                    <div class="invalid-feedback">{{$message}}</div>
                  @enderror
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
      



