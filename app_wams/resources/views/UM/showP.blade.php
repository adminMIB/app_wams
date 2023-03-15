@extends('layouts.main')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
    <style>
        table {
        width: 100%;
        border-collapse: collapse;
        }

        table tr td {
        padding: 0;
        }

        table tr td:last-child {
        text-align: right;
        }

        .bold {
        font-weight: bold;
        }

        .right {
        text-align: right;
        }

        .large {
        font-size: 1.75em;
        }

        .total {
        font-weight: bold;
        color: #000000;
        }

        .logo-container {
        margin: 20px 0 70px 0;
        }

        .invoice-info-container {
        font-size: 0.875em;
        }
        .invoice-info-container td {
        padding: 4px 0;
        }

        .client-name {
        font-size: 1.5em;
        vertical-align: top;
        }

        .line-items-container {
        margin: 70px 0;
        font-size: 0.875em;
        }

        .line-items-container th {
        text-align: left;
        color: #999;
        border-bottom: 2px solid #ddd;
        padding: 10px 0 15px 0;
        font-size: 0.75em;
        text-transform: uppercase;
        }

        .line-items-container th:last-child {
        text-align: right;
        }

        .line-items-container td {
        padding: 15px 0;
        }

        .line-items-container tbody tr:first-child td {
        padding-top: 25px;
        }

        .line-items-container.has-bottom-border tbody tr:last-child td {
        padding-bottom: 25px;
        border-bottom: 2px solid #ddd;
        }

        .line-items-container.has-bottom-border {
        margin-bottom: 0;
        }

        .line-items-container th.heading-quantity {
        width: 50px;
        }
        .line-items-container th.heading-price {
        text-align: right;
        width: 100px;
        }
        .line-items-container th.heading-subtotal {
        width: 100px;
        }

        .payment-info {
        width: 38%;
        font-size: 0.75em;
        line-height: 1.5;
        }

        .footer {
        margin-top: 100px;
        }

        .footer-thanks {
        font-size: 1.125em;
        }

        .footer-thanks img {
        display: inline-block;
        position: relative;
        top: 1px;
        width: 16px;
        margin-right: 4px;
        }

        .footer-info {
        float: right;
        margin-top: 5px;
        font-size: 0.75em;
        color: #ccc;
        }

        .footer-info span {
        padding: 0 5px;
        color: black;
        }

        .footer-info span:last-child {
        padding-right: 0;
        }

        .page-container {
        display: none;
        }
    </style>
