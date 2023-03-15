@extends('layouts.main')
@section('content')
<section class="section">
  <div class="section-header">
    <h1>Create Elearning</h1>
  </div>
  <a href="{{route ('elearning')}}"> <button type="submit" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left"></i> Back</button></a>
  <hr>
  <div class="card">
    <div class="card-body">
      <form action="{{route('Esimpan-data')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="mb-2 row">
                    <label for="" class="col-sm-3 col-form-label">Solution/Product</label>
                    <div class="col-sm-8">
                        <select name="produk" class="@error('produk') is-invalid @enderror form-control">
                            <option value="" disabled selected hidden>Product</option>
                            @foreach($produk as $item)
                            <option value="{{$item->produk}}">{{$item->produk}}</option>
                            @endforeach
                       
                    </select>
                     @error('produk')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
        <div class="mb-2 row">
                    <label for="" class="col-sm-3 col-form-label">Principal</label>
                    <div class="col-sm-8">
                        <select name="principle" class="@error('principle') is-invalid @enderror form-control">
                            <option value="" disabled selected hidden>Principal</option>
                            @foreach($principal as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                            @endforeach
                       
                    </select>
                     @error('principle')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>
        <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label">Description Solution</label>
          <div class="col-sm-8">
            <textarea name="deskripsi" id="" cols="40" rows="20" class="form-control @error('deskripsi') is-invalid @enderror" style="height: 100px;" placeholder="Deskripsi"></textarea>
            @error('deskripsi')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>
      
        <div class="row mb-5">
          <label for="" class="col-sm-3 col-form-label">Upload Document</label>
          <div class="col-sm-8">
            <input type="file" class="form-control @error('upload') is-invalid @enderror" name="upload">
            @error('upload')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
        </div>
        <div class="row mb-3">
          <label for="" class="col-sm-3 col-form-label">Implementation Experience</label>
          <div class="col-sm-8">
            <textarea name="implementasi[]" id="" cols="40" rows="20" class="form-control" style="height:100px ;" placeholder="Pengalaman Implementasi Produk"></textarea>
          
          </div>
        </div>
        <div class="learn"></div>
        <button type="submit" class="btn btn-success">Save</button>
        
       
 
      </form>
      <br>
   
      <a href="#"><button id="addlearn" type="submit" class="addlearn btn btn-success btn-sm" style="float:right ;">Plus</button></a>
      
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
    var learn = "<div class='row mb-3'><label for=''class='col-sm-3 col-form-label'>Pengalaman Implementasi</label><div class='col-sm-8'><textarea name='implementasi[]' id='' cols='40' rows='20' class='form-control @error('implementasi[]') is-invalid @enderror' style='height:100px ;' placeholder='Pengalaman Implementasi Produk'></textarea><a href='#' class='remove btn btn-danger'style='float:right;'><i class='fas fa-trash'></i></a></div></div>";
    $('.learn').append(learn);
  };
  $('.remove').live('click', function() {
    $(this).parent().parent().remove();
  });
</script>
@endsection