@extends('layouts.main')
@section('css')
    {{-- CSS assets in head section --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <style>
      .dz-image img {
         width: 120px;
         height: 120px;
      }
    </style>
@endsection
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h1>Tambah Sales Order</h1>
        </div>
        <div class="card-body">
            <form action="{{route('Ssimpan-data')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="column col-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">No Sales Order</label>
                            <input type="text" class="form-control" name="no_so" value="{{date('d/m/Y').'/'.$dd}}" id="exampleInputEmail1" readonly>
                        </div>
                        <div class="form-group">
                            <label>Tanggal Sales Order</label>
                            <div class="input-group date">
                                <input type="text" class="form-control datetimepicker-input" name="tgl_so" id="Date" placeholder="TGL Sales Order" data-target="#reservationdate" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Sign to PM LEAD</label>
                            <select class="form-control select2" style="width: 100%;" name="signPm_lead">
                            <option></option>
                            @foreach ($pmLead as $it)
                                @foreach ($it->users as $us)
                                    <option value="{{$us->id}}">{{$us->name}}</option>
                                @endforeach
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="column col-4">
                        <input type="hidden" class="form-control" name="project" id="NamaProject" placeholder="Project" readonly>
                        <div class="form-group">
                            <label>Nama Project</label>
                            <select class="form-control select2" id="id" style="width: 100%;" name="listpa_id">
                            <option>Project</option>
                            @foreach ($lpa as $item)
                            @if ($item->Status === 'Menang')
                            <option value="{{$item->id}}">{{$item->NamaProject}}</option>
                            @endif
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="required"><b>HPS</b></label>
                            <input type="text" name="hps" id="Angka" class="form-control" placeholder="Harga Perkiraan Sendiri" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label>Sign to Teknikal</label>
                            <select class="form-control select2" style="width: 100%;" name="signTeknikal_lead">
                            <option></option>
                            @foreach ($TechnikelLead as $item)
                                @foreach ($item->users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <div class="column col-4">
                        <div class="form-group">
                            <label for="NamaClient">Nama Institusi</label>
                            <input type="text" class="form-control" name="institusi" id="NamaClient" placeholder="Institusi" readonly>
                        </div>
                        <div class="form-group">
                            <label for="ID_project">Kode Project</label>
                            <input type="text" class="form-control" id="ID_project" name="kode_project" placeholder="ID Project" readonly>
                        </div>
                        {{-- <div class="form-group">
                            <label>Upload File Document</label>
                            <input type="file" class="form-control" name="file_dokumen[]" multiple="multiple">
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="exampleInputEmail1">Nama Project</label>
                        </div> --}}
                    </div>
                </div>
                <div class="mb-3">
                    <label for="document">Upload File</label>
                    <div class="needsclick dropzone" id="document-dropzone">
           
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{route('slsorder')}}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</section>
@endsection
@push('script-internal')
{{-- JS assets at the bottom --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
{{-- ...Some more scripts... --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
var uploadedDocumentMap = {}
Dropzone.options.documentDropzone = {
    url: '{{ route('storeMedia') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    acceptedFiles: ".doc,.docx,.pdf,.xls,.xlsx,.ppt,.pptx",
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function(file, response) {
        $('form').append('<input type="hidden" name="file_dokumen[]" value="' + response.name + '">')
        uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function(file) {
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedDocumentMap[file.name]
        }
        $('form').find('input[name="file_dokumen[]"][value="' + name + '"]').remove()
    }
}
</script>
@endpush
@section('js')
<script>
  $('#id').change(function() {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
      method: "POST",
      type: "JSON",
      data: {
        id: this.value
      },
      url: "/add_so"
    }).done(function(res) {
      $("#ID_project").val(res.ID_project)
      $("#NamaClient").val(res.NamaClient)
      $("#NamaProject").val(res.NamaProject)
      $("#Date").val(res.Date)
      $("#Angka").val(res.Angka)
    //   $("#kode_project").val(res.kode_project)
    })
  });
</script>
@endsection
{{-- @section('js')
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
@endsection --}}