@extends('layouts.main')
@section('content')
    <section class="section">
        <div class="card">
          <div class="card-header">
            <h1>Tambah Sales Order</h1>
          </div>
          <div class="card-body">
            <form action="#" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="row">
                <div class="column col-4">
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Institusi</label>
                      <input type="text" class="form-control" name="institusi" id="exampleInputEmail1" placeholder="Institusi">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Nama Project</label>
                      <input type="text" class="form-control" name="project" id="exampleInputEmail1" placeholder="Project">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">Editor</label>  
                      <input type="text" class="form-control" name="editor" id="exampleInputEmail1" placeholder="nama">
                  </div>
                  {{-- <div class="form-group">
                      <label for="customFile">Upload File Quotation</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file_quotation" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                  </div> --}}
                </div>
                <div class="column col-4">
                  <div class="form-group">
                      <label>Tanggal Sales Order</label>
                      <div class="input-group date">
                          <input type="text" class="form-control datetimepicker-input" value="{{date('d/m/Y')}}" data-target="#reservationdate" readonly/>
                      </div>
                  </div>
                  <div class="form-group">
                      <label>HPS</label>
                      <select class="form-control select2" style="width: 100%;" name="hps">
                        <option value="Dok PO">Dok PO</option>
                        <option selected="selected" value="Dok Penawaran">Dok Penawaran</option>
                        <option value="Dok BAST">Dok BAST</option>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Upload File Quotation</label>
                    <input type="file" class="form-control" name="file_quotation">
                  </div>
                  {{-- <div class="form-group">
                    <label>status</label>
                    <select class="form-control select2" style="width: 100%;" name="status">
                      <option selected="selected" value="Approve">Approve</option>
                      <option value="Reject">Reject</option>
                    </select>
                  </div> --}}
                  {{-- <div class="form-group">
                      <label for="customFile">Upload File PO</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file_po" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                  </div> --}}
                </div>
                <div class="column col-4">
                  
                  <div class="form-group">
                    <label>Upload File PO</label>
                    <input type="file" class="form-control" name="file_po">
                  </div>
                  <div class="form-group">
                    <label>Upload File SPK</label>
                    <input type="file" class="form-control" name="file_spk">
                  </div>
                  
                  {{-- <div class="form-group">
                      <label for="customFile">Upload File SPK</label>
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file_spk" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                  </div> --}}
                </div>
                
              </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <a href="#" class="btn btn-secondary">Back</a>
            </form>
          </div>
        </div>
    </section>
@endsection