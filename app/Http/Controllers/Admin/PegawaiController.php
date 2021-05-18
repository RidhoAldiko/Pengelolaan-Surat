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
        return view('admin.pegawai.pegawai');
    }
    public function pegawai_serverSide(){
        //get data pegawai 
        $data = Pegawai::select('pegawai.*','nama_unit','nama_golongan','nama_jabatan')
                ->join('unit_kerja', 'unit_kerja.id_unit', '=', 'pegawai.id_unit')
                ->join('golongan', 'golongan.id_golongan', '=', 'pegawai.id_golongan')
                ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
                ->get();
        return DataTables::of($data)
                ->editColumn('nip', function($data){ 
                    return $data->nip_pegawai; 
                })
                ->editColumn('nama', function($data){ 
                    return $data->nama_pegawai; 
                })
                ->editColumn('unit', function($data){ 
                    return $data->nama_unit; 
                })
                ->editColumn('golongan', function($data){ 
                    return $data->nama_golongan; 
                })
                ->editColumn('jabatan', function($data){ 
                    return $data->nama_jabatan; 
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
    
    public function pegawai_create(){
        //get data unit kerja
        $unit = Unit::where('status','=',0)->get();
        //get data golongan
        $golongan = Golongan::where('status','=',0)->get();
        //get data jabatan
        $jabatan = Jabatan::where('status','=',0)->get();
        return view('admin.pegawai.pegawai-create',\compact('unit','jabatan','golongan'));
    }

    public function pegawai_store(PegawaiRequest $request){

    }
}
