@extends('layouts.main')
@section('content')
<style>
  .card-header-action {
    margin-left: 70%;
  }
</style>
<section class="section">
  <div class="section-header">
    <h1>List Elearning</h1>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <a href="{{route ('create-elearning')}}"> <button type="submit" class="btn btn-primary btn-sm">Create</button></a>
          <div class="card-header-action">
            <form method="GET" action="/search">
             
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-striped table-md" >
              <thead>
                <tr>
                  <th>Solusi/Produk</th>
                  <th>Principle</th>
                  <th>Deskripsi Produk</th>
                  <th>Pengalaman</th>
                  <th>Dokumen Datasheet</th>
                  <th>Action</th>
                </tr>
              </thead>
              @foreach($ele as $item)
              <tbody>
                <tr>
                  <th scope="row">{{$item->eles->produk}}</th>
                  <td>{{$item->eles->principle}}</td>
                  <td>{{$item->eles->deskripsi}}</td>
                  <td>{{$item->implementasi}}</td>
                  <td>
                    <a href="dokumen/{{$item->eles->upload}}">{{$item->eles->upload}}</a>
                  </td>
                  <td>
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown">
                      ...
                    </a>
                    <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
                      <a href="{{url ('edite', $item->id)}}" style="color: black;"><button type="submit" class="btn btn-primary btn-sm"> <i class="fas fa-pen nav-icon"></i></button> </a>
                      <a href="{{url ('delete', $item->id)}}" style="color: black ;"><button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash nav-icon"></i></button></a>
                     

                </tr>
              </tbody>
              @endforeach
            </table>
            <div class="card-footer d-flex justify-content-end">
        {{ $ele->links() }}
        </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
@endsection