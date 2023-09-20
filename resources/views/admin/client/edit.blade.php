@extends('layouts.admin')

@section('main-content')
<div class="content ml-3 mr-3 ">
    <div class="d-sm-flex align-items-center justify-content-between ">
        <h1 class="h3 mb-0 text-gray-800">Client</h1>
    </div>
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style="text-decoration:none" href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a style="text-decoration:none" href="{{route('admin.client.index')}}">Client</a></li>
                <li class="breadcrumb-item">Ubah Client</li>
            </ol>
        </nav>
    </div>
    <form action="{{ route('admin.client.update', Crypt::encrypt($data->id)) }}" method="post"
        enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="m-0 font-weight-bold text-white">Ubah Pegawai</h5>
                    </div>
                    <div class="card-body">
                        <div class="pl-4 pr-4">
                            <div class="row">
                                <div class="mb-3 mt-4">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                            <label for="code" class=" control-label">ID</label>
                                            <input id="code" type="text" class="form-control" name="code" readonly value="{{$data->code}}" required>
                                            @if ($errors->has('code'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('code') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 ">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name" class=" control-label">Nama Lengkap<span
                                                    class="small text-danger">*</label>
                                            <input id="name" type="name" class="form-control" name="name" 
                                                value="{{$data->name}}" required>
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
                                <div class="mb-3 ">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('region') ? ' has-error' : '' }}">
                                            <label for="region" class=" control-label">Wilayah<span
                                                    class="small text-danger">*</label>
                                            <input id="region" type="text" class="form-control" name="region" 
                                                value="{{$data->region}}" required>
                                            @if ($errors->has('region'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('region') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 ">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                            <label for="phone" class=" control-label">Telephone<span
                                                class="small text-danger">*</span></label>
                                            <input id="phone" type="number" class="form-control" name="phone" value="{{$data->phone}}">
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
                                <div class="mb-3 ">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('information') ? ' has-error' : '' }}">
                                            <label for="information" class=" control-label">Keterangan</label>
                                            <input id="information" type="text" class="form-control rupiah" name="information" value="{{ $data->information }}">
                                            @if ($errors->has('information'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('information') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 ">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                            <label for="file" class=" control-label">Unggah File (.zip)<span
                                                class="small text-danger">*</label>
                                            <input id="file" type="file" class="form-control" name="file" 
                                            value="{{ $data->file }}" > 
                                            <a href="{{url('admin/client/download/'.$data->id)}}" >{{$data->file}}</a>
                                            @if ($errors->has('file'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer pt-3 border-top text-right mb-4">
                                <button type="submit" class="btn btn-primary btn-default mr-1">Simpan</button>
                                <a href="{{ route('admin.client.index') }}"
                                    class="btn btn-secondary btn-default ">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection