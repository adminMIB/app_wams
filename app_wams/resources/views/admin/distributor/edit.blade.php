@extends('layouts.main')
@section('content')
   
    <section class="section">
      <h1 class="text-center mb-5">Edit Data Distibutor</h1>
      <div class="card">
        <div class="card-header">
        </div>

        <div class="card-body">
          <form action="{{ route('/updateDisti', $editData->id) }}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}
                  {{-- name --}}
                <div class="form-group">
                  <label>Distibutor</label>
                  <input type="text" name="distributor" class="form-control" value="{{$editData->distributor}}" autofocus>
                </div>
                {{-- email --}}
                <div class="form-group">
                  <label>email</label>
                  <input type="email" name="email" class="form-control" value="{{$editData->email}}">
                </div>
                {{-- no tlp --}}
                <div class="form-group">
                  <label>No Telephone</label>
                  <input type="text" name="noTelephone" class="form-control" placeholder=""  value="{{$editData->no_telp}}">
                </div>
                {{-- alamt --}}
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" name="alamat_disti" class="form-control" placeholder=""  value="{{$editData->alamat_disti}}">
                </div>
                {{-- role --}}
                <button class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
          <a href="/disti" class="btn btn-secondary btn-lg d-block mt-2">Back</a>
    </section>
@endsection
      



