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
                  <label class="mb-2">Bank Name</label>
                  <input type="text" name="namaClient" class="form-control" value="{{$detailData->NamaBank}}" autofocus readonly>
                </div>
                <div class="form-group mb-4">
                  <label class="mb-2">Account Number</label>
                  <input type="text" name="namaClient" class="form-control" value="{{$detailData->NoRekg}}" autofocus readonly>
                </div>
                
                <div class="d-flex  justify-content-between mt-5">
                  {{-- <a href="{{url('/adminprojectShowEdit', $detailId->id)}}" class="btn btn-md btn-danger text-white">Kembali</a> --}}
                  <a href="{{ url('/bank') }}" class="btn btn-md btn-primary text-white">Back</a>
                </div>

            </form> 
              </div>
      </div>
    </section>
@endsection