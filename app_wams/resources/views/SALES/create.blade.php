@extends('layouts.main')
@section('css')
    {{-- CSS assets in head section --}}
    <link rel="stylesheet" href="{{ asset('newassets/assets/extensions/choices.js/public/assets/styles/choices.css') }}">
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
            <h1>Tambah LTO</h1>
        </div>
        <div class="card-body">
            <form action="{{route('Ssimpan-data')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">

                    <input type="hidden" class="form-control" name="confidence_level" id="confidence_level" readonly>
                    <input type="hidden" class="form-control" name="file_project" id="file_project" readonly>
                    <input type="hidden" class="form-control" name="sbu" id="sbu" readonly>
                    <input type="hidden" class="form-control" name="listadmin_id" id="listadmin_id" readonly>
                    <input type="hidden" class="form-control" name="listpipe_id" id="listpipe_id" readonly>
                    <input type="hidden" name="estimated_amount" id="estimated_amount" class="form-control" readonly>
                    <input type="hidden" name="no_customer" id="no_customer" class="form-control" readonly>
                    
                    <div class="column col-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1"><b>No LTO</b></label>
                            <input type="text" class="form-control" name="no_so" value="SO/{{date('d/m/Y').'/'.$dd}}" id="exampleInputEmail1" readonly>
                        </div>
                        <div class="form-group">
                            <label><b>LTO Date</b></label>
                            <div class="input-group date">
                                <input type="date" class="form-control datetimepicker-input" name="tgl_so" placeholder="TGL LTO" data-target="#reservationdate" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="required"><b>Principal</b></label>
                            <input type="text" name="principal" id="principal" class="form-control" placeholder="Principal" readonly>
                        </div>
                    </div>
                    <div class="column col-4">
                        <input type="hidden" class="form-control" name="project" id="NamaProject" placeholder="Project" readonly>
                        <div class="form-group">
                            <label><b>Project Name</b></label> 
                            <select class="form-select choices" id="id" style="width: 100%;" required>
                            <option disabled selected hidden>Project</option>
                            @foreach($lpa as $t)
                                @if ($t->salesopty_id)
                                    @if ($t->sopty->Status == "PO/Contract")
                                        @if (Auth::user()->name == $t->sopty->name_user)
                                            <option value="{{$t->id}}">{{$t->sopty->NamaProject}}</option>
                                        @endif
                                    @endif
                                @endif
                                @if ($t->salesorder_id)
                                    @if ($t->sorder->Status == "PO/Contract")
                                        @foreach ($t->sorder->userTechnikals as $item)
                                            @if (Auth::user()->id ==  $item->user_id_am)
                                                <option value="{{$t->id}}">{{$t->sorder->NamaProject}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                @endif
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="required"><b>Contract Amount</b></label>
                            <input type="number" class="form-control" name="contract_amount" placeholder="Contract Amount" id="contract_amount">
                        </div>
                        <div class="form-group">
                            <label class="required"><b>Progress Status</b></label>
                            <input type="text" name="status_project" id="Status" class="form-control" placeholder="Progress Status" readonly>
                        </div>
                        <div class="form-group">
                            <label class="required"><b>Distributor</b></label>
                            <input type="text" name="distributor" id="distributor" class="form-control" placeholder="Distributor" readonly>
                        </div>
                    </div>
                    <div class="column col-4">
                        <div class="form-group">
                            <label for="NamaClient"><b>Client Name</b></label>
                            <input type="text" class="form-control" name="institusi" id="NamaClient" placeholder="Institusi" readonly>
                        </div>
                        <div class="form-group">
                            <label for="ID_project"><b>Project Code</b></label>
                            <input type="text" class="form-control" id="ID_project" name="kode_project" placeholder="Project ID" readonly>
                        </div>
                        
                        <div class="form-group">
                            <label class="required"><b>Technical</b></label>
                            <input type="text" name="presales" id="presales" class="form-control" placeholder="Presales" readonly>
                            <input type="hidden" name="amsales" id="amsales" class="form-control" placeholder="Presales" readonly>
                        </div>
                    </div>
                </div>

                {{-- <div>
                    <button type="button" class="addamount btn btn-success" style="float:right;"><i class="fa-fas fa-plus"></i> Cost Amount</button>
                    <h3 class="mb-3">Cost Amount</h3>
                </div>
               
                <div class="amount scroll">
                </div>
                
                <div class="form-group w-25">
                    <label for="total">Total</label>
                    <input type="number" class="form-control total" name="totalSO" readonly >
                </div>

                <button type="button" class="btn btn-success" style="float:right;" onclick="addRow()"><i class="fa-fas fa-plus"></i> Product</button>
                <h3 class="mb-3">Product</h3>
                <table class=" mb-3">
                    <tbody id="calculation">
                        <tr>
                            <th>Nama Product</th>
                            <th>Quantity</th>
                            <th>Harga</th>
                            <th>Total</th>
                        </tr>
                        <tr class="row-cols-4  ">
                            <td><input class="underline-input form-control " type="text" name="product_name[] " /></td>
                            <td><input class="underline-input form-control multi" type="number" id="quantity" name="product_quantity[]" /></td>
                            <td><input class="underline-input form-control multi" type="number" id="price" name="harga_product[]" /></td>
                            <td><input class="underline-input form-control product" type="number" id="product" name="total[]"/></td>
                        </tr>
                    </tbody>
                    <tr>
                        <th colspan="2"></th>
                        <th>Grand Total</th>
                        <td><input class="underline-input form-control" type="number" id="gtotal" name="grandtotal" readonly/></td>
                    </tr>
                </table> --}}
                
                <div class="row mt-5">
                    {{-- <div class="col-md-4">
                        <div class="form-group">
                            <label><b>Distributor Price Offers</b></label>
                            <input type="file" class="form-control" name="file_PHD" required>
                        </div>
                    </div> --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>SPK/PO/SPBBJ Client</b></label>
                            <input type="file" class="form-control" name="file_SPSC" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label><b>Sales Offer</b></label>
                            <input type="file" class="form-control" name="file_PS" required>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="document">Distributor Price Offers</label>
                    <div style="background-color: none" class="needsclick dropzone" id="document-dropzone">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{route('slsorder')}}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</section>
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
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
    url: '{{ route('storeMediaSales') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    acceptedFiles: ".doc,.docx,.pdf,.xls,.xlsx,.ppt,.pptx",
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function(file, response) {
        $('form').append('<input type="hidden" name="file_PHD[]" value="' + response.name + '">')
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
        $('form').find('input[name="file_PHD[]"][value="' + name + '"]').remove()
    },
    init: function() {
            @if (isset($file_PHDs))
                var files =
                {!! json_encode($file_PHDs) !!}
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

                $('form').append('<input type="hidden" name="file_PHD[]" value="' + file.file_name + '">')
                }
            @endif
        }
}

