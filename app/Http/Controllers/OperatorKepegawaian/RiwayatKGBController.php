<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\RiwayatKGBRequest;
use App\Models\Gaji;
use App\Models\RiwayatKGB;
use App\Models\RiwayatPangkat;
use Illuminate\Http\Request;

class RiwayatKGBController extends Controller
{
    public function create()
    {
        return view('operator-kepegawaian.riwayat-kgb.riwayat-kgb-create');
    }

    public function store(RiwayatKGBRequest $request)
    {
        $data = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama
        $data['nip_pegawai'] = $explode[0];
       
        $pangkatPegawai   = RiwayatPangkat::where('nip_pegawai',$data['nip_pegawai'])->where('status', 0)->orderBy('id_riwayat_pangkat', 'desc')->first();
        $selisihTahun     = floor((strtotime($data['mulai_berlaku'])-strtotime($pangkatPegawai->tmt))/(60 * 60 * 24 * 365));
        $tahun            = (int)$selisihTahun;
        
        $gaji             = Gaji::where('id_golongan',$pangkatPegawai->id_golongan)->where('mkg',$tahun)->first();
        
        //kriteria pegawai tidak ada di tabel gaji
            if ($gaji == null) {
                return redirect()->route('pegawai-riwayat-kgb.create')->with('status_gagal','Data Gaji Master tidak ada yang cocok dengan kriteria pegawai');
            }
        
        //cek data riwayatKGB, jika ada data lama statusnya nonaktifkan 
        $data_riwayatkgb = RiwayatKGB::where('nip_pegawai',$data['nip_pegawai'])->where('status', 0)->orderBy('id_riwayat_kgb','desc')->first();
                if ($data_riwayatkgb != null) {
                    //update status data sebelmunya dengan nonaktif
                    $data['status']=1;
                    $data_riwayatkgb->update([
                        'status' => $data['status']
                    ]);
                }
        $data['status']  = 0;
        $data['id_gaji'] = $gaji->id_gaji;  

        RiwayatKGB::create($data);
        return redirect()->route('pegawai-riwayat-kgb.create')->with('status','Data Kenaikan Gaji Berkala pegawai berhasil ditambah');
    }
    public function edit($id)
    {
        $pegawai = RiwayatKGB::findOrFail($id);

        return view('operator-kepegawaian.riwayat-kgb.riwayat-kgb-edit',compact('pegawai'));
    }

    public function update(RiwayatKGBRequest $request, $id)
    {
        $data           = $request->all();
            $pangkatPegawai     = RiwayatPangkat::where('nip_pegawai',$data['nip_pegawai'])->where('status', 0)->orderBy('id_riwayat_pangkat', 'desc')->first();
            $selisihTahun     = floor((strtotime($data['mulai_berlaku'])-strtotime($pangkatPegawai->tmt))/(60 * 60 * 24 * 365));
            $tahun            = (int)$selisihTahun;
           
            $gaji               = Gaji::where('id_golongan',$pangkatPegawai->id_golongan)->where('mkg',$tahun)->first();
            //kriteria pegawai tidak ada di tabel gaji
                if ($gaji == null) {
                    return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status_gagal','Data Gaji Master tidak ada  yang cocok dengan kriteria pegawai');
                } 
        $data['id_gaji']    = $gaji->id_gaji; 
        $item               = RiwayatKGB::findOrFail($id);
        $data['status']     = $item->status;
        $item->update($data);
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data riwayat Kenaikan gaji berkala berhasil diedit");
    }

    public function destroy($id)
    {
        $data = RiwayatKGB::findOrFail($id);
        $data->delete();
        
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data riwayat Kenaikan gaji berkala berhasil dihapus");
    }
}
