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
            <form method="GET" action="/telearning">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search" name="cari">
                <div class="input-group-btn">
                  <button class="btn btn-primary"><i class="fas fa-search"></i></button>
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
                  <th scope="row">{{$item->produk}}</th>
                  <td>{{$item->principle}}</td>
                  <td>{{$item->deskripsi}}</td>
                  <td>{{$item->implementasi}}</td>
                  <td>
                    <a href="dokumen/{{$item->upload}}">{{$item->upload}}</a>
                  </td>
                  <td>
                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-dark" href="#" role="button" data-toggle="dropdown">
                      ...
                    </a>
                    <div class="dropdown-menu dropdown-menu-right text-center" aria-labelledby="navbarDropdown">
                      <a href="{{url ('edit', $item->id)}}" style="color: black;"><button type="submit" class="btn btn-primary btn-sm"> <i class="fas fa-pen nav-icon"></i></button> </a>
                      <a href="{{url ('delete', $item->id)}}" style="color: black ;"><button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash nav-icon"></i></button></a>
                      <a href="dokumen/{{$item->upload}}"><button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-download nav-icon"></i></button></a>

                </tr>
              </tbody>
              @endforeach
            </table>
         
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
@endsection