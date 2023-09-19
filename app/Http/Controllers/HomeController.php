<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nette\Utils\DateTime;
use App\Models\Purchase;
use App\Models\Proforma;
use App\Models\Invoice;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 0; $i <= $bulan; $i++){
            $totalPo = Purchase::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->sum('total_price');
            $dataBulan[] = Carbon::create()->month($i)->format('F');
            $dataTotalPo[] = $totalPo;
        }
        $this->data['dataBulan'] = $dataBulan;
        $this->data['dataTotalPo'] = $dataTotalPo;

        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 0; $i <= $bulan; $i++){
            $totalPi = Proforma::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->sum('total_price');
            $dataBulan[] = Carbon::create()->month($i)->format('F');
            $dataTotalPi[] = $totalPi;
        }
        $this->data['dataBulan'] = $dataBulan;
        $this->data['dataTotalPi'] = $dataTotalPi;

        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 0; $i <= $bulan; $i++){
            $totalIn = Invoice::whereYear('created_at', $tahun)->whereMonth('created_at', $i)->sum('total_price');
            $dataBulan[] = Carbon::create()->month($i)->format('F');
            $dataTotalIn[] = $totalIn;
        }
        $this->data['dataBulan'] = $dataBulan;
        $this->data['dataTotalIn'] = $dataTotalIn;


        $purchases = Purchase::sum('total_price');
        $this->data['purchases'] = $purchases;

        $proformas = Proforma::sum('total_price');
        $this->data['proformas'] = $proformas;

        $invoices = Invoice::sum('total_price');
        $this->data['invoices'] = $invoices;
        
        if(auth()->user()->role == 'admin'){
            return view('admin.home', $this->data);
        }elseif(auth()->user()->role == 'member'){
            return view('home');
        }
    }
}
