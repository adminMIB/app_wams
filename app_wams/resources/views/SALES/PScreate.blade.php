@extends('layouts.main')
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h1>Tambah Produk/Solusi</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('pssimpan') }}" method="POST">
                {{csrf_field()}}
                <div>
                    <select name="so_id" id="" class="form-control w-25">
                        <option value=""></option>
                        @foreach ($sod as $item)
                            <option value="{{ $item->id }}">{{ $item->id }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <a href="#" class="addamount btn btn-success" style="float:right;"><i class="fa-fas fa-plus"></i> </a>
                </div>
               
                <div class="amount"></div>
                
                <div class="form-group col-4">
                    <label for="total">Total</label>
                    <input type="number" class="form-control total" name="total" readonly >
                </div> 
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{route('produksolusi')}}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</section>
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript">
  $('.addamount').on('click', function() {
    addamount();
  });

  function addamount() {
    var amount = ' <div class="row"><div class="col-4 col-sm-4"><label for="tes">Tes</label><input type="text" class="form-control"  name="tes[]" ></div><div class="col-4 col-sm-4"><label for="amount">Cost Amount</label><input type="number" class="form-control amount" name="amount[]" ></div><br><a href="#" class="remove btn btn-danger" style="float:right;"><i class="fas fa-trash"></i></a></div>';
    $('.amount').append(amount);
  };
  $('.remove').live('click', function() {
    $(this).parent().remove();
  });
</script>
<script>
    $(document).on("change", ".amount", function() {
    var sum = 0;
    $(".amount").each(function(){
        sum += +$(this).val();
    });
    $(".total").val(sum);
});
</script>
@endsection