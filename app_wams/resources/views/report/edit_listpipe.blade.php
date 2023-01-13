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
  <div class="section-header">
    <h1>Detail Page</h1>
  </div>
  <div class="card" id="mycard-dimiss" style="border-radius: 2em">
    <div class="card-header">
      <div class="card-header-action">
        <a data-dismiss="#mycard-dimiss" class="btn btn-icon btn-secondary" href="/viewproject">Back</a>
      </div>
    </div>
    <div class="card-body">
      <form action="{{route('updatepipe', $getOneById->id)}}" method="POST" enctype="multipart/form-data"> 
        {{ csrf_field() }}
        <h3 class="mb-3">Upload Proposal</h3>
        @foreach ($getOneById->UploadDocuments as $i)
          @foreach (explode("," , $i->file_name) as $a) 
            <input type="text" class="form-control w-50 mb-2" value="{{$a}}" readonly>
          @endforeach
        @endforeach
        <hr>
        <div class="mb-3">
          <label for="document">File Update</label>
          <div class="needsclick dropzone" id="document-dropzone">
          </div>
        </div>
        <div class="text-right">
          <button class="btn btn-success" type="submit">Update Proposal</button>
          {{-- <a href="#" class="btn btn-danger delete" data-id="##">Delete</a> --}}
        </div>
      </form>
    </div>
  </div>
</section>
@endsection

{{-- @section('js')
<script>
$('.delete').click( function(){
  var reportid = $(this).attr('data-id');
  swal({
  title: "Are you sure?",
  text: ""+reportid+" data will be deleted",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    window.location ="##"
    swal(""+reportid+" file has been deleted!", {
      icon: "success",
    });
  } else {
    swal("Your "+reportid+" file is safe!");
  }
});  
});
</script>    
@endsection --}}
@push('script-internal')
{{-- JS assets at the bottom --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
{{-- ...Some more scripts... --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script>
    var uploadedDocumentMap = {}
    Dropzone.options.documentDropzone = {
        url: '{{ route('storeMediaAdmin') }}',
        maxFilesize: 2, // MB
        addRemoveLinks: true,
        acceptedFiles: ".doc,.docx,.pdf,.xls,.xlsx,.ppt,.pptx",
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        success: function(file, response) {
            $('form').append('<input type="hidden" name="UploadDocument[]" value="' + response.name + '">')
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
            $('form').find('input[name="UploadDocument[]"][value="' + name + '"]').remove()
        },
        init: function() {
            @if (isset($UploadDocuments))
                var files =
                {!! json_encode($UploadDocuments) !!}
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

                $('form').append('<input type="hidden" name="UploadDocument[]" value="' + file.file_name + '">')
                }
            @endif
        }
    }
</script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.select2').select2();
    });
  </script>
@endpush
