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
    <div class="section-header">
        <h1>Create Project</h1>
    </div>
    <div class="card">
        <div class="card-body">
        <form action="{{route('/adminproject/store')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}

                <div class="mb-3 row">
                    <label for="inputID_project" class="col-sm-3 col-form-label">Project ID</label>
                    <div class="col-sm-9">
                    {{-- arr2 --}}
                    <input type="text" class="@error('ID_project') is-invalid @enderror form-control d-none" name="arr2" placeholder="ID_project" id="inputID_project" value="{{$nomer}}" readonly>
                    {{-- end arr2 --}}
                    <input type="text" class="@error('ID_project') is-invalid @enderror form-control" name="ID_project" placeholder="ID_project" id="inputID_project" value="{{$nomer}}" readonly>
                    @error('ID_project')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                {{-- <div class="mb-3 row">
                    <label for="inputNamaClient" class="col-sm-3 col-form-label">ID Customer</label>
                    <div class="col-sm-9">
                        <input type="text" class="@error('ID_Customer') is-invalid @enderror form-control" name="IDCustomer" value="}" placeholder="ID Customer" id="ID_Customer" readonly>
                        @error('NamaClient')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div> --}}

                <div class="mb-2 row">
                    <label for="inputTimeline" class="col-sm-3 col-form-label">Client Name</label>
                    <div class="col-sm-9">
                        <select name="namaClient" class="@error('elearning_id') is-invalid @enderror form-control" required>
                            <option value=""></option>
                            @foreach($customer as $item)
                            <option value="{{$item->nama}}">{{$item->nama}}</option>
                            @endforeach
                        </select>
                    @error('elearning_id')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>
        
                {{-- <div class="mb-3 row">
                    <label for="inputNamaClient" class="col-sm-3 col-form-label">Nama Client</label>
                    <div class="col-sm-9">
                    <input type="text" class="@error('NamaClient') is-invalid @enderror form-control" name="NamaClient" placeholder="Nama Client" id="inputNamaClient">
                    @error('NamaClient')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div> --}}

                <div class="mb-2 row">
                    <label for="inputNamaProject" class="col-sm-3 col-form-label">Project Name</label>
                    <div class="col-sm-9">
                    <input type="text" class=" @error('NamaProject') is-invalid @enderror form-control" name="NamaProject" placeholder="Nama Project" id="inputNamaProject" required>
                    @error('NamaProject')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputTimeline" class="col-sm-3 col-form-label">Principal</label>
                    <div class="col-sm-9">
                        <select name="principal" class="@error('elearning_id') is-invalid @enderror form-control" required>
                            <option value=""></option>
                            @foreach($principal as $item)
                            <option value="{{$item->name}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    @error('elearning_id')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputTimeline" class="col-sm-3 col-form-label">Distributor</label>
                    <div class="col-sm-9">
                        {{-- <select name="distributor" class="@error('elearning_id') is-invalid @enderror form-control" required>
                            <option></option>
                            @foreach($distributor as $item)
                            <option value="{{$item->distributor}}">{{$item->distributor}}</option>
                            @endforeach
                        </select> --}}
                        <select class="choices form-select multiple-remove @error('elearning_id') is-invalid @enderror" multiple="multiple" name="distributor[]" required>
                            <option value="" hidden></option>
                            @foreach($distributor as $item)
                            <option value="{{$item->distributor}}">{{$item->distributor}}</option>
                            @endforeach
                        </select>
                        @error('elearning_id')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label class="col-sm-3 co
                    l-form-label">Date</label>
                    <div class="col-sm-9">
                    <input type="date" class="@error('Date') is-invalid @enderror form-control date" name="Date" required>
                    @error('Date')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-3 col-form-label">Progress Status</label>
                    <div class="col-sm-9">
                    <select class="@error('Status') is-invalid @enderror form-control" name="Status" required>
                        <option value=""></option>
                        @foreach($prostat as $item)
                        <option value="{{$item->title}}">{{$item->title}}</option>
                        @endforeach
                    </select>
                    @error('Status')
                        <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="exampleFormControlTextarea1" class="col-sm-3 col-form-label">Note</label>
                    <div class="col-sm-9">
                    <textarea class="@error('Note') is-invalid @enderror form-control" name="Note" id="exampleFormControlTextarea1" ></textarea>
                    @error('Note')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                {{-- Am --}}
                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-3 col-form-label">Asignment to AM</label>
                    <div class="col-sm-9">
                        <select class="choices form-select multiple-remove @error('sign_techLead') is-invalid @enderror" multiple="multiple" name="sign_am[]" required>
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
                </div>  

                {{-- pm --}}
                <div class="mb-2 row d-none">
                    <label for="inputStatus" class="col-sm-3 col-form-label">Asignment to Pm </label>
                    <div class="col-sm-9">
                        <select class="choices form-select @error('sign_pmLead') is-invalid @enderror" name="sign_pmLead">
                            <option value="" hidden></option>
                            @foreach ($pmLead as $item)
                                @foreach ($item->users as $user)
                                    <option  value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                        <div>   
                            @error('sign_pmLead')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div> 
                    </div>
                </div>

                {{-- technikal --}}
                <div class=" row">
                    <label for="inputStatus" class="col-sm-3 col-form-label">Asignment to Engineer & Presales</label>
                    <div class="col-sm-9">
                        <select class="choices form-select multiple-remove @error('sign_techLead') is-invalid @enderror" multiple="multiple" name="sign_techLead[]" required>
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
                </div>  

                {{-- <div class="mb-5 row">
                    <label for="inputStatus" class="col-sm-3 col-form-label">Asignment to Presales </label>
                    <div class="col-sm-9">
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
                </div>   --}}

        {{-- ! --}}
        <div class="mb-3">
            <label for="document">Upload File</label>
            <div style="background-color: none" class="needsclick dropzone" id="document-dropzone">
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <div>
                <a href="/adminproject" class="btn btn-secondary btn-md">Back</a>
            </div>
            <div>
                <button type="submit" class="btn btn-md btn-md text-white" style="background-color: #5252FF">Submit</button>
            </div>
        </div>

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


