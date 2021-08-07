<?php

namespace App\Http\Controllers\OperatorKepegawaian;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperatorKepegawaian\MertuaRequest;
use App\Models\Mertua;
use Illuminate\Http\Request;

class MertuaController extends Controller
{
    public function create()
    {
        return view('operator-kepegawaian.mertua.mertua-create');
    }

    public function store(MertuaRequest $request)
    {
        $data = $request->all();
        //pisahkan dan ambil nip pegawai saja
        $explode = explode(' - ',$request->nip_pegawai,-1);
        //masukan nip ke variabel data['id]
        $data ['nip_pegawai'] = $explode[0];
        //timpa nip lama dengan nip baru yang sudah dipisahkan dari nama
        $data['tgl_lahir'] = date('Y-m-d H:i:s',strtotime($data['tgl_lahir'] ));
        
        Mertua::create($data);
        return redirect()->route('pegawai-mertua.create')->with('status','Data Mertua berhasil ditambah');
    }
    public function edit($id)
    {
        $pegawai = Mertua::findOrFail($id);
        return view('operator-kepegawaian.mertua.mertua-edit',compact('pegawai'));
    }

    public function update(MertuaRequest $request, $id)
    {
        $data   = $request->all();
        $data['tgl_lahir'] = date('Y-m-d H:i:s',strtotime($data['tgl_lahir'] ));

        $item   = Mertua::findOrFail($id);
        $item->update($data);
        return redirect()->route('data-pegawai.edit',$data['nip_pegawai'])->with('status',"Data Mertua berhasil diedit");
    }

    public function destroy($id)
    {
        $data = Mertua::findOrFail($id);
        $data->delete();
        return redirect()->route('data-pegawai.edit',$data->nip_pegawai)->with('status',"Data Mertua berhasil dihapus");
    }
}
