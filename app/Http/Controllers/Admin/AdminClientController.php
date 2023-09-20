<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Nette\Utils\DateTime;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use DB;

class AdminClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::latest()->get();
        $this->data['clients'] = $clients;
        return view('admin.client.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jumlahRow = Client::all()->count();
        $number = $jumlahRow + 1;
        $date = new DateTime();
        $timeNow = $date->format('dmy');
        $kode = "CL-" . $timeNow . "-" . $number;
        $this->data['kode'] = $kode;
        return view('admin.client.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClientRequest $request)
    {
        $params = $request->all();
        if ($request->has('file')) {
            $params['file'] = $this->saveFile('client', $request->file('file'), $params['name']);
        }
        if (Client::create($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/client');
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
        $client = Client::findOrFail(Crypt::decrypt($id));
        $this->data['data'] = $client;
        return view('admin.client.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ClientRequest $request, string $id)
    {
        $params = $request->all();

        if ($request->has('file')) {
            $params['file'] = $this->saveFile('client', $request->file('file'), $params['name']);
        } else {
            $params = $request->except('file');
        }
        
        $clients = Client::findOrFail(Crypt::decrypt($id));
        if ($clients->update($params)) {
            alert()->success('Success', 'Data Berhasil Disimpan');
        } else {
            alert()->error('Error', 'Data Gagal Disimpan');
        }
        return redirect('admin/client');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $client = Client::findOrFail(Crypt::decrypt($id));
        $url = $client->file;
        $dir = public_path('storage/' . substr($url, 0, strrpos($url, '/')));
        $path = public_path('storage/' . $url);

        File::delete($path);

        rmdir($dir);
        if ($client->delete()) {
            alert()->success('Success', 'Data Berhasil Dihapus');
        }
        return redirect('admin/client');
    }

    private function saveFile($type, $file, $name)
    {
        $dt = new DateTime();

        $path = public_path('storage/uploads/client/' . $type . '/' . $dt->format('Y-m-d') . '/' . $name);
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        $berkas = $file;
        $nama =  $type . '_' . $name . '_' . $dt->format('Y-m-d');
        $fileName = $nama . '.' . $file->getClientOriginalExtension();
        $folder = '/uploads/client/' . $type . '/' . $dt->format('Y-m-d') . '/' . $name;

        $check = public_path($folder) . $fileName;

        if (File::exists($check)) {
            File::delete($check);
        }

        $filePath = $file->storeAs($folder, $fileName, 'public');
        return $filePath;
    }

    public function download($id){

        $files = DB::table('clients')->where('id', $id)->first();
        $pathToFile = public_path("storage/{$files->file}");
        return \Response::download($pathToFile);
    }
}
