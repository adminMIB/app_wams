@extends('layouts.main')
@section('content')
   
    <section class="section">
      <h1 class="text-center mb-5">Edit Data Bank</h1>
      <div class="card">
        <div class="card-header">
        </div>

        <div class="card-body">
          <form action="{{ route('/bank/update', $editData->id) }}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                  {{-- name --}}
                <div class="form-group">
                  <label>Bank name</label>
                  <input type="text" name="namaBank" class="form-control" value="{{$editData->NamaBank}}" autofocus>
                </div>
                {{-- email --}}
                <div class="form-group">
                  <label>Account Number</label>
                  <input type="text" name="NoRekg" class="form-control" value="{{$editData->NoRekg}}">
                </div>
                {{-- no tlp --}}
                <div class="d-flex  justify-content-between mt-5">
                  <a href="{{ url('/bank') }}" class="btn btn-md btn-primary text-white">Back</a>
                  <button type="submit" class="btn btn-danger btn-md">Submit</button>
                </div>    
              </form>
            </div>
          </div>
          {{-- <a href="/dashboard/user" class="btn btn-secondary btn-lg d-block mt-2">Kembali</a> --}}
    </section>
@endsection
      



