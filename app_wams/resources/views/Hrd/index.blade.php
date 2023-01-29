@extends('layouts.main')

@section('title', 'Data Karyawan')

@section('css')
<link rel="stylesheet" href="{{ asset('newassets/assets/css/pages/fontawesome.css') }}">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-colvis-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.css" />

@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <div class="card">
            <div class="alert">
                <h2 class="text-capitalize text-center">List Data Karyawan</h2>
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
                            <a href="{{route('hrd.create')}}" class="btn btn-primary">
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
                            <input type="text" class="form-control" placeholder="Search name karyawan" id="search" autocomplete="Off">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered " id="hrd">
                        <thead>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Gender</th>
                            <th>Joined</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </table>
                </div>
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
<script src="{{ asset('js/hrd.js') }}"></script>

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
@endsection