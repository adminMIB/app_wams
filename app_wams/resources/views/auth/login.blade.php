@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<section class="background-radial-gradient overflow-hidden">
  <style>
    .background-radial-gradient {
      background-color: hsl(218, 41%, 15%);
      background-image: radial-gradient(650px circle at 0% 0%,
          hsl(218, 41%, 35%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%),
        radial-gradient(1250px circle at 100% 100%,
          hsl(218, 41%, 45%) 15%,
          hsl(218, 41%, 30%) 35%,
          hsl(218, 41%, 20%) 75%,
          hsl(218, 41%, 19%) 80%,
          transparent 100%);
      padding-bottom: 18px;    
    }

    #radius-shape-1 {
      height: 220px;
      width: 220px;
      top: -60px;
      left: -130px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    #radius-shape-2 {
      border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
      bottom: -60px;
      right: -110px;
      width: 300px;
      height: 300px;
      background: radial-gradient(#44006b, #ad1fff);
      overflow: hidden;
    }

    .bg-glass {
      background-color: hsla(0, 0%, 100%, 0.9) !important;
      backdrop-filter: saturate(200%) blur(25px);
    }
  </style>

  <div class="container  px-4 py-5 px-md-5 text-center text-lg-start my-5">
    <div class="row gx-lg-5 align-items-center mb-5">
      <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
          <img src="{{asset('image/logo-mib.png')}}" alt="logo" width="100" class="">
        <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
          Workflow Management System
          <span style="color: hsl(218, 81%, 75%)">(WAMS)</span>
        </h1>
        <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
          
        </p>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
        <h1 class="mb-4 text-white">Login</h1>
        <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
        <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
        <div class="card bg-glass">
          <div class="card-body px-4 py-5 px-md-5">
            <form method="POST" class="needs-validation"  action="{{ route('login') }}">
              @csrf
              <!-- Email input -->
              <div class="form-outline mb-4">
                <input id="email" type="email" placeholder="Your Email ..." class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <div class="invalid-feedback">
                        Please fill in your email
                    </div>
                @enderror

                  @if (session('errors'))
                    <div class="alert alert-danger">
                      <p>{{ session('errors') }}</p>
                    </div>
                  @endif
              </div>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input id="password" placeholder="Your Password ..." type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                
                @error('password')
                  <div class="invalid-feedback">
                      please fill in your password
                  </div>
                @enderror
              </div>

              <!-- Checkbox -->
              {{-- <div class="form-check d-flex justify-content-center mb-4">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example33" checked />
                <label class="form-check-label" for="form2Example33">
                  Subscribe to our newsletter
                </label>
              </div> --}}

              <!-- Submit button -->
              
              {{-- <button type="submit" style="border: none; background:none;  width:100%;">
                <lottie-player  src="https://lottie.host/ba1adbb9-34ae-4570-bfb6-80ba3c82ce54/axzcRm7tgt.json" mode="bounce" style="height: 70px;"  speed="0.6"  loop  autoplay></lottie-player>              
              </button> --}}

              <button type="submit" class="btn btn-primary btn-block btn-lg mt-5 mb-4">
                Sign in
              </button>

              {{-- <!-- Register buttons -->
              <div class="text-center">
                <p>or sign up with:</p>
                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-facebook-f"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-google"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-twitter"></i>
                </button>

                <button type="button" class="btn btn-link btn-floating mx-1">
                  <i class="fab fa-github"></i>
                </button>
              </div> --}}
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

