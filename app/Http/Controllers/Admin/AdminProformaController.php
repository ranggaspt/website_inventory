<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProformaRequest;
use App\Models\Proforma;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use DB;

class AdminProformaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proformas = Proforma::latest()->get();
        $this->data['proformas'] = $proformas;
        return view('admin.proforma.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jumlahRow = Proforma::all()->count();
        $number = $jumlahRow + 1;
        $date = new DateTime();
        $timeNow = $date->format('dmy');
        $kode = "PI-" . $timeNow . "-" . $number;
        $this->data['kode'] = $kode;
        return view('admin.proforma.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProformaRequest $request)
    {
        $params = $request->all();
        if ($request->has('total_price')){
            $params['total_price'] = str_replace('.', '', $request['total_price']);
        }
        if ($request->has('file')) {
            $params['file'] = $this->saveFile('proforma', $request->file('file'), $params['name']);
        }
        if (Proforma::create($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/proforma');
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
        $proforma = Proforma::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $proforma;
        return view('admin.proforma.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProformaRequest $request, string $id)
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
        
        $proformas = Proforma::findOrFail(Crypt::decrypt($id));
        if ($proformas->update($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/proforma');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proforma = Proforma::findOrFail(Crypt::decrypt($id));
        $url = $proforma->file;
        $dir = public_path('storage/' . substr($url, 0, strrpos($url, '/')));
        $path = public_path('storage/' . $url);

        File::delete($path);

        rmdir($dir);
        if ($proforma->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect('admin/proforma');
    }

    private function saveFile($type, $file, $name)
    {
        $dt = new DateTime();

        $path = public_path('storage/uploads/proforma/' . $type . '/' . $dt->format('Y-m-d') . '/' . $name);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $berkas = $file;
        $nama =  $type . '_' . $name . '_' . $dt->format('Y-m-d');
        $fileName = $nama . '.' . $file->getClientOriginalExtension();
        $folder = '/uploads/proforma/' . $type . '/' . $dt->format('Y-m-d') . '/' . $name;

        $check = public_path($folder) . $fileName;

        if (File::exists($check)) {
            File::delete($check);
        }

        $filePath = $file->storeAs($folder, $fileName, 'public');
        return $filePath;
    }

    public function download($id){

        $files = DB::table('proformas')->where('id', $id)->first();
        $pathToFile = public_path("storage/{$files->file}");
        return \Response::download($pathToFile);
    }
}
