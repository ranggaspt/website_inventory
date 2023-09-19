@extends('layouts.admin')

@section('main-content')
<!-- Page Heading -->

@include('layouts.flash')


<div class="content ml-3 mr-3" >
    <div class="row">
        <div class="col-lg-12">
            <div class="d-sm-flex align-items-center justify-content-between ">
                <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div>
            <div class="pagetitle">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a style="text-decoration:none" href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                    </ol>
                </nav>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-white">Dashboard</h5>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Hello! <strong>{{ Auth::user()->name }}</strong> are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
