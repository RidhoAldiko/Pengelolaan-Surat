<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Models\Golongan;
use App\Models\Pegawai;
use App\Models\RiwayatKGB;
use App\Models\RiwayatPangkat;
use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;

class PrintPegawaiController extends Controller
{
    //metod untuk cetak pegawai perorangan
    public function cetak_perorangan($id)
    {
        
        $pegawai = Pegawai::with([
            'jabatan','hobi',
            'alamat','keterangan_badan',
            'riwayat_pendidikan',
            'keterangan_keluarga',
            'orangtua_kandung',
            'mertua','saudara_kandung',
            'penghargaan','pengalaman_keluar_negeri',
            'organisasi','keterangan_lain',
            'mutasi','diklat_penjenjangan',
            'dokumen_pegawai','riwayat_pangkat',
            'riwayat_kgb','kursusataupelatihan'])->where('nip_pegawai',$id)->findOrFail($id);
            
        $riwayat_kenaikan_gaji = RiwayatKGB::with(['golongan'])->where('nip_pegawai',$id)->orderBy('id_riwayat_kgb','asc')->get();
        $pendidikan = RiwayatPendidikan::where('nip_pegawai',$id)->orderBy('sampai','asc')->get();
        $pangkatgolongan = RiwayatPangkat::with(['golongan'])->where('nip_pegawai',$id)->where('status',0)->first();
         
            return view('operator-kepegawaian.pegawai.cetak_perorangan',compact('pegawai','pangkatgolongan','pendidikan','riwayat_kenaikan_gaji'));
    }

    public function cetakdata()
    {
        $pegawai        = Pegawai::with('pangkat_cpns','pangkat_pns','jabatan','riwayat_pangkat',
        'riwayat_kgb','diklat_penjenjangan','riwayat_pendidikan')->where('status','=','0')->get();
        $gol            = Golongan::where('status',0)->get();
        $pangkatgolongan = RiwayatPangkat::with(['pegawai','golongan'])->where('status',0)->orderBy('tmt','asc')->get();
        $riwayatkgb      = RiwayatKGB::with('pegawai')->where('status',0)->get();
        
        return view('operator-kepegawaian.pegawai.cetak_data_pegawai',compact('pangkatgolongan','pegawai','gol','riwayatkgb'));
    }
}
