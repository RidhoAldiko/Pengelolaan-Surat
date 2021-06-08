<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OperatorKepegawaian\PegawaiRequest;
use Yajra\DataTables\DataTables;
use App\Models\Pegawai;
use App\Models\Unit_kerja as Unit;
use App\Models\Jabatan;
use App\Models\Asisten;
use App\Models\Bagian;
use App\Models\SubBagian;
use App\Models\Staf_ahli as Staf;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $data = Pegawai::select('pegawai.*','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
        // ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        // ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
        // ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
        // ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
        // ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
        // ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
        // ->get();
        // return $data;
        return view('admin.pegawai.pegawai');
    }
    public function pegawai_serverSide(){
        //get data pegawai 
        $data = Pegawai::select('pegawai.*','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
        ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
        ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
        ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
        ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
        ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
        ->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('nip', function($data){ 
                    return $data->nip_pegawai; 
                })
                ->editColumn('nama', function($data){ 
                    return $data->nama_pegawai; 
                })
                ->editColumn('jabatan', function($data){ 
                    return $data->nama_jabatan; 
                })

                ->editColumn('unit', function($data){ 
                    
                    if($data->id_jabatan < 3) {
                        return '-';
                    } else 
                    if($data->id_jabatan == 3) {
                        return $data->nama_staf_ahli;
                    } else 
                    if($data->id_jabatan == 4) {
                        return $data->nama_asisten;
                    } else 
                    if($data->id_jabatan == 5) {
                        return $data->nama_bagian;
                    } else 
                    if($data->id_jabatan >= 6) {
                        return $data->nama_sub_bagian;
                    }
                })
                ->editColumn('status', function($data){ 
                    return ($data->status == 0) ? 'Aktif' : 'Nonaktif';
                })
                ->addColumn('aksi', function($data) {
                    $button = ' 
                                <a href="'.route('data-pegawai.show',$data->nip_pegawai).'" class="btn btn-success text-white btn-sm" title="Edit">
                                <i class="fas fa-info"></i> Detail
                                </a>
                                <a href="'.route('data-pegawai.edit',$data->nip_pegawai).'" class="btn btn-warning text-white btn-sm" title="Edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <a href="#" class="btn btn-danger btn-sm getIdPegawai" data-toggle="modal" data-target="#deletePegawai" data-id="'.$data->nip_pegawai.'" >
                                    <i class="fas fa-trash fa-sm"></i> Hapus
                                </a>
                                ';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }
    
    public function create(){
        $jabatan = Jabatan::where('status','=',0)->get();
        return view('admin.pegawai.pegawai-create',\compact('jabatan'));
    }

    public function store(Request $request){
        // $this->validate($request,[
        //     'nip_pegawai' => 'unique:pegawai'
        // ],[
        //     'nip_pegawai.unique' => 'Nip pegawai tidak boleh sama',
        // ]);
        $data = $request->all();
        $data['status'] = 0;
        $store = Pegawai::create($data);

        if ($data['id_jabatan'] < 3) {
            $staf_ahli = Staf::Where('nama_staf_ahli','-')->first('id_staf_ahli');
            $asisten = Asisten::Where('nama_asisten','-')->first('id_asisten');
            $bagian = Bagian::Where('nama_bagian','-')->first('id_bagian');
            $sub_bagian = SubBagian::Where('nama_sub_bagian','-')->first('id_sub_bagian');
            $unit_kerja = Unit::create([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $staf_ahli['id_staf_ahli'],
                'id_asisten' => $asisten['id_asisten'],
                'id_bagian' => $bagian['id_bagian'],
                'id_sub_bagian' => $sub_bagian['id_sub_bagian'],
            ]);
        } else 
        if ($data['id_jabatan'] == 3){
            $asisten = Asisten::Where('nama_asisten','-')->first('id_asisten');
            $bagian = Bagian::Where('nama_bagian','-')->first('id_bagian');
            $sub_bagian = SubBagian::Where('nama_sub_bagian','-')->first('id_sub_bagian');
            $unit_kerja = Unit::create([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $data['id_staf_ahli'],
                'id_asisten' => $asisten['id_asisten'],
                'id_bagian' => $bagian['id_bagian'],
                'id_sub_bagian' => $sub_bagian['id_sub_bagian'],
            ]);
        } else 
        if ($data['id_jabatan'] == 4) {
            $staf_ahli = Staf::Where('nama_staf_ahli','-')->first('id_staf_ahli');
            $bagian = Bagian::Where('nama_bagian','-')->first('id_bagian');
            $sub_bagian = SubBagian::Where('nama_sub_bagian','-')->first('id_sub_bagian');
            $unit_kerja = Unit::create([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $staf_ahli['id_staf_ahli'],
                'id_asisten' => $data['id_asisten'],
                'id_bagian' => $bagian['id_bagian'],
                'id_sub_bagian' => $sub_bagian['id_sub_bagian'],
            ]);
        } else 
        if ($data['id_jabatan'] == 5) {
            $staf_ahli = Staf::Where('nama_staf_ahli','-')->first('id_staf_ahli');
            $sub_bagian = SubBagian::Where('nama_sub_bagian','-')->first('id_sub_bagian');
            $unit_kerja = Unit::create([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $staf_ahli['id_staf_ahli'],
                'id_asisten' => $data['id_asisten'],
                'id_bagian' => $data['id_bagian'],
                'id_sub_bagian' => $sub_bagian['id_sub_bagian'],
            ]);
        }else 
        if ($data['id_jabatan'] > 5) {
            $staf_ahli = Staf::Where('nama_staf_ahli','-')->first('id_staf_ahli');
            $unit_kerja = Unit::create([
                'nip_pegawai' => $data['nip_pegawai'],
                'id_staf_ahli' => $staf_ahli['id_staf_ahli'],
                'id_asisten' => $data['id_asisten'],
                'id_bagian' => $data['id_bagian'],
                'id_sub_bagian' => $data['id_sub_bagian'],
            ]);
        }
        
        
        
        return redirect()->route('admin-pegawai.index')->with('status',"Data Berhasil Ditambah");
    }
}
