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
            <h1>Create Project</h1>
        </div>
        <div class="card-body">
            <form action="{{route('svcpt')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="row">
                    <div class="column col-4">
                        <div class="form-group">
                            <label for="ID_project"><b>Project Code</b></label>
                            <input type="text" class="form-control" name="id_project" placeholder="Project ID" >
                        </div>
                        <div class="form-group">
                            <label><b>Project Name</b></label>
                            <div class="input-group date">
                                <input type="text" class="form-control" name="project_name" placeholder="Project Name" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="required"><b>Principal Name</b></label>
                            <select name="principal_name" class="form-control" id="">
                                <option value=""></option>
                                @foreach ($cp as $item)
                                    <option value="{{$item->principal_name}}">{{$item->principal_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="column col-4">
                        <div class="form-group">
                            <label for="NamaClient"><b>Client Name</b></label>
                            <select name="client_name" class="form-control" id="">
                                <option value=""></option>
                                @foreach ($cc as $item)
                                    <option value="{{$item->client_name}}">{{$item->client_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="ID_project"><b>Upload File Hitungan</b></label>
                            <input type="file" class="form-control"  name="file">
                        </div>

                        <div class="form-group">
                            <label for="ID_project"><b>Lain - Lain</b></label>
                            <input type="text" class="form-control"   name="lain" value="-">
                        </div>
                        
                    </div>

                    <div class="column col-4">

                        <div class="form-group">
                            <label class="required"><b>BMT-Awal</b></label>
                            <input type="number" name="bmt" id="b"  class="form-control" >
                        </div>

                        <div class="form-group">
                            <label for="NamaClient"><b>Services</b></label>
                            <input type="number" class="form-control" id="s" name="services" >
                        </div>
                        
                        <div class="form-group">
                            <label class="required"><b>Sub Total</b></label>
                            <input type="number" name="subtotal" id="subtot"  class="form-control" readonly style="background-color: #EC4537;color:#ffffff;" >
                        </div>
                    </div>

                    <div class="column col-4">
                        <div class="form-group">
                            <label class="required"><b>Bunga Admin</b></label>
                            <input type="number" name="bunga_admin" id="bg" class="form-control" placeholder="%" >
                        </div>

                        <div class="form-group">
                            <label class="required"><b>Biaya Admin</b></label>
                            <input type="number" name="biaya_admin" id="ab" class="form-control" readonly >
                        </div>

                        <div class="form-group">
                            <label for="NamaClient"><b>Biaya Pengurang (BPK)</b></label>
                            <input type="number" class="form-control" id="bk" name="biaya_pengurangan" >
                        </div>
                        
                        <div class="form-group">
                            <label class="required"><b>Total</b></label>
                            <input type="number" name="total_final"  class="form-control" id="tot" readonly style="background-color: black;color:#ffffff;" >
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

                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{ route('/indexCPT') }}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</section>
@endsection
@section('js')
<script src="http://code.jquery.com/jquery-2.1.4.js"></script>
<script src="{{asset('newassets/assets/extensions/choices.js/public/assets/scripts/choices.js')}}"></script>
<script src="{{asset ('newassets/assets/js/pages/form-element-select.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $("#s,#bk,#bg").keyup(function(){
        var bmt  = parseInt($("#b").val());
        var services = parseInt($("#s").val());
        var subtot = bmt + services ;
        var bpk = parseInt($("#bk").val());
        var bunga_admin = parseInt($("#bg").val());
        var ab =  ((bunga_admin/100)*subtot);
        var total = subtot - ab - bpk;
            $("#subtot").val(subtot);
            $("#tot").val(total);
            $("#ab").val(ab)
      });
    });
  </script>
@endsection