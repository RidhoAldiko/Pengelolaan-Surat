<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\KeteranganLainRequest;
use App\Models\KeteranganLain;
use Illuminate\Http\Request;

class KeteranganLainController extends Controller
{
    public function create()
    {
        return view('operator-kepegawaian.keterangan-lain.keterangan-lain-create');
    }

    public function store(KeteranganLainRequest $request)
    {
        $data = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //masukan nip ke variabel data['id]
        $data ['nip_pegawai'] = $explode[0];
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama

        KeteranganLain::create($data);
        return redirect()->route('pegawai-keterangan-lain.create')->with('status','Data keterangan lain berhasil ditambah');
    }

    public function edit($id)
    {
        $pegawai = KeteranganLain::findOrFail($id);
        return view('operator-kepegawaian.keterangan-lain.keterangan-lain-edit',compact('pegawai'));
    }

    public function update(KeteranganLainRequest $request, $id)
    {
        $data = $request->all();
        $item = KeteranganLain::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data keterangan lain berhasil diedit");
    }

    public function destroy($id)
    {
        $data = KeteranganLain::findOrFail($id);
        $data->delete();
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data keterangan lain berhasil dihapus");
    }
}
