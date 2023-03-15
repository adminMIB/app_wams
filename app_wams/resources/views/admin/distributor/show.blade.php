@extends('layouts.main')
@section('content')
   
    <section class="section">
      <h1 class="text-center mb-5">Detail Distributor</h1>
      <div class="card">
        <div class="card-header">
        </div>

        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data"> 
                  @method('put')
                  {{csrf_field()}}
                  {{-- Project ID --}}
                <div class="form-group mb-4">
                  <label class="mb-2">Distributor</label>
                  <input type="text" name="namaClient" class="form-control" value="{{$detailId->distributor}}" autofocus readonly>
                </div>
                  {{-- nama client --}}
                <div class="form-group mb-4">
                  <label class="mb-2">Email</label>
                  <input type="text" name="namaClient" class="form-control" value="{{$detailId->email}}" autofocus readonly>
                </div>
                  {{-- nama project --}}
                <div class="form-group mb-4">
                  <label class="mb-2">No Telephone</label>
                  <input type="text" name="namaProject" class="form-control" value="{{$detailId->no_telp}}" autofocus readonly>
                </div>
                <div class="form-group mb-4">
                  <label class="mb-2">Address</label>

                  <input type="text" name="namaProject" class="form-control" value="{{$detailId->alamat_disti}}" autofocus readonly>
                </div>
                
                <div class="d-flex  justify-content-between mt-5">
                  <a href="{{ url('/disti') }}" class="btn btn-md btn-primary text-white">Back</a>
                  <a href="{{url('/adminprojectShowEdit', $detailId->id)}}" class="btn btn-md btn-danger text-white">Edit Data</a>
                </div>

            </form> 
              </div>
      </div>
    </section>
@endsection