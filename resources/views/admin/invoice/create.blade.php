@extends('layouts.admin')

@section('main-content')
<div class="content ml-3 mr-3 ">
    <div class="d-sm-flex align-items-center justify-content-between ">
        <h1 class="h3 mb-0 text-gray-800">Invoice</h1>
    </div>
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style="text-decoration:none" href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item"><a style="text-decoration:none" href="{{route('admin.invoice.index')}}">Invoice</a></li>
                <li class="breadcrumb-item">Tambah Data</li>
            </ol>
        </nav>
    </div>

    <form method="POST" action="{{ route('admin.invoice.store') }}" enctype="multipart/form-data">
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
                                            <label for="code" class="control-label">Kode PI</label>
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
                                        <div class="form-group{{ $errors->has('client_id') ? ' has-error' : '' }}">
                                            <label for="client_id" class=" control-label">Nama Client</label>
                                            <div>
                                                <select class="form-control" name="client_id" required>
                                                    <option value="">Pilih Client</option>
                                                    @forelse ($clients as $client)
                                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                @if ($errors->has('client_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('client_id') }}</strong>
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
                                        <div class="form-group{{ $errors->has('proforma_id') ? ' has-error' : '' }}">
                                            <label for="proforma_id" class=" control-label">Judul PO</label>
                                            <div>
                                                <select class="form-control" name="proforma_id" required>
                                                    <option value="">Pilih Judul PO</option>
                                                    @forelse ($proformas as $proforma)
                                                        <option value="{{ $proforma->id }}">{{ $proforma->title }}</option>
                                                    @empty
                                                    @endforelse
                                                </select>
                                                @if ($errors->has('proforma_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('client_id') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 ">
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
                                        <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                                            <label for="status" class=" control-label">Status Pembayaran</label>
                                            <select class="form-control" name="status">
                                                <option value="">Pilih Status</option>
                                                <option value="Belum Lunas">Belum Lunas</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Lunas">Lunas</option>
                                            </select>
                                            @if ($errors->has('status'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('status') }}</strong>
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
                                            <label for="file" class=" control-label">Unggah File<span
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
                                    <a href="{{ route('admin.invoice.index') }}"
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
