@extends('layouts.main')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>Edit Elearning</h1>
  </div>
  <a href="{{route ('elearning')}}"> <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i> Back</button></a>
  <hr>
  <div class="card">
    <div class="card-body">
      <form action="{{route ('update-data',$ele->id)}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label text-dark">Solusi / Produk</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="produk" value="{{$ele->produk}}">
          </div>
        </div>
        <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label text-dark">Principle</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="principle" value="{{$ele->principle}}">
          </div>
        </div>
        <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label text-dark">Deskripsi Solusi</label>
          <div class="col-sm-8">
            <textarea name="deskripsi" id="" cols="40" rows="20" class="form-control" style="height: 100px;">{{$ele->deskripsi}}</textarea>
          </div>
        </div>
        <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label text-dark">Pengalaman Implementasi</label>
          <div class="col-sm-8">
            <textarea name="implementasi" id="" cols="40" rows="20" class="form-control" style="height:100px ;">{{$ele->implementasi}}</textarea>
          </div>
        </div>
        <div class="row mb-5">
          <label for="" class="col-sm-3 col-form-label text-dark">Dokumen</label>
          <div class="col-sm-8">
            <input class="form-control" name="upload" value="{{$ele->upload}}" readonly>
          </div>
        </div>
        <div class="row mb-5">
          <label for="" class="col-sm-3 col-form-label text-dark">Upload Dokumen Baru</label>
          <div class="col-sm-8">
            <input type="file" class="form-control" name="upload">
          </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
</section>
@endsection