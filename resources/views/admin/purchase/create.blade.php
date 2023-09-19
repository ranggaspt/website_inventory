@extends('layouts.admin')

@section('main-content')
<div class="content ml-3 mr-3 ">
    <div class="d-sm-flex align-items-center justify-content-between ">
        <h1 class="h3 mb-0 text-gray-800">Purchase Order</h1>
    </div>
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style="text-decoration:none" href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a style="text-decoration:none" href="{{route('admin.purchase.index')}}">Inventory</a></li>
                <li class="breadcrumb-item">Tambah Data</li>
            </ol>
        </nav>
    </div>

    <form method="POST" action="{{ route('admin.purchase.store') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
    <div class="row">

        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h5 class="m-0 font-weight-bold text-white">Tambah Data</h5>
                </div>
                <div class="card-body">
                        @include('layouts.flash')
                        <div class="mb-4 pl-4 pr-4">

                            <div class="row">
                                <div class="mb-3 mt-4">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                                            <label for="code" class="control-label">Kode PO</label>
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
                                <div class="mb-3">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('supplier_id') ? ' has-error' : '' }}">
                                            <label for="supplier_id" class="control-label">Nama Supplier<span
                                                class="small text-danger">*</label>
                                            <div>
                                                <select class="form-control" name="supplier_id" required>
                                                    <option value="">Pilih Supplier</option>
                                                    @forelse ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">{{ $supplier->name  }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                @if ($errors->has('supplier_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('supplier_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                            <label for="title" class=" control-label">Judul PO<span
                                                    class="small text-danger">*</label>
                                            <input id="title" type="text" class="form-control" name="title" 
                                                value="{{ old('title') }}" required>
                                            @if ($errors->has('title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('total_price') ? ' has-error' : '' }}">
                                            <label for="total_price" class=" control-label">Total Harga</label>
                                            <input id="total_price" type="text" class="form-control rupiah" name="total_price" value="{{ old('total_price') }}">
                                            @if ($errors->has('total_price'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('total_price') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('information') ? ' has-error' : '' }}">
                                            <label for="information" class=" control-label">Keterangan</label>
                                            <input id="information" type="text" class="form-control" name="information" value="{{ old('information') }}">
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
                                <div class="mb-3">
                                    <div class="form-group focused">
                                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                            <label for="file" class=" control-label">Unggah Dokumen<span
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
                                    <a href="{{ route('admin.purchase.index') }}"
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
