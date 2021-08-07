<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\PangkatCPNSRequest;
use App\Models\Golongan;
use App\Models\PangkatCPNS;
use Illuminate\Http\Request;

class PangkatCPNSController extends Controller
{
    public function create()
    {
        //get data golongan
        $golongan = Golongan::where('status','=',0)->get();
        return view('operator-kepegawaian.pangkat-cpns.pangkat-cpns-create',compact('golongan'));
    }

    public function store(PangkatCPNSRequest $request)
    {
        $data = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama
        $data['nip_pegawai'] = $explode[0];
        $data['tmt'] = date('Y-m-d H:i:s',strtotime($data['tmt'] ));
        $data['tanggal'] = date('Y-m-d H:i:s',strtotime($data['tanggal'] ));

        $pangkatCPNS = PangkatCPNS::where('nip_pegawai',$data['nip_pegawai'])->first();
            //jika sudah pernah input pangkat cpns maka campakan ke form lagi
            if ($pangkatCPNS != null) {
                return redirect()->route('pegawai-pangkat-cpns.create')->with('status_gagal','Data Pangkat CPNS pegawai sudah pernah diinputkan!');
            }else{
                PangkatCPNS::create($data);
                return redirect()->route('pegawai-pangkat-cpns.create')->with('status','Data Pangkat CPNS pegawai berhasil ditambahkan');
            }
        
    }

    public function edit($id)
    {
        $pegawai  = PangkatCPNS::findOrFail($id);
        //get data golongan
        $golongan = Golongan::where('status','=',0)->get();

        return view('operator-kepegawaian.pangkat-cpns.pangkat-cpns-edit',compact('golongan','pegawai'));
    }

    public function update(PangkatCPNSRequest $request, $id)
    {
        $data  = $request->all();
        $data['tmt'] = date('Y-m-d H:i:s',strtotime($data['tmt'] ));
        $data['tanggal'] = date('Y-m-d H:i:s',strtotime($data['tanggal'] ));
        
        $item  = PangkatCPNS::findOrFail($id);
        $item->update($data);
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data riwayat Pangkat CPNS berhasil diedit");
    }

    public function destroy($id)
    {
        $data   = PangkatCPNS::findOrFail($id);
        $data->delete();
        
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data Pangkat CPNS pegawai berhasil dihapus");
    }
}
