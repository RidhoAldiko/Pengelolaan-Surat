<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OperatorKepegawaian\GolonganRequest;
use App\Models\Golongan;

class GolonganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data   = Golongan::all();
        return view('admin.masterdata.jenis-golongan.golongan',[
            'items' => $data
        ]);
    }

    public function create()
    {
        return view('admin.masterdata.jenis-golongan.golongan-add');
    }

    public function store(GolonganRequest $request)
    {
        $data           = $request->all();
        $data['status'] = 0;
        Golongan::create($data);

        return redirect()->route('data-golongan.index')->with('status','Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $data          = Golongan::findOrFail($id);
        return view('admin.masterdata.jenis-golongan.golongan-edit',[
            'item' => $data
        ]);
    }

    public function update(GolonganRequest $request, $id)
    {
        $data       = $request->all();
        $item       = Golongan::findOrFail($id); 
        $item->update($data);
        return redirect()->route('data-golongan.index')->with('status','Data Berhasil Diedit');
    }

    public function destroy(Golongan $data_golongan)
    {
        Golongan::destroy($data_golongan->id_golongan);
        return redirect()->route('data-golongan.index')->with('status','Data Berhasil Dihapus');
    }
}
