@extends('layouts.app')
@section('title', !empty($project->principal_id) ? 'Edit' : 'Buat ' . 'Project ' . "(" . $project->project_name . ")")

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection

@section('page-script')
    <script>
        var project = @json($project)
    </script>
    <script src="{{ asset('js/pages/project-AddEdit.js') }}"></script>
@endsection

@push('js')
    @if (session('message'))
        <script>
            $(document).ready(function() {
                $('#toast-body').text('{{ session('message') }}');
                $('#session-toast').toast('show');
            });
        </script>
    @endif
@endpush

@section('content')

    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0" style="display: flex; align-items: center;">
                    <a href="/project" style="display: flex; align-items: center;">
                        <i class="ti ti-arrow-left" style="margin-right: 5px;"></i>
                        <span>Back</span>
                    </a>
                </h6>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="/">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/project">Project</a>
                        </li>
                        <li class="breadcrumb-item active">
                            {{ !empty($project->principal_id) ? 'Edit' : 'Buat' }} Project
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            @endif

            <form action="{{ route('project.update', $project->id) }}" class="row" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">ID Project</label>
                    <div class="col-sm-12 col-md-7">
                        <input
                            type="text"
                            class="form-control {{ $errors->has('id_project') ? 'is-invalid' : '' }}"
                            name="id_project"
                            placeholder="ID Project"
                            autocomplete="Off"
                            value='{{ old('id_project', $project->id_project) }}'
                            required
                        >
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Project Name</label>
                    <div class="col-sm-12 col-md-7">
                        <span class="form-control" readonly>{{ $project->project_name }}</span>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Principal</label>
                    <div class="col-sm-12 col-md-7">
                        <select class="select2 form-select" id="principal_id" name="principal_id" data-allow-clear="true" required>
                            <option readOnly value="">----Pilih----</option>
                            @foreach ($principal as $item)
                                <option value="{{ $item->id }}"
                                    {{ $project->principal_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">File</label>
                    <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                            <input type="file" name="file" class="form-control"
                                accept="application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                        </div>
                        @if (!empty($project->file))
                            <p class="text-warning mt-2">Biarkan kosong jika tidak ingin mengganti file</p>
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">BMT - Awal</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input type="text" id="bmt_awal" class="form-control uang calculate"
                                value='{{ old('bmt', $project->bmt) }}' name="bmt" min=1 autocomplete="off" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Komponen</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="select2-primary">
                            <select class="form-select" name="component[]" id="component" multiple="multiple" required>
                                <option value="">------PILIH------</option>
                                @foreach ($component as $item)
                                    <option value="{{ $item }}">{{ ucwords(str_replace("_", " ", $item)) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-4" id="showDelivery" style="display: none">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Delivery</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="text"
                                id="delivery"
                                class="form-control uang calculate"
                                name="delivery"
                                value='{{ old('delivery', $project->delivery) }}'
                                min=0
                                autocomplete="off"
                                required
                            >
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-4" id="showEndUser" style="display: none">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">End User</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="text"
                                id="end_user"
                                class="form-control uang calculate"
                                name="end_user"
                                min=1
                                value='{{ old('end_user', $project->end_user) }}'
                                autocomplete="off"
                                required
                            >
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-4" id="showService" style="display: none">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Service</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="text"
                                id="service"
                                class="form-control uang calculate"
                                name="service"
                                value='{{ old('service', $project->service) }}'
                                min=0
                                autocomplete="off"
                                required>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-4" id="showWapu" style="display: none">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Wapu</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="text"
                                id="wapu"
                                class="form-control uang calculate"
                                name="wapu"
                                min=1
                                value='{{ old('wapu', $project->wapu) }}'
                                required
                                autocomplete="off"
                            >
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">SubTotal</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="hidden"
                                name="subtotal"
                                id="subtotal"
                                value="{{ $project->subtotal }}"
                            >
                            <div id="displaySubtotal" class="form-control">
                                Rp. {{ number_format($project->subtotal) }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Bunga Admin</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="input-group mb-3">
                            <input
                                type="number"
                                class="form-control uang calculate"
                                id="admin_bunga"
                                name="bunga_admin"
                                min="1"
                                max="100"
                                autocomplete="off"
                                value='{{ old('bunga_admin', $project->bunga_admin) }}'
                                required
                            >
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Biaya Admin</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input type="hidden" name="biaya_admin" id="admin_cost">
                            <div id="displayCost" class="form-control">0</div>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Biaya Lain</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="text"
                                id="decrement_cost"
                                class="form-control uang calculate"
                                name="biaya_pengurangan"
                                min=0
                                required
                                autocomplete="off"
                                value='{{ old('biaya_pengurangan', $project->biaya_pengurangan) }}'
                            >
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Final Subtotal</label>
                    <div class="col-sm-12 col-md-7">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp</span>
                            <input
                                type="hidden"
                                name="total_final"
                                id="finalSubtotal"
                                value="{{ $project->total_final }}"
                            >
                            <div id="displayFinalSubtotal" class="form-control">
                                Rp. {{ number_format($project->total_final) }}
                            </div>
                        </div>
                        <p class="text-sm text-muted">Final Subtotal <b>dari</b> Subtotal - Biaya admin - Biaya Lain</p>
                    </div>
                </div>

                <div class="form-group row mb-4">
                    <div class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></div>
                    <div class="col-sm-12 col-md-7">
                        <button type="submit" class="btn btn-primary btn-md waves-effect waves-light"
                            id="submitBtn">{{ isset($opty) ? 'Update' : 'Submit' }}
                            <i class="tf-icons ti ti-device-floppy ti-md me-1"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- toast --}}
    <div class="bs-toast toast toast-ex animate__animated my-2" id="session-toast" role="alert" aria-live="assertive"
        aria-atomic="true" data-bs-delay="10000">
        <div class="toast-header">
            <i class="ti ti-bell ti-xs me-2 text-success"></i>
            <div class="me-auto fw-medium" id="toast-title">Success</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="toast-body"></div>
    </div>
@endsection
