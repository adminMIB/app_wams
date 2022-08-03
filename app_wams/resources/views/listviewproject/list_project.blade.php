@extends('layouts.main')
@section('content')
<section class="section">
    <div class="section-header">
        <h1>List Project Timeline</h1>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <a href="{{route('input')}}"><button type="submit" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Create</button></a>

                <hr>
                <thead>
                    <tr align="center">
                        <th>No</th>
                        <th>No Work Order</th>
                        <th>Tanggal WO</th>
                        <th>Nama Institusi</th>
                        <th>Nama Project</th>
                        <th>Quantity</th>
                        <th>Nama Sales</th>
                        <th>HPS</th>
                        <th>PM Lead</th>
                        <th>Action</th>

                    </tr>
                </thead>

                <tbody>
                   
                </tbody>
            </table>
        </div>
    </div>



</section>
@endsection
