@extends('layouts.app')

@section('title', isset($opty) ? 'Edit Opty' : 'Create Opty')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.8/jquery.mask.min.js"
        integrity="sha512-hAJgR+pK6+s492clbGlnrRnt2J1CJK6kZ82FZy08tm6XG2Xl/ex9oVZLE6Krz+W+Iv4Gsr8U2mGMdh0ckRH61Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('js/pages/opty-add-edit.js') }}"></script>
@endsection


@push('js')
    <script>
        $('.uang').mask('000.000.000.000.000', {
            reverse: true
        });
    </script>
@endpush

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0" style="display: flex; align-items: center;">
                    <a href="/opty" style="display: flex; align-items: center;">
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
                            <a href="/opty">List Opty</a>
                        </li>
                        <li class="breadcrumb-item active">{{ isset($opty) ? 'Edit' : 'Create' }}</li>
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

            <form
                action="{{ isset($opty) ? route('opty.update', $opty->id) : route('opty.store') }}"
                method="POST"
                enctype="multipart/form-data"
                id="storeFormOpty"
                class="row"
            >
                @csrf
                @if (isset($opty))
                    @method('PUT')
                @endif
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="code_opty">
                            ID Opty
                        </label>
                        <div class="col-sm-12 col-md-7">
                            <input
                                type="text"
                                class="form-control"
                                name="code_opty"
                                id="code_opty"
                                placeholder="ID Opty"
                                autocomplete="Off"
                                value="{{ old('code_opty', isset($opty) ? $opty->code_opty : '') }}"
                                autofocus
                            >
                            <p class="text-danger">{{ $errors->first('code_opty') }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="project_name">
                            Project Name
                        </label>
                        <div class="col-sm-12 col-md-7">
                            <input
                                type="text"
                                class="form-control"
                                id="project_name"
                                name="project_name"
                                placeholder="Project Name"
                                autocomplete="Off"
                                value="{{ old('project_name', isset($opty) ? $opty->project_name : '') }}"
                                autofocus
                            >
                            <p class="text-danger">{{ $errors->first('project_name') }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="account_manager">
                            Nama Account Manager
                        </label>
                        <div class="col-sm-12 col-md-7">
                            <input
                                type="text"
                                class="form-control"
                                name="account_manager"
                                placeholder="Nama Account Manager"
                                autocomplete="Off"
                                value="{{ old('account_manager', isset($opty) ? $opty->account_manager : '') }}"
                                autofocus
                            >
                            <p class="text-danger">{{ $errors->first('account_manager') }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="customer_id">
                            Customer
                        </label>
                        <div class="col-sm-12 col-md-7">
                            <select
                                id="customer_id"
                                name="customer_id"
                                class="select2 form-select form-select-lg"
                                data-allow-clear="true"
                                autofocus
                            >
                                <option readOnly value="">----Pilih----</option>
                                @foreach ($customer as $item)
                                    <option value="{{ $item->id }}"
                                        {{ (old('customer_id') ?? (isset($opty) ? $opty->customer_id : '')) == $item->id ? 'selected' : '' }}>
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="text-danger">{{ $errors->first('customer_id') }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="revenue_sales">
                            Sales Revenue
                        </label>
                        <div class="col-sm-12 col-md-7">
                            <div class="input-group">
                                <span class="input-group-text" id="rp">Rp</span>
                                <input
                                    type="text"
                                    id="revenue_sales"
                                    name="revenue_sales"
                                    class="form-control uang"
                                    placeholder="Sales Revenue"
                                    autofocus
                                    autocomplete="off"
                                    value="{{ old('revenue_sales', isset($opty) ? number_format($opty->revenue_sales) : '') 
                                }}">
                            </div>
                            <p class="text-danger">{{ $errors->first('revenue_sales') }}</p>
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3" for="file">File</label>
                        <div class="col-sm-12 col-md-7">
                            <input
                                type="file"
                                name="file"
                                id="file"
                                class="form-control"
                                accept="application/pdf,.csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                            >
                            <p class="text-danger">{{ $errors->first('file') }}</p>
                            @if (isset($opty))
                                <p class="text-muted">Biarkan kosong jika tidak ingin mengganti file</p>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-4">
                        <div class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></div>
                        <div class="col-sm-12 col-md-7">
                            <button type="submit"
                                class="btn btn-primary btn-md waves-effect waves-light"
                                id="submitBtn">{{ isset($opty) ? 'Update' : 'Submit' }}
                                <i class="tf-icons ti ti-device-floppy ti-md me-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
