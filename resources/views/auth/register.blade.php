@extends('layouts.app')

@section('content')
<div class="container py-3 mt-5">
    <div class="mx-auto" style="max-width: 30rem;">
        <div class="card card-lg mb-5">

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    <div class="text-center">
                        <div class="mb-5">
                            <h1 class="display-5">Register</h1>
                            <p>Sudah memiliki akun? <a class="link" href="{{ route('login') }}">Masuk disini!</a></p>
                        </div>
                    </div>
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label">{{ __('Name') }}</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="username" class="form-label">{{ __('Username') }}</label>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}" required >

                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">{{ __('Password') }}</label>
                        <div class="input-group input-group-merge">
                            <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password"
                            pattern="^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$" >
                            
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                        

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <div class="alert alert-secondary mt-2 mb-0" role="alert" id="message">
                            <p style="font-weight: bold;"> Kata Sandi harus terdiri dari: </p>
                            <p id="length" class="invalid"> Minimal <b> 8 karakter </b> </p>
                            <p id="letter" class="invalid"> Huruf <b> kecil (a-z)</b> </p>
                            <p id="capital" class="invalid"> Huruf <b> KAPITAL (A-Z)</b></p>
                            <p id="number" class="invalid"> <b>Angka</b>(0-9) </p>
                            <p id="symbol" class="invalid"> <b>Symbol</b>(!$#%@)</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                        <div class="input-group input-group-merge">
                            <input id="password-confirm" type="password" class="form-control " name="password_confirmation"
                            required autocomplete="new-password">
                            
                            <button class="btn btn-outline-secondary" type="button" id="confirmPass">
                                <i class="fa fa-eye"></i>
                            </button>
                        </div>
                    </div>
                        

                        
                    {{-- <div class="mb-4">
                        <label class="form-label">{{ __('Google Recaptcha') }}</label>
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                    </div> --}}

                    <div class="mb-4">
                            <label  class="form-label">Google Recaptcha</label>
	                        <div class="col-md-6"> {!! htmlFormSnippet() !!} </div>
                        </div>

                    <div class=" py-3 d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
