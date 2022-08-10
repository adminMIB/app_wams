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
    <div class="title">
        <h1 style="color: black; margin-left: 9px; margin-top:20px">Input Project</h1>
    </div> 
        <div class="card">
        <div class="card-body">
        <form action="{{route('/adminproject/store')}}" method="POST" enctype="multipart/form-data">
            {{csrf_field()}}

                <div class="mb-3 row">
                    <label for="inputID_project" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">ID Project</label>
                    <div class="col-sm-10">
                    <input type="text" class="@error('ID_project') is-invalid @enderror form-control" name="ID_project" placeholder="ID_project" id="inputID_project" value="{{$nomer}}" readonly>
                    @error('ID_project')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>
        
                <div class="mb-3 row">
                    <label for="inputNamaClient" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Nama Client</label>
                    <div class="col-sm-10">
                    <input type="text" class="@error('NamaClient') is-invalid @enderror form-control" name="NamaClient" placeholder="Nama Client" id="inputNamaClient">
                    @error('NamaClient')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputNamaProject" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Nama Project</label>
                    <div class="col-sm-10">
                    <input type="text" class=" @error('NamaProject') is-invalid @enderror form-control" name="NamaProject" placeholder="Nama Project" id="inputNamaProject">
                    @error('NamaProject')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>
                
                {{-- <div class="mb-2 row">
                    <label for="inputNamaProject" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Upload Dokumen</label>
                    <div class="col-sm-10">
                    <input type="file" class=" @error('NamaProject') is-invalid @enderror form-control" name="UploadDocument[]" multiple placeholder="Nama Project" id="inputNamaProject">

                    @error('NamaProject')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                    <p></p>
                </div> --}}

                <div class="mb-2 row">
                    <label class="col-sm-2 co
                    l-form-label" style="color:black;font-weight:bold">Date</label>
                    <div class="col-sm-10">
                    <input type="date" class="@error('Date') is-invalid @enderror form-control date" name="Date">
                    @error('Date')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                {{-- uoload --}}
                {{-- <div class="mb-2 row">
                    <label for="inputNamaProject" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Upload Dokumen</label>
                    <div class="col-sm-10">
                    <input type="file" class=" @error('NamaProject') is-invalid @enderror form-control" name="UploadDocument[]" multiple placeholder="Nama Project" id="inputNamaProject">
                    @error('NamaProject')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div> --}}

                <div class="mb-2 row">
                    <label for="inputAngka" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Angka</label>
                    <div class="col-sm-10">
                    <input type="text" class="@error('Angka') is-invalid @enderror form-control" name="Angka" placeholder="Angka" id="inputAngka">
                    @error('Angka')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Status</label>
                    <div class="col-sm-10">
                    <select class="@error('Status') is-invalid @enderror form-control" name="Status">

                        <option value="">-- Tender, Menang, Kalah --</option>
                        <option value="Tender"> Tender</option>
                        <option value="Menang"> Menang</option>
                        <option value="Kalah"> Kalah</option>
                        
                    </select>
                    @error('Status')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="exampleFormControlTextarea1" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Note</label>
                    <div class="col-sm-10">
                    <textarea class="@error('Note') is-invalid @enderror form-control" name="Note" id="exampleFormControlTextarea1" ></textarea>
                    @error('Note')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                    </div>
                </div>

                {{-- pm lead --}}
                {{-- <div class="mb-2 row">
                    <label for="inputStatus" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Sign Pm Lead</label>
                    <div class="col-sm-10">
                    <select class="@error('signPm_lead') is-invalid @enderror form-control" name="signPm_lead">

                    <option value=""></option>
                        @foreach ($pmLead as $item)
                            @foreach ($item->users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        @endforeach

                </select>
                    @error('signPm_lead')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div> --}}

            {{-- signTechnikel_lead --}}
            {{-- <div class="mb-2 row">
                <label for="inputStatus" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Technikal Lead</label>
                <div class="col-sm-10">
                <select class="@error('Technikal_lead') is-invalid @enderror form-control" name="signTechnikel_lead">

                    <option value=""></option>
                        @foreach ($TechnikelLead as $item)
                            @foreach ($item->users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        @endforeach
                    
                </select>
                @error('Technikal_lead')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>
            </div> --}}

            {{-- sales --}}
            {{-- <div class="mb-2 row">
                <label for="inputStatus" class="col-sm-2 col-form-label" style="color:black;font-weight:bold">Sales</label>
                <div class="col-sm-10">
                <select class="@error('signAmSales_id') is-invalid @enderror form-control" name="signAmSales_id">

                <option value=""></option>
                    @foreach ($sales as $item)
                        @foreach ($item->users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    @endforeach

            </select>
                @error('signAmSales_id')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror
            </div>
        </div> --}}

        {{-- ! --}}
        <div class="mb-3">
            <label for="document">Upload File</label>
            <div class="needsclick dropzone" id="document-dropzone">
            </div>
        </div>

            <div style="text-align:right;">
                <button type="submit" class="btn btn-primary btn-md">Send</button>
            </div>

        </form>
        <a href="/adminproject"><button type="submit" class="btn btn-secondary btn-sm">Back</button>
        </a> 
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
    url: '{{ route('admin/media') }}',
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
@endpush



