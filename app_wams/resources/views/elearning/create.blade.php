@extends('layouts.main')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>Create Elearning</h1>
  </div>
  <a href="{{route ('elearning')}}"> <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i> Back</button></a>
  <hr>
  <div class="card">
    <div class="card-body">
      <form action="{{route('Esimpan-data')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label text-dark">Solusi / Produk</label>
          <div class="col-sm-8">
            <input type="text" class="form-control @error('produk') is-invalid @enderror" name="produk" placeholder="Solusi/Produk">
            @error('produk')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label text-dark">Principle</label>
          <div class="col-sm-8">
            <input type="text" class="form-control  @error('principle') is-invalid @enderror" name="principle" placeholder="Principle">
            @error('principle')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label text-dark">Deskripsi Solusi</label>
          <div class="col-sm-8">
            <textarea name="deskripsi" id="" cols="40" rows="20" class="form-control @error('deskripsi') is-invalid @enderror" style="height: 100px;" placeholder="Deskripsi"></textarea>
            @error('deskripsi')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>
      
        <div class="row mb-5">
          <label for="" class="col-sm-3 col-form-label text-dark">Upload Dokumen</label>
          <div class="col-sm-8">
            <input type="file" class="form-control @error('upload') is-invalid @enderror" name="upload">
            @error('upload')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label text-dark">Pengalaman Implementasi</label>
          <div class="col-sm-8">
            <textarea name="implementasi[]" id="" cols="40" rows="20" class="form-control" style="height:100px ;" placeholder="Pengalaman Implementasi Produk"></textarea>
          
          </div>
        </div>
        <div class="learn"></div>
        <button type="submit" class="btn btn-primary">Save</button>
        
       
 
      </form>
      <br>
   
      <a href="#"><button id="addlearn" type="submit" class="addlearn btn btn-success btn-sm" style="float:right ;">Tambah</button></a>
      
    </div>
  </div>
</section>
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
  $('.addlearn').on('click', function() {
    addlearn();
  });

  function addlearn() {
    var learn = "<div class='row mb-3'><label for=''class='col-sm-3 col-form-label text-dark'>Pengalaman Implementasi</label><div class='col-sm-8'><textarea name='implementasi[]' id='' cols='40' rows='20' class='form-control @error('implementasi[]') is-invalid @enderror' style='height:100px ;' placeholder='Pengalaman Implementasi Produk'></textarea><a href='#' class='remove btn btn-danger'style='float:right;'><i class='fas fa-trash'></i></a></div></div>";
    $('.learn').append(learn);
  };
  $('.remove').live('click', function() {
    $(this).parent().parent().remove();
  });
</script>
@endsection