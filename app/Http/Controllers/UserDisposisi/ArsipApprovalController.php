<?php

namespace App\Http\Controllers\UserDisposisi;

use App\Http\Controllers\Controller;
use App\Models\SuratKeluar;
use App\Models\TeruskanEffortSurat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ArsipApprovalController extends Controller
{
    public function index(){
                
        return view('user-disposisi.arsip.arsip-approval');
    }

    public function arsip_approval_serverside(){
        $id = Auth::user()->id;
        //cek level surat user yang login
        $level = User::select('users.*','urutan_level','nama_level')
                ->join('level_surat','level_surat.id_level_surat','=','users.id_level_surat')
                ->where('id',$id)
                ->first();
        //tampilkan disposisi surat masuk berdasarkan id user
        $results = SuratKeluar::select('surat_keluar.*','id_teruskan_effort_surat','indeks','effort_surat_keluar.id_effort_surat','tanggal_effort','teruskan_effort_surat.id','teruskan_effort_surat.status as status_teruskan','urutan_level')
                ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->join('teruskan_effort_surat', 'teruskan_effort_surat.id_effort_surat', '=', 'effort_surat_keluar.id_effort_surat')
                ->join('users','users.id','=','teruskan_effort_surat.id')
                ->join('level_surat','level_surat.id_level_surat','=','users.id_level_surat')
                ->where('urutan_level',$level->urutan_level)
                ->where('users.id',$id)
                ->where('teruskan_effort_surat.status','1')
                ->orderBy('id_teruskan_effort_surat','DESC')
                ->get();

                return DataTables::of($results)
                ->addIndexColumn()
                ->editColumn('nomor_surat', function($data){ 
                    return $data->nomor_surat; 
                })
                
                ->editColumn('tanggal_surat', function($data){ 
                    return date("d/m/Y", strtotime($data->tanggal_surat));
                })
                ->editColumn('tanggal_effort', function($data){ 
                    return date("d/m/Y", strtotime($data->tanggal_effort));
                })
                ->addColumn('status', function($data) {
                    
                    if ($data->status == 2) {
                        return "Bejalan";
                    }elseif($data->status == 3) {
                        return "Selesai diapproval";
                    }elseif($data->status == 4) {
                        return "Approval Ditolak";
                    }else{
                        return "Selesai diapproval";
                    }
                })
                ->addColumn('aksi', function($data) {

                    if ($data->status == 2 || $data->status == 4 ) {
                        $button = '<a href="'.route('arsip-approval.detail',$data->id_surat_keluar).'" class="btn btn-success text-white btn-sm" title="Edit">
                                    <i class="fas fa-info"></i> Detail
                                </a>
                            ';
                    }else {
                        $button = '<a href="'.route('arsip-approval.detail',$data->id_surat_keluar).'" class="btn btn-success text-white btn-sm" title="Edit">
                                    <i class="fas fa-info"></i> Detail
                                </a>

                                <a target="_blank" href="'.route('arsip-approval.cetak',$data->id_surat_keluar).'" class="btn btn-primary text-white btn-sm" title="Edit">
                                <i class="fas fa-print"></i> Print
                                </a>
                            ';
                    }
                    
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);

        
    }

    public function detail($id){
        $result = SuratKeluar::select('surat_keluar.*','indeks','id_effort_surat','tanggal_effort')
                ->join('effort_surat_keluar', 'effort_surat_keluar.id_surat_keluar', '=', 'surat_keluar.id_surat_keluar')
                ->where('effort_surat_keluar.id_surat_keluar',$id)
                ->first();
        return view('user-disposisi.arsip.arsip-approval-detail',compact('result'));
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
