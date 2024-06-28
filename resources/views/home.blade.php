@extends('layouts.app')

@section('title', 'Dashboard')

@section('page-script')
    <script>
        window.auth = @json(auth()->user());
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
@endsection

@section('content')
    <div id="app">
        <dashboard></dashboard>
    </div>
@endsection
