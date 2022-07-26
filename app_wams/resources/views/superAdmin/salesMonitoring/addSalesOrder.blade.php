@extends('layouts.main')
@section('content')
<section class="section">
  <div class="card">
      <div class="card-header">
          <h1>Tambah Sales Order</h1>
      </div>
      <div class="card-body">
          <form action="{{route('saOrder/saveData')}}" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              <div class="row">
                  <div class="column col-4">
                      <input type="hidden" class="form-control" name="no_so" value="{{date('d/m/Y').'/'.$dd}}" id="exampleInputEmail1" readonly>
                      {{-- <div class="form-group">
                          <label for="exampleInputEmail1">No Sales Order</label>
                      </div> --}}
                      <div class="form-group">
                          <label>Tanggal Sales Order</label>
                          <div class="input-group date">
                              <input type="text" class="form-control datetimepicker-input" value="{{date('d/m/Y')}}" data-target="#reservationdate" readonly/>
                          </div>
                      </div>
                      <div class="form-group">
                        <label>HPS</label>
                        <select class="form-control select2" style="width: 100%;" name="jenis_dok">
                          <option value="Dok PO">Dok PO</option>
                          <option selected="selected" value="Dok Penawaran">Dok Penawaran</option>
                          <option value="Dok BAST">Dok BAST</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Upload File Document</label>
                        <input type="file" class="form-control" name="file_dokumen">
                      </div>
                  </div>
                  <div class="column col-4">
                      <div class="form-group">
                          <label for="exampleInputEmail1">Nama Institusi</label>
                          <input type="text" class="form-control" name="institusi" id="exampleInputEmail1" placeholder="Institusi">
                      </div>
                      <div class="form-group">
                        <label class="required"><b>HPS</b></label>
                        <input type="text" name="hps" id="harga" class="form-control" placeholder="Harga Perkiraan Sendiri" />
                      </div>
                      <div class="form-group">
                        <label>Upload File Quotation</label>
                        <input type="file" class="form-control" name="file_quotation">
                      </div>
                  </div>
                  <div class="column col-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Project</label>
                            <input type="text" class="form-control" name="project" id="exampleInputEmail1" placeholder="Project">
                        </div>
                        <div class="form-group">
                            <label>Upload File PO</label>
                            <input type="file" class="form-control" name="file_po">
                        </div>
                        <div class="form-group">
                            <label>Upload File SPK</label>
                            <input type="file" class="form-control" name="file_spk">
                        </div>
                  </div>
              </div>
              <button type="submit" class="btn btn-primary mr-2">Submit</button>
              <a href="{{route('/dashboard/salesOrder')}}" class="btn btn-secondary">Back</a>
          </form>
      </div>
  </div>
</section>
@endsection
@section('js')
<script>
    var harga = document.getElementById('harga');
    harga.addEventListener('keyup', function(e)
    {
        harga.value = formatRupiah(this.value, 'Rp. ');
    });
    
    function formatRupiah(angka, prefix)
    {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split    = number_string.split(','),
            sisa     = split[0].length % 3,
            rupiah     = split[0].substr(0, sisa),
            ribuan     = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
    </script>
@endsection