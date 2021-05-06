<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GajiRequest;
use App\Models\Gaji;
use App\Models\Golongan;
use Illuminate\Http\Request;

class GajiController extends Controller
{
    public function index()
    {
        $data   = Gaji::with(['golongan'])->get();
        return view('admin.masterdata.gaji.gaji',[
            'items' => $data
        ]);
    }

    public function create()
    {
        //get data golongan
        $golongan = Golongan::where('status','=',0)->get();
        return view('admin.masterdata.gaji.gaji-add',compact('golongan'));
    }

    public function store(GajiRequest $request)
    {
        $data           = $request->all();
        $data['status'] = 0;
        Gaji::create($data);

        return redirect()->route('data-gaji.index')->with('status','Data Berhasil Ditambah');
    }

    public function edit($id)
    {
        $data          = Gaji::with(['golongan'])->findOrFail($id);
        //get data golongan
        $golongan = Golongan::where('status','=',0)->get();
        return view('admin.masterdata.gaji.gaji-edit',[
            'item' => $data,
            'golongan' => $golongan
        ]);
    }

    public function update(GajiRequest $request, $id)
    {
        $data       = $request->all();
        $item       = Gaji::findOrFail($id); 
        $item->update($data);
        return redirect()->route('data-gaji.index')->with('status','Data Berhasil Diedit');
    }

    public function destroy(Gaji $data_gaji)
    {
        Gaji::destroy($data_gaji->id_gaji);
        return redirect()->route('data-gaji.index')->with('status','Data Berhasil Dihapus');
    }
}
