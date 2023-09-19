@extends('layouts.admin')

@section('main-content')
<div class="content ml-3 mr-3 ">
    <div class="d-sm-flex align-items-center justify-content-between ">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
    </div>
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style="text-decoration:none" href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a style="text-decoration:none" href="{{route('admin.member.index')}}">Users</a></li>
                <li class="breadcrumb-item">Tambah Data</li>
            </ol>
        </nav>
    </div>

    <form method="POST" action="{{ route('admin.member.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-white">Tambah Users</h5>
                </div>
                <div class="card-body">
                        @include('layouts.flash')
                        <div class="mb-4 pl-4 pr-4">
                            <div class="row">
                                <div class="mb-3 mt-4">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class=" control-label">Name<span
                                                    class="small text-danger">*</label>
                                            <input id="name" type="name" class="form-control" name="name" 
                                                value="{{ old('name') }}" required>
                                            @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label for="phone" class=" control-label">Telephone<span
                                                class="small text-danger">*</span></label>
                                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                                            @if ($errors->has('phone'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('phone') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                            <label for="username" class=" control-label">Username<span
                                                    class="small text-danger">*</label>
                                            <input id="username" type="text" class="form-control" name="username"
                                                value="{{ old('username') }}" required>
                                            @if ($errors->has('username'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('username') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label for="email" class=" control-label">Email<span
                                                    class="small text-danger">*</label>
                                            <input id="email" type="email" class="form-control" name="email"
                                                value="{{ old('email') }}" required>
                                            @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="password" class=" control-label">Password</label>
                                        <div class="input-group input-group-merge">
                                        <input type="password" id="password" class="form-control" name="password" 
                                        pattern="^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        </div>
                                        @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif

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
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label for="password-confirm" class="col-md-10 control-label">Konfirmasi Password</label>
                                        {{-- <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required autocomplete="password"> --}}
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="confirm_password" class="form-control" name="password_confirmation">
                                        <button class="btn btn-outline-secondary" type="button" id="confirmPassword">
                                            <i class="fa fa-eye"></i>
                                        </button>   
                                        </div>
                                        @if ($errors->has('password-confirm'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password-confirm') }}</strong>
                                        </span>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Button -->
                            <div class="mb-3">
                                <div class="form-footer pt-3 border-top text-right">
                                    <button type="submit" class="btn btn-primary btn-default mr-1">Simpan</button>
                                    <a href="{{ route('admin.member.index') }}"
                                        class="btn btn-secondary btn-default">Kembali</a>
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