</script>
<script type="text/javascript">
  $('.addamount').on('click', function() {
    addamount();
  });

  function addamount() {
    var amount = '<div class="col-lg-10"><div class="row mb-2"><div class="col-md-4 mr-2"><input type="text" class="form-control" name="title[]"></div><div class="col-md-4 mr-2"><input type="number" class="form-control amountT" name="amount[]"></div><button type="button" class="remove btn btn-danger col-md-1" style="float:right;"><i class="bi bi-trash"></i></button></div></div>';
    $('.amount').append(amount);
  };
  $('.remove').live('click', function() {
    $(this).parent().remove();
  });
</script>
<script>
    $(document).ready(function(){

    $('#calculation').on("keyup",".multi",function(){
    var parent = $(this).closest('tr');
    var quant= $(parent).find('#quantity').val();
    var price= $(parent).find('#price').val();

    $(parent).find('#product').val(quant* price);
    GrandTotal();
    });

    function GrandTotal(){
    var sum=0;

    $('.product').each(function(){
        sum+=Number($(this).val());
    });

    $('#gtotal').val(sum);
    }
    
    });

    function addRow() {    
    var template = '';
    template += '<tr>';
    template += '<td><input class="underline-input form-control" type="text" name="product_name[]" />';
    template += '<td><input class="underline-input form-control multi" type="number" id="quantity" name="product_quantity[]" />';
    template += '<td><input class="underline-input form-control multi" type="number" id="price" name="harga_product[]" />';
    template += '<td><input class="underline-input form-control product" type="number" id="product" name="total[]" /></td>';
    template += '<td><button type="button" class="removep btn btn-danger"><i class="bi bi-trash"></i></button></td>';
    template += '</tr>';
    
    $("#calculation").append(template);

    };

    $('.removep').live('click', function() {
        $(this).parent().parent().remove();
    });
