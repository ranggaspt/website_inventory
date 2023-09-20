@extends('layouts.admin')

@section('main-content')
<div class="content ml-3 mr-3">
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
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-blue shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-blue text-uppercase mb-1">
                                    Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Member::count() ?? '0' }}</div>
                            </div>
                            <div class="col-auto mr-3">
                                <i class="fas fa-fw fa-users fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-blue shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-blue text-uppercase mb-1">
                                    Client</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Client::count() ?? '0' }}</div>
                            </div>
                            <div class="col-auto mr-3">
                                <i class="fas fa-fw fa-handshake fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-blue shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-blue text-uppercase mb-1">
                                    Inventory</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Inventory::count() ?? '0' }}</div>
                            </div>
                            <div class="col-auto mr-3">
                                <i class="fas fa-fw fa-cubes fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-blue shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-blue text-uppercase mb-1">
                                    Rekanan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ App\Models\Proforma::count() ?? '0' }}</div>
                            </div>
                            <div class="col-auto mr-3">
                                <i class="fas fa-fw fa-file fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-blue shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-blue text-uppercase mb-1">
                                    Income</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{formatRupiah($invoices, true)}}</div>
                            </div>
                            <div class="col-auto mr-3">
                                <i class="fa fa-money-bill fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-blue shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-blue text-uppercase mb-1">
                                    Outcome</div>
                                {{-- <div class=" h5 mb-0 font-weight-bold text-gray-800" >{{number_format($purchases, 0, ',' , '.')}}</div> --}}
                                <div class=" h5 mb-0 font-weight-bold text-gray-800" >{{formatRupiah($purchases, true)}}</div>
                            </div>
                            <div class="col-auto mr-3">
                                <i class="fas fa-fw fa-store fa-2x text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-6 ">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div id="chartPo">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 ">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div id="chartPi">
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div id="chartIn">
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
<script src="{{ asset('achart/dist/apexcharts.js')}}"></script>
<link rel="stylesheet" href="{{ asset('achart/dist/apexcharts.css')}}" />

{{-- Grafik PO --}}
    <script>
        var options = {
              series: [{
                name: "Total PO",
                data: @json($dataTotalPo)
            }],
              chart: {
              height: 280,
              type: 'line',
              zoom: {
                enabled: false
              }
            },
            dataLabels: {
              enabled: false
            },
            stroke: {
              curve: 'straight'
            },
            title: {
              text: 'Data Total Purchase Order Perbulan',
              align: 'left'
            },
            grid: {
              row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
              },
            },
            xaxis: {
              categories: @json($dataBulan),
            },
            yaxis: {
                labels: {
                    formatter: function (value) {
                        return value.toLocaleString("id-ID",{style:"currency", currency:"IDR"});
                    }
                },
            },
            };
            var chart = new ApexCharts(document.querySelector("#chartPo"), options);
            chart.render();
    </script>

{{-- Grafik PI --}}
<script>
    var options = {
          series: [{
            name: "Total PI",
            data: @json($dataTotalPi)
        }],
          chart: {
          height: 280,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        title: {
          text: 'Data Total Proforma Invoice Perbulan',
          align: 'left'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: @json($dataBulan),
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value.toLocaleString("id-ID",{style:"currency", currency:"IDR"});
                }
            },
        },
        };
        var chart = new ApexCharts(document.querySelector("#chartPi"), options);
        chart.render();
</script>

{{-- Grafik Invoice --}}
<script>
    var options = {
          series: [{
            name: "Total In",
            data: @json($dataTotalIn)
        }],
          chart: {
          height: 280,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        title: {
          text: 'Data Total Invoice Perbulan',
          align: 'left'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
            opacity: 0.5
          },
        },
        xaxis: {
          categories: @json($dataBulan),
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return value.toLocaleString("id-ID",{style:"currency", currency:"IDR"});
                }
            },
        },
        };
        var chart = new ApexCharts(document.querySelector("#chartIn"), options);
        chart.render();
</script>

@endsection




