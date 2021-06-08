<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OperatorKepegawaian\UnitKerjaRequest;
use App\Models\Unit_kerja;
use App\Models\Jabatan;
use App\Models\Asisten;
use App\Models\Bagian;
use App\Models\SubBagian;
use App\Models\Staf_ahli as Staf;

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
        $results = Jabatan::all();
        return view('admin.masterdata.unit-kerja.unit-kerja-add',\compact('results'));      
    }

    //method untuk menyinpan data unit kerja
    public function store(UnitKerjaRequest $request)
    {
        $data           = $request->all();
        $data['status'] = 0;
        // dd($data);
        Unit_kerja::create($data);
        
        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Ditambah');
    }

    public function get_staf(Request $request){
        $data = $request->data;
        if ($data == 3) {
            $results = Staf::all();
            $output = '<option selected disabled> --Pilih Staf Ahli-- </option>';
            foreach ($results as $result) {
                if ($result->nama_staf_ahli != '-' ) {
                    $output .= ' <option value="'.$result->id_staf_ahli.'">'.$result->nama_staf_ahli.'</option>';
                }
            }
        } 
        echo $output;
    }

    public function get_asisten(Request $request){
        $data = $request->data;
        if ($data == 4) {
            $results = asisten::all();
            $output = '<option selected disabled> --Pilih Asisten-- </option>';
            foreach ($results as $result) {
                if ($result->nama_asisten != '-' ) {
                    $output .= ' <option value="'.$result->id_asisten.'">'.$result->nama_asisten.'</option>';
                }
            }
        } 
        echo $output;
    }

    public function get_bagian(Request $request){
        $data = $request->data;
        
            $results = Bagian::Where('id_asisten',$data)->get();
            $output = '<option selected disabled> --Pilih Bagian-- </option>';
            foreach ($results as $result) {
                if ($result->nama_bagian != '-' ) {
                    $output .= ' <option value="'.$result->id_bagian.'">'.$result->nama_bagian.'</option>';
                }
            }
        echo $output;
    }

    public function get_sub_bagian(Request $request){
        $data = $request->data;
        
            $results = SubBagian::Where('id_bagian',$data)->get();
            $output = '<option selected disabled> --Pilih Sub bagian-- </option>';
            foreach ($results as $result) {
                if ($result->nama_sub_bagian != '-' ) {
                    $output .= ' <option value="'.$result->id_sub_bagian.'">'.$result->nama_sub_bagian.'</option>';
                }
            }
        echo $output;
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
