@extends('layouts.main')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">
              <h1>Edit Sales Order</h1>
            </div>
            <div class="card-body">
            <form action="{{url('update-data',$getOneById->id)}}" method="POST" enctype="multipart/form-data">
              {{csrf_field()}}
              @method('put')
                <div class="row">
                    <div class="column col-4">
                        <input type="hidden" class="form-control" name="no_so" value="{{$getOneById->no_so}}" id="exampleInputEmail1" readonly>
                    {{-- <div class="form-group">
                        <label for="exampleInputEmail1">No Sales Order</label>
                    </div> --}}
                    <div class="form-group">
                        <label>Tanggal Sales Order</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datetimepicker-input" value="{{$getOneById->created_at}}" data-target="#reservationdate" readonly/>
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
                        <input type="text" class="form-control" name="old_file_dokumen" value="{{$getOneById->file_dokumen}}" readonly>
                        <input type="file" name="file_dokumen">
                    </div>
                    
                    </div>
                    <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Institusi</label>
                        <input type="text" class="form-control" name="institusi" value="{{$getOneById->institusi}}" id="exampleInputEmail1" placeholder="Institusi">
                    </div>
                    <div class="form-group">
                        <label class="required"><b>HPS</b></label>
                        <input type="text" name="hps" id="harga" value="{{$getOneById->hps}}" class="form-control" placeholder="Harga Perkiraan Sendiri" />
                    </div>
                    <div class="form-group">
                        <label>Upload File Quotation</label>
                        <input type="text" class="form-control mb-1" name="old_file_quotation" value="{{$getOneById->file_quotation}}" readonly>
                        <input type="file" name="file_quotation">
                    </div>
                    
                    </div>
                    <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Project</label>
                        <input type="text" class="form-control" name="project" value="{{$getOneById->project}}" id="exampleInputEmail1" placeholder="Project">
                    </div>
                    <div class="form-group">
                        <label>Upload File SPK</label>
                        <input type="text" class="form-control mb-1" name="old_file_spk" value="{{$getOneById->file_spk}}" readonly>
                        <input type="file" name="file_spk">
                    </div>
                    <div class="form-group">
                        <label>Upload File PO</label>
                        <input type="text" class="form-control mb-1" name="old_file_po" value="{{$getOneById->file_po}}" readonly>
                        <input type="file" name="file_po">
                    </div>
                    </div>
                </div>
                <a href="{{route('slsorder')}}" class="btn btn-secondary">Back</a>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
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