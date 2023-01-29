@extends('layouts.main')
@section('title', 'Dashboard HRD')

@section('css')
    <style>
        .card.card-statistic-1, .card.card-statistic-2 {
            display: inline-block;
            width: 100%;
        }

        .card.card-statistic-1 .card-icon {
            line-height: 90px;
        }

        .card.card-statistic-1 .card-icon, .card.card-statistic-2 .card-icon {
            width: 80px;
            height: 80px;
            margin: 10px;
            border-radius: 3px;
            line-height: 94px;
            text-align: center;
            float: left;
            margin-right: 15px;
        }
        .card.card-statistic-1 .card-header, .card.card-statistic-2 .card-header {
            padding-bottom: 0;
            padding-top: 25px;
        }

        .card.card-statistic-1 .card-header, .card.card-statistic-2 .card-header {
            border-color: transparent;
            padding-bottom: 0;
            height: auto;
            min-height: auto;
            display: block;
        }
    </style>
@endsection

@section('content')
<section class="section">
    <div class="card">
        <div class="card-header">
            <h1>Welcome</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user text-white"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                @php $data = \Illuminate\Support\Facades\DB::table('hrds')->count(); @endphp
                                <h4>Total Data Karyawan</h4>
                            </div>
                            <div class="card-body"> {{ $data }} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

