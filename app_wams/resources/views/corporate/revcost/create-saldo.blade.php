@extends('layouts.main')
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header"><h2>Create Initial Balance</h2></div>
            <div class="card-body">
                <form action="{{ route('store-saldo') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Total Balance</label>
                                <input type="number" name="jumlah_saldo" class="form-control" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Balance Date</label>
                                <input type="date" name="tanggal_saldo" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="{{ route('index-saldo') }}" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

