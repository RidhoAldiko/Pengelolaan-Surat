<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\OrganisasiRequest;
use App\Models\Organisasi;
use Illuminate\Http\Request;

class OrganisasiController extends Controller
{
    public function create()
    {
        return view('operator-kepegawaian.organisasi.organisasi-create');
    }

    public function store(OrganisasiRequest $request)
    {
        $data = $request->all();
        $data = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //masukan nip ke variabel data['id]
        $data ['nip_pegawai'] = $explode[0];
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama
        Organisasi::create($data);
        return redirect()->route('pegawai-organisasi.create')->with('status','Data organisasi berhasil ditambah');

    }

    public function edit($id)
    {
        $pegawai = Organisasi::findOrFail($id);

        return view('operator-kepegawaian.organisasi.organisasi-edit',compact('pegawai'));
    }

    public function update(OrganisasiRequest $request,$id)
    {
        $data   = $request->all();
        $item   = Organisasi::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data organisasi berhasil diedit");
    }

    public function destroy($id)
    {
        $data   = Organisasi::findOrFail($id);
        $data->delete();
        
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data organisasi berhasil dihapus");
    }
}
