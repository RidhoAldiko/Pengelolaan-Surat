<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\GolonganRequest;
use App\Models\Golongan;
use Illuminate\Http\Request;

class GolonganController extends Controller
{
    public function index()
    {
        $data   = Golongan::all();
        return view('operator-kepegawaian.masterdata.jenis-golongan.golongan',[
            'items' => $data
        ]);
    }

    public function create()
    {
        return view('operator-kepegawaian.masterdata.jenis-golongan.golongan-add');
    }

    public function store(GolonganRequest $request)
    {
        $data           = $request->all();
        $data['status'] = '0';
        Golongan::create($data);

        return redirect()->route('data-golongan.index')->with('status','Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $data          = Golongan::findOrFail($id);
        return view('operator-kepegawaian.masterdata.jenis-golongan.golongan-edit',[
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

    public function destroy($id)
    {
        $data = Golongan::findOrFail($id);
        $data->delete();
        return redirect()->route('data-golongan.index')->with('status','Data Berhasil Dihapus');
    }

}
