@extends('layouts.main')
@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h1>Tambah Produk/Solusi</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('psupdate',$data_prosol->id) }}" method="POST">
                {{csrf_field()}}
                @method('put')
                <div class="d-flex">
                    <div class="col form-group">
                        <label for="principal">Principal</label>
                        <input type="text" class="form-control" name="principal" id="principal" value="{{ $data_prosol->principal }}" placeholder="Principal">
                    </div>
                    <div class="col form-group">
                        <label for="distributor">Distributor</label>
                        <input type="text" class="form-control" name="distributor" id="distributor" value="{{ $data_prosol->distributor }}" placeholder="Distributor">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <a href="{{route('produksolusi')}}" class="btn btn-secondary">Back</a>
            </form>
        </div>
    </div>
</section>
@endsection