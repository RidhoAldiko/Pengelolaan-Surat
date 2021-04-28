<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\KeteranganKeluargaRequest;
use App\Models\KeteranganKeluarga;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Null_;

class KeteranganKeluargaController extends Controller
{
    public function create()
    {
        return view('operator-kepegawaian.keterangan-keluarga.keterangan-keluarga-create');
    }

    public function store(KeteranganKeluargaRequest $request)
    {
        $data = $request->all();
        //jika status bukan anak maka jalankan validasi tgl_nikah
        if ($data['status'] !== 'Anak') {
            $this->validate($request,[
                'tgl_nikah' => 'required'
            ],[
                'tgl_nikah.required' => 'Tgl Nikah wajib di isi jika status Suami/Istri'
            ]);
        }else{
            //jika dia anak set tgl nikahnya null
            $data['tgl_nikah']=null;
        }
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //masukan nip ke variabel data['id]
        $data ['nip_pegawai'] = $explode[0];
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama
        
        KeteranganKeluarga::create($data);
        return redirect()->route('pegawai-keterangan-keluarga.create')->with('status','Data Keterangan keluarga berhasil ditambah');
    }

    public function edit($id)
    {
        $pegawai  = KeteranganKeluarga::findOrFail($id);
        return view('operator-kepegawaian.keterangan-keluarga.keterangan-keluarga-edit',compact('pegawai'));
    }

    public function update(KeteranganKeluargaRequest $request, $id)
    {
        $data = $request->all();
            //jika status bukan anak maka jalankan validasi tgl_nikah
            if ($data['status'] !== 'Anak') {
                $this->validate($request,[
                    'tgl_nikah' => 'required'
                ],[
                    'tgl_nikah.required' => 'Tgl Nikah wajib di isi jika status Suami/Istri'
                ]);
            }else{
                //jika dia anak set tgl nikahnya null
                $data['tgl_nikah']=null;
            }
            
        $item = KeteranganKeluarga::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Keterangan keluarga berhasil diedit");
    }

    public function destroy($id)
    {
        $data = KeteranganKeluarga::findOrFail($id);
        $data->delete();
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data Keterangan keluarga berhasil dihapus");
    }
}
