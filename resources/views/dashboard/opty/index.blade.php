@extends('layouts.app')

@section('title', 'List Opty')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection

@section('page-script')
    <script>
        var canViewseOpty = @json($canViewseOpty);
        var canCreateOpty = @json($canCreateOpty);
        var canEditOpty = @json($canEditOpty);
        var canDeleteOpty = @json($canDeleteOpty);
        var canApprovelOpty = @json($canApprovelOpty);
    </script>
    <script src="{{ asset('js/pages/opty.js') }}"></script>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0">List Data Opty</h5>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="javascript:void(0);">Opty</a>
                        </li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">

        <div class="container mt-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <span class="text-center">{!! session('success') !!}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button>
                </div>
            @endif
        </div>

        <div class="card-datatable table-responsive">
            <table class="datatables-opties table border-top">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>No</th>
                        <th>ID Opty</th>
                        <th>Project</th>
                        <th>Customer</th>
                        <th>Account Manager</th>
                        <th>Revenue Sales</th>
                        <th>CreatedAt</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    @include('dashboard.opty.modal.move')
@endsection
