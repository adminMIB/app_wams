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
    <!-- {{route('/dashboard/saveUser')}} -->
      <form action="{{route('update-data', $ele->id)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        {{csrf_field()}}
        <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label text-dark">Solusi / Produk</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="produk" value="{{$ele->eles->produk}}">
          </div>
        </div>
        <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label text-dark">Principle</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" name="principle" value="{{$ele->eles->principle}}">
          </div>
        </div>
        <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label text-dark">Deskripsi Solusi</label>
          <div class="col-sm-8">
            <textarea name="deskripsi" id="" cols="40" rows="20" class="form-control" style="height: 100px;">{{$ele->eles->deskripsi}}</textarea>
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
            <input class="form-control" name="upload" value="{{$ele->eles->upload}}" readonly>
          </div>
        </div>
        <div class="row mb-5">
          <label for="" class="col-sm-3 col-form-label text-dark">Upload Dokumen Baru</label>
          <div class="col-sm-8">
            <input type="file" class="form-control" name="upload">
          </div>
        </div>
        <!-- <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label text-dark">Pengalaman Implementasi</label>
          <div class="col-sm-8">
            <textarea name="implementasi[]" id="" cols="40" rows="20" class="form-control" style="height:100px ;">{{$ele->implementasi}}</textarea>
            <a href='#' class='remove btn btn-danger'style='float:right;'><i class='fas fa-trash'></i></a>
          </div>
       
        </div> -->
        <div class="learn"></div>
   
        <button type="submit" class="btn btn-primary">Update</button>
      </form>
      <br>
   
  
   
</section>
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
  $('.addlearn').on('click', function() {
    addlearn();
  });

  function addlearn() {
    var learn = "<div class='row mb-3'><label for=''class='col-sm-3 col-form-label text-dark'>Pengalaman Implementasi</label><div class='col-sm-8'><textarea name='implementasi' id='' cols='40' rows='20' class='form-control @error('implementasi[]') is-invalid @enderror' style='height:100px ;' placeholder='Pengalaman Implementasi Produk'></textarea><a href='#' class='remove btn btn-danger'style='float:right;'><i class='fas fa-trash'></i></a></div></div>";
    $('.learn').append(learn);
  };
  $('.remove').live('click', function() {
    $(this).parent().parent().remove();
  });
</script>
@endsection