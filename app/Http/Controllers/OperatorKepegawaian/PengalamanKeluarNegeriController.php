<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\PengalamanKeluarNegeriRequest;
use App\Models\PengalamanKeluarNegeri;
use Illuminate\Http\Request;

class PengalamanKeluarNegeriController extends Controller
{
    public function create()
    {
        return view('operator-kepegawaian.pengalaman-keluar-negeri.pengalaman-keluar-negeri-create');
    }

    public function store(PengalamanKeluarNegeriRequest $request)
    {
        $data = $request->all();
        $data = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //masukan nip ke variabel data['id]
        $data ['nip_pegawai'] = $explode[0];
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama

        PengalamanKeluarNegeri::create($data);
        return redirect()->route('pegawai-pengalaman-keluar-negeri.create')->with('status','Data Pengalaman keluar negeri berhasil ditambah');

    }

    public function edit($id)
    {
        $pegawai = PengalamanKeluarNegeri::findOrFail($id);

        return view('operator-kepegawaian.pengalaman-keluar-negeri.pengalaman-keluar-negeri-edit',compact('pegawai'));
    }

    public function update(PengalamanKeluarNegeriRequest $request,$id)
    {
        $data   = $request->all();
        $item   = PengalamanKeluarNegeri::findOrFail($id);
        $item->update($data);

        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Pengalaman keluar negeri berhasil diedit");
    }

    public function destroy($id)
    {
        $data   = PengalamanKeluarNegeri::findOrFail($id);
        $data->delete();
        
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data Pengalaman keluar negeri berhasil dihapus");
    }
}
