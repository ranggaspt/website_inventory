@extends('layouts.admin')

@section('main-content')
<div class="content ml-3 mr-3 ">
    <div class="d-sm-flex align-items-center justify-content-between ">
        <h1 class="h3 mb-0 text-gray-800">Inventory</h1>
    </div>
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style="text-decoration:none" href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a style="text-decoration:none" href="{{route('admin.inventory.index')}}">Inventory</a></li>
                <li class="breadcrumb-item">Tambah Data</li>
            </ol>
        </nav>
    </div>

    <form method="POST" action="{{ route('admin.inventory.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-white">Tambah Barang</h5>
                </div>
                <div class="card-body">
                        @include('layouts.flash')
                        <div class="mb-4 pl-4 pr-4">

                            <div class="row">
                                <div class="mb-3 mt-4">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                            <label for="code" class=" control-label">Kode Barang</label>
                                            <input id="code" type="text" class="form-control" name="code" readonly value="{{$kode}}" required>
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
                                            <label for="name" class=" control-label">Nama Barang<span
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
                                <div class="mb-3 ">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                                            <label for="category" class=" control-label">Kategori</label>
                                            <select class="form-control" name="category">
                                                <option value="">Pilih Kategori</option>
                                                <option value="Laptop">Laptop</option>
                                                <option value="Smartphone">Smartphone</option>
                                                <option value="PC">PC</option>
                                            </select>
                                            @if ($errors->has('category'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('category') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 ">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('stock') ? ' has-error' : '' }}">
                                            <label for="stock" class=" control-label">Stok</label>
                                            <input id="stock" type="number" class="form-control" name="stock" 
                                                value="{{ old('stock') }}">
                                            @if ($errors->has('stock'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('stock') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 ">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                            <label for="price" class=" control-label">Harga<span
                                                class="small text-danger">*</label>
                                            <input id="price" type="text" class="form-control rupiah" name="price" 
                                                value="{{ old('price') }}"required>
                                            @if ($errors->has('price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('price') }}</strong>
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
                                                value="{{ old('file') }}">
                                            @if ($errors->has('file'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Button -->
                            <div class="mb-3">
                                <div class="form-footer pt-3 border-top text-right">
                                    <button type="submit" class="btn btn-primary btn-default mr-1">Simpan</button>
                                    <a href="{{ route('admin.inventory.index') }}"
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
