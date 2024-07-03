@extends('layouts.app')

@section('title', 'List Data (Belum Lengkap)')

@section('vendor-style')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection

@section('vendor-script')
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection

@section('page-script')

<script>
    var canEditProjects = @json($canEditProjects);
</script>

<script src="{{ asset('js/pages/projects-incomplete.js') }}"></script>
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">List Data Projects <sup>(Belum Lengkap)</sup></h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);">Projects</a>
                    </li>
                    <li class="breadcrumb-item active">List Data (Belum lengkap)</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="col-md-3">
            <select id="customer" class="select2 form-select">
                <option readOnly value="">----Pilih----</option>
                @foreach ($customer as $item)
                <option value="{{ $item->id }}">
                    {{ $item->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="card-body">
        <div class="card-datatable table-responsive">
            <table class="datatables-incomplete table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>No</th>
                        <th>ID Project</th>
                        <th>Project</th>
                        <th>Customer</th>
                        <th>CreatedAt</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection