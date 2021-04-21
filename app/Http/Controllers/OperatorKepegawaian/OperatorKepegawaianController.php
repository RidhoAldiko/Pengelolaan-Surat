<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\PegawaiRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
//inisialisasi model yang digunakan
use App\Models\Pegawai;
use App\Models\Unit_kerja as Unit;
use App\Models\Golongan;
use App\Models\Jabatan;

class OperatorKepegawaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //method dashboad
    public function index()
    {   
        return view('operator-kepegawaian.dashboard');
    }
    // method form data pegawai
    public function data_pegawai(){
        return view('operator-kepegawaian.pegawai.pegawai');
    }
    // method get server side data pegawai
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
                    $button = ' <a href="'.route('data-pegawai.edit', $data->nip_pegawai).'" class="btn btn-warning text-white btn-sm" title="Edit">
                                    <i class="fas fa-pencil-alt"></i>
                                </a> ';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }
    //method form data pegawai
    public function add_pegawai(){
        //get data unit kerja
        $unit = Unit::where('status','=',0)->get();
        //get data golongan
        $golongan = Golongan::where('status','=',0)->get();
        //get data jabatan
        $jabatan = Jabatan::where('status','=',0)->get();
        return view('operator-kepegawaian.pegawai.pegawai-add',\compact('unit','jabatan','golongan'));
    }
    //method store data pegawai
    public function store_pegawai(PegawaiRequest $request){
        $data = $request->all();
        $data['status'] = 0;
        // dd($data);
        //store data pegawai
        $store = Pegawai::create($data);
        return redirect()->route('data-pegawai.index')->with('status',"Data Berhasil Ditambah");
    }
    //method edit data
    public function edit($id)
    {
        //get data unit kerja
        $unit = Unit::where('status','=',0)->get();
        //get data golongan
        $golongan = Golongan::where('status','=',0)->get();
        //get data jabatan
        $jabatan = Jabatan::where('status','=',0)->get();

        $pegawai   = Pegawai::findOrFail($id);
        return view('operator-kepegawaian.pegawai.pegawai-edit',\compact('unit','jabatan','golongan','pegawai'));
    }

    public function update(PegawaiRequest $request, $id)
    {
        $data = $request->all();
       
        $item = Pegawai::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-pegawai.index')->with('status',"Data Berhasil Edit");
    }

}
