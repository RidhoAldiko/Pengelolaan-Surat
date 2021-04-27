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
        $pegawai    = Pegawai::where('status','0')->orderBy('nama_pegawai','asc')->get();
        return view('operator-kepegawaian.riwayat-pendidikan.riwayat-pendidikan-create',compact('pegawai'));
    }

    public function store(RiwayatPendidikanRequest $request)
    {
        $data   = $request->all();
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
