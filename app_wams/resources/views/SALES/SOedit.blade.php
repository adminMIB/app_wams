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
          <h1>Edit LTO</h1>
        </div>
        <div class="card-body">
        <form action="{{url('update-dataS',$product->id)}}" method="POST" enctype="multipart/form-data">
          {{csrf_field()}}
          @method('put')
            <div class="row">
                <input type="hidden" class="form-control" name="file_project" value="{{ $product->file_project }}" id="file_project" readonly>
                <input type="hidden" class="form-control" name="estimated_amount" value="{{ $product->estimated_amount }}" id="" readonly>
                <input type="hidden" name="no_customer" value="{{ $product->no_customer }}" id="no_customer" class="form-control" readonly>

                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">No LTO</label>
                        <input type="text" class="form-control" name="no_so"  value="{{$product->no_so}}" id="exampleInputEmail1" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="ID_project">Project Code</label>
                        <input type="text" class="form-control" id="ID_project" value="{{$product->kode_project}}" name="kode_project" placeholder="Project ID" readonly>
                    </div>
                    @if ($product->status == "Approve")
                    <div class="form-group">
                        <label class="text-danger"><b>PM Signment</b></label>
                        <select class="form-select select2" name="pmo">
                            @if (!$product->pmo)
                            <option value="">User PM</option>
                            @else
                            <option value="{{$product->pmo}}">{{$product->pmo}}</option>
                            @endif
                            @foreach ($pmLead as $item)
                                @foreach ($item->users as $user)
                                    <option  value="{{$user->name}}">{{$user->name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    @else
                    <input type="text" class="d-none" name="pmo">
                    @endif
                    <div class="form-group">
                        <label class="required"><b>Technical</b></label>
                        <input type="text" name="presales" id="presales" value="{{$product->presales}}" class="form-control" placeholder="Presales" readonly>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>AM/sales</b></label>
                        <input type="text" name="amsales" id="amsales" value="{{$product->amsales}}" class="form-control" placeholder="Presales" readonly>
                    </div>
                </div>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Project Name</label>
                        <input type="text" class="form-control" name="project" value="{{$product->project}}" id="exampleInputEmail1" placeholder="Project">
                    </div>
                    
                    <div class="form-group">
                        <label class="required"><b>Principal</b></label>
                        <input type="text" name="principal" id="principal" value="{{$product->principal}}" class="form-control" placeholder="Principal">
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Progress Status</b></label>
                        <input type="text" name="status_project" id="Status" value="{{$product->status_project}}" class="form-control" placeholder="Progress Status">
                    </div>                
                    <div class="form-group">
                        <label class="required"><b>Contract Amount</b></label>
                        <input type="number" name="contract_amount" id="contract_amount" value="{{$product->contract_amount}}" class="form-control" placeholder="Contract Amount">
                    </div>                
                </div>
                <div class="column col-4">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Client Name</label>
                        <input type="text" class="form-control" name="institusi" value="{{$product->institusi}}" id="exampleInputEmail1" placeholder="Institusi">
                    </div>
                    <div class="form-group">
                        <label>LTO Date</label>
                        <div class="input-group date">
                            <input type="date" class="form-control datetimepicker-input" name="tgl_so"  value="{{$product->tgl_so}}" id="Date" placeholder="TGL LTO" data-target="#reservationdate"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="required"><b>Distributor</b></label>
                        <input type="text" name="distributor" id="distributor" class="form-control"  value="{{$product->distributor}}" placeholder="Distributor">
                    </div>
                    <div class="form-group">
                        <label class=""><b>SBU</b></label>
                        <select class="form-select select2" name="sbu">
                            <option value="{{$product->sbu}}">{{$product->sbu}}</option>
                            @foreach ($sbu as $item)
                                <option  value="{{$item->name}}">{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label class="required"><b>Confidence Level</b></label>
                        <input type="text" name="confidence_level" id="confidence_level" value="{{$product->confidence_level}}" class="form-control" placeholder="Presales">
                    </div> --}}
                </div>
            </div>

            {{-- <div>
                <button type="button" class="addamount btn btn-success" style="float:right;"><i class="fa-fas fa-plus"></i> Cost Amount</button>
                <h3 class="mb-3">Cost Amount</h3>
            </div>

            @foreach ($product->amdetail as $item)
            <div class="col-lg-10">
                <div class="row mb-2">
                    <div class="col-md-4 mr-2">
                        <input type="text" class="form-control" name="title[]" value="{{ $item->title }}">
                    </div>
                    <div class="col-md-4 mr-2">
                        <input type="number" class="form-control amountT" name="amount[]" value="{{ $item->amount }}">
                    </div>
                    <button type="button" class="remove btn btn-danger col-md-1" style="float:right;"><i class="bi bi-trash"></i></button>
                </div>
            </div>
            @endforeach
           
            <div class="amount">
            </div>
            
            <div class="form-group w-25">
                <label for="total">Total</label>
                <input type="number" class="form-control total" value="{{ $product->total }}" name="totalSO" readonly >
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
                    @foreach ($product->pddetail as $item)
                    <tr class="row-cols-4 ">
                        <td><input class="underline-input form-control " type="text" name="product_name[]" value="{{ $item->product_name }}" /></td>
                        <td><input class="underline-input form-control multi" type="number" id="quantity" name="product_quantity[]" value="{{ $item->product_quantity }}" /></td>
                        <td><input class="underline-input form-control multi" type="number" id="price" name="harga_product[]" value="{{ $item->harga_product }}" /></td>
                        <td><input class="underline-input form-control product" type="number" id="product" name="total[]" value="{{ $item->total }}" /></td>
                        <td><button type="button" class="removep btn btn-danger"><i class="bi bi-trash"></i></button></td>
                    </tr>
                    @endforeach
                </tbody>
                <tr>
                    <th colspan="2"></th>
                    <th>Grand Total</th>
                    <td><input class="underline-input form-control" type="number" id="gtotal" value="{{ $product->grandtotal }}" name="grandtotal" readonly/></td>
                </tr>
            </table> --}}
            
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Distributor Price Offers</b></label>
                        <p class="text-danger">Old File</p>
                        <input type="text" class="form-control mb-2" name="file_PHD" value="{{ $product->file_PHD }}" readonly>
                        <input type="file" class="form-control" name="file_PHD">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>SPK/PO/SPBBJ Client</b></label>
                        <p class="text-danger">Old File</p>
                        <input type="text" class="form-control mb-2" name="file_SPSC" value="{{ $product->file_SPSC }}" readonly>
                        <input type="file" class="form-control" name="file_SPSC">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label><b>Sales Offer</b></label>
                        <p class="text-danger">Old File</p>
                        <input type="text" class="form-control mb-2" name="file_PS" value="{{ $product->file_PS }}" readonly>
                        <input type="file" class="form-control" name="file_PS">
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
@push('script-internal')
{{-- JS assets at the bottom --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
{{-- ...Some more scripts... --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
  $('.addamount').on('click', function() {
    addamount();
  });

  function addamount() {
    var amount = '<div class="col-lg-10"><div class="row mb-2"><div class=" col-md-4 mr-2"><input type="text" class="form-control" name="title[]"></div><div class=" col-md-4 mr-2"><input type="number" class="form-control amountT" name="amount[]"></div><button type="button" class="remove btn btn-danger col-md-1" style="float:right;"><i class="bi bi-trash"></i></button></div></div>';
    $('.amount').append(amount);
  };
  $('.remove').live('click', function() {
    $(this).parent().remove();
  });
</script>
{{-- <script type="text/javascript">
    $('.addProduct').on('click', function() {
      addProduct();
    });
  
    function addProduct() {
      var productplace = '<div class="container mb-3"><div class="row"><div class="mr-2"><label for="" class="">Nama Product</label><input type="text" class="form-control" name="product_name[]"></div><div class="mr-2"><label for="" class="">Quantity</label><input type="text" class="form-control" id="qty" name="product_quantity[]"></div><div class="mr-2"><label for="" class="">Harga</label><input type="text" class="form-control" id="harga" name="harga_product[]"></div><div class="mr-2"><label for="" class="">Total</label><input type="text" class="form-control totalp" id="totalP" name="total[]"></div><div class="align-self-end mb-1 ml-2"><a href="#" class="removep btn btn-danger"><i class="fas fa-trash"></i></a></div></div></div>';
      $('.productplace').append(productplace);
    };
    $('.removep').live('click', function() {
      $(this).parent().parent().parent().remove();
    });
  </script> --}}
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
@endpush