<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\RiwayatPendidikanRequest;
use App\Models\Pegawai;
use App\Models\RiwayatPendidikan;
use Illuminate\Http\Request;

class RiwayatPendidikanController extends Controller
{
    public function create()
    {

        return view('operator-kepegawaian.riwayat-pendidikan.riwayat-pendidikan-create');
    }

    public function store(RiwayatPendidikanRequest $request)
    {
        $data   = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //masukan nip ke variabel data['id]
        $data ['id'] = $explode[0];
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama
        $data['nip_pegawai'] = $data['id'];
        $data['tgl_sttb'] = date('Y-m-d H:i:s',strtotime($data['tgl_sttb'] ));
        $data['mulai'] = date('Y-m-d H:i:s',strtotime($data['mulai'] ));
        $data['sampai'] = date('Y-m-d H:i:s',strtotime($data['sampai'] ));

        //jika tidak menginputkan tanggal mulai dan selesai pendidikan maka set null
        if ($data['mulai']==='1970-01-01 00:00:00' && $data['sampai']==='1970-01-01 00:00:00') {
            $data['mulai']=null;
            $data['sampai']=null;
        }
        RiwayatPendidikan::create($data);

        return redirect()->route('riwayat-pendidikan.create')->with('status',"Data Pendidikan berhasil ditambah");
    }

    public function edit($id)
    {
        
        $pegawai = RiwayatPendidikan::findOrFail($id);
        
        return view('operator-kepegawaian.riwayat-pendidikan.riwayat-pendidikan-edit',compact('pegawai'));
    }

    public function update(RiwayatPendidikanRequest $request, $id)
    {
        $data = $request->all();
        $data['tgl_sttb'] = date('Y-m-d H:i:s',strtotime($data['tgl_sttb'] ));
        $data['mulai'] = date('Y-m-d H:i:s',strtotime($data['mulai'] ));
        $data['sampai'] = date('Y-m-d H:i:s',strtotime($data['sampai'] ));
        //jika tidak menginputkan tanggal mulai dan selesai pendidikan maka set null
        if ($data['mulai']==='1970-01-01 00:00:00' && $data['sampai']==='1970-01-01 00:00:00') {
            $data['mulai']=null;
            $data['sampai']=null;
        }
        $item = RiwayatPendidikan::findOrFail($id);
        $item->update($data);
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Riwayat pendidikan berhasil diedit");
    }

    public function destroy($id)
    {
        $data = RiwayatPendidikan::findOrFail($id);
        $data->delete();
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data Riwayat pendidikan berhasil dihapus");
        
    }
}
