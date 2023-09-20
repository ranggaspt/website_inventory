<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\InventoryRequest;
use App\Models\Inventory;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use DB;

class AdminInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventories = Inventory::latest()->get();
        $this->data['inventories'] = $inventories;
        return view('admin.inventory.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jumlahRow = Inventory::all()->count();
        $number = $jumlahRow + 1;
        $date = new DateTime();
        $timeNow = $date->format('dmy');
        $kode = "1312-" . $timeNow . "-" . $number;
        $this->data['kode'] = $kode;
        return view('admin.inventory.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryRequest $request)
    {
        $params = $request->all();
        if ($request->has('price')){
            $params['price'] = str_replace('.', '', $request['price']);
        }
        if ($request->has('file')) {
            $params['file'] = $this->saveFile('inventory', $request->file('file'), $params['name']);
        }
        if (Inventory::create($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/inventory');
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
        $inventory = Inventory::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $inventory;
        return view('admin.inventory.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InventoryRequest $request, string $id)
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
        
        $inventories = Inventory::findOrFail(Crypt::decrypt($id));
        if ($inventories->update($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/inventory');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inventory = Inventory::findOrFail(Crypt::decrypt($id));
        $url = $inventory->file;
        $dir = public_path('storage/' . substr($url, 0, strrpos($url, '/')));
        $path = public_path('storage/' . $url);

        File::delete($path);

        rmdir($dir);
        if ($inventory->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect('admin/inventory');
    }

    private function saveFile($type, $file, $name)
    {
        $dt = new DateTime();

        $path = public_path('storage/uploads/inventory/' . $type . '/' . $dt->format('Y-m-d') . '/' . $name);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $berkas = $file;
        $nama =  $type . '_' . $name . '_' . $dt->format('Y-m-d');
        $fileName = $nama . '.' . $file->getClientOriginalExtension();
        $folder = '/uploads/inventory/' . $type . '/' . $dt->format('Y-m-d') . '/' . $name;

        $check = public_path($folder) . $fileName;

        if (File::exists($check)) {
            File::delete($check);
        }

        $filePath = $file->storeAs($folder, $fileName, 'public');
        return $filePath;
    }

    public function download($id){

        $files = DB::table('inventories')->where('id', $id)->first();
        $pathToFile = public_path("storage/{$files->file}");
        return \Response::download($pathToFile);
    }


}
