<?php

namespace App\Http\Controllers\OperatorSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\SuratKeluar;
use App\Models\TeruskanEffortSurat;

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
        $data = SuratKeluar::Where('status','5')->orderBy('id_surat_keluar','DESC')->get();
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
                    $button = '
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="'.route('arsip-surat-keluar.show',$data->id_surat_keluar).'" class="btn btn-success text-white btn-sm" title="Edit">
                                    <i class="fas fa-info"></i> Detail
                                </a>

                                <a target="_blank" href="'.route('arsip-surat-keluar.cetak',$data->id_surat_keluar).'" class="btn btn-primary text-white btn-sm" title="Edit">
                                <i class="fas fa-print"></i> Print
                                </a>
                            </div>    
                            ';
                    return $button;
                })
                
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function show($id){
        
        
        $result = SuratKeluar::select('surat_keluar.*','indeks','id_effort_surat','tanggal_effort')
                ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('effort_surat_keluar.id_surat_keluar',$id)
                ->first();
            return view('operator-surat.arsip.arsip-surat-keluar-detail',\compact('result'));
    }

    public function cetak($id){
        $result = SuratKeluar::select('surat_keluar.*','indeks','id_effort_surat','tanggal_effort')
                ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('effort_surat_keluar.id_surat_keluar',$id)
                ->first();
        $data = TeruskanEffortSurat::select('teruskan_effort_surat.*', 'nama_pegawai','jabatan.id_jabatan','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian','instruksi')
        ->join('pegawai', 'pegawai.nip_pegawai', '=', 'teruskan_effort_surat.id')
        ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
        ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
        ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
        ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
        ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
        ->where('id_effort_surat','=',$result->id_effort_surat)
        ->orderBy('id_teruskan_effort_surat','ASC')
        ->get();
        return view('operator-surat.effort.effort-surat-cetak', \compact('result','data'));
    }
}
