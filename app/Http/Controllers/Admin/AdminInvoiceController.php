<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceRequest;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\ProformaRequest;
use App\Models\Proforma;
use App\Models\Invoice;
use App\Models\Client;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class AdminInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $invoices = Invoice::latest()->get();
        $this->data['invoices'] = $invoices;
        return view('admin.invoice.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::orderBy('name', 'ASC')->get();
        $this->data['clients'] = $clients;
        $proformas = Proforma::orderBy('name', 'ASC')->get();
        $this->data['proformas'] = $proformas;
        $jumlahRow = Invoice::all()->count();
        $number = $jumlahRow + 1;
        $date = new DateTime();
        $timeNow = $date->format('dmy');
        $kode = "IN-" . $timeNow . "-" . $number;
        $this->data['kode'] = $kode;
        return view('admin.Invoice.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request)
    {
        $params = $request->all();
        if ($request->has('total_price')){
            $params['total_price'] = str_replace('.', '', $request['total_price']);
        }
        if ($request->has('file')) {
            $params['file'] = $this->saveFile('invoice', $request->file('file'), $params['code']);
        }
        if (Invoice::create($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/invoice');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $clients = Client::orderBy('name', 'ASC')->get();
        $this->data['clients'] = $clients;
        $proformas = Proforma::orderBy('name', 'ASC')->get();
        $this->data['proformas'] = $proformas;
        $invoice = Invoice::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $invoice;
        return view('admin.invoice.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InvoiceRequest $request, string $id)
    {
        $params = $request->all();

        if ($request->has('total_price')){
            $params['total_price'] = str_replace('.', '', $request['total_price']);
        }else {
            $params = $request->except('total_price');
        }

        if ($request->has('file')) {
            $params['file'] = $this->saveFile('purchase', $request->file('file'), $params['code']);
        }
        
        $invoices = Invoice::findOrFail(Crypt::decrypt($id));
        if ($invoices->update($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/invoice');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $invoice = Invoice::findOrFail(Crypt::decrypt($id));
        $url = $invoice->file;
        $dir = public_path('storage/' . substr($url, 0, strrpos($url, '/')));
        $path = public_path('storage/' . $url);

        File::delete($path);

        rmdir($dir);
        if ($invoice->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect('admin/invoice');
    }

    private function saveFile($type, $file, $code)
    {
        $dt = new DateTime();

        $path = public_path('storage/uploads/invoice/' . $type . '/' . $dt->format('Y-m-d') . '/' . $code);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $berkas = $file;
        $nama =  $type . '_' . $code . '_' . $dt->format('Y-m-d');
        $fileName = $nama . '.' . $file->getClientOriginalExtension();
        $folder = '/uploads/invoice/' . $type . '/' . $dt->format('Y-m-d') . '/' . $code;

        $check = public_path($folder) . $fileName;

        if (File::exists($check)) {
            File::delete($check);
        }

        $filePath = $file->storeAs($folder, $fileName, 'public');
        return $filePath;
    }
}
