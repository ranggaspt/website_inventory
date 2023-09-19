<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;

class AdminSupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::latest()->get();
        $this->data['suppliers'] = $suppliers;
        return view('admin.supplier.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jumlahRow = Supplier::all()->count();
        $number = $jumlahRow + 1;
        $date = new DateTime();
        $timeNow = $date->format('dmy');
        $kode = "PN-" . $timeNow . "-" . $number;
        $this->data['kode'] = $kode;
        return view('admin.supplier.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $params = $request->all();
        if ($request->has('file')) {
            $params['file'] = $this->saveFile('supplier', $request->file('file'), $params['name']);
        }
        if (Supplier::create($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/supplier');
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
        $supplier = Supplier::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $supplier;
        return view('admin.supplier.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, string $id)
    {
        $params = $request->all();

        if ($request->has('file')) {
            $params['file'] = $this->saveFile('supplier', $request->file('file'), $params['name']);
        } else {
            $params = $request->except('file');
        }
        
        $suppliers = Supplier::findOrFail(Crypt::decrypt($id));
        if ($suppliers->update($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/supplier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail(Crypt::decrypt($id));
        $url = $supplier->file;
        $dir = public_path('storage/' . substr($url, 0, strrpos($url, '/')));
        $path = public_path('storage/' . $url);

        File::delete($path);

        rmdir($dir);
        if ($supplier->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect('admin/supplier');
    }

    private function saveFile($type, $file, $name)
    {
        $dt = new DateTime();

        $path = public_path('storage/uploads/supplier/' . $type . '/' . $dt->format('Y-m-d') . '/' . $name);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $berkas = $file;
        $nama =  $type . '_' . $name . '_' . $dt->format('Y-m-d');
        $fileName = $nama . '.' . $file->getClientOriginalExtension();
        $folder = '/uploads/supplier/' . $type . '/' . $dt->format('Y-m-d') . '/' . $name;

        $check = public_path($folder) . $fileName;

        if (File::exists($check)) {
            File::delete($check);
        }

        $filePath = $file->storeAs($folder, $fileName, 'public');
        return $filePath;
    }
}
