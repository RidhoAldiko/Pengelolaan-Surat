<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\SaudaraKandungRequest;
use App\Models\SaudaraKandung;
use Illuminate\Http\Request;

class SaudaraKandungController extends Controller
{
    public function create()
    {
        return view('operator-kepegawaian.saudara-kandung.saudara-kandung-create ');
    }

    public function store(SaudaraKandungRequest $request)
    {
        $data = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //masukan nip ke variabel data['id]
        $data ['nip_pegawai'] = $explode[0];
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama
       
        SaudaraKandung::create($data);
        return redirect()->route('pegawai-saudara-kandung.create')->with('status','Data saudara kandung berhasil ditambah');
    }
    public function edit($id)
    {
        $pegawai = SaudaraKandung::findOrFail($id);
        return view('operator-kepegawaian.saudara-kandung.saudara-kandung-edit',compact('pegawai'));
    }

    public function update(SaudaraKandungRequest $request, $id)
    {
        $data   = $request->all();
        $item   = SaudaraKandung::findOrFail($id);
        $item->update($data);
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Saudara kandung berhasil diedit");
    }

    public function destroy($id)
    {
        $data = SaudaraKandung::findOrFail($id);
        $data->delete();
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data Saudara kandung berhasil dihapus");
    }
}
