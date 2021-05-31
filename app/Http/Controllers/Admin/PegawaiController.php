<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OperatorKepegawaian\PegawaiRequest;
use Yajra\DataTables\DataTables;
use App\Models\Pegawai;
use App\Models\Unit_kerja as Unit;
use App\Models\Jabatan;
use App\Models\Golongan;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // $data = Pegawai::select('pegawai.*','nama_jabatan','nama_unit')
        // ->join('unit_kerja','unit_kerja.id_unit','=','pegawai.id_unit' )
        // ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        // ->get();
        // dd($data);
        return view('admin.pegawai.pegawai');
    }
    public function pegawai_serverSide(){
        //get data pegawai 
        $data = Pegawai::select('pegawai.*','nama_jabatan','nama_unit')
        ->join('unit_kerja','unit_kerja.id_unit','=','pegawai.id_unit' )
        ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
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
                    return $data->nama_unit; 
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
        //get data unit kerja
        $unit = Unit::where('status','=',0)->get();
        //get data golongan
        $golongan = Golongan::where('status','=',0)->get();
        //get data jabatan
        $jabatan = Jabatan::where('status','=',0)->get();
        return view('admin.pegawai.pegawai-create',\compact('unit','jabatan','golongan'));
    }

    public function store(PegawaiRequest $request){
        $this->validate($request,[
            'nip_pegawai' => 'unique:pegawai'
        ],[
            'nip_pegawai.unique' => 'Nip pegawai tidak boleh sama',
        ]);
        $data = $request->all();
        $data['status'] = 0;
        // dd($data);
        $store = Pegawai::create($data);
        return redirect()->route('admin-pegawai.index')->with('status',"Data Berhasil Ditambah");
    }
}
