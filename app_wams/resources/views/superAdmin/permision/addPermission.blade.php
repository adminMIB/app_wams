@extends('layouts.main')
@section('content')
   
    <section class="section">
      <div class="card">
        <div class="card-header">
          <h1>Add permision</h1>
        </div>
        <div class="card-body">


          {{-- add role --}}
          <div class="col-12 col-md-5 col-lg-5 ">
            <div class="card">
              <div class="card-header">
                <h4>Permission</h4>
              </div>

              <div class="card-body">
                <form action="{{route('/dashboard/savePermission')}}" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}

                {{-- <div class="form-group"> --}}
                  <label>New Permission</label>
                  <input type="text" name="name" class="form-control">
              {{-- </div> --}}
                
                <button class="btn btn-primary mt-5 d-flex flex-end">Kirim</button>
                </form>
              </div>
            </div>
          
          </div>
            
        </div>
      </div>
    </section>
@endsection
      



