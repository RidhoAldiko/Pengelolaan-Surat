<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\PangkatPNSRequest;
use App\Models\Golongan;
use App\Models\PangkatPNS;
use App\Models\RiwayatPangkat;
use Illuminate\Http\Request;

class PangkatPNSController extends Controller
{
    public function create()
    {
        //get data golongan
        $golongan = Golongan::where('status','=',0)->get();
        return view('operator-kepegawaian.pangkat-pns.pangkat-pns-create',compact('golongan'));
    }
    public function store(PangkatPNSRequest $request)
    {
        $data = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama
        $data['nip_pegawai'] = $explode[0];
        $data['tmt'] = date('Y-m-d H:i:s',strtotime($data['tmt'] ));
        $data['tanggal'] = date('Y-m-d H:i:s',strtotime($data['tanggal'] ));
        
        $pangkatPNS = PangkatPNS::where('nip_pegawai',$data['nip_pegawai'])->first();
            //jika sudah pernah input pangkat cpns maka campakan ke form lagi
            if ($pangkatPNS != null) {
                return redirect()->route('pegawai-pangkat-pns.create')->with('status_gagal','Data Pangkat PNS pegawai sudah pernah diinputkan!');
            }else{
                PangkatPNS::create($data);
                //inputkan datanya ke riwayat pangkat juga
                $data['batas_berlaku'] = date('Y-m-d',strtotime('+4 year', strtotime( $data['tmt'] )));
                RiwayatPangkat::create([
                    'nip_pegawai'  => $data['nip_pegawai'],
                    'id_golongan'  => $data['id_golongan'],
                    'tmt'          => $data['tmt'],
                    'penjabat'     => $data['penjabat'],
                    'nomor'        => $data['nomor'],
                    'tanggal'      => $data['tanggal'],
                    'batas_berlaku'=> $data['batas_berlaku'],
                    'status'       => 0
                ]);
                return redirect()->route('pegawai-pangkat-pns.create')->with('status','Data Pangkat PNS pegawai berhasil ditambahkan');
            }
        
    }

    public function edit($id)
    {
        $pegawai  = PangkatPNS::findOrFail($id);
        //get data golongan
        $golongan = Golongan::where('status','=',0)->get();

        return view('operator-kepegawaian.pangkat-pns.pangkat-pns-edit',compact('golongan','pegawai'));
    }

    public function update(PangkatPNSRequest $request, $id)
    {
        $data  = $request->all();
        $data['tmt'] = date('Y-m-d H:i:s',strtotime($data['tmt'] ));
        $data['tanggal'] = date('Y-m-d H:i:s',strtotime($data['tanggal'] ));
        
        $item  = PangkatPNS::findOrFail($id);
        $item->update($data);
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data riwayat Pangkat CPNS berhasil diedit");
    }

    public function destroy($id)
    {
        $data   = PangkatPNS::findOrFail($id);
        $data->delete();
        
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data Pangkat PNS pegawai berhasil dihapus");
    }
}
