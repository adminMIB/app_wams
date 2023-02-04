@extends('layouts.main')
@section('content')
   
    <section class="section">
      <h1 class="text-center mb-5">Detail Customer</h1>
      <div class="card">
        <div class="card-header">
        </div>

        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data"> 
                  @method('put')
                  {{csrf_field()}}
                <div class="form-group mb-4">
                  <label class="mb-2">Customer Name</label>
                  <input type="text" name="namaClient" class="form-control" value="{{$detailId->nama}}" autofocus readonly>
                </div>
                <div class="form-group mb-4">
                  <label class="mb-2">PIC Name</label>
                  <input type="text" name="namaClient" class="form-control" value="{{$detailId->pic_name}}" autofocus readonly>
                </div>
                <div class="form-group mb-4">
                  <label class="mb-2">Position</label>
                  <input type="text" name="namaProject" class="form-control" value="{{$detailId->position}}" autofocus readonly>
                </div>
                <div class="form-group mb-4">
                  <label class="mb-2">No Telephone</label>
                  <input type="text" name="namaProject" class="form-control" value="{{$detailId->no_telp}}" autofocus readonly>
                </div>
                <div class="form-group mb-4">
                  <label class="mb-2">Email</label>
                  <input type="email" name="namaClient" class="form-control" value="{{$detailId->email}}" autofocus readonly>
                </div>
                <div class="form-group mb-4">
                  <label class="mb-2">Influencer Name</label>
                  <input type="text" name="namaProject" class="form-control" value="{{$detailId->influencer_name}}" autofocus readonly>
                </div>
                <div class="form-group mb-4">
                  <label class="mb-2">Influencer Position</label>
                  <input type="text" name="namaProject" class="form-control" value="{{$detailId->influencer_position}}" autofocus readonly>
                </div>
                <div class="form-group mb-4">
                  <label class="mb-2">Telp Influencer</label>
                  <input type="text" name="namaProject" class="form-control" value="{{$detailId->telp_influencer}}" autofocus readonly>
                </div>
                <div class="form-group mb-4">
                  <label class="mb-2">Influencer Email</label>
                  <input type="text" name="namaProject" class="form-control" value="{{$detailId->influencer_email}}" autofocus readonly>
                </div>
                
                
                
                <div class="d-flex  justify-content-between mt-5">
                  {{-- <a href="{{url('/adminprojectShowEdit', $detailId->id)}}" class="btn btn-md btn-danger text-white">Kembali</a> --}}
                  <a href="{{ url('/customer') }}" class="btn btn-md btn-primary text-white">Back</a>
                </div>

            </form> 
              </div>
      </div>
    </section>
@endsection