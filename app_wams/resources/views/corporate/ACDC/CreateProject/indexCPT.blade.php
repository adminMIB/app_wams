@extends('layouts.main')

@section('title', 'All Projects')

@section('css')
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />
<style>
    .table-loader {
        visibility: hidden;
    }
    .table-loader:before {
        visibility: visible;
        display: table-caption;
        content: " ";
        width: 100%;
        height: 600px;
        background-image: linear-gradient(rgba(235, 235, 235, 1) 1px, transparent 0),
        linear-gradient(90deg, rgba(235, 235, 235, 1) 1px, transparent 0),
        linear-gradient(90deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.5) 15%, rgba(255, 255, 255, 0) 30%),
        linear-gradient(rgba(240, 240, 242, 1) 35px, transparent 0);
        background-repeat: repeat;
        background-size: 1px 35px,
        calc(100% * 0.1666666666) 1px,
        30% 100%,
        2px 70px;
        background-position: 0 0,
        0 0,
        0 0,
        0 0;
        animation: shine 0.5s infinite;
    }
    @keyframes shine {
        to {
            background-position: 0 0,
            0 0,
            40% 0,
            0 0;
        }
    }
    
    .picker__theme_dark {
        background-color: black;
        color: white;
    }

    .picker__theme_dark li:hover {
        color: black
    }
</style>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <div class="card">
            <div class="alert">
                <h2 class="text-capitalize text-center">List Create Project ACDC</h2>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Filter</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5">
                    <div class="form-group">
                        <label for="">Client</label>
                        <select id="client_filter" class="form-control select2">
                            <option value="" readonly>-----PILIH------</option>
                            @forelse ($client as $item)
                                <option value="{{ $item->client_name }}">{{ $item->client_name }}</option>
                            @empty
                                <option value="">tidak ada data</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="form-group">
                        <label for="">Principal</label>
                        <select id="principal_filter" class="form-control select2">
                            <option value="" readonly>-----PILIH------</option>
                            @forelse ($principal as $item)
                                <option value="{{ $item->principal_name }}">{{ $item->principal_name }}</option>
                            @empty
                                <option value="">tidak ada data</option>
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <div class="pt-3"></div>
                        <button class="btn btn-danger" id="reset">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="border-radius: 2em">
        <div class="card-header">
            <div class="card-header">
                <div class="row">
                    <div class="col pull-left"></div>
                    <div class="col pull-right">
                        <div style="float: right;">
                            <a href="{{route('/cpt')}}" class="btn btn-primary">
                                Create <i class="fa fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-6 pull-left">
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <div id="date-range" class="form-control">
                                        <i class="fa fa-calendar"></i>&nbsp;
                                        <span></span> <i class="fa fa-caret-down"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-3 pull-right">
                            <input type="text" class="form-control" placeholder="Search project name" id="search" autocomplete="Off">
                        </div>
                    </div>
                </div>
            </div>
        <div class="table-responsive">
                <table class="table table-bordered " id="project">
                    <thead>
                        <th>No</th>
                        <th>Project ID</th>
                        <th>Project</th>
                        <th>Client</th>
                        <th>Principal</th>
                        <th>Subtotal Final</th>
                        <th>CreatedAt</th>
                        <th>Action</th>
                    </thead>
                </table>
            </table>
        </div>
        </div>
    </div>

    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="page" class="p-2">
    
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ asset('js/project_acdc.js') }}"></script>

<script>
    $(init)
        function init() {
            if ($('body').hasClass('theme-dark')) {
                $(".ranges").addClass('picker__theme_dark')
            } else {
                $('.ranges').removeClass('picker__theme_dark')
            }
        }
        $('input[type="checkbox"]').click(function(){
            if ($('body').hasClass('theme-dark')) {
                $(".ranges").addClass('picker__theme_dark')
            } else {
                $('.ranges').removeClass('picker__theme_dark')
            }
        })
</script>

<script>
    function CreateTM(id){
        $.get("{{url('createTM')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Transaction Maker')
            $("#page").html(data);
            $("#exampleModal").modal('show');
        });
    }
</script>
@endsection
