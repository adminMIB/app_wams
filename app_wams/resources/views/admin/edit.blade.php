@extends('layouts.main')
@section('css')
    {{-- <link href="../assets/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="{{ asset('newassets/assets/extensions/choices.js/public/assets/styles/choices.css') }}">
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
      <h1 class="text-center mb-5">Edit List Project admin</h1>
      <div class="card">
        <div class="card-header">
        </div>

        <div class="card-body">
          <form action="{{route('/adminprojecsUpdates', $detailId->id)}}" method="POST" enctype="multipart/form-data"> 
                  {{csrf_field()}}
                  <input type="text" id="last-name-column" class="form-control d-none"
                  placeholder="Last Name" name="ID_project" value="{{$detailId->ID_project}}" autofocus readonly>
                  <input type="text" id="last-name-column" class="form-control d-none"
                  placeholder="Last Name" name="IDCustomer" value="{{$detailId->ID_Customer}}" autofocus readonly>
                  <input type="hidden" name="ListProjectAdmin_id[]" value="{{ $detailId->id }}">
                  <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12 mb-2">
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
                                                <div class="col-md-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Client Name</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                            placeholder="Last Name" name="namaClient" value="{{$detailId->NamaClient}}" autofocus >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="city-column">Project Name</label>
                                                        <input type="text" id="city-column" class="form-control" placeholder="City"
                                                            name="NamaProject" value="{{$detailId->NamaProject}}" autofocus >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="country-floating">Date</label>
                                                        <input type="date" id="country-floating" class="form-control"
                                                            name="Date" placeholder="Country" value="{{$detailId->Date}}" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="company-column">Distributor</label>
                                                        <select name="distributor" class="@error('elearning_id') is-invalid @enderror form-control">
                                                          <option value="{{$detailId->distributor}}">{{$detailId->distributor}}</option>
                                                          @foreach($distributor as $item)
                                                          <option value="{{$item->distributor}}">{{$item->distributor}}</option>
                                                          @endforeach
                                                        </select>
                                                        @error('elearning_id')
                                                          <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                    <div class="form-group">
                                                        <label for="email-id-column">Principal</label>
                                                        <select name="principal" class="@error('elearning_id') is-invalid @enderror form-control">
                                                          <option value="{{$detailId->principal}}">{{$detailId->principal}}</option>
                                                          @foreach($principal as $item)
                                                          <option value="{{$item->name}}">{{$item->name}}</option>
                                                          @endforeach
                                                      </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12 mb-3">
                                                  <div class="form-group">
                                                      <label for="email-id-column">Status</label>
                                                      <select class="@error('Status') is-invalid @enderror form-control" name="Status">
                                                        <option value="{{$detailId->Status}}">{{$detailId->Status}}</option>
                                                        @foreach($prostat as $item)
                                                        <option value="{{$item->title}}">{{$item->title}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    @error('Status')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                    @enderror
                                                  </div>
                                                </div>  
                                              </div>
                                              <div class="">
                                                <div class="form-group">
                                                    <label for="email-id-column">Note</label>
                                                    <textarea name="Note" id="" cols="30" rows="10" style="height: 100px;"  class="form-control">{{$detailId->Note}}</textarea>
                                                </div>
                                              </div>
                                                <div class="mt-5 form-group">
                                                  <label>AM</label>
                                                  <select class="choices form-select multiple-remove @error('sign_techLead') is-invalid @enderror" multiple="multiple" name="sign_am[]">
                                                    @foreach ($detailId->userTechnikals as $item)  
                                                    <option value="{{$item->AM->id ?? null}}" selected>{{$item->AM->name ?? null}}</option>
                                                    @endforeach
                                                    @foreach ($sales as $item)
                                                        @foreach ($item->users as $user)
                                                            <option  value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                                  {{-- @foreach ($detailId->userTechnikals as $item)  
                                                    <input  type="text" class="form-control w-20 mb-2 col-sm-2" value="{{$item->AM->name ?? null}}" readonly >
                                                    <input name="amLama[]" type="text" class="form-control w-20 mb-2 col-sm-2 d-none" value="{{$item->AM->id ?? null}}"  >
                                                  @endforeach --}}
                                                </div>
                                                {{-- pilih am baru--}}
                                                {{-- <div class="mb-2 row">
                                                  <div class="col-sm-12">
                                                      <label for="inputStatus" class="text-danger" style="">Sign AM Terbaru</label>
                                                            <select class="select2 form-control  @error('sign_techLead') is-invalid @enderror " name="sign_am[]" multiple="multiple">
                                                            <option value=""></option>
                                                                @foreach ($sales as $item)
                                                                    @foreach ($item->users as $user)
                                                                        <option  value="{{$user->id}}">{{$user->name}}</option>
                                                                    @endforeach
                                                                @endforeach
                                                        </select>
                                                        <select class="choices form-select multiple-remove @error('sign_techLead') is-invalid @enderror" multiple="multiple" name="sign_am[]">
                                                          <option value="" hidden></option>
                                                          @foreach ($sales as $item)
                                                            @foreach ($item->users as $user)
                                                                <option  value="{{$user->id}}">{{$user->name}}</option>
                                                            @endforeach
                                                          @endforeach
                                                      </select>
                                                        <div>   
                                                            @error('sign_techLead')
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>  
                                                    </div>                  
                                                </div> --}}
                                                <div class="mt-5 form-group">
                                                  <label>Engineer & Presales</label>
                                                  </select>
                                                  <select class="choices form-select multiple-remove @error('sign_techLead') is-invalid @enderror" multiple="multiple" name="sign_techLead[]">
                                                    @foreach ($detailId->userTechnikals as $item)  
                                                    <option value="{{$item->userTechnikal->id ?? null}}" selected>{{$item->userTechnikal->name ?? null}}</option>
                                                    @endforeach
                                                    @foreach ($TechnikelLead as $item)
                                                        @foreach ($item->users as $user)
                                                            <option  value="{{$user->id}}">{{$user->name}}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                                  {{-- @foreach ($detailId->userTechnikals  as $item)  
                                                    <input type="text" class=" form-control mb-2 col-sm-2" value="{{$item->userTechnikal->name ?? null}}" readonly >
                                                    <input name="TechnikalLama[]" type="text" class="form-control mb-2 col-sm-2 d-none" value="{{$item->userTechnikal->id ?? null}}" readonly  >
                                                  @endforeach --}}
                                                </div>
                                                {{-- technikal baru --}}
                                                {{-- <div class="mb-5 row ">
                                                  <label for="inputStatus" class="text-danger" style="">Sign Technikal Terbaru </label>
                                                  <div class="col-sm-12">
                                                          <select class=" select2 @error('sign_techLead') is-invalid @enderror form-control" name="sign_techLead[]" multiple="multiple">
                                                          <option value=""></option>
                                                              @foreach ($TechnikelLead as $item)
                                                                  @foreach ($item->users as $user)
                                                                      <option  value="{{$user->id}}">{{$user->name}}</option>
                                                                  @endforeach
                                                              @endforeach
                                                      </select>
                                                      <select class="choices form-select multiple-remove @error('sign_techLead') is-invalid @enderror" multiple="multiple" name="sign_techLead[]">
                                                        <option value="" hidden></option>
                                                        @foreach ($TechnikelLead as $item)
                                                            @foreach ($item->users as $user)
                                                                <option  value="{{$user->id}}">{{$user->name}}</option>
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                      <div>   
                                                          @error('sign_techLead')
                                                          <div class="invalid-feedback">{{$message}}</div>
                                                          @enderror
                                                      </div>  
                                                  </div>                  
                                              </div> --}}
                                              {{--  --}}
                                              {{-- <div class="mt-5 form-group">
                                                <label>Presales</label>
                                                <select class="choices form-select multiple-remove @error('sign_techLead') is-invalid @enderror" multiple="multiple" name="sign_presale[]">
                                                  @foreach ($detailId->userTechnikals as $item)  
                                                  <option value="{{$item->userPresale->id ?? null}}" selected>{{$item->userPresale->name ?? null}}</option>
                                                  @endforeach
                                                  @foreach ($TechnikelLead as $item)
                                                      @foreach ($item->users as $user)
                                                          <option  value="{{$user->id}}">{{$user->name}}</option>
                                                      @endforeach
                                                  @endforeach
                                              </select> --}}
                                                {{-- @foreach ($detailId->userTechnikals  as $item)  
                                                  <input type="text" class=" form-control mb-2 col-sm-2" value="{{$item->userPresale->name ?? null}}" readonly >
                                                  <input name="TechnikalLama[]" type="text" class="form-control mb-2 col-sm-2 d-none" value="{{$item->userPresale->id ?? null}}" readonly  >
                                                @endforeach --}}
                                              {{-- </div> --}}
                                              {{-- presale baru --}}
                                              {{-- <div class="mb-5 row ">
                                                <label for="inputStatus" class="text-danger" style="">Sign Presales Terbaru </label>
                                                <div class="col-sm-12">
                                                        <select class=" select2 @error('sign_techLead') is-invalid @enderror form-control" name="sign_presale[]" multiple="multiple">
                                                          <select class="choices select2 form-select multiple-remove @error('sign_techLead') is-invalid @enderror" multiple="multiple" name="sign_presale[]">

                                                        <option value=""></option>
                                                            @foreach ($TechnikelLead as $item)
                                                                @foreach ($item->users as $user)
                                                                    <option  value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                            @endforeach
                                                    </select>

                                                    <select class="choices form-select multiple-remove @error('sign_techLead') is-invalid @enderror" multiple="multiple" name="sign_presale[]">
                                                      <option value="" hidden></option>
                                                      @foreach ($TechnikelLead as $item)
                                                          @foreach ($item->users as $user)
                                                              <option  value="{{$user->id}}">{{$user->name}}</option>
                                                          @endforeach
                                                      @endforeach
                                                  </select>
                                                    <div>   
                                                        @error('sign_techLead')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>  
                                                </div>                  
                                            </div> --}}
                                              
                                              <div class="mb-3">
                                                <label for="document">File Update</label>
                                                <div class="needsclick dropzone" id="document-dropzone">
                                                </div>
                                              </div> 
                                              <div class="d-flex  justify-content-between mt-5">
                                                <a href="/adminproject" class="btn btn-md btn-secondary text-white">Back</a>
                                                <button type="submit" class="btn btn-danger btn-md">Submit</button>
                                              </div>                                         
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  </section>
            </form> 
              </div>
      </div>
    </section>
@endsection

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