var harga = document.getElementById('inputAngka');
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $(document).ready(function() {
    $('.select2').select2();
  });
</script>

<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
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
        // if (res.salesorder_id) {
        //     const amsales = res.sorder.user_technikals.map((item) => {
        //         if (item.a_m != null) {
        //             return item.a_m.name;
        //         }
        //     })
        //     const presales = res.sorder.user_technikals.map((item) => {
        //         if (item.user_technikal != null) {
        //             return  item.user_technikal.name;
        //         }
        //     });
            
        //     $("#ID_project").val(res.sorder.ID_project)
        //     $("#NamaClient").val(res.sorder.NamaClient)
        //     $("#NamaProject").val(res.sorder.NamaProject)
        //     $("#estimated_amount").val(null)
        //     $("#Status").val(res.sorder.Status)
        //     $("#distributor").val(res.sorder.distributor)
        //     $("#presales").val(presales)
        //     $("#sbu").val(null)
        //     $("#amsales").val(amsales)
        //     $("#principal").val(res.sorder.principal)
        //     $("#confidence_level").val(null)
        //     $("#contract_amount").val(null)
        //     $("#file_project").val(res.sorder.UploadDocument)
        //     $("#listadmin_id").val(res.sorder.id)
        //     $("#listpipe_id").val(null)
        //     $("#no_customer").val(res.sorder.ID_Customer)
        // }
        // if (res.salesopty_id) {
        //     const presales = res.sopty.user_technikals_pipe.map(item => item.user_technikal.name)
        //     $("#ID_project").val(res.sopty.ID_project)
        //     $("#NamaClient").val(res.sopty.NamaClient)
        //     $("#NamaProject").val(res.sopty.NamaProject)
        //     $("#estimated_amount").val(res.sopty.estimated_amount)
        //     $("#Status").val(res.sopty.Status)
        //     $("#distributor").val(res.sopty.distributor)
        //     $("#presales").val(presales)
        //     $("#sbu").val(res.sopty.sbu) 
        //     $("#amsales").val(res.sopty.name_user)
        //     $("#principal").val(res.sopty.elearning_id)
        //     $("#confidence_level").val(res.sopty.confidence_level)
        //     $("#contract_amount").val(res.sopty.contract_amount)
        //     $("#file_project").val(null)
        //     $("#listpipe_id").val(res.sopty.id)
        //     $("#listadmin_id").val(null)
        //     $("#no_customer").val(res.opty.no_customer)
        // }
    })
  });
</script>

@endpush

     



