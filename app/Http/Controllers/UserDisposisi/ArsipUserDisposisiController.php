<?php

namespace App\Http\Controllers\UserDisposisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Models\User;
use App\Models\SuratMasuk;
use App\Models\TeruskanDisposisiMasuk;

class ArsipUserDisposisiController extends Controller
{
    public function index(){
        // dd($results);
        return view('user-disposisi.arsip.arsip-disposisi');
    }

    public function arsip_disposisi_serverside(){
        $id = Auth::user()->id;
        //cek level surat user yang login
        $level = User::select('users.*','urutan_level','nama_level')
                ->join('level_surat','level_surat.id_level_surat','=','users.id_level_surat')
                ->where('id',$id)
                ->first();
        //tampilkan disposisi surat masuk berdasarkan id user
        $results = SuratMasuk::select('surat_masuk.*','id_teruskan_surat_masuk','indeks','disposisi_surat_masuk.id_disposisi_surat_masuk','tanggal_disposisi','teruskan_disposisi_masuk.id','teruskan_disposisi_masuk.status as status_teruskan','urutan_level')
                ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->join('teruskan_disposisi_masuk', 'teruskan_disposisi_masuk.id_disposisi_surat_masuk', '=', 'disposisi_surat_masuk.id_disposisi_surat_masuk')
                ->join('users','users.id','=','teruskan_disposisi_masuk.id')
                ->join('level_surat','level_surat.id_level_surat','=','users.id_level_surat')
                ->where('urutan_level',$level->urutan_level)
                ->where('users.id',$id)
                ->where('teruskan_disposisi_masuk.status','1')
                ->orderBy('id_teruskan_surat_masuk','DESC')
                ->get();

                return DataTables::of($results)
                ->addIndexColumn()
                ->editColumn('pengirim', function($data){ 
                    return $data->pengirim; 
                })->editColumn('nomor_surat', function($data){ 
                    return $data->nomor_surat; 
                })
                ->editColumn('tanggal_surat', function($data){ 
                    return date("d/m/Y", strtotime($data->tanggal_surat));
                })
                ->editColumn('tanggal_disposisi', function($data){ 
                    return date("d/m/Y", strtotime($data->tanggal_disposisi));
                })
                ->addColumn('status', function($data) {
                    
                    if ($data->status == 2) {
                        return "Bejalan";
                    }else {
                        return "Selesai didisposisi";
                    }
                })
                ->addColumn('aksi', function($data) {

                    if ($data->status == 2) {
                        $button = '<a href="'.route('arsip-disposisi.detail',$data->id_surat_masuk).'" class="btn btn-success text-white btn-sm" title="Edit">
                                    <i class="fas fa-info"></i> Detail
                                </a>
                            ';
                    } else {
                        $button = '<a href="'.route('arsip-disposisi.detail',$data->id_surat_masuk).'" class="btn btn-success text-white btn-sm" title="Edit">
                                    <i class="fas fa-info"></i> Detail
                                </a>

                                <a target="_blank" href="'.route('arsip-disposisi.cetak',$data->id_surat_masuk).'" class="btn btn-primary text-white btn-sm" title="Edit">
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
        $result = SuratMasuk::select('surat_masuk.*','indeks','id_disposisi_surat_masuk','tanggal_disposisi')
        ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
        ->where('disposisi_surat_masuk.id_surat_masuk',$id)
        ->first();
        return view('user-disposisi.arsip.arsip-disposisi-detail',\compact('result'));
    }

    public function cetak($id){
        $result = SuratMasuk::select('surat_masuk.*','indeks','id_disposisi_surat_masuk','tanggal_disposisi')
        ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
        ->where('disposisi_surat_masuk.id_surat_masuk',$id)
        ->first();
        
        $data = TeruskanDisposisiMasuk::select('teruskan_disposisi_masuk.*', 'nama_pegawai','jabatan.id_jabatan','nama_jabatan','nama_staf_ahli','nama_asisten','nama_bagian','nama_sub_bagian')
        ->join('pegawai', 'pegawai.nip_pegawai', '=', 'teruskan_disposisi_masuk.id')
        ->join('jabatan', 'jabatan.id_jabatan', '=', 'pegawai.id_jabatan')
        ->join('unit_kerja', 'unit_kerja.nip_pegawai', '=', 'pegawai.nip_pegawai')
        ->join('staf_ahli', 'staf_ahli.id_staf_ahli', '=', 'unit_kerja.id_staf_ahli')
        ->join('asisten', 'asisten.id_asisten', '=', 'unit_kerja.id_asisten')
        ->join('bagian', 'bagian.id_bagian', '=', 'unit_kerja.id_bagian')
        ->join('sub_bagian', 'sub_bagian.id_sub_bagian', '=', 'unit_kerja.id_sub_bagian')
        ->where('id_disposisi_surat_masuk','=',$result->id_disposisi_surat_masuk)
        ->orderBy('id_teruskan_surat_masuk','ASC')
        ->get();
        

        return view('operator-surat.disposisi.cetak_disposisi',\compact('result','data'));
    }
}
