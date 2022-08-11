@extends('layouts.main')
@section('css')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
          <h1>Edit Sales Order</h1>
        </div>
        <div class="card-body">
        <form action="{{url('update-data',$product->id)}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          @method('put')
            <div class="row">
                <div class="column col-4">
                    <input type="hidden" class="form-control" name="no_so" value="{{$product->no_so}}" id="exampleInputEmail1" readonly>
                    {{-- <div class="form-group">
                        <label for="exampleInputEmail1">No Sales Order</label>
                    </div> --}}
                    <div class="form-group">
                        <label>Tanggal Sales Order</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datetimepicker-input" value="{{$product->tgl_so}}" data-target="#reservationdate" readonly/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>HPS</b></label>
                        <input type="text" name="hps" id="harga" value="{{$product->hps}}" class="form-control" placeholder="Harga Perkiraan Sendiri" />
                    </div>
                </div>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Project</label>
                        <input type="text" class="form-control" name="project" value="{{$product->project}}" id="exampleInputEmail1" placeholder="Project">
                    </div>
                    <div class="form-group">
                        <label>Sign to PM Lead</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datetimepicker-input" value="{{$product->pmLead->name}}" data-target="#reservationdate" readonly/>
                        </div>
                    </div>                    
                </div>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nama Institusi</label>
                        <input type="text" class="form-control" name="institusi" value="{{$product->institusi}}" id="exampleInputEmail1" placeholder="Institusi">
                    </div>
                    <div class="form-group">
                        <label>Sign to Teknikal Lead</label>
                        <div class="input-group date">
                            <input type="text" class="form-control datetimepicker-input" value="{{$product->teknikalLead->name}}" data-target="#reservationdate" readonly/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="document">File Update</label>
                <div class="needsclick dropzone" id="document-dropzone">
       
                </div>
             </div>
            <a href="{{route('slsorder')}}" class="btn btn-secondary">Back</a>
            <button type="submit" class="btn btn-primary mr-2">Submit</button>
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
        },
        init: function() {
            @if (isset($file_dokumens))
            var files =
            {!! json_encode($file_dokumens) !!}
            for (var i in files) {
            var file = files[i]
            console.log(file);
            file = {
            ...file,
            width: 226,
            height: 324
            }
            this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.original_url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="file_dokumen[]" value="' + file.file_name + '">')
            }
            @endif
        }
    }
</script>
@endpush