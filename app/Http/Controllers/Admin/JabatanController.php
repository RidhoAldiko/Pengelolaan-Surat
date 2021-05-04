<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OperatorKepegawaian\JabatanRequest;
use App\Models\Jabatan;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data   = Jabatan::all();
        return view('admin.masterdata.jenis-jabatan.jabatan',[
            'items' => $data
        ]);
    }

    public function create()
    {
        return view('admin.masterdata.jenis-jabatan.jabatan-add');
    }

    public function store(JabatanRequest $request)
    {
        $data           = $request->all();
        $data['status'] = 0;
        jabatan::create($data);

        return redirect()->route('data-jabatan.index')->with('status','Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $data          = Jabatan::findOrFail($id);
        return view('admin.masterdata.jenis-jabatan.jabatan-edit',[
            'item' => $data
        ]);
    }

    public function update(JabatanRequest $request, $id)
    {
        $data       = $request->all();
        $item       = Jabatan::findOrFail($id); 
        $item->update($data);
        return redirect()->route('data-jabatan.index')->with('status','Data Berhasil Diedit');
    }

    public function destroy(Jabatan $data_jabatan)
    {
        Jabatan::destroy($data_jabatan->id_jabatan);
        return redirect()->route('data-jabatan.index')->with('status','Data Berhasil Dihapus');
    }
}
