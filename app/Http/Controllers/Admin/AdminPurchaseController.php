<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;
use App\Models\Supplier;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class AdminPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::latest()->get();
        $this->data['purchases'] = $purchases;
        return view('admin.purchase.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::orderBy('name', 'ASC')->get();
        $this->data['suppliers'] = $suppliers;
        $jumlahRow = Purchase::all()->count();
        $number = $jumlahRow + 1;
        $date = new DateTime();
        $timeNow = $date->format('dmy');
        $kode = "PO-" . $timeNow . "-" . $number;
        $this->data['kode'] = $kode;
        return view('admin.purchase.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PurchaseRequest $request)
    {
        $params = $request->all();
        if ($request->has('total_price')){
            $params['total_price'] = str_replace('.', '', $request['total_price']);
        }

        if ($request->has('file')) {
            $params['file'] = $this->saveFile('purchase', $request->file('file'), $params['code']);
        }

        if (Purchase::create($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/purchase');
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
        $suppliers = Supplier::orderBy('name', 'ASC')->get();
        $this->data['suppliers'] = $suppliers;
        $purchase = Purchase::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $purchase;
        return view('admin.purchase.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PurchaseRequest $request, string $id)
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

        
        
        $purchases = Purchase::findOrFail(Crypt::decrypt($id));
        if ($purchases->update($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/purchase');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase = Purchase::findOrFail(Crypt::decrypt($id));
        $url = $purchase->file;
        $dir = public_path('storage/' . substr($url, 0, strrpos($url, '/')));
        $path = public_path('storage/' . $url);

        File::delete($path);

        rmdir($dir);
        if ($purchase->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect('admin/purchase');
    }

    private function saveFile($type, $file, $code)
    {
        $dt = new DateTime();

        $path = public_path('storage/uploads/purchase/' . $type . '/' . $dt->format('Y-m-d') . '/' . $code);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $berkas = $file;
        $nama =  $type . '_' . $code . '_' . $dt->format('Y-m-d');
        $fileName = $nama . '.' . $file->getClientOriginalExtension();
        $folder = '/uploads/purchase/' . $type . '/' . $dt->format('Y-m-d') . '/' . $code;

        $check = public_path($folder) . $fileName;

        if (File::exists($check)) {
            File::delete($check);
        }

        $filePath = $file->storeAs($folder, $fileName, 'public');
        return $filePath;
    }
}
