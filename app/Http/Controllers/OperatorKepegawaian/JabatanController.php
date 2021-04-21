<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\JabatanRequest;
use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $data   = Jabatan::all();
        return view('operator-kepegawaian.masterdata.jenis-jabatan.jabatan',[
            'items' => $data
        ]);
    }

    public function create()
    {
        return view('operator-kepegawaian.masterdata.jenis-jabatan.jabatan-add');
    }

    public function store(JabatanRequest $request)
    {
        $data           = $request->all();
        $data['status'] = '0';
        jabatan::create($data);

        return redirect()->route('data-jabatan.index')->with('status','Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $data          = Jabatan::findOrFail($id);
        return view('operator-kepegawaian.masterdata.jenis-jabatan.jabatan-edit',[
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

    public function destroy($id)
    {
        $data = jabatan::findOrFail($id);
        $data->delete();
        return redirect()->route('data-jabatan.index')->with('status','Data Berhasil Dihapus');
    }
}
