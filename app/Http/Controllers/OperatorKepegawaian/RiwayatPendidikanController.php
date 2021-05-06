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
