@extends('layouts.admin')

@section('main-content')
<div class="content ml-3 mr-3">
    <div class="d-sm-flex align-items-center justify-content-between ">
        <h1 class="h3 mb-0 text-gray-800">Invoice</h1>
        <a href="{{ route('admin.invoice.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mr-1"><i class="fa fa-plus-circle fa-sm text-white mr-2"></i>Tambah Data</a>
    </div>
    <div class="pagetitle">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style="text-decoration:none" href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item">Invoice</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-sm-flex  justify-content-between">
                    <h5 class="m-0 font-weight-bold text-white">Invoice Data</h5>                   
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Kode Invoice</th>
                                    <th>Nama Client</th>
                                    <th>Judul PI</th>
                                    <th>Total Harga</th>
                                    <th>Keterangan</th>
                                    <th>Stastus</th>
                                    <th>File</th>
                                    <th style="width: 10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $invoice)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{$invoice->code}}</td>
                                    <td>{{$invoice->client->name}}</td>
                                    <td>{{$invoice->proforma->title}}</td>
                                    <td>{{formatRupiah($invoice->total_price, true)}}</td>
                                    <td>{{$invoice->information}}</td>
                                    <td>{{$invoice->status}}</td>
                                    <td>
                                        <a href="{{url('admin/invoice/download/'.$invoice->id)}}" class="btn btn-sm btn-danger">Download</a>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <a href="{{ route('admin.invoice.edit', Crypt::encrypt($invoice->id)) }}" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-pencil-alt"></i>
                                                </a>
                                            </div>
                                            <div class="mr-2">
                                                <!-- Add this in your view -->
                                                <form method="POST" action="{{ route('admin.invoice.destroy', Crypt::encrypt($invoice->id)) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm" data-toggle="tooltip" title='Delete'><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">Data Tidak Ditemukan</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

