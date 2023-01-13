@extends('layouts.main')
@section('content')
   
    <section class="section">
      <div class="section-header">
        <h1>List permision</h1>
      </div>
      <div class="card">

        <div class="card-body">
          <div class="text-right">
              {{-- <a href="{{route('/dashboard/addPermission')}}" class="btn btn-primary">Add Permission</a> --}}
          </div>
          <div class="table-responsive">
            <table class="table table-hover table-bordered table-striped mt-2">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Permission</th>
                  <th scope="col">action</th>
                  </tr>
              </thead>
              @foreach ($permission as $d)
              <tbody>
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$d->name}}</td>
                  <td>
                    
                    <a href="{{url('/editPermission',$d->id)}}">Edit</a> |
                    <a  onClick="javascript: return confirm('Apahkah Anda Ingin Menghapusnya?');" href="{{url('/dashboard/deletePermission',$d->id)}}">Delete</a>
                  </td>
                </tr>
              </tbody>
              @endforeach
            </table>
          </div>
      </div>
      
      </div>
    </section>
@endsection
      



