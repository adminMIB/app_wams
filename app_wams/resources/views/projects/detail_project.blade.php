@extends('layouts.main')

@section('title','Detail Projects')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.css" rel="stylesheet" />
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
        .dz-image img {
         width: 120px;
         height: 120px;
      }
    </style>
@endsection
@section('content')
<section class="section">
    <h3>{{$shorder->institusi}}</h3>
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
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="dokumen-tab" data-bs-toggle="tab" href="#dokumen" role="tab"
                            aria-controls="dokumen" aria-selected="false">Document</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="bast-tab" data-bs-toggle="tab" href="#bast" role="tab"
                            aria-controls="bast" aria-selected="false">BAST</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a  href="{{url('projects')}}" class="nav-link" style="color: white;background-color:gray;opacity:40%;border-radius:5%;">Back</a>
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
                            <div class="row">
                                <div class="mr-2 col">
                                    <label for="" class=""><b>Distributor Price Offers</b></label>
                                    <a href="/DocumentLTO/{{$shorder->file_PHD}}" class="form-control">{{$shorder->file_PHD}}</a>
                                </div>
                                <div class="mr-2 col">
                                    <label for="" class=""><b>SPK/PO/SPBBJ Client</b></label>
                                    <a href="/DocumentLTO/{{$shorder->file_SPSC}}" class="form-control">{{$shorder->file_SPSC}}</a>
                                </div>
                                <div class="mr-2 col">
                                    <label for="" class=""><b>Sales Offer</b></label>
                                    <a href="/DocumentLTO/{{$shorder->file_PS}}" class="form-control">{{$shorder->file_PS}}</a>
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
                            <div class="card-header">
                                <button type="button" class="btn ml-2 btn-primary btn-sm" style="float: left;" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable{{$shorder->id}}">Add Timeline</button>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="table-responsive  mb-2">
                                        <table id="" class="table table-bordered">
                                        <thead>
                                            <tr align="center" style="font-size: 13px">
                                                <th scope="col">Project Code</th>
                                                <th scope="col">Client Name</th>
                                                <th scope="col">Project Name</th>
                                                <th scope="col">Document</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($shorder->listtimeline as $r)
                                            {{-- @foreach($r->detail as $tm) --}}
                                            <tr align="center" style="font-size: 13px">
                                                <td>{{$r->kode_project}}</td>
                                                <td>{{$r->nama_institusi}}</td>
                                                <td>{{$r->nama_project}}</td>
                                                <td>
                                                    @foreach ($r->upload_documents as $i)
                                                      @foreach (explode("," , $i->file_name) as $a) 
                                                    <a href="/storage/{{$i->id}}/{{$a}}">{{$a}}<br></a>
                                                    @endforeach 
                                                  @endforeach
                                                </td>
                                                <td>
                                                    <a href="{{route('detail_timeline',$r->id)}}" style="font-size: 10px" class="btn btn-primary btn-sm">Detail</a>
                                                    <a href="{{url('newtimeline', $r->id)}}" style="font-size: 10px" class="btn btn-warning btn-sm" >Add New Timeline</a>
                                                </td>
                                            </tr>
                                            {{-- @endforeach --}}
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
                                <th scope="col">Task Status</th>
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

                    <div class="tab-pane fade" id="c" rotle="tabpanel" aria-labelledby="dokumen">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn ml-2 btn-primary btn-sm" style="float: left;" data-bs-toggle="modal" data-bs-target="#dokumen{{$shorder->id}}">Add Dokumen</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table id="dokumen" class="table table-bordered ">
                                <thead>
                                <tr align="center" style="font-size: 13px">
                                <th scope="col">Project Code</th>
                                <th scope="col"> Client Name</th>
                                <th scope="col"> Project Name</th>
                                <th scope="col">Document</th>
                                <th scope="col">Description</th>
                                <th style="display: none"></th>
                                </tr>
                                </thead>
                                @foreach ($shorder->dokumen_projects as $dp)
                                <tbody>
                                
                                <tr align="center" style="font-size: 13px">
                                <td>{{$shorder->kode_project}}</td>
                                <td>{{$shorder->institusi}}</td>
                                <td>{{$shorder->project}}</td>
                                <td>
                                    <a href="dokumen_project/{{$dp->dokumen_project}}">{{$dp->dokumen_project}}</a>
                                </td>
                                <td>{{$dp->deskripsi}}</td>
                                <td style="display: none"></td>
                                </tr>
                                
                                </tbody>
                                @endforeach
                                </table>
                                <div>
                                {{-- <a href="{{ route('VIEWLTODONE') }}" class="btn btn-secondary">Back</a> --}}
                            </div>
                        </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="tab-pane fade" id="bast" role="tabpanel" aria-labelledby="bast">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#bast{{$shorder->id}}">Add BAST</button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="bast" class="table table-bordered  ">
                                        <thead>
                                            <tr align="center" style="font-size: 13px">
                                                <th>Project Code</th>
                                                <th>Client Name</th>
                                                <th>Project Name</th>
                                                <th>Status</th>
                                                <th>Document</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        @foreach ($shorder->bast as $r)
                                        <tbody>
                                            <tr align="center" style="font-size: 13px">
                                                <td>{{$shorder->kode_project}}</td>
                                                <td>{{$shorder->institusi}}</td>
                                                <td>{{$shorder->project}}</td>
                                                <td>
                                                    @if ($r->status == 'Open')
                                                    <div class="badge bg-warning">Open</div>
                                                    @elseif ($r->status == 'Completed')
                                                    <div class="badge bg-success">Completed</div>
                                                    @elseif ($r->status == 'Hold')
                                                    <div class="badge bg-danger">Hold</div>
                                                    @endif 
                                                </td>
                                                <td>
                                                    <a href="{{asset('bast_dokumen')}}/{{$r->bast_dokumen}}">{{$r->bast_dokumen}}</a>
                                                </td>
                                                <td>
                                                    <a href="" data-bs-toggle="modal" data-bs-target="#editbast{{$r->id}}"><button type="submit" class="btn btn-primary btn-sm">Edit</button></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        @endforeach
                                    </table>
                                    <div>
                                        {{-- <a href="{{ route('VIEWLTODONE') }}" class="btn btn-secondary">Back</a> --}}
                                    </div>
                                </div>
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
                                                            <span class="badge bg-light-success" style="font-size: 10px"  > <i class="fas fa-clock mt-2 mr-2 align-center" ></i> {{ date('d-m-Y', strtotime($value->start_date)) }}</span> 
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
                                                            <span class="badge bg-light-success" style="font-size: 10px"  > <i class="fas fa-clock mt-2 mr-2 align-center" ></i> {{ date('d-m-Y', strtotime($value->start_date)) }}</span> 
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
                                            <li class="ui-sortable-handle border rounded p-2 mb-2 shadow" onclick="show({{$value->id}})" item-id="{{ $value->id }}"     >
                                                <div class="kanban-box">
                                                    <div class="kanban-detail">
                                                        <h5 class="mt-0" ><a href="" data-bs-toggle="modal" data-bs-target="#editweekly{{$value->id}}"  style="font-size: 13px"><i class="fas fa-briefcase "></i> {{$value->job_essay}}</a> </h5>
                                                        <ul class="list-inline">
                                                            <span class="badge bg-light-success" style="font-size: 10px"  > <i class="fas fa-clock mt-2 mr-2 align-center" ></i> {{ date('d-m-Y', strtotime($value->start_date)) }}</span> 
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
    <div id="exampleModalScrollable{{$shorder->id}}" class="modal fade modal-xl" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Project Timeline</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{route('simpan-data')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
              <div class="modal-body">
                <input type="hidden" name="so_id" value="{{$shorder->id}}">
                <input type="hidden" name="hps" value="{{$shorder->contract_amount}}">
                <input type="hidden" name="nama_sales" id="" value="{{$shorder->amsales}}">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">No LTO</label>
                    <div class="col-sm-10">
                    <input type="text" class="text-sm form-control" name="no_sales" id="inputEmail3" value="{{$shorder->no_so}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">LTO Date</label>
                    <div class="col-sm-10">
                    <input type="text" class="text-sm form-control" name="tgl_sales" id="inputEmail3" value="{{ date('d-m-Y', strtotime($shorder->tgl_so)) }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Project Code</label>
                    <div class="col-sm-10">
                    <input type="text" class="text-sm form-control" name="kode_project" id="inputEmail3" value="{{$shorder->kode_project}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Client Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm" name="nama_institusi" id="inputEmail3" value="{{$shorder->institusi}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Project Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm" name="nama_project" id="inputEmail3" value="{{$shorder->project}}" readonly  >
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm text-black">Document Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm" name="nama_dokumen" id="inputEmail3"  >
                    </div>
                </div>


                <div class="mb-3">
                    <label for="document">Upload File</label>
                    <div style="background-color: none" class="needsclick dropzone" id="document-dropzone">
                    </div>
                </div>

                <div class="row">
                    <div class="row">
                        <div class="container mt-5 mb-3">
                            <div class="row">
                            <div class="col-6 col-sm-4">
                                <label for="" class="text-sm">Start Date</label>
                                <input type="date" class="form-control text-sm" name="start_date[]">
                            </div>
                            <div class="col-6 col-sm-4">
                                <label for="" class="text-sm">Finish Date</label>
                                <input type="date" class="form-control text-sm" name="finish_date[]">
                            </div>
                            <div class="w-100 d-none d-md-block"></div>
                            <div class="col-6 col-sm-4">
                                <label for="" class="text-sm">Type of work</label>
                                <input type="text" class="form-control text-sm" name="jenis_pekerjaan[]">
                            </div>
                            <div class="col-6 col-sm-4">
                                <label for="" class="text-sm">Technical Name</label>
                                <select name="nama_technical[]" id="" class="form-control text-sm">
                                <option value=""></option>
                                @foreach ($user as $l)
                                @foreach($l->users as $a)
                                <option value="{{$a->name}}">{{$a->name}}</option>
                                @endforeach
                                @endforeach
                                </select>
                            </div>
                            </div>
                            <a href="#" class="addtechnical btn btn-success" style="float:right;"><i class="bi bi-plus"></i> </a>
                        </div>
                        <div class="technical"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info btn-sm" >Submit</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
            </div>
            </form>
        </div>
        </div>
    </div>

    <div id="bast{{$shorder->id}}" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Document Bast</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('simpan-bast')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
            <div class="modal-body">
                <input type="hidden" name="so_id" value="{{$shorder->id}}">
                <input type="hidden" name="hps" value="{{$shorder->estimated_amount}}">
                <input type="hidden" name="nama_sales" id="" value="{{$shorder->amsales}}">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">No LTO</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="no_sales" id="inputEmail3" value="{{$shorder->no_so}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">LTO Date</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="tgl_sales" id="inputEmail3" value="{{ date('d-m-Y', strtotime($shorder->tgl_so)) }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="text-sm col-sm-2 col-form-label">Project Code</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="kode_project" id="inputEmail3" value="{{$shorder->kode_project}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Client Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="nama_institusi" id="inputEmail3" value="{{$shorder->institusi}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Project Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="nama_project" id="inputEmail3" value="{{$shorder->project}}" readonly  >
                    </div>
                </div>

                <div class="row">
                    <div class="column col-4">
                        <div class="form-group">
                        <label for="jenis_dokumen" class="text-sm" >Status</label>
                        <select name="status" id="" class="form-control text-sm ">
                            <option value=""></option>
                            <option value="Open">Open</option>
                            <option value="Completed">Completed</option>
                            <option value="Hold">Hold</option>
                        </select>
                        </div>
                    </div>
                    <div class="column col-4">
                        <div class="form-group">
                        <label for="" class="text-sm" >Upload Document</label>
                        <input type="file" class="form-control text-sm " id="" name="bast_dokumen" multiple="multiple" >
                        </div>
                    </div>
                  </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-info" >Submit</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
            </div>
            </form>
          </div>
        </div>
    </div>

    @foreach ($shorder->bast as $r)
    <div id="editbast{{$r->id}}" class="modal fade modal-xl" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Document Bast</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('update-bast',$r->id)}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
            <div class="modal-body">
                <input type="hidden" name="so_id" value="{{$shorder->id}}">
                <input type="hidden" name="hps" value="{{$shorder->estimated_amount}}">
                <input type="hidden" name="nama_sales" id="" value="{{$shorder->amsales}}">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">No LTO</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="no_sales" id="inputEmail3" value="{{$shorder->no_so}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Tanggal LTO</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="tgl_sales" id="inputEmail3" value="{{ date('d-m-Y', strtotime($shorder->tgl_so)) }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="text-sm col-sm-2 col-form-label">Project Code</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="kode_project" id="inputEmail3" value="{{$shorder->kode_project}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Client Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="nama_institusi" id="inputEmail3" value="{{$shorder->institusi}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Project Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="nama_project" id="inputEmail3" value="{{$shorder->project}}" readonly  >
                    </div>
                </div>

                <div class="row">
                    <div class="column col-4">
                        <div class="form-group">
                        <label for="jenis_dokumen" class="text-sm" >Status</label>
                        <select name="status" id="" class="form-control text-sm ">
                            <option value="{{$r->status}}" selected>{{$r->status}}</option>
                            <option value=""></option>
                            <option value="Open">Open</option>
                            <option value="Completed">Completed</option>
                            <option value="Hold">Hold</option>
                        </select>
                        </div>
                    </div>
                    <div class="column col-4">
                        <div class="form-group">
                        <label for="" class="text-sm" >Upload Document</label>
                        <input type="file" class="form-control text-sm " id="" name="bast_dokumen" multiple="multiple" >
                        </div>
                    </div>
                  </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-info" >Submit</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
            </div>
            </form>
          </div>
        </div>
    </div>
    @endforeach

    <div id="dokumen{{$shorder->id}}" class="modal fade modal-lg" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('simpan-dp')}}" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
            <div class="modal-body">
                <input type="hidden" name="so_id" value="{{$shorder->id}}">
                <input type="hidden" name="hps" value="{{$shorder->contract_amount}}">
                <input type="hidden" name="nama_sales" id="" value="{{$shorder->amsales}}">
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">No LTO</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="no_sales" id="inputEmail3" value="{{$shorder->no_so}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Tanggal LTO</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="tgl_sales" id="inputEmail3" value="{{ date('d-m-Y', strtotime($shorder->tgl_so)) }}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="text-sm col-sm-2 col-form-label">Project Code</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="kode_project" id="inputEmail3" value="{{$shorder->kode_project}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Client Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="nama_institusi" id="inputEmail3" value="{{$shorder->institusi}}" readonly>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Project Name</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control text-sm " name="nama_project" id="inputEmail3" value="{{$shorder->project}}" readonly  >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Upload Dokumen</label>
                    <div class="col-sm-10">
                    <input type="file" class="form-control text-sm " id="" name="dokumen_project" multiple="multiple" >
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail3" class="col-sm-2 col-form-label text-sm">Deskripsi</label>
                    <div class="col-sm-10">
                    <textarea name="deskripsi" id="" cols="30" class="form-control"></textarea>
                    </div>
                </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-info" >Submit</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                        </button>
                    </div>
                </div>
            </div>
            </div>
            </form>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/min/dropzone.min.js"></script>
<script type="text/javascript">
var uploadedDocumentMap = {}
Dropzone.options.documentDropzone = {
    url: '{{ route('storeMediaPm') }}',
    maxFilesize: 2, // MB
    addRemoveLinks: true,
    acceptedFiles: ".doc,.docx,.pdf,.xls,.xlsx,.ppt,.pptx",
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    success: function(file, response) {
        $('form').append('<input type="hidden" name="upload_dokumen[]" value="' + response.name + '">')
        uploadedDocumentMap[file.name] = response.name
    },
    removedfile: function(file) {
        file.previewElement.remove()
        var name = ''
        if (typeof file.file_name !== 'undefined') {
            name = file.file_name
        } else {
            name = uploadedDocumentMap[file.name]
        }
        $('form').find('input[name="upload_dokumen[]"][value="' + name + '"]').remove()
    },
    init: function() {
            @if (isset($upload_documents))
                var files =
                {!! json_encode($upload_documents) !!}
                for (var i in files) {
                var file = files[i]
                console.log(file);
                file = {
                ...file,
                width: 226,
                height: 324
                }
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.original_url)
                file.previewElement.classList.add('dz-complete')

                $('form').append('<input type="hidden" name="upload_dokumen[]" value="' + file.file_name + '">')
                }
            @endif
        }
}
    $('.addtechnical').on('click', function() {
        addtechnical();
    });

    function addtechnical() {
        var technical = '<div class="container"><div class="row"><div class="col-6 col-sm-5"><label for="" class="">Start Date</label><input type="date" class="form-control" name="start_date[]"> </div><div class="col-6 col-sm-5"><label for="" class="">Finish Date</label><input type="date" class="form-control" name="finish_date[]"></div><div class="w-100 d-none d-md-block"></div><div class="col-6 col-sm-5"><label for="" class="">Jenis Pekerjaan</label><input type="text" class="form-control" name="jenis_pekerjaan[]"></div><div class="col-8 col-sm-5 "><label for="" class="">Technikal Name</label><select name="nama_technical[]" id="" class="form-control"><option value=""></option>@foreach ($user as $l)@foreach($l->users as $a)<option value="{{$a->name}}">{{$a->name}}</option>@endforeach @endforeach</select><br><a href="#" class="remove btn btn-danger" style="float:right;"><i class="bi bi-trash"></i></a></form></div></div></div>';
        $('.technical').append(technical);
    };
    $('.remove').live('click', function() {
        $(this).parent().parent().parent().remove();
    });


    $('.adddok').on('click', function() {
        adddok();
    });

</script>


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