</script>
<script>
    $(document).on("change", ".amountT", function() {
    var sum = 0;
    $(".amountT").each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
});
</script>
<script>
    $(document).on("change", ".totalp", function() {
    var sum = 0;
    $(".totalp").each(function(){
        sum += +$(this).val();
    });
    $(".gtot").val(sum);
});
</script>
<script>
    function sum() {
        // var i = 0;
        var txtFirstNumberValue = document.getElementById('quan').value;
        var txtSecondNumberValue = document.getElementById('hargaP').value;
        var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
        if (!isNaN(result)) {
            document.getElementById('totalP').value = result;
        }
    }
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
        if (res.salesorder_id) {
            const amsales = res.sorder.user_technikals.map((item) => {
                if (item.a_m != null) {
                    return item.a_m.name;
                }
            })
            const presales = res.sorder.user_technikals.map((item) => {
                if (item.user_technikal != null) {
                    return  item.user_technikal.name;
                }
            });
            
            $("#ID_project").val(res.sorder.ID_project)
            $("#NamaClient").val(res.sorder.NamaClient)
            $("#NamaProject").val(res.sorder.NamaProject)
            $("#estimated_amount").val(null)
            $("#Status").val(res.sorder.Status)
            $("#distributor").val(res.sorder.distributor)
            $("#presales").val(presales)
            $("#sbu").val(null)
            $("#amsales").val(amsales)
            $("#principal").val(res.sorder.principal)
            $("#confidence_level").val(null)
            $("#contract_amount").val(null)
            $("#file_project").val(res.sorder.UploadDocument)
            $("#listadmin_id").val(res.sorder.id)
            $("#listpipe_id").val(null)
            $("#no_customer").val(res.sorder.ID_Customer)
        }
        if (res.salesopty_id) {
            const presales = res.sopty.user_technikals_pipe.map(item => item.user_technikal.name)
            $("#ID_project").val(res.sopty.ID_project)
            $("#NamaClient").val(res.sopty.NamaClient)
            $("#NamaProject").val(res.sopty.NamaProject)
            $("#estimated_amount").val(res.sopty.estimated_amount)
            $("#Status").val(res.sopty.Status)
            $("#distributor").val(res.sopty.distributor)
            $("#presales").val(presales)
            $("#sbu").val(res.sopty.sbu) 
            $("#amsales").val(res.sopty.name_user)
            $("#principal").val(res.sopty.elearning_id)
            $("#confidence_level").val(res.sopty.confidence_level)
            $("#contract_amount").val(res.sopty.contract_amount)
            $("#file_project").val(res.sopty.UploadDocument)
            $("#listpipe_id").val(res.sopty.id)
            $("#listadmin_id").val(null)
            $("#no_customer").val(res.sopty.no_customer)
        }
    })
  });
</script>
{{-- <script>
    var harga2 = document.getElementById('contract_amount');
    harga2.addEventListener('keyup', function(e)
    {
        harga2.value = formatRupiah(this.value, 'Rp. ');
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
</script> --}}
@endsection