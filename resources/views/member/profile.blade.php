@extends('layouts.admin') @section('main-content')
<!-- Page Heading -->

<div class="content ml-3 mr-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="d-sm-flex align-items-center justify-content-between ">
                <h1 class="h3 mb-0 text-gray-800">Profil</h1>
            </div>
            <div class="pagetitle">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a style="text-decoration:none" href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Profil</li>
                    </ol>
                </nav>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-white">Data Profil </h5>
                </div>
                <div class="card-body">
                    @include('layouts.flash')
                    <form method="POST" action="{{ route('member.profile.update') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="_method" value="PUT" />
                        <div class="mb-4 mt-4 col-lg-12">
                            <div class="row">
                                

                            <div class="mb-3">
                                <div class="form-group focused">
                                    <label for="email" class="form-label">{{ __('Email') }}<span class="small text-danger">*</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email', Auth::user()->email) }}"required autocomplete="email">
                
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>  
                            
                            <div class="mb-3">
                                <div class="form-group focused">
                                    <label for="username" class="form-label">{{ __('Username') }}<span class="small text-danger">*</label>
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                                            name="username" value="{{ old('username', Auth::user()->username) }}"required>
                
                                        @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>    

                            <div class="row">
                                <div class="mb-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Nama<span
                                                class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Nama"
                                            value="{{ old('name', Auth::user()->name) }}" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label for="phone" class="form-control-label">Telephone<span
                                                class="small text-danger">*</span></label>
                                            <input id="phone" type="text" class="form-control" name="phone" value="{{ $data->phone }}" required>
                                            @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">Current
                                            password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="current_password" class="form-control"
                                            name="current_password" placeholder="Current password" />
                                            <button class="btn btn-outline-secondary" type="button" id="currentPassword">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                            </div>
                                        
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label for="new_password" class="form-label">New password</label>
                                        <div class="input-group input-group-merge">
                                            <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="new_password"
                                        placeholder="New password" autocomplete="new-password"
                                        pattern="^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$" />
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
                                        <p style="font-weight: bold">
                                            Kata Sandi harus terdiri dari:
                                        </p>
                                        <p id="length" class="invalid">
                                            Minimal <b> 8 karakter </b>
                                        </p>
                                        <p id="letter" class="invalid">
                                            Huruf <b> kecil (a-z)</b>
                                        </p>
                                        <p id="capital" class="invalid">
                                            Huruf <b> KAPITAL (A-Z)</b>
                                        </p>
                                        <p id="number" class="invalid">
                                            <b>Angka</b>(0-9)
                                        </p>
                                        <p id="symbol" class="invalid">
                                            <b>Symbol</b>(!$#%@)
                                        </p>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 ">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Confirm
                                            password</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="confirm_password" class="form-control"
                                            name="password_confirmation" placeholder="Confirm password" />
                                            <button class="btn btn-outline-secondary" type="button" id="confirmPassword">
                                                <i class="fa fa-eye"></i>
                                            </button> 
                                            </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Button -->
                        <div class="pl-lg-4 mb-2">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