@endsection
@section('content')
<section class="section">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab"
                            aria-controls="home" aria-selected="true">LTO</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab"
                            aria-controls="profile" aria-selected="false">Timeline</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab"
                            aria-controls="contact" aria-selected="false">Task Progress</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="taskT-tab" data-bs-toggle="tab" href="#taskT" role="tab"
                            aria-controls="taskT" aria-selected="false">Task Kanban</a>
                    </li>
                </ul>
            </div>
            <div class="card-footer">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">                            
                            <div class="row">
                                <input type="hidden" class="form-control" name="file_project" value="{{ $shorder->file_project }}" id="file_project" readonly>
                                <div class="column col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">No LTO</label>
                                        <input type="text" class="form-control" name="no_so"  value="{{$shorder->no_so}}" id="exampleInputEmail1" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>LTO Date</label>
                                        <div class="input-group date">
                                            <input type="text" class="form-control datetimepicker-input" name="tgl_so"  value="{{ date('d-m-Y', strtotime($shorder->tgl_so)) }}" id="Date" placeholder="TGL LTO" data-target="#reservationdate"readonly />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="required"><b>Distributor</b></label>
                                        <input type="text" name="distributor" id="distributor" class="form-control"  value="{{$shorder->distributor}}" placeholder="Distributor" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="required"><b>SBU</b></label>
                                        <input type="text" name="sbu" id="sbu" class="form-control"  value="{{$shorder->sbu}}" placeholder="SBU" readonly>
                                    </div>
                                </div>
                                <div class="column col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Project Name</label>
                                        <input type="text" class="form-control" name="project" value="{{$shorder->project}}" id="exampleInputEmail1" placeholder="Project" readonly>
                                    </div>
                                    <div class="form-group">
                                        {{-- <label class="required"><b>Estimated Amount</b></label> --}}
                                        <input type="hidden" name="estimated_amount" id="estimated_amount" value="{{$shorder->estimated_amount}}" class="form-control" placeholder="Estimated Amount" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="required"><b>Principal</b></label>
                                        <input type="text" name="principal" id="principal" value="{{$shorder->principal}}" class="form-control" placeholder="Principal" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="required"><b>Progress Status</b></label>
                                        <input type="text" name="status_project" id="Status" value="{{$shorder->status_project}}" class="form-control" placeholder="Progress Status" readonly>
                                    </div>                
                                    <div class="form-group">
                                        <label class="required"><b>Confidence Level</b></label>
                                        <input type="text" name="confidence_level" id="confidence_level" value="{{$shorder->confidence_level}}" class="form-control" placeholder="Presales"readonly>
                                    </div>
                                        <input type="hidden" name="contract_amount" id="contract" value="{{$shorder->contract_amount}}" class="form-control" placeholder="Contract Amount" readonly>               
                                </div>
                                <div class="column col-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Client Name</label>
                                        <input type="text" class="form-control" name="institusi" value="{{$shorder->institusi}}" id="exampleInputEmail1" placeholder="Institusi" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="ID_project">Project Code</label>
                                        <input type="text" class="form-control" id="ID_project" value="{{$shorder->kode_project}}" name="kode_project" placeholder="Project ID" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="required"><b>PMO</b></label>
                                        <input type="text" name="pmo" id="pmo" value="{{$shorder->pmo}}" class="form-control" placeholder="PMO" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="required"><b>Prasales</b></label>
                                        <input type="text" name="presales" id="presales" value="{{$shorder->presales}}" class="form-control" placeholder="Presales" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label class="required"><b>AM/sales</b></label>
                                        <input type="text" name="amsales" id="amsales" value="{{$shorder->amsales}}" class="form-control" placeholder="Presales" readonly>
                                    </div>
                                </div>
                            </div>
                            
                        
                            <div>
                                {{-- <a href="{{ route('VIEWLTODONE') }}" class="btn btn-secondary">Back</a> --}}
                            </div>

                            <div class="d-none" id="soexel">

                                <div class="page-container">
                                    Page
                                    <span class="page"></span>
                                    of
                                    <span class="pages"></span>
                                </div>
                                
                                <img style="height: 100px;" src="https://mitraintibersama.com/assets/img/logo-mib.png">
                            <div class="">
                                    <h3 class="text-primary">LTOs</h3>
                                <table class="w-50">
                                    <thead>
                                        <tr>
                                        <th>Referensi</th>
                                        <td>{{ $shorder->no_so }}</td>
                                        </tr>
                                        <tr>
                                        <th>Tanggal</th>
                                        <td>{{ date('d-m-Y', strtotime($shorder->tgl_so)) }}</td>
                                        </tr>
                                        <tr>
                                        <th>Status</th>
                                        <td><b>{{ $shorder->status }}</b></td>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <table class="mt-5">
                                <thead>
                                    <tr>
                                        <th class="text-center">Info Perusahaan <hr></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-center">Order Dari <hr></th>
                                        </tr>
                                        <tr>
                                        <th class="text-center">PT. Mitra Inti Bersama</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th class="text-center">{{ $shorder->distributor }}</th>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            Rukan Mangga Dua Squere Blok F 7-11, 
                                            Jl. Gunung Sahari Raya No. 1, Jakarta Utara, 
                                            DKI Jakarta, 14430 
                                            Indonesia
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td class="text-center">
                                            Gd Palma One Lt 5 Suite 500 , 
                                            Jl HR Rasuna Said Blok X2 Kav 4 Kuningan Timur 
                                            Setiabudi, Jakarta Selatan, 
                                            DKI Jakarta, 12950
                                            Indonesia
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                                
                            <table class="table" style="margin-top: 50px;">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Produk</th>
                                        <th>Kuantitas</th>
                                        <th>Harga</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @foreach ($shorder->pddetail as $item)
                                        @php
                                        $ab = $item->total + $item->total;
                                        @endphp
                                        <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->product_quantity }}</td>
                                        <td>{{ $item->harga_product }}</td>
                                        <td>{{ $item->total }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            <table class="line-items-container has-bottom-border">
                                    <thead>
                                    <tr>
                                        <th>Syarat dan Ketentuan</th>
                                        <th>di Buat Tanggal</th>
                                        <th>Sub Total</th>
                                    </tr>
                                    </thead>
                                <tbody>
                                    <tr>
                                        <td class="payment-info">
                                        <div>
                                            TOP :
                                        </div>
                                        <div>
                                            Back to Back
                                        </div>
                                        </td>
                                        <td class="large">{{ date('D, M Y') }}</td>
                                        <td class="large total">Rp. {{ $shorder->grandtotal }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            </div>

                            <script src="../assets/js/export_exel.js"></script>
                    </div>

                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="table-responsive  mb-2">
                                        <table id="" class="table table-bordered">
                                        <thead>
                                            <tr align="center" style="font-size: 13px">
                                                <th scope="col">Project Code</th>
                                                <th scope="col">No LTO</th>
                                                <th scope="col">LTO Date</th>
                                                <th scope="col">Client Name</th>
                                                <th scope="col">Project Name</th>
                                                {{-- <th scope="col">AM</th> --}}
                                                <th scope="col">PM</th>
                                                <th scope="col">Technical</th>
                                                <th scope="col">Start Date</th>
                                                <th scope="col">End Date</th>
                                                <th scope="col">Task</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($shorder->listtimeline as $r)
                                            @foreach($r->detail as $tm)
                                            <tr align="center" style="font-size: 13px">
                                                <td>{{$r->kode_project}}</td>
                                                <td>{{$r->no_sales}}</td>
                                                <td>{{date('d/m/Y', strtotime($r->tgl_sales))}}</td>
                                                <td>{{$r->nama_institusi}}</td>
                                                <td>{{$r->nama_project}}</td>
                                                {{-- <td>{{$r->nama_sales}}</td> --}}
                                                <td>{{$tm->nama_pm}}</td>
                                                <td>{{ $tm->nama_technical }}</td>
                                                <td>{{ date('d/m/Y', strtotime($tm->start_date)) }}</td>
                                                <td>{{ date('d/m/Y', strtotime($tm->finish_date)) }}</td>
                                                <td>{{ $tm->jenis_pekerjaan }}</td>
                                            </tr>
                                            @endforeach
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                <div>
                                        {{-- <a href="{{ route('VIEWLTODONE') }}" class="btn btn-secondary">Back</a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="table-responsive">
                            <table id="task" class="table table-bordered ">
                            <thead>
                                <tr align="center" style="font-size: 13px">
                                <th scope="col">Project Code</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Project Name</th>
                                <th scope="col">AM</th>
                                <th scope="col">PM</th>
                                <th scope="col">Task</th>
                                <th scope="col">Status Pekerjaan</th>
                                <th scope="col">Technical</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($shorder->weeklies as $r)
                                <tr align="center" style="font-size: 13px">
                                <td>{{$shorder->kode_project}}</td>
                                <td>{{$shorder->institusi}}</td>
                                <td>{{$shorder->project}}</td>
                                <td>{{$shorder->amsales}}</td>
                                <td>{{$shorder->pmo}}</td>
                                <td>{{$r->job_essay}}</td>
                                <td>
                                    @if ($r->status == 0)
                                    <div class="badge bg-primary">To Do</div>
                                    @elseif ($r->status == 1)
                                    <div class="badge bg-warning">In Progress</div>
                                    @elseif ($r->status == 2)
                                    <div class="badge bg-success">Done</div>
                                    @endif 
                                </td>
                                <td><a href="{{url('/projectsT/view',$shorder->id)}}">{{$r->name_technikal}}</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                            </table>
                            <div>
                                {{-- <a href="{{ route('VIEWLTODONE') }}" class="btn btn-secondary">Back</a> --}}
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="taskT" role="tabpanel" aria-labelledby="taskT-tab">
                        <div class="row">
                            <div class="col-xl-4">
                                <div class="card" >
                                    <div class="card-body taskboard-box" style="overflow-y: auto;height:400px">
                                            <h4 class="header-title mt-0 mb-3  shadow text-center " style="border-radius:4%;border-color:#2B60DE;border-style:ridge"><span >To Do</span></h4>
                                        <ul class="sortable-list list-unstyled taskList ui-sortable connectedSortable" id="padding-item-drop" >
                                            <span class="list-group-item" style=" opacity: 0;">todo</span>
                                                {{-- @if(!empty($cb) && $cb->count()) --}}
                                                @foreach($shorder->weeklies as $value)
                                                @if ($value->status == 0)
                                            <li class="ui-sortable-handle border rounded p-2 mb-2 shadow" onclick="show({{$value->id}})" item-id="{{ $value->id }}"  >
                                                <div class="kanban-box">
                                                    <div class="kanban-detail">
                                                        <h5 class="mt-0" ><a style="font-size: 13px" ><i class="fas fa-briefcase "></i> {{$value->job_essay}}</a></h5>
                                                        <ul class="list-inline">
                                                            <span class="badge bg-light-success" style="font-size: 10px"  > <i class="fas fa-clock text-black mt-2 mr-2 align-center" ></i> {{ date('d-m-Y', strtotime($value->start_date)) }}</span> 
                                                            <span class="badge bg-light-danger" style="font-size: 10px" >{{ date('d-m-Y', strtotime($value->end_date)) }} </span>
                                                            <br>
                                                            <span class="badge bg-light-secondary" style="font-size: 10px" ><i class="fas fa-user"></i> {{$value->name_technikal}}</span>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                                @endif
                                                @endforeach
                                                {{-- @endif --}}
                                        </ul>
                                            
                                        </div>
                                    </div>
                                </div><!-- end col -->
                            
                            
                            <div class="col-xl-4">
                                <div class="card" >
                                    <div class="card-body taskboard-box" style="overflow-y: auto;height:400px; complete-item" >
                                        <h4 class="header-title mt-0 mb-3 shadow text-center " style="border-radius:4%;border-color:#F88017;border-style:ridge"> <span >In Progress</span> </h4>
                                        <ul class="sortable-list list-unstyled taskList ui-sortable connectedSortable" id="complete-item-drop" >
                                            <li class="list-group-item" style=" opacity: 0;">inprogress</li>
                                            {{-- @if(!empty($bc) && $bc->count()) --}}
                                            @foreach($shorder->weeklies as$value)
                                            @if ($value->status == 1)
                                            <li class="ui-sortable-handle border rounded p-2 mb-2 shadow" onclick="show({{$value->id}})" item-id="{{ $value->id }}"    >
                                                <div class="kanban-box">
                                                    <div class="kanban-detail">
                                                        <h5 class="mt-0" ><a style="font-size: 13px" ><i class="fas fa-briefcase "></i> {{$value->job_essay}}</a> </h5>
                                                        <ul class="list-inline">
                                                            <span class="badge bg-light-success" style="font-size: 10px"  > <i class="fas fa-clock text-black mt-2 mr-2 align-center" ></i> {{ date('d-m-Y', strtotime($value->start_date)) }}</span> 
                                                            <span class="badge bg-light-danger" style="font-size: 10px" > {{ date('d-m-Y', strtotime($value->end_date)) }}</span>
                                                            <br>
                                                            <span class="badge bg-light-secondary" style="font-size: 10px" ><i class="fas fa-user"></i> {{$value->name_technikal}}</span>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                            @endforeach
                                            {{-- @endif --}}
                                        </ul>
                                </div>
                            </div>
                        </div><!-- end col -->
                            
                            
                            <div class="col-xl-4">
                                <div class="card" >
                                    <div class="card-body taskboard-box" style="overflow-y: auto;height:400px; done-item">
                                        <h4 class="header-title mt-0 mb-3 shadow text-center" style="border-radius:4%;border-color:	#00FF00;border-style:ridge"><span >Done</span></h4>
                                        <ul class="sortable-list list-unstyled taskList ui-sortable connectedSortable" id="done-item-drop" >
                                            <li class="list-group-item" style=" opacity: 0;">done</li>
                                            {{-- @if(!empty($b) && $b->count()) --}}
                                            @foreach($shorder->weeklies as $value)
                                            @if ($value->status == 2)
                                            <li class="ui-sortable-handle border rounded p-2 mb-2 shadow" onclick="show({{$value->id}})" item-id="{{ $value->id }}"      >
                                                <div class="kanban-box">
                                                    <div class="kanban-detail">
                                                        <h5 class="mt-0" ><a href="" data-bs-toggle="modal" data-bs-target="#editweekly{{$value->id}}"  style="font-size: 13px"><i class="fas fa-briefcase "></i> {{$value->job_essay}}</a> </h5>
                                                        <ul class="list-inline">
                                                            <span class="badge bg-light-success" style="font-size: 10px"  > <i class="fas fa-clock text-black mt-2 mr-2 align-center" ></i> {{ date('d-m-Y', strtotime($value->start_date)) }}</span> 
                                                            <span class="badge bg-light-danger" style="font-size: 10px" > {{ date('d-m-Y', strtotime($value->end_date)) }} </span>
                                                            <br>
                                                            <span class="badge bg-light-secondary" style="font-size: 10px" ><i class="fas fa-user"></i> {{$value->name_technikal}}</span>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                            @endforeach
                                            {{-- @endif --}}
                                        </ul>
                                </div>
                            </div>
                            @include('report.edit1')
                            
                        </div><!-- end col -->    
                    </div>

                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Task</h5>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script>
    function show(id){
        $.get("{{url('show-task')}}/"+ id,{},function(data,status){
            $("#exampleModalLabel").html('Edit Product')
            $("#page").html(data);
            $("#exampleModal").modal('show');

        });
    }
</script>


@endsection