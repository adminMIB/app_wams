@extends('layouts.main')
@section('content')

<section class="section">
  <div class="card">
    <div class="card-header">
      <h1>Input Work Orders</h1>
    </div>
    <div class="card-body">
      <form action="#" method="post" enctype="multipart/form-data">
      {{-- cek jika status pending jangan ditampilkan --}}
   
            
      
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">No Sales Order</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="no_doc" id="inputEmail3" value="">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail2" class="col-sm-3 col-form-label">Tanggal Sales Order</label>
            <div class="col-sm-9">
            <input type="date" class="form-control" name="tgl_up" id="inputEmail2">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label"></label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="institusi" id="inputEmail3" placeholder="Institusi">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Institusi</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="institusi" id="inputEmail3" placeholder="Institusi">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Nama Project</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" name="project" id="inputEmail3" placeholder="Project">
            </div>
        </div>
      
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">HPS</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="editor" id="inputEmail3" placeholder="editor name">
            </div>
        </div>
        <div class="form-group row">
          <label for="inputEmail5" class="col-sm-3 col-form-label">Sign to WO</label>
          <div class="col-sm-9">
            <select class="form-control select2" style="width: 100%;" name="jenis_doc" id="inputEmail5">
              <option value="Dok PO">Dok PO</option>
              <option selected="selected" value="Dok Penawaran">Dok Penawaran</option>
              <option value="Dok BAST">Dok BAST</option>
            </select>
          </div>
        </div>
        <div class="text-right">
            <button class="btn btn-info" type="submit">Upload</button>
            <a href="#" class="btn btn-danger">Kembali</a>
        </div>
      </form>


    </div>
  </div>
</section>
@endsection