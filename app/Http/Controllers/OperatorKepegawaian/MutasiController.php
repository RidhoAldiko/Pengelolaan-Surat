<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\MutasiRequest;
use App\Models\Mutasi;
use Illuminate\Http\Request;

class MutasiController extends Controller
{
    public function create()
    {
        return view('operator-kepegawaian.mutasi.mutasi-create');
    }

    public function store(MutasiRequest $request)
    {
        $data = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //masukan nip ke variabel data['id]
        $data ['nip_pegawai'] = $explode[0];
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama
        
        Mutasi::create($data);
        return redirect()->route('pegawai-mutasi.create')->with('status','Data Mutasi berhasil ditambah');
    }

    public function edit($id)
    {
        $pegawai = Mutasi::findOrFail($id);
        return view('operator-kepegawaian.mutasi.mutasi-edit',compact('pegawai'));
    }

    public function update(MutasiRequest $request, $id)
    {
        $data = $request->all();
        $item = Mutasi::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Mutasi berhasil diedit");
    }

    public function destroy($id)
    {
        $data = Mutasi::findOrFail($id);
        $data->delete();
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data Mutasi berhasil dihapus");
    }
}
