@extends('layouts.main')
@section('content')
   
    <section class="section">
      <h1 class="text-center mb-5">Edit Data Customer</h1>
      <div class="card">
        <div class="card-header">
        </div>

        <div class="card-body">
          <form action="{{ route('/customer/update', $editData->id) }}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                  {{-- name --}}
                <div class="form-group">
                  <label>Customer Name</label>
                  <input type="text" name="namaCustomer" class="form-control" value="{{$editData->nama}}" autofocus>
                </div>
                {{-- email --}}
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" value="{{$editData->email}}">
                </div>
                {{-- no tlp --}}
                <div class="form-group">
                  <label>No Telepone</label>
                  <input type="text" name="noTelephone" class="form-control" placeholder=""  value="{{$editData->no_telp}}">
                </div>
                {{-- alamt --}}
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" name="alamat" class="form-control" placeholder=""  value="{{$editData->alamat}}">
                </div>
                {{-- role --}}
                <div class="d-flex  justify-content-between mt-5">
                  <a href="{{ url('/customer') }}" class="btn btn-md btn-primary text-white">Back</a>
                  <button type="submit" class="btn btn-danger btn-md">Submit</button>
                </div>    
              </form>
            </div>
          </div>
          {{-- <a href="/dashboard/user" class="btn btn-secondary btn-lg d-block mt-2">Kembali</a> --}}
    </section>
@endsection
      



