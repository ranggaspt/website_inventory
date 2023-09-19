@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->



<div class="content ml-3 mr-3">
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
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card shadow mb-4 ">
                <div class="card-profile-image mt-4">
                    <figure class="rounded-circle avatar avatar font-weight-bold" style="font-size: 60px; height: 180px; width: 180px;" data-initial='S'></figure>
                </div>
                <div class="card-body">
                    <div class="row"> 
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{ Auth::user()->name }}</h5>
                                <p>Super Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-lg-1">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-white">Data Profil</h5>
                </div>
                <div class="card-body">
                    @include('layouts.flash')
                    <form method="POST" action="{{ route('admin.profile.update') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="mb-4 mt-4 col-lg-12">
                            <div class="row">
                                <div class="mb-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Username<span class="small text-danger">*</span></label>
                                        <input type="text" id="username" class="form-control" name="username" placeholder="username" value="{{ old('username', Auth::user()->username) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Email<span class="small text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="email" value="{{ old('email', Auth::user()->email) }}">
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="mb-3">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">Nama<span class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" name="name" placeholder="Nama" value="{{ old('name', Auth::user()->name) }}">
                                    </div>
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">Current password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="current_password" class="form-control" name="current_password" placeholder="Current password">
                                        <button class="btn btn-outline-secondary" type="button" id="currentPassword">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">New password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New password">
                                        <button class="btn btn-outline-secondary" type="button" id="newPassword">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Confirm password</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                                        <button class="btn btn-outline-secondary" type="button" id="confirmPassword">
                                        <i class="fa fa-eye"></i>
                                        </button>   
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!-- Button -->
                        <div class="pl-lg-4 mb-3">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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