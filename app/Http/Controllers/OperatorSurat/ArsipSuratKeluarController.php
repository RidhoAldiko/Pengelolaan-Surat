<?php

namespace App\Http\Controllers\OperatorSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\SuratKeluar;

class ArsipSuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operator-surat.arsip.arsip-surat-keluar');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function arsip_surat_serverside()
    {
        $data = SuratKeluar::Where('status','5')->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('alamat', function($data){ 
                    return $data->alamat; 
                })
                ->editColumn('nomor_surat', function($data){ 
                    return $data->nomor_surat; 
                })
                ->editColumn('tanggal_surat', function($data){ 
                    return date("d/m/Y", strtotime($data->tanggal_surat));
                })
                ->addColumn('status', function($data) {
                    if ($data->status == 5) {
                        return "Selesai di Approval";
                    }
                })
                ->addColumn('aksi', function($data) {
                    $button = '<a href="'.route('arsip-surat-keluar.show',$data->id_surat_keluar).'" class="btn btn-success text-white btn-sm" title="Edit">
                                    <i class="fas fa-info"></i> Detail
                                </a>
                            ';
                    return $button;
                })
                
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function show($id){
        $result = SuratKeluar::select('surat_keluar.*','indeks','id_effort_surat','tanggal_effort')
                ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('id_effort_surat',$id)
                ->first();
            return view('operator-surat.arsip.arsip-surat-keluar-detail',\compact('result'));
    }
}
