<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StafAhliRequest;
use App\Http\Requests\Admin\AsistenRequest;
use App\Http\Requests\Admin\BagianRequest;
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
        $staf_ahli   = Staf::all();
        $asisten   = Asisten::all();
        $bagian = Bagian::select('bagian.*','nama_asisten')
                ->join('asisten','asisten.id_asisten','=','bagian.id_asisten')->get();
        $sub_bagian = SubBagian::select('sub_bagian.*','nama_bagian')
        ->join('bagian','bagian.id_bagian','=','sub_bagian.id_bagian')->get();
        return view('admin.masterdata.unit-kerja.unit-kerja',\compact('staf_ahli','asisten','bagian','sub_bagian'));
    }

    //metod untuk menampilkan form tambah unit kerja
    public function create_staf_ahli()
    {
        return view('admin.masterdata.unit-kerja.staf-ahli.staf-ahli-create');      
    }

    //method untuk menyinpan data staf ahli
    public function store_staf_ahli(StafAhliRequest $request)
    {
        $data           = $request->all();
        $data['status'] = 0;
        Staf::create($data);
        
        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Ditambah');
    }

    public function edit_staf_ahli($id){
        $result   = Staf::findOrFail($id);
        return view('admin.masterdata.unit-kerja.staf-ahli.staf-ahli-edit',\compact('result'));
    }

    public function update_staf_ahli(StafAhliRequest $request, $id)
    {
        $data   = $request->all();
        $item   = Staf::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Edit');
    }

    public function destroy_staf_ahli($id)
    {
        $result   = Staf::findOrFail($id);
        Staf::destroy($result->id_staf_ahli);
        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Dihapus');
    }

    public function create_asisten()
    {
        return view('admin.masterdata.unit-kerja.asisten.asisten-create');      
    }

    public function store_asisten(AsistenRequest $request)
    {
        $data           = $request->all();
        $data['status'] = 0;
        Asisten::create($data);
        
        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Ditambah');
    }

    public function edit_asisten($id){
        $result   = Asisten::findOrFail($id);
        return view('admin.masterdata.unit-kerja.asisten.asisten-edit',\compact('result'));
    }

    public function update_asisten(AsistenRequest $request, $id)
    {
        $data   = $request->all();
        $item   = Asisten::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Edit');
    }

    public function destroy_asisten($id)
    {
        $result = Asisten::select('asisten.*','bagian.id_bagian','nama_bagian','sub_bagian.id_sub_bagian','nama_sub_bagian')
                ->join('bagian','bagian.id_asisten','=', 'asisten.id_asisten')
                ->join('sub_bagian','sub_bagian.id_bagian','=', 'bagian.id_bagian')
                ->where('asisten.id_asisten',$id)
                ->first();
        // dd($result);
        Bagian::destroy($result->id_bagian);
        SubBagian::destroy($result->id_sub_bagian);
        Asisten::destroy($result->id_asisten);
        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Dihapus');
    }

    public function create_bagian()
    {
        $results = Asisten::all();
        return view('admin.masterdata.unit-kerja.bagian.bagian-create',\compact('results'));      
    }

    public function store_bagian(BagianRequest $request)
    {
        $data           = $request->all();
        $data['status'] = 0;
        Bagian::create($data);
        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Ditambah');
    }

    public function edit_bagian($id){
        $results = Asisten::all();
        $bagian = Bagian::select('bagian.*','bagian.id_asisten','nama_asisten')
        ->join('asisten','asisten.id_asisten','=','bagian.id_asisten')
        ->where('bagian.id_bagian',$id)
        ->first();
        return view('admin.masterdata.unit-kerja.bagian.bagian-edit',\compact('results','bagian'));
    }

    public function update_bagian(BagianRequest $request, $id)
    {
        $data   = $request->all();
        $item   = Bagian::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Edit');
    }

    public function destroy_bagian($id)
    {
        $result   = Bagian::findOrFail($id);
        Bagian::destroy($result->id_asisten);
        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Dihapus');
    }

    public function create_sub_bagian(){
        $results = Asisten::all();
        return view('admin.masterdata.unit-kerja.sub-bagian.sub-bagian-create',\compact('results'));
    }

    public function store_sub_bagian(Request $request){
        $data = $request->all();
        SubBagian::create([
            'id_bagian' => $data['id_bagian'],
            'nama_sub_bagian' => $data['nama_sub_bagian'],
            'status' => '0'
        ]);
        return redirect()->route('data-unit_kerja.index')->with('status','Data Sub Bagian Berhasil Ditambahkan');
    }

    public function edit_sub_bagian($id){
        $asisten = Asisten::all();
        $result = Asisten::select('asisten.*','bagian.id_bagian','nama_bagian','sub_bagian.id_sub_bagian','nama_sub_bagian')
                ->join('bagian','bagian.id_asisten','=', 'asisten.id_asisten')
                ->join('sub_bagian','sub_bagian.id_bagian','=', 'bagian.id_bagian')
                ->where('sub_bagian.id_sub_bagian',$id)
                ->first();
        $bagian = Bagian::where('id_asisten',$result->id_asisten)->get();
        return view('admin.masterdata.unit-kerja.sub-bagian.sub-bagian-edit',\compact('asisten','bagian','result'));
    }

    public function update_sub_bagian(Request $request,$id){
        $data = [
            'id_bagian' => $request->id_bagian,
            'nama_sub_bagian' => $request->nama_sub_bagian,
        ];
        $item   = SubBagian::findOrFail($id);
        $item->update($data);
        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Edit');
    }

    public function destroy_sub_bagian($id){
        $result   = SubBagian::findOrFail($id);
        SubBagian::destroy($result->id_sub_bagian);
        return redirect()->route('data-unit_kerja.index')->with('status','Data Berhasil Dihapus');
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
    
    
}
