<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OperatorKepegawaian\UnitKerjaRequest;
use App\Models\Unit_kerja;

class UnitKerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data   = Unit_kerja::all();
        return view('admin.masterdata.unit-kerja.unit-kerja',[
            'items' => $data
        ]);
    }

    //metod untuk menampilkan form tambah unit kerja
    public function create()
    {
        return view('admin.masterdata.unit-kerja.unit-kerja-add');      
    }

    //method untuk menyinpan data unit kerja
    public function store(UnitKerjaRequest $request)
    {
        $data           = $request->all();
        $data['status'] = '0';

        Unit_kerja::create($data);
        
        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Ditambah');
    }

    //method untuk menampikan form edit data
    public function edit($id)
    {
        $data   = Unit_kerja::findOrFail($id);
        return view('admin.masterdata.unit-kerja.unit-kerja-edit',[
            'item' => $data
        ]);
    }

    //method untuk update data
    public function update(UnitKerjaRequest $request, $id)
    {
        $data   = $request->all();
        $item   = Unit_kerja::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Edit');
    }

    public function destroy(Unit_kerja $data_unit_kerja)
    {
        Unit_kerja::destroy($data_unit_kerja->id_unit);
        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Dihapus');
    }
}
