@extends('layouts.auth')

@section('content')
<div class="card-body">
    <form method="POST" class="needs-validation"  action="{{ route('login') }}">
        @csrf
      <div class="form-group">
        <label for="email">Email</label>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
            <div class="invalid-feedback">
                Please fill in your email
            </div>
        @enderror
      </div>

      @if (session('errors'))
        <div class="alert alert-danger">
          <p>{{ session('errors') }}</p>
        </div>
      @endif

      <div class="form-group">
        <div class="d-block">
            <label for="password" class="control-label">Password</label>
          <div class="float-right">
            <a href="auth-forgot-password.html" class="text-small">
              Forgot Password?
            </a>
          </div>
        </div>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('password')
        <div class="invalid-feedback">
            please fill in your password
        </div>
        @enderror
      </div>

      <div class="form-group">
        <div class="custom-control custom-checkbox">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
          <label class="custom-control-label" for="remember-me">Remember Me</label>
        </div>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
          Login
        </button>
      </div>
    </form>
  </div>
@endsection
