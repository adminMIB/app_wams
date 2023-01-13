<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>@yield('title')  </title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>WAMS</title>
    
  <link rel="stylesheet" href="{{ asset('newassets/assets/css/main/app.css') }}">
  <link rel="stylesheet" href="{{ asset('newassets/assets/css/main/app-dark.css') }}">
  {{-- <link rel="shortcut icon" href="{{ asset('newassets/assets/images/logo/favicon.svg') }}" type="image/x-icon"> --}}
  <link rel="icon" href="{{ asset('image/favicon.ico') }}" />
  {{-- <link rel="shortcut icon" href="{{ asset('newassets/assets/images/logo/favicon.png') }}" type="image/png"> --}}
  
  <link rel="stylesheet" href="{{ asset('newassets/assets/css/shared/iconly.css') }}">
  @yield('css')
</head>

<body>
  <div id="app">
    @include('layouts.sidebar')
    <div id="main">
      <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
          <i class="bi bi-justify fs-3"></i>
        </a>
      </header>
      
      @yield('content')
      
      @include('layouts.footer')
    </div>
  </div>
  
  <script src="{{ asset('newassets/assets/js/bootstrap.js') }}"></script>
  <script src="{{ asset('newassets/assets/js/app.js') }}"></script>
    
  <!-- Need: Apexcharts -->
  <script src="{{ asset('newassets/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('newassets/assets/js/pages/dashboard.js') }}"></script>

  <script src="{{ asset('newassets/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
  <script src="{{ asset('newassets/assets/js/pages/form-element-select.js') }}"></script>

  @stack('script-internal')

  @yield('js')

</body>

</html>