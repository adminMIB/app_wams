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
  
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.0/sweetalert2.css"
  integrity="sha512-0BcnfLcXBm81KVM/wzoS7yZRVflcQC3rj/Wqgi4cHSGktXTMcXrP6kquf1I14JFUj2LiFCfpZCSf/+478ifefA=="
  crossorigin="anonymous" referrerpolicy="no-referrer"/>
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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

  <script src="{{ asset('newassets/assets/extensions/jquery/jquery.min.js') }}"></script>
  
  <script src="{{ asset('newassets/assets/js/bootstrap.js') }}"></script>
  <script src="{{ asset('newassets/assets/js/app.js') }}"></script>
    
  <!-- Need: Apexcharts -->
  <script src="{{ asset('newassets/assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('newassets/assets/js/pages/dashboard.js') }}"></script>

  <script src="{{ asset('newassets/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
  <script src="{{ asset('newassets/assets/js/pages/form-element-select.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.6.0/sweetalert2.min.js"
  integrity="sha512-STirfWdXti4sBdx8qNLvlPU6G008ynF4TcZkLd0hOsM6PkZM3PbWbAoe4tO0nAu92S/HfE/XK1N4SwDzai9xDg=="
  crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  @stack('script-internal')
  <script>
    $(".select2").select2()
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>

  @stack('script-internal')

  @yield('js')

</body>

</html>