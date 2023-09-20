@extends('layouts.app')

@section('content')
<!-- Content -->
<br>
<div class="container py-5 py-sm-7 ">
<br>
    <div class="mx-auto" style="max-width: 30rem;">
      <!-- Card -->
      <div class="card card-lg mb-5">
        <div class="card-body">
            <form method="POST" class="js-validate needs-validation" action="{{ route('login') }}">
                <div class="text-center">
                    <div class="mb-5">
                        <h1 class="display-5">Login</h1>
                    </div>
                </div>
                @csrf

                <!-- Form -->
              <div class="mb-4">
                <label class="form-label" for="signinSrEmail">Username</label>
                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Masukan Username Anda" value="{{ old('username') }}" required autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
              </div>
              <!-- End Form -->

                <div class="mb-4">
                    <label class="form-label w-100" for="signupSrPassword" tabindex="0">
                        <span class="d-flex justify-content-between align-items-center">
                            <span>Password</span>
                            
                        </span>
                    </label>
    
                    <div class="input-group input-group-merge" data-hs-validation-validate-class>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="8+ karakter" aria-label="8+ karakter" required minlength="8" >
                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                            <i class="fa fa-eye"></i>
                        </button>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="termsCheckbox">
                        Remember me
                    </label>
                </div>
                
                <div class="d-grid mb-3 ">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {{ __('Login') }}
                    </button>
                    <br>
                    {{-- @if (Route::has('password.request'))
                            <a class="btn btn-link mt-3" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif --}}
                </div>
            </form>
        </div>
      </div>
      <!-- End Card -->
    </div>
  </div>
  <!-- End Content -->

@endsection
