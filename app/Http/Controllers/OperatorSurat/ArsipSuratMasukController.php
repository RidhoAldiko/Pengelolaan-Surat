<?php

namespace App\Http\Controllers\OperatorSurat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\SuratMasuk;
use App\Models\TeruskanDisposisiMasuk;

class ArsipSuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operator-surat.arsip.arsip-surat-masuk');
    }

    public function arsip_surat_serverside(){
        $data = SuratMasuk::where('status','1')->orWhere('status','4')->orderBy('id_surat_masuk','DESC')->get();
        return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('pengirim', function($data){ 
                    return $data->pengirim; 
                })
                ->editColumn('nomor_surat', function($data){ 
                    return $data->nomor_surat; 
                })
                ->editColumn('tanggal_surat', function($data){ 
                    return date("d/m/Y", strtotime($data->tanggal_surat));
                })
                ->addColumn('status', function($data) {
                    if ($data->status == 0) {
                        return "didisposisi";
                    }else
                    if ($data->status == 1) {
                        return "Tidak didisposisi";
                    }else
                    if ($data->status == 4) {
                        return "Selesai didisposisi";
                    }
                })
                ->addColumn('aksi', function($data) {

                    if ($data->status == 1) {
                        $button = '
                                <a href="'.route('arsip-surat-masuk.detail',$data->id_surat_masuk).'" class="btn btn-success text-white btn-sm mx-1" title="Edit">
                                    <i class="fas fa-info"></i> Detail
                                </a>
                            ';
                    } else {
                        $button = '
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="'.route('arsip-surat-masuk.detail',$data->id_surat_masuk).'" class="btn btn-success text-white btn-sm mx-1" title="Edit">
                                    <i class="fas fa-info"></i> Detail
                                </a>

                                <a target="_blank" href="'.route('arsip-surat-masuk.cetak',$data->id_surat_masuk).'" class="btn btn-primary text-white btn-sm mx-1" title="Edit">
                                <i class="fas fa-print"></i> Print
                                </a>
                            </div>    
                            ';
                    }
                    
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function detail($id){
        $result = SuratMasuk::findOrFail($id);
        if($result->status ==1) {
            $surat_masuk = SuratMasuk::where('id_surat_masuk',$id)->first();
            return view('operator-surat.arsip.arsip-surat-masuk-detail',compact('surat_masuk'));
        } else {
            $disposisi = SuratMasuk::select('surat_masuk.*','indeks','id_disposisi_surat_masuk','tanggal_disposisi')
                ->join('disposisi_surat_masuk', 'disposisi_surat_masuk.id_surat_masuk', '=', 'surat_masuk.id_surat_masuk')
                ->where('disposisi_surat_masuk.id_surat_masuk',$id)
                ->first();
            return view('operator-surat.arsip.arsip-disposisi-detail',compact('disposisi'));
        }
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
